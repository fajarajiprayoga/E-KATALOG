<?php

class MasterchasisController extends Controller {
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
           $this->renderPartial('index');
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }
    
    public function actionProses_addchasis() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('proses_addchasis', array(
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
            $command= Yii::app()->dbOracle->createCommand("INSERT INTO KATALOG_CHASIS (ID_CHASIS, NAMA_CHASIS, ID_PRODUK, ID_CLASS, ID_MODEL, ID_TYPE, CREATED_AT, CREATED_BY)VALUES(:ID_CHASIS, :NAMA_CHASIS, :ID_PRODUK, :ID_CLASS, :ID_MODEL, :ID_TYPE, to_date(:CREATED_AT, 'dd-mm-yy hh24:mi:ss'),:CREATED_BY)");
            $command->bindValue(':ID_CHASIS', "");
            $command->bindValue(':NAMA_CHASIS', $_POST['chasis']);
            $command->bindValue(':ID_PRODUK', $_POST['produk']);
            $command->bindValue(':ID_CLASS', $_POST['class']);
            $command->bindValue(':ID_MODEL', $_POST['model']);
            $command->bindValue(':ID_TYPE', $_POST['type']);
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
    
    public function actionProses_delchasis() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('proses_delete_chasis', array(
                'idchasis' => $_POST['idchasis']
            ));
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }

    public function actionDetail_chasis() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
            $idproduk = $_POST['idproduk'];
            $idclass = $_POST['idclass'];
            $idmodel = $_POST['idmodel'];
            $idtype = $_POST['idtype'];
            $idchasis = $_POST['idchasis'];
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
            $q_type = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_TYPE WHERE ID_TYPE = '$idtype'")->queryAll();
            foreach($q_type as $rowtype){
                $data['IDTYPE'] = $arr[]=$rowtype["ID_TYPE"];
                $data['NAMATYPE'] = $arr[]=$rowtype["NAMA_TYPE"];
            }

            $q_chasis = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_CHASIS WHERE ID_CHASIS = '$idchasis'")->queryAll();
            foreach($q_chasis as $rowchasis){
                $data['NAMACHASIS'] = $arr[]=$rowchasis["NAMA_CHASIS"];
                $data['IDCHASIS'] = $arr[]=$rowchasis["ID_CHASIS"];
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
    
    public function actionForm_edit_chasis() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('form_edit_chasis', array(
                'idchasis' => $_POST['idchasis'],
                'idproduk' => $_POST['idproduk'],
                'idclass' => $_POST['idclass'],
                'idtype' => $_POST['idtype'],
                'idproduk' => $_POST['idproduk'],
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
    
    public function actionProses_update_chasis() {
        if($this->Auth_adm() == '1' || $this->Auth_eng() == '1' || $this->Auth_all() == '1'){
           $this->renderPartial('proses_updatechasis');
        } else {
            ?>
                <script type="text/javascript">
                    window.location.href = "index.php?r=site/logout";
                </script>
            <?php
        }
    }
}
