<?php

class DesignController extends Controller {
    
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
           $this->renderPartial('index', array(
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
    
    public function actionForm_design() {
        if($this->Auth_adm() == '1' /*AND $this->cekotp() == '1'*/){
           $this->renderPartial('form_design', array(
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
    
    public function actionProses_upload_design() {
        if($this->Auth_adm() == '1' /*AND $this->cekotp() == '1'*/){
           $this->renderPartial('proses_upload_design');
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }
    
    public function actionForm_edit_design() {
        if($this->Auth_adm() == '1' /*AND $this->cekotp() == '1'*/){
           $this->renderPartial('form_edit_design', array(
                'idchasis' => $_POST['idchasis'],
                'dept' => $_POST['dept'],
                'produk' => $_POST['produk'], 
                'clas' => $_POST['clas'],
                'model' => $_POST['model'],
                'chasis' => $_POST['chasis'],
                'iddesign' => $_POST['iddesign'],
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
    
    public function actionProses_update_design() {
        if($this->Auth_adm() == '1' /*AND $this->cekotp() == '1'*/){
           $this->renderPartial('proses_update_design');
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }
    
    public function actionProses_delete_design() {
        if($this->Auth_adm() == '1' /*AND $this->cekotp() == '1'*/){
           $this->renderPartial('proses_delete_design', array(
                'dept' => $_POST['dept'],
                'iddesign' => $_POST['iddesign'],
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
