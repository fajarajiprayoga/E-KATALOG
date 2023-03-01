$(document).ready(function(){
       $(document).on('click', '.pag_next_onprogress', function(){
            var hal = document.getElementsByClassName("pg"); // untuk ambil nilai page sekarang
            var sort = $('input:radio[name=sort]:checked').val(); // untuk ambil nilai asc/sesc
            var sort_vebln = document.getElementById("sort_vebln").value ; // untuk ambil niai no order
            //var column = document.getElementById("column").value; // untuk ambil niai column
            var allrecords = $(this).attr('data-allrecords'); // untuk ambil atribut yg value nya count last record
            
            if(hal[0].innerHTML == allrecords){
                var page = allrecords;
            } else {
                var page = parseInt(hal[0].innerHTML)+1; // nilai page sekarang ditambah 1(next)
            }

            load_data_onprogress(page,sort,sort_vebln);
       });

       $(document).on('click', '.pag_prev_onprogress', function(){
            var hal = document.getElementsByClassName("pg"); // untuk ambil nilai page sekarang
            var sort = $('input:radio[name=sort]:checked').val(); // untuk ambil nilai asc/sesc
            var sort_vebln = document.getElementById("sort_vebln").value ; // untuk ambil niai no order
            //var column = document.getElementById("column").value; // untuk ambil niai column

            if(hal[0].innerHTML == 1){
                var page = 1;
            } else {
                var page = parseInt(hal[0].innerHTML)-1;
            }
            hal[0].innerHTML = page;

            load_data_onprogress(page,sort,sort_vebln);
       });

       $(document).on('click', '.pag_first_onprogress', function(){
            var hal = document.getElementsByClassName("pg"); // untuk ambil nilai page sekarang
            var sort = $('input:radio[name=sort]:checked').val(); // untuk ambil nilai asc/sesc
            var sort_vebln = document.getElementById("sort_vebln").value ; // untuk ambil niai no order
            //var column = document.getElementById("column").value; // untuk ambil niai column

            var page = 1;
            hal[0].innerHTML = page;

            load_data_onprogress(page,sort,sort_vebln);
       });

       $(document).on('click', '.pag_last_onprogress', function(){
            var hal = document.getElementsByClassName("pg"); // untuk ambil nilai page sekarang
            var sort = $('input:radio[name=sort]:checked').val(); // untuk ambil nilai asc/sesc
            var sort_vebln = document.getElementById("sort_vebln").value ; // untuk ambil niai no order
            //var column = document.getElementById("column").value; // untuk ambil niai column
            var allrecords = $(this).attr('data-allrecords'); // untuk ambil atribut yg value nya count last record

            hal[0].innerHTML = allrecords; // untuk mengubah angka page ketika button di klik

            load_data_onprogress(allrecords,sort,sort_vebln);
       });

       $(document).on('click', '.pag_sort_onprogress', function(){
            var sort = $('input:radio[name=sort]:checked').val(); // untuk ambil nilai asc/sesc
            var sort_vebln = document.getElementById("sort_vebln").value ; // untuk ambil niai no order
            //var column = document.getElementById("column").value; // untuk ambil niai column
            var page = 1;

            load_data_onprogress(page,sort,sort_vebln);
       });
    });