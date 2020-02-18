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
            <h1>Company Information</h1>
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <hr>
        <h4 class="mb-3">Master Summary</h4>
        <div class="row">
          <!-- left column -->
          <div class="col-md-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>15</h3>
                <p>User Information</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="user_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="small-box bg-yellow">
              <div class="inner">
                <h3>10</h3>
                <p>Demo Information</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="make_information_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="small-box bg-green">
              <div class="inner">
                <h3>5</h3>
                <p>demo Information</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="product_information_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-md-3 col-6">
            <div class="small-box bg-red">
              <div class="inner">
                <h3>5</h3>
                <p>demo Information</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="party_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
        <hr>

        <div class="row">
        <div class="col-md-4">
          <table id="example" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th colspan=5"">Employee Name</th>
              </tr>
            <tr>
              <th class="">#</th>
              <th> Time</th>
              <th>Party Name</th>
              <th>Status</th>
              <th class="wt_50">Action</th>
            </tr>
            </thead>
            <tbody>
              <!-- <?php $i = 0;
              foreach ($user_list as $list) {
                $i++; ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $list->user_name ?></td>
                <td><?php echo $list->user_city ?></td>
                <td><?php echo $list->user_mobile ?></td>
                <td><?php echo $list->user_email ?></td>
                <td>
                  <a href="<?php echo base_url(); ?>User/edit_user/<?php echo $list->user_id; ?>"> <i class="fa fa-edit"></i> </a>
                  <a href="<?php echo base_url(); ?>User/delete_user/<?php echo $list->user_id; ?>" onclick="return confirm('Delete this User');" class="ml-2"> <i class="fa fa-trash text-danger"></i> </a>
                </td>
              <?php } ?>
              </tr> -->

            </tbody>
          </table>
        </div>

        <div class="col-md-4">
          <table id="example" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th colspan=5"">Employee Name</th>
              </tr>
            <tr>
              <th class="">#</th>
              <th> Time</th>
              <th>Party Name</th>
              <th>Status</th>
              <th class="wt_50">Action</th>
            </tr>
            </thead>
            <tbody>
              <!-- <?php $i = 0;
              foreach ($user_list as $list) {
                $i++; ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $list->user_name ?></td>
                <td><?php echo $list->user_city ?></td>
                <td><?php echo $list->user_mobile ?></td>
                <td><?php echo $list->user_email ?></td>
                <td>
                  <a href="<?php echo base_url(); ?>User/edit_user/<?php echo $list->user_id; ?>"> <i class="fa fa-edit"></i> </a>
                  <a href="<?php echo base_url(); ?>User/delete_user/<?php echo $list->user_id; ?>" onclick="return confirm('Delete this User');" class="ml-2"> <i class="fa fa-trash text-danger"></i> </a>
                </td>
              <?php } ?>
              </tr> -->

            </tbody>
          </table>
        </div>

        <div class="col-md-4">
          <table id="example" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th colspan=5"">Employee Name</th>
              </tr>
            <tr>
              <th class="">#</th>
              <th> Time</th>
              <th>Party Name</th>
              <th>Status</th>
              <th class="wt_50">Action</th>
            </tr>
            </thead>
            <tbody>
              <!-- <?php $i = 0;
              foreach ($user_list as $list) {
                $i++; ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $list->user_name ?></td>
                <td><?php echo $list->user_city ?></td>
                <td><?php echo $list->user_mobile ?></td>
                <td><?php echo $list->user_email ?></td>
                <td>
                  <a href="<?php echo base_url(); ?>User/edit_user/<?php echo $list->user_id; ?>"> <i class="fa fa-edit"></i> </a>
                  <a href="<?php echo base_url(); ?>User/delete_user/<?php echo $list->user_id; ?>" onclick="return confirm('Delete this User');" class="ml-2"> <i class="fa fa-trash text-danger"></i> </a>
                </td>
              <?php } ?>
              </tr> -->

            </tbody>
          </table>
        </div>
      </div>

      </div><!-- /.container-fluid -->
    </section>
  </div>

</body>
</html>
