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
            <h1>Customer</h1>
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
                <h3 class="card-title">Add Customer</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="m-0 input_form" id="form_action" role="form" action="" method="post">
                <div class="card-body row">
                  <div class="col-md-12 ">
                    <div class="row">
                      <div class="form-group col-md-12">
                        <label>Customer Name</label>
                        <input type="text" class="form-control form-control-sm" name="customer_name" id="customer_name" value="<?php if(isset($customer_info['customer_name'])){ echo $customer_info['customer_name']; } ?>" placeholder="" required>
                      </div>
                      <div class="form-group col-md-12">
                        <label>Customer Address</label>
                        <textarea name="customer_addr" id="customer_addr" class="form-control" rows="3" cols="90" required><?php if(isset($customer_info['customer_addr'])){ echo $customer_info['customer_addr']; } ?></textarea>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Mobile No. 1</label>
                        <input type="number" class="form-control form-control-sm" name="customer_mob1" id="customer_mob1" value="<?php if(isset($customer_info['customer_mob1'])){ echo $customer_info['customer_mob1']; } ?>" placeholder="" required>
                      </div>
                      <div class="form-group col-md-6">
                        <label>Mobile No. 2</label>
                        <input type="number" class="form-control form-control-sm" name="customer_mob2" id="customer_mob2" value="<?php if(isset($customer_info['customer_mob2'])){ echo $customer_info['customer_mob2']; } ?>" placeholder="" >
                      </div>
                      <div class="form-group col-md-6">
                        <label>Email</label>
                        <input type="email" class="form-control form-control-sm" name="customer_email" id="customer_email" value="<?php if(isset($customer_info['customer_email'])){ echo $customer_info['customer_email']; } ?>" placeholder="" >
                      </div>
                      <div class="form-group col-md-6">
                        <label>Website</label>
                        <input type="text" class="form-control form-control-sm" name="customer_website" id="customer_website" value="<?php if(isset($customer_info['customer_website'])){ echo $customer_info['customer_website']; } ?>" placeholder="" >
                      </div>
                      <div class="form-group col-md-6">
                        <label>Birthdate</label>
                        <input type="text" class="form-control form-control-sm" name="customer_birthdate" id="date1" data-target="#date1" data-toggle="datetimepicker" value="<?php if(isset($customer_info['customer_birthdate'])){ echo $customer_info['customer_birthdate']; } ?>" placeholder="">
                      </div>
                      <div class="form-group col-md-6">
                        <label>Anniversary date</label>
                        <input type="text" class="form-control form-control-sm" name="customer_anv_date" id="date2" data-target="#date2" data-toggle="datetimepicker" value="<?php if(isset($customer_info['customer_anv_date'])){ echo $customer_info['customer_anv_date']; } ?>" placeholder="" >
                      </div>
                      <div class="form-group col-md-2 mb-0">
                        <label for="">Gender : </label>
                      </div>
                      <div class="form-group col-md-2 mb-0">
                        <div class="form-check">
                          <input class="form-check-input" value="Male" type="radio" name="customer_gender" <?php if(isset($customer_info['customer_gender']) && $customer_info['customer_gender'] == 'Male'){ echo 'checked'; } elseif (!isset($customer_info['customer_gender'])) { echo 'checked'; } ?>>
                          Male
                        </div>
                      </div>
                      <div class="form-group col-md-2">
                        <div class="form-check">
                          <input class="form-check-input" value="Female" type="radio" name="customer_gender" <?php if(isset($customer_info['customer_gender']) && $customer_info['customer_gender'] == 'Female'){ echo 'checked'; } ?>>
                          Female
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer row m-0">
                  <div class="col-md-2">
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="customer_status1" name="customer_status" value="1" <?php if(isset($customer_info['customer_status']) && $customer_info['customer_status'] == '1'){ echo 'checked'; } elseif (!isset($customer_info['customer_status'])) { echo 'checked'; } ?>>
                      <label for="customer_status1" class="custom-control-label">Active</label>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="custom-control custom-radio">
                      <input class="custom-control-input" type="radio" id="customer_status0" name="customer_status" value="0" <?php if(isset($customer_info['customer_status']) && $customer_info['customer_status'] == '0'){ echo 'checked'; }  ?>>
                      <label for="customer_status0" class="custom-control-label">Inactive</label>
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
// Check Mobile Duplication..
  var customer_mob11 = $('#customer_mob1').val();
  $('#customer_mob1').on('change',function(){
    var customer_mob1 = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>User/check_duplication',
      type: 'POST',
      data: {"column_name":"customer_mob1",
             "column_val":customer_mob1,
             "table_name":"customer"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#customer_mob1').val(customer_mob11);
          toastr.error(customer_mob1+' Mobile No Exist.');
        }
      }
    });
  });

// Check Email Duplication..
  var customer_email1 = $('#customer_email').val();
  $('#customer_email').on('change',function(){
    var customer_email = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>User/check_duplication',
      type: 'POST',
      data: {"column_name":"customer_email",
             "column_val":customer_email,
             "table_name":"customer"},
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
