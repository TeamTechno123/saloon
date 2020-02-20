<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller{
  public function __construct(){
    parent::__construct();
    $this->load->model('User_Model');
  }

  public function logout(){
    $this->session->sess_destroy();
    header('location:'.base_url().'User');
  }

/**************************      Login      ********************************/
  public function index(){
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    if ($this->form_validation->run() == FALSE) {
    	$this->load->view('User/login');
    } else{
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      $login = $this->User_Model->check_login($email, $password);
      // print_r($login);
      if($login == null){
        $this->session->set_flashdata('msg','login_error');
        header('location:'.base_url().'User');
      } else{
        // echo 'null not';
        $this->session->set_userdata('sol_user_id', $login[0]['user_id']);
        $this->session->set_userdata('sol_company_id', $login[0]['company_id']);
        $this->session->set_userdata('sol_roll_id', $login[0]['roll_id']);
        header('location:'.base_url().'User/dashboard');
      }
    }
  }

/**************************      Dashboard      ********************************/
  public function dashboard(){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    $today = date('d-m-Y');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $data['user_cnt'] = $this->User_Model->get_count('user_id',$sol_company_id,'is_admin','0','','','user');
    $data['customer_cnt'] = $this->User_Model->get_count('customer_id',$sol_company_id,'','','','','customer');
    $data['package_cnt'] = $this->User_Model->get_count('package_id',$sol_company_id,'','','','','package');
    $data['product_cnt'] = $this->User_Model->get_count('product_id',$sol_company_id,'','','','','product');
    $data['tot_appo_cnt'] = $this->User_Model->get_count('appointment_id',$sol_company_id,'','','','','appointment');
    $data['today_appo_cnt'] = $this->User_Model->get_count('appointment_id',$sol_company_id,'appointment_date',$today,'appointment_status','0','appointment');
    $data['complete_appo_cnt'] = $this->User_Model->get_count('appointment_id',$sol_company_id,'appointment_status','1','','','appointment');
    $data['cancel_appo_cnt'] = $this->User_Model->get_count('appointment_id',$sol_company_id,'appointment_status','2','','','appointment');

    $data['user_list'] = $this->User_Model->get_list_by_id_com($sol_company_id,'user_status',1,'is_admin','0','user_name','ASC','user');
    
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('User/dashboard', $data);
    $this->load->view('Include/footer', $data);
  }

/**************************      Company Information      ********************************/

  // Company List...
  public function company_information_list(){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }

    $data['company_list'] = $this->User_Model->get_list($sol_company_id,'company_id','ASC','company');
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('User/company_information_list', $data);
    $this->load->view('Include/footer', $data);
  }

  // Edit Company...
  public function edit_company($company_id){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }

    $this->form_validation->set_rules('company_name', 'company_name', 'trim|required');
    $this->form_validation->set_rules('company_address', 'company_address', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $up_data = array(
        'company_name' => $this->input->post('company_name'),
        'company_address' => $this->input->post('company_address'),
        'company_city' => $this->input->post('company_city'),
        'company_state' => $this->input->post('company_state'),
        'company_district' => $this->input->post('company_district'),
        'company_statecode' => $this->input->post('company_statecode'),
        'company_mob1' => $this->input->post('company_mob1'),
        'company_mob2' => $this->input->post('company_mob2'),
        'company_email' => $this->input->post('company_email'),
        'company_website' => $this->input->post('company_website'),
        'company_pan_no' => $this->input->post('company_pan_no'),
        'company_gst_no' => $this->input->post('company_gst_no'),
        'company_lic1' => $this->input->post('company_lic1'),
        'company_lic2' => $this->input->post('company_lic2'),
        'company_start_date' => $this->input->post('company_start_date'),
        'company_end_date' => $this->input->post('company_end_date'),
      );
      $this->User_Model->update_info('company_id', $company_id, 'company', $up_data);
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/company_information_list');
    }
    $company_info = $this->User_Model->get_info('company_id', $company_id, 'company');
    if($company_info){
      foreach($company_info as $info){
        $data['update'] = 'update';
        $data['company_id'] = $info->company_id;
        $data['company_name'] = $info->company_name;
        $data['company_address'] = $info->company_address;
        $data['company_city'] = $info->company_city;
        $data['company_state'] = $info->company_state;
        $data['company_district'] = $info->company_district;
        $data['company_statecode'] = $info->company_statecode;
        $data['company_mob1'] = $info->company_mob1;
        $data['company_mob2'] = $info->company_mob2;
        $data['company_email'] = $info->company_email;
        $data['company_website'] = $info->company_website;
        $data['company_pan_no'] = $info->company_pan_no;
        $data['company_gst_no'] = $info->company_gst_no;
        $data['company_lic1'] = $info->company_lic1;
        $data['company_lic2'] = $info->company_lic2;
        $data['company_start_date'] = $info->company_start_date;
        $data['company_end_date'] = $info->company_end_date;
      }
      $this->load->view('Include/head', $data);
      $this->load->view('Include/navbar', $data);
      $this->load->view('User/company_information', $data);
      $this->load->view('Include/footer', $data);
    }
  }

/**************************************************************************************/
/*******                                Master Forms                          *********/
/**************************************************************************************/


/*******************************    User Information      ****************************/

  // Add New User....
  public function add_user(){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('user_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $save_data = array(
        'company_id' => $sol_company_id,
        'user_name' => $this->input->post('user_name'),
        'user_mobile' => $this->input->post('user_mobile'),
        'user_city' => $this->input->post('user_city'),
        'user_password' => $this->input->post('user_password'),
        'user_addedby' => $sol_user_id,
      );
      $this->User_Model->save_data('user', $save_data);
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/user_list');
    }
    $this->load->view('Include/head');
    $this->load->view('Include/navbar');
    $this->load->view('User/user');
    $this->load->view('Include/footer');
  }

  // User List....
  public function user_list(){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $data['user_list'] = $this->User_Model->user_list($sol_company_id);
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/user_list',$data);
    $this->load->view('Include/footer',$data);
  }

  // Edit User....
  public function edit_user($user_id){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('user_name', 'First Name', 'trim|required');
    if ($this->form_validation->run() != FALSE) {
      $update_data = array(
        'user_name' => $this->input->post('user_name'),
        'user_mobile' => $this->input->post('user_mobile'),
        'user_email' => $this->input->post('user_email'),
        'user_city' => $this->input->post('user_city'),
        'user_password' => $this->input->post('user_password'),
        'user_addedby' => $sol_user_id,
      );
      $this->User_Model->update_info('user_id', $user_id, 'user', $update_data);
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/user_list');
    }

    $user_info = $this->User_Model->get_info('user_id', $user_id, 'user');
    if($user_info == ''){ header('location:'.base_url().'User/user_list'); }
    foreach($user_info as $info){
      $data['update'] = 'update';
      $data['user_name'] = $info->user_name;
      $data['user_mobile'] = $info->user_mobile;
      $data['user_email'] = $info->user_email;
      $data['user_city'] = $info->user_city;
      $data['user_password'] = $info->user_password;
    }
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/user',$data);
    $this->load->view('Include/footer',$data);
  }

  // Delete User....
  public function delete_user($user_id){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('user_id', $user_id, 'user');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'User/user_list');
  }



/**************************************************************************************/
/*******                           Manage Forms                               *********/
/**************************************************************************************/

/***************************      Customer Information     *****************************/

  // Customer List...
  public function customer_list(){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $data['customer_list'] = $this->User_Model->get_list($sol_company_id,'customer_id','DESC','customer');
    $this->load->view('Include/head',$data);
    $this->load->view('Include/navbar',$data);
    $this->load->view('User/customer_list',$data);
    $this->load->view('Include/footer',$data);
  }

  // Add Customer...
  public function customer(){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('customer_name','Name','trim|required');
    if($this->form_validation->run() != FALSE){
      $save_data = $_POST;
      $save_data['company_id'] = $sol_company_id;
      $save_data['customer_addedby'] = $sol_user_id;
      $save_data['customer_date'] = date('d-m-Y h:i:s A');

      $this->User_Model->save_data('customer', $save_data);
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/customer_list');
    }
    $this->load->view('Include/head');
    $this->load->view('Include/navbar');
    $this->load->view('User/customer');
    $this->load->view('Include/footer');
  }

  // Edit Customer...
  public function edit_customer($customer_id){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('customer_name','Name','trim|required');
    if($this->form_validation->run() != FALSE){
      $update_data = $_POST;
      $update_data['customer_addedby'] = $sol_user_id;
      $update_data['customer_date'] = date('d-m-Y h:i:s A');

      $this->User_Model->update_info('customer_id', $customer_id, 'customer', $update_data);
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/customer_list');
    }
    $customer_info = $this->User_Model->get_info_arr('customer_id',$customer_id,'customer');
    if(!$customer_info){ header('location:'.base_url().'Master/customer_list'); }
    $data['update'] = 'update';
    $data['customer_info'] = $customer_info[0];
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('User/customer', $data);
    $this->load->view('Include/footer', $data);
  }

  // Delete Customer....
  public function delete_customer($customer_id){
    $eco_user_id = $this->session->userdata('eco_user_id');
    $eco_company_id = $this->session->userdata('eco_company_id');
    $eco_roll_id = $this->session->userdata('eco_roll_id');
    if($eco_user_id == '' && $eco_company_id == ''){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('customer_id', $customer_id, 'customer');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'User/customer_list');
  }

  /***********************     package Information      ******************************/
  // Customer List...
  public function package_list(){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $data['package_list'] = $this->User_Model->get_list($sol_company_id,'package_id','DESC','package');
    // print_r($data['package_list']);
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('User/package_list', $data);
    $this->load->view('Include/footer', $data);
  }

  // Add Customer...
  public function package(){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('package_name','Name','trim|required');
    if($this->form_validation->run() != FALSE){
      $save_data = $_POST;
      $save_data['company_id'] = $sol_company_id;
      $save_data['package_addedby'] = $sol_user_id;
      $save_data['package_date'] = date('d-m-Y h:i:s A');

      $this->User_Model->save_data('package', $save_data);
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/package_list');
    }
    $this->load->view('Include/head');
    $this->load->view('Include/navbar');
    $this->load->view('User/package');
    $this->load->view('Include/footer');
  }

  // Edit Package...
  public function edit_package($package_id){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('package_name','Name','trim|required');
    if($this->form_validation->run() != FALSE){
      $update_data = $_POST;
      $update_data['package_addedby'] = $sol_user_id;
      $update_data['package_date'] = date('d-m-Y h:i:s A');

      $this->User_Model->update_info('package_id', $package_id, 'package', $update_data);
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/package_list');
    }
    $package_info = $this->User_Model->get_info_arr('package_id',$package_id,'package');
    if(!$package_info){ header('location:'.base_url().'Master/package_list'); }
    $data['update'] = 'update';
    $data['package_info'] = $package_info[0];
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('User/package', $data);
    $this->load->view('Include/footer', $data);
  }

  // Delete Package....
  public function delete_package($package_id){
    $eco_user_id = $this->session->userdata('eco_user_id');
    $eco_company_id = $this->session->userdata('eco_company_id');
    $eco_roll_id = $this->session->userdata('eco_roll_id');
    if($eco_user_id == '' && $eco_company_id == ''){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('package_id', $package_id, 'package');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'User/package_list');
  }
  /***********************     product Information      ******************************/
  // Customer List...
  public function product_list(){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $data['product_list'] = $this->User_Model->get_list($sol_company_id,'product_id','DESC','product');
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('User/product_list', $data);
    $this->load->view('Include/footer', $data);
  }

  // Add Customer...
  public function product(){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('product_name','Name','trim|required');
    if($this->form_validation->run() != FALSE){
      $save_data = $_POST;
      $save_data['company_id'] = $sol_company_id;
      $save_data['product_addedby'] = $sol_user_id;
      $save_data['product_date'] = date('d-m-Y h:i:s A');

      $this->User_Model->save_data('product', $save_data);
      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/product_list');
    }
    $this->load->view('Include/head');
    $this->load->view('Include/navbar');
    $this->load->view('User/product');
    $this->load->view('Include/footer');
  }

  // Edit Product...
  public function edit_product($product_id){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('product_name','Name','trim|required');
    if($this->form_validation->run() != FALSE){
      $update_data = $_POST;
      $update_data['product_addedby'] = $sol_user_id;
      $update_data['product_date'] = date('d-m-Y h:i:s A');

      $this->User_Model->update_info('product_id', $product_id, 'product', $update_data);
      $this->session->set_flashdata('update_success','success');
      header('location:'.base_url().'User/product_list');
    }
    $product_info = $this->User_Model->get_info_arr('product_id',$product_id,'product');
    if(!$product_info){ header('location:'.base_url().'Master/product_list'); }
    $data['update'] = 'update';
    $data['product_info'] = $product_info[0];
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('User/product', $data);
    $this->load->view('Include/footer', $data);
  }

  // Delete Product....
  public function delete_product($product_id){
    $eco_user_id = $this->session->userdata('eco_user_id');
    $eco_company_id = $this->session->userdata('eco_company_id');
    $eco_roll_id = $this->session->userdata('eco_roll_id');
    if($eco_user_id == '' && $eco_company_id == ''){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('product_id', $product_id, 'product');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'User/product_list');
  }

  /***********************     appointment Information      ******************************/
  // Appointment List...
  public function appointment_list(){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $data['appointment_list'] = $this->User_Model->appointment_list($sol_company_id);
    // print_r($data['appointment_list']);
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('User/appointment_list', $data);
    $this->load->view('Include/footer', $data);
  }

  // Add Appointment...
  public function appointment(){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('appointment_no','Number','trim|required');
    if($this->form_validation->run() != FALSE){

      $save_data = $_POST;
      $save_data['company_id'] = $sol_company_id;
      $save_data['appointment_addedby'] = $sol_user_id;
      $save_data['appointment_date2'] = date('d-m-Y h:i:s A');
      unset($save_data['input']);
      $appointment_id = $this->User_Model->save_data('appointment', $save_data);

      foreach($_POST['input'] as $details_data){
        $details_data['appointment_id'] = $appointment_id;
        $details_data['appo_details_date'] = date('d-m-Y h:i:s A');
        $details_data['appo_details_addedby'] = $sol_user_id;
        $this->db->insert('appo_details', $details_data);
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/appointment_list');
    }
    $data['appointment_no'] = $this->User_Model->get_count_no($sol_company_id,'appointment_no', 'appointment');
    $data['customer_list'] = $this->User_Model->get_list_by_id('customer_status',1,'','','customer_name','ASC','customer');
    $data['user_list'] = $this->User_Model->get_list_by_id_com($sol_company_id,'user_status',1,'is_admin','0','user_name','ASC','user');
    $data['product_list'] = $this->User_Model->get_list_by_id_com($sol_company_id,'product_status',1,'','','product_name','ASC','product');
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('User/appointment', $data);
    $this->load->view('Include/footer', $data);
  }

  // Edit/Update Appointment...
  public function edit_appointment($appointment_id){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $this->form_validation->set_rules('appointment_no','Number','trim|required');
    if($this->form_validation->run() != FALSE){

      $update_data = $_POST;
      $update_data['appointment_addedby'] = $sol_user_id;
      $update_data['appointment_date2'] = date('d-m-Y h:i:s A');
      unset($update_data['input']);
      $this->User_Model->update_info('appointment_id', $appointment_id, 'appointment', $update_data);

      foreach($_POST['input'] as $details_data){
      $details_data['appo_details_date'] = date('d-m-Y h:i:s A');
      $details_data['appo_details_addedby'] = $sol_user_id;
        if(isset($details_data['appo_details_id'])){
          $appo_details_id = $details_data['appo_details_id'];
          if(!isset($details_data['product_id'])){
            $this->User_Model->delete_info('appo_details_id', $appo_details_id, 'appo_details');
          }else{
              $this->User_Model->update_info('appo_details_id', $appo_details_id, 'appo_details', $details_data);
          }
        }
        else{
          $details_data['appointment_id'] = $appointment_id;
          $this->db->insert('appo_details', $details_data);
        }
      }

      $this->session->set_flashdata('save_success','success');
      header('location:'.base_url().'User/appointment_list');
    }
    $data['appointment_no'] = $this->User_Model->get_count_no($sol_company_id,'appointment_no', 'appointment');
    $data['customer_list'] = $this->User_Model->get_list_by_id('customer_status',1,'','','customer_name','ASC','customer');
    $data['user_list'] = $this->User_Model->get_list_by_id_com($sol_company_id,'user_status',1,'is_admin','0','user_name','ASC','user');
    $data['product_list'] = $this->User_Model->get_list_by_id_com($sol_company_id,'product_status',1,'','','product_name','ASC','product');

    $appointment_info = $this->User_Model->get_info_arr('appointment_id',$appointment_id,'appointment');
    if(!$appointment_info){ header('location:'.base_url().'User/appointment_list'); }
    $data['update'] = 'update';
    $data['appointment_info'] = $appointment_info[0];

    $data['appo_details_list'] = $this->User_Model->get_list_by_id('appointment_id',$appointment_id,'','','appo_details_id','ASC','appo_details');
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('User/appointment', $data);
    $this->load->view('Include/footer', $data);
  }

  // Delete Appointment....
  public function delete_appointment($appointment_id){
    $eco_user_id = $this->session->userdata('eco_user_id');
    $eco_company_id = $this->session->userdata('eco_company_id');
    $eco_roll_id = $this->session->userdata('eco_roll_id');
    if($eco_user_id == '' && $eco_company_id == ''){ header('location:'.base_url().'User'); }
    $this->User_Model->delete_info('appointment_id', $appointment_id, 'appointment');
    $this->User_Model->delete_info('appointment_id', $appointment_id, 'appo_details');
    $this->session->set_flashdata('delete_success','success');
    header('location:'.base_url().'User/appointment_list');
  }

  /***********************     Manage Appointment Information      ******************************/
  // Customer List...
  public function manage_appointment(){
    $sol_user_id = $this->session->userdata('sol_user_id');
    $sol_company_id = $this->session->userdata('sol_company_id');
    $sol_roll_id = $this->session->userdata('sol_roll_id');
    if($sol_user_id == '' && $sol_company_id == ''){ header('location:'.base_url().'User'); }
    $data['appointment_list'] = $this->User_Model->appointment_list($sol_company_id);
    $this->load->view('Include/head', $data);
    $this->load->view('Include/navbar', $data);
    $this->load->view('User/manage_appointment', $data);
    $this->load->view('Include/footer', $data);
  }

  public function update_appo_status(){
    $update_data = $_POST;
    $this->User_Model->update_info('appointment_id', $update_data['appointment_id'], 'appointment', $update_data);
    header('location:'.base_url().'User/manage_appointment');
  }

/*******************************  Check Duplication  ****************************/
  public function check_duplication(){
    $column_name = $this->input->post('column_name');
    $column_val = $this->input->post('column_val');
    $table_name = $this->input->post('table_name');
    $company_id = '';
    $cnt = $this->User_Model->check_dupli_num($company_id,$column_val,$column_name,$table_name);
    echo $cnt;
  }

/*******************************  Get Product Rate By Id  ****************************/
  public function get_product_rate(){
    $product_id = $this->input->post('product_id');
    $result = $this->User_Model->get_info_arr_fields('product_rate','product_id', $product_id, 'product');
    if($result){ $product_rate = $result[0]['product_rate']; }
    else{ $product_rate = 0; }
    echo $product_rate;
  }


}
?>
