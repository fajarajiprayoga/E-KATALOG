<?php
$id=Yii::app()->user->id;
$waktu = date('d-m-Y H:i:s');
$otp = Yii::app()->db->createCommand("SELECT TO_CHAR(JAM,'YYYY-MM-DD HH24:MI:SS') JAM FROM SKRBFILE_TEMPORARY_OTP WHERE CODE_OTP = '$otpuser' AND ID_USER = '$id'")->queryAll();

    if(count($otp) > 0){
        $datawaktu = [];
        $arr = array();
        foreach($otp as $rowwaktu){
            $datawaktu['JAM'] = $arr[] = $rowwaktu['JAM'];
        }
        $waktuawal = strtotime(date("Y-m-d H:i:s"));
        $waktuakhir = strtotime($datawaktu['JAM']);
        $diff = $waktuawal - $waktuakhir; //DETIK
        
        if($diff > 350){
            $arrFromDb = array(
                'status' => '1'
            ); 
        } else {
            $connection = yii::app()->db;
            $sqlupdate = "UPDATE SKRBFILE_TEMPORARY_OTP SET ACTIVE = 'X' WHERE CODE_OTP="."'".$otpuser."'";
            $command=$connection->createCommand($sqlupdate);
            $command->execute();
            
            $command1= Yii::app()->db->createCommand("INSERT INTO SKRBFILE_ACTIVITY_USER (ID_ACTIVITY, ID_USER, TIME, ACTIVITY)VALUES(:ID_ACTIVITY, :ID_USER, to_date(:TIME, 'dd-mm-yy hh24:mi:ss'), :ACTIVITY)");
            $command1->bindValue(':ID_ACTIVITY', substr(rand(), -3).date("His"));
            $command1->bindValue(':ID_USER', $id);
            $command1->bindValue(':TIME', $waktu);
            $command1->bindValue(':ACTIVITY', '2');
            
            $command1->execute();
            $arrFromDb = array(
                'status' => '2'
            );    
        }
         
    } else {
        $arrFromDb = array(
        'status' => '0'
        );
    }
echo json_encode( $arrFromDb ); exit();
