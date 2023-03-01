<?php
if(isset($_POST['idchasis'])){
    $namachasis = $_POST['namachasis'];
    $idchasis = $_POST['idchasis'];
    $idproduk = $_POST['idproduk'];
    $idclass = $_POST['idclass'];
    $idmodel = $_POST['idmodel'];
    $idtype = $_POST['idtype'];
    
    $currenttime = date('d-m-Y H:i:s');
    $id = Yii::app()->user->id;
    $connection = yii::app()->dbOracle;
    $sqlupdate = "UPDATE KATALOG_CHASIS SET NAMA_CHASIS = '$namachasis', ID_PRODUK = '$idproduk', ID_CLASS = '$idclass', ID_MODEL = '$idmodel', ID_TYPE = '$idtype' WHERE ID_CHASIS="."'".$idchasis."'";
    $command=$connection->createCommand($sqlupdate);
    $command->execute();
    $arrFromDb = array('status' => "1");
    echo json_encode( $arrFromDb ); 
    exit();
} else {}