<section class="py-5">
    <div class="alert alert-primary" role="alert">
        Upload File
    </div>
    <div class="container-fluid px-xl-5">
        <form method="post" enctype="multipart/form-data">
            <div class="col-md-4 w-25 p-3">
                <label>Departemen : </label>
                <select class="form-control form-control-sm" name="departemen">
                    <option value="SALES">Sales</option>
                    <option value="ENGINEER">Engineer</option>
                </select>
            </div>

            <div class="col-md-4 w-25 p-3">
                <label>Kategori : </label>
                <select class="form-control form-control-sm" name="kategori">
                    <option value="" disabled selected hidden>PILIH KATEGORI</option>
                    <?php
                        $query_kategori = Yii::app()->dbOracle->createCommand("SELECT * FROM SKRBFILE_KATEGORI")->queryAll();
                        $arr = array();
                        foreach($query_kategori as $rowkategori){
                    ?>
                    <option value="<?php echo $arr[]=$rowkategori['NAMA_KATEGORI']; ?>"><?php echo $arr[]=$rowkategori['NAMA_KATEGORI']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-4 w-25 p-3">
                <label>File : </label>
                <input type="file" name="files[]" class="form-control form-control-sm" multiple>
            </div>

            <div class="col-md-4 w-25 p-3">
                <input type="submit" class="btn btn-primary btn-sm" value="Upload">
            </div>
        </form>
    </div>
</section>

<script>
$("form").on("submit", function(e){
        e.preventDefault();
        $.ajax({
          url: "index.php?r=uploadfile/proses_upload_file",
          type: "POST",
          data: new FormData(this),
          contentType: false,
          processData: false,
          success: function(data){
            alert("gambar berhasil di upload");
          }
        });
    });
</script>