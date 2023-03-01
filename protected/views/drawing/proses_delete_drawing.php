<?php

if(isset($_POST['iddrawingeng'])){
    $iddrawingeng = $_POST['iddrawingeng'];
    
    $arr = array();
    $qdatakatalog = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_DRAWING_ENG WHERE ID_DRAWING_ENG = '$iddrawingeng'")->queryAll();
    foreach($qdatakatalog as $datakatalog){
        $data['filename'] = $arr[]=$datakatalog['FILE_NAME'];
        $data['islastversion'] = $arr[]=$datakatalog['ISLASTVERSION'];
    }
    
    if($data['islastversion'] == 'X') {
        $arrFromDb = array('status' => "2");
        echo json_encode( $arrFromDb ); 
        exit();
    } else {
        Yii::app()->dbOracle->createCommand("DELETE FROM KATALOG_DRAWING_ENG WHERE ID_DRAWING_ENG = '$iddrawingeng'")->execute();
        
        if (file_exists("FILE/DRAWING/".$data['filename'])) {
            unlink("FILE/DRAWING/".$data['filename']);
        }
        
        $arrFromDb = array('status' => "1");
        echo json_encode( $arrFromDb ); 
        exit();
    }
    
} else {}