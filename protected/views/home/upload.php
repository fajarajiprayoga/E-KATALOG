<?php 
if($_POST['upload']){
        $ekstensi_diperbolehkan	= array('pdf','PDF');
        $nama = $_FILES['file']['name'];
        $x = explode('.', $nama);
        $ekstensi = strtolower(end($x));
        $ukuran	= $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];	

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
                if($ukuran < 1044070){
                        $ch = curl_init();
                        
                        $cfile = new CURLFile($file_tmp, $_FILES['file']['type'], $nama);
                        $data = array("myfile"=>$cfile);
                        
                        curl_setopt($ch, CURLOPT_URL, "http://10.30.20.115/sapdata/SKRB/uploads.php");
                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                        
                        $response = curl_exec($ch);
                        
                        if($response == true) {
                            echo 'File Posted';
                        } else {
                            echo 'Error';
                        }
                        
                }else{
                        echo 'UKURAN FILE TERLALU BESAR';
                }
        }else{
                echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }
}
?>