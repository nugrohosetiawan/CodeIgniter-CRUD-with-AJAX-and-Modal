  <!-- /.row -->
  <?php
$this->load->view('template/head');
?>

<!--tambahkan custom css disini-->
<!-- iCheck -->

<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<!-- Morris chart -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">

  <!-- Ionicons -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
<!-- bootstrap wysihtml5 - text editor -->

<link  href="<?php echo base_url('assets/AdminLTE-2.0.5/dist/css/skins/_all-skins.min.css')?>"  rel="stylesheet" type="text/css" />
<link  href="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />

<link href="<?php echo base_url('assets/AdminLTE-2.0.5/datatables/css/dataTables.bootstrap.css')?>" rel="stylesheet">

<?php
$this->load->view('template/topbar');

$this->load->view('template/sidebar');
?>
     <div class="container">
    <h1>Kelola Lokasi Wisata's</h1>
</center>
    
    
    <br />
    <div class="box">
        <div class="box-header">
               <button class="btn btn-success" onclick="add_des()"><i class="glyphicon glyphicon-plus"></i> Tambah Destinasi</button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Deskripsi</th>
          <th>Lokasi</th>
          <th>Gambar</th>
          <th>Kategori</th>
          <th>Status</th>

          <th style="width:125px;">Action
          </p></th>
        </tr>
      </thead>
      <tbody>
          <?php foreach($h->result() as $row){?>
                 <td><?php echo $row->nama;?></td>
                 <td><?php echo $row->deskripsi;?></td>
                 <td><?php echo $row->lokasi;?></td>
                 <td><?php echo $row->gambar;?></td>
                <td><?php echo $row->kategori;?></td>
                <td><?php echo $row->stat;?></td>
                
                <td>
                  <button class="btn btn-warning" onclick="desti_edit(<?php echo $row->id_des;?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                  <button class="btn btn-danger" onclick="delete_des(<?php echo $row->id_des;?>)"><i class="glyphicon glyphicon-remove"></i></button>

             
                </td>
              </tr>
             
<?php }?>

      </tbody>

      
    </table>

  </div>
  </div>
  </div>


  


  <script type="text/javascript">

 
  $(document).ready( function () {

     $("#upload").on('change', prePareUpload);        
   
  } );
    var save_method; //for save method string
    var table;

    

    function add_des()
    {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Tambah Destinasi'); // Set Title to Bootstrap modal title
      $('#photo-preview').hide(); // hide photo preview modal
      $('#label-photo').text('Upload Photo'); // label photo upload
    }

    function desti_edit(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
     $('.help-block').empty(); // clear error string

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('destinasi/des_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id_des"]').val(data.id_des); 
            $('[name="nama"]').val(data.nama);
            $('[name="deskripsi"]').val(data.deskripsi);
            $('[name="lokasi"]').val(data.lokasi);
            $('[name="gambar"]').val(data.gambar);
            $('[name="kategori"]').val(data.kategori);
            $('[name="stat"]').val(data.stat);


            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Destination'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
    }
   

   

    function save()
    {
       $('#btnSave').text('saving...'); //change button text
       $('#btnSave').attr('disabled',true); //set button disable 
      var url;
      if(save_method == 'add')
      {
          url = "<?php echo site_url('destinasi/des_add')?>";
      }
      else
      {
          url = "<?php echo site_url('destinasi/des_update')?>";
      }

       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               if(data.status)
               {
               toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
              location.reload();// for reload a page

            }
            
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable
          },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
 
            }
        });
    }
  

    function delete_des(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "<?php echo site_url('destinasi/des_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               
               location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

      }
    }

  </script>

  <!-- Bootstrap modal -->
  <div class="modal fade" id="modal_form" action=""<?= base_url('destination/des_add'); ?>"  method="post" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Add destination</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="id_des"/>
          <div class="form-body">
            <div class="form-group">
              <label class="control-label col-md-3">Nama</label>
              <div class="col-md-9">
                <input name="nama" placeholder="Nama" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Deskripsi</label>
              <div class="col-md-9">
                <input name="deskripsi" placeholder="Deskripsi" class="form-control" type="text">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3">Lokasi</label>
              <div class="col-md-9">
                <input name="lokasi" placeholder="Lokasi" class="form-control" type="text">

              </div>
            </div>
             <div class="form-group" id="photo-preview">
                            <label class="control-label col-md-3">Photo</label>
                            <div class="col-md-9">
                                (No photo)
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" id="label-photo">Upload Photo </label>
                            <div class="col-md-9">
                                <input name="gambar" type="file" id="image_file">
                                <span class="help-block"></span>
                            </div>
                        </div>
             <div class="form-group">
              <label class="control-label col-md-3">Kategori</label>
              <div class="col-md-9">
                <input name="kategori" placeholder="Kategori" class="form-control" type="text">

              </div>
            </div>
             <div class="form-group">
              <label class="control-label col-md-3">Status</label>
              <div class="col-md-9">
                <input name="stat" placeholder="Status" class="form-control" type="text">

              </div>
            </div>

          </div>
        </form>
          </div>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">


      <?php
$this->load->view('template/js');
?>

<!--tambahkan custom js disini-->
<!-- jQuery UI 1.11.2 -->
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Morris.js charts -->
<script src="<?php echo base_url('assets/js/raphael-min.js') ?>"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/morris/morris.min.js') ?>" type="text/javascript"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/sparkline/jquery.sparkline.min.js') ?>" type="text/javascript"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/knob/jquery.knob.js') ?>" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/daterangepicker/daterangepicker.js') ?>" type="text/javascript"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/datepicker/bootstrap-datepicker.js') ?>" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>" type="text/javascript"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/iCheck/icheck.min.js') ?>" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/pages/dashboard.js') ?>" type="text/javascript"></script>

<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/demo.js') ?>" type="text/javascript"></script>

<?php
$this->load->view('template/foot');
?>