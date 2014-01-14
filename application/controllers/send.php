<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Send extends CI_Controller {


	public function index()
	{

		/*
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		*/
		

		$this->load->view('includes/header'); 
		$this->load->view('includes/navbar'); 
		$this->load->view('send');
		$this->load->view('includes/footer');
	}

	public function input()
	{
		/*
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login', 'refresh');
		}
		*/

		$this->load->library('form_validation');

		$this->form_validation->set_rules('artist', 'Artist', 'required');
		$this->form_validation->set_rules('title', 'Release', 'required');
		$this->form_validation->set_rules('tracklist', 'Tracklist', 'required');

		if ($this->form_validation->run() == FALSE)
		{

			$this->load->view('includes/header'); 
			$this->load->view('includes/navbar'); 
			$this->load->view('send');
			$this->load->view('includes/footer');			
		}else{

			$this->load->model('release_model');
			$this->release_model->entry_insert();
			redirect('front','refresh');

			//redirect('detail/view/'.$this->input->post('campaign_id'), 'refresh');
		}
	}

	public function directInput()
	{
		$this->load->model('release_model');
		$this->release_model->entry_insert();
		echo $this->input->post('title');
		echo "ok";

	}

}
