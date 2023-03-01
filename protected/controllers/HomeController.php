<?php

class HomeController extends Controller {
    private function Auth_adm() {
        if(Yii::app()->user->isAdm()) {
            $auth = '1';
        } else {
            $auth = '0';
        }
        return $auth;
    }
    
    private function Auth_engs() {
        if(Yii::app()->user->isEng()) {
            $auth = '1';
        } else {
            $auth = '0';
        }
        return $auth;
    }
    
    private function Auth_dir() {
        if(Yii::app()->user->isSales()) {
            $auth = '1';
        } else {
            $auth = '0';
        }
        return $auth;
    }
    
    private function Auth_sales() {
        if(Yii::app()->user->isAll()) {
            $auth = '1';
        } else {
            $auth = '0';
        }
        return $auth;
    }
    
    public function actionIndex() {
        if($this->Auth_engs() == '1' OR $this->Auth_dir() == '1' OR $this->Auth_sales() == '1' OR $this->Auth_adm() == '1' /*AND $this->cekotp() == '1'*/){
           $this->renderPartial('index');
        } else {
            //var_dump(Yii::app()->user);
        }
    }
    
    public function actionUpload() {
        $this->renderPartial('upload');
    }
}
