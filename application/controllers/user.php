<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {


	public function index()
	{


		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$data['user'] = $user = $this->ion_auth->user()->row();

		$this->load->model('list_model');
		$data['lists'] = $this->list_model->get_by_userId($data['user']->id);
		

		$this->load->model('label_model');
		$data['labels'] = $this->label_model->get_by_userId($data['user']->id);


		$this->load->view('includes/header'); 
		$this->load->view('includes/navbar'); 
		$this->load->view('user/myProfile',$data);
		$this->load->view('includes/footer');


	}

	public function ajaximage()
	{


		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$path = "uploads/avatars/";
		$user = $this->ion_auth->user()->row();

		$valid_formats = array("jpg", "png", "gif", "bmp");
		if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['photoimg']['name'];
			$size = $_FILES['photoimg']['size'];
			
			if(strlen($name))
			{
				list($txt, $ext) = explode(".", $name);
				if(in_array($ext,$valid_formats))
				{
					if($size<(1024*1024))
					{
						$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
						$tmp = $_FILES['photoimg']['tmp_name'];
						if(move_uploaded_file($tmp, $path.$actual_image_name))
						{

							$config['image_library'] = 'gd2';
							$config['source_image'] = $path.$actual_image_name;
							$config['create_thumb'] = TRUE;
							$config['maintain_ratio'] = TRUE;
							$config['width'] = 150;
							$config['height'] = 150;

							$this->load->library('image_lib', $config);

							$this->image_lib->resize();

							$this->load->database();
							$data = array(
								'image'=>$actual_image_name
								);

							$this->db->where('id',$user->id);
							$this->db->update('users', $data);

							echo "<img src='uploads/avatars/".$actual_image_name."'  class='avatar img-circle'>";
						}
						else
							echo "failed";
					}
					else
						echo "Image file size max 1 MB";					
				}
				else
					echo "Invalid file format..";	
			}

			else
				echo "Please select image..!";

			exit;
		}

	}


	public function ajaxbio()
	{


		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		
		$user = $this->ion_auth->user()->row();


		if( $this->input->post('nb') )
		{
			$new_bio = strip_tags($this->input->post('nb'));

			$this->load->database();
			$data = array(
				'bio'=>$new_bio
				);

			$this->db->where('id',$user->id);
			$this->db->update('users', $data);

		}

	}

	public function createList()
	{

		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}
		
		$user = $this->ion_auth->user()->row();

		if( $this->input->post('name') )
		{

			$this->load->model('list_model');
			echo $this->list_model->createList($user->id,$user->username);

		}



	}

}
