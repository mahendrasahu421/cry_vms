<?php 
use SebastianBergmann\Exporter\Exporter;
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class Export extends MY_Controller
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

    public function preRegistrationVolunteer_exporttoExcel(){
       
        $host = "localhost";
        $username = "mgracwck_cryuser";
        $password = "QM?VYXd.%N4A";
        $dbname = "mgracwck_cryvms";
        $conn = mysqli_connect($host, $username, $password, $dbname);
        // Retrieve the data
        $sql =  "SELECT volunteer_id,first_name, last_name, email, mobile,state_name,city_name FROM volunteer LEFT JOIN states ON volunteer.state_id=states.state_id LEFT JOIN cities ON volunteer.city_id=cities.city_id WHERE volunteer.status=1" ;
        $result = mysqli_query($conn, $sql);
        // Create a file pointer
        $fp = fopen('Pre Registration Volunteer.csv', 'w');
       
        // Write the header row
        $header = array('volunteer_id', 'First Name', 'Last Name','email','number','state_name','city_name');
      
        fputcsv($fp, $header);

        // Write the data rows
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($fp, $row);
        }

        // Close the file pointer
        fclose($fp);
        // Set headers for download
        header('Content-Type: text/csv');
        //header('Content-Disposition: attachment; filename="Pre Registration Volunteer.csv"');

        // Read the file and output it to the user
        //readfile('Pre Registration Volunteer.csv');

}

    public function postRegistrationexporttoExcel(){
       
        $host = "localhost";
        $username = "mgracwck_cryuser";
        $password = "QM?VYXd.%N4A";
        $dbname = "mgracwck_cryvms";
        $conn = mysqli_connect($host, $username, $password, $dbname);
        // Retrieve the data
        $sql =  "SELECT volunteer_id,first_name, last_name, email, mobile,state_name,city_name FROM volunteer LEFT JOIN states ON volunteer.state_id=states.state_id LEFT JOIN cities ON volunteer.city_id=cities.city_id WHERE volunteer.status=4" ;
        $result = mysqli_query($conn, $sql);
        // Create a file pointer
        $fp = fopen('Post Registration Volunteer.csv', 'w');
      
        // Write the header row
        $header = array('volunteer_id', 'First Name', 'Last Name','email','number','state_name','city_name');
       
        fputcsv($fp, $header);

        // Write the data rows
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($fp, $row);
        }

        // Close the file pointer
        fclose($fp);
        // Set headers for download
        header('Content-Type: text/csv');
        // header('Content-Disposition: attachment; filename="Post Registration Volunteer.csv"');

        // // Read the file and output it to the user
        // readfile('Post Registration Volunteer.csv');

}


    public function onboar_volunteerd_ExporttoExcel(){
       
        $host = "localhost";
        $username = "mgracwck_cryuser";
        $password = "QM?VYXd.%N4A";
        $dbname = "mgracwck_cryvms";
        $conn = mysqli_connect($host, $username, $password, $dbname);
        // Retrieve the data
        $sql = "SELECT volunteer_id,first_name, last_name, email, mobile,state_name,city_name FROM volunteer LEFT JOIN states ON volunteer.state_id=states.state_id LEFT JOIN cities ON volunteer.city_id=cities.city_id WHERE volunteer.status=5" ; 

        $result = mysqli_query($conn, $sql);
        // Create a file pointer
        $fp = fopen('On Board Volunteer.csv', 'w');
      
        // Write the header row
        $header = array('volunteer_id', 'First Name', 'Last Name','email','number','state_name','city_name');
       
        fputcsv($fp, $header);

        // Write the data rows
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($fp, $row);
        }

        // Close the file pointer
        fclose($fp);
        // Set headers for download
        header('Content-Type: text/csv');
        // header('Content-Disposition: attachment; filename="On Board Volunteer.csv"');

        // // Read the file and output it to the user
        // readfile('On Board Volunteer.csv');

}
    public function task_exportTOexcel(){
       
        $host = "localhost";
        $username = "mgracwck_cryuser";
        $password = "QM?VYXd.%N4A";
        $dbname = "mgracwck_cryvms";
        $conn = mysqli_connect($host, $username, $password, $dbname);
        // Retrieve the data
        $sql = "SELECT task_id,task_type_id,task_title,task_brief,start_date,expected_end_date,volunteer_required,state_name,city_name,region_name 
        FROM task 
        LEFT JOIN states ON task.task_state_id=states.state_id 
        LEFT JOIN cities ON task.task_city_id=cities.city_id 
        LEFT JOIN regions ON task.region_id=regions.region_id 
        WHERE task.status=1";
        
        $result = mysqli_query($conn, $sql);

   
        $fp = fopen('Task.csv', 'w');
      
        // Write the header row
        $header = array('Task Id', 'Task Type', 'Task Tittle', 'Task Description', 'Start Date', 'End Date', 'Volunteer required', 'State Name', 'City Name', 'Region Name');
       
        fputcsv($fp, $header);

        // Write the data rows
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($fp, $row);
        }

        // Close the file pointer
        fclose($fp);
        // Set headers for download
        header('Content-Type: text/csv');
        // header('Content-Disposition: attachment; filename="Task.csv"');

        // // Read the file and output it to the user
        // readfile('Task.csv');

}

}
?>