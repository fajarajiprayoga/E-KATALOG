<?php

class UploadfileController extends Controller {
    private function Auth_engs() {
        if(Yii::app()->user->isEngs()) {
            $auth = '1';
        } else {
            $auth = '0';
        }
        return $auth;
    }
    
    public function actionIndex() {
        if($this->Auth_engs() == '1' /*AND $this->cekotp() == '1'*/){
           $this->renderPartial('index');
        } else {
        ?>
            <script type="text/javascript">
                window.location.href = "index.php?r=site/logout";
            </script>
        <?php
        }
    }
    
    public function actionProses_upload_file() {
        if($this->Auth_engs() == '1' /*AND $this->cekotp() == '1'*/){
           $this->renderPartial('proses_upload_file');
        } else {
        ?>
            <script type="text/javascript">
                window.location.href = "index.php?r=site/logout";
            </script>
        <?php
        }
    }
}
