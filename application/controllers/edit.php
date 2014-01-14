<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit extends CI_Controller {


	public function index()
	{
		redirect('/', 'refresh');

	}

	public function label($slug=NULL)
	{

		if (!$this->ion_auth->is_admin())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		if(!$slug){
			redirect('/', 'refresh');

		}

		$this->load->model('label_model');

		$data['label']  = $this->label_model->edit_by_slug($slug);


		if(count($data['label'])==1){

			$this->load->view('includes/header',$data); 
			$this->load->view('includes/navbar'); 
			$this->load->view('edit/editLabel',$data);
			$this->load->view('includes/footer',$data);
		}
      //  error_log($this->db->last_query());

	}

	public function artist($slug=NULL)
	{

		if (!$this->ion_auth->is_admin())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		if(!$slug){
			redirect('/', 'refresh');

		}

		$this->load->model('artist_model');

		$data['artist']  = $this->artist_model->edit_by_slug($slug);


		if(count($data['artist'])==1){

			$this->load->view('includes/header',$data); 
			$this->load->view('includes/navbar'); 
			$this->load->view('edit/editArtist',$data);
			$this->load->view('includes/footer',$data);
		}
      //  error_log($this->db->last_query());

	}
	
}
