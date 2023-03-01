<section class="py-1">
    <a class="btn btn-primary hovdesign" attr-dept="<?php echo $dept; ?>" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $produk; ?>" attr-class = "<?php echo $clas; ?>" attr-model = "<?php echo $model; ?>" attr-chasis = "<?php echo $chasis; ?>" attr-type = "<?php echo $type; ?>" style="color: white;">Back</a>
</section>
<section class="py-2">
        <div class="card-header">
            <h6 class="text-uppercase mb-0">Edit Design</h6>
        </div>
      <div class="card card-body">
            <div class="row py-2">
                <?php
                    $arr = array();
                    $q_design = Yii::app()->dbOracle->createCommand("SELECT
                                                            TO_CHAR(CREATED_AT,'DD/MM/YYYY') CREATE_AT,
                                                            FILE_NAME,
                                                            FILE_VERSION,
                                                            ISLASTVERSION,
                                                            FILE_DESKRIPSI,
                                                            ID_DESIGN,
                                                            ISHIDE
                                                            FROM KATALOG_DESIGN WHERE ID_DESIGN = '$iddesign'")->queryAll();
                    foreach($q_design as $rowdesign){
                    if($arr[]=$rowdesign['ISLASTVERSION'] == 'X'){
                        $ck = 'checked="true"';
                    } else {
                        $ck = '';
                    }
                ?>
                <form id="form-data">
                    <div class="row">
                        <input type="hidden" name="iddesign" id="iddesign" value="<?php echo $iddesign; ?>">
                        <input type="hidden" name="idchasis" id="idchasis" value="<?php echo $idchasis; ?>">
                        <input type="hidden" name="departemen" id="departemen" value="<?php echo $dept; ?>">
                        <input type="hidden" name="adafile" id="adafile" value="AA">
                        <div class="col-md-6">
                            <label>Deskripsi : </label>
                            <input type="text" name="deskripsi" id="deskripsi" class="form-control form-control-sm" value="<?php echo $arr[]=$rowdesign['FILE_DESKRIPSI']; ?>">
                        </div>

                        <div class="col-md-2">
                            <label>Version : </label>
                            <input type="text" name="version" id="version" class="form-control form-control-sm" value="<?php echo $arr[]=$rowdesign['FILE_VERSION']; ?>">
                        </div>
                        
                        <div class="col-md-2">
                            <label>File : </label>
                            <input type="file" name="fileupload" id="fileupload" class="form-control form-control-sm">
                        </div>
                        
                        <div class="col-md-2">
                            <div class="custom-control custom-checkbox">
                                <label>Last Version : </label>
                                <input id="customCheck1" type="checkbox" name="lastVersion" class="custom-control-input lastVersion" <?php echo $ck; ?>>
                                <label for="customCheck1" class="custom-control-label"><span style="font-size: 7pt; color: gray;">Checklist if last</span></label>
                            </div> 
                        </div>
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <input type="button" class="updatedesign" attr-dept="<?php echo $dept; ?>" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $produk; ?>" attr-class = "<?php echo $clas; ?>" attr-model = "<?php echo $model; ?>" attr-chasis = "<?php echo $chasis; ?>" attr-type = "<?php echo $type; ?>" class="btn btn-primary btn-sm" value="Update">
                    </div>
                </form>
                <?php } ?>
            </div>
      </div>
</section>