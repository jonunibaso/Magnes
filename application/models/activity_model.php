<?
class Activity_model extends CI_Model {

  function __construct()
  {
    parent::__construct();
  }

  /* Type List
     
     1: userFavoriteLabel 
     2: releaseAddList

  */


     function getLastActivity($offset)
     {


      $q = "SELECT activity.*, labels.*, users.username, lists.* FROM activity INNER JOIN users ON activity.users_id = users.id ";
      $q .= " LEFT JOIN labels ON activity.type = 1 AND labels.id = activity.labels_id";
      $q .= " LEFT JOIN lists ON activity.type = 2 AND lists.id = activity.lists_id";
      $q .= " ORDER BY activity.id DESC LIMIT 10";

      $query = $this->db->query($q);

    //  error_log($this->db->last_query());
      return $query->result();

    }

    function userFavoriteLabel($userId, $labelId)
    {


      $query = $this->db->get_where('activity', array('type' => 1, 'users_id' => $userId, 'labels_id' => $labelId ))->row();

      if (isset($query->id))
      {
    //  $artistID = $query->id;
    //    error_log('already favorite');
      }
      else
      { 

      //error_log($userId);
      //error_log($labelId);

        $mysqldate = date( 'Y-m-d H:i:s' );

      //error_log($mysqldate);

        $data = array(
         'type'=> 1,
         'users_id' => $userId,
         'labels_id' => $labelId,
         'date' => $mysqldate
         );

        $this->db->insert('activity',$data);

      }

    }

    function releaseAddList($userId, $releaseId, $listId)
    {
    //error_log("uId:".$userId);
    //error_log("lId:".$listId);
    //error_log("rId:".$releaseId);

      $query = $this->db->get_where('activity', array('type' => 2, 'users_id' => $userId, 'release_id' => $releaseId, 'lists_id' => $listId ))->row();

      if (isset($query->id))
      {

      //  error_log('already in activity');
      }
      else
      { 

        $mysqldate = date( 'Y-m-d H:i:s' );

      //error_log($mysqldate);

        $data = array(
         'type'=> 2,
         'users_id' => $userId,
         'lists_id' => $listId,
         'release_id' => $releaseId,
         'date' => $mysqldate
         );

        $this->db->insert('activity',$data);

      //  error_log('added activity');


      }


    }

  }

  ?>