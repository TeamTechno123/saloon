<!DOCTYPE html>
<html>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12 text-center mt-2">
            <h1>Package</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8 offset-md-2">
            <!-- general form elements -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Add Package</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="m-0 input_form" id="form_action" role="form" action="" method="post">
                <div class="card-body row">
                  <div class="col-md-12 ">
                    <div class="row">
                      <div class="form-group col-md-12">
                        <label>Package Name</label>
                        <input type="text" class="form-control form-control-sm" name="package_name" id="package_name" value="<?php if(isset($package_info['package_name'])){ echo $package_info['package_name']; } ?>" placeholder="" required>
                      </div>
                      <div class="form-group col-md-12">
                        <label>Package Description</label>
                      <textarea name="package_desc" id="package_desc" class="form-control" rows="3" cols="90" required><?php if(isset($package_info['package_desc'])){ echo $package_info['package_desc']; } ?></textarea>
                    </div>
                      <div class="form-group col-md-12">
                        <label>Package Price</label>
                        <input type="text" class="form-control form-control-sm" name="package_price" id="package_price" value="<?php if(isset($package_info['package_price'])){ echo $package_info['package_price']; } ?>" placeholder="" required>
                      </div>
                </div>
              </div>
            </div>
                <div class="card-footer row m-0">
                  <div class="col-md-2">
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="package_status1" name="package_status" value="1" <?php if(isset($package_info['package_status']) && $package_info['package_status'] == '1'){ echo 'checked'; } elseif (!isset($package_info['package_status'])) { echo 'checked'; } ?>>
                      <label for="package_status1" class="custom-control-label">Active</label>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="package_status0" name="package_status" value="0" <?php if(isset($package_info['package_status']) && $package_info['package_status'] == '0'){ echo 'checked'; }  ?>>
                      <label for="package_status0" class="custom-control-label">Inactive</label>
                    </div>
                  </div>
                  <div class="col-md-8 text-right">
                    <?php if(isset($update)){ ?>
                      <button id="btn_update" type="submit" class="btn btn-primary">Update </button>
                    <?php } else{ ?>
                      <button id="btn_save" type="submit" class="btn btn-success px-4">Save</button>
                    <?php } ?>
                    <a href="<?php echo base_url() ?>User/customer_list" class="btn btn-default ml-4">Cancel</a>
                  </div>
                </div>
              </form>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">
// Check Package Name Duplication..
  var package_name1 = $('#package_name').val();
  $('#package_name').on('change',function(){
    var package_name = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>User/check_duplication',
      type: 'POST',
      data: {"column_name":"package_name",
             "column_val":package_name,
             "table_name":"package"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#package_name').val(package_name1);
          toastr.error(package_name+' Exist.');
        }
      }
    });
  });
</script>
</body>
</html>
