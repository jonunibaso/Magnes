<? 
$CurrentSecc = $this->uri->segment(1, 0);
if($CurrentSecc===0){
    $CurrentSecc = "front";
}
if($CurrentSecc=="front"){
    $PageNum = $this->uri->segment(3, 0);
    if($PageNum===0){
        $PageNum = 1;
    }
}

$CurrentSubSecc = $this->uri->segment(2, 0);


$metaD = "The Magnes is an open sourced community for music sharing, discussing and rating";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><? 
        switch ($CurrentSecc) 
        {
            case 'release':
            $ti = "Download ".$release->artist_name." - ".$release->title." 320kbps";
            
            $metaD = "Download Artist: ".$release->artist_name." TItle: ".$release->title;
            if($release->label_name!=""){
                $metaD .= " Label: ".$release->label_name;
                $ti .= " [".$release->label_name."]";
            }
            if($release->date!=""){
                $metaD .= " Year: ".$release->date;
                $ti .=  " (".$release->date.")";
            }
            $metaD .= " Tracklist: ".$release->tracklist;
            $ti .= " | The Magnes";
            echo $ti;
            break;
            
            case 'front':

            if($CurrentSubSecc==="hotReleases"){
                echo "Hot Releases | The Magnes";
            }else{


                if($PageNum==1){
                    echo "The Magnes | Open Community For Music Sharing";
                    $metaD = "The Magnes | Last Releases: ";
                    foreach ($release as $row)
                    {
                        $metaD .= $row->artist_name." - ".$row->title;
                        if ($row->label_name!=""){
                            $metaD .= " [".$row->label_name."]";
                        }
                        $metaD .= " | ";
                    } 
                }else{
                    echo "Last Releases Page ".$PageNum." | The Magnes";
                    $metaD = "Page ".$PageNum.", Last Releases: ";
                    foreach ($release as $row)
                    {
                        $metaD .= $row->artist_name." - ".$row->title;
                        if ($row->label_name!=""){
                            $metaD .= " [".$row->label_name."]";
                        }
                        $metaD .= " | ";
                    } 
                }
            }
            break;      
            
            case 'send':
            echo "Send Release | The Magnes";
            $metaD = "Send your release and contribute the community";

            break;

            case 'artist':

            if($CurrentSubSecc==="view")
            {
                $ln = "";
                
                if($notFound==True)
                {
                    echo "Artist not found | The Magnes";
                    $metaD = "Artist not found, searching similars.";

                }else{

                    if($release[0]->artist_name){
                        $ln = $release[0]->artist_name;
                    }
                    echo "Download ".$ln." Artist Releases | The Magnes ";
                    $metaD = "Download 320kbps releases from ".$ln." : ";
                    foreach ($release as $row)
                    { 
                        $metaD .= $row->title;
                        if($row->date!=""){
                            $metaD .=  " (".$row->date.")";
                        }
                        if ($row->label_name!=""){
                            $metaD .= " [".$row->label_name."]";
                        }
                        $metaD .= " | ";
                    }
                }
            }else{

                if($CurrentSubSecc==="letter")
                {    
                    $letter = $this->uri->segment(3, 0);
                    if($letter===0){
                        $letter = "a";
                    }
                    echo "Artist list searching ".strtoupper($letter)." | The Magnes ";
                    $metaD = "Search all artists from our databse beginning with ".strtoupper($letter)." ";

                }else{
                    echo "Artist List searching A | The Magnes ";
                    $metaD = "Search all artists from our databse beginning with A ";
                }
            }
            break;

            case 'label':

            if($CurrentSubSecc==="view")
            {
                $ln = "";
                if($notFound==True)
                {
                    echo "Label not found | The Magnes";
                    $metaD = "Label not found, searching similars.";

                }else{

                    if($release[0]->label_name){
                        $ln = $release[0]->label_name;
                    }
                    echo "Download ".$ln." Records Releases | The Magnes ";
                    $metaD = "Download 320kbps releases from ".$ln." records : ";
                    foreach ($release as $row)
                    { 
                        $metaD .= $row->artist_name." - ".$row->title." | ";
                    }
                }
            }else{

                if($CurrentSubSecc==="letter")
                {
                    $letter = $this->uri->segment(3, 0);
                    if($letter===0){
                        $letter = "a";
                    }
                    echo "Label list searching ".strtoupper($letter)." | The Magnes ";
                    $metaD = "Search all labels from our databse beginning with ".strtoupper($letter)." ";

                }else{
                    echo "Label List searching A | The Magnes ";
                    $metaD = "Search all labels from our databse beginning with A ";
                }
            }
            break;

            case 'search':
            echo "Search ".str_replace('-',' ',urldecode($this->uri->segment(3, 0)))." 320kbps Direct Download Links | The Magnes ";
            $metaD = "Search ".str_replace('-',' ',urldecode($this->uri->segment(3, 0)))." 320kbps Direct Download Links";
            break;

            case 'users':

            if($CurrentSubSecc==="v")
            {
                error_log('a');
                echo "View ".$user->username." Profile | The Magnes ";
                $metaD = $user->username." Profile, User Lists: ";
                if($lists){
                    foreach ($lists as $row) {
                         $metaD .= $row->list_name.", ";
                    }            
                }
                break;
            }
                break;


            case 'lists':
            echo $list->list_name." by ".$user_list->username." | The Magnes";
            $metaD = $list->list_name." by ".$user_list->username;
            $metaD .= " Including: ";
            foreach ($list_releases as $row)
            { 
                $metaD .=  $row->artist_name." - ".$row->title." | ";
            }
            break;

            case 'user':
            echo "Edit your profile | The Magnes";
            break; 

            case 'auth':
            echo $this->uri->segment(2, 0)." | The Magnes";
            $metaD = $this->uri->segment(2, 0)." | The Magnes";
            break;

            case 'edit':
            echo "Admin Edit ".$this->uri->segment(2, 0)." | The Magnes";

            default:
                # code...
            break;
        }
        ?></title>
        <meta name="author" content="The Magnes">
        <meta name="description" content="<? echo $metaD; ?>">

        <meta name="keywords" content="free electronic music direct download 320 kbps mediafire mega rapidshare novafile zippishare uploaded turbobit">
        <meta name="robots" content="index, follow">
        <meta name="copyright" content="The Magnes">
        
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" /> 
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta namecd="apple-mobile-web-app-status-bar-style" content="black-translucent" />


        <link href="<? echo base_url('css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<? echo base_url('css/bootstrap-responsive.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<? echo base_url('css/bootstrap-overrides.css'); ?>" rel="stylesheet" type="text/css">

        <link href="<? echo base_url('css/style.css'); ?>" rel="stylesheet" type="text/css">

        <!-- libraries -->
        <link href="<? echo base_url('css/lib/jquery-ui-1.10.2.custom.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<? echo base_url('css/lib/font-awesome.css'); ?>" rel="stylesheet"  type="text/css"  />
        <link rel="styesheet" href="<? echo base_url('css/lib/jquery.pnotify.default.css'); ?>" type="text/css" media="screen" > 


        <?
        if ($CurrentSecc=="send"){
            ?>
            <!-- libraries -->
            <link href="<? echo base_url('css/lib/bootstrap-wysihtml5.css'); ?>" type="text/css" rel="stylesheet">
            <link href="<? echo base_url('css/lib/uniform.default.css'); ?>" type="text/css" rel="stylesheet">
            <link href="<? echo base_url('css/lib/select2.css'); ?>" type="text/css" rel="stylesheet">
            <link href="<? echo base_url('css/lib/bootstrap.datepicker.css'); ?>" type="text/css" rel="stylesheet">
            <link rel="stylesheet" href="<? echo base_url('css/compiled/form-wizard.css'); ?>" type="text/css" media="screen" />
            <?
        }
        ?>
        <link rel="styesheet"  type="text/css" href="<? echo base_url('css/compiled/new-user.css'); ?>" >    

        <!-- global styles -->
        <link rel="stylesheet" type="text/css" href="<? echo base_url('css/layout.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<? echo base_url('css/elements.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<? echo base_url('css/icons.css'); ?>">


        <link href="<? echo base_url('img/favicon.ico'); ?>" rel="shortcut icon">

        <!-- this page specific styles -->
        <?
        switch ($CurrentSecc) {
            case 'front':
            ?>
            <link rel="stylesheet" href="<? echo base_url('css/compiled/index.css'); ?>" type="text/css" media="screen" >    
            <?
            break;

            case 'search':
            ?>
            <link rel="stylesheet" href="<? echo base_url('css/compiled/index.css'); ?>" type="text/css" media="screen" > 
            <?
            break;
            
            case 'release':
            ?>
            <link href="<? echo base_url('css/lib/bootstrap.datepicker.css'); ?>" type="text/css" rel="stylesheet">
            <link rel="stylesheet" href="<? echo base_url('css/compiled/index.css'); ?>" type="text/css" media="screen" > 
            <link rel="styesheet" href="<? echo base_url('css/compiled/form-showcase.css'); ?>" type="text/css" media="screen" > 
            <link rel="stylesheet" href="<? echo base_url('css/soundcloud_search.css'); ?>" type="text/css" media="screen" > 

            <?
            break;

            case 'label':
            ?>
            <link rel="stylesheet" href="<? echo base_url('css/compiled/index.css'); ?>" type="text/css" media="screen" > 
            <link rel="stylesheet" href="<? echo base_url('css/soundcloud_search.css'); ?>" type="text/css" media="screen" > 
           
            <?
            break;

            case 'artist':
            ?>
            <link rel="stylesheet" href="<? echo base_url('css/compiled/index.css'); ?>" type="text/css" media="screen" >
            <link rel="stylesheet" href="<? echo base_url('css/soundcloud_search.css'); ?>" type="text/css" media="screen" > 

            <?
            break;

            case 'user':
            ?>
            <link rel="stylesheet" href="<? echo base_url('css/compiled/user-profile.css'); ?>" type="text/css" media="screen" >
            <?
            break;
            
            case 'users':
            ?>
            <link rel="stylesheet" href="<? echo base_url('css/compiled/user-profile.css'); ?>" type="text/css" media="screen" >
            <?
            break;

            case 'auth':
            ?>
            <link rel="styesheet" href="<? echo base_url('css/compiled/new-user.css'); ?>" type="text/css" media="screen" >    
            <?
            break;
            
            case 'lists':
            ?>
            <link rel="stylesheet" href="<? echo base_url('css/compiled/index.css'); ?>" type="text/css" media="screen" >    
            <?
            break;


            default:
                # code...
            break;
        }
        ?>

        <!-- open sans font -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

        <!-- lato font -->
        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->


      <script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-41878244-1', 'themagnes.com');
  ga('send', 'pageview');

</script>

  </head>
  <body>
