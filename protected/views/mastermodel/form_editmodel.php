<section class="py-2">
    <button class="btn btn-primary py-2 mastermodel">Back</button>
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
?>
<section>
    <form id="form-data">
        <input type="hidden" name="idmodel" id="idmodel" value="<?php echo $idmodel; ?>">
        <div class="row py-2">
            <div class="col-md-4"> 
                <label>Nama Produk : </label>
                <select class="form-control form-control-sm js-example-basic-single2" id="idproduk" name="idproduk" style="width: 100%;">
                    <option value="<?php echo $data['IDPRODUK']; ?>"><?php echo $data['NAMAPRODUK']; ?></option>
                    <option value="" disabled>----------------------------------------</option>
                    <?php
                    $arr_produk = array();
                    $id=Yii::app()->user->id;
                    $q_katalog_produk = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_PRODUK WHERE ISDEL_PRODUK IS NULL")->queryAll();
                    foreach ($q_katalog_produk as $row_produk){
                    ?>
                    <option value="<?php echo $arr_produk[]=$row_produk['ID_PRODUK']; ?>"><?php echo $arr_produk[]=$row_produk['NAMA_PRODUK']; ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="col-md-4">
                <label>Nama Class : </label>
                <select class="form-control form-control-sm js-example-basic-single2" id="idclass" name="idclass" style="width: 100%;">
                    <option value="<?php echo $data['IDCLASS']; ?>"><?php echo $data['NAMACLASS']; ?></option>
                    <option value="" disabled>----------------------------------------</option>
                    <?php
                    $arr_class = array();
                    $q_katalog_class = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_CLASS WHERE ISDEL_CLASS IS NULL")->queryAll();
                    foreach ($q_katalog_class as $row_class){
                    ?>
                    <option value="<?php echo $arr_class[]=$row_class['ID_CLASS']; ?>"><?php echo $arr_class[]=$row_class['NAMA_CLASS']; ?></option>
                    <?php } ?>
                </select>
            </div>


            <div class="col-md-4"> 
                <label>Nama Model : </label>
                <input type="text" class="form-control form-control-sm" id="namamodel" oninput="this.value = this.value.toUpperCase()" value="<?php echo $data['NAMAMODEL']; ?>">
            </div>
        </div>
    
        <div class="d-flex justify-content-center">
            <input type="button" class="updatemastermodel" class="btn btn-primary btn-sm" value="Update">
        </div>
    </form>
</section>