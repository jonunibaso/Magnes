<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Artist extends CI_Controller {


	public function index()
	{

		$this->load->model('artist_model');

		$data['artist_list'] = $this->artist_model->get_letter('a');
		$data['artist_top'] = $this->artist_model->get_top();

		$this->load->view('includes/header'); 
		$this->load->view('includes/navbar'); 
		$this->load->view('artist/artistList',$data);
		$this->load->view('includes/footer');


	}

	public function view($slug=NULL,$page = 1)
	{

		if(!$slug){
			redirect('/', 'refresh');

		}

		$this->load->model('artist_model');

		$data['release']  = $this->artist_model->get_by_slug($slug,$page);

		if(count($data['release'])>0)
		{
			$data['notFound'] = False;
			

			$this->load->library('pagination');

			$this->db->from('artist');
			$this->db->where('artist_slug',$slug);
			$query = $this->db->get();
			$result = $query->row();
			$total = $result->num_releases;


			$config['base_url'] =  base_url() .'/artist/view/'.$slug;
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
			$this->load->view('artist/artistReleases',$data);
			$this->load->view('includes/footer',$data);
		}
		else{

			$data['notFound'] = True;

			$this->load->view('includes/header',$data); 
			$this->load->view('includes/navbar'); 
			$this->load->view('artistNotFound',$data);
			$this->load->view('includes/footer',$data);      

		}


	}

	public function search()
	{


			//$this->load->model('artist_model');
			//$this->artist_model->entry_insert();
		
		$this->load->database();
		$this->db->like('artist_name', $this->input->post('q'), 'both');
		$query = $this->db->get('artist')->result_array();
		$array = array($query);


		header('Content-Type: application/json', true);
		echo json_encode($query);   

	}

	public function letter($let = 'a')
	{

		$this->load->model('artist_model');

		if($let=="characters")
		{
			$data['artist_list'] = $this->artist_model->get_characters();
		}else
		{
			$data['artist_list'] = $this->artist_model->get_letter($let);
		}

		$data['artist_top'] = $this->artist_model->get_top();

		$this->load->view('includes/header'); 
		$this->load->view('includes/navbar'); 
		$this->load->view('artistList',$data);
		$this->load->view('includes/footer');
	}

	public function rename(){

		if (!$this->ion_auth->is_admin())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$artistID = $this->input->post('artistID');
		$newName = $this->input->post('newN');

	    $this->load->database();
	    $this->db->select('*');
	    $this->db->from('artist');
	    $this->db->where('artist.id', $artistID);

	    $query = $this->db->get();
	    $artist = $query->row();

	    if ($artist) {

			$ls =  url_title( $newName, 'dash', true);


     		while ($this->db->get_where('artist', array('artist_slug' => $ls))->num_rows()){
        		$rand = rand(0, 9);
        		$ls .= '-'.$rand; 
      		}

			$discoData = array(
	     	 	'artist_name'=>$newName,
	     		'artist_slug' => $ls
	    	);

			$this->db->where('id',$artistID);
		    $this->db->update('artist', $discoData);

	    }

	}


	public function insertInto(){

		if (!$this->ion_auth->is_admin())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$artistID = $this->input->post('artistID');
		$insertID = $this->input->post('intoID');

	    $this->load->database();
	    $this->db->select('*');
	    $this->db->from('release');
	    $this->db->where('release.artist_id', $artistID);

	    $query = $this->db->get();
	    $releases = $query->result();

	    foreach ($releases as $r) {

   			$data = array(
		     'artist_id' => $insertID
		     );

		    $this->db->where('id',$r->id);
		    $this->db->update('release', $data);
	    }
	  $this->db->delete('artist', array('id' => $artistID));

	}


	/*

	public function createSlugs(){


		if (!$this->ion_auth->is_admin())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}

	    $this->load->database();
	    $this->db->select('*');
	    $this->db->from('artist');
	    $this->db->order_by("artist.id", "asc");
	    $query = $this->db->get();
	    $artists = $query->result();

	    foreach ($artists as $l) {

			$slug = url_title( $l->artist_name, 'dash', true);
			 
			while ($this->db->get_where('artist', array('artist_slug' => $slug))->num_rows()){
		      $rand = rand(0, 9);
		      $slug .= '-'.$rand; 

		    }

			$num_releases = 0;

		    $num_releases = $this->db->get_where('release', array('artist_id' => $l->id))->num_rows();
				
		    $data = array(
		     'artist_slug'=>$slug,
		     'num_releases'=>$num_releases,
		     'num_views' => 0
		     );

		    $this->db->where('id',$l->id);
		    $this->db->update('artist', $data);


	    	echo "name: ".$l->artist_name." - slug: ".$slug."<br>num_releases: ".$num_releases."<br>";
	    }

	}
*/


}
