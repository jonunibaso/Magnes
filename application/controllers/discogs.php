<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include './discogs-api/vendor/autoload.php';


class Discogs extends CI_Controller {


	public function index()
	{



	}

	public function fix()
	{


		if (!$this->ion_auth->is_admin())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$service = new \Discogs\Service();



		$this->load->database();
		$this->db->select('*, release.id as release_id');
		$this->db->from('release');
		$this->db->join('artist', 'artist.id = release.artist_id');
		$this->db->join('music_genres', 'release.music_genres_id = music_genres.id');
		$this->db->join('labels', 'release.labels_id = labels.id','left');
		$this->db->where('release.music_genres_id','6');
		$this->db->limit(10);
		$this->db->offset(0);
		$this->db->order_by("release.id", "asc");
		$query = $this->db->get();
		$releases = $query->result();

		foreach ($releases as $r) {

			echo "id: ".$r->release_id." - ";
			$query = $r->artist_name.' - '.$r->title;

			$resultset = $service->search(array(
				'q'     => $query,
				));
			echo "QUERY: ".$query."<br>";

			// Total results
			$total = count($resultset); 
			echo $total." results...<br>";

			if($total>0){
					// Total pages
					$pagination = $resultset->getPagination();
		
					$found = false;
					//echo count($pagination)."\n";

					// Fetch all results (use on your own risk, only one request per second allowed)
					do {
						$pagination = $resultset->getPagination();
						echo "page: ".$pagination->getPage().'<br /><br />';
						$num = 1;
						foreach ($resultset as $result) {
							if($num<3){

							echo "#".$num." ".$result->getTitle().'<br />';
							echo "uri: http://www.discogs.com".$result->getUri().'<br>';
							foreach ($result->getLabel() as $l) {
								echo "Label: ".$l.'<br>';
							}      
							foreach ($result->getGenre() as $g) {
								echo "genre: ".$g.'<br />';
							}
							foreach ($result->getStyle() as $s) {
								echo "  -".$s.'<br />';
							} 
							echo "</br></br>";
							$num++;
								$found = true;
							}
						}
					}while($resultset = $service->next($resultset) && (!$found));
				}

		}


	}

}
