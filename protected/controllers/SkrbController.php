<?php

class SkrbController extends Controller {
    private function Auth_adm() {
        if(Yii::app()->user->isAdm()) {
            $auth = '1';
        } else {
            $auth = '0';
        }
        return $auth;
    }

    private function Auth_eng(){
        if(Yii::app()->user->isEng()){
            $auth = '1';
        } else {
            $auth = '0';
        }
        return $auth;
    }

    private function Auth_sales(){
        if(Yii::app()->user->isSales()){
            $auth = '1';
        } else {
            $auth = '0';
        }
        return $auth;
    }

    private function Auth_all(){
        if(Yii::app()->user->isAll()){
            $auth = '1';
        } else {
            $auth = '0';
        }
        return $auth;
    }
    
    public function actionIndex() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_sales() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('index2', array(
               'idchasis' => $_POST['idchasis'], 
               'produk' => $_POST['produk'], 
               'clas' => $_POST['clas'],
               'model' => $_POST['model'],
               'chasis' => $_POST['chasis'],
               'type' => $_POST['type'],
            ));
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }
    
    public function actionForm_skrb() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_sales() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('form_skrb', array(
                'idchasis' => $_POST['idchasis'],
                'dept' => $_POST['dept'],
                'produk' => $_POST['produk'], 
                'clas' => $_POST['clas'],
                'model' => $_POST['model'],
                'chasis' => $_POST['chasis'],
                'type' => $_POST['type'],
            ));
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }
    
    public function actionProses_upload_skrb() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('proses_upload_skrb');
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }
    
    public function actionForm_edit_skrb() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('form_edit_skrb', array(
                'idchasis' => $_POST['idchasis'],
                'dept' => $_POST['dept'],
                'produk' => $_POST['produk'], 
                'clas' => $_POST['clas'],
                'model' => $_POST['model'],
                'chasis' => $_POST['chasis'],
                'idskrbsales' => $_POST['idskrbsales'],
                'type' => $_POST['type'],
            ));
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }
    
    public function actionProses_update_skrb() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('proses_update_skrb');
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }
    
    public function actionProses_delete_skrb() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('proses_delete_skrb', array(
                'dept' => $_POST['dept'],
                'idskrb' => $_POST['idskrb'],
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
