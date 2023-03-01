<?php

class DrawingController extends Controller {
    
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
    
    public function actionForm_drawing() {
        if($this->Auth_adm() == '1' /*AND $this->cekotp() == '1'*/){
           $this->renderPartial('form_drawing', array(
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
    
    public function actionProses_upload_drawing() {
        if($this->Auth_adm() == '1' /*AND $this->cekotp() == '1'*/){
           $this->renderPartial('proses_upload_drawing');
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }
    
    public function actionForm_edit_drawing() {
        if($this->Auth_adm() == '1' /*AND $this->cekotp() == '1'*/){
           $this->renderPartial('form_edit_drawing', array(
                'idchasis' => $_POST['idchasis'],
                'dept' => $_POST['dept'],
                'produk' => $_POST['produk'], 
                'clas' => $_POST['clas'],
                'model' => $_POST['model'],
                'chasis' => $_POST['chasis'],
                'iddrawingeng' => $_POST['iddrawingeng'],
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
    
    public function actionProses_update_drawing() {
        if($this->Auth_adm() == '1' /*AND $this->cekotp() == '1'*/){
           $this->renderPartial('proses_update_drawing');
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }
    
    public function actionProses_delete_drawing() {
        if($this->Auth_adm() == '1' /*AND $this->cekotp() == '1'*/){
           $this->renderPartial('proses_delete_drawing', array(
                'dept' => $_POST['dept'],
                'iddrawingeng' => $_POST['iddrawingeng'],
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
