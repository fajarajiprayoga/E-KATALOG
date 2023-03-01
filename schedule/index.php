<?php
$page = $_SERVER['PHP_SELF'];
$sec = "300";
$dateupdate = date("d/m/Y");
$timeupdate = date("H:i:s");
?><meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'"><?php
/*
$conn = oci_connect('C##MKTAPPS', 'madajaya', '192.168.9.92/XE');
$delivDate = date('d-m-Y h:i:s');    
$vbeln = 'BT30191-20';
$sql = "UPDATE BPM_LIST SET TADM = to_date('".$delivDate."','dd-mm-yy hh24:mi:ss') WHERE VBELN="."'".$vbeln."'";
$sqlparse =oci_parse($conn,$sql);
$result=oci_execute($sqlparse) or die(oci_error());

$delivDate = date('d-m-Y');    
$vbeln = 'BT30191-20';
$sql = "UPDATE BPM_LIST SET DADM = to_date('".$delivDate."','dd-mm-yy') WHERE VBELN="."'".$vbeln."'";
$sqlparse =oci_parse($conn,$sql);
$result=oci_execute($sqlparse) or die(oci_error());
 */
$conn = oci_connect('C##MKTAPPS', 'madajaya', '192.168.9.92/XE');
require 'kriptograph.php';       
if ($conn) {
    $query = 'SELECT * FROM BPM_LIST BL INNER JOIN MASTER_USERS MU ON BL.VKBUR = MU."id_office" INNER JOIN BPM_USER_SETTING BUS ON MU."id" = BUS.ID_USER WHERE BL.EADM is null AND BUS.TINGKAT ='."'1'";
    $parsesql = oci_parse($conn, $query);
    oci_execute($parsesql);
    $data=[];
    while($rows=oci_fetch_object($parsesql)){
        $data['vbeln'] = $rows->VBELN;
        $data['email'] = $rows->EMAIL;
        $data['fpdf'] = str_replace(" ","",$rows->FPDF);
    }
} else {
    echo 'CONNECT FAILED';
}

if(oci_num_rows($parsesql) > 0){
    require '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
    require '/usr/share/php/libphp-phpmailer/class.smtp.php';
    $source = 'http://10.30.20.115/sapdata/BPM/'.$data['fpdf'];
    $mail = new PHPMailer;
    $mail->setFrom('official_admin@mekararmadajaya.com');
    $mail->addAddress($data['email']);
    $mail->Subject = 'BPM '.$data['vbeln'];
    $mail->isHTML(true);
    $mail->Body = 'Approval BPM Nomor : '.$data['vbeln'].'. Silahkann <a style="cursor: pointer" href="http://36.91.11.21/~wipapps/BPMAPP/index.php?r=sendemail/approvemobile&auth='.base64_encrypt($data['vbeln'], koy()).'&m_auth='.base64_encrypt('1', koy()).'">klik disini</a> untuk melakukan approve';
    $mail->addStringAttachment(file_get_contents($source), $data['fpdf']);
    $mail->IsSMTP();
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'ssl://mail.mekararmadajaya.com';
    $mail->SMTPAuth = true;
    $mail->SMTPAutoTLS = false;
    $mail->Port = 465;
    $mail->Username = 'official_admin@mekararmadajaya.com';
    $mail->Password = 'adm@RM4D4';
    if(!$mail->send()) {
      echo 'Email is not sent.';
      echo 'Email error: ' . $mail->ErrorInfo;
    } else {
        $sql = "UPDATE BPM_LIST SET EADM = 'X' WHERE VBELN="."'".$data['vbeln']."'";
        $sqlparse =oci_parse($conn,$sql);
        $result=oci_execute($sqlparse) or die(oci_error());
        echo "Update (Ada Data) : "."&nbsp;".$dateupdate.";&nbsp;&nbsp;".$timeupdate;
    }
}else{
echo "Update (Tida Ada Data) : "."&nbsp;".$dateupdate.";&nbsp;&nbsp;".$timeupdate;
}
