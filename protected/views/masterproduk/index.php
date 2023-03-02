<section class="py-2">
    <div class="row">
        <div>
            <a class="btn btn-primary" id="buttonku" data-toggle="collapse" href="#collapseAdd" role="button" aria-expanded="false" aria-controls="collapseExample">
              <i class="fas fa-sort"></i> Add
            </a>
        </div>
    </div>
    
    <div class="collapse py-2" id="collapseAdd">
        <div class="card-header">
            <h6 class="text-uppercase mb-0">Add Produk</h6>
        </div>
      <!-- <div class="card card-body">
          <center><i class="fas fa-save addproduk" style="font-size: 3em; color: blue; cursor: pointer;"></i></center>
            <div class="row py-2">
                <div class="col-md-4">
                    <label>Nama Produk : </label>
                    <input type="text" class="form-control form-control-sm" id="namaproduk" oninput="this.value = this.value.toUpperCase()">
                </div>
            </div>
      </div> -->
    </div>
</section>
<section class="py-1">
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="text-uppercase mb-0 mt-2">Master Produk</h6>
                <button class="btn btn-primary btn-sm px-3 rounded-0 btnaddproduk"><i class="fas fa-plus"></i> Tambah</button>
            </div>
            <div class="card-body">
                <div style="overflow-x:auto; position: relative;">
                    <table id="myTable" class="display" style="width:100%">
                        <thead>
                          <tr align="left">
                            <th width="20px">No</th>
                            <th>Nama Produk</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                $qproduk = "SELECT * FROM KATALOG_PRODUK WHERE ISDEL_PRODUK IS NULL";
                                $arr = array();
                                $q_produk = Yii::app()->dbOracle->createCommand($qproduk)->queryAll();
                                foreach($q_produk as $rowuser){
                            ?>
                          <tr align="left">
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $arr[]=$rowuser["NAMA_PRODUK"]; ?></td>
                            <td>
                                <i class="fas fa-trash-alt deletemasterproduk" attr-idproduk="<?php echo $arr[]=$rowuser["ID_PRODUK"]; ?>"  style="font-size: 13pt; cursor: pointer;"></i>
                                <i class="fas fa-edit form_edit_produk" attr-idproduk="<?php echo $arr[]=$rowuser["ID_PRODUK"]; ?>" style="font-size: 13pt; cursor: pointer;"></i>
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

<!-- Modal -->
<div class="modal fade" id="produkModal" tabindex="-1" role="dialog" aria-labelledby="produkModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="produkModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <label>Nama Produk : </label>
          <input type="text" class="form-control form-control-sm" id="namaproduk" oninput="this.value = this.value.toUpperCase()">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="btnsaveproduk" type="submit" class="btn d-none hiden btn-primary addproduk">Simpan</button>
        <button id="btnupdateproduk" type="submit" class="btn d-none btn-primary updatemasterproduk">Simpan</button>
      </div>
    </div>
  </div>
</div>

<script>
  $('#myTable').DataTable();
  $(document).ready(function() {
    $('.btnaddproduk').on('click', function() {
        $('#produkModalLabel').text('Form tambah produk');
        $('#btnsaveproduk').removeClass('d-none');
        $('#produkModal').modal('show');
    });

    $('.addproduk').on('click', function() {
      $('#produkModal').modal('hide');
    });

    $('.form_edit_produk').on('click', function(){
        var idproduk = $(this).attr('attr-idproduk');
        // load_formeditproduk(idproduk);
    });
  })
</script>
