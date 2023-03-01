<section class="py-2">
    <div class="row">
        <div>
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseAdd" role="button" aria-expanded="false" aria-controls="collapseExample">
              <i class="fas fa-sort"></i> Add
            </a>
        </div>
    </div>
    
    <div class="collapse py-2" id="collapseAdd">
        <div class="card-header">
            <h6 class="text-uppercase mb-0">Add Type</h6>
        </div>
      <div class="card card-body">
          <center><i class="fas fa-save inserttype" style="font-size: 3em; color: blue; cursor: pointer;"></i></center>
          <i class="fas fa-plus add-more" style="color: blue; cursor: pointer;"></i>
          <div class="after-add-more"></div>
      </div>
    </div>
</section>
<section class="py-1">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h6 class="text-uppercase mb-0">Master Type</h6>
            </div>
            
            <div class="card-body">
                <div style="overflow-x:auto; position: relative;">
                    <table id="myTable" class="display" style="width:100%">
                        <thead>
                          <tr align="left">
                            <th width="20px">No</th>
                            <th>Nama Type</th>
                            <th>Nama Model</th>
                            <th>Nama Class</th>
                            <th>Nama Produk</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                $qtype = "SELECT * FROM KATALOG_TYPE WHERE ISDEL_TYPE IS NULL";
                                $arr = array();
                                $q_type = Yii::app()->dbOracle->createCommand($qtype)->queryAll();
                                foreach($q_type as $rowtype){
                                $idproduk = $arr[]=$rowtype["ID_PRODUK"];
                                $idclass = $arr[]=$rowtype["ID_CLASS"];
                                $idmodel = $arr[]=$rowtype["ID_MODEL"];
                            ?>
                          <tr align="left">
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $arr[]=$rowtype["NAMA_TYPE"]; ?></td>
                            <td>
                                <?php
                                    $q_model = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_MODEL WHERE ID_MODEL = '$idmodel'")->queryAll();
                                    foreach($q_model as $rowmodel){
                                        echo $arr[]=$rowmodel["NAMA_MODEL"];
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    $q_class = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_CLASS WHERE ID_CLASS = '$idclass'")->queryAll();
                                    foreach($q_class as $rowclass){
                                        echo $arr[]=$rowclass["NAMA_CLASS"];
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    $q_produk = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_PRODUK WHERE ID_PRODUK = '$idproduk'")->queryAll();
                                    foreach($q_produk as $rowproduk){
                                        echo $arr[]=$rowproduk["NAMA_PRODUK"];
                                    }
                                ?>
                            </td>
                            <td>
                                <i class="fas fa-trash-alt deletemastertype" attr-idclass="<?php echo $arr[]=$rowtype["ID_TYPE"]; ?>"  style="font-size: 13pt; cursor: pointer;"></i>
                                <i class="fas fa-edit form_edit_type" attr-idproduk="<?php echo $idproduk; ?>" attr-idclass="<?php echo $idclass; ?>" attr-idmodel="<?php echo $idmodel; ?>" attr-idtype="<?php echo $arr[]=$rowtype["ID_TYPE"]; ?>" style="font-size: 13pt; cursor: pointer;"></i>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
</section>

<div class="copy invisible">
    <div class="row py-2 wadah">
        <div class="col-md-2 subwadah">
            <input type="hidden" value="1" name="id[]">
            <label>Nama Produk : </label>
            <select class="form-control form-control-sm js-example-basic-single2" id="addproduk" name="addproduk[]" style="width: 100%;">
                <option value=""></option>
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

        <div class="col-md-3 subwadah">
            <label>Nama Class : </label>
            <select class="form-control form-control-sm js-example-basic-single2" id="addclass" name="addclass[]" style="width: 100%;">
                <option value=""></option>
                <?php
                $arr_class = array();
                $q_katalog_class = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_CLASS WHERE ISDEL_CLASS IS NULL")->queryAll();
                foreach ($q_katalog_class as $row_class){
                ?>
                <option value="<?php echo $arr_class[]=$row_class['ID_CLASS']; ?>"><?php echo $arr_class[]=$row_class['NAMA_CLASS']; ?></option>
                <?php } ?>
            </select>
        </div>
        
        <div class="col-md-3 subwadah">
            <label>Nama Model : </label>
            <select class="form-control form-control-sm js-example-basic-single2" id="addmodel" name="addmodel[]" style="width: 100%;">
                <option value=""></option>
                <?php
                $arr_model = array();
                $q_katalog_model = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_MODEL WHERE ISDEL_MODEL IS NULL")->queryAll();
                foreach ($q_katalog_model as $row_model){
                ?>
                <option value="<?php echo $arr_class[]=$row_model['ID_MODEL']; ?>"><?php echo $arr_class[]=$row_model['NAMA_MODEL']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-md-4">
            <label>Nama Type : </label>
            <input type="text" class="form-control form-control-sm" id="namatype" name="namatype[]" oninput="this.value = this.value.toUpperCase()">
        </div>
        <i class="far fa-trash-alt remove" style="font-size: 1.2em; color: red; cursor: pointer;"></i>
    </div>
</div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/select2-master/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
      $('#myTable').DataTable();
      $(".add-more").click(function(){
          var html = $(".copy").html();
          $(".after-add-more").after(html);
          $('.js-example-basic-single2').select2();
          var list1 = document.getElementsByClassName("subwadah")[0];
          list1.getElementsByClassName("select2-container--default")[1].remove();
          
          var list2 = document.getElementsByClassName("subwadah")[1];
          list2.getElementsByClassName("select2-container--default")[1].remove();
          
          var list3 = document.getElementsByClassName("subwadah")[2];
          list3.getElementsByClassName("select2-container--default")[1].remove();
      });

      // saat tombol remove dklik control group akan dihapus 
      $("body").on("click",".remove",function(){ 
          $(this).parents(".wadah").remove();
      });
    });
</script>
