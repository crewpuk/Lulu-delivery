<?php
ini_set("memory_limit", "1024M");
$tmp_path = ".tmp/";
if(!file_exists($tmp_path))mkdir($tmp_path, 0755);
// else chmod($tmp_path, 0755);

// print_r(($tmp_path));

$file_excel_name = image_name($tmp_path,$_FILES['excel_file']['name'],TRUE);

$file_path = $tmp_path.$file_excel_name['fullname'];



if(strtolower($file_excel_name['ext'])=="dbf"&&$_POST['id_sub_office']!="product"){

  function dbf2json($dbfname) {
    $r = "";
      $fdbf = fopen($dbfname,'r');
      $fields = array();
      $buf = fread($fdbf,32);
      $header=unpack( "VRecordCount/vFirstRecord/vRecordLength", substr($buf,4,8));
      //echo 'Header: '.json_encode($header).'<br/>';
      $goon = true;
  /**/$unpackString='A1DeletionFlag/';
      while ($goon && !feof($fdbf)) { // read fields:
          $buf = fread($fdbf,32);
          if (substr($buf,0,1)==chr(13)) {$goon=false;} // end of field list
          else {
              $field=unpack( "a11fieldname/A1fieldtype/Voffset/Cfieldlen/Cfielddec", substr($buf,0,18));
              //echo 'Field: '.json_encode($field).'<br/>';
              $unpackString.="A$field[fieldlen]$field[fieldname]/";
              array_push($fields, $field);}}
  /**/fseek($fdbf, $header['FirstRecord']); // move back to the start of the first record (after the field definitions)
          $r.=('[');
      for ($i=1; $i<=$header['RecordCount']; $i++) {
          $buf = fread($fdbf,$header['RecordLength']);
          $record=unpack($unpackString,$buf);
  /**/    if ($record['DeletionFlag'] == '*') continue;
          if($i>1)$r.=(',');
          $record=str_replace(" ", "", $record);
          $r.= json_encode($record);
          //echo /*$i.$buf.*/'<br/>';
          } //raw record
          $r.=(']');
      fclose($fdbf);
      return $r;
  }

  move_uploaded_file($_FILES['excel_file']['tmp_name'], $file_path);

  $file = $file_path;
  $aray = dbf2json($file);

  $e=(json_decode($aray));

  $num_update=0;
  $num_insert=0;
  $num_error=0;
  $non_product=0;
  for($i=0;$i<count($e);$i++){
      $data = $e[$i];
      // B_DATE
      // B_TIME
      // B_SKU
      // B_PCS
      // B_HRG

      // [B_DATE] => 20120321
      // [B_TIME] => 13:38:12
      // [B_SKU] => 0000542
      // [B_PCS] => 0
      // [B_HRG] => 14500.00

      $time = substr($data->B_DATE, 0, 4).'-'.substr($data->B_DATE, 4, 2).'-'.substr($data->B_DATE, 6, 2).' '.$data->B_TIME;
      $code_product = $data->B_SKU;
      $stock_product = $data->B_PCS;
      $price_product = $data->B_HRG;
      $id_sub_office = $_POST['id_sub_office'];


      $check_CP = mysql_num_rows(mysql_query("SELECT code_product FROM m_product WHERE code_product = '".$code_product."'"));
      $check_SP = mysql_num_rows(mysql_query("SELECT stock FROM m_stock WHERE code_product = '".$code_product."' AND id_sub_office = '".$id_sub_office."'"));
      if($check_CP<=0){
      	$non_product++;
      }
      elseif($check_SP>0){
        $success1 = mysql_query("UPDATE m_product SET price_product = '".$price_product."' WHERE code_product = '".$code_product."';\n");
        $success2 = mysql_query("UPDATE m_stock SET stock = '$stock_product', last_edit = '$time' WHERE code_product = '$code_product' AND id_sub_office = '$id_sub_office';\n");
        $action="update";
        if($success1&&$success2){
          if($action=="update")$num_update++;
          else $num_insert++;
        }
        else $num_error++;
      }
      else{
        $success1 = mysql_query("UPDATE m_product SET price_product = '".$price_product."' WHERE code_product = '".$code_product."';\n");
        $success = mysql_query("INSERT INTO m_stock(id_stock,code_product,id_sub_office,stock,last_edit) VALUES('','$code_product','$id_sub_office','$stock_product','$time');\n");
        $action="insert";
        if($success){
          if($action=="update")$num_update++;
          else $num_insert++;
        }
        else $num_error++;
      }
        

      //echo($time."\t".$code_product."\t".$stock_product."\t".$price_product."\n");
  }

  @unlink($file_path);

  echo("Import Excel telah selesai.<br>\nSebanyak $non_product product tidak terdapat pada data product.<br>\nSebanyak $num_insert telah berhasil diimport.<br>\nSebanyak $num_update telah berhasil diperbarui.<br>\nSebanyak $num_error gagal.<br><br>");

}
elseif((strtolower($file_excel_name["ext"])=="xls"||strtolower($file_excel_name["ext"])=="xlsx"||strtolower($file_excel_name["ext"])=="csv")&&$_POST['id_sub_office']=="product"){

	require_once("../lib/phpexcel/PHPExcel.php");
	require_once("../lib/phpexcel/PHPExcel/IOFactory.php");

	$objReaderState = true;
	if($file_excel_name["ext"]=='xls') {
	  $objReader = PHPExcel_IOFactory::createReader('Excel5'); 
	}elseif($file_excel_name["ext"]=='xlsx') {
	  $objReader = PHPExcel_IOFactory::createReader('Excel2007'); 
	}elseif($file_excel_name["ext"]=='csv') {
	  $objReader = new PHPExcel_Reader_CSV();
	}else{
	  $objReaderState = false;
	}
	// $objReader = PHPExcel_IOFactory::createReader('Excel2007'); // 2007
	// $objReader = new PHPExcel_Reader_CSV(); // csv
	// $objReader = PHPExcel_IOFactory::createReader('Excel5'); // 2003

	if($objReaderState==true){

    move_uploaded_file($_FILES['excel_file']['tmp_name'], $file_path);

    $check_field = mysql_query("SHOW FIELDS FROM m_product");
    $check_field_num_fld = 0;
    while($check_field_row = mysql_fetch_array($check_field)){
      if(!empty($check_field_row))$check_field_num_fld++;
    }

    $objPHPExcel = $objReader->load($file_path);

    $objWorksheet = $objPHPExcel->getActiveSheet();

    // Update all product into non-active
    mysql_query("UPDATE m_product SET status_product = '0'");
    $error_row=array();
    $row_number=0;

    $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
    $highestRow = $objWorksheet->getHighestRow();
    $highestColumn = $objWorksheet->getHighestColumn();

    $headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
    $headingsArray = $headingsArray[1];

    $r = -1;
    $namedDataArray = array();
    for ($row = 2; $row <= $highestRow; ++$row) {
        $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
            ++$r;
            foreach($headingsArray as $columnKey => $columnHeading) {
                $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
         
                $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
                $highestRow = $objWorksheet->getHighestRow();
                $highestColumn = $objWorksheet->getHighestColumn();

                $headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
                $headingsArray = $headingsArray[1];

                $r = -1;
                $namedDataArray = array();
                for ($row = 2; $row <= $highestRow; ++$row) {
                    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
                    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                        ++$r;
                        foreach($headingsArray as $columnKey => $columnHeading) {
                            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                        }
                    }
                }
                /*

                echo '<pre>';
                var_dump($namedDataArray);
                echo '</pre><hr />';
                
                [FLT] => 
                [B_DATETD] => 2/6/2012
                [B_TIMETD] => 09:13:03
                [B_DATETC] => 1/5/2012
                [B_TIMETC] => 17:39:11
                [B_DATETS] => 20120416
                [B_TIMETS] => 09:46:56
                [B_DATETK] => 
                [B_TIMETK] => 
                [B_DATEGD] => 20120513
                [B_TIMEGD] => 10:57:14
                [B_GRP] => S002
                [KODE] => 2497
                [GROUP] => SIROP
                [NAMA] => RIA SIROP KODIAL RUTBIR
                [SIZE] => 2L
                [KRT] => 1x6
                [HARGA] => 31000
                [DEPOK] => 0
                [CIBUBUR] => 0
                [SAWANGAN] => 0
                [GUDANG] => 0
                [KOMSEN] => 0
                [TOTAL] => 0
                [PAKAI] => 0
                [] => 
                */

                }
            }
            
            /*$num_update=0;
            $num_insert=0;
            $num_error=0;
            for($i=0;$i<count($namedDataArray);$i++){

              $namedDataArray[$i]["NAMA"] = mysql_real_escape_string($namedDataArray[$i]["NAMA"]);

              // B_GRP  KODE  GROUP NAMA  SIZE  KRT HARGA DEPOK CIBUBUR SAWANGAN  GUDANG  KOMSEN  TOTAL PAKAI
                $check_CP = mysql_num_rows(mysql_query("SELECT code_product FROM m_product WHERE code_product = '".$namedDataArray[$i]["KODE"]."'"));
                if($check_CP>0){
                  $success = mysql_query("UPDATE m_product SET  code_group = '".$namedDataArray[$i]["B_GRP"]."', group_product = '".$namedDataArray[$i]["GROUP"]."', name_product = '".$namedDataArray[$i]["NAMA"]."', size_product = '".$namedDataArray[$i]["SIZE"]."', `sum-pcs_product` = '".$namedDataArray[$i]["KRT"]."', price_product = '".$namedDataArray[$i]["HARGA"]."', status_product = '1' WHERE code_product = '".$namedDataArray[$i]["KODE"]."'") or die(mysql_error());

                  mysql_query("UPDATE m_stock SET stock = '".$namedDataArray[$i]["DEPOK"]."' WHERE id_sub_office = '1';\n") or die(mysql_error());
                  mysql_query("UPDATE m_stock SET stock = '".$namedDataArray[$i]["CIBUBUR"]."' WHERE id_sub_office = '2';\n") or die(mysql_error());
                  mysql_query("UPDATE m_stock SET stock = '".$namedDataArray[$i]["SAWANGAN"]."' WHERE id_sub_office = '3';\n") or die(mysql_error());
                  mysql_query("UPDATE m_stock SET stock = '".$namedDataArray[$i]["GUDANG"]."' WHERE id_sub_office = '4';\n") or die(mysql_error());
                  mysql_query("UPDATE m_stock SET stock = '".$namedDataArray[$i]["KOMSEN"]."' WHERE id_sub_office = '5';\n") or die(mysql_error());
                  $action="update";
                }
                else{
                  // code_group code_product  barcode group_product name_product  size_product  sum-pcs_product price_product status_product
                  $success = mysql_query("INSERT INTO m_product VALUES('".$namedDataArray[$i]["B_GRP"]."','".$namedDataArray[$i]["KODE"]."','','".$namedDataArray[$i]["GROUP"]."','".$namedDataArray[$i]["NAMA"]."','".$namedDataArray[$i]["SIZE"]."','".$namedDataArray[$i]["KRT"]."','".$namedDataArray[$i]["HARGA"]."','1')") or die(mysql_error());
                  //id_stock  code_product  id_sub_office stock last_edit
                    mysql_query("INSERT INTO m_stock VALUES('','".$namedDataArray[$i]["KODE"]."','1','".$namedDataArray[$i]["DEPOK"]."',CURRENT_TIMESTAMP)") or die(mysql_error());
                    mysql_query("INSERT INTO m_stock VALUES('','".$namedDataArray[$i]["KODE"]."','1','".$namedDataArray[$i]["CIBUBUR"]."',CURRENT_TIMESTAMP)") or die(mysql_error());
                    mysql_query("INSERT INTO m_stock VALUES('','".$namedDataArray[$i]["KODE"]."','1','".$namedDataArray[$i]["SAWANGAN"]."',CURRENT_TIMESTAMP)") or die(mysql_error());
                    mysql_query("INSERT INTO m_stock VALUES('','".$namedDataArray[$i]["KODE"]."','1','".$namedDataArray[$i]["GUDANG"]."',CURRENT_TIMESTAMP)") or die(mysql_error());
                    mysql_query("INSERT INTO m_stock VALUES('','".$namedDataArray[$i]["KODE"]."','1','".$namedDataArray[$i]["KOMSEN"]."',CURRENT_TIMESTAMP)") or die(mysql_error());
                  $action="insert";
                }
                if($success){
                  if($action=="update")$num_update++;
                  else $num_insert++;
                }
                else $num_error++;*/
        }

    // echo '<pre>';
    // print_r($namedDataArray);
    // echo '</pre><hr />';
    

    /*
    foreach ($objWorksheet->getRowIterator() as $row) {
      $row_number++;
        
      $cellIterator = $row->getCellIterator();
      $cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
                                                         // even if it is not set.
                                                         // By default, only cells
                                                         // that are set will be
                                                         // iterated.
      $col_for_row=array();

      $cell_number = 1;
      foreach($cellIterator as $cell){
        if($cell_number>11&&$cell_number<=23){
        	if($cell->getValue()==NULL&&$cell->getValue()==""){
        		if($cell_number==17)$col_for_row[]="1";
            if($cell_number>18)$col_for_row[]="0";
            else $col_for_row[]=" ";
        	}
        	else $col_for_row[] = $cell->getValue();
        }
        $cell_number++;
      }
      $namedDataArray[]=$col_for_row;
    }
    print_r($namedDataArray);
    /*
    $num_update=0;
    $num_insert=0;
    $num_error=0;
    for($i=0;$i<count($namedDataArray);$i++){

      $namedDataArray[$i]["NAMA"] = mysql_real_escape_string($namedDataArray[$i]["NAMA"]);

      // B_GRP  KODE  GROUP NAMA  SIZE  KRT HARGA DEPOK CIBUBUR SAWANGAN  GUDANG  KOMSEN  TOTAL PAKAI
        $check_CP = mysql_num_rows(mysql_query("SELECT code_product FROM m_product WHERE code_product = '".$namedDataArray[$i][1]."'"));
        if($check_CP>0){
          $success = mysql_query("UPDATE m_product SET  code_group = '".$namedDataArray[$i]["B_GRP"]."', group_product = '".$namedDataArray[$i]["GROUP"]."', name_product = '".$namedDataArray[$i]["NAMA"]."', size_product = '".$namedDataArray[$i]["SIZE"]."', `sum-pcs_product` = '".$namedDataArray[$i]["KRT"]."', price_product = '".$namedDataArray[$i]["HARGA"]."', status_product = '1' WHERE code_product = '".$namedDataArray[$i][1]."'") or die(mysql_error());

          mysql_query("UPDATE m_stock SET stock = '".$namedDataArray[$i]["DEPOK"]."' WHERE id_sub_office = '1';\n") or die(mysql_error());
          mysql_query("UPDATE m_stock SET stock = '".$namedDataArray[$i]["CIBUBUR"]."' WHERE id_sub_office = '2';\n") or die(mysql_error());
          mysql_query("UPDATE m_stock SET stock = '".$namedDataArray[$i]["SAWANGAN"]."' WHERE id_sub_office = '3';\n") or die(mysql_error());
          mysql_query("UPDATE m_stock SET stock = '".$namedDataArray[$i]["GUDANG"]."' WHERE id_sub_office = '4';\n") or die(mysql_error());
          mysql_query("UPDATE m_stock SET stock = '".$namedDataArray[$i]["KOMSEN"]."' WHERE id_sub_office = '5';\n") or die(mysql_error());
          $action="update";
        }
        else{
          // code_group code_product  barcode group_product name_product  size_product  sum-pcs_product price_product status_product
          $success = mysql_query("INSERT INTO m_product VALUES('".$namedDataArray[$i]["B_GRP"]."','".$namedDataArray[$i][1]."','','".$namedDataArray[$i]["GROUP"]."','".$namedDataArray[$i]["NAMA"]."','".$namedDataArray[$i]["SIZE"]."','".$namedDataArray[$i]["KRT"]."','".$namedDataArray[$i]["HARGA"]."','1')") or die(mysql_error());
          //id_stock  code_product  id_sub_office stock last_edit
            mysql_query("INSERT INTO m_stock VALUES('','".$namedDataArray[$i][1]."','1','".$namedDataArray[$i]["DEPOK"]."',CURRENT_TIMESTAMP)") or die(mysql_error());
            mysql_query("INSERT INTO m_stock VALUES('','".$namedDataArray[$i][1]."','1','".$namedDataArray[$i]["CIBUBUR"]."',CURRENT_TIMESTAMP)") or die(mysql_error());
            mysql_query("INSERT INTO m_stock VALUES('','".$namedDataArray[$i][1]."','1','".$namedDataArray[$i]["SAWANGAN"]."',CURRENT_TIMESTAMP)") or die(mysql_error());
            mysql_query("INSERT INTO m_stock VALUES('','".$namedDataArray[$i][1]."','1','".$namedDataArray[$i]["GUDANG"]."',CURRENT_TIMESTAMP)") or die(mysql_error());
            mysql_query("INSERT INTO m_stock VALUES('','".$namedDataArray[$i][1]."','1','".$namedDataArray[$i]["KOMSEN"]."',CURRENT_TIMESTAMP)") or die(mysql_error());
          $action="insert";
        }
        if($success){
          if($action=="update")$num_update++;
          else $num_insert++;
        }
        else $num_error++;
    }*/

    @unlink($file_path);

    $num_row_error = count($error_row);
    echo("Import Excel telah selesai.<br>\nSebanyak $num_insert telah berhasil diimport.<br>\nSebanyak $num_update telah berhasil diperbarui.<br>\nSebanyak $num_error gagal.<br>\nDan sebanyak $num_row_error baris gagal diimport dari $row_number baris pada excel.<br><br>");

	}
  else{
    echo("Format file tidak sesuai!<br><br>");
  }
}
else{
  echo("Format file tidak sesuai!<br><br>");
}
?>