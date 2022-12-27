<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        error_reporting(0);
        $CI = &get_instance();
        $CI->load->library('Get_library');
        $this->load->model('curl/Curl_model');
        $this->load->model('crud/Crud_modal');
        $this->load->helper('url', 'form');
        $this->load->model('LoginModel');
        $this->load->library('Phpmailer');
        //$this->load->library('session');
        date_default_timezone_set('Asia/Kolkata');
    }

    public function index()
    {

        echo '<script>window.location.href = "' . base_url() . 'login"</script>';
    }

    public function login()
    {
        $res['email'] = "";
        $res['password'] = "";
        if ($this->input->post()) {
            $res['email'] = $this->input->post('email');
            $res['password'] = $this->input->post('password');
            if ($this->input->post('signin') == 'signin') {
                $rules_array = array(
                    array(
                        'field' => 'email',
                        'label' => 'Email Address',
                        'rules' => 'trim|required',
                        'errors' => array(
                            'required' => 'Enter Email Address.',
                        ),
                    ),
                    array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|required',
                        'errors' => array(
                            'required' => 'Enter Password',
                        ),
                    ),
                );

                $this->form_validation->set_rules($rules_array);
                if ($this->form_validation->run() == TRUE) {
                    $email = $this->input->post('email');
                    $password = $this->input->post('password');
                    $fields = array(
                        'role_id',
                        'emp_password',
                        'emp_name',
                        'emp_id',
                        'region_id',
                        'sid',
                        'status',
                    );
                    $where = array(
                        'emp_email' => $email,
                    );
                    $limit = '';
                    $order_by = '';
                    $results = $this->Curl_model->fetch_data('employee', $fields, $where, $limit, $order_by);
                    // echo "<pre>";
                    // print_r($results);exit;
                    if (!empty($results) && $results != '') {
                        $r_password = $results['emp_password'];

                        if ($r_password == md5($password)) {
                            if ($results['role_id'] == 1) {
                                if ($results['status'] == 1) {
                                    $this->session->set_userdata('emp_id', $results['emp_id']);
                                    $this->session->set_userdata('sid', $results['sid']);
                                    $this->session->set_userdata('role_id', $results['role_id']);
                                    $this->session->set_userdata('region_id', $results['region_id']);
                                    $this->session->set_userdata('emp_name', $results['emp_name']);
                                    echo '<script>window.location.href = "' . base_url() . 'admin-dashboard"</script>';
                                } else {
                                    $this->session->set_userdata('error', 'Your Login has been block.');
                                }
                            } else {
                                $this->session->set_userdata('emp_id', $results['emp_id']);
                                $this->session->set_userdata('sid', $results['sid']);
                                $this->session->set_userdata('region_id', $results['region_id']);
                                $this->session->set_userdata('role_id', $results['role_id']);
                                $this->session->set_userdata('emp_name', $results['emp_name']);
                                echo '<script>window.location.href = "' . base_url() . 'admin-dashboard"</script>';
                            }
                        } else {

                            $this->session->set_userdata('error', 'Wrong Password');
                        }
                    } else {

                        $this->session->set_userdata('error', 'Please Enter Valid Email Address');
                    }
                }
            }
        }

        $this->load->view('login', $res);
    }

    public function reset_password()
    {
        if ($this->session->userdata('userID')) {
            echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
        }
        $CI = &get_instance();
        if ($this->input->post()) {
            $rules_array = array(
                array(
                    'field' => 'resent_email',
                    'label' => 'Email Address',
                    'rules' => 'trim|required',
                    'errors' => array(
                        'required' => 'Please Enter Email Address.',
                    ),
                ),
            );

            $this->form_validation->set_rules($rules_array);
            if ($this->form_validation->run() == TRUE) {
                $email = $this->input->post('resent_email');
                $href = base_url() . 'reset/' . rtrim(strtr(base64_encode($email), "+/", "-_"), "=");
                $href2 = base_url() . 'verify/' . md5($results);
                $to = $email;
                $from = 'volunteer@caritasindia.org';
                $msg = 'Caritas India Volunteer';
                $msg2 = "Please click on 'Reset Password' button for reset your password.";
                $subj = "Reset Password link from Caritas India";
                $btn = "Reset Password";

                $html = $this->request_email($msg, $msg2, $href, $btn);
                $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
                $html = Modules::run('Mails/request_email', $msg, $msg2, $href, $btn);
                $res = Modules::run('Mails/mail_send', $to, $from, $msg, $msg2, $subj, $href, $btn, $html);
                die();
                $res = $this->session->set_userdata('resent_password_success', 'Reset password link has been sent on your email address please check.');
                echo '<script>window.location.href = "' . base_url() . 'reset-password"</script>';
                redirect('reset-password');
            } else {
                $this->load->view('reset-password');
            }
        } else {
        }
        $this->load->view('reset-password');
    }

    public function resetPassword()
    {
        $CI = &get_instance();
        $link2 = $this->uri->segment(2);
        $res['link2'] = $link2;
        if ($link2 != '') {
            $email = base64_decode(str_pad(strtr($link2, '-_', '+/'), strlen($link2) % 4, '=', STR_PAD_RIGHT));
            $where = array(
                'email' => $email,
            );
            $fields = array(
                'mailConfrmationStatus'
            );
            $results = $this->Curl_model->fetch_data('users', $fields, $where, "", "");
            print_r($results);
            if ($results['mailConfrmationStatus'] == 1) {
                if ($this->input->post()) {
                    $rules_array = array(
                        array(
                            'field' => 'npass',
                            'label' => 'New Password',
                            'rules' => 'trim|required|min_length[8]',
                            'errors' => array(
                                'required' => 'Please Enter New Password',
                                'min_length' => 'Please Enter New Password at least 8 digits',
                            ),
                        ),
                        array(
                            'field' => 'cnpass',
                            'label' => 'Confirm New Password',
                            'rules' => 'trim|required|matches[npass]',
                            'errors' => array(
                                'required' => 'Please Enter Confirm New Password',
                                'matches' => 'Confirm New Password Not Match',
                            ),
                        ),
                    );

                    $this->form_validation->set_rules($rules_array);
                    if ($this->form_validation->run() == TRUE) {
                        $npass = $CI->get_library->encode($this->input->post('npass'));
                        $where = array(
                            'email' => $email,
                        );
                        $fields = array(
                            'password' => $npass
                        );
                        $results = $this->Curl_model->update_data('users', $fields, $where);
                        if ($results) {
                            $res['results'] = "Password has been reseted.";
                            $res['href'] = base_url('login');
                            $res['btn'] = "Login Now";
                            $res['heading'] = "Successfull";
                            $this->load->view('error', $res);
                        }
                    } else {
                        $this->load->view('reset', $res);
                    }
                } else {
                    $this->load->view('reset', $res);
                }
            } else {
                $res['results'] = "This Link has been expired";
                $res['href'] = base_url();
                $res['btn'] = "Go Home";
                $res['heading'] = "Error!";
                $this->load->view('error', $res);
            }
        } else {
            $res['results'] = "Invalid Link";
            $res['href'] = base_url();
            $res['btn'] = "Go Home";
            $res['heading'] = "Error!";
            $this->load->view('error', $res);
        }
        $this->load->view('reset');
    }

    function get_states()
    {
        $stat = $this->input->post('country_id');
        $state = $this->Crud_modal->all_data_select('*', 'states', "country_id='$stat'", 'state_name ASC');
        echo '<option value="">---Select State---</option>';
        foreach ($state as $state) {
            $state_id = $state['state_id'];
            $state_nam = $state['state_name'];
            echo '<option value="' . $state_id . '">' . rtrim($state_nam, ' ') . '</option>';
        }
    }

    function get_city()
    {

        $stat = $this->input->post('state_id');
        $citys = $this->Crud_modal->all_data_select('*', 'cities', "state_id='$stat'", 'city_name ASC');
        // print_r($citys);
        echo '<option value="">---Select City---</option>';
        foreach ($citys as $city) {
            $city_id = $city['city_id'];
            $city_nam = $city['city_name'];
            echo '<option value="' . $city_id . '">' . rtrim($city_nam, ' ') . '</option>';
        }
    }

    public function preregistration()
    {
        try {
            $data['occupation'] = $this->Crud_modal->fetch_all_data('*', 'occupation', 'status= 1', 'occupation_name ASC');
            $data['opportunity'] = $this->Crud_modal->fetch_all_data('*', 'opportunity', 'opportunity_status= 1', 'opportunity_name ASC');
            $data['skills'] = $this->Crud_modal->fetch_all_data('*', 'skills', 'status= 1', 'skill_name ASC');
            $data['countries'] = $this->Crud_modal->fetch_all_data('*', 'countries', 'status= 1', 'Name ASC');
            $data['state'] = $this->Crud_modal->all_data_select('*', 'states', 'status=1 and state_id !=45', 'state_name ASC');
            $data['taskType'] = $this->Crud_modal->fetch_all_data('*', 'volunteer_type', 'status = 1');
            $this->load->view('preregistration', $data);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function post_registration_volunteer()
    {
        try {

            $volunteer_id = $this->uri->segment(2);
            $val = base64_decode(str_pad(strtr($volunteer_id, '-_', '+/'), strlen($volunteer_id) % 4, '=', STR_PAD_RIGHT));
            $where = "volunteer_id = '$val'";
            $data['allvolunteersData'] = $this->LoginModel->allDatavolunteers($val);
            // echo "<pre>";
            // print_r($data['allvolunteersData']);exit;
            $data['state'] = $this->Crud_modal->fetch_all_data('*', 'states', 'status=1');
            $data['cities'] = $this->Crud_modal->fetch_all_data('*', 'cities', 'status=1');
            $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
            $data['occupation'] = $this->Crud_modal->fetch_all_data('*', 'occupation', 'status= 1', 'occupation_name ASC');
            $data['opportunity'] = $this->Crud_modal->fetch_all_data('*', 'opportunity', 'opportunity_status= 1', 'opportunity_name ASC');
            $this->load->view('post-registration-volunteer', $data);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }


    public function insertoccupationDetails()
    {
        try {
            $volunteer_id = $this->input->post('volunteer_id');
            $emergency_contact = $this->input->post('emergency_contact');
            // echo "<pre>";
            // print_r($emergency_contact);
            // exit;
            $occupation = $this->input->post('occupation');
            $otherOccupation = $this->input->post('otherOccupation');
            $name_of_school = $this->input->post('name_of_school');
            $designation = $this->input->post('designation');
            $language = $this->input->post('language');
            $Otherlanguages = $this->input->post('otherlanguage');
            $programsInterests = $this->input->post('programsInterests');
            $otherprogramsInterests = $this->input->post('otherprogramsInterests');
            $commitment = $this->input->post('commitment');
            $knowaboutCRY = $this->input->post('where_know_opportunity');
            $where_know_opportunityBox = $this->input->post('where_know_opportunityBox');
            $signature = $this->input->post('signature');
            $dateofSubmission = $this->input->post('dateofSubmission');
            $occupationDetails = array(
                //'other_contact' => $other_contact,
                'emergency_contact' => $emergency_contact,
                'occupation' => $occupation,
                'otherOccupation' => $otherOccupation,
                'name_of_school' => $name_of_school,
                'designation' =>  $designation,
                'language' => $language,
                'Otherlanguages' => $Otherlanguages,
                'programsInterests' =>  $programsInterests,
                'communicated_cry' => $otherprogramsInterests,
                'start_date_internship' => $commitment,
                'profileofProject' => $knowaboutCRY,
                'knowaboutCRY' => $where_know_opportunityBox,
                'signature' => $signature,
                'dateofSubmission' => $dateofSubmission,

            );
            // echo "<pre>";
            // print_r($occupationDetails);
            // exit;
            $status = array(
                'status' => 4,
            );
            $where = array(
                'volunteer_id' => $volunteer_id,
            );
            $this->Curl_model->update_data('volunteer', $status, $where);
            if ($this->Curl_model->update_data('volunteer_data', $occupationDetails, $where)) {
                return 1;
            } else {
                return 1;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function program_volunteerbasicData()
    {
        try {
            $ProgramId = $this->input->post('ProgramId');
            $first_name = $this->input->post('first_name');
            $last_name = $this->input->post('last_name');
            $email = $this->input->post('email');
            $mobile_number = $this->input->post('mobile_number');
            $age = $this->input->post('age');
            $gender = $this->input->post('gender');
            $country = $this->input->post('country');
            $state_id = $this->input->post('state_id');
            $city_name = $this->input->post('city_name');
            $volunteer_programs = $this->input->post('volunteer_programs');
            $occupation = $this->input->post('occupation');
            $present_address = $this->input->post('present_address');
            $basicData1 = array(
                //'id' => $first_name,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'age' => $age,
                'gender' => $mobile_number,
                'age' => $age,
                'gender' => $gender,
                'country_id' => $country,
                'state_id' => $state_id,
                'city_id' => $city_name,
                'volunteer_programs' => $volunteer_programs,
                'occupation_id' => $occupation,
                'present_address' => $present_address,
            );

            $this->Crud_modal->user_data_insert('volunteer_program_users', $basicData1);
            //$this->Curl_model->update_data('volunteer_data', $basicData2, $where);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
    public function insertBasicdata()
    {
        try {
            $volunteer_id = $this->input->post('volunteer_id');
            $firstName = $this->input->post('firstName');
            $lastName = $this->input->post('lastName');
            $email = $this->input->post('email');
            $mobile = $this->input->post('mobile');
            $dob = $this->input->post('dob');
            //  $age = $this->input->post('age');
            $gender = $this->input->post('gender');
            $present_address = $this->input->post('present_address');
            $permanent_address = $this->input->post('permanent_address');
            $cityResindence = $this->input->post('cityResindence');
            $basicData1 = array(
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'mobile' => $mobile,
                'date_of_birth' => $dob,
                //  'age' => $age,
                'gender' => $gender,
            );
            $basicData2 = array(
                'present_address' => $present_address,
                'permanent_address' => $permanent_address,
                'cityResindence' => $cityResindence,
            );
            $where = array(
                'volunteer_id' => $volunteer_id,
            );
            // print_r($where);exit;
            $this->Curl_model->update_data('volunteer', $basicData1, $where);
            $this->Curl_model->update_data('volunteer_data', $basicData2, $where);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function post_registration_intern()
    {

        $this->load->view('post-registration-intern');
    }

    public function insert_preregistration_data()
    {
        try {

            $looking_for = $this->input->post('looking_for');
            $name = $this->input->post('first_name');
            $lname = $this->input->post('last_name');
            $dob = date('Y-m-d', strtotime($this->input->post('dob')));
            $gender = $this->input->post('gender');
            $email = $this->input->post('email');
            $mobile_number = $this->input->post('mobile_number');
            $encoded_mob = rtrim(strtr(base64_encode($mobile_number), '+/', '-_'), '=');
            $county = $this->input->post('county');
            $state_id = $this->input->post('state_id');
            $city_name = $this->input->post('city_name');
            $occupation = $this->input->post('occupation');
            //$office_location = $this->input->post('office_location');
            $volunteering_type = $this->input->post('volunteering_type');
            // echo "<pre>";
            // print_r($volunteering_type);exit;
            $where_know_opportunity = $this->input->post('where_know_opportunity');
            $internship = $this->input->post('skill_id');
            $volunteerSkill = $this->input->post('skill_id');
            $Uploade_file = $this->input->post('Uploade_file');
            $mention_past = $this->input->post('mention_past');
            $whatyou_aim = $this->input->post('whatyou_aim');


            // echo "<pre>";
            // print_r($office_location);
            // exit;


            $volunteerData = array(
                //  'looking_for' => $looking_for,
                'first_name' => $name,
                'last_name' => $lname,
                'date_of_birth' => $dob,
                'gender' => $gender,
                'email' => $email,
                'mobile' => $mobile_number,
                'country_id' => $county,
                'state_id' => $state_id,
                'city_id ' => $city_name,
                'occupation_id' => $occupation,
                //'office_location' => $office_location,
                'vol_type_id' => $volunteering_type,
                'volunteer_skill' => implode(",", $volunteerSkill),
                'where_did_u_know' => implode(",", $where_know_opportunity),
                'creation_date' => date('Y-m-d'),
                'status' => 1,
            );
            // echo "<pre>";
            // print_r($volunteerData);
            // exit;
            $internData = array(
                // 'looking_for' => $looking_for,
                'first_name' => $name,
                'last_name' => $lname,
                'date_of_birth' => $dob,
                'gender' => $gender,
                'email' => $email,
                'mobile' => $mobile_number,
                'country_id' => $county,
                'state_id' => $state_id,
                'city_id ' => $city_name,
                'occupation_id' => $occupation,
                //'office_location' => $office_location,
                'skill_id' => implode(",", $internship),
                //'cv_file' => $Uploade_file,
                'past_volunteering' => $mention_past,
                'what_you_aim' => $whatyou_aim,
                'creation_date' => date('Y-m-d'),
                'status' => 1,
            );
            // echo "<pre>";
            // print_r($internData);exit;

            if ($looking_for == 'volunteering') {
                $this->Crud_modal->user_data_insert('volunteer', $volunteerData);
                $this->session->set_flashdata('master_insert_message', '<div class="alert alert-warning"><strong>Registration Success!</strong> We Are Contact Soon.</div>');
                redirect(base_url() . 'thank-you');
            } else {

                $config['upload_path'] = './uploads';
                $config['allowed_types']  = 'gif|jpg|png|pdf';
                $new_name = time() . $_FILES["Uploade_file"]['name'];
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('Uploade_file')) {
                    $file = $this->upload->data();
                    $internData['cv_file'] = $file['file_name'];

                    $this->Crud_modal->user_data_insert('interns', $internData);
                    $this->session->set_flashdata('master_insert_message', '<div class="alert alert-warning"><strong>Registration Success!</strong> We Are Contact Soon.</div>');
                    redirect(base_url() . 'thank-you');
                } else {
                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    $this->session->set_flashdata('assign_message', '<div class="danger"><strong>Oops!</strong>Error</div>');
                }
                //$this->Crud_modal->data_insert('interns', $internData);
            }

            $this->session->set_flashdata('volunteer_sing_up_msg', '<div class="alert alert-info"><strong>Success!</strong>  Migrant //sign up successfully.</div>');
            redirect(base_url() . 'thank-you/' . $encoded_mob);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function secondinsertBasicdata()
    {
        $volunteer_id = $this->input->post('volunteer_id');

        if ($_FILES['id_proof_attach'] != "") {
            $config['upload_path'] = './uploads/id_proof';
            $config['allowed_types'] = 'gif|jpg|png|doc|pdf|jpeg';
            $config['max_size'] = 1024 * 8;
            $new_name = time() . $_FILES["id_proof_attach"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('id_proof_attach')) {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
            } else {
                $file = $this->upload->data();
                $id_proof_attachvol['id_proof_attach'] = $file['file_name'];
                $where = array(
                    'volunteer_id' => $volunteer_id,
                );
                $this->Curl_model->update_data('volunteer_data', $id_proof_attachvol, $where);
            }
            echo json_encode(array('status' => $status, 'msg' => $msg));
        }
        if ($_FILES['add_proof_attach'] != "") {
            $config['upload_path'] = './uploads/address_proof';
            $config['allowed_types'] = 'gif|jpg|png|doc|pdf|jpeg';
            $config['max_size'] = 1024 * 8;
            $new_name = time() . $_FILES["add_proof_attach"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('add_proof_attach')) {
                $status = 'error';
                $msg = $this->upload->display_errors();
                exit;
            } else {
                $file = $this->upload->data();
                $add_proof_attachvol['add_proof_attach'] = $file['file_name'];
                $where = array(
                    'volunteer_id' => $volunteer_id,
                );
                $this->Curl_model->update_data('volunteer_data', $add_proof_attachvol, $where);
            }
            echo json_encode(array('status' => $status, 'msg' => $msg));
        }
        if ($_FILES['letter_parents_attach'] != "") {
            $config['upload_path'] = './uploads/reference_letter';
            $config['allowed_types'] = 'gif|jpg|png|doc|pdf|jpeg';
            $config['max_size'] = 1024 * 8;
            $new_name = time() . $_FILES["letter_parents_attach"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('letter_parents_attach')) {
                $status = 'error';
                $msg = $this->upload->display_errors();
                exit;
            } else {
                $file = $this->upload->data();
                $letter_parents_attachvol['letter_parents_attach'] = $file['file_name'];
                $where = array(
                    'volunteer_id' => $volunteer_id,
                );
                $this->Curl_model->update_data('volunteer_data', $letter_parents_attachvol, $where);
            }
            echo json_encode(array('status' => $status, 'msg' => $msg));
        }
        if ($_FILES['close_up_photo'] != "") {
            $config['upload_path'] = './uploads/closeup_photo';
            $config['allowed_types'] = 'gif|jpg|png|doc|pdf|jpeg';
            $config['max_size'] = 1024 * 8;
            $new_name = time() . $_FILES["close_up_photo"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('close_up_photo')) {
                $status = 'error';
                $msg = $this->upload->display_errors();
                exit;
            } else {
                $file = $this->upload->data();
                $close_up_photovol['close_up_photo'] = $file['file_name'];
                $where = array(
                    'volunteer_id' => $volunteer_id,
                );
                $this->Curl_model->update_data('volunteer_data', $close_up_photovol, $where);
            }
            echo json_encode(array('status' => $status, 'msg' => $msg));
        }
        if ($_FILES['cv_attach'] != "") {
            $config['upload_path'] = './uploads/cv';
            $config['allowed_types'] = 'gif|jpg|png|doc|pdf|jpeg';
            $config['max_size'] = 1024 * 8;
            $new_name = time() . $_FILES["cv_attach"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('cv_attach')) {
                $status = 'error';
                $msg = $this->upload->display_errors();
                exit;
            } else {
                $file = $this->upload->data();
                $cv_attachvol['cv_attach'] = $file['file_name'];
                $where = array(
                    'volunteer_id' => $volunteer_id,
                );
                $this->Curl_model->update_data('volunteer_data', $cv_attachvol, $where);
            }
            echo json_encode(array('status' => $status, 'msg' => $msg));
        }
        if ($_FILES['ref_attach'] != "") {
            $config['upload_path'] = './uploads/reference_letter';
            $config['allowed_types'] = 'gif|jpg|png|doc|pdf|jpeg';
            $config['max_size'] = 1024 * 8;
            $new_name = time() . $_FILES["ref_attach"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('ref_attach')) {
                $status = 'error';
                $msg = $this->upload->display_errors();
                exit;
            } else {
                $file = $this->upload->data();
                $ref_attachvol['ref_attach'] = $file['file_name'];
                $where = array(
                    'volunteer_id' => $volunteer_id,
                );
                $this->Curl_model->update_data('volunteer_data', $ref_attachvol, $where);
            }
            echo json_encode(array('status' => $status, 'msg' => $msg));
        }
    }

    public function email_ajax_check()
    {
        $data['email_exsist'] = $this->LoginModel->email_exsist();

        if ($data['email_exsist'] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }


    public function create_emailOtp()
    {
        $email = $this->input->post('VOLUNTEEREMAIL');
        $length = 4;
        $to = $email;
        $keys = array_merge(range(0, 9), range(0, 9));
        //print_r($keys);exit;
        $key = "";
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[mt_rand(0, count($keys) - 1)];
        }
        //echo $key;exit;
        echo  $this->preregistration_sendMail($key, $to);
    }

    public function preregistration_sendMail($otp, $to)
    {
        $mail = new PHPMailer();
        // $mail->IsSMTP();
        $mail->Host = 'mail.mgracesolution.com';
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Username = "testvms@mgracesolution.com";
        $mail->Password = "smvtset@1234";
        $mail->setFrom('testvms@mgracesolution.com');
        $mail->AddAddress($to);
        $mail->addBCC("ravishankar.k@neuralinfo.org", "Ravi");
        $mail->FromName = 'cry Vms';
        $mail->IsHTML(true);
        $mail->Subject = 'OTP From CRY VMS ';
        $mail->Body = 'Hello User Your One Time Password is' . ' ' . $otp;
        if (!$mail->Send()) {
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {

            return $otp;
        }
    }


    public function volunteer_programs()
    {
        try {
            $programId = $this->uri->segment(2);
            $val = base64_decode(str_pad(strtr($programId, '-_', '+/'), strlen($programId) % 4, '=', STR_PAD_RIGHT));
            $where = "program_id = '$val'";
            $data['program'] = $this->LoginModel->get_all_program($val);
            // echo "<pre>";
            // print_r($data['program']);exit;
            $data['allvolunteersData'] = $this->LoginModel->allDatavolunteers($val);
            $data['occupation'] = $this->Crud_modal->fetch_all_data('*', 'occupation', 'status= 1', 'occupation_name ASC');
            $data['volunteer_programs'] = $this->Crud_modal->fetch_all_data('*', 'program_volunteer', 'status= 1', 'occupation_name ASC');
            // echo "<pre>";
            // print_r($data['volunteer_programs']);exit;
            $data['opportunity'] = $this->Crud_modal->fetch_all_data('*', 'opportunity', 'opportunity_status= 1', 'opportunity_name ASC');
            $data['skills'] = $this->Crud_modal->fetch_all_data('*', 'skills', 'status= 1', 'skill_name ASC');
            $data['countries'] = $this->Crud_modal->fetch_all_data('*', 'countries', 'status= 1', 'Name ASC');
            $data['state'] = $this->Crud_modal->all_data_select('*', 'states', 'status=1 and state_id !=45', 'state_name ASC');
            $this->load->view('volunteer-programs', $data);
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function insert_volunteer_programs()
    {
        try {
            //   $VolProgramId = $this->input->post('ProgramId');
            //   $val =  base64_encode( $VolProgramId );

            $name = $this->input->post('first_name');
            $lname = $this->input->post('last_name');
            $age = $this->input->post('age');
            $gender = $this->input->post('gender');
            $email = $this->input->post('email');
            $mobile_number = $this->input->post('mobile_number');
            // $encoded_mob = rtrim(strtr(base64_encode($mobile_number), '+/', '-_'), '=');
            $country = $this->input->post('country');
            $state_id = $this->input->post('state_id');
            $city_name = $this->input->post('city_name');
            $school = $this->input->post('school');
            $board = $this->input->post('board');
            $grade = $this->input->post('grade');
            $about_this_program = $this->input->post('about_this_program');
            $what_made_you = $this->input->post('what_made_you');
            $volunteer_programs = $this->input->post('volunteer_programs');
            // echo "<pre>";
            // print_r($volunteer_programs);exit;
            $volunteerData = array(
                //'looking_for' => $looking_for,
                'first_name' => $name,
                'last_name' => $lname,
                'age' => $age,
                'gender' => $gender,
                'email' => $email,
                'mobile' => $mobile_number,
                'country_id' => $country,
                'state_id' => $state_id,
                'city_id ' => $city_name,
                'name_of_school' => $school,
                'which_board' => $board,
                'grade' => $grade,
                'about_this_program' => $about_this_program,
                'what_made_you' => $what_made_you,
                'volunteer_programs' => $volunteer_programs,
                //'creation_date' => date('Y-m-d'),
                'status' => 1,
            );
            // echo "<pre>";
            // print_r($volunteerData);
            // exit;
            $this->Crud_modal->data_insert('volunteer_program_users', $volunteerData);
            $this->session->set_flashdata('master_insert_message', '<div class="alert alert-warning"><strong>Registration Success!</strong> We Are Contact Soon.</div>');
            redirect(base_url() . 'login');
            $this->session->set_flashdata('volunteer_sing_up_msg', '<div class="alert alert-info"><strong>Success!</strong>  Migrant //sign up successfully.</div>');
            redirect(base_url() . 'login');
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function volunteer_programs_email_ajax_check()
    {
        $data['email_exsist'] = $this->LoginModel->volunteer_programs_email_exsist();

        if ($data['email_exsist'] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function volunteer_programsCreatemailotp()
    {
        $email = $this->input->post('PROGRAME');
        $length = 4;
        $to = $email;
        $keys = array_merge(range(0, 9), range(0, 9));
        // print_r($keys);exit;
        $key = "";
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[mt_rand(0, count($keys) - 1)];
        }
        // echo $key;
        echo  $this->volunteer_programspre_registration_sendMail($key, $to);
    }


    public function volunteer_programspre_registration_sendMail($otp, $to)
    {
        $mail = new PHPMailer();
        // $mail->IsSMTP();
        $mail->Host = 'mail.mgracesolution.com';
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Username = "testvms@mgracesolution.com";
        $mail->Password = "smvtset@1234";
        $mail->setFrom('testvms@mgracesolution.com');
        $mail->AddAddress($to);
        $mail->addBCC("ravishankar.k@neuralinfo.org", "Ravi");
        $mail->FromName = 'cry Vms';
        $mail->IsHTML(true);
        $mail->Subject = 'OTP From CRY VMS ';
        $mail->Body = 'Hello User Your One Time Password Is' . ' ' . $otp;
        if (!$mail->Send()) {
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {

            return $otp;
        }
    }

    public function validate_age($age)
    {
        $dob = new DateTime($age);
        $now = new DateTime();
        return ($now->diff($dob)->y > 18) ? 'yes' : 'no';
    }

    public function inquiry()
    {
        if ($this->input->post()) {
            // print_r($this->input->post('name'));
            // die();
            $name = ucwords($this->input->post('name'));
            $email = $this->input->post('email');
            $message = ucwords($this->input->post('message'));
            $captcha = $this->input->post('captcha');
            $rcaptcha = $this->input->post('rcaptcha');
            $admin_data = $this->Curl_model->fetch_data('users', array('email'), array('roleID' => 1), 1, array('userID', 'ASC'));
            $href = base_url() . 'login';
            //$href2 = base_url().'verify/'.md5($results);
            $to = $admin_data['email'];
            $from = 'volunteer@caritasindia.org';
            $msg = 'Caritas India Volunteer';
            $msg2 = "
            <center><p><strong style='font-weight:bold;'>Inquiry details is given below</strong></p></center>
            <table style='border:1px solid #8f281f;border-top:0px solid #8f281f !important;border-spacing: 0px;width:100%;'>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Name</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $name . "</td>
                </tr>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Email</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $email . "</td>
                </tr>
                <tr>
                    <th style='border-top:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>Message</th>
                    <td style='border-top:1px solid #8f281f !important;border-left:1px solid #8f281f !important;padding:10px 20px ;text-align:left;'>" . $message . "</td>
                </tr>
            </table>";
            //die();
            $subj = "Inquiry for Caritas Indias";
            $btn = "Check Now!";

            $html = $this->request_email_without_btn($msg, $msg2);
            if ($captcha === $rcaptcha) {
                $res = $this->mail_send($to, $from, $msg, $msg2, $subj, $href, $btn, $html);
                $this->session->set_flashdata('sendmsg', 'We will contact you soon.');
            } else {
                $this->session->set_flashdata('sendmsg', 'Opps! Somthing Wrong');
            }
        }
        echo '<script>window.location.href = "' . base_url() . '"</script>';
    }

    public function mail_send($to, $from, $msg, $msg2, $subj, $link, $btn, $html)
    {
        $mail = new PHPMailer();
        // $mail->IsSMTP();
        $mail->Host = 'office365.caritasindia.org';
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Username = "volunteer@caritasindia.org";
        $mail->Password = "volunteer@123";
        $mail->setFrom($from);
        $mail->AddAddress($to);
        $mail->addBCC("ravishankar.k@neuralinfo.org", "Ravi");
        $mail->FromName = $msg;
        $mail->IsHTML(true);
        $mail->Subject = $subj;
        $mail->Body = $html;
        if (!$mail->Send()) {
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        //return true;
    }

    public function request_email($msg, $msg2, $link, $btn)
    {
        $html = '<div style="margin:0;padding:0" bgcolor="#FFFFFF">

        <table style="min-width:348px" width="100%" lang="en" height="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr style="height:32px" height="32">
                    <td>
                    </td>
                </tr>
                <tr align="center">
                    <td>
                        <div>
                            <div>
                            </div>
                        </div>
                        <table style="padding-bottom:20px;max-width:516px;min-width:220px" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td style="width:8px" width="8">
                                    </td>
                                    <td>
                                        <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px" class="m_-3835115663774870952mdv2rw" align="center">
                                            <img src="https://www.caritasindia.org/wp-content/uploads/2019/09/Caritas-India-Logo.png"
                                             aria-hidden="true" style="margin-bottom:16px" alt="caritas india" class="" width="150" height="70">
                                            <div style="border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;text-align:center;word-break:break-word">
                                            <div style="font-size:24px">
                                                ' . $msg . '
                                            </div>
                                                
                                            </div>
                                            <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">
                                            ' . $msg2 . '<div style="padding-top:32px;text-align:center">
                                            <a href="' . $link . '" 
                                            style="line-height:16px;color:#ffffff;font-weight:400;text-decoration:none;font-size:14px;display:inline-block;padding:10px 24px;background-color:#8e2c24;border-radius:5px;min-width:90px" 
                                            target="_blank" 
                                            data-saferedirecturl="' . $link . '">
                                            ' . $btn . '</a>
                                            </div>
                                            </div>
                                        </div>
                                        <div style="text-align:left">
                                            <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
                                            <div>
                                                Caritas India Headquarter:
                                                Caritas India, CBCI Centre, Ashok Place, Opposite to Goledakkhana,
                                                New Delhi - 11 00 01, India</div>
                                            <div style="direction:ltr">
                                                Tel - 91 -11 - 2336 3390 / 2374 23 39, <a class="m_-3835115663774870952afal" style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
                                                    Email - volunteer@caritasindia.org</a>
                                            </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width:8px" width="8">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr style="height:32px" height="32">
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>';
        return $html;
    }

    public function request_email_without_btn($msg, $msg2)
    {
        $html = '<div style="margin:0;padding:0" bgcolor="#FFFFFF">

        <table style="min-width:348px" width="100%" lang="en" height="100%" cellspacing="0" cellpadding="0" border="0">
            <tbody>
                <tr style="height:32px" height="32">
                    <td>
                    </td>
                </tr>
                <tr align="center">
                    <td>
                        <div>
                            <div>
                            </div>
                        </div>
                        <table style="padding-bottom:20px;max-width:516px;min-width:220px" cellspacing="0" cellpadding="0" border="0">
                            <tbody>
                                <tr>
                                    <td style="width:8px" width="8">
                                    </td>
                                    <td>
                                        <div style="border-style:solid;border-width:thin;border-color:#dadce0;border-radius:8px;padding:40px 20px" class="m_-3835115663774870952mdv2rw" align="center">
                                            <img src="https://www.caritasindia.org/wp-content/uploads/2019/09/Caritas-India-Logo.png"
                                             aria-hidden="true" style="margin-bottom:16px" alt="caritas india" class="" width="150" height="70">
                                            <div style="border-bottom:thin solid #dadce0;color:rgba(0,0,0,0.87);line-height:32px;padding-bottom:24px;text-align:center;word-break:break-word">
                                            <div style="font-size:24px">
                                                ' . $msg . '
                                            </div>
                                                
                                            </div>
                                            <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">
                                            ' . $msg2 . '<div style="padding-top:32px;text-align:center">
                                            </div>
                                            </div>
                                        </div>
                                        <div style="text-align:left">
                                            <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
                                            <div>
                                                Caritas India Headquarter:
                                                Caritas India, CBCI Centre, Ashok Place, Opposite to Goledakkhana,
                                                New Delhi - 11 00 01, India</div>
                                            <div style="direction:ltr">
                                                Tel - 91 -11 - 2336 3390 / 2374 23 39, <a class="m_-3835115663774870952afal" style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;color:rgba(0,0,0,0.54);font-size:11px;line-height:18px;padding-top:12px;text-align:center">
                                                    Email - volunteer@caritasindia.org</a>
                                            </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="width:8px" width="8">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr style="height:32px" height="32">
                    <td>
                    </td>
                </tr>
            </tbody>
        </table>
        </div>';
        return $html;
    }

    public function verify()
    {
        $link = $this->uri->segment(2);
        $link2 = $this->uri->segment(3);
        $userID = base64_decode(str_pad(strtr($link, '-_', '+/'), strlen($link) % 4, '=', STR_PAD_RIGHT));
        $email = base64_decode(str_pad(strtr($link2, '-_', '+/'), strlen($link2) % 4, '=', STR_PAD_RIGHT));
        $where = array(
            'userID' => $userID,
            'email' => $email,
        );
        $fields = array(
            'mailConfrmationStatus' => 1,
            'verify' => 1
        );
        $results = $this->Curl_model->update_data('users', $fields, $where);
        $this->load->view('verified');
    }

    public function all_state()
    {
        echo '<option value="">Select State</option>';
        $taskID = $this->input->post('taskID');
        if ($this->input->post('taskID') != 0) {

            $tempcities = $this->LoginModel->select_all_states_by_task($taskID);
            foreach ($tempcities as $key => $value) {
                echo '<option class="sv_' . $value['state_id'] . '" value="' . $value['state_id'] . '">' . ucwords($value['state_name']) . '</option>';
            }
        }
    }

    public function all_cities()
    {
        echo '<option value="">Select City</option>';
        $stateID = $this->input->post('stateId');

        if ($this->input->post('stateId') != 0) {

            $tempcities = $this->LoginModel->select_all_city_by_task($stateID);
            //print_r($tempcities);exit;
            foreach ($tempcities as $key => $value) {

                echo '<option class="cv_' . $value['city_id'] . '" value="' . $value['city_id'] . '">' . ucwords($value['city_name']) . '</option>';
            }
        }
    }

    public function all_city()
    {
        echo '<option value="">Select City</option>';
        $stateID = $this->input->post('stateId');
        if ($this->input->post('stateId') != 0) {
            $fields3 = array(
                'cityID',
                'cityName',
            );
            $where3 = array(
                'stateID' => $stateID
            );
            $limit3 = '';
            //$order_by = array('userID','DESC');
            $order_by3 = "";
            $tempcities = $this->Curl_model->fetch_data_in_many_array('cities', $fields3, $where3, $limit3, $order_by3);

            foreach ($tempcities as $key => $value) {

                echo '<option class="cv_' . $value['cityID'] . '" value="' . $value['cityID'] . '">' . ucwords($value['cityName']) . '</option>';
            }
        }
    }

    public function fetch_city()
    {
        $stateID = $this->input->post('stateId');
        if ($this->input->post('stateId') != 0) {
            $fields3 = array(
                'cityID',
                'cityName',
            );
            $where3 = array(
                'stateID' => $stateID
            );
            $limit3 = '';
            //$order_by = array('userID','DESC');
            $order_by3 = "";
            $tempcities = $this->Curl_model->fetch_data_in_many_array('cities', $fields3, $where3, $limit3, $order_by3);

            foreach ($tempcities as $key => $value) {

                echo '<option class="cv_' . $value['cityID'] . '" value="' . $value['cityID'] . '">' . ucwords($value['cityName']) . '</option>';
            }
        }
    }

    public function all_intern()
    {
        $taskType = $this->input->post('taskType');
        $taskID = $this->input->post('taskName');
        $cityID = $this->input->post('stateName');
        // print_r($taskID);exit;
        if ($this->input->post('stateName') != 0) {
            $internDetails = $this->LoginModel->assign_task_intern($cityID, $taskID);
            // print_r($internDetails);
            // exit;
?>
            <div id="tb<?php echo $cityID; ?>">
                <table class="table table-bordered">
                    <thead class="bg-gray">
                        <tr>
                            <th class="text-white"></th>
                            <th class="text-white">Name</th>
                            <th class="text-white">Mobile</th>
                            <th class="text-white">Email</th>
                            <th class="text-white">City</th>
                            <th class="text-white">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($internDetails as $value) {
                            $checked = '';
                            $encode_intern_id = rtrim(strtr(base64_encode($value['intern_id']), "+/", "-_"), "=");
                            $intern_id = $value['intern_id'];
                            $assigning_task = $this->LoginModel->assign_task_intern_taskType($cityID, $taskID, $intern_id);
                            // echo "<pre>";
                            // print_r($assigning_task);exit;
                            if (count($assigning_task) > 0) {
                                $checked = "checked disabled";
                            } else {
                                $checked = 'name="interns[]"';
                            }
                        ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="largerCheckbox" <?php echo $checked; ?> value="<?php echo $value['intern_id']; ?>" id="intern<?php echo $value['intern_id']; ?>" />
                                </td>
                                <!-- <td><?php //echo $count++; 
                                            ?></td> -->
                                <td>
                                    <?php if ($value['gender'] == 1) {
                                        echo "Mr.";
                                    } elseif ($value['gender'] == 2) {
                                        echo "Mrs.";
                                    } ?> <?php echo ucwords($value['first_name'] . ' ' . $value['last_name']); ?>
                                    <br>
                                    <a href="#" data-toggle="modal" data-target=".profile-details" onclick="fetch_details('<?php echo $encode_intern_id; ?>','profile_details');">
                                        <small class="text-primary">(View Profile)</small></a>
                                </td>
                                <td><?php echo $value['mobile']; ?></td>
                                <td><?php echo $value['email']; ?></td>
                                <td><?php echo $value['city_name']; ?></td>
                                <?php
                                if (sizeof($assigning_task) > 0) {
                                ?>
                                    <td>
                                        <span class="badge bg-success  me-1 mb-1 mt-1">Assigned</span><br>
                                        <small data-toggle="modal" data-target=".project-details" class="text-primary" onclick="fetch_task_details('<?php echo $encode_intern_id; ?>','project-details');">&nbsp;View Task</small>
                                    </td>
                                <?php } else { ?>
                                    <td><span class="badge bg-danger  me-1 mb-1 mt-1">Not Assigned</span></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <script>
                    function checked(id) {
                        alert(id);
                    }
                </script>
            </div>
        <?php

        }
    }

    public function all_valunteers()
    {
        $taskType = $this->input->post('taskType');
        $taskID = $this->input->post('taskName');
        $cityID = $this->input->post('stateName');
        //print_r($taskType);exit;
        if ($this->input->post('stateName') != 0) {
            $volunteerDetails = $this->LoginModel->assign_task_volunteer($cityID, $taskType, $taskID);
            // print_r($volunteerDetails);
            // exit;
        ?>
            <div id="tb<?php echo $cityID; ?>">
                <table class="table table-bordered">
                    <thead class="bg-gray">
                        <tr>
                            <th class="text-white"></th>
                            <th class="text-white">Name</th>
                            <th class="text-white">Mobile</th>
                            <th class="text-white">Email</th>
                            <th class="text-white">City</th>
                            <th class="text-white">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        foreach ($volunteerDetails as $value) {
                            $checked = '';
                            $encode_volunteerID = rtrim(strtr(base64_encode($value['volunteer_id']), "+/", "-_"), "=");
                            $volunteer_id = $value['volunteer_id'];

                            $assigning_task = $this->LoginModel->assign_task_volunteer_taskType($cityID, $taskID, $volunteer_id);
                            // echo "<pre>";
                            // print_r($assigning_task);exit;
                            if (count($assigning_task) > 0) {
                                $checked = "checked disabled";
                            } else {
                                $checked = 'name="valunteers[]"';
                            }
                        ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="largerCheckbox" <?php echo $checked; ?> value="<?php echo $value['volunteer_id']; ?>" id="valunteer<?php echo $value['volunteer_id']; ?>" />
                                </td>
                                <!-- <td><?php //echo $count++; 
                                            ?></td> -->
                                <td>
                                    <?php if ($value['gender'] == 1) {
                                        echo "Mr.";
                                    } elseif ($value['gender'] == 2) {
                                        echo "Mrs.";
                                    } ?> <?php echo ucwords($value['first_name'] . ' ' . $value['last_name']); ?>
                                    <br>
                                    <a href="#" data-toggle="modal" data-target=".profile-details" onclick="fetch_details('<?php echo $encode_volunteerID; ?>','profile_details');">
                                        <small class="text-primary">(View Profile)</small></a>
                                </td>
                                <td><?php echo $value['mobile']; ?></td>
                                <td><?php echo $value['email']; ?></td>
                                <td><?php echo $value['city_name']; ?></td>
                                <?php
                                if (sizeof($assigning_task) > 0) {
                                ?>
                                    <td>
                                        <span class="badge bg-success  me-1 mb-1 mt-1">Assigned</span><br>
                                        <small data-toggle="modal" data-target=".project-details" class="text-primary" onclick="fetch_task_details('<?php echo $encode_volunteerID; ?>','project-details');">&nbsp;View Task</small>
                                    </td>
                                <?php } else { ?>
                                    <td><span class="badge bg-danger  me-1 mb-1 mt-1">Not Assigned</span></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <script>
                    function checked(id) {
                        alert(id);
                    }
                </script>
            </div>
<?php

        }
    }

    public function logout()
    {
        $this->session->unset_userdata('userID');
        //die();
        echo '<script>window.location.href = "' . base_url() . 'login"</script>';
        //redirect('login');
    }

    public function partner_login()
    {
        $res['user_id'] = "";
        $res['password'] = "";
        if ($this->input->post()) {
            $res['user_id'] = $this->input->post('user_id');
            $res['password'] = $this->input->post('password');
            if ($this->input->post('signin') == 'signin') {
                $rules_array = array(
                    array(
                        'field' => 'user_id',
                        'label' => 'Email Address',
                        'rules' => 'trim|required',
                        'errors' => array(
                            'required' => 'Enter Email Address.',
                        ),
                    ),
                    array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'trim|required',
                        'errors' => array(
                            'required' => 'Enter Password',
                        ),
                    ),
                );
                $this->form_validation->set_rules($rules_array);
                if ($this->form_validation->run() == TRUE) {
                    $user_id = $this->input->post('user_id');
                    $password = $this->input->post('password');
                    $fields = array(
                        'password',
                        'user_id',
                        'email',
                        'status',
                        'dioceses_id',
                        'name',
                    );
                    $where = array(
                        'user_id' => $user_id,
                    );
                    $limit = '';
                    $order_by = '';
                    $results = $this->Curl_model->fetch_data('dioceses', $fields, $where, $limit, $order_by);
                    //print_r($results);exit;
                    if (!empty($results) && $results != '') {
                        $r_password = $results['password'];
                        if ($r_password == md5($password)) {
                            if ($results['status'] == 1) {
                                $this->session->set_userdata('dioceses_id', $results['dioceses_id']);
                                $this->session->set_userdata('partner_name', $results['name']);
                                echo '<script>window.location.href = "' . base_url() . 'partner-dashboard"</script>';
                            } else {
                                $this->session->set_userdata('error', 'Your Login has been block.');
                            }
                        } else {
                            $this->session->set_userdata('error', 'Wrong Password');
                        }
                    } else {
                        $this->session->set_userdata('error', 'Please Enter Valid Email Address');
                    }
                }
            }
        }
        $this->load->view('partner-login', $res);
    }

    public function partner_logout()
    {
        $this->session->unset_userdata('dioceses_id');
        echo '<script>window.location.href = "' . base_url() . 'partner-login"</script>';
    }

    public function test()
    {
        $CI = &get_instance();
        echo $encode_data = $CI->get_library->encode('12345678');
        echo $encode_data = $CI->get_library->decode('tY7HjYamUGu6m9A/kWLCj01fLyXKqKMTKDyL0ntLz4tDXqMkJbrA3hPyLDHuK4uhAfYKzvdFoN89FmmUEt0UBw==');
    }

    public function otp()
    {
        if ($this->session->userdata('userID')) {
            echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
        } else {
            $link = $this->uri->segment(2);
            $link2 = $this->uri->segment(3);
            $data['userID'] = $userID = base64_decode(str_pad(strtr($link, '-_', '+/'), strlen($link) % 4, '=', STR_PAD_RIGHT));
            $data['email'] = $email = base64_decode(str_pad(strtr($link2, '-_', '+/'), strlen($link2) % 4, '=', STR_PAD_RIGHT));
            //get mobile number
            $fields = array(
                'mobile'
            );
            $where = array(
                'userID' => $userID,

            );
            $limit = '';
            $order_by = array('userID', 'DESC');
            $user_record = $this->Curl_model->fetch_data('users', $fields, $where, $limit, $order_by);
            $mob = $user_record['mobile'];
            $otp = $this->create_otp();
            $where = array(
                'userID' => $userID,
            );
            $fields = array(
                'mobileOTP' => $otp,
            );
            $results = $this->Curl_model->update_data('users', $fields, $where);
            $this->sendOTP($mob, $otp);
            $this->load->view('otp', $data);
        }
    }

    public function verfy_mobile_otp()
    {
        $uid = $this->input->post('uid');
        $uotp = $this->input->post('uotp');
        $record = $this->Curl_model->check_numrow('users', 'userID=' . $uid . ' and mobileOTP="' . $uotp . '"');
        if ($record == 1) {
            $fields = array(
                'mobileConfrmationStatus' => 1,
            );
            $where = array(
                'userID' => $uid,
            );
            $this->Curl_model->update_data('users', $fields, $where);
            echo 1;
        } else {
            echo 2;
        }
    }

    public function sendOTP_bkp()
    {
        $mob = '9560031521';
        $otp = '8541';
        $massage = 'Dear User, Your OTP for Caritas India is:' . $otp . ' Thankyou';
        $msg = str_replace(' ', '%20', $massage);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://182.18.162.128/api/mt/SendSMS?ApiKey=918191&senderid=CRTSIN&channel=trans&DCS=0&flashsms=0&number=" . $mob . "&text=" . $msg . "&route=8",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 85bd4deb-2816-307f-8948-0dfbaddd4386"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }

    public function sendOTP($mobileNumber, $otp)
    {
        $msg = 'Dear User, Your OTP for Caritas India is:' . $otp . ' Thankyou';
        $message = urlencode($msg);
        $authKey = "367517AJfEyIv5Cbi614b363dP1";
        $senderId = "CRTSIN";
        $tempID = "1207163117852320807";
        $route = "4";
        $postData = array(
            'authkey' => $authKey,
            'mobiles' => '91' . $mobileNumber,
            'message' => $message,
            'DLT_TE_ID' => $tempID,
            'sender' => $senderId,
            'route' => $route
        );
        $url = "http://map.txtapi.com//api/sendhttp.php";
        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
            //,CURLOPT_FOLLOWLOCATION => true
        ));
        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        //get response
        $output = curl_exec($ch);

        //Print error if any
        if (curl_errno($ch)) {
            echo 'error:' . curl_error($ch);
        } else {
            return $output;
        }
        curl_close($ch);
    }

    public function create_otp()
    {
        $length = 4;
        $keys = array_merge(range(0, 9), range(0, 9));

        $key = "";
        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[mt_rand(0, count($keys) - 1)];
        }
        return $key;
    }

    public function otp_login()
    {
        if ($this->session->userdata('userID')) {
            echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
        }
        $CI = &get_instance();
        $res['mobile'] = "";
        if ($this->input->post()) {
            $res['mobile'] = $this->input->post('mobile');
            if ($this->input->post('signin') == 'signin') {
                $rules_array = array(
                    array(
                        'field' => 'mobile',
                        'label' => 'Mobile No.',
                        'rules' => 'trim|required|min_length[10]|max_length[10]',
                        'errors' => array(
                            'required' => 'Please Enter Mobile No.',
                            'min_length' => 'Invalid Mobile No.',
                            'max_length' => 'Invalid Mobile No.',
                        ),

                    ),
                );

                $this->form_validation->set_rules($rules_array);
                if ($this->form_validation->run() == TRUE) {
                    $mobile = $this->input->post('mobile');
                    $results = $this->LoginModel->fetch_details($mobile, '');
                    if (!empty($results) && $results != '') {
                        if ($results['status'] == 1) {
                            $otp = $this->create_otp();
                            $userID = $results['userID'];
                            $res['userID'] = $userID;
                            $where = array(
                                'userID' => $userID,
                            );
                            $fields = array(
                                'mobileOTP' => $otp,
                            );
                            $results = $this->Curl_model->update_data('users', $fields, $where);
                            $this->sendOTP($mobile, $otp);
                            $this->load->view('verify_otp_login', $res);
                        } else {
                            $this->session->set_userdata('error', 'Your account deactivated please contact to the admin.');
                        }
                    } else {
                        $this->session->set_userdata('error', 'Please Enter Valid Mobile Number');
                    }
                }
            }
        }
        $this->load->view('otp_login', $res);
    }

    public function verfy_login_otp()
    {
        $res['userID'] = $uid = $this->input->post('uid');
        $res['mobile'] =  $mobile = $this->input->post('mobile');
        if ($this->input->post('otp') !== '') {
            $uotp = $this->input->post('otp');
            $record = $this->Curl_model->check_numrow('users', 'userID=' . $uid . ' and mobile="' . $mobile . '" and mobileOTP="' . $uotp . '"');
            if ($record == 1) {
                $fields = array(
                    'mobileConfrmationStatus' => 1,
                );
                $where = array(
                    'userID' => $uid,
                );
                $this->Curl_model->update_data('users', $fields, $where);
                $this->login_with_mobile($mobile);
            } else {
                $this->session->set_userdata('error', 'OTP not matched.');
                $this->load->view('verify_otp_login', $res);
            }
        } else {
            $this->session->set_userdata('error', 'Enter OTP.');
            $this->load->view('verify_otp_login', $res);
        }
    }

    public function login_with_mobile($mobile)
    {
        $results = $this->LoginModel->fetch_details($mobile, '');
        $uid = $results['userID'];
        if (!empty($results) && $results != '') {
            if ($results['status'] == 1) {
                if ($results['mobileConfrmationStatus'] == 1) {
                    if ($results['mailConfrmationStatus'] == 1) {
                        if ($results['roleID'] == 2) {
                            if ($results['verify'] == 1) {
                                //redirect('dashboard');
                                $this->session->set_userdata('userID', $results['userID']);
                                $this->session->set_userdata('roleID', $results['roleID']);
                                echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
                            } else if ($results['verify'] == 2) {
                                $this->session->set_userdata('error', 'Your Verification has been block.');
                            } else {
                                $this->session->set_userdata('error', 'Your Verification is pending from admin side');
                            }
                        } else {
                            $this->session->set_userdata('userID', $results['userID']);
                            $this->session->set_userdata('roleID', $results['roleID']);
                            echo '<script>window.location.href = "' . base_url() . 'admin-dashboard"</script>';
                        }
                    } else {
                        $this->session->set_userdata('error', 'First Verify from your email');
                    }
                } else {
                    $this->session->set_userdata('error', 'First Verify from your mobile number<br>');
                }
            } else {
                $this->session->set_userdata('error', 'Your account deactivated please contact to the admin.');
            }
        } else {
            $this->session->set_userdata('error', 'Please Enter Valid Email Address');
        }
    }

    public function thank_you()
    {

        $this->load->view('thank-you');
    }
}
