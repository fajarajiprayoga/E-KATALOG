<section class="py-2">
<table style="width:100%">
    <tr align="center">
        <th><h3><span class="badge badge-primary"><?php echo $dir; ?></span></h3></th>
    </tr>
    <tr align="center">
        <th><span class="badge badge-primary">Total data : <?php echo $hitung_row; ?></span></th>
    </tr>
</table>
</section>
<section>
    <div class="container-fluid px-xl-5">
        <i class="fas fa-arrow-alt-circle-left first" style="cursor: pointer; font-size: 3em; color: #1E90FF;"></i>
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php   
                    for($a=0; $a < count($data['data']); $a++)
                    {
                    if($data['data'][$a] == '.' || $data['data'][$a] == '..'){
                    } else {
                ?>
                <tr>
                    <td style="width: 5%;"><a href="index.php?r=openpdf&dir=<?php echo $this->base64_encrypt($dir, $this->key()); ?>&namefile=<?php echo $this->base64_encrypt($data['data'][$a], $this->key()); ?>" target="_blank" data-namefile="<?php echo $data['data'][$a]; ?>" style="cursor: pointer;"><i class="fas fa-file-pdf" style="font-size: 3.5em; color: #8B0000;"></i></a></td>
                    <td><a href="index.php?r=openpdf&dir=<?php echo $this->base64_encrypt($dir, $this->key()); ?>&namefile=<?php echo $this->base64_encrypt($data['data'][$a], $this->key()); ?>" target="_blank" data-dir="<?php echo $dir; ?>" style="cursor: pointer;" data-namefile="<?php echo $data['data'][$a]; ?>"><?php echo $data['data'][$a]; ?></a></td>
                </tr>
                <?php }} ?>
            </tbody>
        </table>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );
</script>
