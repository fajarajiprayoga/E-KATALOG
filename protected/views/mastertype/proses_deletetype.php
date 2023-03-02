<?php
if(isset($idtype)){
    $idtype = $_POST['idtype'];
    $connection = yii::app()->dbOracle;
    
    $sqltype = "UPDATE KATALOG_TYPE SET ISDEL_TYPE = 'X' WHERE ID_TYPE = "."'".$idtype."'";
    $command4=$connection->createCommand($sqltype);
    $command4->execute();
    
    $sqlchasis = "UPDATE KATALOG_CHASIS SET ISDEL_CHASIS = 'X' WHERE ID_TYPE = "."'".$idtype."'";
    $command5=$connection->createCommand($sqlchasis);
    $command5->execute();
    
    $arrFromDb = array('status' => "1");
    echo json_encode( $arrFromDb ); 
    exit();
    
} else {}

?>