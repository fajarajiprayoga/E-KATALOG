<?php
$currenttime = date('d-m-Y H:i:s');
$id = Yii::app()->user->id;

$command= Yii::app()->dbOracle->createCommand("INSERT INTO KATALOG_CLASS (ID_CLASS,NAMA_CLASS,ID_PRODUK, CREATED_AT, CREATED_BY)VALUES(:ID_CLASS,:NAMA_CLASS, :ID_PRODUK, to_date(:CREATED_AT, 'dd-mm-yy hh24:mi:ss'),:CREATED_BY)");
$command->bindValue(':ID_CLASS', "");
$command->bindValue(':NAMA_CLASS', $namaclass);
$command->bindValue(':ID_PRODUK', $idproduk);
$command->bindValue(':CREATED_AT', $currenttime);
$command->bindValue(':CREATED_BY', $id);
$command->execute();

$arrFromDb = array(
'status' => '1'
);
echo json_encode( $arrFromDb ); exit();
