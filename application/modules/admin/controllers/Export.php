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

    public function preRegistrationVolunteer_exporttoExcel()
    {

        $host = "localhost";
        $username = "mgracwck_cryuser";
        $password = "QM?VYXd.%N4A";
        $dbname = "mgracwck_cryvms";
        $conn = mysqli_connect($host, $username, $password, $dbname);
        // Retrieve the data
        $sql =  "SELECT volunteer_id,first_name, last_name, email, mobile,state_name,city_name FROM volunteer LEFT JOIN states ON volunteer.state_id=states.state_id LEFT JOIN cities ON volunteer.city_id=cities.city_id WHERE volunteer.status=1";
        $result = mysqli_query($conn, $sql);
        // Create a file pointer
        $fp = fopen('Pre Registration Volunteer.csv', 'w');
        ob_clean();
        // Write the header row
        $header = array('volunteer_id', 'First Name', 'Last Name', 'email', 'number', 'state_name', 'city_name');

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


    public function preRegistrationinterns_exporttoExcel()
    {

        $host = "localhost";
        $username = "mgracwck_cryuser";
        $password = "QM?VYXd.%N4A";
        $dbname = "mgracwck_cryvms";
        $conn = mysqli_connect($host, $username, $password, $dbname);

        // Retrieve the data
        $sql = "SELECT intern_id,first_name, last_name, email, mobile,state_name,city_name FROM interns LEFT JOIN states ON interns.state_id=states.state_id LEFT JOIN cities ON interns.city_id=cities.city_id WHERE interns.status=1";
        $result = mysqli_query($conn, $sql);

        // Create a file pointer
        $fp = fopen('Pre Registration interns.csv', 'w');
        ob_clean();


        // Write the header row
        $header = array('intern_id', 'First Name', 'Last Name', 'email', 'number', 'state_name', 'city_name');
        fputcsv($fp, $header);

        // Write the data rows
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($fp, $row);
        }

        // Close the file pointer
        fclose($fp);

        // Set headers for download
        // header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="Pre Registration interns.csv"');

        // Read the file and output it to the user
        readfile('Pre Registration interns.csv');
    }


    public function shortlistInterns()
    {

        $host = "localhost";
        $username = "mgracwck_cryuser";
        $password = "QM?VYXd.%N4A";
        $dbname = "mgracwck_cryvms";
        $conn = mysqli_connect($host, $username, $password, $dbname);

        // Retrieve the data
        $sql = "SELECT intern_id,first_name, last_name, email, mobile,state_name,city_name FROM interns LEFT JOIN states ON interns.state_id=states.state_id LEFT JOIN cities ON interns.city_id=cities.city_id WHERE interns.status=2";
        $result = mysqli_query($conn, $sql);

        // Create a file pointer
        $fp = fopen('Short Listed Interns.csv', 'w');
        ob_clean();


        // Write the header row
        $header = array('intern_id', 'First Name', 'Last Name', 'email', 'number', 'state_name', 'city_name');
        fputcsv($fp, $header);

        // Write the data rows
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($fp, $row);
        }

        // Close the file pointer
        fclose($fp);

        // Set headers for download
        // header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="Short Listed Interns.csv"');

        // Read the file and output it to the user
        readfile('Short Listed Interns.csv');
    }

    public function post_registration_intern_exportToExcel()
    {

        $host = "localhost";
        $username = "mgracwck_cryuser";
        $password = "QM?VYXd.%N4A";
        $dbname = "mgracwck_cryvms";
        $conn = mysqli_connect($host, $username, $password, $dbname);

        // Retrieve the data
        $sql = "SELECT intern_id,first_name, last_name, email, mobile,state_name,city_name FROM interns LEFT JOIN states ON interns.state_id=states.state_id LEFT JOIN cities ON interns.city_id=cities.city_id WHERE interns.status=7";
        $result = mysqli_query($conn, $sql);

        // Create a file pointer
        $fp = fopen('Post Registration Interns.csv', 'w');
        ob_clean();


        // Write the header row
        $header = array('intern_id', 'First Name', 'Last Name', 'email', 'number', 'state_name', 'city_name');
        fputcsv($fp, $header);

        // Write the data rows
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($fp, $row);
        }

        // Close the file pointer
        fclose($fp);

        // Set headers for download
        // header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="Post Registration Interns.csv"');

        // Read the file and output it to the user
        readfile('Post Registration Interns.csv');
    }
    
    public function all_onboard_intern_memberexportToexcel()
    {

        $host = "localhost";
        $username = "mgracwck_cryuser";
        $password = "QM?VYXd.%N4A";
        $dbname = "mgracwck_cryvms";
        $conn = mysqli_connect($host, $username, $password, $dbname);

        // Retrieve the data
        $sql = "SELECT intern_id,first_name, last_name, email, mobile,state_name,city_name FROM interns LEFT JOIN states ON interns.state_id=states.state_id LEFT JOIN cities ON interns.city_id=cities.city_id WHERE interns.status=8";
        $result = mysqli_query($conn, $sql);

        // Create a file pointer
        $fp = fopen('Post Registration Interns.csv', 'w');
        ob_clean();


        // Write the header row
        $header = array('intern_id', 'First Name', 'Last Name', 'email', 'number', 'state_name', 'city_name');
        fputcsv($fp, $header);

        // Write the data rows
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($fp, $row);
        }

        // Close the file pointer
        fclose($fp);

        // Set headers for download
        // header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="Post Registration Interns.csv"');

        // Read the file and output it to the user
        readfile('Post Registration Interns.csv');
    }


    public function postRegistrationexporttoExcel()
    {

        $host = "localhost";
        $username = "mgracwck_cryuser";
        $password = "QM?VYXd.%N4A";
        $dbname = "mgracwck_cryvms";
        $conn = mysqli_connect($host, $username, $password, $dbname);
        // Retrieve the data
        $sql =  "SELECT volunteer_id,first_name, last_name, email, mobile,state_name,city_name FROM volunteer LEFT JOIN states ON volunteer.state_id=states.state_id LEFT JOIN cities ON volunteer.city_id=cities.city_id WHERE volunteer.status=4";
        $result = mysqli_query($conn, $sql);
        // Create a file pointer
        $fp = fopen('Post Registration Volunteer.csv', 'w');

        // Write the header row
        $header = array('volunteer_id', 'First Name', 'Last Name', 'email', 'number', 'state_name', 'city_name');

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


    public function onboar_volunteerd_ExporttoExcel()
    {

        $host = "localhost";
        $username = "mgracwck_cryuser";
        $password = "QM?VYXd.%N4A";
        $dbname = "mgracwck_cryvms";
        $conn = mysqli_connect($host, $username, $password, $dbname);
        // Retrieve the data
        $sql = "SELECT volunteer_id,first_name, last_name, email, mobile,state_name,city_name FROM volunteer LEFT JOIN states ON volunteer.state_id=states.state_id LEFT JOIN cities ON volunteer.city_id=cities.city_id WHERE volunteer.status=5";

        $result = mysqli_query($conn, $sql);
        // Create a file pointer
        $fp = fopen('On Board Volunteer.csv', 'w');
        ob_clean();
        // Write the header row
        $header = array('volunteer_id', 'First Name', 'Last Name', 'email', 'number', 'state_name', 'city_name');

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

    public function task_exportTOexcel()
    {

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
        ob_clean();
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

    public function intern_task_exportToexcel()
    {
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mgracwck_cryvms";
    
        // Create connection
        $conn = mysqli_connect($host, $username, $password, $dbname);
    
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    
        // Retrieve the data
        $sql = "SELECT intern_task_id, task_type, region_name,task_title, task_brief, start_date, expected_end_date, intern_required, state_name, city_name 
                FROM interntask 
                LEFT JOIN states ON interntask.task_state_id = states.state_id 
                LEFT JOIN cities ON interntask.task_city_id = cities.city_id 
                LEFT JOIN regions ON interntask.region_id = regions.region_id 
                LEFT JOIN task_type ON interntask.task_type_id = task_type.task_type_id 
                WHERE interntask.status = 1";
    
        $result = mysqli_query($conn, $sql);
    
        if (!$result) {
            die("Error retrieving data: " . mysqli_error($conn));
        }
    
        // Open file for writing
        $fp = fopen('Task.csv', 'w');
        ob_clean();
        // Write the header row
        $header = array('Task Id', 'Task Type', 'Region Name','Task Title', 'Task Description', 'Start Date', 'End Date', 'Intern required', 'State Name', 'City Name');
        fputcsv($fp, $header);
    
        // Write the data rows
        while ($row = mysqli_fetch_assoc($result)) {
            $row['task_brief'] = str_replace('&nbsp;', '', $row['task_brief']);
            $row['task_brief'] = strip_tags($row['task_brief']);

    // Write the row to the CSV file
    fputcsv($fp, $row);
        }
    
        // Close the file pointer
        fclose($fp);
    
        // Set headers for download
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="Task.csv"');
        header('Pragma: no-cache');
        header('Expires: 0');
    
        // Output the file contents
        readfile('Task.csv');
    
        // Exit the script
        exit();
    }


    function assign_taskDetails_exportToExcel()
{
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mgracwck_cryvms";

    // Create connection
    $conn = mysqli_connect($host, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve the data
    $sql = "SELECT intern_assigning_task.intern_assigned_task_id, 
            interntask.task_title, 
            interntask.task_brief, 
            interns.intern_id, 
            interns.first_name, 
            interns.last_name, 
            interns.email, 
            interns.mobile, 
            intern_assigning_task.assigned_date, 
            master_role.role_name, 
            intern_assigning_task.reminder 
            FROM intern_assigning_task 
            LEFT JOIN interntask ON interntask.intern_task_id = intern_assigning_task.intern_task_id 
            LEFT JOIN interns ON interns.intern_id = intern_assigning_task.intern_id 
            LEFT JOIN master_role ON master_role.role_id = intern_assigning_task.assign_by_task 
            WHERE intern_assigning_task.status = 1";

    // Use prepared statement to avoid SQL injection
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Open file for writing
    $fp = fopen('Assign Task.csv', 'w');

    // Write the header row
    $header = array('Task Id', 'Task Title', 'Task Description', 'Intern Id', 'First Name', 'Last Name', 'Email', 'Mobile', 'Task Assign Date', 'Task Assign By', 'Reminder');
    fputcsv($fp, $header);

    // Write the data rows using a generator function to read the data from the database in chunks
    function get_data($result)
    {
        while ($row = mysqli_fetch_assoc($result)) {
            $row['task_brief'] = str_replace('&nbsp;', '', $row['task_brief']);
            $row['task_brief'] = strip_tags($row['task_brief']);
            yield $row;
        }
    }

    foreach (get_data($result) as $row) {
        // Write the row to the CSV file
        fputcsv($fp, $row);
    }

    // Close the file pointer
    fclose($fp);

    // Set headers for download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="Assign Task.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');

    // Output the file contents
    readfile('Assign Task.csv');
}


    
}