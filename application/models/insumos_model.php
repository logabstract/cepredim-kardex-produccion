<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Insumos_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}


	public function total_registros(){

		$query = $this->db->query('SELECT COUNT(*) FROM INSUMO i JOIN MARCA m ON m.MAR_ID=i.MAR_ID JOIN UNIDAD_MEDIDA um ON um.UNIM_ID=i.UNIM_ID JOIN ENTRADA_SALIDA_DET esd ON esd.ESD_ID=(SELECT max(es.ESD_ID) FROM ENTRADA_SALIDA_DET es where es.INS_ID=i.INS_ID and es.TIPES_ID=2) JOIN ENTRADA_SALIDA_DET esd2 ON esd2.ESD_ID=(SELECT max(es2.ESD_ID) FROM ENTRADA_SALIDA_DET es2 where es2.INS_ID=i.INS_ID) WHERE i.PAR_COD like '. $this->db->escape('%.%'));

		foreach ($query->result() as $row) {
			$total = $row->COUNT;
		}

		return $total;
	}	


	public function total_registros_match($search_term){
		if ($search_term == "NIL") $search_term = "";
		$query = $this->db->query('SELECT COUNT(*) FROM INSUMO i JOIN MARCA m ON m.MAR_ID=i.MAR_ID JOIN UNIDAD_MEDIDA um ON um.UNIM_ID=i.UNIM_ID JOIN ENTRADA_SALIDA_DET esd ON esd.ESD_ID=(SELECT max(es.ESD_ID) FROM ENTRADA_SALIDA_DET es where es.INS_ID=i.INS_ID and es.TIPES_ID=2) JOIN ENTRADA_SALIDA_DET esd2 ON esd2.ESD_ID=(SELECT max(es2.ESD_ID) FROM ENTRADA_SALIDA_DET es2 where es2.INS_ID=i.INS_ID) WHERE i.PAR_COD like '. $this->db->escape('%.%') . ' AND ' . 'i.INS_DES containing ' . $this->db->escape("$search_term"));

		foreach ($query->result() as $row) {
			$total = $row->COUNT;
		}

		return $total;
	}


	public function get_insumos($limit, $start){

		$query = $this->db->query('SELECT FIRST '. $limit .' SKIP ' . $start . ' i.INS_ID, i.PAR_COD, i.INS_DES, m.MAR_NOM, um.UNIM_NOM,esd.ESD_FECHA,esd.TIPES_NUM,esd.ESD_PRECIO_UNIT, esd2.ESD_CANT_SALDO FROM INSUMO i JOIN MARCA m ON m.MAR_ID=i.MAR_ID JOIN UNIDAD_MEDIDA um ON um.UNIM_ID=i.UNIM_ID JOIN ENTRADA_SALIDA_DET esd ON esd.ESD_ID=(SELECT max(es.ESD_ID) FROM ENTRADA_SALIDA_DET es where es.INS_ID=i.INS_ID and es.TIPES_ID=2) JOIN ENTRADA_SALIDA_DET esd2 ON esd2.ESD_ID=(SELECT max(es2.ESD_ID) FROM ENTRADA_SALIDA_DET es2 where es2.INS_ID=i.INS_ID) WHERE i.PAR_COD like '. $this->db->escape('%.%') .' ORDER BY esd.ESD_FECHA desc');

		if ($query) {
			return $query;
		} else {
			return false;
		}
	}	


	public function get_insumos_match($limit, $start, $search_term){
		if ($search_term == "NIL") $search_term = "";
		$query = $this->db->query('SELECT FIRST '. $limit .' SKIP ' . $start . ' i.INS_ID, i.PAR_COD, i.INS_DES, m.MAR_NOM, um.UNIM_NOM,esd.ESD_FECHA,esd.TIPES_NUM,esd.ESD_PRECIO_UNIT, esd2.ESD_CANT_SALDO FROM INSUMO i JOIN MARCA m ON m.MAR_ID=i.MAR_ID JOIN UNIDAD_MEDIDA um ON um.UNIM_ID=i.UNIM_ID JOIN ENTRADA_SALIDA_DET esd ON esd.ESD_ID=(SELECT max(es.ESD_ID) FROM ENTRADA_SALIDA_DET es where es.INS_ID=i.INS_ID and es.TIPES_ID=2) JOIN ENTRADA_SALIDA_DET esd2 ON esd2.ESD_ID=(SELECT max(es2.ESD_ID) FROM ENTRADA_SALIDA_DET es2 where es2.INS_ID=i.INS_ID) WHERE i.PAR_COD like '. $this->db->escape('%.%') .' AND i.INS_DES containing ' . $this->db->escape("$search_term") . ' ORDER BY esd.ESD_FECHA desc');

		if ($query) {
			return $query;
		} else {
			return false;
		}
	}

	public function searchterm_handler($search_term)
	{
		if($search_term)
		{
			$this->session->set_userdata('search_term', $search_term);
			return $search_term;
		}
		elseif($this->session->userdata('search_term'))
		{
			$search_term = $this->session->userdata('search_term');
			return $search_term;
		}
		else
		{
			$search_term ="";
			return $search_term;
		}
	}

}

/* End of file insumos_model.php */
/* Location: ./application/models/insumos_model.php */