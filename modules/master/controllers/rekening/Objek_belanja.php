<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Objek_belanja extends Aksara
{
	private $_table									= 'ref__rek_4';
	private $_title									= null;
	function __construct()
	{
		parent::__construct();
		$this->set_permission();
		$this->set_theme('backend');
		$this->_primary								= $this->input->get('id_ref_rek_3');
	}
	
	public function index()
	{
		$this->set_breadcrumb
		(
			array
			(
				'master/rekening/akun'				=> phrase('akun'),
				'../kelompok'						=> phrase('kelompok'),
				'../jenis_belanja'					=> phrase('jenis_belanja')
			)
		);
		if($this->_primary)
		{
			$this->_title							= $this->model->select('uraian')->get_where('ref__rek_3', array('id' => $this->_primary), 1)->row('uraian');
			$this->where
			(
				array
				(
					'id_ref_rek_3'					=> $this->_primary,
					'tahun'							=> get_userdata('year')
				)
			)
			->set_default
			(
				array
				(
					'id_ref_rek_3'					=> $this->_primary,
					'tahun'							=> get_userdata('year')
				)
			)
			->unset_column('id_ref_rek_3')
			->unset_field('id_ref_rek_3')
			->unset_view('id_ref_rek_3');
		}
		else
		{
			$this->where
			(
				array
				(
					'tahun'							=> get_userdata('year')
				)
			)
			->set_default
			(
				array
				(
					'tahun'							=> get_userdata('year')
				)
			)
			->set_relation
			(
				'id_ref_rek_3',
				'ref__rek_3.id',
				'{ref__rek_1.kd_rek_1}.{ref__rek_2.kd_rek_2}.{ref__rek_3.kd_rek_3} - {ref__rek_3.uraian}',
				array
				(
					'ref__rek_3.tahun'			=> get_userdata('year')
				),
				array
				(
					array
					(
						'ref__rek_2',
						'ref__rek_2.id = ref__rek_3.id_ref_rek_2'
					),
					array
					(
						'ref__rek_1',
						'ref__rek_1.id = ref__rek_2.id_ref_rek_1'
					)
				)
			);
		}
		
		if('isu' == $this->input->post('method'))
		{
			$this->_get_last_code();
		}
		else
		{
			$this->set_title(phrase('objek_belanja') . ' ' . $this->_title)
			->set_icon('fa fa-user-circle-o')
			->unset_column('id, id_ref_rek_4, tahun')
			->unset_view('id, id_ref_rek_4, tahun')
			->unset_field('id, tahun')
			->set_field('uraian', 'textarea, hyperlink', 'master/rekening/rincian_objek', array('id_ref_rek_4' => 'id'))
			->column_order('kd_rek_1, uraian')
			->field_order('id_ref_rek_3, kd_rek_4')
			->merge_content('<b>{kd_rek_1}.{kd_rek_2}.{kd_rek_3}.{kd_rek_4}</b>', phrase('kode'))
			->add_class
			(
				array
				(
					'id_ref_rek_3'						=> 'trigger_kode',
					'kd_rek_4'							=> 'kode_input',
					'uraian'							=> 'autofocus'
				)
			)
			->set_relation
			(
				'id_jns_kas',
				'ref__jenis_kas.id',
				'{ref__jenis_kas.nama}'
			)
			->set_alias
			(
				array
				(
					'id_ref_rek_3'						=> 'Jenis Belanja',
					'kd_rek_4'							=> 'Kode',
					'uraian'							=> 'Objek Belanja',
					'uraian_ref_rek_3'					=> 'Jenis Belanja',
					'id_jns_kas'						=> 'Jenis Kas',
					'nama'								=> 'Jenis Kas'
				)
			)
			->set_validation
			(
				array
				(
					'id_ref_rek_3'						=> 'required',
					'kd_rek_4'							=> 'required',
					'uraian'							=> 'required',
					'id_jns_kas'						=> 'required'
				)
			)
			->order_by('kd_rek_1, kd_rek_2, kd_rek_3, kd_rek_4')
			->render($this->_table);
		}
	}
	
	private function _get_last_code()
	{
		$last_code											= $this->model->select_max('kd_rek_4')->get_where('ref__rek_4', array('id_ref_rek_3' => $this->input->post('isu')), 1)->row('kd_rek_4');
		
		make_json
		(
			array
			(
				'html'										=> $last_code + 1
			)
		);
	}
}