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
          <div class="col-sm-12 mt-1">
            <h4>APPOINTMENT INFORMATION</h4>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-list"></i> List Appointment Information</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="wt_50">#</th>
                  <th> Date </th>
                  <th> Time</th>
                  <th>Customer Name</th>
                  <th>mobile No.</th>
                  <th>Employee Name</th>
                  <th>Status</th>
                  <!-- <th class="wt_50">Action</th> -->
                </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                  foreach ($appointment_list as $list) {
                    $i++; ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $list->appointment_date ?></td>
                    <td><?php echo $list->appointment_time ?></td>
                    <td><?php echo $list->customer_name ?></td>
                    <td><?php echo $list->customer_mob1 ?></td>
                    <td><?php echo $list->user_name ?></td>
                    <td><?php if($list->appointment_status == 0){ ?>
                      <a href="#" app_id="<?php echo $list->appointment_id; ?>" app_status="<?php echo $list->appointment_status; ?>" app_date="<?php echo $list->appointment_date; ?>" app_time="<?php echo $list->appointment_time; ?>" class="badge badge-warning p-2 change_status" data-toggle="modal" data-target="#exampleModal">Pending</a>
                    <?php } elseif($list->appointment_status == 1){ ?>
                      <a href="#" app_id="<?php echo $list->appointment_id; ?>" app_status="<?php echo $list->appointment_status; ?>" app_date="<?php echo $list->appointment_date; ?>" app_time="<?php echo $list->appointment_time; ?>" class="badge badge-success p-2 change_status" data-toggle="modal" data-target="#exampleModal">Completed</small>
                    <?php } else{ ?>
                      <a href="#" app_id="<?php echo $list->appointment_id; ?>" app_status="<?php echo $list->appointment_status; ?>" app_date="<?php echo $list->appointment_date; ?>" app_time="<?php echo $list->appointment_time; ?>" class="badge badge-danger p-2 change_status" data-toggle="modal" data-target="#exampleModal">Cancel</small>
                    <?php } ?></td>
                  <?php } ?>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Info</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form class="" action="update_appo_status" method="post">
              <input type="hidden" name="appointment_id" id="appointment_id">
              <div class="modal-body">
                <div class="form-group row cha_status ">
                  <label class="col-md-4">Status</label>
                  <div class="col-md-8 select_sm p-0">
                    <select class="form-control form-control-sm" id="appointment_status" data-placeholder="Select Status" name="appointment_status">
                      <option value="0">Pending</option>
                      <option value="1">Complete</option>
                      <option value="2">Cancel</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-4">Appointment Date</label>
                  <input type="text" class="form-control form-control-sm col-md-8" name="appointment_date" id="date1" data-target="#date1" data-toggle="datetimepicker" required>
                </div>
                <div class="form-group row">
                  <label class="col-md-4">Appointment Time</label>
                  <input type="text" class="form-control form-control-sm col-md-8" name="appointment_time" id="timepicker1" data-target="#timepicker1" data-toggle="datetimepicker" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>

  </div>
  <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>
  <script type="text/javascript">
  <?php if($this->session->flashdata('save_success')){ ?>
    $(document).ready(function(){
      toastr.success('Saved successfully');
    });
  <?php } ?>
  <?php if($this->session->flashdata('update_success')){ ?>
    $(document).ready(function(){
      toastr.success('Updated successfully');
    });
  <?php } ?>
  <?php if($this->session->flashdata('delete_success')){ ?>
    $(document).ready(function(){
      toastr.error('Deleted successfully');
    });
  <?php } ?>
  </script>

  <script type="text/javascript">
    $('.change_status').click(function(){
      var app_id = $(this).attr('app_id');
      var app_status = $(this).attr('app_status');
      var app_date = $(this).attr('app_date');
      var app_time = $(this).attr('app_time');

      $('#appointment_id').val(app_id);
      $('#date1').val(app_date);
      $('#timepicker1').val(app_time);
      if(app_status == 0){ $("#appointment_status").val(0); }
      else if(app_status == 1){ $("#appointment_status").val(1); }
      else{ $("#appointment_status").val(2); }
    });
  </script>

</body>
</html>
