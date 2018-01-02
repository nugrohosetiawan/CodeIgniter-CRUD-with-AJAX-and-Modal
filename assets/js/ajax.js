var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;

manageData();

/* manage data list */
function manageData() {
   $.ajax({
      dataType: 'json',
      url: url,
      data: {page:page}
    }).done(function(data){

       total_page = data.total % 10;
       current_page = page;

       $('#pagination').twbsPagination({
            totalPages: total_page,
            visiblePages: current_page,
            onPageClick: function (event, pageL) {

                page = pageL;

                if(is_ajax_fire != 0){
                   getPageData();
                }
            }
        });

        manageRow(data.data);

        is_ajax_fire = 1;

   });
}

/* Get Page Data*/
function getPageData() {

    $.ajax({
       dataType: 'json',
       url: url,
       data: {page:page}
	}).done(function(data){

       manageRow(data.data);

    });

}

/* Add new Item table row */
function manageRow(data) {

    var	rows = '';

    $.each( data, function( key, value ) {

        rows = rows + '<tr>';
        rows = rows + '<td>'+value.nama+'</td>';
        rows = rows + '<td>'+value.deskripsi+'</td>';
        rows = rows + '<td>'+value.lokasi+'</td>';
        rows = rows + '<td>'+value.gambar+'</td>';
        rows = rows + '<td>'+value.kategori+'</td>';
        rows = rows + '<td>'+value.status+'</td>';
        rows = rows + '<td data-id="'+value.id_des+'">';
        rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';
        rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
        rows = rows + '</td>';
        rows = rows + '</tr>';

    });

    $("tbody").html(rows);

}

/* Create new Item */
$(".crud-submit").click(function(e){

    e.preventDefault();

    var form_action = $("#create-item").find("form").attr("action");
    var nama = $("#create-item").find("input[name='nama']").val();
    var deskripsi = $("#create-item").find("textarea[name='deskripsi']").val();
    var lokasi = $("#create-item").find("textarea[name='lokasi']").val();
    var gambar = $("#create-item").find("textarea[name='gambar']").val();
    var kategori = $("#create-item").find("textarea[name='kategori']").val();
    var status = $("#create-item").find("textarea[name='status']").val();

    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
        data:{nama:nama, deskripsi:deskripsi, lokasi:lokasi, gambar:gambar, kategori:kategori
        status:status}
    }).done(function(data){

        getPageData();
        $(".modal").modal('hide');
        toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});

    });

});

/* Remove Item */
$("body").on("click",".remove-item",function(){

    var id = $(this).parent("td").data('id_des');
    var c_obj = $(this).parents("tr");

    $.ajax({
        dataType: 'json',
        type:'delete',
        url: url + '/' + id,
    }).done(function(data){

        c_obj.remove();
        toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
        getPageData();

    });

});

/* Edit Item */
$("body").on("click",".edit-item",function(){

    var id = $(this).parent("td").data('id');
    var nama = $(this).parent("td").prev("td").prev("td").text();
    var deskripsi = $(this).parent("td").prev("td").text();
    var lokasi = $(this).parent("td").prev("td").text();
    var gambar = $(this).parent("td").prev("td").text();
    var kategori = $(this).parent("td").prev("td").text();
    var status = $(this).parent("td").prev("td").text();


    $("#edit-item").find("input[name='nama']").val(title);
    $("#edit-item").find("textarea[name='deskripsi']").val(description);
    $("#edit-item").find("textarea[name='lokasi']").val(description);
    $("#edit-item").find("textarea[name='gambar']").val(description);
    $("#edit-item").find("textarea[name='kategori']").val(description);
    $("#edit-item").find("textarea[name='status']").val(description);
    $("#edit-item").find("form").attr("action",url + '/update/' + id);

});

/* Updated new Item */
$(".crud-submit-edit").click(function(e){

    e.preventDefault();

    var form_action = $("#edit-item").find("form").attr("action");
    var nama = $("#edit-item").find("input[name='title']").val();
    var deskripsi = $("#edit-item").find("textarea[name='description']").val();

    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
        data:{title:title, description:description}
    }).done(function(data){

        getPageData();
        $(".modal").modal('hide');
        toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});

    });

});