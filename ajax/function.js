/////////////////// FUNCTION ///////////////////
function load_authotp()
{
    $.ajax({
        url:"index.php?r=first",
        method:"POST",
        data:{},
        beforeSend: function(){
         $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
         $(".loader").hide();
        }
    });
}

function load_beranda()
{
    $.ajax({
        url:"index.php?r=home",
        method:"POST",
        data:{},
        beforeSend: function(){
         $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
         $(".loader").hide();
        }
    });
}

function load_second(dir)
{
    $.ajax({
        url:"index.php?r=second",
        method:"POST",
        data:{dir:dir},
        beforeSend: function(){
         $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}
function load_openpdf(namefile,dir)
{
    $.ajax({
        url:"index.php?r=openpdf",
        method:"POST",
        data:{namefile:namefile,dir:dir},
        beforeSend: function(){
         $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
         $(".loader").hide();
        }
    });
}

function load_getotp()
{
    $.ajax({
        url:"index.php?r=first/getotp",
        method:"POST",
        data:{},
        beforeSend: function(){
         $(".loader").show();
        },
        success:function(data){
            var stat = $.parseJSON(data);
            var statt = stat.status;

            if(statt == '1'){
                Swal.fire({
                    title: 'Gagal mengirim code OTP!',
                    icon: 'error',
                    confirmButtonText: 'Close'
                });
            } else if (statt == '0') {
                Swal.fire({
                    title: 'Gagal mengirim code OTP!',
                    text: 'Email anda belum terdaftar',
                    icon: 'error',
                    confirmButtonText: 'Close'
                });
            } else if (statt == '2') {
                Swal.fire({
                    title: 'Code OTP berhasil dikirim ke email anda',
                    icon: 'success',
                    confirmButtonText: 'Close'
                });
                setTimeout(function(){
                    window.location.reload();
                }, 1500);
            }  else {
                Swal.fire({
                    title: 'Gagal mengirim code OTP!',
                    icon: 'error',
                    confirmButtonText: 'Close'
                });
            }
        },
        error:function () {
            Swal.fire({
                title: 'Gagal Mengirim Code OTP!',
                text: 'Segera hubungi Dept IT!',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        },
        complete: function(){
         $(".loader").hide();
        }
    });
}

function load_cekotp(otpuser)
{
    $.ajax({
        url:"index.php?r=first/cekotp",
        method:"POST",
        data:{otpuser:otpuser},
        beforeSend: function(){
         $(".loader").show();
        },
        success:function(data){
            var stat = $.parseJSON(data);
            var statt = stat.status;
            var content = stat.content;

            if (statt == '0') {
                Swal.fire({
                    title: 'Gagal Login!',
                    text: 'Code OTP Salah!',
                    icon: 'error',
                    confirmButtonText: 'Close'
                });
            } else if(statt == '1'){
                Swal.fire({
                    title: 'Gagal Login!',
                    text: 'Code OTP Sudah Expired',
                    icon: 'error',
                    confirmButtonText: 'Close'
                });
                //window.location.reload();
            } else if(statt == '2'){
                Swal.fire({
                    title: 'Login Berhasil!',
                    icon: 'success',
                    confirmButtonText: 'Close'
                });
                window.location.reload();
            } else {
                Swal.fire({
                    title: 'Gagal Login!',
                    icon: 'error',
                    confirmButtonText: 'Close'
                });
            }
        },
        error:function () {
            Swal.fire({
                title: 'Gagal Mengirim Code OTP!',
                text: 'Segera hubungi Dept IT!',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        },
        complete: function(){
         $(".loader").hide();
        }
    });
}

function load_activity()
{
    $.ajax({
        url:"index.php?r=activity",
        method:"POST",
        data:{},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_whopdf()
{
    $.ajax({
        url:"index.php?r=activity/whopdf",
        method:"POST",
        data:{},
        beforeSend: function(){
            $(".activityloader").show();
        },
        success:function(data){
            $('#activitycontent').html(data);
        },
        complete: function(){
            $(".activityloader").hide();
        }
    });
}

function load_whologgin()
{
    $.ajax({
        url:"index.php?r=activity/whologgin",
        method:"POST",
        data:{},
        beforeSend: function(){
            $(".activityloader").show();
        },
        success:function(data){
            $('#activitycontent').html(data);
        },
        complete: function(){
            $(".activityloader").hide();
        }
    });
}

function load_whogetotp()
{
    $.ajax({
        url:"index.php?r=activity/whogetotp",
        method:"POST",
        data:{},
        beforeSend: function(){
            $(".activityloader").show();
        },
        success:function(data){
            $('#activitycontent').html(data);
        },
        complete: function(){
            $(".activityloader").hide();
        }
    });
}

function load_uploadfile()
{
    $.ajax({
        url:"index.php?r=uploadfile",
        method:"POST",
        data:{},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_masteruser()
{
    $.ajax({
        url:"index.php?r=masteruser",
        method:"POST",
        data:{},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_masterproduk()
{
    $.ajax({
        url:"index.php?r=masterproduk",
        method:"POST",
        data:{},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#produkModal').modal('hide');
            $('#content').html(data);
        },
        complete: function(){
            $('#produkModal').modal('hide');
            $(".loader").hide();
        }
    });
}

function load_proses_addproduk(namaproduk)
{
    $.ajax({
        url:"index.php?r=masterproduk/proses_addproduk",
        method:"POST",
        data:{namaproduk:namaproduk},
        beforeSend: function(){
            $('#produkModal').modal('hide');
            $(".loader").show();
        },
        success:function(response){
            var stat = $.parseJSON(response);
            var statt = stat.status; 
            if(statt == '1'){
                load_masterproduk();
                Swal.fire({
                    title: 'Add Success!',
                    icon: 'success',
                    confirmButtonText: 'Close'
                });   
            } else{
                Swal.fire({
                    title: 'Add Failed!',
                    icon: 'error',
                    confirmButtonText: 'Close'
                });
            }
        },
        error: function(response){
            Swal.fire({
                title: 'Failed!',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        },
        complete: function(){
         $('#produkModal').modal('hide');
         $(".loader").hide();
        }
    });
}

function load_masterclass()
{
    $.ajax({
        url:"index.php?r=masterclass",
        method:"POST",
        data:{},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_proses_addclass(namaclass, idproduk)
{
    $.ajax({
        url:"index.php?r=masterclass/proses_addclass",
        method:"POST",
        data:{namaclass:namaclass, idproduk:idproduk},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(response){
            var stat = $.parseJSON(response);
            var statt = stat.status; 
            if(statt == '1'){
                load_masterclass();
                Swal.fire({
                    title: 'Add Success!',
                    icon: 'success',
                    confirmButtonText: 'Close'
                });   
            } else{
                Swal.fire({
                    title: 'Add Failed!',
                    icon: 'error',
                    confirmButtonText: 'Close'
                });
            }
        },
        error: function(response){
            Swal.fire({
                title: 'Failed!',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        },
        complete: function(){
         $(".loader").hide();
        }
    });
}

function load_mastermodel()
{
    $.ajax({
        url:"index.php?r=mastermodel",
        method:"POST",
        data:{},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_proses_addmodel(tumpuk)
{
    $('#modelModal').modal('hide');
    $.ajax({
        url:"index.php?r=mastermodel/proses_addmodel",
        method:"POST",
        data:{tumpuk:tumpuk},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(response){
            var stat = $.parseJSON(response);
            var statt = stat.status;
            var totalData = stat.data;
            if(statt == '1'){
                load_mastermodel();
                Swal.fire({
                    title: 'Add Success!',
                    icon: 'success',
                    confirmButtonText: 'Close'
                });   
            } else{
                Swal.fire({
                    title: 'Add Failed!',
                    icon: 'error',
                    confirmButtonText: 'Close'
                });
            }
        },
        error: function(response){
            Swal.fire({
                title: 'Failed!',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        },
        complete: function(){
         $(".loader").hide();
        }
    });
}

function load_mastertype()
{
    $.ajax({
        url:"index.php?r=mastertype",
        method:"POST",
        data:{},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_proses_addtype(tumpuk)
{
    $.ajax({
        url:"index.php?r=mastertype/proses_addtype",
        method:"POST",
        data:{tumpuk:tumpuk},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(response){
            var stat = $.parseJSON(response);
            var statt = stat.status;
            var totalData = stat.data;
            if(statt == '1'){
                load_mastertype();
                Swal.fire({
                    title: 'Add Success!',
                    icon: 'success',
                    confirmButtonText: 'Close'
                });   
            } else{
                Swal.fire({
                    title: 'Add Failed!',
                    icon: 'error',
                    confirmButtonText: 'Close'
                });
            }
        },
        error: function(response){
            Swal.fire({
                title: 'Failed!',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        },
        complete: function(){
         $(".loader").hide();
        }
    });
}

function load_masterchasis()
{
    $.ajax({
        url:"index.php?r=masterchasis",
        method:"POST",
        data:{},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_proses_addchasis(tumpuk)
{
    $.ajax({
        url:"index.php?r=masterchasis/proses_addchasis",
        method:"POST",
        data:{tumpuk:tumpuk},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(response){
            var stat = $.parseJSON(response);
            var statt = stat.status;
            var totalData = stat.data;
            if(statt == '1'){
                load_masterchasis();
                Swal.fire({
                    title: 'Add Success!',
                    icon: 'success',
                    confirmButtonText: 'Close'
                });   
            } else{
                Swal.fire({
                    title: 'Add Failed!',
                    icon: 'error',
                    confirmButtonText: 'Close'
                });
            }
        },
        error: function(response){
            Swal.fire({
                title: 'Failed!',
                icon: 'error',
                confirmButtonText: 'Close'
            });
        },
        complete: function(){
         $(".loader").hide();
        }
    });
}

function load_skrb(idchasis, produk, clas, model, chasis, type)
{
    $.ajax({
        url:"index.php?r=skrb",
        method:"POST",
        data:{idchasis:idchasis, produk:produk, clas:clas, model:model, chasis:chasis, type:type},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_formskrb(idchasis, dept, produk, clas, model, chasis, type)
{
    $.ajax({
        url:"index.php?r=skrb/form_skrb",
        method:"POST",
        data:{idchasis:idchasis, dept:dept, produk:produk, clas:clas, model:model, chasis:chasis, type:type},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function proses_upload_skrb(formData)
{
   $.ajax({
        url:"index.php?r=skrb/proses_upload_skrb",
        method:"POST",
        data:{formData:formData},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_formeditskrb(idchasis, dept, produk, clas, model, chasis, type, idskrbsales)
{
    $.ajax({
        url:"index.php?r=skrb/form_edit_skrb",
        method:"POST",
        data:{idchasis:idchasis, dept:dept,  produk:produk, clas:clas, model:model, chasis:chasis, type:type, idskrbsales:idskrbsales},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_formeditproduk(idproduk)
{
    $.ajax({
        url:"index.php?r=masterproduk/form_editproduk",
        method:"POST",
        data:{idproduk:idproduk},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_formeditclass(idproduk, idclass)
{
    $.ajax({
        url:"index.php?r=masterclass/form_editclass",
        method:"POST",
        data:{idproduk: idproduk, idclass: idclass},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_formeditmodel(idproduk, idclass, idmodel)
{
    $.ajax({
        url:"index.php?r=mastermodel/form_editmodel",
        method:"POST",
        data:{idproduk: idproduk, idclass: idclass, idmodel},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_formedittype(idproduk, idclass, idmodel, idtype)
{
    $.ajax({
        url:"index.php?r=mastertype/form_edittype",
        method:"POST",
        data:{idproduk: idproduk, idclass: idclass, idmodel: idmodel, idtype: idtype},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_drawing(idchasis, produk, clas, model, chasis, type)
{
    $.ajax({
        url:"index.php?r=drawing",
        method:"POST",
        data:{idchasis:idchasis, produk:produk, clas:clas, model:model, chasis:chasis, type:type},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_formdrawing(idchasis, dept, produk, clas, model, chasis, type)
{
    $.ajax({
        url:"index.php?r=drawing/form_drawing",
        method:"POST",
        data:{idchasis:idchasis, dept:dept, produk:produk, clas:clas, model:model, chasis:chasis, type:type},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_formeditdrawing(idchasis, dept, produk, clas, model, chasis, type, iddrawingeng)
{
    $.ajax({
        url:"index.php?r=drawing/form_edit_drawing",
        method:"POST",
        data:{idchasis:idchasis, dept:dept,  produk:produk, clas:clas, model:model, chasis:chasis, type:type, iddrawingeng:iddrawingeng},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_design(idchasis, produk, clas, model, chasis, type)
{
    $.ajax({
        url:"index.php?r=design",
        method:"POST",
        data:{idchasis:idchasis, produk:produk, clas:clas, model:model, chasis:chasis, type:type},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_formdesign(idchasis, dept, produk, clas, model, chasis, type)
{
    $.ajax({
        url:"index.php?r=design/form_design",
        method:"POST",
        data:{idchasis:idchasis, dept:dept, produk:produk, clas:clas, model:model, chasis:chasis, type:type},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_formeditdesign(idchasis, dept, produk, clas, model, chasis, type, iddesign)
{
    $.ajax({
        url:"index.php?r=design/form_edit_design",
        method:"POST",
        data:{idchasis:idchasis, dept:dept,  produk:produk, clas:clas, model:model, chasis:chasis, type:type, iddesign:iddesign},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_iws(idchasis, produk, clas, model, chasis, type)
{
    $.ajax({
        url:"index.php?r=iws",
        method:"POST",
        data:{idchasis:idchasis, produk:produk, clas:clas, model:model, chasis:chasis, type:type},
        beforeSend: function(){
            $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
            $(".loader").hide();
        }
    });
}

function load_formeditchasis(idchasis, idclass, idmodel, idproduk, idtype)
{
    $.ajax({
        url:"index.php?r=masterchasis/form_edit_chasis",
        method:"POST",
        data:{idchasis: idchasis, idclass: idclass, idmodel: idmodel, idproduk: idproduk, idtype: idtype},
        beforeSend: function(){
         $(".loader").show();
        },
        success:function(data){
            $('#content').html(data);
        },
        complete: function(){
         $(".loader").hide();
        }
    });
}
/////////////////// FUNCTION ///////////////////