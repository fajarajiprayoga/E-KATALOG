<?php

class MasterprodukController extends Controller {
    private function Auth_adm() {
        if(Yii::app()->user->isAdm()) {
            $auth = '1';
        } else {
            $auth = '0';
        }
        return $auth;
    }
    
    public function actionIndex() {
        if($this->Auth_adm() == '1' /*AND $this->cekotp() == '1'*/){
           $this->renderPartial('index');
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }
    
    public function actionProses_addproduk() {
        if($this->Auth_adm() == '1' /*AND $this->cekotp() == '1'*/){
           $this->renderPartial('proses_addproduk', array(
                'namaproduk' => $_POST['namaproduk']
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
