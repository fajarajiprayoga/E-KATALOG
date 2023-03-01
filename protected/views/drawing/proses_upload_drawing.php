<?php
$format = explode(".", $_FILES['fileupload']['name']);
$file_size = $_FILES['fileupload']['size'];
$allowed_ext = array("sldprt", "slddrw", "cdr", "dwg", "jpg", "jpeg", "SLDPRT", "SLDDRW", "CDR", "DWG", "JPG", "JPEG", "pdf", "PDF");
$maxsize = 30 * 1024 * 1024; //30 MB
$name_file = date("dmis")."-".$_FILES['fileupload']['name'];


if($_POST['lastVersion'] == "true"){
    $lastVersion = "X";
} else {
    $lastVersion = "O";
}

if(in_array($format[1], $allowed_ext)){
    if($file_size < $maxsize){
        $temp = "FILE/DRAWING/";
        move_uploaded_file($_FILES["fileupload"]["tmp_name"], $temp.$name_file); // Menyimpan file
        
        insertDrawing($name_file, $_POST['deskrispi'], $_POST['idchasis'], $_POST['version'], $lastVersion);
        $arrFromDb = array('status' => "1");
        echo json_encode( $arrFromDb ); 
        exit();
    } else {
        $arrFromDb = array('status' => '2');
        echo json_encode( $arrFromDb ); 
        exit();
    }
} else {
    $arrFromDb = array('status' => '3');
        echo json_encode( $arrFromDb ); 
        exit();
}


//upload file dengan curl lintas domain
/*if(in_array($file_name[1], $allowed_ext)){
    if($file_size < $maxsize){
        $name_file = md5(rand()).'-'.$_FILES['fileupload']['name'];
        $type_file = $file_name[1];

        if($_POST['departemen'] == "0"){
            $directori = "SALES";
        } else {
            $directori = "ENG";
        }
        
        if($_POST['lastVersion'] == "true"){
            $lastVersion = "X";
        } else {
            $lastVersion = "O";
        }

        $ch = curl_init();
        $cfile = new CURLFile($_FILES['fileupload']['tmp_name'], $_FILES['fileupload']['type'], $name_file);
        $data = array("myfile"=>$cfile);

        curl_setopt($ch, CURLOPT_URL, "http://10.30.20.115/sapdata/EKATALOG/SKRB/uploads.php?dir=$directori");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        $response = curl_exec($ch);
        
        if($response){
            insertSkrb($name_file, $_POST['deskrispi'], $directori, $_POST['idchasis'], $_POST['version'], $lastVersion);
        
            $arrFromDb = array('status' => "1");
            echo json_encode( $arrFromDb ); 
            exit();
        }
        
    } else {
        $arrFromDb = array('status' => '2');
        echo json_encode( $arrFromDb ); 
        exit();
    }
} else {
    $arrFromDb = array('status' => '3');
        echo json_encode( $arrFromDb ); 
        exit();
}*/

function insertDrawing($name_file, $deskripsi, $idchasis, $version, $lastversion){
    $currenttime = date('d-m-Y H:i:s');
    $id = Yii::app()->user->id;
    $connection = yii::app()->dbOracle;
    
    if($lastversion == 'X'){
        $sqlupdate = "UPDATE KATALOG_DRAWING_ENG SET ISLASTVERSION = '' WHERE ID_CHASIS="."'".$idchasis."'";
        $command=$connection->createCommand($sqlupdate);
        $command->execute();
        $finalLastversion = 'X';
    } else {
        $qlastversion = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_DRAWING_ENG WHERE ID_CHASIS = '$idchasis' AND ISLASTVERSION = 'X'")->queryAll();
        if(count($qlastversion) > 0){
            $finalLastversion = '';
        } else {
            $finalLastversion = 'X';
        }
    }
    
    
    $command= Yii::app()->dbOracle->createCommand("INSERT INTO KATALOG_DRAWING_ENG (FILE_NAME, FILE_DESKRIPSI, FILE_VERSION, ID_CHASIS, ISLASTVERSION, CREATED_AT, CREATED_BY)VALUES(:FILE_NAME, :FILE_DESKRIPSI, :FILE_VERSION, :ID_CHASIS, :ISLASTVERSION ,to_date(:CREATED_AT, 'dd-mm-yy hh24:mi:ss'),:CREATED_BY)");
    $command->bindValue(':FILE_NAME', $name_file);
    $command->bindValue(':FILE_DESKRIPSI', $deskripsi);
    $command->bindValue(':FILE_VERSION', $version);
    $command->bindValue(':ID_CHASIS', $idchasis);
    $command->bindValue(':ISLASTVERSION', $finalLastversion);
    $command->bindValue(':CREATED_AT', $currenttime);
    $command->bindValue(':CREATED_BY', $id);
    $command->execute();
}