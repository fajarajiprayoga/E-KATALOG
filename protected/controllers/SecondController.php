<?php

class SecondController extends Controller {
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
        if($this->Auth_engs() == '1' OR $this->Auth_dir() == '1' AND $this->cekotp() == '1'){
           $this->renderPartial('index', array(
               'dir' => $_POST['dir']
           ));
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }
}
