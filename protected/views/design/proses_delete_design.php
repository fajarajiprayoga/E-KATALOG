<?php

if(isset($_POST['iddesign'])){
    $iddesign = $_POST['iddesign'];
    
    $arr = array();
    $qdatakatalog = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_DESIGN WHERE ID_DESIGN = '$iddesign'")->queryAll();
    foreach($qdatakatalog as $datakatalog){
        $data['filename'] = $arr[]=$datakatalog['FILE_NAME'];
        $data['islastversion'] = $arr[]=$datakatalog['ISLASTVERSION'];
    }
    
    if($data['islastversion'] == 'X') {
        $arrFromDb = array('status' => "2");
        echo json_encode( $arrFromDb ); 
        exit();
    } else {
        Yii::app()->dbOracle->createCommand("DELETE FROM KATALOG_DESIGN WHERE ID_DESIGN = '$iddesign'")->execute();
        
        if (file_exists("FILE/DESIGN/".$data['filename'])) {
            unlink("FILE/DESIGN/".$data['filename']);
        }
        
        $arrFromDb = array('status' => "1");
        echo json_encode( $arrFromDb ); 
        exit();
    }
    
} else {}