<?php 

use SebastianBergmann\Exporter\Exporter;
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class Admin_new extends MY_Controller
{
    public $nama_tabel = 'dioceses';
    public function __construct()
    {
        parent::__construct();
        error_reporting(0);
        // if ($this->session->userdata('userID')) {
        //     if ($this->session->userdata('roleID') == 2) {
        //         echo '<script>window.location.href = "' . base_url() . 'dashboard"</script>';
        //     } else {
        //     }
        // } else {
        //     echo '<script>window.location.href = "' . base_url() . 'login"</script>';
        // }
        $CI = &get_instance();
        $CI->load->library('Get_library');
        $this->load->library('upload');
        $this->load->library('csvimport');
        //$this->load->library("PHPExcel");
        $this->load->helper('url');
        $this->load->library("pagination");
        $this->load->model('crud/Crud_modal');
        $this->load->model('curl/Curl_model');
        $this->load->model('users/User_model');
        $this->load->model('admin/Admin_model');
        $this->load->library('Phpmailer');
        $this->load->library('Fpdf_gen');

        date_default_timezone_set('Asia/Kolkata');
    }

    public function designation(){
        try{
            if($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null){
                $data['designation'] = $this->Crud_modal->fetch_all_data('*','designation', 'status=1');
                
             $this->load->view('temp/head');
             $this->load->view('temp/header',$data);
             $this->load->view('temp/sidebar');
             $this->load->view('designation',$data);
             $this->load->view('temp/footer');
            }else {
                redirect(base_url() . 'login', 'refresh');
            }

        }catch(Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
       
    }
    public function add_designation(){
        try{
            if($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null){
               
             $this->load->view('temp/head');
             $this->load->view('temp/header');
             $this->load->view('temp/sidebar');
             $this->load->view('add-designation');
             $this->load->view('temp/footer');
            }else {
                redirect(base_url() . 'login', 'refresh');
            }

        }catch(Exception $e){
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
       
    }

    public function insert_designation_master()

	{

		try {

			$createdata = array(

				'des_name' => $this->input->post('designation_name'),

				'creation_date' => date('Y-m-d H:i:s'),

				'status' => $this->input->post('status'),

			);

			$this->Crud_modal->data_insert('designation', $createdata);

			$this->session->set_flashdata('designation_insert_message', '<div class="alert alert-info"><strong>Success!</strong> Designation has Inserted.</div>');

			redirect(base_url() . 'designation');
		} catch (Exception $e) {

			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
    
    public function update_designation_master()

	{

		$des_id = $this->input->post('des_id');

		$designation_name = $this->input->post('designation_name');

		$status = $this->input->post('status');

		$update_data = array(

			'des_name' => $designation_name,

			'status' => $status,

			'modification_date' => date('Y-m-d')

		);



		$where = "des_id = '$des_id'";

		if ($this->Crud_modal->update_data($where, 'designation', $update_data)) {

			$this->session->set_flashdata('master_designation', '<div class="alert alert-warning"><strong>Success!</strong> Designation Data has Updated.</div>');

			redirect(base_url() . 'designation');
		} else {

			$this->session->set_flashdata('master_designation', '<div class="alert alert-danger"><strong>Failed!</strong> to Updated Data</div>');

			redirect(base_url() . 'designation');
		}
	}
    public function edit_designation()

	{

		try {

			if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {

				$des_id = $this->uri->segment(2);

				$val = base64_decode(str_pad(strtr($des_id, '-_', '+/'), strlen($des_id) % 4, '=', STR_PAD_RIGHT));

				$where = "des_id = '$val'";

				$data['pravasi_designation'] = $this->Crud_modal->all_data_select('*', 'designation', $where, 'des_id desc');
            

				$this->load->view('temp/head');

				$this->load->view('temp/header');

				$this->load->view('temp/sidebar');

				$this->load->view('edit-designation', $data);

				$this->load->view('temp/footer');
			} else {

				redirect(base_url() . 'login', 'refresh');
			}
		} catch (Exception $e) {

			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
 public function intern_request_certificate()
 {
     try {
         if (($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null)) {
             $region = $this->session->userdata('region_id');
             $role = $this->session->userdata('role_id');
            
             if ($role == 1) {
                 $date2 = $data['date_to'] = date("Y-m-d");
                 $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                 $where = 'i.status =7 AND isr.status = 2 AND fd.status=1 AND';
                 if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "" && $this->input->post('region_id') != "") {
                    $empId = $this->session->userdata('emp_id');
                     $data['state'] =  $state_name = $this->input->post('state_name');
                     $data['region_id'] =  $region_id = $this->input->post('region_id');
                     $date1 = $this->input->post('start_new');
                     $date2 = $this->input->post('end_new');
                     $date_from = date("Y-m-d", strtotime($date1));
                     $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                     $data['creation_date'] = $date1;
                     $data['creation_date'] = $date2;
                     $data['state_name'] = $state_name;
                     $where = "fd.creation_date>='" . $date_from . "' and fd.creation_date<='" . $date_to . "' and i.state_id=" . $state_name . "  and (i.status =7 AND isr.status = 2 AND fd.status=1)";
                    
                    
                     $data['feedbackCertifecate'] = $this->Admin_model->send_certificate_by_feedback($where,$empId,$role);
                     echo "<pre>";
                     print_r($data['feedbackCertifecate']);exit;
                     $data['email_templates'] = $this->Crud_modal->fetch_single_data('email_templates_id,body_content', 'email_templates', 'status=1 AND email_templates_id=9');
                      $searchArray = array("Mr. Deepanshu Mittal","Hindi College, Delhi","Bitapi Baruah","Senior Manager","Deepanshu");
                      $latsarrayTemplate = array(
                          "Dear" ." ".$data['feedbackCertifecate'][0]['first_name']." ".$data['feedbackCertifecate'][0]['last_name'],
                          $data['feedbackCertifecate'][0]['name_of_school'],
                          $data['feedbackCertifecate'][0]['emp_name'],
                          $data['feedbackCertifecate'][0]['role_name'],
                          $data['feedbackCertifecate'][0]['first_name'],
                        
                      );
                      $lasttemplate = str_replace($searchArray, $latsarrayTemplate, $data['email_templates']['body_content'], $count);
                      $data['final_offerdata'] = $lasttemplate;
                        
                 }
             } else {
                 $data['rname'] = $this->Curl_model->fetch_single_data('region_name,state_id', 'regions', array('region_id' => $region));
                 $data['states'] = $this->Crud_modal->fetch_all_data('*', 'states', 'region_id=' . $region);
                 $date2 = $data['date_to'] = date("Y-m-d");
                 $data['date_from'] = date("Y-m-d", strtotime($date2 . '-7 days'));
                 $where = 'i.status =7';
                 if ($this->input->post('start_new') != "" && $this->input->post('end_new') != "" &&  $this->input->post('state_name') != "") {
                     $data['state'] =   $state_name = $this->input->post('state_name');
                     $date1 = $this->input->post('start_new');
                     $date2 = $this->input->post('end_new');
                     $date_from = date("Y-m-d", strtotime($date1));
                     $date_to = date("Y-m-d", strtotime($date2 . '+1 days'));
                     $data['creation_date'] = $date1;
                     $data['creation_date'] = $date2;
                     $data['state_name'] = $state_name;
                     $where = "creation_date>='" . $date_from . "' and creation_date<='" . $date_to . "' and v.state_id=" . $state_name . "  and (v.status=1 OR v.status=2)";
                     $data['volunteer'] = $this->Admin_model->volunteer_enquiry_Data($where);
                 }
             }

            
             $data['regions'] = $this->Crud_modal->fetch_all_data('*', 'regions', 'region_status=1');
             
             $this->load->view('temp/head');
             $this->load->view('temp/header', $data);
             $this->load->view('temp/sidebar');
             $this->load->view('intern-request-certificate', $data);
             $this->load->view('temp/footer');
         } else {
             redirect(base_url() . 'login', 'refresh');
         }
     } catch (Exception $e) {
         echo 'Caught exception: ',  $e->getMessage(), "\n";
     }
 }


    public function update_certificate_data(){
        $intern_id =$this->input->post('intern_id');
        $intern_email = $this->input->post('intern_email');
        $emialcontent = $this->input->post('emialcontent');
        $intern = $this->Crud_modal->fetch_single_data('*', 'interns', "intern_id=$intern_id");
        $where = 'intern_id = "' . $intern_id . '" AND email = "' . $intern_email . '"';
        $emailData = array(
            'certificate_email' => strip_tags($emialcontent),
        );
        $this->Crud_modal->update_data($where, 'interns', $emailData);
    }

    public function view_certificate()
    {
        $intern_id = $this->uri->segment(2);
        $val = base64_decode(str_pad(strtr($intern_id, '-_', '+/'), strlen($intern_id) % 4, '=', STR_PAD_RIGHT));
        $where = 'intern_id = "' . $val . '"';
        $internemailData = $this->Crud_modal->fetch_single_data('*', 'interns', $where);
        $offerEmailFormat = $internemailData['certificate_email'];
        $date= date('d-m-Y');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 11);
        $pdf->Image(base_url() . '/uploads/certificate.png', 10, 8, 185);
       // $pdf->Image($_SERVER['DOCUMENT_ROOT'] . '/uploads/Intern-offer-Letter.png', 10, 7, 185);
        $pdf->SetY(38.6);
        $pdf->SetX(147);
        $pdf->Cell(10,5,$date,0,'R');
        $pdf->SetY(70);
        $pdf->Ln(5);
        $pdf->SetX(20);
        $pdf->multiCell(170, 8, strip_tags($offerEmailFormat),5);
        $pdf->Output();
        $this->load->view('view_certificate');

    }

    public function send_certificate_letter( $internemailData)
    {
 
         $offerEmailFormat = $internemailData['offer_latter_email'];
        $date= date('d-m-Y');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 9);
      $pdf->Image(base_url() . '/uploads/certificate.png', 10, 8, 185);
       //$pdf->Image($_SERVER['DOCUMENT_ROOT'] . '/uploads/offer.png', 10, 8, 185);
        $pdf->SetY(38.6);
        $pdf->SetX(147);
        $pdf->Cell(10,5,$date,0,'R');
        $pdf->SetY(70);
        $pdf->Ln(5);
        $pdf->SetX(20);
        $pdf->multiCell(170, 4, strip_tags($offerEmailFormat),5);
        $path = 'certificate/' . rand() . '.pdf';
        $pdf->Output($path, 'F');
        return $path;
        $this->load->view('view_offer_letter');
    }
    
    public function send_certificate_on_mail()
    {
        $intern_id = $this->uri->segment(2);
        $val = base64_decode(str_pad(strtr($intern_id, '-_', '+/'), strlen($intern_id) % 4, '=', STR_PAD_RIGHT));
        $where = 'intern_id = "' . $val . '"';
        $internemailData = $this->Crud_modal->fetch_single_data('first_name,last_name,email,certificate_email', 'interns', $where);
        $internEmail = $internemailData['email'];
        $to = $internEmail;
        $att = $this->send_certificate_letter($internemailData);
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Port = 587;
        $mail->Username = "noreply@crymail.org";
        $mail->Password = "^%n7wh#m7_2k";
        $mail->setFrom('noreply@crymail.org');
        $mail->AddAttachment($att);
        $mail->AddAddress($to);
        $mail->addBCC("ravishankar.k@neuralinfo.org", "Ravi");
        $mail->FromName = 'cry Vms';
        $mail->IsHTML(true);
        $mail->Subject = 'Cry Offer Letter';
        $mail->Body = 'Certificate';
        if (!$mail->Send()) {
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {

            $this->Admin_model->update_send_certificate_mail($val);
            redirect(base_url() . 'intern-request-certificate/');
        }
    }

}

?>