<?
class Release_model extends CI_Model {

  function __construct()
  {
    parent::__construct();
  }

  function entry_insert()
  {
    $this->load->database();
    $serverList = array("180upload","1fichier","2shared","4shared","allmyvideos.net","amonshare","arabsh","asfile","bayfiles","bitshare","box","boxca","cramit.in","crocko","ctdisk","czshare","datafilehost","demo.ovh.net","depositfiles","divxstage.eu","dl.free.fr","dosya.tc","dropbox","easybytez","esnips","extabit","fastupload.rol.ro","file.damasgate","fileband","filebox","filefactory","fileflyer","fileice.net","filejungle","filemates","filenuke","filepost","files.mail.ru","files.namba.kz","fileserve","filesflash","filesin","filesmonster","filesonic","fileswap","freakshare","fshare.vn","ge.tt","gigabase","gigapeta","gigasize","glumbouploads","good.gd","grooveshark","hidemyass","hipfile","hitfile.net","host.hackerbox.org","hostingbulk","hotfile","howfile","hulkshare","idup.in","imagearn","indowebster","ishare.iask.sina.com.cn","issuu","jandown","jumbofiles","kiwi6","kuai.xunlei","letitbit.net","luckyshare.net","mediafire","megashare.vnn.vn","megashares","minus","mixturecloud","movreel","movshare.net","movzap","muchshare.net","net366.cba.pl","netload.in","novamov","pdfcast.org","pornhost","putlocker","queenshare","rapidgator","redpost.mts.ru","rghost.net","saponeclick.de.vu","scribd.com","sendmyway","sendspace","share-online.biz","Hoster","sharebeast","sharecash.org","shareflare.net","sharerepo","slideshare.net","slingfile","sockshare","soundcloud","speedyshare","stagevu","stooorage","sugarsync","transferbigfiles","trilulilu.ro","tusfiles.net","twitvid","u.115","uloz.to","unibytes","up.4share.vn","up.eqla3","upanh","upload.ugm.ac.id","uploadbaz","uploadc","uploading","uploadstation","uplod.ir","uppit","uptobox","veevr","vidbull","vidbux","videarn","videoalbumy.azet.sk","videobam","videobb","vidxden","vimeo","vip-file","wetransfer","wupload","xvidstage","yourfilehost","yousendit","zalaa","zalil.ru","ziddu","zippyshare","novafile","uploaded","rapidshare","turbobit","cloudzer");

    if($this->input->post('bot'))
    {
      $bot = true;
    }else{
      $bot = false;
    }

    /*******  Search for the artist ********/

    $query = $this->db->get_where('artist', array('artist_name' => $this->input->post('artist')))->row();

    if (isset($query->id))
    {
      $artistID = $query->id;
      //error_log($artistID);
    }
    else
    { 

      $aslug = url_title( $this->input->post('artist'), 'dash', true);

      while ($this->db->get_where('artist', array('artist_slug' => $aslug))->num_rows()){
        $rand = rand(0, 9);
        $aslug .= '-'.$rand; 

      }

      $artistData = array(
       'artist_name'=>$this->input->post('artist'),
       'artist_slug' => $aslug
       );

      //error_log($this->input->post('artist'));

      $this->db->insert('artist',$artistData);
      $artistID  =  $this->db->insert_id();
    }

    if($bot){
     echo "artistID:(".$artistID.")";
    } 

    /*******  Search for the release ********/


   $this->load->database();
   $this->db->select('release.id');
   $this->db->from('release');
   $this->db->where('release.artist_id', $artistID);
   $this->db->like('release.title', $this->input->post('title'), 'both');
   $query = $this->db->get();
   $queryF = $query->row();

   if (isset($queryF->id))
   {

      if($bot){
       echo "Release FOUND:(".$queryF->id.")\n\n";
      } 

    }else{

    /*******  Search for the label ********/
  
    if(trim($this->input->post('discography'))!=""){

      $query2 = $this->db->get_where('labels', array('label_name' => $this->input->post('discography')))->row();

      if (isset($query2->id))
      {
        $discographyID = $query2->id;
        //error_log($discographyID);
      }
      else
      {

        $ls =  url_title( $this->input->post('discography'), 'dash', true);

        while ($this->db->get_where('labels', array('label_slug' => $ls))->num_rows())
        {
          $rand = rand(0, 9);
          $ls .= '-'.$rand; 
        }

        $discoData = array(
         'label_name'=>$this->input->post('discography'),
         'label_slug' => $ls
         );
        
        //error_log($this->input->post('discography'));

        $this->db->insert('labels',$discoData);
        $discographyID  =  $this->db->insert_id();
      }

    }else{

    $discographyID = 0;

    }

    if($bot){
      echo "discographyID:(".$discographyID.")";
    }

    /*******  Create release slug  ********/


  $title_slug = $this->input->post('artist').'-'.$this->input->post('title');
  $slug = url_title( $title_slug, 'dash', true);
  //error_log("1: ".$slug);

  while ($this->db->get_where('release', array('slug' => $slug))->num_rows())
  {
    $rand = rand(0, 9);
    $slug .= '-'.$rand; 
    //error_log(" - ".$slug);
  }

    //error_log(date('d-m-Y', strtotime($this->input->post('date'))));

  if($this->input->post('extra_info'))
  {
    $extra = $this->input->post('extra_info');
  }else{
    $extra = "";
  }

  $mysqldate = date( 'Y-m-d H:i:s' );

  $tracklist = strip_tags($this->input->post('tracklist'));

  $data = array(
   'artist_id'=> $artistID,
   'title'=>$this->input->post('title'),
   'music_genres_id'=>$this->input->post('genre'),
   'tracklist'=> $tracklist,
   'date'=>  $this->input->post('date'),
   'labels_id'=> $discographyID,
   'countries_id'=> $this->input->post('country'),
   'extra_info'=>$extra,
   'img_url'=>$this->input->post('validated_img_url'),
   'slug' => $slug,
   'insertedDate' => $mysqldate
   );

  $this->db->insert('release',$data);
  $release_id =  $this->db->insert_id();

  if($bot){
    echo "releaseID:(".$release_id.")";
  }

  /*******  Insert Links  ********/


  $link_num = 0;
  $c_link = 'link_'.$link_num;
  $c_qual = 'qual_'.$link_num;
  $c_serv = 'serv_'.$link_num;

  while($this->input->post($c_link))
  {

    $cs = $this->input->post($c_serv);
    $qu = $this->input->post($c_qual);

    if($bot){
      foreach ($serverList as $s) {
          if (strpos($this->input->post($c_link),$s) !== false){
            //echo "found: ".$s."<br>";
            $cs = $s;
            }
        }
        $qy = "320kbps";
    }

    $data = array(
      'release_id'=> $release_id,
      'quality'=> $qu,
      'server'=>  $cs,
      'inactive'=> 0,
      'supporter_ip'=> "-"
      );

    $this->db->insert('link_group',$data);
    $group_id =  $this->db->insert_id();

    $data2 = array(
     'url'=> $this->input->post($c_link),
     'link_group_id'=> $group_id
     );

    $this->db->insert('link',$data2);
    $link_num++;
    $c_link = 'link_'.$link_num;
    $c_qual = 'qual_'.$link_num;
    $c_serv = 'serv_'.$link_num;

  }
}

}


function add_link()
{
  $this->load->database();
  $data = array(
   'release_id'=> $this->input->post('releaseID'),
   'quality'=> $this->input->post('quality'),
   'server'=> $this->input->post('server'),
   'inactive'=> 0,
   'supporter_ip'=> "-"
   );

  $this->db->insert('link_group',$data);
  $group_id =  $this->db->insert_id();

  $data2 = array(
   'url'=> $this->input->post('link'),
   'link_group_id'=> $group_id
   );

  $this->db->insert('link',$data2);

}

function get_last_ten_entries($offset)
{
  $this->load->database();
  $this->db->select('*, release.id as release_id');
  $this->db->from('release');
  $this->db->join('artist', 'artist.id = release.artist_id');
  $this->db->join('music_genres', 'release.music_genres_id = music_genres.id');
  $this->db->join('labels', 'release.labels_id = labels.id','left');
  $this->db->limit(10);
  $this->db->offset($offset);
  $this->db->order_by("release.id", "desc");
  $query = $this->db->get();
  return $query->result();
}

function get_last_entries($num, $offset)
{
  $this->load->database();
  $this->db->select('*, release.id as release_id');
  $this->db->from('release');
  $this->db->join('artist', 'artist.id = release.artist_id');
  $this->db->join('music_genres', 'release.music_genres_id = music_genres.id');
  $this->db->join('labels', 'release.labels_id = labels.id','left');
  $this->db->limit($num);
  $this->db->offset($offset);
  $this->db->order_by("release.id", "desc");
  $query = $this->db->get();
  return $query->result();
}

function get_top_downloads($offset)
{
  $this->load->database();
  $this->db->select('*, release.id as release_id');
  $this->db->from('release');
  $this->db->join('artist', 'artist.id = release.artist_id');
  $this->db->join('music_genres', 'release.music_genres_id = music_genres.id');
  $this->db->join('labels', 'release.labels_id = labels.id','left');
  $this->db->limit(19);
  $this->db->offset($offset);
  $this->db->order_by("release.views", "desc");
  $query = $this->db->get();
  return $query->result();
}

function get_hot_entries($offset)
{
  $this->load->database();
  $this->db->select('*, release.id as release_id');
  $this->db->from('release');
  $this->db->join('hot_releases', 'release.id = hot_releases.release_id');
  $this->db->join('artist', 'artist.id = release.artist_id');
  $this->db->join('music_genres', 'release.music_genres_id = music_genres.id');
  $this->db->join('labels', 'release.labels_id = labels.id','left');
  $this->db->limit(6);
  $this->db->offset($offset);
  $this->db->order_by("release.id", "RANDOM");
  $query = $this->db->get();
  return $query->result();
}

function get_all_hot_entries($offset)
{
  $this->load->database();
  $this->db->select('*, release.id as release_id');
  $this->db->from('release');
  $this->db->join('hot_releases', 'release.id = hot_releases.release_id');
  $this->db->join('artist', 'artist.id = release.artist_id');
  $this->db->join('music_genres', 'release.music_genres_id = music_genres.id');
  $this->db->join('labels', 'release.labels_id = labels.id','left');
  $this->db->offset($offset);
  $this->db->order_by("release.id", "RANDOM");
  $query = $this->db->get();
  return $query->result();
}

function get_by_id($id)
{
  $this->load->database();
  $this->db->select('*, release.id as release_id');
  $this->db->from('release');
  $this->db->join('artist', 'artist.id = release.artist_id');
  $this->db->join('music_genres', 'release.music_genres_id = music_genres.id');
  $this->db->join('labels', 'release.labels_id = labels.id','left');
  $this->db->where('release.id', $id);
  $query = $this->db->get();
  return $query->row();
}

function get_by_slug($slug)
{

  $this->load->database();

  $this->db->where('release.slug', $slug);
  $this->db->set('views', 'views+1', FALSE);
  $this->db->update('release');

  $this->db->select('*, release.id as release_id');
  $this->db->from('release');
  $this->db->like('release.slug', $slug, 'both');
  $this->db->join('artist', 'artist.id = release.artist_id');
  $this->db->join('music_genres', 'release.music_genres_id = music_genres.id','left');
  $this->db->join('labels', 'release.labels_id = labels.id','left');
  
  $query = $this->db->get();
  return $query->row();
}

function get_related($release)
{

  $this->load->database();
  error_log($release->release_id);

  $this->db->select('*, release.id as release_id');
  $this->db->from('release');
  $this->db->where('release.artist_id', $release->artist_id);
  $this->db->where('release.id !=', $release->release_id);
  $this->db->join('artist', 'artist.id = release.artist_id');
  $this->db->join('music_genres', 'release.music_genres_id = music_genres.id','left');
  $this->db->join('labels', 'release.labels_id = labels.id','left');
  
  $query = $this->db->get();
  $r1 =  $query->result();

  if($release->genre){
      $this->db->select('*');
      $this->db->from('music_genres');
      $this->db->like('music_genres.genre', $release->genre, 'both');
      $query = $this->db->get();
      $rId =  $query->row();
      $rId = $rId->id;

      $this->db->select('*, release.id as release_id');
      $this->db->from('release');
      $this->db->where('release.id !=', $release->release_id);
      $this->db->join('artist', 'artist.id = release.artist_id');
      $this->db->where('release.music_genres_id', $rId);
      $this->db->join('music_genres', 'release.music_genres_id = music_genres.id','left');
      $this->db->join('labels', 'release.labels_id = labels.id','left');
      $this->db->limit(25);
      $this->db->order_by('release.id','desc');

      $query = $this->db->get();

          if($query->num_rows() > 0)
           {
               foreach ($query->result() as $row) 
                {
                    $data[] = $row;                    
                }
                srand((float)microtime()*1000000); /* example from suffle function in PHP manual, values can be altered!*/
                shuffle($data);
                return $data;
           }
      $r2 =  $query->result();
      $result =  array_merge($r1,$r2);
  }
  
  return $result;
}


function delete($id)
{
  $this->load->database();
  $this->db->delete('release', array('id' => $id));

  $query = $this->db->query("SELECT * FROM link_group WHERE release_id = ".$id );

  foreach ($query->result_array() as $row)
  {

    $this->db->delete('link', array('link_group_id' => $row['id'] )); 
    $this->db->delete('link_group', array('release_id' => $id));

  }

}

function add_cover_link()
{

 $this->load->database();
 $data = array(
   'img_url'=>$this->input->post('link'),
   );

 $this->db->where('id',$this->input->post('releaseID'));
 $this->db->update('release', $data);
}



function toggleHot($releaseID)
{

  $this->load->database();

  $query = $this->db->get_where('hot_releases', array('release_id' =>$releaseID))->row();

  if (isset($query->id))
  {
    $this->db->delete('hot_releases', array('release_id' => $releaseID));

  }else{

    $data = array(
      'release_id'=> $releaseID
      );
    $this->db->insert('hot_releases',$data);
  }


}

function rate_link($userID)
{

  $this->load->database();

    #error_log("lID:".$this->input->post('linkID') );
    #error_log("uID:".$userID);
  $query = $this->db->get_where('users_link_group', array('link_group_id' => $this->input->post('linkID'), 'users_id' => $userID ))->row();

  if (isset($query->id))
  {
    return false;
  }
  else
  {

    $data = array(
     'link_group_id'=> $this->input->post('linkID'),
     'users_id'=> $userID,
     'type'=> $this->input->post('rate')
     );

    $this->db->insert('users_link_group',$data);

    $this->db->select('*');
    $this->db->from('link_group');
    $this->db->where('id', $this->input->post('linkID'));
    $query = $this->db->get();
    $result = $query->row();

    $inactive = $result->inactive;
    $karma = $result->karma;

    switch ($this->input->post('rate')) {

      case '1':
      $karma = $karma + 10;
      break;

      case '2':
      $karma = $karma - 10;
      break;

      case '3':
      $karma = $karma - 10;
      $inactive = $inactive + 1;
      break;
      
      default:
      error_log("default");
      break;
    }

    $data = array(
     'karma'=>$karma,
     'inactive'=>$inactive,
     );

    $this->db->where('id',$this->input->post('linkID'));
    $this->db->update('link_group', $data);

    return true;
  }
}

  function search($name, $page = 1)
  {

    $offset = 20*($page-1);


    $this->load->database();
    $this->db->select('*, release.id as release_id');
    $this->db->from('release');
    $this->db->join('artist', 'artist.id = release.artist_id');
    $this->db->join('labels', 'labels.id = release.labels_id' ,'left');
    $this->db->like('release.title', $name, 'both');
    $this->db->join('music_genres', 'release.music_genres_id = music_genres.id');
    $this->db->limit(20,$offset);
    $this->db->order_by("release.title", "asc");
    $query = $this->db->get();
    return $query->result();
  }

/*
function entry_modify()
  {
    $this->load->database();


    $data = array(
     'nombre'=>$this->input->post('nombre'),
     'comercial'=>$this->input->post('comercial'),
     );

    $this->db->where('id',$this->input->post('client_id'));
    $this->db->update('client', $data);

    $client_id = $this->input->post('client_id');

    if($this->input->post('arrayTiendas')){
        foreach ($this->input->post('arrayTiendas') as $value) {

          if ($value) {
            $data = array(
              'nombre'=>$value,
              'client_id'=> $client_id,
              );
            $this->db->insert('shop',$data);
          }      
        }
      }
  }

*/

}

?>