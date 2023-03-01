<?php
$idotp = substr(rand(), -3).date("sHi");
$id=Yii::app()->user->id;
$waktu = date('d-m-Y H:i:s');
$codeotp = substr(rand(), -6);
$col_id = '"id"';
$cekmail = Yii::app()->db->createCommand("SELECT * FROM MASTER_USERS WHERE $col_id = '$id' AND EMAIL IS NULL")->queryAll();

if(count($cekmail) > 0){
    $arrFromDb = array(
        'status' => '0'
    );
} else {
    $arr=array();
    $datauser = [];
    $queryuser = Yii::app()->db->createCommand("SELECT * FROM MASTER_USERS WHERE $col_id = '$id'")->queryAll();
    foreach($queryuser as $rowuser){
        $data['EMAIL'] = $arr[]=$rowuser['EMAIL'];
    }
    
    //KIRIM EMAIL
    require '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
    require '/usr/share/php/libphp-phpmailer/class.smtp.php';

    $tanggal = date("d-m-Y");
    $pukul = date("H:i");
    $mail = new PHPMailer;
    $mail->setFrom('official_admin@mekararmadajaya.com');
    $mail->addAddress($data['EMAIL']);
    $mail->Subject = 'Code OTP Login';
    $mail->isHTML(true);
    $mail->Body = '
    <html>
    <head>
    <title>HTML email</title>
    </head>
    <body>
    Pada tanggal '.$tanggal.' pukul '.$pukul.', account aplikasi fileskrb anda telah meminta code OTP untuk login.<br/>
    Berikut code OTP yang dapat anda gunakan untuk login : <b>'.$codeotp.'</b><br/><br/>
        
    <span style="font-size: 8pt;"><b>nb: Code OTP Hanya Berlaku 5 Menit</b></span>
    
    <br/><br/><br/>
    <p style="font-size: 9pt;">Regards,<br/><br/>

    Admin Webservice<br/>
    PT. Mekar Armada Jaya

    </body>
    </html>';

    //$mail->addStringAttachment(file_get_contents($source), $fpdf[$i]);
    $mail->IsSMTP();
    $mail->SMTPSecure = 'ssl';
    $mail->Host = 'ssl://mail.mekararmadajaya.com';
    $mail->SMTPAuth = true;
    $mail->SMTPAutoTLS = false;
    $mail->Port = 465;
    $mail->Username = 'official_admin@mekararmadajaya.com';
    $mail->Password = 'adm@RM4D4';
    if(!$mail->send()) {
        $arrFromDb = array(
            'status' => '1'
        );
    } else {
        Yii::app()->db->createCommand("DELETE FROM SKRBFILE_TEMPORARY_OTP WHERE ID_USER = '$id'")->execute();
        $command= Yii::app()->db->createCommand("INSERT INTO SKRBFILE_TEMPORARY_OTP (ID_OTP, ID_USER, JAM, CODE_OTP)VALUES(:ID_OTP, :ID_USER, to_date(:JAM, 'dd-mm-yy hh24:mi:ss'), :CODE_OTP)");
        $command->bindValue(':ID_OTP', $idotp);
        $command->bindValue(':ID_USER', $id);
        $command->bindValue(':JAM', $waktu);
        $command->bindValue(':CODE_OTP', $codeotp);
        $command->execute();
        
        $arrFromDb = array(
            'status' => '2'
        );
    }
    
    Yii::app()->db->createCommand("DELETE FROM SKRBFILE_TEMPORARY_OTP WHERE ID_USER = '$id'")->execute();
    $command= Yii::app()->db->createCommand("INSERT INTO SKRBFILE_TEMPORARY_OTP (ID_OTP, ID_USER, JAM, CODE_OTP)VALUES(:ID_OTP, :ID_USER, to_date(:JAM, 'dd-mm-yy hh24:mi:ss'), :CODE_OTP)");
    $command->bindValue(':ID_OTP', $idotp);
    $command->bindValue(':ID_USER', $id);
    $command->bindValue(':JAM', $waktu);
    $command->bindValue(':CODE_OTP', $codeotp);
    $command->execute();
            
    $command1= Yii::app()->db->createCommand("INSERT INTO SKRBFILE_ACTIVITY_USER (ID_ACTIVITY, ID_USER, TIME, ACTIVITY)VALUES(:ID_ACTIVITY, :ID_USER, to_date(:TIME, 'dd-mm-yy hh24:mi:ss'), :ACTIVITY)");
    $command1->bindValue(':ID_ACTIVITY', substr(rand(), -3).date("His"));
    $command1->bindValue(':ID_USER', $id);
    $command1->bindValue(':TIME', $waktu);
    $command1->bindValue(':ACTIVITY', '1');
    $command1->execute();

    $arrFromDb = array(
        'status' => '2'
    );
    
}

echo json_encode( $arrFromDb ); exit();


