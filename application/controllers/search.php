<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {


	public function index()
	{

		redirect('/', 'refresh');
		
	}
	


	public function artist($name = NULL,$page = 1)
	{
		if(!$name){
			redirect('/', 'refresh');

		}

		$name2 = rawurldecode(str_replace('-',' ',$name));
		$name2 = str_replace('&#40;', '(', $name2);
		$name2 = str_replace('&#41;', ')', $name2);


		$this->load->model('artist_model');

		$data['search_name'] = $name2;
        $data['release']  = $this->artist_model->search($name2,$page);
      //  error_log($this->db->last_query());

		$this->load->view('includes/header'); 
		$this->load->view('includes/navbar'); 
		$this->load->view('search/searchArtist',$data);
		$this->load->view('includes/footer',$data);
	}

	public function all($name = NULL,$page = 1)
	{
		if(!$name){
			redirect('/', 'refresh');

		}

		$name2 = rawurldecode(str_replace('-',' ',$name));
		$name2 = str_replace('&#40;', '(', $name2);
		$name2 = str_replace('&#41;', ')', $name2);


		$this->load->model('artist_model');
		$this->load->model('release_model');

		$data['search_name'] = $name2;
        $data['artist_release']  = $this->artist_model->search($name2,$page);
        $data['title_release']  = $this->release_model->search($name2,$page);

      //  error_log($this->db->last_query());

		$this->load->view('includes/header'); 
		$this->load->view('includes/navbar'); 
		$this->load->view('search/searchGlobal',$data);
		$this->load->view('includes/footer',$data);
	}

	public function releaseNotFound($name = NULL,$page = 1)
	{
		if(!$name){
			redirect('/', 'refresh');

		}

		$name2 = rawurldecode(str_replace('-',' ',$name));
		$name2 = str_replace('&#40;', '(', $name2);
		$name2 = str_replace('&#41;', ')', $name2);


		$this->load->model('artist_model');

		$data['search_name'] = $name2;
        $data['release']  = $this->artist_model->search($name2,$page);
      //  error_log($this->db->last_query());

		$this->load->view('includes/header'); 
		$this->load->view('includes/navbar'); 
		$this->load->view('release/releaseNotFound',$data);
		$this->load->view('includes/footer',$data);
	}


	public function label($name = NULL,$offset = 0)
	{
		if(!$name){
			redirect('/', 'refresh');

		}

		$name2 = rawurldecode(str_replace('-',' ',$name));
		$name2 = str_replace('&#40;', '(', $name2);
		$name2 = str_replace('&#41;', ')', $name2);


		$this->load->model('artist_model');

		$data['search_name'] = $name2;
        $data['release']  = $this->artist_model->search_discography($name2,$offset);
      //  error_log($this->db->last_query());

		$this->load->view('includes/header'); 
		$this->load->view('includes/navbar'); 
		$this->load->view('search/searchDiscography',$data);
		$this->load->view('includes/footer',$data);
	}

	public function discography($name = NULL,$offset = 0)
	{
			redirect('/label/', 'refresh');
	}
}
