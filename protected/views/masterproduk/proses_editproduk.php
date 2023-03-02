<?php
if(isset($_POST['idproduk'])){
    $idproduk = $_POST['idproduk'];
    $namaproduk = $_POST['namaproduk'];
    
    $currenttime = date('d-m-Y H:i:s');
    $id = Yii::app()->user->id;
    $connection = yii::app()->dbOracle;
    $sqlupdate = "UPDATE KATALOG_PRODUK SET NAMA_PRODUK = '$namaproduk' WHERE ID_PRODUK="."'".$idproduk."'";
    $command=$connection->createCommand($sqlupdate);
    $command->execute();
    $arrFromDb = array('status' => "1");
    echo json_encode( $arrFromDb ); 
    exit();
} else {}