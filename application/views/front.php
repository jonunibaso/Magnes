<!-- main container -->
<div class="content">

    <div class="container-fluid">

        <div id="main-stats">
            <div class="row-fluid stats-row">
                <div class="span3 stat">
                    <div class="data">
                        <span class="number"><? echo $total_releases; ?></span>
                        Releases
                    </div>
                </div>
                <div class="span3 stat">
                    <div class="data">
                        <span class="number"><? echo $total_artists; ?></span>
                        Artists
                    </div>
                </div>
                <div class="span3 stat">
                    <div class="data">
                        <span class="number"><? echo $total_links; ?></span>
                        Links
                    </div>
                </div>
                <div class="span3 stat last">
                    <div class="data">
                        <span class="number"><? echo $total_disco; ?></span>
                        Labels
                    </div>
                </div>
            </div>
        </div>

        <? if(!isset($previous)){ ?>
            <div class="row-fluid head" style="margin-top: 50px;">
                <div class="span12">
                    <h2>Hot Releases<a href="<? echo base_url('front/hotReleases'); ?>"><span style="font-size: 18px; margin-left: 10px; color: #005580;"><i class="icon-eye-open" style="margin-right: 6px;"></i>View All</span></a></h2>
                </div>
            </div>

        <div class="row-fluid section" style="margin-top: 10px;">
            <?  foreach ($hot_release as $row)
            { 
                ?>
                <div class="span2 hot_release" itemscope itemtype="http://schema.org/MusicAlbum">
                    <div class="thumbnail">
                        <img itemprop="thumbnailUrl" class="lazy" src="<? echo $row->img_url; ?>" data-src="<? echo $row->img_url; ?>" alt="<? echo $row->artist_name." - ".$row->title; ?>" width="260" height="260"/>
                        <noscript>
                            <img itemprop="thumbnailUrl" src="<? echo $row->img_url; ?>" alt="<? echo $row->artist_name." - ".$row->title; ?>"/>
                        </noscript>
                    </div>
                    <div class="caption" style="width:80%; margin: auto auto">
                        <h3 itemprop="byArtist"><? echo $row->artist_name; ?></h3>
                        <h4 itemprop="name"><? echo $row->title; ?></h4>
                        <h5>
                        <? if($row->label_slug!=""){ ?>
                        <a href="<? echo base_url('label/view/'.$row->label_slug);?>" class="link" style="color: #005580;" data-original-title="Search more <? echo $row->label_name; ?> Releases" itemprop="publisher">
                        <? echo $row->label_name." <br> "; ?>
                        </a>
                        <? } ?>
                        <? echo $row->genre; ?></h5>
                        <div style="margin-top:30px;">
                            <a itemprop="url" class="btn-flat default" href="<? echo base_url('release/download/'.$row->slug);?>" style="margin-top: -10px; font-size: 12px;">Download</a>
                        </div>
                    </div>

                </div>
                <?
            }
            ?>

        </div>

        <div class="row-fluid">
            <div class="span5">
                <div class="well" style="padding: 8px 0; margin-top: 40px;">
                    <ul class="nav nav-list">
                        <li class="nav-header">Top Downloads</li>
                        <?  
                        foreach ($top_downloads as $row)
                        { 
                            ?>
                            <li><a href="<? echo base_url('release/download/'.$row->slug);?>"><? echo "<span style='font-size:14px; color:#005580;'>".$row->artist_name." - ".$row->title."</span> / ".$row->date."  ".$row->label_name; ?></a></li>
                            <?
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="span7">
               <div class="row-fluid">
                <div class="span12">

                    <div class="well" style="padding: 8px 0; margin-top: 40px;">
                        <ul class="nav nav-list activity-nav">
                            <li class="nav-header">Users Activity</li>
                            <?  
                            foreach ($last_activity as $row)
                            { 
                                switch ($row->type) {
                                    case 1:
                                    ?>
                                    <li><i class="icon-heart"></i><a style="font-size:16px; color:#005580; display: inline;" href="<? echo base_url('users/v/'.$row->username); ?>"> <? echo ucwords($row->username); ?> </a> favorited a label: <a style="font-size:16px; color:#005580; display: inline;" href="<? echo base_url('label/view/'.$row->label_slug);?>"><? echo $row->label_name; ?></a></li> 
                                    <?                                
                                    break;

                                    case 2:
                                    $this->load->model('release_model');
                                    $r1 = $this->release_model->get_by_id($row->release_id);
                                    ?>
                                    <li><i class="icon-list"></i><a href="<? echo base_url('users/v/'.$row->username); ?>"> <? echo ucwords($row->username); ?> </a> inserted  <a href="<? echo base_url('release/download/'.$r1->slug);?>"><? echo $r1->artist_name." - ".$r1->title; ?></a>  into a list: <a href="<? echo base_url('lists/view/'.$row->slug); ?>" ><? echo $row->list_name; ?></a></li> 
                                    <?                                
                                    break;

                                    default:
                                    # code...
                                    break;
                                }

                            }
                            ?>
                        </ul>
                    </div>
                </div>

                
                  <div class="span12" style=" margin-left: 0px; text-align:center;">
                <div class="hero-unit well" style="padding: 20px; font-size: 16px; line-height: 20px;">
                    <p>The Magnes is an <b>Open Source CMS</b> for building music communities.</p>
                    <p>Users can post, share and discover releases making it bigger.</p>
                    <p>We are in an early beta, but you can sign in now!</p>
                    <br/>
                        <a href="http://www.themagnes.com/auth/register" class="btn btn-success btn-medium">
                            Sign in
                        </a>
                        <a href="https://github.com/marblecode/Magnes" class="btn btn-primary btn-medium">
                            Check at GitHub
                        </a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <?}
    ?>

    <div id="pad-wrapper" style="margin-top: 0px;">
        <div class="table-products section" style="margin-top: 0px; border: none; box-shadow: none;">
            <div class="row-fluid head">
                <div class="span12">
                    <h2>Last Releases<? if(isset($next)){
                        if($next>2){
                           echo "<span style='color:grey; font-weight:100; margin-left: 10px;'>  /   Page ".($next-1)."</span>";
                       }}else{
                           echo "<span style='color:grey'>  // Last Page</span>";

                       }?></h2>
                   </div>
                        <!--
                        <div class="span12" style="font-size: 16px;">
                                All / Electronic / Rock
                        </div>
                    -->
                </div>

                <br>
                <div class="row-fluid">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span1">
                                    Cover
                                </th>
                                <th class="span2">
                                    Artist
                                </th>
                                <th class="span3">
                                    Release Title
                                </th>
                                <th class="span1">
                                    Genre
                                </th>
                                <th class="span2">
                                    Label
                                </th>
                                <th class="span1">
                                    Year
                                </th>
                                <th class="span2">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?  
                            foreach ($release as $row)
                            { 
                                ?>
                                <!-- row -->
                                <tr itemscope itemtype="http://schema.org/MusicAlbum">
                                    <td>
                                        <div class="img">
                                            <? if ($row->img_url==""){
                                                ?>
                                                <img src="<? echo base_url('img/nocover_small.jpg'); ?>" data-src="<? echo base_url('img/nocover_small.jpg'); ?>" alt="<? echo $row->artist_name." - ".$row->title; ?>" width="60" height="60"/>
                                                <?
                                            }else{
                                                ?>
                                                <img itemprop="thumbnailUrl" class="lazy" src="<? echo $row->img_url; ?>" data-src="<? echo $row->img_url; ?>" alt="<? echo $row->artist_name." - ".$row->title; ?>"  width="60" height="60"/>
                                                <noscript>
                                                    <img itemprop="thumbnailUrl" src="<? echo $row->img_url; ?>" alt="<? echo $row->artist_name." - ".$row->title; ?>"/>
                                                </noscript>
                                                <?
                                            }
                                            ?>
                                        </div>  
                                    </td>
                                    <td>
                                        <a href="<? echo base_url('artist/view/'.$row->artist_slug);?>" class="link" data-original-title="Search <? echo $row->artist_name; ?> Releases" itemprop="byArtist"><? echo $row->artist_name; ?></a>
                                    </td>
                                    <td>
                                        <a href="<? echo base_url('release/download/'.$row->slug);?>" itemprop="name"><? echo $row->title; ?></a>
                                    </td>
                                    <td itemprop="genre">
                                       <? echo $row->genre; ?>
                                   </td>
                                   <td>
                                    <a href="<? echo base_url('label/view/'.$row->label_slug);?>" class="link" data-original-title="Search more <? echo $row->label_name; ?> Releases" itemprop="publisher">
                                        <? echo $row->label_name; ?>
                                    </a>
                                </td>
                                <td itemprop="datePublished">
                                   <? echo $row->date; ?>
                               </td>
                               <td>
                                <span class="label label-success">Active</span>
                                <ul class="actions">
                                    <li style="border:none;">
                                        <a itemprop="url" class="btn-flat default" href="<? echo base_url('release/download/'.$row->slug);?>" style="margin-top: -10px; font-size: 12px;" >Download</a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <? 
                    }
                    ?>

                </tbody>
            </table>
        </div>

        <div class="pagintaion" style="width: 170px; margin: auto auto;">
            <? if (isset($previous)){
                ?>
                <a class="btn-glow" style="font-size: 16px;" href="<? if($previous==1){ echo base_url(); }else{ echo base_url('front/page/'.$previous); }?>"> <i class="icon-chevron-left" style="font-size:12px;"></i> Previous </a>
                <?
            }
            if (isset($next)){
                ?>
                <a class="btn-glow" style="font-size: 16px; margin-left: 10px;" href="<? echo base_url('front/page/'.$next);?>"> Next <i class="icon-chevron-right" style="font-size:12px;"></i> </a>
                <?
            }
            ?>   
        </div>

    </div>
    <!-- end table  -->

</div>
</div>
</div>
