<style>
    .hovdesign {
        cursor: pointer;
        transition: 0.5s;
    }
    .hovdesign:hover {
        background-color: #DCDCDC;
    }
</style>

<section class="py-1">
    <a class="btn btn-primary masterchasis" style="color: white;">Back</a>
</section>

<section class="py-1">
    <div class="col-lg-12 py-2">
        <div class="card">
            <div class="card-body">
                <table style="width: 100%">
                    <tr>
                        <th>Produk</th>
                        <th>:</th>
                        <th><?php echo $produk; ?></th>
                    </tr>
                    <tr>
                        <th>Class</th>
                        <th>:</th>
                        <th><?php echo $clas; ?></th>
                    </tr>
                    <tr>
                        <th>Model</th>
                        <th>:</th>
                        <th><?php echo $model; ?></th>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <th>:</th>
                        <th><?php echo $type; ?></th>
                    </tr>
                    <tr>
                        <th>Chasis</th>
                        <th>:</th>
                        <th><?php echo $chasis; ?></th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>
<?php
$q_drawing = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_CHASIS WHERE ID_CHASIS = '$idchasis'")->queryAll();
$row = count($q_drawing);

if($row == 0){} else {
?>
<section class="py-1">
        <div class="container-fluid">
              <div class="row">
                  <div class="col-lg-6">
                      <div class="card hovdesign" attr-dept="0" attr-idchasis = "<?php echo $idchasis; ?>" attr-produk = "<?php echo $produk; ?>" attr-class = "<?php echo $clas; ?>" attr-model = "<?php echo $model; ?>" attr-chasis = "<?php echo $chasis; ?>" attr-type = "<?php echo $type; ?>">
                          <div class="card-header">
                              <h6 class="text-uppercase mb-0">DESIGN</h6>
                          </div>
                          <div class="card-body">
                              <div class="row">
                                  <div class="col-md-7">
                                      <img src="img/sales2.svg" style="width: 100%;">
                                  </div>
                                  <div class="col-md-5">
                                      <?php
                                          $q_design_eng = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_DESIGN WHERE ID_CHASIS = '$idchasis'")->queryAll();
                                          $file_design = count($q_design_eng);
                                          $data = [];
                                          if($file_design == 0){
                                              $data['version'] = '';
                                          } else {
                                              $arr = array();
                                              $q_last_version = Yii::app()->dbOracle->createCommand("SELECT * FROM KATALOG_DESIGN WHERE ID_CHASIS = '$idchasis' AND ISLASTVERSION = 'X' ")->queryAll();
                                              foreach ($q_last_version as $row){
                                                  $data['version'] =  $arr[]=$row['FILE_VERSION'];
                                              }
                                          }
                                      ?>
                                      <ul>
                                          <li style="font-size: 10pt;" align="right"><?php echo $file_design; ?> File</li>
                                          <li style="font-size: 10pt;">Last Version : <?php echo $data['version']; ?> </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
        </div>
</section>

<?php } ?>