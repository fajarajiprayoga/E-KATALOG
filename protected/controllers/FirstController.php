<?php

class FirstController extends Controller {
    private function Auth_engs() {
        if(Yii::app()->user->isEngs()) {
            $auth = '1';
        } else {
            $auth = '0';
        }
        return $auth;
    }
    
    private function Auth_dir() {
        if(Yii::app()->user->isDir()) {
            $auth = '1';
        } else {
            $auth = '0';
        }
        return $auth;
    }
    
    public function actionIndex() {
        if($this->Auth_engs() == '1' OR $this->Auth_dir() == '1' AND $this->cekotp() == '0'){
           $this->renderPartial('index');
        } else {
        ?>
            <script type="text/javascript">
                window.location.href = "index.php?r=site/logout";
            </script>
        <?php
        }
    }
    
    public function actionGetotp() {
        if(isset(Yii::app()->user->id)){
            if($this->Auth_engs() == '1' OR $this->Auth_dir() == '1' AND $this->cekotp() == '0'){
               $this->renderPartial('getotp');
            } else {
                $arrFromDb = array(
                    'status' => '999'
                );
                echo json_encode( $arrFromDb ); exit();
            }
        } else {
            $arrFromDb = array(
                'status' => '999'
            );
            echo json_encode( $arrFromDb ); exit();
        }
    }
    
    public function actionCekotp() {
        if(isset($_POST['otpuser'])){
            if($this->Auth_engs() == '1' OR $this->Auth_dir() == '1' AND $this->cekotp() == '0'){
               $this->renderPartial('cekotp', array(
                   'otpuser' => $_POST['otpuser']
               ));
            } else {
                $arrFromDb = array(
                'status' => '999'
                );
                echo json_encode( $arrFromDb ); exit();
            }    
        } else {
            $arrFromDb = array(
                'status' => '999'
            );
            echo json_encode( $arrFromDb ); exit();
        }
        
    }
}
