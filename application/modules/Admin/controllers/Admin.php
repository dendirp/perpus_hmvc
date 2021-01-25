<?php
class Admin extends CI_Controller
{
    function __construct()
    {
        parent:: __construct();
        $this->load->model('M_admin');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if($this->session->userdata('status') == 'member_login'){
            redirect ('login');
        }
    }
    function index()
    {
        $data['admin'] = $this->M_admin->get_data('admin')->result();
        $data['judul'] = 'Admin';
        $this->load->view('templates/Header', $data);
        $this->load->view('templates/Sidebar');
        $this->load->view('templates/Topbar');
        $this->load->view('V_Admin', $data);
        $this->load->view('templates/Footer');
    }
    function tambah()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $data = array(
            'username' => $username,
            'password' => $password,
        );
        $this->M_admin->tambah_data($data, 'admin');
        $this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade show' 
            role='alert'>
            <strong>Berhasil</strong> Menambah Data.
            <button type='button' class='close' data-dismiss='alert' 
            aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
          </div>");
          redirect('admin');
    }
    function edit()
    {
        if($this->form_validation->run() == false){
            $this->session->set_flashdata("pesan", "<div class='alert alert-danger alert-dismissible fade show' 
            role='alert'>
            <strong>Gagal</strong> Edit Data.
            <button type='button' class='close' data-dismiss='alert' 
            aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
          </div>");
          redirect('Admin');
        } else {
            $id = $this->input->post('id');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $data = array(
                'id' => $id,
                'username' => $username,
                'password' => $password,
            );
            $this->db->where('id', $id);
            $this->db->update('admin', $data);
            $this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade show' 
            role='alert'>
            <strong>Berhasil</strong> Edit Data.
            <button type='button' class='close' data-dismiss='alert' 
            aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
          </div>");
             redirect('Admin');
        }
    }
    function delete($id)
    {
        $where = array('id' => $id);
        $this->M_admin->delete($where, 'admin');
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data <b>Berhasil</b> di hapus
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('Admin');
    }
}
?>