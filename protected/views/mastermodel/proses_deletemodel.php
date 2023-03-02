<?php
if(isset($idmodel)){
    $idmodel = $_POST['idmodel'];
    $connection = yii::app()->dbOracle;
    
    $sqlmodel = "UPDATE KATALOG_MODEL SET ISDEL_MODEL = 'X' WHERE ID_MODEL = "."'".$idmodel."'";
    $command3=$connection->createCommand($sqlmodel);
    $command3->execute();
    
    $sqltype = "UPDATE KATALOG_TYPE SET ISDEL_TYPE = 'X' WHERE ID_MODEL = "."'".$idmodel."'";
    $command4=$connection->createCommand($sqltype);
    $command4->execute();
    
    $sqlchasis = "UPDATE KATALOG_CHASIS SET ISDEL_CHASIS = 'X' WHERE ID_MODEL = "."'".$idmodel."'";
    $command5=$connection->createCommand($sqlchasis);
    $command5->execute();
    
    $arrFromDb = array('status' => "1");
    echo json_encode( $arrFromDb ); 
    exit();
    
} else {}

?>