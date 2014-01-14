<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {


	public function index()
	{

		redirect('/', 'refresh');
	}


	public function v($userName = NULL)
	{

		if (!$userName)
		{
			redirect('/');
		}

		$this->db->from('users');
		$this->db->where('username',$userName);
		$query = $this->db->get();
		$result = $query->row();

		if (!isset($result->username))
		{
			redirect('/', 'refresh');

		}else{

			$data['user'] = $result;
			$this->load->model('list_model');
			$data['lists'] = $this->list_model->get_by_userId($data['user']->id);
			$this->load->model('label_model');
			$data['labels'] = $this->label_model->get_by_userId($data['user']->id);

			$this->load->view('includes/header',$data); 
			$this->load->view('includes/navbar'); 
			$this->load->view('user/userProfile',$data);
			$this->load->view('includes/footer');
		}

	}

	public function listAll()
	{

		if (!$this->ion_auth->is_admin())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$this->db->from('users');
		$query = $this->db->get();
		$result = $query->result();
		$data['users'] = $result;

		$this->load->view('includes/header'); 
		$this->load->view('includes/navbar'); 
		$this->load->view('user/usersList',$data);
		$this->load->view('includes/footer');

	}

}
