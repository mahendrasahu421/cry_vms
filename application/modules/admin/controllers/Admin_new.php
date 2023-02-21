<?php 

use SebastianBergmann\Exporter\Exporter;
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class Admin extends MY_Controller
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


    public function update_certificate_data(){
        $intern_id =$this->input->post('intern_id');
        $intern_email = $this->input->post('intern_email');
        $emialcontent = $this->input->post('emialcontent');
        $intern = $this->Crud_modal->fetch_single_data('*', 'interns', "intern_id=$intern_id");
        // $email_templates = $this->Crud_modal->fetch_all_data('*', 'email_templates', 'status=1 AND email_templates_id=5');
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
        $pdf->SetFont('Arial', '', 9);
        $pdf->Image(base_url() . '/uploads/offer.png', 10, 8, 185);
       // $pdf->Image($_SERVER['DOCUMENT_ROOT'] . '/uploads/Intern-offer-Letter.png', 10, 7, 185);
        $pdf->SetY(38.6);
        $pdf->SetX(147);
        $pdf->Cell(10,5,$date,0,'R');
        $pdf->SetY(60);
        $pdf->Ln(5);
        $pdf->SetX(20);
        $pdf->multiCell(170, 4, strip_tags($offerEmailFormat),5);
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
      $pdf->Image(base_url() . '/uploads/offer.png', 10, 8, 185);
       //$pdf->Image($_SERVER['DOCUMENT_ROOT'] . '/uploads/offer.png', 10, 8, 185);
        $pdf->SetY(38.6);
        $pdf->SetX(147);
        $pdf->Cell(10,5,$date,0,'R');
        $pdf->SetY(60);
        $pdf->Ln(5);
        $pdf->SetX(20);
        $pdf->multiCell(170, 4, strip_tags($offerEmailFormat),5);
        $path = 'offeremail/' . rand() . '.pdf';
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