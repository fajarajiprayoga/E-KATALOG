<section class="py-2">
    <button class="btn btn-primary py-2 masterclass">Back</button>
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
?>
<section>
    <form id="form-data">
        <input type="hidden" name="idclass" id="idclass" value="<?php echo $idclass; ?>">
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
                <input type="text" class="form-control form-control-sm" id="namaclass" oninput="this.value = this.value.toUpperCase()" value="<?php echo $data['NAMACLASS']; ?>">
            </div>
        </div>
    
        <div class="d-flex justify-content-center">
            <input type="button" class="updatemasterclass" class="btn btn-primary btn-sm" value="Update">
        </div>
    </form>
</section>