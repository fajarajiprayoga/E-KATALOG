<?php
class EWebUser extends CWebUser {

    protected $_model;
    
    function isAdm() {

        $user = $this->loadUser();

        if ($user)
            return $user->level == LevelLookUp::ADM;

        return false;
    }
    
    function isEng() {

        $user = $this->loadUser();

        if ($user)
            return $user->level == LevelLookUp::ENG;

        return false;
    }
    
    function isSales() {

        $user = $this->loadUser();

        if ($user)
            return $user->level == LevelLookUp::SALES;

        return false;
    }
    
    function isAll() {

        $user = $this->loadUser();

        if ($user)
            return $user->level == LevelLookUp::ALL;

        return false;
    }
    
    // Load user model.

    protected function loadUser() {
        if ($this->_model === null) {

            $this->_model = User::model()->findByPk($this->id);
        }

        return $this->_model;
    }
}
