<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Style extends CI_Controller {


	public function index()
	{

		redirect('/', 'refresh');

	}

	public function view($slug=NULL,$page = 1)
	{
		if(!$slug){
			redirect('/', 'refresh');

		}

		$slug = str_replace('.', ' ', $slug);

		$this->load->model('release_model');

		$data['release']  = $this->release_model->get_by_style($slug,$page);

		if(count($data['release'])>0)
		{

			$this->load->library('pagination');

	        $this->load->database();
	        $this->db->select('*, COUNT(release_music_style.music_style_id) AS num_releases');
	        $this->db->from('music_styles');
	        $this->db->join('release_music_style', 'release_music_style.music_style_id = music_styles.id');
	        $this->db->where('music_styles.style',$slug);
	        $this->db->order_by("num_releases", "desc");
	        $this->db->group_by("release_music_style.music_style_id "); 

			$query = $this->db->get();
			$result = $query->row();
			$total = $result->num_releases;
			error_log($total);


			$config['base_url'] =  base_url() .'/style/view/'.str_replace(' ', '.', $slug);
			$config['total_rows'] = $total;
			$config['per_page'] = 20;
			$config['use_page_numbers'] = TRUE;
			$config['uri_segment'] = 4;
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li><a><b>';
			$config['cur_tag_close'] = '</a></b></li>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';

			$this->pagination->initialize($config);

			$data["links"] = $this->pagination->create_links();


			$this->load->view('includes/header',$data); 
			$this->load->view('includes/navbar'); 
			$this->load->view('style/styleReleases',$data);
			$this->load->view('includes/footer',$data);

		}
	}
}