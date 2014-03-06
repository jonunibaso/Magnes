
<!-- main container -->
<div class="content">

    <div class="container-fluid">

        <div id="pad-wrapper" style="margin-top: 0px;">
            <?
            echo "<input type='hidden' name='label_slug' id='label_slug' value='".$release[0]->artist_slug."' />";
            ?>
            <div class="table-products" style="margin-top: 60px;">
                <div class="row-fluid head">
                    <div class="span12">
                        <i class="icon-music icon-4x pull-left icon-muted" style="margin-right: 10px;" ></i><h4 style="font-size: 20px;">Artist: <br>  <b style="margin-left: 0px;"><? echo $release[0]->artist_name; ?></b></h4>
                    </div>
                    <div class="span8" style="margin-top: 20px;">
                            <div class='shareaholic-canvas' data-app='share_buttons' data-app-id='5103648'></div>

                    </div>


                    <? if($this->ion_auth->is_admin()){
                        ?>
                        <div class="span6 pull-left" style="font-size: 16px;">
                            <?
                            echo "<a class='btn-glow' href='". base_url('edit/label/'.$release[0]->artist_slug)."' style='margin-left: 10px;¡><i class=¡icon-edit'></i>Edit (".$release[0]->artist_slug.")</a>";
                            echo '<span class="badge badge-success" style="margin-left: 20px;">Views: '.$release[0]->num_views.'</span>';

                            ?>
                        </div>
                        <?
                    }
                    ?>
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
                                    <span class="line"></span>Release Title
                                </th>
                                <th class="span2">
                                    Label
                                </th>
                                <th class="span1">
                                    <span class="line"></span>Genre
                                </th>
                                <th class="span1">
                                    <span class="line"></span>Year
                                </th>
                                <th class="span2">
                                    <span class="line"></span>Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?  
                            foreach ($release as $row)
                            { 
                                ?>

                                <!-- row -->
                                <tr class="first">
                                    <td>
                                        <div class="img">
                                           <? if ($row->img_url==""){
                                            ?>
                                            <img src="<? echo base_url('img/nocover_small.jpg'); ?>" data-src="<? echo base_url('img/nocover_small.jpg'); ?>" alt="<? echo $row->artist_name." - ".$row->title; ?>"/>
                                            <?
                                        }else{
                                            ?>
                                            <img itemprop="thumbnailUrl" class="lazy" src="<? echo $row->img_url; ?>" data-src="<? echo $row->img_url; ?>" alt="<? echo $row->artist_name." - ".$row->title; ?>"/>
                                            <noscript>
                                                <img itemprop="thumbnailUrl" src="<? echo $row->img_url; ?>" alt="<? echo $row->artist_name." - ".$row->title; ?>"/>
                                            </noscript>
                                            <?
                                        }
                                        ?>
                                    </div>  
                                </td>
                                <td>
                                    <a href="<? echo base_url('artist/view/'.$row->artist_slug);?>" class="link" data-original-title="Search <? echo $row->artist_name; ?> Releases" ><? echo $row->artist_name; ?></a>
                                </td>
                                <td class="description">
                                  <a href="<? echo base_url('release/download/'.$row->slug);?>"><? echo $row->title; ?></a>
                              </td>
                              <td>
                                <a href="<? echo base_url('label/view/'.$row->label_slug);?>" class="link" data-original-title="Search more <? echo $row->label_name; ?> Releases" itemprop="publisher">
                                    <? echo $row->label_name; ?>
                                </a>
                            </td>
                            <td class="description">
                               <? echo $row->genre; ?>
                           </td>
                           <td class="description">
                               <? echo $row->date; ?>
                           </td>
                           <td>
                            <span class="label label-success">Active</span>
                            <ul class="actions">
                                <li style="border:none;">
                                  <a class="btn-flat default" href="<? echo base_url('release/download/'.$row->slug);?>" style="margin-top: -10px; font-size: 12px;">Download</a>
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



<div class="pagination">
  <ul>

    <?
    echo $links;
    ?>
</ul>
</div>
   <hr/>
            <div class="row-fluid head"  style="margin-top: 60px;">

                <div class="span6">
                        <h3 id="player_title"><?echo $release[0]->artist_name;?> SoundCloud Sounds</h3>
                        <audio id="player"></audio>
                        <div style="text-align:center; display: none;">
                            <form id="sc_search"  action="javascript:void(0);">
                                <input id="q" name="q" value="<?echo $release[0]->artist_name;?>">
                                <input type="hidden" name="client_id" value="0bcc7c4bcd2b5b55b23ab538c02f70c0">
                                <input type="hidden" name="order" value="hotness">
                            </form>
                        </div>
                        <div class="row-fluid" style="margin-top: 30px;">
                            <div class="span12" id="sounds"></div>
                        </div>
                </div>


                <div class="span6">
                    <h3><?echo $release[0]->artist_name;?> Youtubes</h3>
                     <div class="row-fluid" style="margin-top: 30px;">
                        <div class="span12" id="youtubes"></div>
                    </div>
               </div>
            </div>


            <hr/>
            </div>

        </div>
