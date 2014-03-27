
<!-- main container -->
<div class="content">
    <div class="container-fluid">
        <div id="pad-wrapper" class="user-profile">
            <div class="row-fluid header">
                <div class="span8">
                    <div style="width: 200px; float: left;">
                        <div id='avatarImg'>
                            <? if ($user_list->image!="") { 
                                $ext =  substr($user_list->image, -4);
                                $name =  substr($user_list->image, 0, -4);
                                $thumb = $name."_thumb".$ext;
                                ?>
                                <img src="<? echo base_url('uploads/avatars/'.$thumb); ?>" class="avatar img-circle">

                                <? }else{ ?>                             
                                <img src="<? echo base_url('img/contact-img.png'); ?>" class="avatar img-circle">
                                <? } ?>
                            </div>
                        </div>
                        <h2 class="name"><i class="icon-list" style="margin-right: 10px; font-size: 20px;"></i><? echo  $list->list_name; ?></h2><br><br>
                        <span style="font-size: 14px;">Compiled by:  <a href="<? echo base_url('users/v/'.$user_list->username); ?>"> <? echo  $user_list->username; ?></a></span>
                        <div class="field-box" style="margin-top: 20px;">
                            <div class="release_info" style="width: 40px;">Share:</div>
                            <div class="span6 release_data" style="border: none;">
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
                    </div>

                </div>
            </div>
            <div id="pad-wrapper" style="margin-top: -30px;">
                <div class="table-products section" style="margin-top: 0px; border: none; box-shadow: none;">
                    <div class="row-fluid head">
                        <div class="span12">
                            <h4>Releases</h4>
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

                                foreach ($list_releases as $row)
                                { 
                                    ?>
                                    <tr itemscope itemtype="http://schema.org/MusicAlbum">
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
                                            <a itemprop="url" target="_blank" class="btn-flat default" href="<? echo base_url('release/download/'.$row->slug);?>" style="margin-top: -10px; font-size: 12px;" >Download</a>
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
        </div>

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
    </div>
</div>

<!-- end main container -->
