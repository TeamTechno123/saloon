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
            <h1>Product / Service</h1>
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
                <h3 class="card-title">Add Product / Service </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="m-0 input_form" id="form_action" role="form" action="" method="post">
                <div class="card-body row">
                  <div class="col-md-12 ">
                    <div class="row">

                      <div class="form-group col-md-12 select_sm">
                        <label>Select Type</label>
                        <select class="form-control select2" name="item_group_id" id="item_group_id" data-placeholder="Select Account Group" required>
                          <option value="">Select Type</option>
                        </select>
                      </div>

                      <div class="form-group col-md-12">
                        <label>Product / Service Name</label>
                        <input type="text" class="form-control form-control-sm" name="customer_company" id="customer_company" value="<?php if(isset($customer_company)){ echo $customer_company; } ?>" placeholder="" required>
                      </div>

                      <div class="form-group col-md-6">
                        <label>Quantity</label>
                        <input type="text" class="form-control form-control-sm" name="customer_company" id="customer_company" value="<?php if(isset($customer_company)){ echo $customer_company; } ?>" placeholder="" required>
                      </div>

                      <div class="form-group col-md-6 select_sm">
                        <label>Select Unit</label>
                        <select class="form-control select2" name="item_group_id" id="item_group_id" data-placeholder="Select Account Group" required>
                          <option value="">Select Unit</option>
                        </select>
                      </div>

                      <div class="form-group col-md-6">
                        <label>Rate</label>
                        <input type="text" class="form-control form-control-sm" name="customer_company" id="customer_company" value="<?php if(isset($customer_company)){ echo $customer_company; } ?>" placeholder="" required>
                      </div>

                      <div class="form-group col-md-12">
                        <label>Package Price</label>
                        <input type="text" class="form-control form-control-sm" name="customer_company" id="customer_company" value="<?php if(isset($customer_company)){ echo $customer_company; } ?>" placeholder="" required>
                      </div>
                </div>
                <div class="card-footer row">
                  <div class="col-md-6">
                    <div class="custom-control custom-checkbox ml-2">
                      <input class="custom-control-input" type="checkbox" name="customer_status" id="customer_status" value="1" checked>
                      <label for="customer_status" class="custom-control-label">Active</label>
                    </div>
                  </div>
                  <div class="col-md-6 text-right">
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
          </div>
          <!--/.col (left) -->
          <!-- right column -->
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">
// Check Mobile Duplication..
  var customer_mobile1 = $('#customer_mobile').val();
  $('#customer_mobile').on('change',function(){
    var customer_mobile = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>User/check_duplication',
      type: 'POST',
      data: {"column_name":"customer_mobile",
             "column_val":customer_mobile,
             "table_name":"user"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#customer_mobile').val(customer_mobile1);
          toastr.error(customer_mobile+' Mobile No Exist.');
        }
      }
    });
  });

// Check Email Duplication..
  var customer_email1 = $('#mobile').val();
  $('#customer_email').on('change',function(){
    var customer_email = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>User/check_duplication',
      type: 'POST',
      data: {"column_name":"customer_email",
             "column_val":customer_email,
             "table_name":"user"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#customer_email').val(customer_email1);
          toastr.error(customer_email+' Email Id Exist.');
        }
      }
    });
  });
</script>
</body>
</html>
