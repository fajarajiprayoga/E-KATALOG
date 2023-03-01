<section class="py-2">
    <button class="btn btn-primary py-2 masterchasis">Back</button>
</section>

<?php
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
}
?>
<section>
    <form id="form-data">
        <input type="hidden" name="idchasis" id="idchasis" value="<?php echo $idchasis; ?>">
        <div class="row py-2">
            <div class="col-md-4"> 
                <label>Nama Produk : </label>
                <select class="form-control form-control-sm js-example-basic-single2" id="idproduk" name="idproduk" style="width: 100%;">
                    <option value="<?php echo $data['IDPRODUK']; ?>"><?php echo $data['NAMAPRODUK']; ?></option>
                    <option value="" disabled>----------------------------------------</option>
                    <?php
                    $arr_produk = array();
                    $id=Yii::app()->user->id;
                    $q_katalog_produk = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_PRODUK")->queryAll();
                    foreach ($q_katalog_produk as $row_produk){
                    ?>
                    <option value="<?php echo $arr_produk[]=$row_produk['ID_PRODUK']; ?>"><?php echo $arr_produk[]=$row_produk['NAMA_PRODUK']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-4 subwadah">
                <label>Nama Class : </label>
                <select class="form-control form-control-sm js-example-basic-single2" id="idclass" name="idclass" style="width: 100%;">
                    <option value="<?php echo $data['IDCLASS']; ?>"><?php echo $data['NAMACLASS']; ?></option>
                    <option value="" disabled>----------------------------------------</option>
                    <?php
                    $arr_class = array();
                    $q_katalog_class = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_CLASS")->queryAll();
                    foreach ($q_katalog_class as $row_class){
                    ?>
                    <option value="<?php echo $arr_class[]=$row_class['ID_CLASS']; ?>"><?php echo $arr_class[]=$row_class['NAMA_CLASS']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-4 subwadah">
                <label>Nama Model : </label>
                <select class="form-control form-control-sm js-example-basic-single2" id="idmodel" name="idmodel" style="width: 100%;">
                    <option value="<?php echo $data['IDMODEL']; ?>"><?php echo $data['NAMAMODEL']; ?></option>
                    <option value="" disabled>----------------------------------------</option>
                    <?php
                    $arr_model = array();
                    $q_katalog_model = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_MODEL")->queryAll();
                    foreach ($q_katalog_model as $row_model){
                    ?>
                    <option value="<?php echo $arr_class[]=$row_model['ID_MODEL']; ?>"><?php echo $arr_class[]=$row_model['NAMA_MODEL']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        
        <div class="row py-2">
            <div class="col-md-6 subwadah">
                <label>Nama Type : </label>
                <select class="form-control form-control-sm js-example-basic-single2" id="idtype" name="idtype" style="width: 100%;">
                    <option value="<?php echo $data['IDTYPE']; ?>"><?php echo $data['NAMATYPE']; ?>"</option>
                    <option value="" disabled>----------------------------------------</option>
                    <?php
                    $arr_type = array();
                    $q_katalog_type = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_TYPE")->queryAll();
                    foreach ($q_katalog_type as $row_type){
                    ?>
                    <option value="<?php echo $arr_type[]=$row_type['ID_TYPE']; ?>"><?php echo $arr_type[]=$row_type['NAMA_TYPE']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-6">
                <label>Nama Chasis : </label>
                <input type="text" class="form-control form-control-sm" id="namachasis" name="namachasis" oninput="this.value = this.value.toUpperCase()" value="<?php echo $data['NAMACHASIS']; ?>">
            </div>
        </div>
    
    
        <div class="d-flex justify-content-center">
            <input type="button" class="updatemasterchasis" class="btn btn-primary btn-sm" value="Update">
        </div>
    </form>
</section>