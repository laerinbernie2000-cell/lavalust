<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $_SESSION['student_access'] = true;

        $data['page_title'] = 'Student Portal';

        $this->call->view('student/home', $data);
    }

    public function profile()
    {
        $student = [
            'student_id' => 'MCC2024-01634',
            'name'       => 'Rhendel G. Agosto',
            'course'     => 'BS Information Technology',
            'year'       => '3rd Year',
            'section'    => 'F6',
            'email'      => 'a@example.com',
            'address'    => 'Calapan City, Philippines',
            'contact'    => '0900-000-0000',
            'hobbies'    => 'yes',
        ];

        $data = [
            'page_title' => 'Student Profile',
            'student'    => $student,
        ];

        $this->call->view('student/profile', $data);
    }
}
