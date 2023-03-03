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

    private function Auth_eng(){
        if(Yii::app()->user->isEng()){
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
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
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
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
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

    public function actionForm_editproduk() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('form_editproduk', array(
                'idproduk' => $_POST['idproduk']
            ));
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }

    public function actionDetail_produk() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
            $idproduk = $_POST['idproduk'];
            $q_produk = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_PRODUK WHERE ISDEL_PRODUK IS NULL AND ID_PRODUK = '$idproduk'")->queryAll();
            foreach($q_produk as $rowproduk){
                $data['IDPRODUK'] = $arr[]=$rowproduk["ID_PRODUK"];
                $data['NAMAPRODUK'] = $arr[]=$rowproduk["NAMA_PRODUK"];
            }
            echo json_encode($data);
         } else {
             ?>
                 <script type="text/javascript">
                     window.location.href = "index.php?r=site/logout";
                 </script>
             <?php
         }
    }
    
     public function actionProses_editproduk() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('proses_editproduk');
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }
    
    public function actionProses_delproduk() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('proses_delproduk', array(
               'idproduk' => $_POST['idproduk'],
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
