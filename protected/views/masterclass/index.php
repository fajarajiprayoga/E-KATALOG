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
            <h6 class="text-uppercase mb-0">Add Class</h6>
        </div>
      <div class="card card-body">
          <center><i class="fas fa-save addclass" style="font-size: 3em; color: blue; cursor: pointer;"></i></center>
            <div class="row py-2">
                <div class="col-md-4">
                    <label>Nama Class : </label>
                    <input type="text" class="form-control form-control-sm" id="namaclass" oninput="this.value = this.value.toUpperCase()">
                </div>
                
                <div class="col-md-4">
                    <label>Nama Produk : </label>
                    <select class="form-control form-control-sm" id="idproduk">
                        <option value="" disabled selected hidden>PILIH PRODUK</option>
                        <?php
                            $query_produk = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_PRODUK WHERE ISDEL_PRODUK IS NULL")->queryAll();
                            $arr = array();
                            foreach($query_produk as $rowproduk){
                        ?>
                        <option value="<?php echo $arr[]=$rowproduk['ID_PRODUK']; ?>"><?php echo $arr[]=$rowproduk['NAMA_PRODUK']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
      </div>
    </div>
</section>
<section class="py-1">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h6 class="text-uppercase mb-0">Master Class</h6>
            </div>
            <div class="card-body">
                <div style="overflow-x:auto; position: relative;">
                    <table id="myTable" class="display" style="width:100%">
                        <thead>
                          <tr align="left">
                            <th width="20px">No</th>
                            <th>Nama Class</th>
                            <th>Nama Porduk</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                $qclass = "SELECT * FROM KATALOG_CLASS WHERE ISDEL_CLASS IS NULL";
                                $arr = array();
                                $q_class = Yii::app()->dbOracle->createCommand($qclass)->queryAll();
                                foreach($q_class as $rowclass){
                                $idproduk = $arr[]=$rowclass["ID_PRODUK"];
                            ?>
                          <tr align="left">
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $arr[]=$rowclass["NAMA_CLASS"]; ?></td>
                            <td>
                            <?php
                                $q_produk = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_PRODUK WHERE ID_PRODUK = '$idproduk'")->queryAll();
                                foreach($q_produk as $rowproduk){
                                    echo $arr[]=$rowproduk['NAMA_PRODUK'];
                                }
                            ?>
                            </td>
                            <td>
                                <i class="fas fa-trash-alt deletemasterclass" attr-idclass="<?php echo $arr[]=$rowclass["ID_CLASS"]; ?>"  style="font-size: 13pt; cursor: pointer;"></i>
                                <i class="fas fa-edit form_edit_class" attr-idclass="<?php echo $arr[]=$rowclass["ID_CLASS"]; ?>" attr-idproduk="<?php echo $idproduk; ?>" style="font-size: 13pt; cursor: pointer;"></i>
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
<script>
$('#myTable').DataTable();
</script>
