<?php 
use SebastianBergmann\Exporter\Exporter;
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class Hr_proccess extends MY_Controller
{
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

    public function shortlist_mail()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            $emp_id = $this->session->userdata('emp_id');
            $intern_id = $this->input->post('intern_id');
            $user_data = $this->Crud_modal->fetch_single_data("first_name,email", "interns", "intern_id='$intern_id'");
            $data['user_name'] = $user_data['first_name'];
            $data['user_email'] = $user_data['email'];
            if ($this->Admin_model->shortlist_mail($data)) {
                $this->Crud_modal->update_data("intern_id='$intern_id'", "interns", ['status' => '2']);
                echo true;
            } else {
                echo false;
            }
        }
    }

    public function shortlist_status_update()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            $intern_id = $this->input->post('intern_id');
            $status = $this->input->post('status');
            if ($status == 0) { // when reject
                if ($this->Crud_modal->update_data("intern_id='$intern_id'", "interns", ['status' => '0'])) {
                    echo true;
                } else {
                    echo false;
                }
            } else if ($status == 2) { // when shortlist for next round
                if ($this->Crud_modal->update_data("intern_id='$intern_id'", "interns", ['status' => '2'])) {
                    echo true;
                } else {
                    echo false;
                }
            } else {
                echo false;
            }
        }
    }

    function get_same_day_schedule_user_count()
    {
        $emp_id = $this->session->userdata('emp_id');
        $date = date("Y-m-d", strtotime($this->input->post('date_value')));
        echo $this->Crud_modal->check_numrow("interview_schedule_detail", "schedule_date_time like '%$date%'");
    }

    
    public function save_interview_schedule_data()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            
            if ($this->input->post('schedule_id') == '') {
                $intern_id = $this->uri->segment(2);
                $val = base64_decode(str_pad(strtr($intern_id, '-_', '+/'), strlen($intern_id) % 4, '=', STR_PAD_RIGHT));
                
                $data['mode'] = $data1['mode'] = $this->input->post('mode');
                $data['hr_description'] = $this->input->post('hr_description');
                $data['schedule_date_time'] = $data1['reschedule_date_time'] = date("Y-m-d H:i:s", strtotime($this->input->post('schedule_date') . ' ' . $this->input->post('schedule_time')));
                if ($data['mode'] == "Face to Face") {
                    $data['venue'] = $this->input->post('venue');
                }
                $intern_id = $this->input->post('intern_id');
                $data['round'] = $data1['round'] = $this->input->post('round');
                $data['intern_id'] = $data1['intern_id'] = $this->input->post('intern_id');
                $data['created_date'] = $data1['created_date'] = date("Y-m-d H:i:s");
                $data['created_by'] = $data1['created_by'] = $this->session->userdata('emp_id');
                $this->Crud_modal->update_data("intern_id='$intern_id'", "interns", ['status' => '3']);
                $this->Crud_modal->data_insert("interview_schedule_detail", $data);
                $this->Crud_modal->data_insert("interview_reschedule", $data1);
            } else {
                $intern_id = $this->uri->segment(2);
                $val = base64_decode(str_pad(strtr($intern_id, '-_', '+/'), strlen($intern_id) % 4, '=', STR_PAD_RIGHT));
                $data['mode'] = $data1['mode'] = $this->input->post('mode');
                $data['hr_description'] = $this->input->post('hr_description');
                $data['schedule_date_time'] = $data1['reschedule_date_time'] = date("Y-m-d H:i:s", strtotime($this->input->post('schedule_date') . ' ' . $this->input->post('schedule_time')));
                if ($data['mode'] == "Face to Face") {
                    $data['venue'] = $this->input->post('venue');
                }
                $data['round'] = $data1['round'] = intval($this->input->post('round')) - 1;
                $data['intern_id'] = $data1['intern_id'] = $this->input->post('intern_id');
                $data['created_date'] = $data1['created_date'] = date("Y-m-d H:i:s");
                $intern_id = $this->input->post('intern_id');
                $data['created_by'] = $data1['created_by'] = $this->session->userdata('emp_id');
                $schedule_id = $this->input->post('schedule_id');
                $this->Crud_modal->update_data("intern_id='$intern_id'", "interns", ['status' => '3']);
                $this->Crud_modal->update_data("schedule_id='$schedule_id'", "interview_schedule_detail", $data);
                $this->Crud_modal->data_insert("interview_reschedule", $data1);
            }
        }
    }

    
    function clear_interview()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            //$intern_id = $this->uri->segment(2);
           // $val = base64_decode(str_pad(strtr($intern_id, '-_', '+/'), strlen($intern_id) % 4, '=', STR_PAD_RIGHT));
            //print_r($this->input->post());
            $data['round_status'] = $this->input->post('status');
            $data['comment'] = $this->input->post('comment');
            $schedule_id = $this->input->post('schedule_id');
            $intern_id = $this->input->post('intern_id');
            $date2  = date("Y-m-d");
            $where = array(
            'intern_id' => $intern_id,
            );
             $fields = array(
                'status' => 5,
                'modification_date' => $date2
            );
            $this->Curl_model->update_data('interns', $fields, $where);
           // $this->Crud_modal->update_data("intern_id='$intern_id'", "interns", ['status' => '5', 'modification_date' => $date]);
            //$this->Crud_modal->update_data("intern_id='$intern_id'", "interns", ['modification_date' => $date]);
            if ($this->Crud_modal->update_data("schedule_id='$schedule_id'", "interview_schedule_detail", ['job_process_step' => '4-0'])) {
                if ($this->Crud_modal->update_data("schedule_id='$schedule_id'", "interview_schedule_detail", $data)) {
                    echo true;
                } else {
                    echo false;
                }
            } else {
                echo false;
            }
        }
    }
    function ongoing_interview()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            //print_r($this->input->post());
            $intern_id = $this->uri->segment(2);
           // $val = base64_decode(str_pad(strtr($intern_id, '-_', '+/'), strlen($intern_id) % 4, '=', STR_PAD_RIGHT));
            $data['round_status'] = $this->input->post('status');
            $data['comment'] = $this->input->post('comment');
            $schedule_id = $this->input->post('schedule_id');
            $this->Crud_modal->update_data("intern_id='$intern_id'", "interns", ['status' => '4']);
            if ($this->Crud_modal->update_data("schedule_id='$schedule_id'", "interview_schedule_detail", $data)) {
                $data1['intern_id'] = $this->input->post('intern_id');
                $data1['round'] = $this->input->post('round');
                $data1['created_by'] = $this->session->userdata('emp_id');
                $data1['created_date'] = date("Y-m-d H:i:s");
                if ($this->Crud_modal->data_insert("interview_schedule_detail", $data1)) {
                    echo true;
                } else {
                    echo false;
                }
            } else {
                echo false;
            }
        }
    }
    function reject_interview()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            //print_r($this->input->post());
            $intern_id = $this->uri->segment(2);
            $val = base64_decode(str_pad(strtr($intern_id, '-_', '+/'), strlen($intern_id) % 4, '=', STR_PAD_RIGHT));
            $data['round_status'] = $this->input->post('status');
            $data['comment'] = $this->input->post('comment');
            $schedule_id = $this->input->post('schedule_id');
            $this->Crud_modal->update_data("intern_id='$val'", "interns", ['status' => '10']);
            if ($this->Crud_modal->update_data("schedule_id='$schedule_id'", "interview_schedule_detail", ['job_process_step' => '3-1'])) {
                if ($this->Crud_modal->update_data("schedule_id='$schedule_id'", "interview_schedule_detail", $data)) {
                    echo true;
                } else {
                    echo false;
                }
            } else {
                echo false;
            }
        }
    }

    function update_job_schedule_data()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            //print_r($this->input->post());
            $intern_id = $this->uri->segment(2);
            $val = base64_decode(str_pad(strtr($intern_id, '-_', '+/'), strlen($intern_id) % 4, '=', STR_PAD_RIGHT));
            $data['mode'] = $data1['mode'] = $this->input->post('mode');
            $data['schedule_date_time'] = $data1['reschedule_date_time'] = date("Y-m-d H:i:s", strtotime($this->input->post('schedule_date') . ' ' . $this->input->post('schedule_time')));
            if ($data['mode'] == "Face to Face") {
                $data['venue'] = $this->input->post('venue');
            }
            $data['comment'] = $this->input->post('comment');
            $data1['round'] = intval($this->input->post('round')) - 1;
            $data1['intern_id'] = $this->input->post('intern_id');
            $data['created_date'] = $data1['created_date'] = date("Y-m-d H:i:s");
            $data['created_by'] = $data1['created_by'] = $this->session->userdata('emp_id');
            $data['round_status'] = 0;
            $schedule_id = $this->input->post('schedule_id');
            $this->Crud_modal->update_data("intern_id='$val'", "interns", ['status' => '3']);
            $this->Crud_modal->update_data("schedule_id='$schedule_id'", "interview_schedule_detail", $data);
            $this->Crud_modal->data_insert("interview_reschedule", $data1);
        }
    }

    
    function mail_interview_data()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            $intern_id = $this->uri->segment(2);
            $val = base64_decode(str_pad(strtr($intern_id, '-_', '+/'), strlen($intern_id) % 4, '=', STR_PAD_RIGHT));
            $round = intval($this->input->post('round')) - 1;
            $emp_id = $this->session->userdata('emp_id');
            $intern_id = $this->input->post('intern_id');
            $user_data = $this->Crud_modal->fetch_single_data("first_name,last_name, email ", "interns", "intern_id='$intern_id'");
            $data['mode'] = $this->input->post('mode');
            $data['schedule_date'] = $this->input->post('schedule_date');
            $data['schedule_time'] = $this->input->post('schedule_time');
            $data['venue'] = $this->input->post('venue');
            $data['hr_description'] = $this->input->post('hr_description');
            $data['first_name'] = $user_data['first_name'];
            $data['last_name'] = $user_data['last_name'];
            $data['user_email'] = $user_data['email'];
            if ($this->input->post('data_action') == '') {
                if ($this->Admin_model->schedule_mail_to_user($data)) {
                     $this->Crud_modal->update_data("intern_id='$val'", "interns", ['status' => '3']);
                    echo true;
                } else {
                    echo false;
                }
            } else {
                $old_schedule_data = $this->Admin_model->get_prev_schedule_date("reschedule_date_time,reschedule_id", "interview_reschedule", "intern_id='$intern_id' and round='$round' and created_by='$emp_id'", "reschedule_id desc");
                $data['old_schedule_date'] = date("F d,Y", strtotime($old_schedule_data['reschedule_date_time']));
                $data['old_schedule_time'] = date("h:i A", strtotime($old_schedule_data['reschedule_date_time']));
                if ($this->Admin_model->reschedule_mail_to_user($data)) {
                    echo true;
                } else {
                    echo false;
                }
            }
        }
    }

    function interview_final_mail()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            $emp_id = $this->session->userdata('emp_id');
            $intern_id = $this->input->post('intern_id');
             $date2  = date("Y-m-d");
            $where = array(
            'intern_id' => $intern_id,
            );
             $fields = array(
                'status' => 5,
                'modification_date' => $date2
            );
            $this->Curl_model->update_data('interns', $fields, $where);
            $user_data = $this->Crud_modal->fetch_single_data("first_name,last_name,email", "interns", "intern_id='$intern_id'");
            $interview_status = $this->Crud_modal->fetchdata_with_limit("job_process_step", "interview_schedule_detail", "intern_id='$intern_id'", "schedule_id desc", 1);
            $process_step = explode('-', $interview_status[0]['job_process_step']);
            $data['user_name'] = $user_data['first_name'];
            $data['user_email'] = $user_data['email'];
            if ($process_step[0] == 4) {
                if ($this->Admin_model->interview_final_mail($data)) {
                    echo true;
                } else {
                    echo false;
                }
            }
        }
    }

    
    function send_offer_to_user()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            $config['upload_path'] = './uploads/offer_letter/';
            $config['allowed_types'] = 'pdf';
            $config['max_size'] = 2000;
            $config['file_name'] = date("dmYhis") . '-' . $_FILES['offer_letter']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('offer_letter')) {
                $data1 = $this->upload->data();
                $full_path = $data1['full_path'];
                $file_name = $data1['file_name'];
                $data['offer_letter'] = $data1['file_name'];
                $data['job_process_step'] = '5-0';
                $data['status'] = '5';
                $intern_id = $this->input->post('intern_id');
                $enc_intern = rtrim(strtr(base64_encode($intern_id), "+/", "-_"), "=");
                $url = base_url('post-registration-intern/' . $enc_intern);
                $this->Crud_modal->update_data("intern_id='$intern_id'", "interns", $data);
                $user_data = $this->Crud_modal->fetch_single_data("first_name,email", "interns", "intern_id='$intern_id'");
                $data['first_name'] = $user_data['first_name'];
                $data['email'] = $user_data['email'];
                if ($this->Admin_model->send_offer_letter($full_path, $file_name, $data, $url)) {
                    echo true;
                    $this->Crud_modal->update_data("intern_id='$intern_id'", "interns", $data);
                } else {
                    echo false;
                }
            } else {
                $error = array('error' => $this->upload->display_errors());
                print_r($error);
            }
        }
    }

    public function update_offer_latter()
    {
        try {
            $inter_id = $this->input->post('intern_id');
            $offerLatter_update_date = $this->input->post('offerLatter_update_date');
            $internshipType = $this->input->post('internshipType');
            $internship_durations = $this->input->post('internship_durations');
            $where = 'intern_id = "' . $inter_id . '"';
            $update_intershiopjoiningData = array(
                'joining_date' => $offerLatter_update_date,
                'internshipType' => $internshipType,
                'internshipDeruation' => $internship_durations,

            );
            if ($this->Crud_modal->update_data($where, 'interns', $update_intershiopjoiningData)) {
                echo 1;
            } else {
                return 2;
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }

    public function view_offer_letter()
    {
        $intern_id = $this->uri->segment(2);
        $val = base64_decode(str_pad(strtr($intern_id, '-_', '+/'), strlen($intern_id) % 4, '=', STR_PAD_RIGHT));
        $where = 'intern_id = "' . $val . '"';
        $internemailData = $this->Crud_modal->fetch_single_data('*', 'interns', $where);
        $offerEmailFormat = $internemailData['offer_latter_email'];
        $date = date('d-m-Y');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Image(base_url() . '/uploads/offer.png', 10, 8, 185);
        //$pdf->Image($_SERVER['DOCUMENT_ROOT'] . '/uploads/Intern-offer-Letter.png', 10, 7, 185);
        $pdf->SetY(38.6);
        $pdf->SetX(147);
        $pdf->Cell(10, 5, $date, 0, 'R');
        $pdf->SetY(60);
        $pdf->Ln(5);
        $pdf->SetX(20);
        $pdf->multiCell(170, 4, strip_tags($offerEmailFormat), 5);
        $pdf->Output();
        $this->load->view('view_offer_letter');
    }
    
    public function send_offerLetter_emails()
    {
        $intern_id = $this->uri->segment(2);
        $val = base64_decode(str_pad(strtr($intern_id, '-_', '+/'), strlen($intern_id) % 4, '=', STR_PAD_RIGHT));
        $where = 'intern_id = "' . $val . '"';
        $internemailData = $this->Crud_modal->fetch_single_data('first_name,last_name,email,offer_latter_email', 'interns', $where);
        $this->Crud_modal->update_data("intern_id='$val'", "interns", ['status' => '6']);
        $internEmail = $internemailData['email'];
        $url = base_url('') . 'post-registration-intern/' . $intern_id;
        $to = $internEmail;
        $att = $this->send_offer_letter($internemailData);
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
        $mail->addBCC("pransi.g@neuralinfo.org", "Pransi");
        $mail->FromName = 'cry Vms';
        $mail->IsHTML(true);
        $mail->Subject = 'Cry Offer Letter';
        $mail->Body = 'Please Fill Your Basic Details And Accept Your Offer Letter' . ' ' . $url;
        if (!$mail->Send()) {
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
           // $this->Admin_model->updateStatus_intern_offerletter($internemailData);
            redirect(base_url() . 'hr-process/' . $intern_id);
        }
    }
    public function send_offer_letter($internemailData)
    {

        $offerEmailFormat = $internemailData['offer_latter_email'];
        $date = date('d-m-Y');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 9);
        $pdf->Image(base_url() . '/uploads/offer.png', 10, 8, 185);
        //$pdf->Image($_SERVER['DOCUMENT_ROOT'] . '/uploads/offer.png', 10, 8, 185);
        $pdf->SetY(38.6);
        $pdf->SetX(147);
        $pdf->Cell(10, 5, $date, 0, 'R');
        $pdf->SetY(60);
        $pdf->Ln(5);
        $pdf->SetX(20);
        $pdf->multiCell(170, 4, strip_tags($offerEmailFormat), 5);
        $path = 'offeremail/' . rand() . '.pdf';
        $pdf->Output($path, 'F');
        return $path;
        $this->load->view('view_offer_letter');
    }
    function confirm_joining()
    {
        if ($this->session->userdata('emp_id') != "" || $this->session->userdata('emp_id') != null) {
            $creation_date = date('Y-m-d');
            $intern_id = $this->input->post("intern_id");
            $internEmail = $this->input->post('email');
           
            $intern = $this->Crud_modal->fetch_single_data('*', 'interns', "intern_id=$intern_id");
            // $email_templates = $this->Crud_modal->fetch_all_data('*', 'email_templates', 'status=1 AND email_templates_id=5');
            $val = rtrim(strtr(base64_encode($intern['intern_id']), '+/', '-_'), '=');
            $url = base_url('') . 'intern-login';
            $password = 'intern12345';
            $to = $intern['email']; {
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
                $mail->AddAddress($to);
                $mail->addBCC("ravishankar.k@neuralinfo.org", "Ravi");
                $mail->FromName = 'cry Vms';
                $mail->IsHTML(true);
                $mail->Subject = 'Joining Letter';
                $mail->Body = "" . "<br>" . 'Your Login Credentials,' . " " . "<br>" . "Link:" . " " . $url . "<br><br>" . "Your Email:" . " " . $intern['email'] . '<br>' . "Your Password:" . "  " . $password . "<br><br>" . "Thank you for being a intern with CRY.";
                if (!$mail->Send()) {
                    echo "Message could not be sent. <p>";
                    echo "Mailer Error: " . $mail->ErrorInfo;
                } else {
                    $this->Admin_model->intern_count_send_maillogincredational($intern_id, $creation_date);
                }
            }
        }
    }
}
?>