<?php

$convert = implode(",", $data);
$explode1 = explode(",|,", $convert);

$arr=array();
$currenttime = date('d-m-Y H:i:s');
$id = Yii::app()->user->id;
$hitungData = 0;
for($d=0; $d<count($explode1); $d++){
    $explode2 = explode(",", $explode1[$d]);
    
    $command= Yii::app()->dbOracle->createCommand("INSERT INTO KATALOG_MODEL (ID_MODEL,NAMA_MODEL,ID_PRODUK, ID_CLASS, CREATED_AT, CREATED_BY)VALUES(:ID_MODEL, :NAMA_MODEL, :ID_PRODUK, :ID_CLASS, to_date(:CREATED_AT, 'dd-mm-yy hh24:mi:ss'),:CREATED_BY)");
    $command->bindValue(':ID_MODEL', "");
    $command->bindValue(':NAMA_MODEL', $explode2[2]);
    $command->bindValue(':ID_PRODUK', $explode2[0]);
    $command->bindValue(':ID_CLASS', $explode2[1]);
    $command->bindValue(':CREATED_AT', $currenttime);
    $command->bindValue(':CREATED_BY', $id);
    $command->execute();
    $hitungData++;
}

$arrFromDb = array(
'status' => '1',
'data' => $hitungData
);
echo json_encode( $arrFromDb ); exit();
