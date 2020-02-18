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
                <form role="form" action="<?php echo base_url(); ?>Transaction/update_sale" method="post">
                  <input type="hidden" name="sale_id" value="">
                <form role="form" action="<?php echo base_url(); ?>Transaction/save_sale" method="post">
                <div class="card-body row">
                  <div class="form-group col-md-6">
                    <label>Appointment No.</label>
                    <input type="text" class="form-control form-control-sm" name="customer_company" id="customer_company" value="<?php if(isset($customer_company)){ echo $customer_company; } ?>" placeholder="" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Appointment Date</label>
                    <input type="text" class="form-control form-control-sm" name="customer_company" id="customer_company" value="<?php if(isset($customer_company)){ echo $customer_company; } ?>" placeholder="" required>
                  </div>

                  <div class="form-group col-md-12 select_sm">
                    <label>Select Customer</label>
                    <select class="form-control select2  form-control-sm" name="sale_party" id="sale_party" style="width: 100%;" required>
                      <option selected="selected select_sm" value="" >Select Customer</option>
                        </option>
                    </select>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Appointment Date.</label>
                    <input type="text" class="form-control form-control-sm" name="customer_company" id="customer_company" value="<?php if(isset($customer_company)){ echo $customer_company; } ?>" placeholder="" required>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Appointment Time</label>
                    <input type="text" class="form-control form-control-sm" name="customer_company" id="customer_company" value="<?php if(isset($customer_company)){ echo $customer_company; } ?>" placeholder="" required>
                  </div>

                  <div class="form-group col-md-12 select_sm">
                    <label>Select Employee For Assignment</label>
                    <select class="form-control select2  form-control-sm" name="sale_party" id="sale_party" style="width: 100%;" required>
                      <option selected="selected select_sm" value="" >Select Employee For Assignment</option>
                        </option>
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                  <label >Select Service / Product :- </label>
                  </div>
                <div class="col-md-6 text-right">
                  <button type="button" id="add_row" class="btn btn-sm btn-primary mb-3 mr-1" width="150px">Add Row</button>
                </div>
                </div>

              <div class="" style="overflow-x:auto;">
                <table id="myTable" class="table table-bordered tbl_list">
                      <thead>
                      <tr>
                        <th>Select / Service Product </th>
                        <th class="wt_150"> Qty</th>
                        <th class="wt_100"> Rate</th>
                        <th class="wt_50"></th>
                      </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            <select class="form-control form-control-sm" name="stock_type_id" id="stock_type_id" data-placeholder="Select Type">
                              <option value="">Select Service / Product</option>
                              <option >1</option>
                              <option >2</option>
                              <option >3</option>
                            </select>
                          </td>
                          <td class="wt_150">
                            <input type="text" class="form-control form-control-sm" name="stock_no" id="stock_no" value="" placeholder="" required>
                          </td>

                          <td class="wt_100">
                            <input type="text" class="form-control form-control-sm" name="stock_no" id="stock_no" value="" placeholder="" required>
                          </td>

                          <td class="wt_50"></td>
                        </tr>
                      </tbody>
                    </table>
              </div>
              <div class="row">


                <div class="col-md-6 ">
                  <div class="form-group row pt-4 float-right">
                    <label for="inputEmail3" class=" col-form-label mr-3"> Total Amount </label>
                    <div class="">
                      <input type="text" name="total_base_amount" class="form-control" id="basic_amount" value="<?php if(isset($total_base_amount)){ echo $total_base_amount; } elseif (isset($delivery_basic)) { echo $delivery_basic; } ?>">
                    </div>
                  </div>
                  <div class="form-group row pt-4 float-right">
                    <label for="inputEmail3" class=" col-form-label mr-3">Advance Amount</label>
                    <div class="">
                      <input type="text" name="sale_total" class="form-control" id="sale_total" value="<?php if(isset($sale_total)){ echo $sale_total; } elseif (isset($delivery_total)) { echo $delivery_total; } ?>" >
                    </div>
                  </div>

                  <div class="form-group row pt-4 float-right">
                    <label for="inputEmail3" class=" col-form-label mr-3">Balance Amount</label>
                    <div class="">
                      <input type="text" name="total_gst" class="form-control" id="gst_val" value="<?php if(isset($total_gst)){ echo $total_gst; } elseif (isset($delivery_gst)) { echo $delivery_gst; } ?>">
                    </div>
                  </div>


                  <div class="form-group col-md-12 select_sm float-right">
                    <label>Select Payment Status </label>
                    <select class="form-control select2  form-control-sm" name="sale_party" id="sale_party" style="width: 100%;" required>
                      <option selected="selected select_sm" value="" >Select Payment Status </option>
                        </option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">

                </div>
              </div>
              </form>

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
// Check Mobile Duplication..
  var supplier_mobile1 = $('#supplier_mobile').val();
  $('#supplier_mobile').on('change',function(){
    var supplier_mobile = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>User/check_duplication',
      type: 'POST',
      data: {"column_name":"supplier_mobile",
             "column_val":supplier_mobile,
             "table_name":"user"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#supplier_mobile').val(supplier_mobile1);
          toastr.error(supplier_mobile+' Mobile No Exist.');
        }
      }
    });
  });

// Check Email Duplication..
  var supplier_email1 = $('#mobile').val();
  $('#supplier_email').on('change',function(){
    var supplier_email = $(this).val();
    $.ajax({
      url:'<?php echo base_url(); ?>User/check_duplication',
      type: 'POST',
      data: {"column_name":"supplier_email",
             "column_val":supplier_email,
             "table_name":"user"},
      context: this,
      success: function(result){
        if(result > 0){
          $('#supplier_email').val(supplier_email1);
          toastr.error(supplier_email+' Email Id Exist.');
        }
      }
    });
  });
</script>

<script type="text/javascript">
  // Add Row...
  <?php if(isset($update)){ ?>
  var i = <?php echo $i-1; ?>
  <?php } else { ?>
  var i = 1;
  <?php } ?>

  $('#add_row').click(function(){
    i++;
    var row = ''+
    '<tr>'+
      '<td>'+
        '<select class="form-control form-control-sm" name="stock_type_id" id="stock_type_id" data-placeholder="Select Type">'+
          '<option value="">Select Service / Product </option>'+
          '<option >1</option>'+
          '<option >2</option>'+
          '<option >3</option>'+
        '</select>'+
      '</td>'+
      '<td class="wt_150">'+
        '<input type="text" class="form-control form-control-sm" name="stock_no" id="stock_no" value="" placeholder="" required>'+
      '</td>'+

      '<td class="wt_100">'+
        '<input type="text" class="form-control form-control-sm" name="stock_no" id="stock_no" value="" placeholder="" required>'+
      '</td>'+
      '<td class="wt_50"><a class="rem_row"><i class="fa fa-trash text-danger"></i></a></td>'+
    '</tr>';
    $('#myTable').append(row);
  });

  $('#myTable').on('click', '.rem_row', function () {
    $(this).closest('tr').remove();
  });

</script>
</body>
</html>
