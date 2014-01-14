<?
class Label_model extends CI_Model {

  function __construct()
  {
    parent::__construct();
  }


  function search($name,$offset)
  {
    $this->load->database();
    $this->db->select('*, release.id as release_id');
    $this->db->from('release');
    $this->db->join('artist', 'artist.id = release.artist_id');
    $this->db->join('labels', 'labels.id = release.labels_id');
    $this->db->like('artist.artist_name', $name, 'both');
    $this->db->join('music_genres', 'release.music_genres_id = music_genres.id');
//  $this->db->offset($offset);
    $this->db->order_by("release.title", "asc");
    $query = $this->db->get();
    return $query->result();
  }

  function search_labels($name,$offset)
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
    $this->db->select('*');
    $this->db->from('labels');
    $this->db->like('labels.label_name', $let, 'after');
    $this->db->order_by("labels.label_name", "asc");
    $query = $this->db->get();
    return $query->result();
  }

  function get_characters()
  {
    $this->load->database();
    $this->db->select('*');
    $this->db->from('labels');
    $this->db->where('labels.label_name RLIKE ', "'^[0-9].*'", FALSE);
    $this->db->order_by("labels.label_name", "asc");
    $query = $this->db->get();
    return $query->result();
  }

  function get_top(){

    $this->load->database();
    $this->db->select('*');
    $this->db->from('labels');
    $this->db->limit(40);
    $this->db->order_by("labels.num_releases", "desc");
    $query = $this->db->get();
    return $query->result();
    
  }

  function get_by_slug($slug)
  {
    $this->load->database();


    $this->db->select('*, labels.id as label_id');
    $this->db->from('release');
    $this->db->join('artist', 'artist.id = release.artist_id');
    $this->db->join('labels', 'labels.id = release.labels_id');
    $this->db->where('labels.label_slug', $slug);
    $this->db->join('music_genres', 'release.music_genres_id = music_genres.id','left');
//  $this->db->offset($offset);
    $this->db->order_by("release.title", "asc");
    $query = $this->db->get();
    $result = $query->result();

    $rowcount = $query->num_rows();
    $this->db->where('labels.label_slug', $slug);
    $this->db->set('num_views', 'num_views+1', FALSE);
    $this->db->set('num_releases', $rowcount);
    $this->db->update('labels');

    return $result;
  }


  function edit_by_slug($slug)
  {
    $this->load->database();


    $this->db->select('*');
    $this->db->from('labels');
    $this->db->where('labels.label_slug', $slug);
    $query = $this->db->get();
    $result = $query->row();

    return $result;
  }

  function get_by_userId($uID){

    $this->load->database();
    $this->db->select('*, labels.id as label_id');
    $this->db->from('users_labels');
    $this->db->join('labels', 'labels.id = users_labels.labels_id');
    $this->db->where('users_labels.users_id', $uID);
    $this->db->order_by("labels.id", "asc");
    $query = $this->db->get();
    return $query->result();
  }

}

?>