<?php

class ActivityController extends Controller {
    
    private function Auth_dir() {
        if(Yii::app()->user->isDir()) {
            $auth = '1';
        } else {
            $auth = '0';
        }
        return $auth;
    }
    
    public function actionIndex() {
        $this->renderPartial('index');
        if($this->Auth_dir() == '1' AND $this->cekotp() == '1'){
           
        } else {
        ?>
            <script type="text/javascript">
                window.location.href = "index.php?r=site/logout";
            </script>
        <?php
        }
    }
    
    public function actionWhopdf() {
        if($this->Auth_dir() == '1' AND $this->cekotp() == '1'){
           $this->renderPartial('whopdf');
        } else {
        ?>
            <script type="text/javascript">
                window.location.href = "index.php?r=site/logout";
            </script>
        <?php
        }
    }
    
    public function actionWhologgin() {
        if($this->Auth_dir() == '1' AND $this->cekotp() == '1'){
           $this->renderPartial('whologgin');
        } else {
        ?>
            <script type="text/javascript">
                window.location.href = "index.php?r=site/logout";
            </script>
        <?php
        }
    }
    
    public function actionWhogetotp() {
        if($this->Auth_dir() == '1' AND $this->cekotp() == '1'){
           $this->renderPartial('whogetotp');
        } else {
        ?>
            <script type="text/javascript">
                window.location.href = "index.php?r=site/logout";
            </script>
        <?php
        }
    }
}
