/////////////////// ON CLICK ///////////////////
$(document).on('click', '#navhome', function() {
    $('.dashboard').addClass('active');
    $('.masterproduk').removeClass('active');
    $('.masterclass').removeClass('active');
    $('.mastermodel').removeClass('active');
    $('.mastertype').removeClass('active');
    $('.masterchasis').removeClass('active');
});
$(document).on('click', '#navmasterproduk', function() {
    $('.dashboard').removeClass('active');
    $('.masterproduk').addClass('active');
    $('.masterclass').removeClass('active');
    $('.mastermodel').removeClass('active');
    $('.mastertype').removeClass('active');
    $('.masterchasis').removeClass('active');
});
$(document).on('click', '#navmasterclass', function() {
    $('.dashboard').removeClass('active');
    $('.masterproduk').removeClass('active');
    $('.masterclass').addClass('active');
    $('.mastermodel').removeClass('active');
    $('.mastertype').removeClass('active');
    $('.masterchasis').removeClass('active');
});
$(document).on('click', '#navmastermodel', function() {
    $('.dashboard').removeClass('active');
    $('.masterproduk').removeClass('active');
    $('.masterclass').removeClass('active');
    $('.mastermodel').addClass('active');
    $('.mastertype').removeClass('active');
    $('.masterchasis').removeClass('active');
});
$(document).on('click', '#navmastertype', function() {
    $('.dashboard').removeClass('active');
    $('.masterproduk').removeClass('active');
    $('.masterclass').removeClass('active');
    $('.mastermodel').removeClass('active');
    $('.mastertype').addClass('active');
    $('.masterchasis').removeClass('active');
});
$(document).on('click', '#navmasterchasis', function() {
    $('.dashboard').removeClass('active');
    $('.masterproduk').removeClass('active');
    $('.masterclass').removeClass('active');
    $('.mastermodel').removeClass('active');
    $('.mastertype').removeClass('active');
    $('.masterchasis').addClass('active');
});
$(document).on('click', '.first', function(){
    load_beranda();
});
$(document).on('click', '.second', function(){
    var dir = $(this).attr('data-dir');
    load_second(dir);
});
$(document).on('click', '.openpdf', function(){
    var namefile = $(this).attr('data-namefile');
    var dir = $(this).attr('data-dir');
    load_openpdf(namefile,dir);
});
$(document).on('click', '.getotp', function(){
    load_getotp();
});
$(document).on('click', '.cekotp', function(){
    load_beranda();
    /*var otpuser = document.getElementById('otpuser').value;
    if(otpuser == ''){
        Swal.fire({
            title: 'Warning!',
            text: 'Code OTP Tidak Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else {
        load_cekotp(otpuser);
    }*/
});
$(document).on('click', '.uploadfile', function(){
    load_uploadfile();
});
$(document).on('click', '.activity', function(){
    load_activity();
});
$(document).on('click', '.whopdf', function(){
    load_whopdf();
});
$(document).on('click', '.whologgin', function(){
    load_whologgin();
});
$(document).on('click', '.whogetotp', function(){
    load_whogetotp();
});
$(document).on('click', '.masteruser', function(){
    load_masteruser();
});

$(document).on('click', '.masterproduk', function(){
    load_masterproduk();
});

$(document).on('click', '.addproduk', function(){
    var namaproduk = document.getElementById("namaproduk").value;
    $('#produkModal').modal('hide');
    load_proses_addproduk(namaproduk);
});

$(document).on('click', '.masterclass', function(){
    load_masterclass();
});
$(document).on('click', '.addclass', function(){
    var namaclass = document.getElementById("namaclass").value;
    var idproduk = document.getElementById("idproduk").value;
    
    $('#classModal').modal('hide');

    load_proses_addclass(namaclass, idproduk);
});

$(document).on('click', '.mastermodel', function(){
    load_mastermodel();
});

$(document).on('click', '.insertmodel', function(){
        var addproduk = document.getElementsByName('addproduk[]');
        var addclass = document.getElementsByName('addclass[]');
        var namamodel = document.getElementsByName('namamodel[]');
        var id = document.getElementsByName('id[]');
        var number = 0;
        var countProd = 0;
        var countClass = 0;
        var countModel = 0;
        var statProd = "";
        var statClas = "";
        var statModel = "";
        $('#modelModal').modal('hide');
        
        for (var i = 0; i < id.length; i++) {
            var cekkolom = id[i];
            if(cekkolom.value != ""){
                number++;
            }
        }
        
        var totalKolom = number-1;
        
        for (var j = 0; j < totalKolom; j++) {
            var produk = addproduk[j];
            if(produk.value != ""){
                countProd++;
            } else {
                countProd--;
            }
        }
        
        for (var k = 0; k < totalKolom; k++) {
            var clas = addclass[k];
            if(clas.value != ""){
                countClass++;
            } else {
                countClass--;
            }
        }
        
        for (var l = 0; l < totalKolom; l++) {
            var model = namamodel[l];
            if(model.value != ""){
                countModel++;
            } else {
                countModel--;
            }
        }
        
        if(totalKolom == countProd){
            statProd = "1";
        } else {
            statProd = "0";
        }
        
        if(totalKolom == countClass){
            statClas = "1";
        } else {
            statClas = "0";
        }
        
        if(totalKolom == countModel){
            statModel = "1";
        } else {
            statModel = "0";
        }
        
        if(statProd == "1" && statClas == "1" && statModel == "1"){
            if(totalKolom == 0){
                Swal.fire({
                    title: 'Warning',
                    text: 'Tidak Ada Inputan',
                    icon: 'warning',
                    confirmButtonText: 'Close'
                });
            } else {
                var tumpuk = [];
                for (var m = 0; m < totalKolom; m++) {
                    var finalProd = addproduk[m];
                    var finalClas = addclass[m];
                    var finalModel = namamodel[m];
                    
                    tumpuk.push(finalProd.value, finalClas.value, finalModel.value,'|');
                }
                load_proses_addmodel(tumpuk);
            }
            
        } else {
            Swal.fire({
                title: 'Gagal',
                text: 'Data Tidak Boleh Ada Yang Kosong',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        }
        
    });
    
$(document).on('click', '.savemodel', function() {
    var produk = $('#addproduk').val();
    var clas = $('#addclass').val();
    var model =$('#namamodel').val();
    $('#modelModal').modal('hide');

    $.ajax({
        url:"index.php?r=mastermodel/store",
        method: "POST",
        data: {
            produk: produk,
            class: clas,
            model: model
        },beforeSend: function(){
            $(".loader").show();
        },success:function(response){
            load_mastermodel();
            Swal.fire({
                title: 'Add Success!',
                icon: 'success',
                confirmButtonText: 'Close'
            });   
        },error: function(response){
            Swal.fire({
                title: 'Failed!',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        },
        complete: function(){
         $(".loader").hide();
        }
    })
})

$(document).on('click', '.savetype', function() {
    var produk = $('#addproduk').val();
    var clas = $('#addclass').val();
    var model =$('#addmodel').val();
    var type =$('#namatype').val();
    $('#typeModal').modal('hide');

    $.ajax({
        url:"index.php?r=mastertype/store",
        method: "POST",
        data: {
            produk: produk,
            class: clas,
            model: model,
            type: type
        },beforeSend: function(){
            $(".loader").show();
        },success:function(response){
            load_mastertype();
            Swal.fire({
                title: 'Add Success!',
                icon: 'success',
                confirmButtonText: 'Close'
            });   
        },error: function(response){
            Swal.fire({
                title: 'Failed!',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        },
        complete: function(){
         $(".loader").hide();
        }
    })
})

$(document).on('click', '.savechasis', function() {
    var produk = $('#addproduk').val();
    var clas = $('#addclass').val();
    var model =$('#addmodel').val();
    var type =$('#addtype').val();
    var chasis =$('#namachasis').val();
    $('#chasisModal').modal('hide');

    $.ajax({
        url:"index.php?r=masterchasis/store",
        method: "POST",
        data: {
            produk: produk,
            class: clas,
            model: model,
            type: type,
            chasis: chasis
        },beforeSend: function(){
            $(".loader").show();
        },success:function(response){
            load_masterchasis();
            Swal.fire({
                title: 'Add Success!',
                icon: 'success',
                confirmButtonText: 'Close'
            });   
        },error: function(response){
            Swal.fire({
                title: 'Failed!',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        },
        complete: function(){
         $(".loader").hide();
        }
    })
})

$(document).on('click', '.mastertype', function(){
    load_mastertype();
});

$(document).on('click', '.inserttype', function(){
        var addproduk = document.getElementsByName('addproduk[]');
        var addclass = document.getElementsByName('addclass[]');
        var addmodel = document.getElementsByName('addmodel[]');
        var namatype = document.getElementsByName('namatype[]');
        var id = document.getElementsByName('id[]');
        
        var number = 0;
        var countProd = 0;
        var countClass = 0;
        var countModel = 0;
        var countType = 0;
        
        var statProd = "";
        var statClas = "";
        var statModel = "";
        var statType = "";
        
        for (var i = 0; i < id.length; i++) {
            var cekkolom = id[i];
            if(cekkolom.value != ""){
                number++;
            }
        }
        
        var totalKolom = number-1;
        
        for (var j = 0; j < totalKolom; j++) {
            var produk = addproduk[j];
            if(produk.value != ""){
                countProd++;
            } else {
                countProd--;
            }
        }
        
        for (var k = 0; k < totalKolom; k++) {
            var clas = addclass[k];
            if(clas.value != ""){
                countClass++;
            } else {
                countClass--;
            }
        }
        
        for (var l = 0; l < totalKolom; l++) {
            var model = addmodel[l];
            if(model.value != ""){
                countModel++;
            } else {
                countModel--;
            }
        }
        
        for (var n = 0; n < totalKolom; n++) {
            var type = namatype[n];
            if(type.value != ""){
                countType++;
            } else {
                countType--;
            }
        }
        
        if(totalKolom == countProd){
            statProd = "1";
        } else {
            statProd = "0";
        }
        
        if(totalKolom == countClass){
            statClas = "1";
        } else {
            statClas = "0";
        }
        
        if(totalKolom == countModel){
            statModel = "1";
        } else {
            statModel = "0";
        }
        
        if(totalKolom == countType){
            statType = "1";
        } else {
            statType = "0";
        }
        
        if(statProd == "1" && statClas == "1" && statModel == "1" && statType == "1"){
            if(totalKolom == 0){
                Swal.fire({
                    title: 'Warning',
                    text: 'Tidak Ada Inputan',
                    icon: 'warning',
                    confirmButtonText: 'Close'
                });
            } else {
                var tumpuk = [];
                for (var m = 0; m < totalKolom; m++) {
                    var finalProd = addproduk[m];
                    var finalClas = addclass[m];
                    var finalModel = addmodel[m];
                    var finalType = namatype[m];
                    
                    tumpuk.push(finalProd.value, finalClas.value, finalModel.value, finalType.value,'|');
                }
                //alert(tumpuk);
                load_proses_addtype(tumpuk);
            }
            
        } else {
            Swal.fire({
                title: 'Gagal',
                text: 'Data Tidak Boleh Ada Yang Kosong',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        }
        
    });
    
$(document).on('click', '.masterchasis', function(){
    load_masterchasis();
});

$(document).on('click', '.insertchasis', function(){
        var addproduk = document.getElementsByName('addproduk[]');
        var addclass = document.getElementsByName('addclass[]');
        var addmodel = document.getElementsByName('addmodel[]');
        var addtype = document.getElementsByName('addtype[]');
        var namachasis = document.getElementsByName('namachasis[]');
        var id = document.getElementsByName('id[]');
        
        var number = 0;
        var countProd = 0;
        var countClass = 0;
        var countModel = 0;
        var countType = 0;
        var countChasis = 0;
        
        var statProd = "";
        var statClas = "";
        var statModel = "";
        var statType = "";
        var statChasis = "";
        
        for (var i = 0; i < id.length; i++) {
            var cekkolom = id[i];
            if(cekkolom.value != ""){
                number++;
            }
        }
        
        var totalKolom = number-1;
        
        for (var j = 0; j < totalKolom; j++) {
            var produk = addproduk[j];
            if(produk.value != ""){
                countProd++;
            } else {
                countProd--;
            }
        }
        
        for (var k = 0; k < totalKolom; k++) {
            var clas = addclass[k];
            if(clas.value != ""){
                countClass++;
            } else {
                countClass--;
            }
        }
        
        for (var l = 0; l < totalKolom; l++) {
            var model = addmodel[l];
            if(model.value != ""){
                countModel++;
            } else {
                countModel--;
            }
        }
        
        for (var n = 0; n < totalKolom; n++) {
            var type = addtype[n];
            if(type.value != ""){
                countType++;
            } else {
                countType--;
            }
        }
        
        for (var o = 0; o < totalKolom; o++) {
            var chasis = namachasis[o];
            if(chasis.value != ""){
                countChasis++;
            } else {
                countChasis--;
            }
        }
        
        if(totalKolom == countProd){
            statProd = "1";
        } else {
            statProd = "0";
        }
        
        if(totalKolom == countClass){
            statClas = "1";
        } else {
            statClas = "0";
        }
        
        if(totalKolom == countModel){
            statModel = "1";
        } else {
            statModel = "0";
        }
        
        if(totalKolom == countType){
            statType = "1";
        } else {
            statType = "0";
        }
        
        if(totalKolom == countChasis){
            statChasis = "1";
        } else {
            statChasis = "0";
        }
        
        if(statProd == "1" && statClas == "1" && statModel == "1" && statType == "1"&& statChasis == "1"){
            if(totalKolom == 0){
                Swal.fire({
                    title: 'Warning',
                    text: 'Tidak Ada Inputan',
                    icon: 'warning',
                    confirmButtonText: 'Close'
                });
            } else {
                var tumpuk = [];
                for (var m = 0; m < totalKolom; m++) {
                    var finalProd = addproduk[m];
                    var finalClas = addclass[m];
                    var finalModel = addmodel[m];
                    var finalType = addtype[m];
                    var finalChasis = namachasis[m];
                    
                    tumpuk.push(finalProd.value, finalClas.value, finalModel.value, finalType.value, finalChasis.value,'|');
                }
                //alert(tumpuk);
                load_proses_addchasis(tumpuk);
            }
            
        } else {
            Swal.fire({
                title: 'Gagal',
                text: 'Data Tidak Boleh Ada Yang Kosong',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        }
        
    });
    
$(document).on('click', '.skrb', function(){
    var idchasis = $(this).attr('attr-idchasis');
    var produk = $(this).attr('attr-produk');
    var clas = $(this).attr('attr-class');
    var model = $(this).attr('attr-model');
    var chasis = $(this).attr('attr-chasis');
    var type = $(this).attr('attr-type');
    load_skrb(idchasis, produk, clas, model, chasis, type);
});

$(document).on('click', '.hov', function(){
    var idchasis = $(this).attr('attr-idchasis');
    var dept = $(this).attr('attr-dept');
    var produk = $(this).attr('attr-produk');
    var clas = $(this).attr('attr-class');
    var model = $(this).attr('attr-model');
    var chasis = $(this).attr('attr-chasis');
    var type = $(this).attr('attr-type');
    load_formskrb(idchasis, dept, produk, clas, model, chasis, type);
});

$(document).on('click', '.uploadskrb', function(){
    const fileupload = $('#fileupload').prop('files')[0];
    var deskrispi = $('#deskripsi').val();
    var version = $('#version').val();
    var departemen = $('#departemen').val();
    var idchasis = $('#idchasis').val();
    var lastVersion = document.querySelector('input[type="checkbox"]');
    
    var idchasis = $(this).attr('attr-idchasis');
    var dept = $(this).attr('attr-dept');
    var produk = $(this).attr('attr-produk');
    var clas = $(this).attr('attr-class');
    var model = $(this).attr('attr-model');
    var chasis = $(this).attr('attr-chasis');
    var type = $(this).attr('attr-type');
    
    if(deskrispi == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Deskrispi Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else if (departemen == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Gagal Upload!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else if (version == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Version Tidak Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else {
        let formData = new FormData();
        formData.append('fileupload', fileupload);
        formData.append('deskrispi', deskrispi);
        formData.append('version', version);
        formData.append('departemen', departemen);
        formData.append('idchasis', idchasis);
        formData.append('lastVersion', lastVersion.checked);
        $.ajax({
            url:"index.php?r=skrb/proses_upload_skrb",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
                $(".loader").show();
            },
            success:function(data){
                var stat = $.parseJSON(data);
                var statt = stat.status;
                if(statt == "1"){
                    document.getElementById("form-data").reset();
                    load_formskrb(idchasis, dept, produk, clas, model, chasis, type);
                    Swal.fire({
                        title: 'Upload Success!',
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });
                } else if(statt == "2"){
                    Swal.fire({
                        title: 'Upload Failed!',
                        text: 'Ukuran File Tidak Boleh Melebihi 10 MB!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                } else {
                    Swal.fire({
                        title: 'Upload Failed!',
                        text: 'Format File Tidak Di Dukung!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            },
            complete: function(){
                $(".loader").hide();
            }
        });
    }
});

$(document).on('click', '.form_edit_produk', function(){
    var idproduk = $(this).attr('attr-idproduk');
    $('#produkModalLabel').text('Form edit produk');
    $('#btnupdateproduk').removeClass('d-none');
    $('#produkModal').modal('show');
    // load_formeditproduk(idproduk);
    $.ajax({
        url:"index.php?r=masterproduk/detail_produk",
        method:"POST",
        data:{idproduk:idproduk},
        success:function(data){
            var data = JSON.parse(data);
            $('#idproduk').val(data.IDPRODUK);
            $('#namaproduk').val(data.NAMAPRODUK);
        }
    });
});

$(document).on('click', '.form_edit_class', function(){
    var idclass = $(this).attr('attr-idclass');
    var idproduk = $(this).attr('attr-idproduk');
    $('#classModalLabel').text('Form tambah class');
    $('#btnupdateclass').removeClass('d-none');
    $('#old_produk').removeClass('d-none');
    $('#classModal').modal('show');
    // load_formeditclass(idproduk, idclass);
    $.ajax({
        url:"index.php?r=masterclass/detail_class",
        method:"POST",
        data:{
            idproduk:idproduk,
            idclass:idclass
        },
        success:function(data){
            var data = JSON.parse(data);
            $('#idclass').val(data.IDCLASS);
            $('#old_produk').text(data.NAMAPRODUK);
            $('#old_produk').val(data.IDPRODUK);
            $('#namaclass').val(data.NAMACLASS);
        }
    });
});

$(document).on('click', '.form_edit_model', function(){
    var idclass = $(this).attr('attr-idclass');
    var idproduk = $(this).attr('attr-idproduk');
    var idmodel = $(this).attr('attr-idmodel');
    
    // load_formeditmodel(idproduk, idclass, idmodel);
    $('#modelModalLabel').text('Form edit model');
    $('#btnupdatemodel').removeClass('d-none');
    $('#btnsavemodel').addClass('d-none');
    $('#old_produk').removeClass('d-none');
    $('#modelModal').modal('show');

    $.ajax({
        url:"index.php?r=mastermodel/detail_model",
        method:"POST",
        data:{
            idproduk:idproduk,
            idclass:idclass,
            idmodel: idmodel
        },
        success:function(data){
            var data = JSON.parse(data);
            $('#idmodel').val(data.IDMODEL);
            $('#old_produk').text(data.NAMAPRODUK);
            $('#old_produk').val(data.IDPRODUK);
            $('#old_class').text(data.NAMACLASS);
            $('#old_class').val(data.IDCLASS);
            $('#namamodel').val(data.NAMAMODEL);
        }
    });
});

// $(document).on('click', '.form_edit_type', function(){
//     var idclass = $(this).attr('attr-idclass');
//     var idproduk = $(this).attr('attr-idproduk');
//     var idmodel = $(this).attr('attr-idmodel');
//     var idtype = $(this).attr('attr-idtype');
    
//     load_formedittype(idproduk, idclass, idmodel, idtype);
// });

$(document).on('click', '.form_edit_type', function(){
    var idclass = $(this).attr('attr-idclass');
    var idproduk = $(this).attr('attr-idproduk');
    var idmodel = $(this).attr('attr-idmodel');
    var idtype = $(this).attr('attr-idtype');
    
    $('#typeModallLabel').text('Form edit type');
    $('#btnupdatetype').removeClass('d-none');
    $('#btnsavetype').addClass('d-none');
    $('#old_produk').removeClass('d-none');
    $('#typeModal').modal('show');

    $.ajax({
        url:"index.php?r=mastertype/detail_type",
        method:"POST",
        data:{
            idproduk:idproduk,
            idclass:idclass,
            idmodel: idmodel,
            idtype: idtype
        },
        success:function(data){
            var data = JSON.parse(data);
            $('#idtype').val(data.IDTYPE);
            $('#old_produk').text(data.NAMAPRODUK);
            $('#old_produk').val(data.IDPRODUK);
            $('#old_class').text(data.NAMACLASS);
            $('#old_class').val(data.IDCLASS);
            $('#old_model').text(data.NAMAMODEL);
            $('#old_model').val(data.IDMODEL);
            $('#namatype').val(data.NAMATYPE);
        }
    });
});

$(document).on('click', '.formeditskrb', function(){
    var idchasis = $(this).attr('attr-idchasis');
    var dept = $(this).attr('attr-dept');
    var produk = $(this).attr('attr-produk');
    var clas = $(this).attr('attr-class');
    var model = $(this).attr('attr-model');
    var chasis = $(this).attr('attr-chasis');
    var type = $(this).attr('attr-type'); 
    var idskrbsales = $(this).attr('attr-idskrbsales');
    
    load_formeditskrb(idchasis, dept, produk, clas, model, chasis, type, idskrbsales);
});

$(document).on('click', '.updateskrb', function(){
    if(document.getElementById("fileupload").files.length == 0){
        var validasi_file = "0";
    } else if(document.getElementById("fileupload").files.length > 0) {
        var validasi_file = "1";
    }
    
    const fileskrb = $('#fileupload').prop('files')[0];
        
    var deskrispi = $('#deskripsi').val();
    var adafile = $('#adafile').val();
    var version = $('#version').val();
    var departemen = $('#departemen').val();
    var idchasis = $('#idchasis').val();
    var idskrbsales = $('#idskrbsales').val();
    var lastVersion = document.querySelector('input[type="checkbox"]');
    
    var dept = $(this).attr('attr-dept');
    var produk = $(this).attr('attr-produk');
    var clas = $(this).attr('attr-class');
    var model = $(this).attr('attr-model');
    var chasis = $(this).attr('attr-chasis');
    var type = $(this).attr('attr-type');
    
    
    
    if(deskrispi == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Deskrispi Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else if (departemen == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Gagal Upload!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else if (version == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Version Tidak Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else {
        let formData = new FormData();
        formData.append('fileupload', fileskrb);
        formData.append('adafile', validasi_file);
        formData.append('deskrispi', deskrispi);
        formData.append('version', version);
        formData.append('departemen', departemen);
        formData.append('idchasis', idchasis);
        formData.append('idskrbsales', idskrbsales);
        formData.append('lastVersion', lastVersion.checked);
        
        $.ajax({
            url:"index.php?r=skrb/proses_update_skrb",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
                $(".loader").show();
            },
            success:function(data){
                var stat = $.parseJSON(data);
                var statt = stat.status;
                if(statt == "1"){
                    load_formskrb(idchasis, dept, produk, clas, model, chasis, type);
                    Swal.fire({
                        title: 'Update Success!',
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });
                } else if(statt == "2"){
                    Swal.fire({
                        title: 'Update Failed!',
                        text: 'Ukuran File Tidak Boleh Melebihi 10 MB!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                } else {
                    Swal.fire({
                        title: 'Update Failed!',
                        text: 'Format File Tidak Di Dukung!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            },
            complete: function(){
                $(".loader").hide();
            }
        });
    }
    
});

$(document).on('click', '.deleteskrb', function(){
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Delete SKRB",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Delete skrb ini!'
    }).then((result) => {
        if (result.isConfirmed) {
            var dept = $(this).attr('attr-dept');
            var produk = $(this).attr('attr-produk');
            var clas = $(this).attr('attr-class');
            var model = $(this).attr('attr-model');
            var chasis = $(this).attr('attr-chasis');
            var type = $(this).attr('attr-type');
            var idchasis = $(this).attr('attr-idchasis');
            var idskrb = $(this).attr('attr-idskrbsales');
            $.ajax({
                url:"index.php?r=skrb/proses_delete_skrb",
                method:"POST",
                data:{dept: dept, idskrb:idskrb},
                beforeSend: function(){
                    $(".loader").show();
                },
                success:function(data){
                    var stat = $.parseJSON(data);
                    var statt = stat.status;
                    if(statt == "1"){
                        load_formskrb(idchasis, dept, produk, clas, model, chasis, type);
                        Swal.fire({
                            title: 'Delete Success!',
                            icon: 'success',
                            confirmButtonText: 'Close'
                        });
                    } else if(statt == "2"){
                        Swal.fire({
                            title: 'Delete Failed!',
                            text: 'SKRB ini ter setting last version',
                            icon: 'error',
                            confirmButtonText: 'Close'
                        });
                    } else {
                        Swal.fire({
                            title: 'Delete Failed!',
                            icon: 'error',
                            confirmButtonText: 'Close'
                        });
                    }
                },
                complete: function(){
                    $(".loader").hide();
                }
            });
        }
        });
});

$(document).on('click', '.drawing', function(){
    var idchasis = $(this).attr('attr-idchasis');
    var produk = $(this).attr('attr-produk');
    var clas = $(this).attr('attr-class');
    var model = $(this).attr('attr-model');
    var chasis = $(this).attr('attr-chasis');
    var type = $(this).attr('attr-type');
    
    load_drawing(idchasis, produk, clas, model, chasis, type);
});

$(document).on('click', '.hovdrawing', function(){
    var idchasis = $(this).attr('attr-idchasis');
    var dept = $(this).attr('attr-dept');
    var produk = $(this).attr('attr-produk');
    var clas = $(this).attr('attr-class');
    var model = $(this).attr('attr-model');
    var chasis = $(this).attr('attr-chasis');
    var type = $(this).attr('attr-type');
    
    load_formdrawing(idchasis, dept, produk, clas, model, chasis, type);
});

$(document).on('click', '.uploaddrawing', function(){
    const fileupload = $('#fileupload').prop('files')[0];
    var deskrispi = $('#deskripsi').val();
    var version = $('#version').val();
    var departemen = $('#departemen').val();
    var idchasis = $('#idchasis').val();
    var lastVersion = document.querySelector('input[type="checkbox"]');
    
    var idchasis = $(this).attr('attr-idchasis');
    var dept = $(this).attr('attr-dept');
    var produk = $(this).attr('attr-produk');
    var clas = $(this).attr('attr-class');
    var model = $(this).attr('attr-model');
    var chasis = $(this).attr('attr-chasis');
    var type = $(this).attr('attr-type');
    
    if(deskrispi == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Deskrispi Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else if (departemen == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Gagal Upload!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else if (version == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Version Tidak Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else {
        let formData = new FormData();
        formData.append('fileupload', fileupload);
        formData.append('deskrispi', deskrispi);
        formData.append('version', version);
        formData.append('departemen', departemen);
        formData.append('idchasis', idchasis);
        formData.append('lastVersion', lastVersion.checked);
        $.ajax({
            url:"index.php?r=drawing/proses_upload_drawing",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
                $(".loader").show();
            },
            success:function(data){
                var stat = $.parseJSON(data);
                var statt = stat.status;
                if(statt == "1"){
                    document.getElementById("form-data").reset();
                    load_formdrawing(idchasis, dept, produk, clas, model, chasis, type);
                    Swal.fire({
                        title: 'Upload Success!',
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });
                } else if(statt == "2"){
                    Swal.fire({
                        title: 'Upload Failed!',
                        text: 'Ukuran File Tidak Boleh Melebihi 30 MB!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                } else {
                    Swal.fire({
                        title: 'Upload Failed!',
                        text: 'Format File Tidak Di Dukung!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            },
            complete: function(){
                $(".loader").hide();
            }
        });
    }
});

$(document).on('click', '.formeditdrawing', function(){
    var idchasis = $(this).attr('attr-idchasis');
    var dept = $(this).attr('attr-dept');
    var produk = $(this).attr('attr-produk');
    var clas = $(this).attr('attr-class');
    var model = $(this).attr('attr-model');
    var chasis = $(this).attr('attr-chasis');
    var type = $(this).attr('attr-type'); 
    var iddrawingeng = $(this).attr('attr-iddrawingeng');
    
    load_formeditdrawing(idchasis, dept, produk, clas, model, chasis, type, iddrawingeng);
});

$(document).on('click', '.updatedrawing', function(){
    if(document.getElementById("fileupload").files.length == 0){
        var validasi_file = "0";
    } else if(document.getElementById("fileupload").files.length > 0) {
        var validasi_file = "1";
    }
    
    const fileskrb = $('#fileupload').prop('files')[0];
        
    var deskrispi = $('#deskripsi').val();
    var adafile = $('#adafile').val();
    var version = $('#version').val();
    var departemen = $('#departemen').val();
    var idchasis = $('#idchasis').val();
    var iddrawingeng = $('#iddrawingeng').val();
    var lastVersion = document.querySelector('input[type="checkbox"]');
    
    var dept = $(this).attr('attr-dept');
    var produk = $(this).attr('attr-produk');
    var clas = $(this).attr('attr-class');
    var model = $(this).attr('attr-model');
    var chasis = $(this).attr('attr-chasis');
    var type = $(this).attr('attr-type');
    
    
    
    if(deskrispi == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Deskrispi Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else if (departemen == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Gagal Upload!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else if (version == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Version Tidak Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else {
        let formData = new FormData();
        formData.append('fileupload', fileskrb);
        formData.append('adafile', validasi_file);
        formData.append('deskrispi', deskrispi);
        formData.append('version', version);
        formData.append('departemen', departemen);
        formData.append('idchasis', idchasis);
        formData.append('iddrawingeng', iddrawingeng);
        formData.append('lastVersion', lastVersion.checked);
        
        $.ajax({
            url:"index.php?r=drawing/proses_update_drawing",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
                $(".loader").show();
            },
            success:function(data){
                var stat = $.parseJSON(data);
                var statt = stat.status;
                if(statt == "1"){
                    load_formdrawing(idchasis, dept, produk, clas, model, chasis, type);
                    Swal.fire({
                        title: 'Update Success!',
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });
                } else if(statt == "2"){
                    Swal.fire({
                        title: 'Update Failed!',
                        text: 'Ukuran File Tidak Boleh Melebihi 30 MB!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                } else {
                    Swal.fire({
                        title: 'Update Failed!',
                        text: 'Format File Tidak Di Dukung!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            },
            complete: function(){
                $(".loader").hide();
            }
        });
    } 
});

$(document).on('click', '.deletedrawing', function(){
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Delete Drawing",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Delete drawing ini!'
    }).then((result) => {
        if (result.isConfirmed) {
            var dept = $(this).attr('attr-dept');
            var produk = $(this).attr('attr-produk');
            var clas = $(this).attr('attr-class');
            var model = $(this).attr('attr-model');
            var chasis = $(this).attr('attr-chasis');
            var type = $(this).attr('attr-type');
            var idchasis = $(this).attr('attr-idchasis');
            var iddrawingeng = $(this).attr('attr-iddrawingeng');
            $.ajax({
                url:"index.php?r=drawing/proses_delete_drawing",
                method:"POST",
                data:{dept: dept, iddrawingeng:iddrawingeng},
                beforeSend: function(){
                    $(".loader").show();
                },
                success:function(data){
                    var stat = $.parseJSON(data);
                    var statt = stat.status;
                    if(statt == "1"){
                        load_formdrawing(idchasis, dept, produk, clas, model, chasis, type);
                        Swal.fire({
                            title: 'Delete Success!',
                            icon: 'success',
                            confirmButtonText: 'Close'
                        });
                    } else if(statt == "2"){
                        Swal.fire({
                            title: 'Delete Failed!',
                            text: 'SKRB ini ter setting last version',
                            icon: 'error',
                            confirmButtonText: 'Close'
                        });
                    } else {
                        Swal.fire({
                            title: 'Delete Failed!',
                            icon: 'error',
                            confirmButtonText: 'Close'
                        });
                    }
                },
                complete: function(){
                    $(".loader").hide();
                }
            });
        }
        });
});

$(document).on('click', '.design', function(){
    var idchasis = $(this).attr('attr-idchasis');
    var produk = $(this).attr('attr-produk');
    var clas = $(this).attr('attr-class');
    var model = $(this).attr('attr-model');
    var chasis = $(this).attr('attr-chasis');
    var type = $(this).attr('attr-type');
    
    load_design(idchasis, produk, clas, model, chasis, type);
});

$(document).on('click', '.hovdesign', function(){
    var idchasis = $(this).attr('attr-idchasis');
    var dept = $(this).attr('attr-dept');
    var produk = $(this).attr('attr-produk');
    var clas = $(this).attr('attr-class');
    var model = $(this).attr('attr-model');
    var chasis = $(this).attr('attr-chasis');
    var type = $(this).attr('attr-type');
    
    load_formdesign(idchasis, dept, produk, clas, model, chasis, type);
});

$(document).on('click', '.uploaddesign', function(){
    const fileupload = $('#fileupload').prop('files')[0];
    var deskrispi = $('#deskripsi').val();
    var version = $('#version').val();
    var departemen = $('#departemen').val();
    var idchasis = $('#idchasis').val();
    var lastVersion = document.querySelector('input[type="checkbox"]');
    
    var idchasis = $(this).attr('attr-idchasis');
    var dept = $(this).attr('attr-dept');
    var produk = $(this).attr('attr-produk');
    var clas = $(this).attr('attr-class');
    var model = $(this).attr('attr-model');
    var chasis = $(this).attr('attr-chasis');
    var type = $(this).attr('attr-type');
    
    if(deskrispi == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Deskrispi Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else if (departemen == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Gagal Upload!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else if (version == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Version Tidak Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else {
        let formData = new FormData();
        formData.append('fileupload', fileupload);
        formData.append('deskrispi', deskrispi);
        formData.append('version', version);
        formData.append('departemen', departemen);
        formData.append('idchasis', idchasis);
        formData.append('lastVersion', lastVersion.checked);
        $.ajax({
            url:"index.php?r=design/proses_upload_design",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
                $(".loader").show();
            },
            success:function(data){
                var stat = $.parseJSON(data);
                var statt = stat.status;
                if(statt == "1"){
                    document.getElementById("form-data").reset();
                    load_formdesign(idchasis, dept, produk, clas, model, chasis, type);
                    Swal.fire({
                        title: 'Upload Success!',
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });
                } else if(statt == "2"){
                    Swal.fire({
                        title: 'Upload Failed!',
                        text: 'Ukuran File Tidak Boleh Melebihi 10 MB!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                } else {
                    Swal.fire({
                        title: 'Upload Failed!',
                        text: 'Format File Tidak Di Dukung!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            },
            complete: function(){
                $(".loader").hide();
            }
        });
    }
});

$(document).on('click', '.formeditdesign', function(){
    var idchasis = $(this).attr('attr-idchasis');
    var dept = $(this).attr('attr-dept');
    var produk = $(this).attr('attr-produk');
    var clas = $(this).attr('attr-class');
    var model = $(this).attr('attr-model');
    var chasis = $(this).attr('attr-chasis');
    var type = $(this).attr('attr-type'); 
    var iddesign = $(this).attr('attr-iddesign');
    
    load_formeditdesign(idchasis, dept, produk, clas, model, chasis, type, iddesign);
});

$(document).on('click', '.updatedesign', function(){
    if(document.getElementById("fileupload").files.length == 0){
        var validasi_file = "0";
    } else if(document.getElementById("fileupload").files.length > 0) {
        var validasi_file = "1";
    }
    
    const fileskrb = $('#fileupload').prop('files')[0];
        
    var deskrispi = $('#deskripsi').val();
    var adafile = $('#adafile').val();
    var version = $('#version').val();
    var departemen = $('#departemen').val();
    var idchasis = $('#idchasis').val();
    var iddesign = $('#iddesign').val();
    var lastVersion = document.querySelector('input[type="checkbox"]');
    
    var dept = $(this).attr('attr-dept');
    var produk = $(this).attr('attr-produk');
    var clas = $(this).attr('attr-class');
    var model = $(this).attr('attr-model');
    var chasis = $(this).attr('attr-chasis');
    var type = $(this).attr('attr-type');
    
    
    
    if(deskrispi == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Deskrispi Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else if (departemen == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Gagal Upload!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else if (version == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Version Tidak Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else {
        let formData = new FormData();
        formData.append('fileupload', fileskrb);
        formData.append('adafile', validasi_file);
        formData.append('deskrispi', deskrispi);
        formData.append('version', version);
        formData.append('departemen', departemen);
        formData.append('idchasis', idchasis);
        formData.append('iddesign', iddesign);
        formData.append('lastVersion', lastVersion.checked);
        
        $.ajax({
            url:"index.php?r=design/proses_update_design",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
                $(".loader").show();
            },
            success:function(data){
                var stat = $.parseJSON(data);
                var statt = stat.status;
                if(statt == "1"){
                    load_formdesign(idchasis, dept, produk, clas, model, chasis, type);
                    Swal.fire({
                        title: 'Update Success!',
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });
                } else if(statt == "2"){
                    Swal.fire({
                        title: 'Update Failed!',
                        text: 'Ukuran File Tidak Boleh Melebihi 10 MB!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                } else {
                    Swal.fire({
                        title: 'Update Failed!',
                        text: 'Format File Tidak Di Dukung!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            },
            complete: function(){
                $(".loader").hide();
            }
        });
    } 
});

$(document).on('click', '.deletedesign', function(){
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Delete Design",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Delete design ini!'
    }).then((result) => {
        if (result.isConfirmed) {
            var dept = $(this).attr('attr-dept');
            var produk = $(this).attr('attr-produk');
            var clas = $(this).attr('attr-class');
            var model = $(this).attr('attr-model');
            var chasis = $(this).attr('attr-chasis');
            var type = $(this).attr('attr-type');
            var idchasis = $(this).attr('attr-idchasis');
            var iddesign = $(this).attr('attr-iddesign');
            $.ajax({
                url:"index.php?r=design/proses_delete_design",
                method:"POST",
                data:{dept: dept, iddesign:iddesign},
                beforeSend: function(){
                    $(".loader").show();
                },
                success:function(data){
                    var stat = $.parseJSON(data);
                    var statt = stat.status;
                    if(statt == "1"){
                        load_formdesign(idchasis, dept, produk, clas, model, chasis, type);
                        Swal.fire({
                            title: 'Delete Success!',
                            icon: 'success',
                            confirmButtonText: 'Close'
                        });
                    } else if(statt == "2"){
                        Swal.fire({
                            title: 'Delete Failed!',
                            text: 'Design ini ter setting last version',
                            icon: 'error',
                            confirmButtonText: 'Close'
                        });
                    } else {
                        Swal.fire({
                            title: 'Delete Failed!',
                            icon: 'error',
                            confirmButtonText: 'Close'
                        });
                    }
                },
                complete: function(){
                    $(".loader").hide();
                }
            });
        }
        });
});

$(document).on('click', '.iws', function(){
    var idchasis = $(this).attr('attr-idchasis');
    var produk = $(this).attr('attr-produk');
    var clas = $(this).attr('attr-class');
    var model = $(this).attr('attr-model');
    var chasis = $(this).attr('attr-chasis');
    var type = $(this).attr('attr-type');
    
    load_iws(idchasis, produk, clas, model, chasis, type);
});

$(document).on('click', '.deletemasterproduk', function(){
    Swal.fire({
        title: 'Anda yakin akan delete produk ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Delete PRODUK ini!'
    }).then((result) => {
        if (result.isConfirmed) {
            var idproduk = $(this).attr('attr-idproduk');
            $.ajax({
                url:"index.php?r=masterproduk/proses_delproduk",
                method:"POST",
                data:{idproduk: idproduk},
                beforeSend: function(){
                    $(".loader").show();
                },
                success:function(data){
                    var stat = $.parseJSON(data);
                    var statt = stat.status;
                    if(statt == "1"){
                        load_masterproduk();
                        Swal.fire({
                            title: 'Delete Success!',
                            icon: 'success',
                            confirmButtonText: 'Close'
                        });
                    } else {
                        Swal.fire({
                            title: 'Delete Failed!',
                            icon: 'error',
                            confirmButtonText: 'Close'
                        });
                    }
                },
                complete: function(){
                    $(".loader").hide();
                }
            });
        }
        });
});

$(document).on('click', '.deletemasterchasis', function(){
    Swal.fire({
        title: 'Anda yakin akan delete chasis ini?',
        text: "Delete Chasis Akan Menghapus Semua File yang Telah Terupload Pada Chasis Ini",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Delete CHASIS ini!'
    }).then((result) => {
        if (result.isConfirmed) {
            var idchasis = $(this).attr('attr-idchasis');
            $.ajax({
                url:"index.php?r=masterchasis/proses_delchasis",
                method:"POST",
                data:{idchasis: idchasis},
                beforeSend: function(){
                    $(".loader").show();
                },
                success:function(data){
                    var stat = $.parseJSON(data);
                    var statt = stat.status;
                    if(statt == "1"){
                        load_masterchasis();
                        Swal.fire({
                            title: 'Delete Success!',
                            icon: 'success',
                            confirmButtonText: 'Close'
                        });
                    } else {
                        Swal.fire({
                            title: 'Delete Failed!',
                            icon: 'error',
                            confirmButtonText: 'Close'
                        });
                    }
                },
                complete: function(){
                    $(".loader").hide();
                }
            });
        }
        });
});

$(document).on('click', '.form_edit_chasis', function(){
    var idchasis = $(this).attr('attr-idchasis');
    var idclass = $(this).attr('attr-idclass');
    var idmodel = $(this).attr('attr-idmodel');
    var idproduk = $(this).attr('attr-idproduk');
    var idtype = $(this).attr('attr-idtype');
    // load_formeditchasis(idchasis, idclass, idmodel, idproduk, idtype);

    $('#chasisModallLabel').text('Form edit chasis');
    $('#btnupdatechasis').removeClass('d-none');
    $('#btnsavechasis').addClass('d-none');
    $('#old_produk').removeClass('d-none');
    $('#chasisModal').modal('show');

    $.ajax({
        url:"index.php?r=masterchasis/detail_chasis",
        method:"POST",
        data:{
            idproduk:idproduk,
            idclass:idclass,
            idmodel: idmodel,
            idtype: idtype,
            idchasis: idchasis
        },
        success:function(data){
            var data = JSON.parse(data);
            $('#idchasis').val(data.IDCHASIS);
            $('#old_produk').text(data.NAMAPRODUK);
            $('#old_produk').val(data.IDPRODUK);
            $('#old_class').text(data.NAMACLASS);
            $('#old_class').val(data.IDCLASS);
            $('#old_model').text(data.NAMAMODEL);
            $('#old_model').val(data.IDMODEL);
            $('#old_type').val(data.IDTYPE);
            $('#old_type').text(data.NAMATYPE);
            $('#namachasis').val(data.NAMACHASIS);
        }
    });
});

$(document).on('click', '.updatemasterchasis', function(){
    
    var idproduk = $('#addproduk').val();
    var idmodel = $('#addmodel').val();
    var idtype = $('#addtype').val();
    var idclass = $('#addclass').val();
    var idchasis = $('#idchasis').val();
    var namachasis = $('#namachasis').val();
    $('#chasisModal').modal('hide');
    
    if(namachasis == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Nama Chasis Tidak Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else {
        let formData = new FormData();
        formData.append('idproduk', idproduk);
        formData.append('idmodel', idmodel);
        formData.append('idtype', idtype);
        formData.append('idclass', idclass);
        formData.append('idchasis', idchasis);
        formData.append('namachasis', namachasis);
        
        $.ajax({
            url:"index.php?r=masterchasis/proses_update_chasis",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
                $(".loader").show();
            },
            success:function(data){
                var stat = $.parseJSON(data);
                var statt = stat.status;
                if(statt == "1"){
                    load_masterchasis();
                    Swal.fire({
                        title: 'Update Success!',
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });
                } else {
                    Swal.fire({
                        title: 'Update Failed!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            },
            complete: function(){
                $(".loader").hide();
            }
        });
    } 
});

$(document).on('click', '.updatemasterproduk', function(){
    var idproduk = $('#idproduk').val();
    var namaproduk = $('#namaproduk').val();
    $('#produkModal').modal('hide');
    
    if(namaproduk == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Nama Produk Tidak Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else {
        let formData = new FormData();
        formData.append('idproduk', idproduk);
        formData.append('namaproduk', namaproduk);
        
        $.ajax({
            url:"index.php?r=masterproduk/proses_editproduk",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
                $(".loader").show();
            },
            success:function(data){
                var stat = $.parseJSON(data);
                var statt = stat.status;
                if(statt == "1"){
                    load_masterproduk();
                    Swal.fire({
                        title: 'Update Success!',
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });
                } else {
                    $('#produkModal').modal('hide');
                    Swal.fire({
                        title: 'Update Failed!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            },
            complete: function(){
                $(".loader").hide();
            }
        });
    } 
});

$(document).on('click', '.updatemasterclass', function(){
    var idproduk = $('#idproduk').val();
    var idclass = $('#idclass').val();
    var namaclass = $('#namaclass').val();
    $('#classModal').modal('hide');
    
    if(namaclass == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Nama Class Tidak Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else {
        let formData = new FormData();
        formData.append('idproduk', idproduk);
        formData.append('idclass', idclass);
        formData.append('namaclass', namaclass);
        $.ajax({
            url:"index.php?r=masterclass/proses_editclass",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
                $(".loader").show();
            },
            success:function(data){
                var stat = $.parseJSON(data);
                var statt = stat.status;
                if(statt == "1"){
                    load_masterclass();
                    Swal.fire({
                        title: 'Update Success!',
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });
                } else {
                    Swal.fire({
                        title: 'Update Failed!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            },
            complete: function(){
                $(".loader").hide();
            }
        });
    } 
});

$(document).on('click', '.updatemastermodel', function(){
    var idproduk = $('#addproduk').val();
    var idclass = $('#addclass').val();
    var idmodel = $('#idmodel').val();
    var namamodel = $('#namamodel').val();
    $('#modelModal').modal('hide');

    if(namamodel == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Nama Model Tidak Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else {
        let formData = new FormData();
        formData.append('idproduk', idproduk);
        formData.append('idclass', idclass);
        formData.append('idmodel', idmodel);
        formData.append('namamodel', namamodel);
        
        $.ajax({
            url:"index.php?r=mastermodel/proses_editmodel",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
                $(".loader").show();
            },
            success:function(data){
                var stat = $.parseJSON(data);
                var statt = stat.status;
                if(statt == "1"){
                    load_mastermodel();
                    Swal.fire({
                        title: 'Update Success!',
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });
                } else {
                    Swal.fire({
                        title: 'Update Failed!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            },
            complete: function(){
                $(".loader").hide();
            }
        });
    } 
});

$(document).on('click', '.updatemastertype', function(){
    var idproduk = $('#addproduk').val();
    var idclass = $('#addclass').val();
    var idmodel = $('#addmodel').val();
    var idtype = $('#idtype').val();
    var namatype = $('#namatype').val();
    $('#typeModal').modal('hide');

    if(namatype == ""){
        Swal.fire({
            title: 'Warning!',
            text: 'Nama Type Tidak Boleh Kosong!',
            icon: 'warning',
            confirmButtonText: 'Close'
        });
    } else {
        let formData = new FormData();
        formData.append('idproduk', idproduk);
        formData.append('idclass', idclass);
        formData.append('idmodel', idmodel);
        formData.append('idtype', idtype);
        formData.append('namatype', namatype);
        
        $.ajax({
            url:"index.php?r=mastertype/proses_edittype",
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            beforeSend: function(){
                $(".loader").show();
            },
            success:function(data){
                var stat = $.parseJSON(data);
                var statt = stat.status;
                if(statt == "1"){
                    load_mastertype();
                    Swal.fire({
                        title: 'Update Success!',
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });
                } else {
                    Swal.fire({
                        title: 'Update Failed!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            },
            complete: function(){
                $(".loader").hide();
            }
        });
    } 
});

$(document).on('click', '.deletemasterclassdata', function() {
    var idclass = $(this).attr('attr-idclass');

        Swal.fire({
            title: 'Anda yakin akan delete class ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Delete CLASS ini!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"index.php?r=masterclass/proses_deleteclass",
                    method: "POST",
                    data: {idclass: idclass},
                    beforeSend: function(){
                        $(".loader").show();
                    },
                    success: function(data){
                        var stat = $.parseJSON(data);
                        var statt = stat.status;
                        if(statt == "1"){
                            load_masterclass();
                            Swal.fire({
                            title: 'Delete Success!',
                            icon: 'success',
                            confirmButtonText: 'Close'
                        });
                        } else {
                            Swal.fire({
                            title: 'Delete Failed!',
                            icon: 'error',
                            confirmButtonText: 'Close'
                        });
                        }
                    },
                    complete: function(){
                        $(".loader").hide();
                    }
                })
            }
        })
})

$(document).on('click', '.deletemastermodeldata', function() {
    var idmodel = $(this).attr('attr-idmodel');

    Swal.fire({
        title: 'Anda yakin akan delete model ini?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Delete MODEL ini!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url:"index.php?r=mastermodel/proses_deletemodel",
                method: "POST",
                data: {idmodel: idmodel},
                beforeSend: function(){
                    $(".loader").show();
                },
                success: function(data){
                    var stat = $.parseJSON(data);
                    var statt = stat.status;
                    if(statt == "1"){
                        load_mastermodel();
                        Swal.fire({
                        title: 'Delete Success!',
                        icon: 'success',
                        confirmButtonText: 'Close'
                    });
                    } else {
                        Swal.fire({
                        title: 'Delete Failed!',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                    }
                },
                complete: function(){
                    $(".loader").hide();
                }
            })
        }
    })

})

$(document).on('click', '.deletemastertypedata', function() { 
    var idclass = $(this).attr('attr-idclass');

        Swal.fire({
            title: 'Anda yakin akan delete type ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Delete TYPE ini!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:"index.php?r=mastertype/proses_deletetype",
                    method: "POST",
                    data: {idtype: idclass},
                    beforeSend: function(){
                        $(".loader").show();
                    },
                    success: function(data){
                        var stat = $.parseJSON(data);
                        var statt = stat.status;
                        if(statt == "1"){
                            load_mastertype();
                            Swal.fire({
                            title: 'Delete Success!',
                            icon: 'success',
                            confirmButtonText: 'Close'
                        });
                        } else {
                            Swal.fire({
                            title: 'Delete Failed!',
                            icon: 'error',
                            confirmButtonText: 'Close'
                        });
                        }
                    },
                    complete: function(){
                        $(".loader").hide();
                    }
                })
            }
        })
})
/////////////////// ON CLICK ///////////////////