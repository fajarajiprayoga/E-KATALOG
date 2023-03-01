<?php
if(isset($_POST['adafile'])){
    if($_POST['adafile'] == '0'){ //FILE TIDAK DI UBAH
        if(isset($_POST['idskrbsales'])){
            $idskrbsales = $_POST['idskrbsales'];
            
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


            function insertSkrb($idskrbsales, $deskripsi, $directori, $idchasis, $version, $lastversion){
                $currenttime = date('d-m-Y H:i:s');
                $id = Yii::app()->user->id;
                $connection = yii::app()->dbOracle;

                if($lastversion == 'X'){ // JIKA SKRB LAST VERSION MAKA SKRB LAIN YG LAST VERSION DI HAPUS DULU X NYA
                    $sqlupdate = "UPDATE KATALOG_SKRB_$directori SET ISLASTVERSION = '' WHERE ID_CHASIS="."'".$idchasis."'";
                    $command=$connection->createCommand($sqlupdate);
                    $command->execute();
                    $finalLastversion = ", ISLASTVERSION = 'X'";
                } else { // JIKA SKRB TIDAK LAST VERSION MAKA LAKUKAN PENGECEKAN APAKAH DI DALAM DI CHASIS ITU TERDAPAT LAST VERSION
                        // JIKA TIDAK TERDAPAT LAST VERSION MAKA OTOMATIS SKRB YG DI INPUT MENJADI LAST VERSION
                    $arr = array();
                    $qlastversion = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_SKRB_$directori WHERE ID_CHASIS = '$idchasis' AND ISLASTVERSION = 'X'")->queryAll();
                    if(count($qlastversion) > 0){
                        foreach ($qlastversion as $rowversion){
                            $data['idskrb'] = $arr[]=$rowversion['ID_SKRB_'.$directori];
                        }
                        if($data['idskrb'] == $idskrbsales){
                            $finalLastversion = ", ISLASTVERSION = 'X'";
                        } else {
                            $finalLastversion = ", ISLASTVERSION = ''";
                        }

                    } else {
                        $finalLastversion = ", ISLASTVERSION = 'X'";
                    }
                }

                $sqlupdate = "UPDATE KATALOG_SKRB_$directori SET FILE_VERSION = '$version', FILE_DESKRIPSI = '$deskripsi'$finalLastversion, UPDATE_AT = to_date('".$currenttime."','dd-mm-yy hh24:mi:ss'), UPDATE_BY = '$id' WHERE ID_SKRB_".$directori."="."'".$idskrbsales."'";
                $command=$connection->createCommand($sqlupdate);
                $command->execute();
            }
            insertSkrb($idskrbsales, $_POST['deskrispi'], $directori, $_POST['idchasis'], $_POST['version'], $lastVersion);
            $arrFromDb = array('status' => "1");
            echo json_encode( $arrFromDb ); 
            exit();
        } else {}
        
    } else if($_POST['adafile'] == '1'){ //FILE DIUBAH
        if(isset($_POST['idskrbsales'])){
            
            $idskrbsales = $_POST['idskrbsales'];
            
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
            
            //KHUSU VARIABLE FILE
            $format = explode(".", $_FILES['fileupload']['name']);
            $file_size = $_FILES['fileupload']['size'];
            $allowed_ext = array("jpg", "jpeg", "JPEG", "JPG", "PDF", "pdf");
            $maxsize = 10 * 1024 * 1024; //10 MB
            $name_file = date("dmis")."-".$_FILES['fileupload']['name'];
            //KHUSU VARIABLE FILE
            
            function updateSkrb($name_file, $idskrbsales, $deskripsi, $directori, $idchasis, $version, $lastversion){
                $currenttime = date('d-m-Y H:i:s');
                $id = Yii::app()->user->id;
                $connection = yii::app()->dbOracle;

                if($lastversion == 'X'){ // JIKA SKRB LAST VERSION MAKA SKRB LAIN YG LAST VERSION DI HAPUS DULU X NYA
                    $sqlupdate = "UPDATE KATALOG_SKRB_$directori SET ISLASTVERSION = '' WHERE ID_CHASIS="."'".$idchasis."'";
                    $command=$connection->createCommand($sqlupdate);
                    $command->execute();
                    $finalLastversion = ", ISLASTVERSION = 'X'";
                } else { // JIKA SKRB TIDAK LAST VERSION MAKA LAKUKAN PENGECEKAN APAKAH DI DALAM DI CHASIS ITU TERDAPAT LAST VERSION
                        // JIKA TIDAK TERDAPAT LAST VERSION MAKA OTOMATIS SKRB YG DI INPUT MENJADI LAST VERSION
                    $arr = array();
                    $qlastversion = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_SKRB_$directori WHERE ID_CHASIS = '$idchasis' AND ISLASTVERSION = 'X'")->queryAll();
                    if(count($qlastversion) > 0){
                        foreach ($qlastversion as $rowversion){
                            $data['idskrb'] = $arr[]=$rowversion['ID_SKRB_'.$directori];
                        }
                        if($data['idskrb'] == $idskrbsales){
                            $finalLastversion = ", ISLASTVERSION = 'X'";
                        } else {
                            $finalLastversion = ", ISLASTVERSION = ''";
                        }

                    } else {
                        $finalLastversion = ", ISLASTVERSION = 'X'";
                    }
                }

                $sqlupdate = "UPDATE KATALOG_SKRB_$directori SET FILE_VERSION = '$version', FILE_DESKRIPSI = '$deskripsi'$finalLastversion, UPDATE_AT = to_date('".$currenttime."','dd-mm-yy hh24:mi:ss'), UPDATE_BY = '$id', FILE_NAME = '$name_file' WHERE ID_SKRB_SALES="."'".$idskrbsales."'";
                $command=$connection->createCommand($sqlupdate);
                $command->execute();
            }
            
            if(in_array($format[1], $allowed_ext)){
                if($file_size < $maxsize){
                    //MENCARI NAMA FILE YG AKAN DIHAPUS BERDASARKAN ID SKRB
                    $searchfilename = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_SKRB_$directori WHERE ID_SKRB_$directori = '$idskrbsales'")->queryAll();
                    $arr=array();
                    foreach ($searchfilename as $rowfilename){
                        $data['datafilename'] = $arr[]=$rowfilename['FILE_NAME'];
                    }
                    //MENCARI NAMA FILE YG AKAN DIHAPUS BERDASARKAN ID SKRB
                    
                    //EKSEKUIS UPDATE DATA
                    updateSkrb($name_file, $idskrbsales, $_POST['deskrispi'], $directori, $_POST['idchasis'], $_POST['version'], $lastVersion);
                    
                    //VARIABEL LETAK DIREKTORI FILE
                    $temp = "FILE/SKRB/$directori/";
                    
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