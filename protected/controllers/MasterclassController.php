<?php

class MasterclassController extends Controller {
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
    
    public function actionProses_addclass() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('proses_addclass', array(
                'namaclass' => $_POST['namaclass'],
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

    public function actionForm_editclass() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('form_editclass', array(
                'idproduk' => $_POST['idproduk'],
                'idclass' => $_POST['idclass'],
            ));
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }

    public function actionDetail_class() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
            $idproduk = $_POST['idproduk'];
            $idclass = $_POST['idclass'];
            $q_produk = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_PRODUK WHERE ID_PRODUK = '$idproduk'")->queryAll();
            foreach($q_produk as $rowproduk){
                $data['IDPRODUK'] = $arr[]=$rowproduk["ID_PRODUK"];
                $data['NAMAPRODUK'] = $arr[]=$rowproduk["NAMA_PRODUK"];
            }
            $q_class = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_CLASS WHERE ID_CLASS = '$idclass'")->queryAll();
            foreach($q_class as $rowclass){
                $data['IDCLASS'] = $arr[]=$rowclass["ID_CLASS"];
                $data['NAMACLASS'] = $arr[]=$rowclass["NAMA_CLASS"];
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
    
    public function actionProses_editclass() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('proses_editclass');
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }

    public function actionProses_deleteclass() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('proses_deleteclass', array(
                'idclass' => $_POST['idclass']
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
