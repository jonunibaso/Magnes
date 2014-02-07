
<!-- main container -->
<div class="content">

    <div class="container-fluid">
        <div id="pad-wrapper" class="user-profile">
            <!-- header -->
            <div class="row-fluid header">
                <div class="span8">
                    <div style="width: 200px; float: left;">
                        <div style="height: 180px;">
                            <div id='avatarImg'>
                                <? if ($user->image!="") { 
                                    $ext =  substr($user->image, -4);
                                    $name =  substr($user->image, 0, -4);
                                    $thumb = $name."_thumb".$ext;
                                    ?>
                                    <img src="<? echo base_url('uploads/avatars/'.$thumb); ?>" class="avatar img-circle">

                                    <? }else{ ?>                             
                                    <img src="<? echo base_url('img/contact-img.png'); ?>" class="avatar img-circle">
                                    <? } ?>
                                </div>
                            </div>
                        </div>

                        <h3 class="name"><? echo  $user->username; ?></h3>
                        <span><? if ($user->bio==""){
                                    $bio = "That's you.";
                                }else{
                                    $bio = $user->bio;
                                }
                                echo $bio;
                                ?></span>
                    </div>
                </div>
            </div>
            <div class="row-fluid" style="margin-top: -40px;">
                <div class="span9" style="padding-left: 20px;">
                    <h3>User Lists</h3>
                    <br>
                    <!-- recent orders table -->
                    <table class="table table-hover" id="lists_table">
                        <thead>
                            <tr>
                                <th class="span6" style="font-size: 8px;">
                                    Name
                                </th>
                                <th class="span2" style="font-size: 8px;">
                                    <span class="line"></span>
                                    Items
                                </th>
                                <th class="span2">
                                    <span class="line"></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody  style="font-size: 16px;">
                            <?
                            if($lists){
                                foreach ($lists as $row) {
                                  ?>

                                  <!-- row -->
                                  <tr>
                                    <td>
                                        <a href="#"><? echo $row->list_name; ?></a>
                                    </td>
                                    <td><?
                                        $this->db->from('lists_releases');
                                        $this->db->where('lists_id', $row->id);
                                        $query = $this->db->get();
                                        $rowcount = $query->num_rows();
                                        echo $rowcount;
                                        ?> 
                                    </td>
                                    <td>
                                        <a class="btn-glow" href="<? echo base_url('lists/view/'.$row->slug); ?>" >
                                            <i class="icon-eye-open"></i>View
                                        </a>
                                     <!--   <a class="btn-glow">
                                        <i class="icon-edit-sign"></i>Edit
                                    </a> -->
                                </td>
                            </tr>
                            <? } 
                        }   ?>
                    </tbody>
                </table>
            </div>
        </div>

                    <div class="row-fluid" style="margin-top: 20px;">
                <div class="span9" style="padding-left: 20px;">
                    <h3>Favorite Labels</h3>
                    <br>
                    <!-- recent orders table -->
                    <table class="table table-hover" id="lists_table">
                        <thead>
                            <tr>
                                <th class="span6" style="font-size: 8px;">
                                    Name
                                </th>
                                <th class="span2" style="font-size: 8px;">
                                    <span class="line"></span>
                                    Num Releases
                                </th>
                                <th class="span2">
                                    <span class="line"></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody  style="font-size: 16px;">
                            <?
                            if($labels){
                                foreach ($labels as $row) {
                                  ?>

                                  <!-- row -->
                                  <tr>
                                    <td>
                                        <a href="#"><? echo $row->label_name; ?></a>
                                    </td>
                                    <td><?
                                        echo $row->num_releases;
                                        ?> 
                                    </td>
                                    <td>
                                        <a class="btn-glow" href="<? echo base_url('label/view/'.$row->label_slug); ?>" >
                                            <i class="icon-eye-open"></i>View
                                        </a>
                                     <!--   <a class="btn-glow">
                                        <i class="icon-edit-sign"></i>Edit
                                    </a> -->
                                </td>
                            </tr>
                            <? } 
                        }   ?>
                    </tbody>
                </table>
            </div>
        </div>
</div>
<!-- end main container -->
