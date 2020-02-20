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
              <div class="card-tools">
                <a href="<?php echo base_url(); ?>User/appointment" class="btn btn-sm btn-block btn-primary">Add Appointment</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="wt_50">#</th>
                  <th>Customer Name</th>
                  <th>Appointment Date </th>
                  <th>Appointment Time </th>
                  <th>Status</th>
                  <th class="wt_75">Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $i = 0;
                  foreach ($appointment_list as $list) {
                    $i++; ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $list->customer_name ?></td>
                    <td><?php echo $list->appointment_date ?></td>
                    <td><?php echo $list->appointment_time ?></td>
                    <td><?php if($list->appointment_status == 0){
                      echo "<small class='badge badge-warning p-2'>Pending</small>";
                    } elseif($list->appointment_status == 1){
                      echo "<small class='badge badge-success p-2'>Completed</small>";
                    }  else{
                      echo "<small class='badge badge-danger p-2'>Cancel</small>";
                    } ?></td>
                    <td>
                      <a href="<?php echo base_url(); ?>User/edit_appointment/<?php echo $list->appointment_id; ?>"> <i class="fa fa-edit"></i> </a>
                      <a href="<?php echo base_url(); ?>User/delete_appointment/<?php echo $list->appointment_id; ?>" onclick="return confirm('Delete this Appointment');" class="ml-2"> <i class="fa fa-trash text-danger"></i> </a>
                    </td>
                  <?php } ?>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>




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

</body>
</html>
