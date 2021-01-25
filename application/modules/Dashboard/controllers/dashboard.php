<?php
class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_dashboard');
    }
    function index()
    {
        $data['judul'] = 'Dashboard';
        $this->load->view('templates/Header', $data);
        $this->load->view('templates/Sidebar');
        $this->load->view('templates/Topbar');
        $this->load->view('V_dashboard');
        $this->load->view('templates/Footer');
    }
}