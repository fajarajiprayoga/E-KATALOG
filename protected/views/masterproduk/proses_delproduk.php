<?php
if(isset($idproduk)){
    $idproduk = $_POST['idproduk'];
    $connection = yii::app()->dbOracle;
    
    $sqlproduk = "UPDATE KATALOG_PRODUK SET ISDEL_PRODUK = 'X' WHERE ID_PRODUK = "."'".$idproduk."'";
    $command1=$connection->createCommand($sqlproduk);
    $command1->execute();
    
    $sqlclass = "UPDATE KATALOG_CLASS SET ISDEL_CLASS = 'X' WHERE ID_PRODUK = "."'".$idproduk."'";
    $command2=$connection->createCommand($sqlclass);
    $command2->execute();
    
    $sqlmodel = "UPDATE KATALOG_MODEL SET ISDEL_MODEL = 'X' WHERE ID_PRODUK = "."'".$idproduk."'";
    $command3=$connection->createCommand($sqlmodel);
    $command3->execute();
    
    $sqltype = "UPDATE KATALOG_TYPE SET ISDEL_TYPE = 'X' WHERE ID_PRODUK = "."'".$idproduk."'";
    $command4=$connection->createCommand($sqltype);
    $command4->execute();
    
    $sqlchasis = "UPDATE KATALOG_CHASIS SET ISDEL_CHASIS = 'X' WHERE ID_PRODUK = "."'".$idproduk."'";
    $command5=$connection->createCommand($sqlchasis);
    $command5->execute();
    
    $arrFromDb = array('status' => "1");
    echo json_encode( $arrFromDb ); 
    exit();
    
} else {}

?>