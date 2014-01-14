<!-- main container -->
<div class="content">

    <div class="container-fluid">

            <div class="row-fluid head" style="margin-top: 50px;">
                <div class="span12">
                    <h2>View All Hot Releases</h2>
                </div>
            </div>

       
            <?  
            $i = 0;
            foreach ($hot_release as $row)
            { 
                if($i%4===0){
                    echo  "<div class='row-fluid section' style='margin-top: 10px;'>";
                }
                ?>
                <div class="span3 hot_release" itemscope itemtype="http://schema.org/MusicAlbum">
                    <div class="thumbnail">
                        <img itemprop="thumbnailUrl" class="lazy" src="<? echo $row->img_url; ?>" data-src="<? echo $row->img_url; ?>" alt="<? echo $row->artist_name." - ".$row->title; ?>"/>
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
                        <? echo $row->label_name." - "; ?>
                        </a>
                        <? } ?>
                        <? echo $row->genre; ?></h5>
                        <div style="margin-top:30px;">
                            <a itemprop="url" class="btn-flat default" href="<? echo base_url('release/download/'.$row->slug);?>" style="margin-top: -10px; font-size: 12px;">Download</a>
                        </div>
                    </div>

                </div>
                <?
                if($i%4===3){
                    echo "</div>";
                }
                $i++;
            }
            ?>

        </div>

    </div>
    <!-- end table  -->

</div>
