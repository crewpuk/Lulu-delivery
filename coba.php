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
        $r.= json_encode($record);
        //echo /*$i.$buf.*/'<br/>';
        } //raw record
        $r.=(']');
    fclose($fdbf);
    return $r;
} 
$file = "STOKTC_coba.DBF";
$aray = dbf2json($file);


//$aray = array(array("rian"=>array("haha"=>0,"hihi"=>1)),array("rian"=>array("haha"=>0,"hihi"=>1)));
echo var_dump(json_decode($aray));
?>