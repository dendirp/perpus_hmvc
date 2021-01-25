<?php
class M_login extends CI_Model
{
    function cek_login($tabel, $where)
    {
       return $this->db->get_where($tabel, $where);
    }
}