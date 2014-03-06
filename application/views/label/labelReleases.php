
<!-- main container -->
<div class="content">

    <div class="container-fluid">

        <div id="pad-wrapper" style="margin-top: 0px;">
            <?
            echo "<input type='hidden' name='label_slug' id='label_slug' value='".$release[0]->label_slug."' />";
            ?>
            <div class="table-products" style="margin-top: 60px;">
                <div class="row-fluid head">
                    <div class="span12">
                        <i class="icon-archive icon-4x pull-left icon-muted" style="margin-right: 5px;" ></i><h4 style="font-size: 20px;">Label: <br>  <b style="margin-left: 0px;"><? echo $release[0]->label_name; ?></b></h4>
                    </div>
                    <div class="span8" style="margin-top: 20px;">
                            <div class='shareaholic-canvas' data-app='share_buttons' data-app-id='5103648'></div>
                    </div>

                    <? if ($this->ion_auth->logged_in()) { ?>
                    <div class="span6 pull-left" style="font-size: 16px;">
                        <?
                        $s = "";
                        $user2 = $this->ion_auth->user()->row();
                        $userID = $user2->id;  
                        $query = $this->db->get_where('users_labels', array('labels_id' =>$release[0]->label_id, 'users_id' =>$userID))->row();
                        if (isset($query->id))
                        {
                            $s = "active";
                        }
                        ?>
                        <a class="btn-glow <? echo $s; ?>" id="toggleFavLabelBtn"><i class="icon-star" style="margin-right: 5px;"></i>
                            <? if ($s!=""){
                                echo "Favorite";

                            }else{
                                echo "Add Favorites";
                            }?>
                        </a>
                        <? if($this->ion_auth->is_admin()){
                            echo "<a class='btn-glow' href='". base_url('edit/label/'.$release[0]->label_slug)."' style='margin-left: 10px;¡><i class=¡icon-edit'></i>Edit ".$release[0]->label_slug." (".$release[0]->label_id.")</a>";
                            echo '<span class="badge badge-success" style="margin-left: 20px;">Views: '.$release[0]->num_views.'</span>';

                        }?>
                    </div>
                    <? } ?>
                </div>
                <br>
                <div class="row-fluid">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span3">
                                    Cover
                                </th>
                                <th class="span3">
                                    Artist
                                </th>
                                <th class="span3">
                                    <span class="line"></span>Release
                                </th>

                                <th class="span3">
                                    <span class="line"></span>Genre
                                </th>
                                <th class="span3">
                                    <span class="line"></span>Year
                                </th>
                                <th class="span3">
                                    <span class="line"></span>Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?  
                            foreach ($release as $release[0])
                            { 
                                ?>
                                <!-- row -->
                                <tr itemscope itemtype="http://schema.org/MusicAlbum">
                                    <td>
                                        <div class="img">
                                         <? if ($release[0]->img_url==""){
                                            ?>
                                            <img src="<? echo base_url('img/nocover_small.jpg'); ?>" data-src="<? echo base_url('img/nocover_small.jpg'); ?>" alt="<? echo $release[0]->artist_name." - ".$release[0]->title; ?>"/>
                                            <?
                                        }else{
                                            ?>
                                            <img itemprop="thumbnailUrl" class="lazy" src="<? echo $release[0]->img_url; ?>" data-src="<? echo $release[0]->img_url; ?>" alt="<? echo $release[0]->artist_name." - ".$release[0]->title; ?>"/>
                                            <noscript>
                                                <img itemprop="thumbnailUrl" src="<? echo $release[0]->img_url; ?>" alt="<? echo $release[0]->artist_name." - ".$release[0]->title; ?>"/>
                                            </noscript>
                                            <?
                                        }
                                        ?>
                                    </div>  
                                </td>
                                <td>

                                    <a href="<? echo base_url('artist/view/'.$release[0]->artist_slug);?>" class="link" data-original-title="Search <? echo $release[0]->artist_name; ?> Releases" itemprop="byArtist"><? echo $release[0]->artist_name; ?></a>
                                </td>
                                <td >
                                  <a href="<? echo base_url('release/download/'.$release[0]->slug);?>" itemprop="name"><? echo $release[0]->title; ?></a>
                              </td>
                              <td itemprop="genre">
                                 <? echo $release[0]->genre; ?>
                             </td>
                             <td itemprop="datePublished">
                                 <? echo $release[0]->date; ?>
                             </td>
                             <td>
                                <span class="label label-success">Active</span>
                                <ul class="actions">
                                    <li style="border:none;">
                                      <a class="btn-flat default" href="<? echo base_url('release/download/'.$release[0]->slug);?>" style="margin-top: -10px; font-size: 12px;">Download</a>
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
            <a class="btn-glow" style="font-size: 16px;" href="<? echo base_url('front/page/'.$previous);?>"> <i class="icon-chevron-left" style="font-size:12px;"></i> Previous </a>
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
  <hr/>
            <div class="row-fluid head"  style="margin-top: 60px;">

                <div class="span6">
                        <h3 id="player_title"><?echo $release[0]->label_name;?> SoundCloud Sounds</h3>
                        <audio id="player"></audio>
                        <div style="text-align:center; display: none;">
                            <form id="sc_search"  action="javascript:void(0);">
                                <input id="q" name="q" value="<?echo $release[0]->label_name;?>">
                                <input type="hidden" name="client_id" value="0bcc7c4bcd2b5b55b23ab538c02f70c0">
                                <input type="hidden" name="order" value="hotness">
                            </form>
                        </div>
                        <div class="row-fluid" style="margin-top: 30px;">
                            <div class="span12" id="sounds"></div>
                        </div>
                </div>


                <div class="span6">
                    <h3><?echo $release[0]->label_name;?> Youtubes</h3>
                     <div class="row-fluid" style="margin-top: 30px;">
                        <div class="span12" id="youtubes"></div>
                    </div>
               </div>
            </div>


            <hr/>
</div>
