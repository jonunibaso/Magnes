 <!-- main container -->
 <div class="content">
    <div class="container-fluid">
        <div class="row-fluid" style="">
            <div class="span8">
                <div id="pad-wrapper">
                    <!-- header -->
                    <div class="row-fluid header" style="margin-bottom: 20px;">
                        <div class="span8">
                            <h3 class="name">Artist List</h3>
                        </div>
                    </div>

                    <div class="row-fluid">

                     <div class="pagination pull-left">
                        <ul>
                            <li><a href="<? echo base_url('artist/letter/characters');?>">#-9</a></li>
                            <li><a href="<? echo base_url('artist/letter/a');?>">A</a></li>
                            <li><a href="<? echo base_url('artist/letter/b');?>">B</a></li>
                            <li><a href="<? echo base_url('artist/letter/c');?>">C</a></li>
                            <li><a href="<? echo base_url('artist/letter/d');?>">D</a></li>
                            <li><a href="<? echo base_url('artist/letter/e');?>">E</a></li>
                            <li><a href="<? echo base_url('artist/letter/f');?>">F</a></li>
                            <li><a href="<? echo base_url('artist/letter/g');?>">G</a></li>
                            <li><a href="<? echo base_url('artist/letter/h');?>">H</a></li>
                            <li><a href="<? echo base_url('artist/letter/i');?>">I</a></li>
                            <li><a href="<? echo base_url('artist/letter/j');?>">J</a></li>
                            <li><a href="<? echo base_url('artist/letter/k');?>">K</a></li>
                            <li><a href="<? echo base_url('artist/letter/l');?>">L</a></li>
                            <li><a href="<? echo base_url('artist/letter/m');?>">M</a></li>

                        </ul>
                    </div>
                    <div class="pagination pull-left">
                        <ul>
                            <li><a href="<? echo base_url('artist/letter/n');?>">N</a></li>
                            <li><a href="<? echo base_url('artist/letter/o');?>">O</a></li>
                            <li><a href="<? echo base_url('artist/letter/p');?>">P</a></li>
                            <li><a href="<? echo base_url('artist/letter/q');?>">Q</a></li>
                            <li><a href="<? echo base_url('artist/letter/r');?>">R</a></li>
                            <li><a href="<? echo base_url('artist/letter/s');?>">S</a></li>
                            <li><a href="<? echo base_url('artist/letter/t');?>">T</a></li>
                            <li><a href="<? echo base_url('artist/letter/u');?>">U</a></li>
                            <li><a href="<? echo base_url('artist/letter/v');?>">V</a></li>
                            <li><a href="<? echo base_url('artist/letter/w');?>">W</a></li>
                            <li><a href="<? echo base_url('artist/letter/x');?>">X</a></li>
                            <li><a href="<? echo base_url('artist/letter/y');?>">Y</a></li>
                            <li><a href="<? echo base_url('artist/letter/z');?>">Z</a></li>                
                        </ul>
                    </div>
                </div>
                <div class="row-fluid">
                  <br>
                  <div class="row-fluid">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span3">
                                    Artist
                                </th>
                                <th class="span3">
                                    Releases
                                </th>
                                 <? if($this->ion_auth->is_admin()){ ?>
                                <th class="span3">
                                    Admin
                                </th> 
                                <? } ?>
                            </tr>
                        </thead>
                        <tbody>

                            <?  
                            foreach ($artist_list as $row)
                            { 
                                ?>

                                <!-- row -->
                                <tr class="first">

                                    <td>
                                    <a href="<? echo base_url('artist/view/'.$row->artist_slug);?>" class="link" data-original-title="Search <? echo $row->artist_name; ?> Releases"  style="font-size: 14px;">
                                    <? echo $row->artist_name;
                                        if($this->ion_auth->is_admin()){
                                            echo " (".$row->id.")";
                                        }
                                     ?>
                                    </a>
                                    </td>
                                    <td>
                                        <? echo $row->num_releases; ?> releases
                                    </td>
                                    <? if($this->ion_auth->is_admin()){
                                        echo "<td>(".$row->id.")<a class='btn-glow' href='". base_url('edit/artist/'.$row->artist_slug)."' style='margin-left: 10px;¡><i class=¡icon-edit'></i>Edit</a></td>";
                                    }
                                    ?>
                                </tr>
                                <? 
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <div class="span4">
        <div class="well" style="padding: 8px 0; margin-top: 240px;">
            <ul class="nav nav-list">
                <li class="nav-header">Top Artists</li>
                <?  
                foreach ($artist_top as $row)
                { 
                    echo "<li><a href='".base_url('artist/view/'.$row->artist_slug)."' style='font-size:14px; color:#005580;' >".$row->artist_name."</a></li>";
                }?>
            </ul>
        </div>
    </div>
</div>
</div>
</div>
