<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Front extends CI_Controller {


	public function index()
	{
		
		$this->load->model('release_model');
		$this->load->model('activity_model');

        $data['release'] = $this->release_model->get_last_ten_entries(0);
		$data['next'] = 2;

        $data['top_downloads'] = $this->release_model->get_top_downloads(0);
        $data['hot_release'] = $this->release_model->get_hot_entries(0);

        $data['last_activity'] = $this->activity_model->getLastActivity(0);

		$this->db->from('release');
		$data['total_releases']  = $this->db->count_all_results();
		
		$this->db->from('artist');
		$data['total_artists']  = $this->db->count_all_results();

		$this->db->from('link');
		$data['total_links']  = $this->db->count_all_results();

		$this->db->from('labels');
		$data['total_disco']  = $this->db->count_all_results();

		$this->load->view('includes/header',$data); 
		$this->load->view('includes/navbar'); 
		$this->load->view('front',$data);
		$this->load->view('includes/footer');
	}

	public function page($offset = 1)
	{

		if($offset<=1){
			redirect('/', 'refresh');
		}
		
		$this->load->model('release_model');
        $data['release'] = $this->release_model->get_last_ten_entries(($offset-1)*10);

        if($offset>1){
        	$data['previous'] = $offset-1;
        }else{
        	$data['hot_release'] = $this->release_model->get_hot_entries(0);
        }

		$this->db->from('release');
		$data['total_releases']  = $this->db->count_all_results();
		
		$this->db->from('artist');
		$data['total_artists']  = $this->db->count_all_results();

		$this->db->from('link');
		$data['total_links']  = $this->db->count_all_results();

		$this->db->from('labels');
		$data['total_disco']  = $this->db->count_all_results();
		
		if(($offset)*10> $data['total_releases'])
		{



		}else
		{
	        $data['next'] = $offset+1;
		}

		$this->load->view('includes/header',$data); 
		$this->load->view('includes/navbar'); 
		$this->load->view('front',$data);
		$this->load->view('includes/footer');
	}

	public function hotReleases()
	{

		$this->load->model('release_model');

        $data['hot_release'] = $this->release_model->get_all_hot_entries(0);


		$this->load->view('includes/header',$data); 
		$this->load->view('includes/navbar'); 
		$this->load->view('hotReleases',$data);
		$this->load->view('includes/footer');

	}


}
