$(document).ready(function(){
       $(document).on('click', '.pagination_next_new', function(){
            var hal = document.getElementsByClassName("pg_new"); // untuk ambil nilai page sekarang
            var sort_new = $('input:radio[name=sort_new]:checked').val(); // untuk ambil nilai asc/sesc
            var sort_vebln_new = document.getElementById("sort_vebln_new").value; // untuk ambil niai no order
            //var column_new = document.getElementById("column_new").value; // untuk ambil niai column
            var allrecords_new = $(this).attr('data-allrecords_new'); // untuk ambil atribut yg value nya count last record
            
            if(hal[0].innerHTML == allrecords_new){
                var page_new = allrecords_new;
            } else {
                var page_new = parseInt(hal[0].innerHTML)+1; // nilai page sekarang ditambah 1(next)
            }

            load_data_new(page_new,sort_new,sort_vebln_new);
       });

       $(document).on('click', '.pagination_prev_new', function(){
            var hal = document.getElementsByClassName("pg_new"); // untuk ambil nilai page sekarang
            var sort_new = $('input:radio[name=sort_new]:checked').val(); // untuk ambil nilai asc/sesc
            var sort_vebln_new = document.getElementById("sort_vebln_new").value ; // untuk ambil niai no order
            //var column_new = document.getElementById("column_new").value; // untuk ambil niai column

            if(hal[0].innerHTML == 1){
                var page_new = 1;
            } else {
                var page_new = parseInt(hal[0].innerHTML)-1;
            }
            hal[0].innerHTML = page_new;

            load_data_new(page_new,sort_new,sort_vebln_new);
       });

       $(document).on('click', '.pagination_first_new', function(){
            var hal = document.getElementsByClassName("pg_new"); // untuk ambil nilai page sekarang
            var sort_new = $('input:radio[name=sort_new]:checked').val(); // untuk ambil nilai asc/sesc
            var sort_vebln_new = document.getElementById("sort_vebln_new").value ; // untuk ambil niai no order
            //var column_new = document.getElementById("column_new").value; // untuk ambil niai column

            var page_new = 1;
            hal[0].innerHTML = page_new;

            load_data_new(page_new,sort_new,sort_vebln_new);
       });

       $(document).on('click', '.pag_last_new', function(){
            var hal = document.getElementsByClassName("pg_new"); // untuk ambil nilai page sekarang
            var sort_new = $('input:radio[name=sort_new]:checked').val(); // untuk ambil nilai asc/sesc
            var sort_vebln_new = document.getElementById("sort_vebln_new").value ; // untuk ambil niai no order
            //var column_new = document.getElementById("column_new").value; // untuk ambil niai column
            var allrecords_new = $(this).attr('data-allrecords_new'); // untuk ambil atribut yg value nya count last record

            hal[0].innerHTML = allrecords_new; // untuk mengubah angka page ketika button di klik

            load_data_new(allrecords_new,sort_new,sort_vebln_new);
       });

       $(document).on('click', '.pagination_sort_new', function(){
            var sort_new = $('input:radio[name=sort_new]:checked').val(); // untuk ambil nilai asc/sesc
            var sort_vebln_new = document.getElementById("sort_vebln_new").value ; // untuk ambil niai no order
            //var column_new = document.getElementById("column_new").value; // untuk ambil niai column
            var page_new = 1;

            load_data_new(page_new,sort_new,sort_vebln_new);
       });

       $(document).on('click', '.pagination_clear_new', function(){
            document.getElementById("sort_vebln_new").value=""; //mengkosongkan input no order
            //document.getElementById("column_new").value=""; // mengkosongkan select kolom
            var sort_new = document.getElementsByName('sort_new');
            sort_new[0].checked = true; // memindah checked treu ke DESC
            load_data_new();

       });
    });