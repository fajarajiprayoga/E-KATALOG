<?php
if(isset($_POST['idclass'])){
    $namaclass = $_POST['namaclass'];
    $idproduk = $_POST['idproduk'];
    $idclass = $_POST['idclass'];
    
    $currenttime = date('d-m-Y H:i:s');
    $id = Yii::app()->user->id;
    $connection = yii::app()->dbOracle;
    $sqlupdate = "UPDATE KATALOG_CLASS SET NAMA_CLASS = '$namaclass', ID_PRODUK = '$idproduk' WHERE ID_CLASS="."'".$idclass."'";
    $command=$connection->createCommand($sqlupdate);
    $command->execute();
    $arrFromDb = array('status' => "1");
    echo json_encode( $arrFromDb ); 
    exit();
} else {}