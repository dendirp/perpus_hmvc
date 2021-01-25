<?php
class Member extends CI_Controller
{
    function __construct()
    {
        parent:: __construct();
        $this->load->model('M_member');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if($this->session->userdata('status') == 'member_login'){
            redirect ('login');
        }
    }
    function index()
    {
        $data['member'] = $this->M_member->get_data('member')->result();
        $data['judul'] = 'member';
        $this->load->view('templates/Header', $data);
        $this->load->view('templates/Sidebar');
        $this->load->view('templates/Topbar');
        $this->load->view('V_member', $data);
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
        $this->M_member->tambah_data($data, 'member');
        $this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade show' 
            role='alert'>
            <strong>Berhasil</strong> Menambah Data.
            <button type='button' class='close' data-dismiss='alert' 
            aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
          </div>");
          redirect('member');
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
                $this->db->update('member', $data);
                $this->session->set_flashdata("pesan", "<div class='alert alert-success alert-dismissible fade show' 
                role='alert'>
                <strong>Berhasil</strong> Edit Data.
                <button type='button' class='close' data-dismiss='alert' 
                aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
              </div>");
                 redirect('Member');
            }
        }
        function delete($id)
    {
        $where = array('id' => $id);
        $this->M_member->delete($where, 'member');
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data <b>Berhasil</b> di hapus
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('Member');
    }
    }
    ?>