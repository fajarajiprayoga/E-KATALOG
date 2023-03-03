<?php

class MastermodelController extends Controller {
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
    
    public function actionProses_addmodel() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('proses_addmodel', array(
                'data' => $_POST['tumpuk']
            ));
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }

    public function actionStore(){
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
            $currenttime = date('d-m-Y H:i:s');
            $id = Yii::app()->user->id;
            $command= Yii::app()->dbOracle->createCommand("INSERT INTO KATALOG_MODEL (ID_MODEL,NAMA_MODEL,ID_PRODUK, ID_CLASS, CREATED_AT, CREATED_BY)VALUES(:ID_MODEL, :NAMA_MODEL, :ID_PRODUK, :ID_CLASS, to_date(:CREATED_AT, 'dd-mm-yy hh24:mi:ss'),:CREATED_BY)");
            $command->bindValue(':ID_MODEL', "");
            $command->bindValue(':NAMA_MODEL', $_POST['model']);
            $command->bindValue(':ID_PRODUK', $_POST['produk']);
            $command->bindValue(':ID_CLASS', $_POST['class']);
            $command->bindValue(':CREATED_AT', $currenttime);
            $command->bindValue(':CREATED_BY', $id);
            $command->execute();
        }else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }

    public function actionForm_editmodel() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('form_editmodel', array(
                'idproduk' => $_POST['idproduk'],
                'idclass' => $_POST['idclass'],
                'idmodel' => $_POST['idmodel'],
            ));
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }

    public function actionDetail_model() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
            $idproduk = $_POST['idproduk'];
            $idclass = $_POST['idclass'];
            $idmodel = $_POST['idmodel'];
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

            $q_model = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_MODEL WHERE ID_MODEL = '$idmodel'")->queryAll();
            foreach($q_model as $rowmodel){
                $data['IDMODEL'] = $arr[]=$rowmodel["ID_MODEL"];
                $data['NAMAMODEL'] = $arr[]=$rowmodel["NAMA_MODEL"];
            }
            echo json_encode($data);
        }else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }
    
     public function actionProses_editmodel() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('proses_editmodel');
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }

    public function actionProses_deletemodel() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('proses_deletemodel', array(
                'idmodel' => $_POST['idmodel']
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
