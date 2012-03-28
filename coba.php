<?php
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
$file = "STOKTC_coba.DBF";
$aray = dbf2json($file);

// $aray = array(array("rian"=>array("haha"=>0,"hihi"=>1)),array("rian"=>array("haha"=>0,"hihi"=>1)));
// $aray = json_encode($aray);

$e=(json_decode($aray));

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

    echo($time."\t".$code_product."\t".$stock_product."\t".$price_product."\n");
}
?>