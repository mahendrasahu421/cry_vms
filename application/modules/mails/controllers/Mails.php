<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mails extends MY_Controller
{

    function __construct()
    {
        parent :: __construct();
        // if($this->session->userdata('userID'))
        // {
        //     redirect('dashboard');
        // }
        $this->load->library('Phpmailer');
        date_default_timezone_set('Asia/Kolkata');

    }
    
     public function mail_send($to,$from,$msg,$msg2,$subj,$link,$btn,$html)
    {
        $mail = new PHPMailer();
        // $mail->IsSMTP();
        $mail->Host = 'office365.caritasindia.org';
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        //$mail->Mailer = "smtp";
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";
        $mail->Username = "volunteer@caritasindia.org";
        $mail->Password = "CIV%^&2190";
        $mail->Priority = 1;
        $mail->setFrom($from);
        $mail->AddAddress($to);
        $mail->addBCC("pransi.g@neuralinfo.org", "Pransi");
        $mail->addBCC("ravishankar.k@neuralinfo.org", "ravi");
        $mail->FromName =$msg;
        $mail->IsHTML(true);
        $mail->Subject = $subj;
        $mail->Body = $html;
        if(!$mail->Send()){
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        //return true;
    }
    
    public function mail_send1()
    {
        $mail = new PHPMailer();
         //$mail->IsSMTP();
        $mail->Host = 'office365.caritasindia.org';
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->SMTPSecure = "tls";
        $mail->Username = "volunteer@caritasindia.org";
        $mail->Password = "CIV%^&2190";
        $mail->Priority = 1;
        $mail->setFrom('volunteer@caritasindia.org');
        $mail->AddAddress("volunteer@caritasindia.org", "caritas");
        $mail->addBCC("volunteer@caritasindia.org", "caritas");
        $mail->addBCC("pransi.g@neuralinfo.org", "Pransi");
        $mail->addBCC("jenny@caritasindia.org", "Jenny");
		$mail->addBCC("amit@caritasindia.org", "Amit");
       // $mail->addBCC("ravishankar.k@neuralinfo.org", "ravi");
        $mail->FromName ="Ci Volunteer";
        $mail->IsHTML(true);
        $mail->Subject = "Register Mail";
        $mail->Body = "Register  from office outlook Mail New";
        if(!$mail->Send()){
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else{
            echo "Message has been sent";
        }
        //return true;
    }
    public function mail_send_change($to,$from,$msg,$msg2,$subj,$link,$btn,$html)
    {
        $mail = new PHPMailer(TRUE);
        $mail->IsSMTP();
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
        if(!$mail->Send()){
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        //return true;
    }
    
    public function mail_send_outlook()
    {
        $mail = new PHPMailer();
        // $mail->IsSMTP();
        $mail->Host = 'outlook.office365.com';
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "SSL";
        $mail->Port = 993;
        $mail->Username = "civolunteer@outlook.com";
        $mail->Password = "Volunteer";
        $mail->setFrom('civolunteer@outlook.com');
        $mail->AddAddress('jenny@caritasindia.org');
        $mail->addBCC("jenny.joy3105@gmail.com", "Jenny");
        $mail->addBCC("pransi.g@neuralinfo.org", "Pransi");
        $mail->FromName ="Test For live";
        $mail->IsHTML(true);
        $mail->Subject = "Register Mail";
        $mail->Body = "Register Mail";
        if(!$mail->Send()){
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else{
            echo "send";
        }
        //return true;
    }
    public function mail_send_gmail()
    {
        $mail = new PHPMailer();
        // $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "SSL";
        $mail->Port = 587;
        $mail->Username = "caritasindiavolunteer@gmail.com";
        $mail->Password = "Volunteer";
        $mail->setFrom('caritasindiavolunteer@gmail.com');
        $mail->AddAddress('jenny@caritasindia.org');
        $mail->addBCC("jenny.joy3105@gmail.com", "Jenny");
        $mail->addBCC("pransi.g@neuralinfo.org", "Pransi");
        $mail->FromName ="Test For live";
        $mail->IsHTML(true);
        $mail->Subject = "Register Mail";
        $mail->Body = "Register Mail";
        if(!$mail->Send()){
            echo "Message could not be sent. <p>";
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
        else{
            echo "send";
        }
        //return true;
    }
    
	public function request_email($msg,$msg2,$link,$btn)
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
                                                '.$msg.'
                                            </div>
                                                
                                            </div>
                                            <div style="font-family:Roboto-Regular,Helvetica,Arial,sans-serif;font-size:14px;color:rgba(0,0,0,0.87);line-height:20px;padding-top:20px;text-align:center">
                                            '.$msg2.'<div style="padding-top:32px;text-align:center">
                                            <a href="'.$link.'" 
                                            style="line-height:16px;color:#ffffff;font-weight:400;text-decoration:none;font-size:14px;display:inline-block;padding:10px 24px;background-color:#8e2c24;border-radius:5px;min-width:90px" 
                                            target="_blank" 
                                            data-saferedirecturl="'.$link.'">
                                            '.$btn.'</a>
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
                                                    Email - director@caritasindia.org</a>
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
}
