<?php
$col_id = '"id"';
$q_whopdf= Yii::app()->db->createCommand("SELECT TO_CHAR(TIME,'HH24:MI') JAM, TO_CHAR(TIME,'DD/MM/YYYY') TGL, DESCRIPTION AS DESCRIPTION, NAMA_LENGKAP AS NAMA_LENGKAP FROM SKRBFILE_ACTIVITY_USER SAU INNER JOIN MASTER_USERS MU ON SAU.ID_USER = MU.$col_id WHERE ACTIVITY = '1' ORDER BY SAU.TIME DESC")->queryAll();

?>
<section class="py-2">
<table style="width:100%">
    <tr align="center">
        <th><h3><span class="badge badge-primary">WHO IS GET OTP REQUEST</span></h3></th>
    </tr>
    <tr align="center">
        <th><span class="badge badge-primary">Total data : <?php echo count($q_whopdf); ?></span></th>
    </tr>
</table>
</section>
<section>
    <div class="container-fluid px-xl-5" style="overflow-x:auto;">
        <table id="example" class="display" style="width:100%;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>User</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                    $no=1;
                    $arr = array();
                    foreach($q_whopdf as $datarow){
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $arr[]=$datarow['TGL'] ?></td>
                    <td><?php echo $arr[]=$datarow['JAM'] ?></td>
                    <td><?php echo $arr[]=$datarow['NAMA_LENGKAP'] ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>