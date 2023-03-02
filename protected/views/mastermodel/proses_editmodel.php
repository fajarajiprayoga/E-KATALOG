<?php
if(isset($_POST['idmodel'])){
    $namamodel = $_POST['namamodel'];
    $idmodel = $_POST['idmodel'];
    $idproduk = $_POST['idproduk'];
    $idclass = $_POST['idclass'];
    
    $currenttime = date('d-m-Y H:i:s');
    $id = Yii::app()->user->id;
    $connection = yii::app()->dbOracle;
    $sqlupdate = "UPDATE KATALOG_MODEL SET NAMA_MODEL = '$namamodel', ID_PRODUK = '$idproduk', ID_CLASS = '$idclass' WHERE ID_MODEL="."'".$idmodel."'";
    $command=$connection->createCommand($sqlupdate);
    $command->execute();
    $arrFromDb = array('status' => "1");
    echo json_encode( $arrFromDb ); 
    exit();
} else {}