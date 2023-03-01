
<?php
$id=Yii::app()->user->id;

$cekwaktu= Yii::app()->db->createCommand("SELECT TO_CHAR(JAM+300/24/60/60,'YYYY-MM-DD HH24:MI:SS') JAM FROM SKRBFILE_TEMPORARY_OTP WHERE ID_USER = '$id'")->queryAll();
if(count($cekwaktu) > 0){
    $datawaktu = [];
    foreach($cekwaktu as $rowwaktu){
        $datawaktu['JAM'] = $arr[]=$rowwaktu['JAM'];
    }
    
    $waktuawal = strtotime(date("Y-m-d H:i:s"));
    $waktuakhir = strtotime($datawaktu['JAM']);
    $diff = $waktuawal - $waktuakhir; //DETIK
    ?>
    <script type="text/javascript">
        const tglTujuan = new Date('<?php echo $datawaktu['JAM']; ?>').getTime();

        const hitungMundur = setInterval(function() {

        const tglSekarang = new Date().getTime();
        const selisih = tglTujuan - tglSekarang;
        const hari = Math.floor(selisih / (1000 * 60 * 60 * 24));
        const jam = Math.floor(selisih % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
        const menit = Math.floor(selisih % (1000 * 60 * 60) / (1000 * 60));
        const detik = Math.floor(selisih % (1000 * 60) / 1000);

        const teks = document.getElementById('waktu');


        if(menit <= 0 && detik <= 0){
            clearInterval(hitungMundur);
            teks.innerHTML = "";

            var mydiv = document.getElementById("myDiv");
            var aTag = document.createElement('a');
            aTag.setAttribute('class',"btn btn-success btn-sm getotp");
            aTag.setAttribute('style',"color: white; cursor: pointer;");
            aTag.textContent= "Get OTP";
            mydiv.appendChild(aTag);

        } else {
            teks.innerHTML = menit+" : "+ detik+" menit untuk get OTP kembali"; 
        }

        }, 1000);
    </script>
    <?php
    $stat = 1;
} else {
    ?>
    <script type="text/javascript">
        var mydiv = document.getElementById("myDiv");
        var aTag = document.createElement('a');
        aTag.setAttribute('class',"btn btn-success btn-sm getotp");
        aTag.setAttribute('style',"color: white; cursor: pointer;");
        aTag.textContent= "Get OTP";
        mydiv.appendChild(aTag);
    </script>
    <?php
    $stat = 0;
}
?>

<div class="container-fluid px-xl-5 py-5">
    <div class="d-flex justify-content-center">
    <section class="py-5 col-md-3 bg-light">
        <div class="form-group">
            <input type="text" id="otpuser" class="form-control" style="font-weight: bold;" maxlength="6" placeholder="Masukan 6 Kode OTP">                 
        </div>
        <div class="form-group">
            <center>
                <div id="waktujalan">
                    <div id="myDiv"></div>
                    <span id="waktu" style="font-size: 1.1em; color: #778899; font-family: serif; font-weight: bold;"></span>
                </div>
            </center>                        
        </div>
        <div class="form-group">
            <center>
                <a class="btn btn-primary btn-sm cekotp" style="color: white; cursor: pointer;">Submit</a>
            </center>                        
        </div>
        <div class="form-group">
            <center>
                <a class="btn btn-secondary btn-sm" href="index.php?r=site/logout">Cancel</a>
            </center>                        
        </div>
    </section>
    </div>
</div>

