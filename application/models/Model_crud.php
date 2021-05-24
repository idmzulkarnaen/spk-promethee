
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_crud extends CI_Model 
{
		public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

	    function cekData($tablename="",$where=""){
	    	$cek = $this->db->query("SELECT * FROM ".$tablename." ".$where); 
	    	return $cek->num_rows();
	    }

	    function ambilData($tablename="",$listfield="",$where="")
	    {
	    	$query=null;
	    	if (empty($listfield)) {
                if (empty($where)) {
                    $query = $this->db->query("select * from ".$tablename);
                } else {
                    $query = $this->db->query("select * from ".$tablename." where ".$where);
                }
            } else {
                if (empty($where)) {
                    $query = $this->db->query("select ".$listfield." from ".$tablename);
                } else {
                    $query = $this->db->query("select ".$listfield." from ".$tablename." where ".$where);
                }
            }

	    	return $query->result();
	    }

	    function saveData($tablename="",$field="",$value=""){
	    	$this->db->query("insert into ".$tablename."(".$field.") values(".$value.")");

	    	return $this->db->affected_rows();
	    }

	    function updateData($tablename="",$dataupdate="",$where=""){
	    	$this->db->query("update ".$tablename." set ".$dataupdate." where ".$where);

	    	return $this->db->affected_rows();
	    }

	    function deleteData($tablename="",$where=""){
	    	if (empty($where)) {
                $this->db->query("Delete from ".$tablename);
            } else {
                $this->db->query("Delete from ".$tablename." where ".$where);
            }

            return $this->db->affected_rows();
	    }


	    function newId($tbl="",$field="")
	    {
	    	$this->db->select_max($field,'id');
			$query = $this->db->get($tbl);
			$id = $query->row()->id+1;
			return $id;
	    }

	    function simpan($tabel="",$data=""){
            return $this->db->insert($tabel, $data);
        }

        function update($tabel="",$data="",$where="",$id=""){

            $this->db->where($where, $id);
            return $this->db->update($tabel, $data);
        }
        
        function getData($tabel="",$field="",$where="",$id=""){
            $data = array();
            if (empty($field)) {
                $this->db->select("*");
            } else {
                $this->db->select($field);
            }
            $this->db->from($tabel);
            if (!empty($where)) {
                $this->db->where($where, $id);
            }
            $hasil = $this->db->get();
            
            if($hasil->num_rows() > 0){
                return $hasil->row_array();
            }
        }
        
        function selectData($tabel="",$field="",$where="",$id="",$orderby="",$ascdesc=""){
            $data = array();
            if (empty($field)) {
                $this->db->select("*");
            } else {
                $this->db->select($field);
            }
            $this->db->from($tabel);
            if (!empty($where)) {
                $this->db->where($where, $id);
            }
            if (!empty($orderby)) {
                $this->db->order_by($orderby,$ascdesc);
            }
            return  $hasil = $this->db->get();
        }

        function delete($tabel="",$where="",$id=""){
            $this->db->where($where,$id);
            return $this->db->delete($tabel);
        }
}
?>