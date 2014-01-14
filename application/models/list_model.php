<?
class List_model extends CI_Model {

  function __construct()
  {
    parent::__construct();
  }


  function get_by_userId($id)
  {
    /*
    $this->load->database();
    $this->db->select('*, lists.id as listID, COUNT(lists_releases.id) AS num_items');
    $this->db->from('lists');
    $this->db->join('lists_releases', 'lists.id = lists_releases.lists_id','left');
    $this->db->where('lists.users_id', $id);
    $this->db->order_by("lists.id", "asc");
    $this->db->group_by("lists_releases.id"); 
    $query = $this->db->get();
    return $query->result();*/

    $this->load->database();
    $this->db->select('*, lists.id as listID');
    $this->db->from('lists');
    $this->db->where('lists.users_id', $id);
    $this->db->order_by("lists.id", "asc");
    $query = $this->db->get();
    return $query->result();
  }

  function  get_by_slug($slug)
  {

    $this->load->database();

    $this->db->where('lists.slug', $slug);
    $this->db->set('views', 'views+1', FALSE);
    $this->db->update('lists');

    $this->db->select('*, lists.id as list_id');
    $this->db->from('lists');
    $this->db->where('lists.slug', $slug);

    $query = $this->db->get();
    return $query->row();
  }


  function get_releases($listID)
  {

    $this->load->database();
    $this->db->select('*, release.id as release_id');
    $this->db->from('lists_releases');
    $this->db->join('release', 'lists_releases.release_id = release.id');
    $this->db->join('artist', 'artist.id = release.artist_id');
    $this->db->join('music_genres', 'release.music_genres_id = music_genres.id');
    $this->db->join('labels', 'release.labels_id = labels.id','left');
    $this->db->where('lists_releases.lists_id',$listID);
    $this->db->order_by("release.id", "desc");
    $query = $this->db->get();
    return  $query->result();
  }

  function createList($userID,$username)
  {

    $list_name = $this->input->post('name');
    $title_slug = $username.'-'.$list_name;
    $slug = url_title( $title_slug, 'dash', true);

    error_log("initial slug: ".$slug);

    while ($this->db->get_where('lists', array('slug' => $slug))->num_rows()){
      $rand = rand(0, 9);
      $slug .= '-'.$rand; 
      error_log("newslug: ".$slug);
    }

    $data = array(
     'users_id'=> $userID,
     'list_name'=>$list_name,
     'slug' => $slug
     );

    $this->db->insert('lists',$data);
    $list_id =  $this->db->insert_id();
    return $list_id;
  }


  function addToList($userID)
  {



    $this->load->database();
    $this->db->select('*');
    $this->db->from('lists');
    $this->db->where('lists.id', $this->input->post('lID'));
    $query = $this->db->get();

    $owner =  $query->row();

    error_log("oId:".$owner->users_id);

    if($owner->users_id!=$userID){

    }else{


      $query = $this->db->get_where('lists_releases', array('lists_id' => $this->input->post('lID'), 'release_id' => $this->input->post('rID')))->row();

      if (isset($query->id))
      {
        $this->db->delete('lists_releases',  array('lists_id' => $this->input->post('lID'), 'release_id' => $this->input->post('rID')));
        return false;
      }else{

        $data = array(
          'release_id'=> $this->input->post('rID'),
          'lists_id'=> $this->input->post('lID')
          );
        $this->db->insert('lists_releases',$data);
        return true;
      }

    }

  }


}

?>