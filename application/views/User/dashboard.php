<!DOCTYPE html>
<html>
<?php
$sol_user_id = $this->session->userdata('sol_user_id');
$sol_company_id = $this->session->userdata('sol_company_id');
$sol_roll_id = $this->session->userdata('sol_roll_id');
?>
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
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Appointments</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <h4 class="mb-4 mt-4">Master Summary</h4>

            <div class="row">
              <div class="col-md-3 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php echo $customer_cnt; ?></h3>
                    <p>Customer Information</p>
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
                    <h3><?php echo $package_cnt; ?></h3>
                    <p>Package Information</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="package_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3><?php echo $product_cnt; ?></h3>
                    <p>Product Information</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="product_list" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-3 col-6">
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php echo $tot_appo_cnt; ?></h3>
                    <p>Total Appointment</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="manage_appointment" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3><?php echo $today_appo_cnt; ?></h3>
                    <p>Todays Appointment</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="manage_appointment" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3><?php echo $complete_appo_cnt; ?></h3>
                    <p>Complete Appointment</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="manage_appointment" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?php echo $cancel_appo_cnt; ?></h3>
                    <p>Canceled Appointment</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="manage_appointment" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row mt-4">
              <?php if(isset($user_list)){ foreach ($user_list as $user_list1) { ?>
                <div class="col-md-6">
                  <table id="example" class="table table-bordered tbl_list">
                    <thead>
                      <tr>
                        <th colspan=5"">Employee Name : <?php echo $user_list1->user_name; ?></th>
                      </tr>
                    <tr>
                      <th class="wt_25">#</th>
                      <th class="wt_100">Time</th>
                      <th>Name</th>
                      <th class="wt_50">Status</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                      $today = date('d-m-Y');
                      $appo_list = $this->User_Model->get_list_by_id_com($sol_company_id,'appointment_date',$today,'','','appointment_time','ASC','appointment');
                      $i = 0;
                      foreach ($appo_list as $appo_list1) {
                        $i++;
                        $customer_id = $appo_list1->customer_id;
                        $cust_info = $this->User_Model->get_info_arr_fields('customer_name','customer_id', $customer_id, 'customer');
                      ?>
                      <tr>
                        <td class="wt_25"><?php echo $i; ?></td>
                        <td class="wt_100"><?php echo $appo_list1->appointment_time; ?></td>
                        <td><?php echo $cust_info[0]['customer_name']; ?></td>
                        <td class="wt_50"><?php if($appo_list1->appointment_status == 0){
                          echo "<small class='badge badge-warning p-2'>Pending</small>";
                        } elseif($appo_list1->appointment_status == 1){
                          echo "<small class='badge badge-success p-2'>Completed</small>";
                        }  else{
                          echo "<small class='badge badge-danger p-2'>Cancel</small>";
                        } ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              <?php } } ?>
          </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
  </div>

</body>
</html>
