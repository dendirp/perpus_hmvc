<?php
class M_register extends CI_Model
{
    function insert($data, $tabel)
    {
        $this->db->insert($tabel, $data);
    }
}