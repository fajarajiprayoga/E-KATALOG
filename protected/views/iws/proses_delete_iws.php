<?php

if(isset($_POST['idskrb'])){
    $idskrb = $_POST['idskrb'];
    
    if($_POST['dept'] == "0"){
        $directori = "SALES";
    } else {
        $directori = "ENG";
    }
    
    $arr = array();
    $qdatakatalog = Yii::app()->db->createCommand("SELECT * FROM KATALOG_SKRB_$directori WHERE ID_SKRB_$directori = '$idskrb'")->queryAll();
    foreach($qdatakatalog as $datakatalog){
        $data['filename'] = $arr[]=$datakatalog['FILE_NAME'];
        $data['islastversion'] = $arr[]=$datakatalog['ISLASTVERSION'];
    }
    
    if($data['islastversion'] == 'X') {
        $arrFromDb = array('status' => "2");
        echo json_encode( $arrFromDb ); 
        exit();
    } else {
        Yii::app()->db->createCommand("DELETE FROM KATALOG_SKRB_$directori WHERE ID_SKRB_$directori = '$idskrb'")->execute();
        
        if (file_exists("FILE/SKRB/$directori/".$data['filename'])) {
            unlink("FILE/SKRB/$directori/".$data['filename']);
        }
        
        $arrFromDb = array('status' => "1");
        echo json_encode( $arrFromDb ); 
        exit();
    }
    
} else {}