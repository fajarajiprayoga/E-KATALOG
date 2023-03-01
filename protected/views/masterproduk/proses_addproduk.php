<?php
$currenttime = date('d-m-Y H:i:s');
$id = Yii::app()->user->id;

$command= Yii::app()->dbOracle->createCommand("INSERT INTO KATALOG_PRODUK (ID_PRODUK,NAMA_PRODUK,CREATED_AT,CREATED_BY)VALUES(:ID_PRODUK,:NAMA_PRODUK,to_date(:CREATED_AT, 'dd-mm-yy hh24:mi:ss'),:CREATED_BY)");
$command->bindValue(':ID_PRODUK', "");
$command->bindValue(':NAMA_PRODUK', $namaproduk);
$command->bindValue(':CREATED_AT', $currenttime);
$command->bindValue(':CREATED_BY', $id);
$command->execute();

$arrFromDb = array(
'status' => '1'
);
echo json_encode( $arrFromDb ); exit();
