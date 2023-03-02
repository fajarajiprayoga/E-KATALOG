<?php
if(isset($_POST['idtype'])){
    $namatype = $_POST['namatype'];
    $idtype = $_POST['idtype'];
    $idmodel = $_POST['idmodel'];
    $idproduk = $_POST['idproduk'];
    $idclass = $_POST['idclass'];
    
    $currenttime = date('d-m-Y H:i:s');
    $id = Yii::app()->user->id;
    $connection = yii::app()->dbOracle;
    $sqlupdate = "UPDATE KATALOG_TYPE SET NAMA_TYPE = '$namatype', ID_PRODUK = '$idproduk', ID_CLASS = '$idclass', ID_MODEL = '$idmodel' WHERE ID_TYPE = "."'".$idtype."'";
    $command=$connection->createCommand($sqlupdate);
    $command->execute();
    $arrFromDb = array('status' => "1");
    echo json_encode( $arrFromDb ); 
    exit();
} else {}