<?php
class login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_login');
    }
    function index()
    {
        $data['judul'] = 'Login Page';        
        $this->load->view('templates/header_login', $data);        
        $this->load->view('V_login');        
        $this->load->view('templates/footer_login', $data);        
    }

    function login_aksi()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $sebagai = $this->input->post('sebagai');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() != false)
        {
            
            $where = array(
                'username' => $username,
                'password' => $password,
            );
            if($sebagai == 'admin'){
                $cek = $this->M_login->cek_login('admin', $where)->num_rows();
                $data = $this->M_login->cek_login('admin', $where)->row();
                if($cek > 0){
                    $data_session = array(
                        'id' => $data->id,
                        'username' => $data->username,
                        'status' => 'admin_login'
                    );
                    $this->session->set_userdata($data_session);
                    redirect('Dashboard');
                }else{
                    // echo "<script>alert('Username / Password SALAH BOSSSS...!!!');</script>";
                    $this->session->set_flashdata("pesan", "<div class='alert alert-danger alert-dismissible fade show' 
            role='alert'>
            <strong>Gagal</strong> Login.
            <button type='button' class='close' data-dismiss='alert' 
            aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
          </div>");
                    redirect('login');
                }
            }else if($sebagai == 'member'){
                $cek = $this->M_login->cek_login('member', $where)->num_rows();
                $data = $this->M_login->cek_login('member', $where)->row();
                if($cek > 0){
                    $data_session = array(
                        'id' => $data->id,
                        'username' => $data->username,
                        'status' => 'member_login'
                    );
                    $this->session->set_userdata($data_session);
                    redirect('Dashboard');
                }else{
                    $this->session->set_flashdata("pesan", "<div class='alert alert-danger alert-dismissible fade show' 
            role='alert'>
            <strong>Gagal</strong> Login.
            <button type='button' class='close' data-dismiss='alert' 
            aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
          </div>");
                    redirect('login');
                }
            }
        }else{
            redirect('login');    
            // echo "<script>alert('mental krn g isi form');</script>";
        } 
    }
    function logout()
        {
            $this->session->sess_destroy();
            redirect('login?alert=logout');
        }
}