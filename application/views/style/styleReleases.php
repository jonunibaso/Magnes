
<!-- main container -->
<div class="content">

    <div class="container-fluid">

        <div id="pad-wrapper" style="margin-top: 0px;">
          
            <div class="table-products" style="margin-top: 60px;">
                <div class="row-fluid head">
                    <div class="span12">
                        <i class="icon-music icon-4x pull-left icon-muted" style="margin-right: 10px;" ></i><h4 style="font-size: 20px;">Style: <br>  <b style="margin-left: 0px;"><? echo $release[0]->style; ?></b></h4>
                    </div>
                    <div class="span8" style="margin-top: 20px;">
                            <div class='shareaholic-canvas' data-app='share_buttons' data-app-id='5103648'></div>

                    </div>


                
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
                                <th class="span1">
                                    <span class="line"></span>Style
                                </th>
                                <th class="span1">
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
                                    <a href="<? echo base_url('artist/view/'.$row->artist_slug);?>" class="link"  style="color: #005580;" data-original-title="Search <? echo $row->artist_name; ?> Releases" ><? echo $row->artist_name; ?></a>
                                </td>
                                <td class="description">
                                  <a href="<? echo base_url('release/download/'.$row->slug);?>"><? echo $row->title; ?></a>
                              </td>
                              <td>
                                <a href="<? echo base_url('label/view/'.$row->label_slug);?>" class="link" style="color: #005580;" data-original-title="Search more <? echo $row->label_name; ?> Releases" itemprop="publisher">
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
                                   <? 

                             $varS = "";
                              $this->load->database();
                              $this->db->select('*');
                              $this->db->from('release_music_style');
                              $this->db->join('music_styles', 'release_music_style.music_style_id = music_styles.id');
                              $this->db->where('release_music_style.release_id', $row->release_id);
                              $query = $this->db->get();
                              $styles = $query->result();

                              foreach ($styles as $s) {
                                     echo $s->style." ";
                              }

                                 ?>
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
   
            </div>

        </div>
