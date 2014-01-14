<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Label extends CI_Controller {


	public function index()
	{

		$this->load->model('label_model');

		$data['label_list'] = $this->label_model->get_letter('a');
		$data['label_top'] = $this->label_model->get_top();


		$this->load->view('includes/header'); 
		$this->load->view('includes/navbar'); 
		$this->load->view('label/labelList',$data);
		$this->load->view('includes/footer');

	}

	public function view($slug=NULL)
	{

		if(!$slug){
			redirect('/label', 'refresh');

		}

		$this->load->model('label_model');

		$data['release']  = $this->label_model->get_by_slug($slug);
      //  error_log($this->db->last_query());

		if(count($data['release'])>0)
		{
			$data['notFound'] = False;


			$this->load->view('includes/header',$data); 
			$this->load->view('includes/navbar'); 
			$this->load->view('label/labelReleases',$data);
			$this->load->view('includes/footer',$data);        	
		}else{

			$data['notFound'] = True;

			$terms = explode( '-' , $slug );
			$nt = count($terms);

        	/*for ($i=0; $i < ($nt/2) ; $i++) { 
        		error_log($terms[$i]);
        	}*/

        	if($nt>0){
        		$data['release']  = $this->label_model->get_letter($terms[0]);
        	}

        	$this->load->view('includes/header',$data); 
        	$this->load->view('includes/navbar'); 
        	$this->load->view('label/labelNotFound',$data);
        	$this->load->view('includes/footer',$data);        	

        }


    }

    public function search()
    {


		//$this->load->model('artist_model');
		//$this->artist_model->entry_insert();
		/*
		$this->load->database();
			//$this->db->select('*')->from("artist");
		$query = $this->db->get('artist')->result_array();
		$array = array($query);
        header('Content-Type: application/json', true);
        echo json_encode($query);   
		*/
    }

    public function letter($let = 'a')
    {

    	$this->load->model('label_model');

    	if($let=="characters")
    	{
    		$data['label_list'] = $this->label_model->get_characters();
    	}else
    	{
    		$data['label_list'] = $this->label_model->get_letter($let);
    	}

    	$data['label_top'] = $this->label_model->get_top();

    	$this->load->view('includes/header'); 
    	$this->load->view('includes/navbar'); 
    	$this->load->view('label/labelList',$data);
    	$this->load->view('includes/footer');
    }

    public function insertInto(){

    	if (!$this->ion_auth->is_admin())
    	{
			//redirect them to the login page
    		redirect('auth/login', 'refresh');
    	}

    	$labelID = $this->input->post('labelID');
    	$insertID = $this->input->post('intoID');

    	$this->load->database();
    	$this->db->select('*');
    	$this->db->from('release');
    	$this->db->where('release.labels_id', $labelID);

    	$query = $this->db->get();
    	$releases = $query->result();

    	foreach ($releases as $r) {

    		$data = array(
    			'labels_id' => $insertID
    			);

    		$this->db->where('id',$r->id);
    		$this->db->update('release', $data);
    	}
    	$this->db->delete('labels', array('id' => $labelID));

    }

    public function rename(){

    	if (!$this->ion_auth->is_admin())
    	{
			//redirect them to the login page
    		redirect('auth/login', 'refresh');
    	}

    	$labelID = $this->input->post('labelID');
    	$newName = $this->input->post('newN');

    	$this->load->database();
    	$this->db->select('*');
    	$this->db->from('labels');
    	$this->db->where('labels.id', $labelID);

    	$query = $this->db->get();
    	$label = $query->row();

    	if ($label) {

    		$ls =  url_title( $newName, 'dash', true);


    		while ($this->db->get_where('labels', array('label_slug' => $ls))->num_rows()){
    			$rand = rand(0, 9);
    			$ls .= '-'.$rand; 
    		}

    		$discoData = array(
    			'label_name'=>$newName,
    			'label_slug' => $ls
    			);

    		$this->db->where('id',$labelID);
    		$this->db->update('labels', $discoData);

    	}

    }

    public function toggleFav(){

    	if (!$this->ion_auth->logged_in())
    	{
    		redirect('/');
    	}

    	$this->load->database();

        $user = $this->ion_auth->user()->row();
        $userID = $user->id;  

        $labelSlug = $this->input->post('slug');

        $query = $this->db->get_where('labels', array('label_slug' =>$labelSlug))->row();

        if(isset($query->id))
        {
            $labelID = $query->id;

            $query2 = $this->db->get_where('users_labels', array('labels_id' =>$labelID, 'users_id' =>$userID))->row();
            
            if (isset($query2->id))
            {
                $this->db->delete('users_labels', array('labels_id' =>$labelID, 'users_id' =>$userID));

            }else{

                $data = array(
                    'labels_id'=> $labelID,
                    'users_id' => $userID
                    );
                $this->db->insert('users_labels',$data);
                $this->load->model('activity_model');
   
                $this->activity_model->userFavoriteLabel($userID, $labelID);
            }
        }


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
	    $this->db->from('labels');
	    $this->db->order_by("labels.id", "asc");
	    $query = $this->db->get();
	    $labels = $query->result();

	    foreach ($labels as $l) {

			$slug = url_title( $l->label_name, 'dash', true);
			$num_releases = 0;

		    $num_releases = $this->db->get_where('release', array('labels_id' => $l->id))->num_rows();
				
		    $data = array(
		     'label_slug'=>$slug,
		     'num_releases'=>$num_releases,
		     'num_views' => 0
		     );

		    $this->db->where('id',$l->id);
		    $this->db->update('labels', $data);


	    	echo "name: ".$l->label_name." - slug: ".$slug."<br>num_releases: ".$num_releases."<br>";
	    }

	}
	*/
}
