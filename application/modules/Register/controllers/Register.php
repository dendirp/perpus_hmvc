<?php
class Register extends CI_Controller{
    function __construct()
    {
        parent:: __construct();
        $this->load->model('M_register');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
    }
    function index()
    {
        $data['judul'] = 'Register Page';
        $this->load->view('templates/header_login', $data);
        $this->load->view('V_register');
        $this->load->view('templates/footer_login');
    }
    function tambah()
    {
        if($this->form_validation->run() == false){
            $this->session->set_flashdata("pesan", "<div class='alert alert-danger alert-dismissible fade show' 
            role='alert'>
            <strong>Gagal</strong> Mendaftar
            <button type='button' class='close' data-dismiss='alert' 
            aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
          </div>");
          redirect('Register');
        } else{
            $id = $this->input->post('id');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $data = array(
                'id' => $id,
                'username' => $username,
                'password' => $password
            );
            $this->M_register->insert($data, 'member');
            $this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade show' 
            role='alert'>
            <strong>Berhasil</strong> Mendaftar
            <button type='button' class='close' data-dismiss='alert' 
            aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
          </div>");
          redirect('login');
        }
    }
}