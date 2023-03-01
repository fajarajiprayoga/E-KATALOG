<?php
$ch = curl_init();
if(is_array($_FILES)){
  foreach ($_FILES['files']['name'] as $name => $value) {
    $file_name = explode(".", $_FILES['files']['name'][$name]);
    $allowed_ext = array("jpg", "jpeg", "png", "gif", "PNG", "JPEG", "JPG", "PDF", "pdf");
    if(in_array($file_name[1], $allowed_ext)){
      $name_file = md5(rand()).'||'.$_FILES['files']['name'][$name];
      $type_file = $file_name[1];
      $directori = $_POST['departemen'];
      $ch = curl_init();
      $cfile = new CURLFile($_FILES['files']['tmp_name'][$name], $_FILES['files']['type'][$name], $_FILES['files']['name'][$name]);
      $data = array("myfile"=>$cfile);
      
      var_dump($_FILES['files']['tmp_name'][$name]);
      
      curl_setopt($ch, CURLOPT_URL, "http://10.30.20.115/sapdata/SKRB/uploads.php?dir=$directori");
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      
      $response = curl_exec($ch);
    }
  }
}
?>