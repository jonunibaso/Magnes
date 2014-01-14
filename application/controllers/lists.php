<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lists extends CI_Controller {


	public function view($slug = NULL)
	{

		if (!$slug)
		{
			redirect('/');
		}

		$this->load->model('list_model');
		$data['list'] =  $this->list_model->get_by_slug($slug);

		if (!isset($data['list']->list_name)){

			redirect('/');


		}else{

			#$data['user'] = $this->ion_auth->user()->row();
			$this->db->from('users');
			$this->db->where('id',$data['list']->users_id);
			$query = $this->db->get();
			$result = $query->row();
			$data['user_list'] = $result;

			$data['list_releases'] = $this->list_model->get_releases($data['list']->id);

			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar'); 
			$this->load->view('listView', $data);
			$this->load->view('includes/footer');
		}

	}



	public function index()
	{

		redirect('/');
	}




}
