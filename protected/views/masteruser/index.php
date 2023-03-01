<section class="py-2">
    <div class="row">
        <div>
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseFilter" role="button" aria-expanded="false" aria-controls="collapseExample">
              <i class="fas fa-sort"></i> Filter
            </a>
        </div>
        &nbsp;&nbsp;
        <div>
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseAdd" role="button" aria-expanded="false" aria-controls="collapseExample">
              <i class="fas fa-sort"></i> Add
            </a>
        </div>
    </div>
    
    <div class="collapse py-2" id="collapseFilter">
        <div class="card-header">
            <h6 class="text-uppercase mb-0">Filter</h6>
        </div>
      <div class="card card-body">
          <table style="width: 55%;">
            <tr>
              <th>
                <a style="cursor: pointer; color: blue;"><i class="fas fa-search search_tr_all" style="font-size: 1.5em;"></i></a>
                &nbsp;&nbsp;
                <a style="cursor: pointer; color: blue;"><i class="fas fa-sync transactionall" style="font-size: 1.5em;"></i></a>
              </th>
            </tr>
            <tr>
                <th style="width: 15%;"><input type="checkbox" class="cknik" name="cknik">&nbsp;<label><strong>NIK :</strong></label></th>
                <th style="width: 20%;">
                    <input type="text" id="valuenik" class="form-control form-control-sm" placeholder="Value" disabled="true" oninput="this.value = this.value.toUpperCase()">
                </th>
            </tr>
            <tr>
                <th><input type="checkbox" class="cksort" name="cksort">&nbsp;<label><strong>Sort :</strong></label></th>
                <th>
                    <select name="operation_nik" id="valuesort" class='form-control form-control-sm' disabled="true">
                        <option value="ASC">Ascending</option>
                        <option value="DESC">Descending</option>
                    </select>
                </th>
            </tr>
          </table>
      </div>
    </div>
    
    <div class="collapse py-2" id="collapseAdd">
        <div class="card-header">
            <h6 class="text-uppercase mb-0">Add User</h6>
        </div>
      <div class="card card-body">
          <center><i class="fas fa-save adddepartemen" style="font-size: 3em; color: blue; cursor: pointer;"></i></center>
            <div class="row py-2">
                <div class="col-md-4">
                    <label>NIK : </label>
                    <input type="text" class="form-control form-control-sm" id="addnamadep" oninput="this.value = this.value.toUpperCase()">
                </div>
                
                <div class="col-md-4">
                    <label>Nama Lengkap : </label>
                    <input type="text" class="form-control form-control-sm" id="addnamadep" oninput="this.value = this.value.toUpperCase()">
                </div>
                
                <div class="col-md-4">
                    <label>Office : </label>
                    <select class="form-control" name="office" required>
                        <option value="" disabled selected>PILIH OFFICE</option>
                        <option value="1000">MAJ Magelang Cabang</option>
                        <option value="1010">MAJ Kelapa Gading</option>
                        <option value="1020">MAJ Tanah Abang</option>
                        <option value="1030">MAJ Surabaya</option>
                        <option value="1050">MAJ Magelang HO</option>
                        <option value="1060">MAJ Jati Baru</option>
                    </select>
                </div>
            </div>
          
            <div class="row py-2">
                <div class="col-md-4">
                    <label>Username : </label>
                    <input type="text" class="form-control form-control-sm" id="addnamadep" oninput="this.value = this.value.toUpperCase()">
                </div>
                
                <div class="col-md-4">
                    <label>Password : </label>
                    <input type="text" class="form-control form-control-sm" id="addnamadep" oninput="this.value = this.value.toUpperCase()">
                </div>
                
                <div class="col-md-4">
                    <label>Email : </label>
                    <input type="text" class="form-control form-control-sm" id="addnamadep" oninput="this.value = this.value.toUpperCase()">
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
                <h6 class="text-uppercase mb-0">Master User</h6>
            </div>
            <div class="card-body">
                <div style="overflow-x:auto; position: relative;">
                    <table class="table table-striped table-sm card-text tabel">
                        <thead>
                          <tr align="center">
                            <th>No</th>
                            <th>NIK</th>
                            <th>Username</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                                $colid = '"id"';
                                $username = '"username"';
                                $qusr = "SELECT
                                         MU.NAMA_LENGKAP AS NAMA,
                                         MU.$username AS USERNAME,
                                         MU.NIK AS NIK,
                                         KUS.STATUS AS STATUS
                                         FROM MASTER_USERS MU
                                         INNER JOIN MASTER_ACCESS MA ON MU.$colid = MA.ID_USER 
                                         INNER JOIN KATALOG_USER_SETTING KUS ON KUS.ID_MA = MA.ID_ACCESS
                                         WHERE
                                         MU.ISDEL IS NULL
                                         AND
                                         MA.CODE_ACCESS = 'EKATALOG'";
                                $arr = array();
                                $q_user = Yii::app()->dbOracle->createCommand($qusr)->queryAll();
                                foreach($q_user as $rowuser){
                            ?>
                          <tr align="center">
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $arr[]=$rowuser["NIK"]; ?></td>
                            <td><?php echo $arr[]=$rowuser["USERNAME"]; ?></td>
                            <td><?php echo $arr[]=$rowuser["NAMA"]; ?></td>
                            <td>
                                <?php
                                    if($arr[]=$rowuser["STATUS"] == "10"){
                                        echo 'Admin';
                                    } else if($arr[]=$rowuser["STATUS"] == "20"){
                                        echo 'Engineering';
                                    } else if($arr[]=$rowuser["STATUS"] == "30"){
                                        echo 'Sales';
                                    } else if($arr[]=$rowuser["STATUS"] == "40"){
                                        echo 'All';
                                    } else {}
                                ?>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <a href="#" class="proses_edit_sales"><i class="fas fa-edit" style="font-size: 1.2em;"></i></a>
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
