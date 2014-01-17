
<!-- main container -->
<div class="content">
    <?
    echo "<input type='hidden' name='release_id' id='release_id' value='".$release->release_id."' />";
    ?>
    <div class="container-fluid">
        <div id="pad-wrapper" class="form-page">
            <div class="row-fluid form-wrapper">
                <!-- left column -->
                <div class="span7 column">
                    <form itemscope itemtype="http://schema.org/MusicAlbum">
                        <meta content="<? echo base_url('release/download/'.$release->slug); ?>" itemprop="url" />
                        <div class="field-box">
                            <div class="release_info">Artist:</div>
                            <div class="span8 release_data">
                                <a href="<? echo base_url('artist/view/'.$release->artist_slug);?>" class="link" data-original-title="Search <? echo $release->artist_name; ?> Releases" itemprop="byArtist"><? echo $release->artist_name; ?></a>
                            </div>
                        </div>
                        <div class="field-box">
                            <div class="release_info">Release:</div>
                            <? if ($this->ion_auth->is_admin()){ ?>
                            <input type="text" value="<? echo $release->title; ?>" style="width: 450px; margin-left: 20px;"/>
                            <? }else{?>
                            <div class="span8 release_data" itemprop="name"><? echo $release->title; ?></div>
                            <?}?>
                        </div>

                        <div class="field-box">
                            <label>Cover:</label>
                                <? if ($release->img_url==""){ ?>
                                    <div style="border: 1px solid #ddd; width: 220px; height: 220px; overflow: hidden;">
                                    <img src="<? echo base_url('img/nocover_medium.jpg'); ?>" data-src="<? echo base_url('img/nocover_medium.jpg'); ?>" alt="<? echo $release->artist_name." - ".$release->title; ?>"/>
                                <? }else{ ?>
                                    <div style="border: 1px solid #ddd; width: 220px; height: 220px; overflow: hidden; background: url('<? echo $release->img_url; ?>'); background-size: cover;">
                                    <img itemprop="thumbnailUrl"  style="display: none;" class="lazy" src="<? echo $release->img_url; ?>" data-src="<? echo $release->img_url; ?>" alt="<? echo $release->artist_name." - ".$release->title; ?>"/>
                                    <noscript>
                                        <img itemprop="thumbnailUrl" height="220" src="<? echo $release->img_url; ?>" alt="<? echo $release->artist_name." - ".$release->title; ?>"/>
                                    </noscript>
                                <? } ?>
                            </div>
                        </div>
                        <? if ($this->ion_auth->is_admin()) { ?>
                        <div class="field-box">
                            <a data-toggle="modal" href="#adminUrlModal" class="btn">  <i class="icon-picture" style="margin-right: 10px;"></i>Send Cover Link</a>
                        </div>
                        <? } ?>


                        <div class="field-box">
                            <div class="release_info">Tracklist:</div>
                            <textarea id="tracklist" class="span8" rows="4" <? if (!$this->ion_auth->is_admin()){ echo "readonly"; }?> style="cursor: pointer; margin-left: 15px; background: none repeat scroll 0 0 #FFFFFF; color: #333333;" itemprop="tracks"><? echo $release->tracklist; ?></textarea>

                        </div>
                        <div class="field-box">
                            <div class="release_info">Genre:</div>
                            <? if ($this->ion_auth->is_admin()){ ?>
                            <select id="genre" name="genre" style="margin-left: 20px; height: 30px;">
                                <option value="0" > - </option>
                                <?
                                $query = $this->db->query("SELECT * FROM music_genres");

                                foreach ($query->result_array() as $row)
                                {
                                    echo "<option value='".$row['id']."'";
                                    if($row['genre']==$release->genre){
                                        echo " selected='selected' ";
                                    }
                                    echo ">".$row['genre']."</option>";
                                }

                                ?>
                            </select>
                            <? }else{?>
                            <div class="span8 release_data" itemprop="genre"><? echo $release->genre; ?></div>
                            <?}?>

                        </div>    
                        <div class="field-box">
                            <div class="release_info">Release Date:</div>
                            <? if ($this->ion_auth->is_admin()){ ?>
                                <input id="date" name="date" class="span4 date-picker" type="text" value="<? echo $release->date; ?>" data-date-format="dd-mm-yyyy"  style=" margin-left: 20px;" />

                            <? }else{?>
                                <div class="span8 release_data" itemprop="datePublished"><? echo $release->date; ?></div>
                            <?}?>
   
                        </div>
                        <div class="field-box">
                            <div class="release_info">Extra Info:</div>
                            <textarea class="span8" rows="5" readonly style="height: 60px; cursor: pointer; margin-left: 15px; background: none repeat scroll 0 0 #FFFFFF; color: #333333;" ><? echo $release->extra_info; ?></textarea>
                        </div>
                        <? if ($this->ion_auth->is_admin()){ ?>
                        <br><a id="saveTrackBtn" class="btn">Save</a><br><hr/>
                        <? }?>   


                        <? if ($release->label_name!="")
                        {
                            ?>
                            <div class="field-box">
                                <div class="release_info">Label:</div>
                                <div class="span8 release_data">
                                    <a href="<? echo base_url('label/view/'.$release->label_slug );?>" class="link" data-original-title="Search more <? echo $release->label_name; ?> Releases" itemprop="publisher">
                                        <? echo $release->label_name; ?>
                                    </a>
                                </div>
                            </div>
                            <?
                        }
                        if ($this->ion_auth->is_admin())
                            { ?>
                        <div class="field-box">
                            <div class="release_info">Admin:</div>
                            <div class="span8">
                             <span class="badge badge-info" style="margin-right: 20px;">ID: <? echo $release->release_id; ?></span>
                             <span class="badge badge-success" style="margin-right: 20px;">Views: <? echo $release->views; ?></span>
                             <span class="badge badge-warning" style="margin-right: 20px;"><? echo $release->insertedDate; ?></span>
                             <br><br>
                             <?
                             $query = $this->db->get_where('hot_releases', array('release_id' =>$release->release_id))->row();
                             if (isset($query->id))
                             {
                                $isHot = true;
                            }else{
                                $isHot = false;
                            }?>
                            <div class="btn-glow" style="margin-right: 20px;" id="toggleHotBtn">
                                <i class="icon-fire"></i>
                                <? if($isHot){ echo "IS "; }else{ echo "NOT "; }?>Hot
                            </div>
                            <a class="btn btn-danger small" href="<? echo base_url('release/delete/'.$release->release_id);?>">
                                <i class="icon-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                    <div class="field-box">
                        <div class="release_info">Status:</div>
                        <div class="span8">
                            <input type="text" style="width: 20px; margin-right: 20px; " name="releaseStatus" id="releaseStatus" value="<? echo $release->status; ?>">
                            <a id="saveStatusBtn" class="btn">Save</a>
                        </div>
                    </div>
                    <?
                }
                ?>                    
                <? if ($country!=""){ ?>
                <div class="field-box">
                    <div class="release_info">Country:</div>
                    <div class="span8 release_data"><? echo $country; ?></div>
                </div> 
                <? } ?> 
                <div class="field-box">
                    <div class="release_info">Share:</div>
                    <div class="span8 release_data">
                        <!-- AddThis Button BEGIN -->
                        <div class="addthis_toolbox addthis_default_style addthis_16x16_style">
                            <a class="addthis_button_facebook"></a>
                            <a class="addthis_button_email"></a>
                            <a class="addthis_button_twitter"></a>
                            <a class="addthis_button_google_plusone_share"></a>
                            <a class="addthis_button_compact"></a><a class="addthis_counter addthis_bubble_style"></a>
                        </div>
                        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=undefined"></script>
                        <!-- AddThis Button END -->
                    </div>
                </div>
                <? if ($this->ion_auth->logged_in()){
                    ?>
                    <div class="field-box well" style="padding: 10px;">
                        <div class="release_info">
                            <div style="width: 60px; height: 60px;">
                                <?
                                if ($user->image!="") { 
                                    $ext =  substr($user->image, -4);
                                    $name =  substr($user->image, 0, -4);
                                    $thumb = $name."_thumb".$ext;
                                    ?>
                                    <img src="<? echo base_url('uploads/avatars/'.$thumb); ?>" class="miniAvatar img-circle">
                                    <? }else{ ?>                             
                                    <img src="<? echo base_url('img/contact-img.png'); ?>" class="miniAvatar img-circle">
                                    <? } ?> 
                                </div>      
                            </div>
                            <div class="span8 release_data" style="border: none; margin-top: 14px;">

                                <div class="btn-group settings">
                                    <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="icon-download-alt" style="margin-right: 10px;"></i>Save to list
                                        <span class="caret" style="margin-left: 5px;"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <?

                                        if($lists){
                                            foreach ($lists as $row) {
                                                ?>
                                                <li id="list_<? echo $row->listID; ?>"<? 
                                                 $query = $this->db->get_where('lists_releases', array('lists_id' => $row->listID, 'release_id' => $release->release_id ))->row();
                                                 if (isset($query->id))
                                                 {
                                                    echo "style='background: #81BD82;'";
                                                }
                                                ?>>
                                                <a <? echo "onclick='addToList(".$row->listID.");'";  ?>><? echo $row->list_name; ?></a>
                                            </li>
                                            <?
                                        }
                                    }else{
                                        echo "<li><a href=".base_url('/user').">You dont have created any list yet, edit your account and create the first one.</a></li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <? } ?>

                </form>
            </div>

            <!-- right column -->
            <div class="span5 column pull-right">
              <div class="well" style="padding: 8px 0; margin-top: 20px;">
                        <ul class="nav nav-list">
                            <li class="nav-header">Related Releases</li>
                            <? 
                            if($related){ 
                            foreach ($related as $row){
                            ?>
                            <li><a href="<? echo base_url('release/download/'.$row->slug);?>"><? echo "<span style='font-size:14px; color:#005580;'>".$row->artist_name." - ".$row->title."</span> / ".$row->date."  ".$row->label_name; ?></a></li>
                            <? } }
                            ?> 
                        </ul>
                </div>
            </div>
    </div>
</div>
<hr>
<?
if($release->status==2){
    ?>

    <div class="span10">
        <div class="hero-unit well" style="padding: 20px; font-size: 16px; line-height: 20px; text-align: center;">
            <p>Sorry ;(</p>
            <p>This content was removed due to DMCA notification.</p>
        </div>
    </div>
    <?
}else{


    $this->load->database();
    $this->db->from('link_group');
    $this->db->select('*, link_group.id as link_group_id');
    $this->db->join('link', 'link_group.id = link.link_group_id');
    $this->db->where('link_group.release_id', $release->release_id);
    $this->db->order_by("link_group.inactive", "asc");
    $query = $this->db->get();
    ?>
    <div class="row-fluid head"  style="margin-top: 60px;">

        <div class="span12">
            <div style="float: left; margin-right: 10px;">
                <span class="badge badge-info"><? echo $query->num_rows(); ?></span>
            </div>
            <h3>Direct Download Links</h3>
        </div>
    </div>
    <div class="row-fluid section" style="margin-top: 10px;">
        <div class="table-products" style="margin-top: -20px; border: none;">
            <div id="link_adder" class="well">
                <div class="span1" style="font-size: 14px; padding-top: 5px;">
                    Link: 
                </div>  
                <div class="span10">
                    <input id="link_url" type="text" placeholder="Url" class="span9">
                    <div class="ui-select" style="float: right;">
                        <select id="quality_link" name="quality_link" >
                            <option value="-" selected > - </option>
                            <option value="128 kbps"  > 128 kbps </option>
                            <option value="256 kbps"  > 256 kbps </option>
                            <option value="320 kbps"  > 320 kbps </option>
                            <option value="FLAC"  > FLAC </option>
                        </select>
                    </div>
                </div>
                <div class="span1">
                    <a id="btn_add_url" class="btn-flat new-product" style="font-size: 16px;">Add</a>
                </div>
            </div>

            <div class="row-fluid" style="margin-top: 40px">
                <table class="table table-hover" id="links_table">
                    <thead>
                        <tr>
                            <th class="span6">
                                Link
                            </th>
                            <th class="span1">
                                <span class="line"></span>Quality
                            </th>
                            <th class="span1">
                                <span class="line"></span>Type
                            </th>
                            <th class="span1">
                                <span class="line"></span>Rate
                            </th>
                            <th class="span2">
                                Rank
                            </th>
                            <th class="span1">
                                <span class="line"></span>Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?

                        foreach ($query->result() as $row) {
                          ?>

                          <tr class="first">
                            <td>
                                <a href="<? echo $row->url; ?>" target="_blank"><? echo $row->url; ?></a>
                            </td>
                            <td class="description">
                             <b><? echo $row->quality; ?></b>
                         </td>
                         <td class="">
                            Direct Download<br>( <b><? echo $row->server; ?></b> )
                        </td>
                        <td>
                            <div class="btn-group btn-mini">
                              <a class="btn btn-mini link" data-original-title="Good" <? if (!$this->ion_auth->logged_in()){ 
                                echo "data-toggle='modal' href='#notLoggedModal'"; 
                            }else{
                                echo "onclick='rateLink(".$row->link_group_id.",1);'"; 
                            } ?> >
                            <i class="icon-circle-arrow-up"></i></a>
                            <a class="btn btn-mini link" data-original-title="Bad" <? if (!$this->ion_auth->logged_in()){ 
                                echo "data-toggle='modal' href='#notLoggedModal'"; 
                            }else{
                                echo "onclick='rateLink(".$row->link_group_id.",2);'"; 
                            } ?> >
                            <i class="icon-circle-arrow-down"></i></a>
                            <a class="btn btn-mini btn-danger link"  data-original-title="Invalid" <? if (!$this->ion_auth->logged_in()){ 
                                echo "data-toggle='modal' href='#notLoggedModal'"; 
                            }else{
                                echo "onclick='rateLink(".$row->link_group_id.",3);'"; 
                            } ?> >
                            <i class="icon-trash"></i></a>
                        </div>
                    </td>
                    <td><?
                        $per = 50 + $row->karma;
                        if($per<0){
                            $per = 0;
                        }
                        if($per>100){
                            $per = 100;
                        }
                        ?>
                        <div class="progress <?
                        if ($per==50) echo "progress-info";
                        if ($per<50) echo "progress-warning";
                        if ($per>50) echo "progress-success";
                        ?>">
                        <div class="bar" style="width: <? echo $per; ?>%"></div>
                    </div>
                </td>
                <td>
                    <? if ($row->inactive>2) {?>
                    <span class="label label-important">Inactive</span>
                    <?
                }else{
                    ?>
                    <span class="label label-success">Active</span>
                    <?                        
                }
                ?>  
            </td>

        </tr>

        <?
    } 
    ?>
    <!-- row -->
</tbody>
</table>
</div>

</div>
</div>
<? } ?>
<div class="row-fluid head" style="margin-top: 60px;">
    <div class="span12">
        <h3>Comments</h3>
    </div>
</div>
<div class="row-fluid section" style="margin-top: 10px;">
    <div id="disqus_thread"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'themagnes'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>


</div>
<div class="row-fluid section" style="margin-top: 10px;">

    <!-- AddThis Trending Content BEGIN -->
    <div id="addthis_trendingcontent"></div>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51c2516e06c7fed9"></script>
    <script type="text/javascript">
        addthis.box("#addthis_trendingcontent", {
            feed_title : "",
            feed_type : "shared",
            feed_period : "month",
            num_links : 5,
            height : "auto",
            width : "auto"});
    </script>
    <!-- AddThis Trending Content END -->


</div>
</div>
</div>

<!-- end main container -->


<? if ($this->ion_auth->is_admin())
{ ?>
    <div id="adminUrlModal" class="modal hide fade" tabindex="-1" role="dialog" >
        <div class="modal-header">
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h3>Please enter a new Url:</h3>
        </div>
        <div class="modal-body">
            <div class="divDialogElements">
                <input class="xlarge" id="xlInput" name="xlInput" type="text" />
            </div>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" onclick="closeDialog ();">Cancel</a>
            <a href="#" class="btn btn-primary" onclick="okClicked ();">OK</a>
        </div>
    </div>
    <?
}
if (!$this->ion_auth->logged_in()){
    ?>
    <div id="notLoggedModal" class="modal hide fade" tabindex="-1" role="dialog" style="width: 300px;">
        <div class="modal-header">
            <a href="#" class="close" data-dismiss="modal">&times;</a>
            <h3>Sorry, you must be logged in!</h3>
        </div>
        <div class="modal-body">
            <button onclick="location.href='<? echo base_url('auth/login'); ?>';" class="btn btn-primary" style="width:150px;">Login</button><br><br>
            <button onclick="location.href='<? echo base_url('auth/register'); ?>';" class="btn btn-success" style="width:150px;">Sign in</button>
        </div>
        <div class="modal-footer">
            <a href="#" class="btn" onclick="closeLoggedDialog ();">Ok</a>
        </div>
    </div>
    <?
}
?>



