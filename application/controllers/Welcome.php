<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('Insumos_model');
		$this->load->library('pagination');

		$this->session->unset_userdata('searchterm');
		
		$config['base_url'] = site_url('welcome/index');
		$config['total_rows'] = $this->Insumos_model->total_registros();
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;

		$choice = $config['total_rows'] / $config['per_page'];

		//$config['num_links'] = floor($choice);
		$config['num_links'] = 5;

		//incluyendo bootstrap styles
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'Primero';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Ultimo';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';

		//extra
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['query'] = $this->Insumos_model->get_insumos($config['per_page'], $data['page']);

		$data['pagination'] = $this->pagination->create_links();


		$this->load->view('welcome_message',$data);
	}

	public function buscar()
	{
		$this->load->helper('url');
    	$this->load->helper('form');
		$this->load->model('Insumos_model');
		$this->load->library('pagination');

		$search_term = $this->Insumos_model->searchterm_handler($this->input->post('search_term', TRUE));

		$config['base_url'] = site_url('welcome/buscar');
		$config['total_rows'] = $this->Insumos_model->total_registros_match($search_term);
		$config['per_page'] = 20;
		$config['uri_segment'] = 3;

		$choice = $config['total_rows'] / $config['per_page'];

		//$config['num_links'] = floor($choice);
		$config['num_links'] = 5;

		//incluyendo bootstrap styles
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'Primero';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Ultimo';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';

		//extra
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data['query'] = $this->Insumos_model->get_insumos_match($config['per_page'], $data['page'],$search_term);

		$data['pagination'] = $this->pagination->create_links();

		$data['search_term'] = $search_term;

		$this->load->view('welcome_message',$data);
	}
}
