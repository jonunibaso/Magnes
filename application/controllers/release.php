<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Release extends CI_Controller {


	public function download($slug)
	{

		if (!$slug)
		{
			redirect('/');
		}

		$this->load->model('release_model');
        //$data['release'] = $this->release_model->get_by_id($releaseID);
		
		$data['release'] = $this->release_model->get_by_slug($slug);

		if (!isset($data['release']->title))
		{

			$terms = explode( '-' , $slug );
        	$nt = count($terms);

        	if($nt>0){
       			redirect('search/releaseNotFound/'.$terms[0]);
			}


		}else{

			if ($data['release']->countries_id==0){
				$data['country'] = "";
			}else{

				$this->db->from('countries');
				$this->db->where('id',$data['release']->countries_id);
				$query = $this->db->get();
				$result = $query->row();
				$data['country'] = $result->country_name;
			}


			if ($this->ion_auth->logged_in()){

                $data['user'] = $this->ion_auth->user()->row();
 				$this->load->model('list_model');
            	$data['lists'] = $this->list_model->get_by_userId( $data['user']->id);
            }

			$this->load->view('includes/header', $data);
			$this->load->view('includes/navbar'); 
			$this->load->view('release/releaseView', $data);
			$this->load->view('includes/footer');
		}

	}


	public function delete($releaseID)
	{

		if (!$releaseID)
		{
			redirect('/');
		}
		if (!$this->ion_auth->is_admin())
		{
			redirect('/');			
		}

		$this->load->model('release_model');
		$this->release_model->delete($releaseID);

		redirect('/');			

	}


	public function addLink($releaseID)
	{

		if (!$releaseID)
		{
			redirect('/');
		}

		$this->load->model('release_model');
		$this->release_model->add_link();
	}


	public function addCoverLink($releaseID)
	{

		if (!$releaseID)
		{
			redirect('/');
		}

		$this->load->model('release_model');
		$this->release_model->add_cover_link();
	}

	public function rateLink($releaseID)
	{

		if (!$releaseID)
		{
			redirect('/');
		}
		if (!$this->ion_auth->logged_in())
		{
			redirect('/');
		}

		$user = $this->ion_auth->user()->row();

		$this->load->model('release_model');
		echo $this->release_model->rate_link($user->id);

	}

	public function addToList()
	{

		if (!$this->ion_auth->logged_in())
		{
			redirect('/');
		}

		$user = $this->ion_auth->user()->row();

		$this->load->model('list_model');
		$v =  $this->list_model->addToList($user->id);

		$this->load->model('activity_model');
		$this->activity_model->releaseAddList($user->id, $this->input->post('rID'), $this->input->post('lID') );

		echo $v;

	}


	public function toggleHot(){
		
		if (!$this->ion_auth->logged_in())
		{
			redirect('/');
		}
		$this->load->model('release_model');
		$this->release_model->toggleHot($this->input->post('id'));

	}

	public function updateTrack(){
		
		if (!$this->ion_auth->logged_in())
		{
			redirect('/');
		}
	
		if( $this->input->post('nt') )
		{
			$new_track = strip_tags($this->input->post('nt'));

			$this->load->database();
			$data = array(
				'tracklist'=>$new_track
				);

			$this->db->where('id',$this->input->post('id'));
			$this->db->update('release', $data);

		}

	}

	public function updateStatus(){
		
		if (!$this->ion_auth->logged_in())
		{
			redirect('/');
		}
	
		if( $this->input->post('ns') )
		{
			$new_status = $this->input->post('ns');

			$this->load->database();
			$data = array(
				'status'=>$new_status
				);

			$this->db->where('id',$this->input->post('id'));
			$this->db->update('release', $data);

		}

	}


	public function index()
	{

		redirect('/');
	}




	/**** Admin tools ****/

	public function fixLinks(){


		if (!$this->ion_auth->is_admin())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}

		$serverList = array("180upload","1fichier","2shared","4shared","allmyvideos.net","amonshare","arabsh","asfile","bayfiles","bitshare","box","boxca","cramit.in","crocko","ctdisk","czshare","datafilehost","demo.ovh.net","depositfiles","divxstage.eu","dl.free.fr","dosya.tc","dropbox","easybytez","esnips","extabit","fastupload.rol.ro","file.damasgate","fileband","filebox","filefactory","fileflyer","fileice.net","filejungle","filemates","filenuke","filepost","files.mail.ru","files.namba.kz","fileserve","filesflash","filesin","filesmonster","filesonic","fileswap","freakshare","fshare.vn","ge.tt","gigabase","gigapeta","gigasize","glumbouploads","good.gd","grooveshark","hidemyass","hipfile","hitfile.net","host.hackerbox.org","hostingbulk","hotfile","howfile","hulkshare","idup.in","imagearn","indowebster","ishare.iask.sina.com.cn","issuu","jandown","jumbofiles","kiwi6","kuai.xunlei","letitbit.net","luckyshare.net","mediafire","megashare.vnn.vn","megashares","minus","mixturecloud","movreel","movshare.net","movzap","muchshare.net","net366.cba.pl","netload.in","novamov","pdfcast.org","pornhost","putlocker","queenshare","rapidgator","redpost.mts.ru","rghost.net","saponeclick.de.vu","scribd.com","sendmyway","sendspace","share-online.biz","Hoster","sharebeast","sharecash.org","shareflare.net","sharerepo","slideshare.net","slingfile","sockshare","soundcloud","speedyshare","stagevu","stooorage","sugarsync","transferbigfiles","trilulilu.ro","tusfiles.net","twitvid","u.115","uloz.to","unibytes","up.4share.vn","up.eqla3","upanh","upload.ugm.ac.id","uploadbaz","uploadc","uploading","uploadstation","uplod.ir","uppit","uptobox","veevr","vidbull","vidbux","videarn","videoalbumy.azet.sk","videobam","videobb","vidxden","vimeo","vip-file","wetransfer","wupload","xvidstage","yourfilehost","yousendit","zalaa","zalil.ru","ziddu","zippyshare","novafile","uploaded","rapidshare","turbobit","cloudzer");


	    $this->load->database();
	    $this->db->select('*');
	    $this->db->from('link_group');
	    $this->db->where('server','-');
	    $query = $this->db->get();
	    $labels = $query->result();

	    foreach ($labels as $l) {

	    	$linkI = $this->db->get_where('link', array('link_group_id' => $l->id))->row();

	    	if(isset($linkI->id)){
	    	if($linkI->id){
	    		echo $linkI->url."<br>";
	    	}

	    	$nl = $l->server;

	    	if($nl=="-")
	    	{
		    	foreach ($serverList as $s) {
		    		if (strpos($linkI->url,$s) !== false){
		    			echo "found: ".$s."<br>";
		    			$nl = $s;
		    		}
		    	}

		    	if($nl=="-"){
		    		if(strpos($linkI->url,"ul.to") !== false){
		    			echo "found: uploaded (ul.to)<br>";
		    			$nl = "uploaded";
		    		}
		    	}
			}
			
			$qu = $l->quality;
	    	if($qu=="-"){
	    		$qu = "320kbps";
	    	}

		    $data = array(
		     'server'=>$nl,
		     'quality' => $qu
		     );


		    $this->db->where('id',$l->id);
		    $this->db->update('link_group', $data);
			
	    	echo "id: ".$l->id." - Server: (".$qu.") ".$nl."<br><br>";
	    	}
	    }

	}
	
	public function fixDates(){


		if (!$this->ion_auth->is_admin())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}

	    $this->load->database();
	    $this->db->select('*');
	    $this->db->from('release');
	    $this->db->like('date','00-');
	    $query = $this->db->get();
	    $releases = $query->result();

	    foreach ($releases as $r) {

	    	$oldDate = $r->date;
	    	$newDate = str_replace('00-', '',$oldDate);
	    	 
	    	 $data = array(
		     'date'=>$newDate,
		     );

		    $this->db->where('id',$r->id);
		    $this->db->update('release', $data);
			

	    	echo "id: ".$r->id." - title: (".$r->title.") ".$oldDate." - ".$newDate."<br><br>";

	    }

	}

	public function fixTracklists(){


		if (!$this->ion_auth->is_admin())
		{
			//redirect them to the login page
			redirect('auth/login', 'refresh');
		}

	    $this->load->database();
	    $this->db->select('*');
	    $this->db->from('release');
	    $this->db->like('tracklist','â€“');
	    $query = $this->db->get();
	    $releases = $query->result();

	    echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>";

	    foreach ($releases as $r) {

	    	$nt = str_replace('â€“', '-', $r->tracklist);
	    	/*
	    	$oldDate = $r->date;
	    	$newDate = str_replace('00-', '',$oldDate);
	    	*/
	    	 $data = array(
		     'tracklist'=>$nt,
		     );

		    $this->db->where('id',$r->id);
		    $this->db->update('release', $data);
		

	    	echo "id: ".$r->id." - tracklist: <br>(".$nt.") <br><br>";

	    }

	}
}
