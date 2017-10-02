<?php
	class Form_model extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		//CREATE
		function insert_splp($data)
		{
			$this->db->insert("splp",$data);
			return $this->db->insert_id();
		}
		function insert_pelepasan($data)
		{
			$this->db->insert("pelepasan",$data);
			return $this->db->insert_id();
		}
		function insert_berkas($data)
		{
			$this->db->insert("berkas",$data);
			return $this->db->insert_id();
		}
		//READ
		function get_config()
		{
			$value = $this->db->get('config')->result();
			return $value;
		}
		function get_pasal_splp()
		{
			$value = $this->db->get('pasal_splp')->result();
			return $value;
		}
		function get_berkas_byNomor($no_berkas, $tipe_berkas)
		{
			$this->db->where('no_berkas', $no_berkas);
			$this->db->where('tipe_berkas', $tipe_berkas);
			$value = $this->db->get('berkas')->result();
			return $value;
		}
		function get_pasal_splp_byId($id)
		{
			$this->db->where('id_pasal_splp', $id);
			$value = $this->db->get('pasal_splp')->result();
			return $value;
		}
		function get_splp_byId($id)
		{
			$this->db->where('id_splp', $id);
			$value = $this->db->get('splp')->result();
			return $value;
		}
		function get_pelepasan_byId($id)
		{
			$this->db->where('id_pelepasan', $id);
			$value = $this->db->get('pelepasan')->result();
			return $value;
		}
		function get_juml_splp_bln($bln, $thn)
		{
        	$value = $this->db->query("SELECT count(splp.id_splp) as juml from splp where month(creation_date) = $bln and year(creation_date) = $thn")->result();
		    return $value[0];
		}
		function get_juml_pelepasan_bln($bln, $thn)
		{
			$value = $this->db->query("SELECT count(pelepasan.id_pelepasan) as juml from pelepasan where month(creation_date) = $bln and year(creation_date) = $thn")->result();
		    return $value[0];
		}
		//UPDATE
		function Update($data, $id)
		{
			$this->db->where('id_pk', $id);
			$this->db->update('table', $data);
		}
		//DELETE
		function Delete($id)
		{
			$this->db->where('id_pk',$id);
			$this->db->delete('table');
		}
		
		function Custom_Query()
		{
			$value = $this->db->query("SELECT * from `table` where 1")->result();
			return $value;
		}
	}
?>