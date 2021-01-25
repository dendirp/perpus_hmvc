<?php
include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
class Dataa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_data');
        $this->form_validation->set_rules('dataa', 'Dataa', 'required|trim');
        $this->form_validation->set_rules('sks', 'SKS', 'required|trim');
    }
    function index()
    {
        $data['dataa'] = $this->M_data->get_data('dataa')->result();
        $data['judul'] = 'Dataa Page';
        $this->load->view('Templates/Header', $data);
        $this->load->view('Templates/Topbar');
        $this->load->view('Templates/Sidebar');
        $this->load->view('V_data', $data);
        $this->load->view('Templates/Footer');
    }
    function tambah()
    {
        $dataa = $this->input->post('dataa');
        $sks = $this->input->post('sks');
        $data = array(
            'id_user' => $this->session->userdata('id'),
            'dataa' => $dataa,
            'sks' => $sks
        );
        $this->M_dataa->insert($data, 'dataa');
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data <b>Berhasil</b> di tambah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('Dataa');
    }
    function edit()
    {
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Data <b>Gagal</b> di edit
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
            redirect('Dataa');
        } else {
            $id = $this->input->post('id');
            $dataa = $this->input->post('dataa');
            $sks = $this->input->post('sks');
            $data = array(
                'id' => $id,
                'id_user' => $this->session->userdata('id'),
                'dataa' => $dataa,
                'sks' => $sks
            );
            $this->db->where('id', $id);
            $this->db->update('dataa', $data);
            $this->session->set_flashdata('message', '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data <b>Berhasil</b> di ubah
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>');
            redirect('Dataa');
        }
    }
    function delete($id)
    {
        $where = array('id' => $id);
        $this->M_dataa->delete($where, 'dataa');
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data <b>Berhasil</b> di hapus
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('Dataa');
    }
    function deleteAll()
    {
        $this->db->empty_table('dataa');
        $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data <b>Berhasil</b> di hapus dari Sistem
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
        redirect('Dataa');
    }
    function upload()
    {
        $config['upload_path'] = realpath('excel');
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['max_size'] = '10000';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $this->session->set_flashdata('message', '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Data <b>Gagal</b> di unggah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('Dataa');
        } else {
            $data_upload = $this->upload->data();
            $excelreader     = new PHPExcel_Reader_Excel2007();
            $loadexcel         = $excelreader->load('excel/' . $data_upload['file_name']);
            $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $data = array();
            $numrow = 1;
            foreach ($sheet as $row) {
                if ($numrow > 1) {
                    array_push($data, array(
                        'dataa' => $row['A'],
                        'sks'      => $row['B']
                    ));
                }
                $numrow++;
            }
            $this->db->insert_batch('dataa', $data);
            unlink(realpath('excel/' . $data_upload['file_name']));
            $this->session->set_flashdata('message', '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Data <b>Berhasil</b> di unggah
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>');
            redirect('Dataa');
        }
    }
    function download()
    {
        $data = array(
            'title' => 'Tabel Dataa',
            'unduh' => $this->M_dataa->get_data('dataa')->result()
        );
        $this->load->view('V_excel', $data);
    }
}
