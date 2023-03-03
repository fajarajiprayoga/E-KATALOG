<style>
    .skrbmenu {
        transition: 0.2s;
        cursor: pointer;
    }
    .skrbmenu:hover {
        color: blue;
        border-bottom: 5px solid blue;
        font-weight: bold;
    }
    .clicked {
        color: blue;
        border-bottom: 5px solid blue;
        font-weight: bold;
    }
    .skrbdatatable {
        transition: 0.2;
    }
</style>
<section class="py-1">
<div class="col-lg-12 py-2">
    <div class="row">
        <div class="col-md-6">
        <div class="card">
            <div class="card-body">
            <h6="m-0 th6md text-uppercase">Detail Chasis | SKRB</span>
            <hr>
                <table>
                    <tr>
                        <td>Produk</td>
                        <td class="pl-5">:</td>
                        <td class="pl-2"><?php echo $produk; ?></td>
                    </tr>
                    <tr>
                        <td>Class</td>
                        <td class="pl-5">:</td>
                        <td class="pl-2"><?php echo $clas; ?></td>
                    </tr>
                    <tr>
                        <td>Model</td>
                        <td class="pl-5">:</td>
                        <td class="pl-2"><?php echo $model; ?></td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td class="pl-5">:</td>
                        <td class="pl-2"><?php echo $type; ?></td>
                    </tr>
                    <tr>
                        <td>Chasis</td>
                        <td class="pl-5">:</td>
                        <td class="pl-2"><?php echo $chasis; ?></td>
                    </tr>
                </table>
            </div>
        </div>
        </div>
    </div>
    <section class="mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-start">
                        <div class="mr-3">
                            <span>MENU</span>
                        </div>
                        <div class="mr-3">
                            <span>|</span>
                        </div>
                        <div class="mr-3 skrbmenu px-3 masterchasis">
                            <span>Back</span>
                        </div>
                        <div id="menusales" class="mr-3 skrbmenu px-3">
                            <span>Sales</span>
                        </div>
                        <div id="menueng" class="mr-3 skrbmenu px-3">
                            <span>Engineer</span>
                        </div>
                    </div>
                </div>
                <?php 
                    $dir = 'SALES';
                    $q_skrb_sales = Yii::app()->dbOracle->createCommand("SELECT
                                                                TO_CHAR(CREATED_AT,'DD/MM/YYYY') CREATE_AT,
                                                                TO_CHAR(UPDATE_AT,'DD/MM/YYYY') UPDATE_AT,
                                                                FILE_NAME,
                                                                FILE_VERSION,
                                                                ISLASTVERSION,
                                                                FILE_DESKRIPSI,
                                                                ID_SKRB_$dir,
                                                                ISHIDE,
                                                                ID_CHASIS
                                                                FROM KATALOG_SKRB_$dir WHERE ID_CHASIS = '$idchasis' AND ISHIDE IS NULL ORDER BY ISLASTVERSION ASC")->queryAll();
                ?>
                <div id="sales-data" class="skrbdatatable">
                <button class="btn btn-primary my-3 btn-sm px-3 rounded"><i class="fas fa-plus"></i> Tambah</button>
                    <table class="display mytable" style="width:100%">
                        <thead>
                          <tr align="left">
                            <th width="20px">No</th>
                            <th>Deskripsi File</th>
                            <th>Create At</th>
                            <th>Update At</th>
                            <th>File Version</th>
                            <th>Last Version</th>
                            <th>Detail</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $no=1; foreach($q_skrb_sales as $data){
                                if($data['ISLASTVERSION'] == 'X'){
                                    $last_version  = '<i class="fa fa-times px-1 py-1 bg-danger text-white" aria-hidden="true"></i>';
                                }else {
                                    $last_version  = '<i class="fa fa-check px-1 py-1 bg-success text-white" aria-hidden="true"></i>';
                                }
                                echo '<tr>';
                                    echo '<td>'.$no++.'</td>';
                                    echo '<td>'.$data['FILE_DESKRIPSI'].'</td>';
                                    echo '<td>'.$data['CREATE_AT'].'</td>';
                                    echo '<td>'.$data['UPDATE_AT'].'</td>';
                                    echo '<td>'.$data['FILE_VERSION'].'</span></td>';
                                    echo '<td>'.$last_version.'</td>';
                                    echo '<td>
                                    edit dan delete belum guys
                                    <a href="FILE/SKRB/SALES/'.$data['FILE_NAME'].'" target="_blank" view><i class="fas fa-eye"></i></a>                 
                                    <a href="FILE/SKRB/SALES/'.$data['FILE_NAME'].'" target="_blank" download><i class="fas fa-download"></i></a>
                                            </td>';
                                echo '</tr>';
                            } ?>
                        </tbody>
                    </table>
                </div>
                <div id="engg-data" class="skrbdatatable">
                    <?php
                    $dir = 'ENG';
                    $q_skrb_eng = Yii::app()->dbOracle->createCommand("SELECT
                                                                TO_CHAR(CREATED_AT,'DD/MM/YYYY') CREATE_AT,
                                                                TO_CHAR(UPDATE_AT,'DD/MM/YYYY') UPDATE_AT,
                                                                FILE_NAME,
                                                                FILE_VERSION,
                                                                ISLASTVERSION,
                                                                FILE_DESKRIPSI,
                                                                ID_SKRB_$dir,
                                                                ISHIDE,
                                                                ID_CHASIS
                                                                FROM KATALOG_SKRB_$dir WHERE ID_CHASIS = '$idchasis' AND ISHIDE IS NULL ORDER BY ISLASTVERSION ASC")->queryAll();
                    ?>
                    <button class="btn btn-primary my-3 btn-sm px-3 rounded"><i class="fas fa-plus"></i> Tambah</button>
                    <table class="display mytable" style="width:100%">
                        <thead>
                          <tr align="left">
                            <th width="20px">No</th>
                            <th>Deskripsi File</th>
                            <th>Create At</th>
                            <th>Update At</th>
                            <th>File Version</th>
                            <th>Last Version</th>
                            <th>Detail</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; foreach($q_skrb_eng as $data){
                                if($data['ISLASTVERSION'] == 'X'){
                                    $last_version  = '<i class="fa fa-times px-1 py-1 bg-danger text-white" aria-hidden="true"></i>';
                                }else {
                                    $last_version  = '<i class="fa fa-check px-1 py-1 bg-success text-white" aria-hidden="true"></i>';
                                }
                                echo '<tr>';
                                    echo '<td>'.$no++.'</td>';
                                    echo '<td>'.$data['FILE_DESKRIPSI'].'</td>';
                                    echo '<td>'.$data['CREATE_AT'].'</td>';
                                    echo '<td>'.$data['UPDATE_AT'].'</td>';
                                    echo '<td>'.$data['FILE_VERSION'].'</span></td>';
                                    echo '<td>'.$last_version.'</td>';
                                    echo '<td>
                                    edit dan delete belum guys
                                    <a href="FILE/SKRB/ENG/'.$data['FILE_NAME'].'" target="_blank" view><i class="fas fa-eye"></i></a>                 
                                    <a href="FILE/SKRB/ENG/'.$data['FILE_NAME'].'" target="_blank" download><i class="fas fa-download"></i></a>
                                            </td>';
                                echo '</tr>';
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    </section>
</section>

<?php
$q_chasis = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_CHASIS WHERE ID_CHASIS = '$idchasis'")->queryAll();
$row = count($q_chasis);
if($row == 0){} else {
?>
<style>
    .hov {
        cursor: pointer;
        transition: 0.5s;
    }
    .hov:hover {
        background-color: #DCDCDC;
    }
</style>
<!-- <section class="py-1">
        <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-6">
                      <div class="card hov" attr-dept="0" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $produk; ?>" attr-class = "<?php echo $clas; ?>" attr-model = "<?php echo $model; ?>" attr-chasis = "<?php echo $chasis; ?>" attr-type = "<?php echo $type; ?>">
                          <div class="card-header">
                              <h6 class="text-uppercase mb-0">SKRB SALES</h6>
                          </div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-7">
                                      <img src="img/sales2.svg" style="width: 100%;">
                                  </div>
                                  <div class="col-md-5">
                                      <?php
                                          $q_skrb_sales = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_SKRB_SALES WHERE ID_CHASIS = '$idchasis'")->queryAll();
                                          $file_skrb_sales = count($q_skrb_sales);
                                          $data = [];
                                          if($file_skrb_sales == 0){
                                              $data['version'] = '';
                                          } else {
                                              $arr = array();
                                              $q_last_version = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_SKRB_SALES WHERE ID_CHASIS = '$idchasis' AND ISLASTVERSION = 'X'")->queryAll();
                                              foreach ($q_last_version as $row){
                                                  $data['version'] =  $arr[]=$row['FILE_VERSION'];
                                              }
                                          }
                                      ?>
                                      <ul>
                                          <li style="font-size: 10pt;"><?php echo $file_skrb_sales; ?> File</li>
                                          <li style="font-size: 10pt;">Last Version : <?php echo $data['version']; ?> </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>

                  <div class="col-lg-6">
                      <div class="card hov" attr-dept="1" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $produk; ?>" attr-class = "<?php echo $clas; ?>" attr-model = "<?php echo $model; ?>" attr-chasis = "<?php echo $chasis; ?>" attr-type = "<?php echo $type; ?>">
                          <div class="card-header">
                              <h6 class="text-uppercase mb-0">SKRB ENGINEER</h6>
                          </div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-7">
                                      <img src="img/engineer.svg" style="width: 100%;">
                                  </div>
                                  <div class="col-md-5">
                                      <?php
                                          $q_skrb_eng = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_SKRB_ENG WHERE ID_CHASIS = '$idchasis'")->queryAll();
                                          $file_skrb_eng = count($q_skrb_eng);
                                      ?>
                                      <ul>
                                          <li style="font-size: 10pt;"><?php echo $file_skrb_eng; ?> File</li>
                                          <li style="font-size: 10pt;">Last Version 1.1 </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
        </div>
</section> -->

<?php } ?>

<script>
    $(document).ready(function() {
        $('.mytable').DataTable();
        $('#menusales').addClass('clicked')
        $('#engg-data').addClass('d-none');
        $('#menueng').on('click', function() {
            $(this).addClass('clicked')
            $('#menusales').removeClass('clicked');
            $('#sales-data').addClass('d-none');
            $('#engg-data').removeClass('d-none');
        })
        $('#menusales').on('click', function() {
            $(this).addClass('clicked')
            $('#menueng').removeClass('clicked');
            $('#engg-data').addClass('d-none');
            $('#sales-data').removeClass('d-none');
        })
    })
</script>