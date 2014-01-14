<?
class Artist_model extends CI_Model {

  function __construct()
  {
    parent::__construct();
  }


  function search($name, $page = 1)
  {

    $offset = 20*($page-1);


    $this->load->database();
    $this->db->select('*, release.id as release_id');
    $this->db->from('release');
    $this->db->join('artist', 'artist.id = release.artist_id');
    $this->db->join('labels', 'labels.id = release.labels_id','left');
    $this->db->like('artist.artist_name', $name, 'both');
    $this->db->join('music_genres', 'release.music_genres_id = music_genres.id');
    $this->db->limit(20,$offset);
    $this->db->order_by("release.title", "asc");
    $query = $this->db->get();
    return $query->result();
  }

  function search_discography($name,$offset)
  {
    $this->load->database();
    $this->db->select('*, release.id as release_id');
    $this->db->from('release');
    $this->db->join('artist', 'artist.id = release.artist_id');
    $this->db->join('labels', 'labels.id = release.labels_id');
    $this->db->like('labels.label_name', $name, 'both');
    $this->db->join('music_genres', 'release.music_genres_id = music_genres.id');
//  $this->db->offset($offset);
    $this->db->order_by("release.title", "asc");
    $query = $this->db->get();
    return $query->result();
  }


  function get_letter($let)
  {
    $this->load->database();
    $this->db->select('*, COUNT(artist.id) AS num_releases');
    $this->db->from('release');
    $this->db->join('artist', 'artist.id = release.artist_id');
    $this->db->like('artist.artist_name', $let, 'after');
    $this->db->order_by("artist.artist_name", "asc");
    $this->db->group_by("artist.artist_name"); 
    $query = $this->db->get();
    return $query->result();
  }

    function get_characters()
  {
    $this->load->database();
    $this->db->select('*, COUNT(artist.id) AS num_releases');
    $this->db->from('release');
    $this->db->join('artist', 'artist.id = release.artist_id');
    $this->db->where('artist.artist_name RLIKE ', "'^[0-9].*'", FALSE);
    $this->db->order_by("artist.artist_name", "asc");
    $this->db->group_by("artist.artist_name"); 
    $query = $this->db->get();
    return $query->result();
  }

  function get_all(){


    
  }


  function get_by_slug($slug, $page = 1)
  {
    $this->load->database();

    $offset = 20*($page-1);

    $this->db->select('*, release.id as release_id');
    $this->db->from('release');
    $this->db->join('artist', 'artist.id = release.artist_id');
    $this->db->join('labels', 'labels.id = release.labels_id','left');
    $this->db->where('artist.artist_slug', $slug);
    $this->db->join('music_genres', 'release.music_genres_id = music_genres.id','left');
    $this->db->limit(20,$offset);
    $this->db->order_by("release.title", "asc");
    $query = $this->db->get();
    $result = $query->result();

    $this->db->select('*');
    $this->db->from('release');
    $this->db->join('artist', 'artist.id = release.artist_id');
    $this->db->where('artist.artist_slug', $slug);
    $query2 = $this->db->get();

    $rowcount = $query2->num_rows();
    $this->db->where('artist.artist_slug', $slug);
    $this->db->set('num_views', 'num_views+1', FALSE);
    $this->db->set('num_releases', $rowcount);
    $this->db->update('artist');

    return $result;
  }

  function get_top(){

    $this->load->database();
    $this->db->select('*');
    $this->db->from('artist');
    $this->db->limit(40);
    $this->db->order_by("artist.num_releases", "desc");
    $query = $this->db->get();
    return $query->result();
    
  }



  function edit_by_slug($slug)
  {
    $this->load->database();


    $this->db->select('*');
    $this->db->from('artist');
    $this->db->where('artist.artist_slug', $slug);
    $query = $this->db->get();
    $result = $query->row();

    return $result;
  }

}

?>