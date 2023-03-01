<?php
if(isset($idchasis)){
    $idchasis = $_POST['idchasis'];
    $connection = yii::app()->dbOracle;
    $sqlupdate = "UPDATE KATALOG_CHASIS SET ISDEL_CHASIS = 'X' WHERE ID_CHASIS= "."'".$idchasis."'";
    $command=$connection->createCommand($sqlupdate);
    $command->execute();
    $arrFromDb = array('status' => "1");
    echo json_encode( $arrFromDb ); 
    exit();
    
} else {}

?>