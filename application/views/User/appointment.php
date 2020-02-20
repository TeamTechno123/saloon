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
          <div class="col-sm-12 mt-1 text-center">
            <h4>APPOINTMENT </h4>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-10 offset-md-1">
            <!-- general form elements -->
            <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
            <form role="form" action="" method="post">
                <div class="card-body row">
                  <div class="form-group col-md-6">
                    <label>Appointment No.</label>
                    <input type="text" class="form-control form-control-sm" name="appointment_no" id="appointment_no" value="<?php if(isset($appointment_info['appointment_no'])){ echo $appointment_info['appointment_no']; } elseif(!isset($appointment_info['appointment_no']) && isset($appointment_no)){ echo $appointment_no; } ?>" placeholder="" required readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Appointment Date</label>
                    <input type="text" class="form-control form-control-sm" name="app_entry_date" id="app_entry_date" value="<?php if(isset($appointment_info['app_entry_date'])){ echo $appointment_info['app_entry_date']; } elseif(!isset($appointment_info['app_entry_date'])){ echo date('d-m-Y'); } ?>" placeholder="" required readonly>
                  </div>
                  <div class="form-group col-md-12 select_sm">
                    <label>Select Customer</label>
                    <select class="form-control select2  form-control-sm" name="customer_id" id="customer_id" style="width: 100%;" required>
                      <option selected="selected select_sm" value="" >Select Customer</option>
                      <?php if(isset($customer_list)){ foreach ($customer_list as $list) { ?>
                        <option value="<?php echo $list->customer_id; ?>" <?php if(isset($appointment_info['customer_id']) && $appointment_info['customer_id'] == $list->customer_id){ echo 'selected'; } ?>><?php echo $list->customer_name; ?></option>
                      <?php } } ?>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Appointment Date.</label>
                    <input type="text" class="form-control form-control-sm" name="appointment_date" id="date1" data-target="#date1" data-toggle="datetimepicker" value="<?php if(isset($appointment_info['appointment_date'])){ echo $appointment_info['appointment_date']; } ?>" placeholder="" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Appointment Time</label>
                    <input type="text" class="form-control form-control-sm" name="appointment_time" id="timepicker1" data-target="#timepicker1" data-toggle="datetimepicker" value="<?php if(isset($appointment_info['appointment_time'])){ echo $appointment_info['appointment_time']; } ?>" placeholder="" required>
                  </div>
                  <div class="form-group col-md-12 select_sm">
                    <label>Select Employee For Assignment</label>
                    <select class="form-control select2  form-control-sm" name="user_id" id="user_id" data-placeholder="Select Employee For Assignment" required>
                      <option selected="selected select_sm" value="" >Select Employee For Assignment</option>
                      <?php if(isset($user_list)){ foreach ($user_list as $list) { ?>
                        <option value="<?php echo $list->user_id; ?>" <?php if(isset($appointment_info['user_id']) && $appointment_info['user_id'] == $list->user_id){ echo 'selected'; } ?>><?php echo $list->user_name; ?></option>
                      <?php } } ?>
                    </select>
                  </div>
                  <div class="col-md-12">
                    <hr>
                  </div>
                  <div class="col-md-6">
                    <label >Service / Product :- </label>
                  </div>
                  <div class="col-md-6 text-right">
                    <button type="button" id="add_row" class="btn btn-sm btn-primary mb-3 mr-1" width="150px">Add Row</button>
                  </div>
                  <div class="col-md-12">
                    <table id="myTable" class="table table-bordered tbl_list">
                    <thead>
                      <tr>
                        <th>Select / Service Product </th>
                        <th class="wt_75"> Qty</th>
                        <th class="wt_75"> Rate</th>
                        <th class="wt_75"> Amount</th>
                        <th class="wt_50"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(isset($appo_details_list)){ $i=0; foreach ($appo_details_list as $list) { ?>
                        <input type="hidden" name="input[<?php echo $i; ?>][appo_details_id]" value="<?php echo $list->appo_details_id; ?>">
                        <tr>
                          <td>
                            <select class="form-control form-control-sm product_id" name="input[<?php echo $i; ?>][product_id]" data-placeholder="Select Type" required>
                              <option value="">Select Service / Product</option>
                              <?php if(isset($product_list)){ foreach ($product_list as $list2) { ?>
                                <option value="<?php echo $list2->product_id; ?>" <?php if($list->product_id == $list2->product_id){ echo 'selected'; } ?>><?php echo $list2->product_name; ?></option>
                              <?php } } ?>
                            </select>
                          </td>
                          <td class="wt_100">
                            <input type="number" class="form-control form-control-sm appo_product_qty" name="input[<?php echo $i; ?>][appo_product_qty]" value="<?php echo $list->appo_product_qty; ?>" required>
                          </td>
                          <td class="wt_100">
                            <input type="number" class="form-control form-control-sm app_product_rate" name="input[<?php echo $i; ?>][app_product_rate]" value="<?php echo $list->app_product_rate; ?>" required>
                          </td>
                          <td class="wt_100">
                            <input type="number" class="form-control form-control-sm app_product_amt" name="input[<?php echo $i; ?>][app_product_amt]" value="<?php echo $list->app_product_amt; ?>" required readonly>
                          </td>
                          <td class="wt_50"> <?php if($i>0){ ?> <a class="rem_row"><i class="fa fa-trash text-danger"></i></a><?php } ?></td>
                        </tr>
                      <?php  $i++; } } else{ ?>
                        <tr>
                          <td>
                            <select class="form-control form-control-sm product_id" name="input[0][product_id]" id="product_id" data-placeholder="Select Type" required>
                              <option value="">Select Service / Product</option>
                              <?php if(isset($product_list)){ foreach ($product_list as $list) { ?>
                                <option value="<?php echo $list->product_id; ?>" <?php if(isset($appointment_info['product_id']) && $appointment_info['product_id'] == $list->product_id){ echo 'selected'; } ?>><?php echo $list->product_name; ?></option>
                              <?php } } ?>
                            </select>
                          </td>
                          <td class="wt_100">
                            <input type="number" class="form-control form-control-sm appo_product_qty" name="input[0][appo_product_qty]" id="appo_product_qty" required>
                          </td>
                          <td class="wt_100">
                            <input type="number" class="form-control form-control-sm app_product_rate" name="input[0][app_product_rate]" id="app_product_rate" required>
                          </td>
                          <td class="wt_100">
                            <input type="number" class="form-control form-control-sm app_product_amt" name="input[0][app_product_amt]" id="app_product_rate" required readonly>
                          </td>
                          <td class="wt_50"></td>
                        </tr>
                      <?php  } ?>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-6 row">
                </div>
                <div class="col-md-6 ">
                  <div class="form-group row pt-1 float-right">
                    <label for="inputEmail3" class=" col-form-label mr-3"> Total Amount </label>
                    <div class="">
                      <input type="number" name="appointment_total" id="appointment_total" class="form-control form-control-sm" value="<?php if(isset($appointment_info['appointment_total'])){ echo $appointment_info['appointment_total']; } ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group row pt-1 float-right">
                    <label for="inputEmail3" class=" col-form-label mr-3">Advance Amount</label>
                    <div class="">
                      <input type="number" name="appointment_advance" id="appointment_advance" class="form-control form-control-sm" value="<?php if(isset($appointment_info['appointment_advance'])){ echo $appointment_info['appointment_advance']; } ?>" >
                    </div>
                  </div>
                  <div class="form-group row pt-1 float-right">
                    <label for="inputEmail3" class=" col-form-label mr-3">Balance Amount</label>
                    <div class="">
                      <input type="number" name="appointment_balance" id="appointment_balance" class="form-control form-control-sm" value="<?php if(isset($appointment_info['appointment_balance'])){ echo $appointment_info['appointment_balance']; } ?>" readonly>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-footer row m-0">
              <div class="col-md-2">
                <input type="hidden" name="appointment_status" value="0">
                <!-- <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="appointment_status1" name="appointment_status" value="1" <?php if(isset($appointment_info['appointment_status']) && $appointment_info['appointment_status'] == '1'){ echo 'checked'; } elseif (!isset($appointment_info['appointment_status'])) { echo 'checked'; } ?>>
                  <label for="appointment_status1" class="custom-control-label">Active</label>
                </div> -->
              </div>
              <div class="col-md-2">
                <!-- <div class="custom-control custom-radio">
                  <input class="custom-control-input" type="radio" id="appointment_status0" name="appointment_status" value="0" <?php if(isset($appointment_info['appointment_status']) && $appointment_info['appointment_status'] == '0'){ echo 'checked'; }  ?>>
                  <label for="appointment_status0" class="custom-control-label">Inactive</label>
                </div> -->
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
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  </div>
  <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>

<script type="text/javascript">
  // Add Row...
  <?php if(isset($update)){ ?>
  var i = <?php echo $i-1; ?>
  <?php } else { ?>
  var i = 0;
  <?php } ?>

  $('#add_row').click(function(){
    i++;
    var row = ''+
    '<tr>'+
      '<td>'+
        '<select class="form-control form-control-sm product_id" name="input['+i+'][product_id]" id="product_id" data-placeholder="Select Type" required>'+
          '<option value="">Select Service / Product</option>'+
          '<?php if(isset($product_list)){ foreach ($product_list as $list) { ?>'+
            '<option value="<?php echo $list->product_id; ?>" <?php if(isset($appointment_info['product_id']) && $appointment_info['product_id'] == $list->product_id){ echo 'selected'; } ?>><?php echo $list->product_name; ?></option>'+
          '<?php } } ?>'+
        '</select>'+
      '</td>'+
      '<td class="wt_100">'+
        '<input type="text" class="form-control form-control-sm appo_product_qty" name="input['+i+'][appo_product_qty]" id="appo_product_qty" value="" placeholder="" required>'+
      '</td>'+
      '<td class="wt_100">'+
        '<input type="text" class="form-control form-control-sm app_product_rate" name="input['+i+'][app_product_rate]" id="app_product_rate" value="" placeholder="" required>'+
      '</td>'+
      '<td class="wt_100">'+
        '<input type="number" class="form-control form-control-sm app_product_amt" name="input['+i+'][app_product_amt]" id="app_product_rate" required readonly>'+
      '</td>'+
      '<td class="wt_50"><a class="rem_row"><i class="fa fa-trash text-danger"></i></a></td>'+
    '</tr>';
    $('#myTable').append(row);
  });

  $('#myTable').on('click', '.rem_row', function () {
    $(this).closest('tr').remove();
  });

  // $('.product_id').on('change',function(){
  //   var product_id = $(this).val();
  //   alert(product_id);
  // });

  $("#myTable").on("change", "select.product_id", function(){
    var product_id = $(this).val();
    $.ajax({
      url: '<?php echo base_url(); ?>User/get_product_rate',
      type: "POST",
      data: {"product_id":product_id},
      context: this,
      success: function (result) {
        $(this).closest('tr').find('.app_product_rate').val(result);
        var appo_product_qty = $(this).closest('tr').find('.appo_product_qty').val();
        var app_product_rate = $(this).closest('tr').find('.app_product_rate').val();
        var app_product_amt = appo_product_qty * app_product_rate;
        $(this).closest('tr').find('.app_product_amt').val(app_product_amt);

        var appointment_total = 0;
        $('.app_product_amt').each(function(){
          var app_product_amt = $(this).val();
          if(!isNaN(app_product_amt) && app_product_amt.length != 0) {
              appointment_total += parseFloat(app_product_amt);
          }
        });
        $('#appointment_total').val(appointment_total);
        $('#appointment_balance').val(appointment_total);
      }
  	});
  });

  $("#myTable").on("change", ".appo_product_qty, .app_product_rate", function(){
    var appo_product_qty = $(this).closest('tr').find('.appo_product_qty').val();
    var app_product_rate = $(this).closest('tr').find('.app_product_rate').val();
    var app_product_amt = appo_product_qty * app_product_rate;
    $(this).closest('tr').find('.app_product_amt').val(app_product_amt);

    var appointment_total = 0;
    $('.app_product_amt').each(function(){
      var app_product_amt = $(this).val();
      if(!isNaN(app_product_amt) && app_product_amt.length != 0) {
          appointment_total += parseFloat(app_product_amt);
      }
    });
    $('#appointment_total').val(appointment_total);
    $('#appointment_balance').val(appointment_total);
  });

  $('#appointment_advance').change(function(){
    var appointment_advance = $(this).val();
    var appointment_total = $('#appointment_total').val();
    var appointment_balance = appointment_total - appointment_advance;
    $('#appointment_balance').val(appointment_balance);
  });

</script>
</body>
</html>
