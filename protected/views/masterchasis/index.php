<section class="py-2">
    <div class="row">
        <div>
        <?php if(!Yii::app()->user->isSales()){ ?>
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseAdd" role="button" aria-expanded="false" aria-controls="collapseExample">
              <i class="fas fa-sort"></i> Add
            </a>
        <?php } ?>
        </div>
    </div>
    
    <div class="collapse py-2" id="collapseAdd">
        <div class="card-header">
            <h6 class="text-uppercase mb-0">Add Chasis</h6>
        </div>
      <div class="card card-body">
          <center><i class="fas fa-save insertchasis" style="font-size: 3em; color: blue; cursor: pointer;"></i></center>
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
                <h6 class="text-uppercase mb-0">Master Chasis</h6>
            </div>
            
            <div class="card-body">
                <div style="overflow-x:auto; position: relative;">
                    <table id="myTable" class="display" style="width:100%">
                        <thead>
                          <tr align="left">
                            <th width="20px">No</th>
                            <?php if(!Yii::app()->user->isSales()){ ?>
                            <th>Action</th>
                            <?php } ?>
                            <th>Nama Chasis</th>
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
                                $qchasis = "SELECT * FROM KATALOG_CHASIS WHERE ISDEL_CHASIS IS NULL";
                                $arr = array();
                                $q_chasis = Yii::app()->dbOracle->createCommand($qchasis)->queryAll();
                                foreach($q_chasis as $rowchasis){
                                $idproduk = $arr[]=$rowchasis["ID_PRODUK"];
                                $idclass = $arr[]=$rowchasis["ID_CLASS"];
                                $idmodel = $arr[]=$rowchasis["ID_MODEL"];
                                $idtype = $arr[]=$rowchasis["ID_TYPE"];
                                $idchasis = $arr[]=$rowchasis["ID_CHASIS"];
                                $data =[];
                            ?>
                          <tr align="left">
                            <td><?php echo $no++; ?></td>
                            <?php if(!Yii::app()->user->isSales()){ ?>
                            <td>
                                <i class="fas fa-trash-alt deletemasterchasis" attr-idchasis="<?php echo $idchasis; ?>"  style="font-size: 13pt; cursor: pointer;"></i>
                                <i class="fas fa-edit form_edit_chasis" attr-idchasis="<?php echo $idchasis; ?>" attr-idclass="<?php echo $idclass; ?>" attr-idproduk="<?php echo $idproduk; ?>" attr-idtype="<?php echo $idtype; ?>" attr-idmodel="<?php echo $idmodel; ?>" style="font-size: 13pt; cursor: pointer;"></i>
                            </td>
                            <?php } ?>
                            <td><?php echo $arr[]=$rowchasis["NAMA_CHASIS"]; ?></td>
                            <td>
                                <?php
                                    $q_type = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_TYPE WHERE ID_TYPE = '$idtype'")->queryAll();
                                    foreach($q_type as $rowtype){
                                        echo $arr[]=$rowtype["NAMA_TYPE"];
                                        $data['type'] = $arr[]=$rowtype["NAMA_TYPE"];
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    $q_model = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_MODEL WHERE ID_MODEL = '$idmodel'")->queryAll();
                                    foreach($q_model as $rowmodel){
                                        echo $arr[]=$rowmodel["NAMA_MODEL"];
                                        $data['model'] = $arr[]=$rowmodel["NAMA_MODEL"];
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    $q_class = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_CLASS WHERE ID_CLASS = '$idclass'")->queryAll();
                                    foreach($q_class as $rowclass){
                                        echo $arr[]=$rowclass["NAMA_CLASS"];
                                        $data['class'] = $arr[]=$rowclass["NAMA_CLASS"];
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    $q_produk = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_PRODUK WHERE ID_PRODUK = '$idproduk'")->queryAll();
                                    foreach($q_produk as $rowproduk){
                                        echo $arr[]=$rowproduk["NAMA_PRODUK"];
                                        $data['produk'] = $arr[]=$rowproduk["NAMA_PRODUK"];
                                    }
                                ?>
                            </td>
                            <td>
                                <!-- Default dropright button -->
                                <div class="btn-group dropright">
                                  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item skrb" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $data['produk']; ?>" attr-class = "<?php echo $data['class']; ?>" attr-model = "<?php echo $data['model']; ?>" attr-chasis = "<?php echo $arr[]=$rowchasis["NAMA_CHASIS"]; ?>" attr-type = "<?php echo $data['type']; ?>" style="cursor: pointer;" >SKRB</a>

                                    <?php if(!Yii::app()->user->isSales()){ ?>
                                    <a class="dropdown-item drawing" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $data['produk']; ?>" attr-class = "<?php echo $data['class']; ?>" attr-model = "<?php echo $data['model']; ?>" attr-chasis = "<?php echo $arr[]=$rowchasis["NAMA_CHASIS"]; ?>" attr-type = "<?php echo $data['type']; ?>" style="cursor: pointer;" >DRAWING</a>
                                    <?php } ?>

                                    <a class="dropdown-item design" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $data['produk']; ?>" attr-class = "<?php echo $data['class']; ?>" attr-model = "<?php echo $data['model']; ?>" attr-chasis = "<?php echo $arr[]=$rowchasis["NAMA_CHASIS"]; ?>" attr-type = "<?php echo $data['type']; ?>" style="cursor: pointer;" >DESIGN</a>
                                  </div>
                                </div>
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
    <div class="wadah">
        <div class="row py-2">
            <div class="col-md-4 subwadah">
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

            <div class="col-md-4 subwadah">
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

            <div class="col-md-4 subwadah">
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
        </div>
        
        <div class="row py-2">
            <div class="col-md-6 subwadah">
                <label>Nama Type : </label>
                <select class="form-control form-control-sm js-example-basic-single2" id="addtype" name="addtype[]" style="width: 100%;">
                    <option value=""></option>
                    <?php
                    $arr_type = array();
                    $q_katalog_type = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_TYPE WHERE ISDEL_TYPE IS NULL")->queryAll();
                    foreach ($q_katalog_type as $row_type){
                    ?>
                    <option value="<?php echo $arr_type[]=$row_type['ID_TYPE']; ?>"><?php echo $arr_type[]=$row_type['NAMA_TYPE']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="col-md-6">
                <label>Nama Chasis : </label>
                <input type="text" class="form-control form-control-sm" id="namachasis" name="namachasis[]" oninput="this.value = this.value.toUpperCase()">
            </div>
            <i class="far fa-trash-alt remove" style="font-size: 1.2em; color: red; cursor: pointer;"></i>
        </div>
        <hr style="border: 1px solid #1E90FF;">
    </div>
</div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/select2-master/dist/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        
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
          
          var list4 = document.getElementsByClassName("subwadah")[3];
          list4.getElementsByClassName("select2-container--default")[1].remove();
      });

      // saat tombol remove dklik control group akan dihapus 
      $("body").on("click",".remove",function(){ 
          $(this).parents(".wadah").remove();
      });
      
      $('#myTable').DataTable();
    });
</script>
