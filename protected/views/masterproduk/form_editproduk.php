<section class="py-2">
    <button class="btn btn-primary py-2 masterproduk">Back</button>
</section>

<?php
$q_produk = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_PRODUK WHERE ISDEL_PRODUK IS NULL AND ID_PRODUK = '$idproduk'")->queryAll();
foreach($q_produk as $rowproduk){
    $data['IDPRODUK'] = $arr[]=$rowproduk["ID_PRODUK"];
    $data['NAMAPRODUK'] = $arr[]=$rowproduk["NAMA_PRODUK"];
}
?>
<section>
    <form id="form-data">
        <input type="hidden" name="idproduk" id="idproduk" value="<?php echo $idproduk; ?>">
        <div class="row py-2">
            <div class="col-md-4"> 
                <label>Nama Produk : </label>
                <input type="text" class="form-control form-control-sm" id="namaproduk" oninput="this.value = this.value.toUpperCase()" value="<?php echo $data['NAMAPRODUK']; ?>">
            </div>
        </div>
    
        <div class="d-flex justify-content-center">
            <input type="button" class="updatemasterproduk" class="btn btn-primary btn-sm" value="Update">
        </div>
    </form>
</section>