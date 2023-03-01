<?php
if(isset($_POST['adafile'])){
    if($_POST['adafile'] == '0'){ //FILE TIDAK DI UBAH
        if(isset($_POST['iddrawingeng'])){
            $iddrawingeng = $_POST['iddrawingeng'];

            if($_POST['lastVersion'] == "true"){
                $lastVersion = "X";
            } else {
                $lastVersion = "O";
            }


            function updateDrawing($iddrawingeng, $deskripsi, $idchasis, $version, $lastversion){
                $currenttime = date('d-m-Y H:i:s');
                $id = Yii::app()->user->id;
                $connection = yii::app()->dbOracle;

                if($lastversion == 'X'){ // JIKA DRAWING LAST VERSION MAKA DRAWING LAIN YG LAST VERSION DI HAPUS DULU X NYA
                    $sqlupdate = "UPDATE KATALOG_DRAWING_ENG SET ISLASTVERSION = '' WHERE ID_CHASIS="."'".$idchasis."'";
                    $command=$connection->createCommand($sqlupdate);
                    $command->execute();
                    $finalLastversion = ", ISLASTVERSION = 'X'";
                } else { // JIKA DRAWING TIDAK LAST VERSION MAKA LAKUKAN PENGECEKAN APAKAH DI DALAM DI CHASIS ITU TERDAPAT LAST VERSION
                        // JIKA TIDAK TERDAPAT LAST VERSION MAKA OTOMATIS DRAWING YG DI INPUT MENJADI LAST VERSION
                    $arr = array();
                    $qlastversion = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_DRAWING_ENG WHERE ID_CHASIS = '$idchasis' AND ISLASTVERSION = 'X'")->queryAll();
                    if(count($qlastversion) > 0){
                        foreach ($qlastversion as $rowversion){
                            $data['iddrawing'] = $arr[]=$rowversion['ID_DRAWING_ENG'];
                        }
                        if($data['iddrawing'] == $iddrawingeng){
                            $finalLastversion = ", ISLASTVERSION = 'X'";
                        } else {
                            $finalLastversion = ", ISLASTVERSION = ''";
                        }

                    } else {
                        $finalLastversion = ", ISLASTVERSION = 'X'";
                    }
                }

                $sqlupdate = "UPDATE KATALOG_DRAWING_ENG SET FILE_VERSION = '$version', FILE_DESKRIPSI = '$deskripsi'$finalLastversion, UPDATE_AT = to_date('".$currenttime."','dd-mm-yy hh24:mi:ss'), UPDATE_BY = '$id' WHERE ID_DRAWING_ENG="."'".$iddrawingeng."'";
                $command=$connection->createCommand($sqlupdate);
                $command->execute();
            }
            updateDrawing($iddrawingeng, $_POST['deskrispi'], $_POST['idchasis'], $_POST['version'], $lastVersion);
            $arrFromDb = array('status' => "1");
            echo json_encode( $arrFromDb ); 
            exit();
        } else {}
        
    } else if($_POST['adafile'] == '1'){ //FILE DIUBAH
        if(isset($_POST['iddrawingeng'])){
            
            $iddrawingeng = $_POST['iddrawingeng'];

            if($_POST['lastVersion'] == "true"){
                $lastVersion = "X";
            } else {
                $lastVersion = "O";
            }
            
            //KHUSU VARIABLE FILE
            $format = explode(".", $_FILES['fileupload']['name']);
            $file_size = $_FILES['fileupload']['size'];
            $allowed_ext = array("sldprt", "slddrw", "cdr", "dwg", "jpg", "jpeg", "SLDPRT", "SLDDRW", "CDR", "DWG", "JPG", "JPEG","pdf", "PDF");
            $maxsize = 30 * 1024 * 1024; //30 MB
            $name_file = date("dmis")."-".$_FILES['fileupload']['name'];
            //KHUSU VARIABLE FILE
            
            function updateDrawing($name_file, $iddrawingeng, $deskripsi, $idchasis, $version, $lastversion){
                $currenttime = date('d-m-Y H:i:s');
                $id = Yii::app()->user->id;
                $connection = yii::app()->dbOracle;

                if($lastversion == 'X'){ // JIKA DRAWING LAST VERSION MAKA DRAWING LAIN YG LAST VERSION DI HAPUS DULU X NYA
                    $sqlupdate = "UPDATE KATALOG_DRAWING_ENG SET ISLASTVERSION = '' WHERE ID_CHASIS="."'".$idchasis."'";
                    $command=$connection->createCommand($sqlupdate);
                    $command->execute();
                    $finalLastversion = ", ISLASTVERSION = 'X'";
                } else { // JIKA DRAWING TIDAK LAST VERSION MAKA LAKUKAN PENGECEKAN APAKAH DI DALAM DI CHASIS ITU TERDAPAT LAST VERSION
                        // JIKA TIDAK TERDAPAT LAST VERSION MAKA OTOMATIS DRAWING YG DI INPUT MENJADI LAST VERSION
                    $arr = array();
                    $qlastversion = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_DRAWING_ENG WHERE ID_CHASIS = '$idchasis' AND ISLASTVERSION = 'X'")->queryAll();
                    if(count($qlastversion) > 0){
                        foreach ($qlastversion as $rowversion){
                            $data['iddrawingeng'] = $arr[]=$rowversion['ID_DRAWING_ENG'];
                        }
                        if($data['iddrawingeng'] == $iddrawingeng){
                            $finalLastversion = ", ISLASTVERSION = 'X'";
                        } else {
                            $finalLastversion = ", ISLASTVERSION = ''";
                        }

                    } else {
                        $finalLastversion = ", ISLASTVERSION = 'X'";
                    }
                }

                $sqlupdate = "UPDATE KATALOG_DRAWING_ENG SET FILE_VERSION = '$version', FILE_DESKRIPSI = '$deskripsi'$finalLastversion, UPDATE_AT = to_date('".$currenttime."','dd-mm-yy hh24:mi:ss'), UPDATE_BY = '$id', FILE_NAME = '$name_file' WHERE ID_DRAWING_ENG="."'".$iddrawingeng."'";
                $command=$connection->createCommand($sqlupdate);
                $command->execute();
            }
            
            if(in_array($format[1], $allowed_ext)){
                if($file_size < $maxsize){
                    //MENCARI NAMA FILE YG AKAN DIHAPUS BERDASARKAN ID DRAWING
                    $searchfilename = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_DRAWING_ENG WHERE ID_DRAWING_ENG = '$iddrawingeng'")->queryAll();
                    $arr=array();
                    foreach ($searchfilename as $rowfilename){
                        $data['datafilename'] = $arr[]=$rowfilename['FILE_NAME'];
                    }
                    //MENCARI NAMA FILE YG AKAN DIHAPUS BERDASARKAN ID DRAWING
                    
                    //EKSEKUIS UPDATE DATA
                    updateDrawing($name_file, $iddrawingeng, $_POST['deskrispi'], $_POST['idchasis'], $_POST['version'], $lastVersion);
                    
                    //VARIABEL LETAK DIREKTORI FILE
                    $temp = "FILE/DRAWING/";
                    
                    //MENGHAPUS FILE
                    if (file_exists($temp.$data['datafilename'])) {
                        unlink($temp.$data['datafilename']);
                    }
                    
                    // MENYIMPAN FILE BARU
                    move_uploaded_file($_FILES["fileupload"]["tmp_name"], $temp.$name_file); 
                    
                    //BALIKAN DATA UNTUK NOTIFIKASI
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
            
        } else {
            echo '3';
        }
    } else{
        echo $_POST['adafile'];
    }
} else {
    echo '1';
}