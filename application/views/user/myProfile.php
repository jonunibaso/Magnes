
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
                            <a class="btn-flat icon large edit" id="changeAvatarBtn">
                                Change avatar
                            </a>
                            <form id="imageform" method="post" enctype="multipart/form-data" action='<? echo base_url('user/ajaximage'); ?>' style="height: 30px; margin-top: 20px; display: none;">
                                <input type="file" name="photoimg" id="photoimg" />
                            </form>
                        </div>

                        <h3 class="name"><? echo  $user->username; ?></h3>
                        <span class="area">Karma: -</span><br><br>
                        <span>Your public url: <a href="<? echo base_url('users/v/'.$user->username); ?>" style="font-size: 16px; margin-left: 10px;" target="_blank"><? echo base_url('users/v/'.$user->username); ?></a></span>
                    </div>
                    <!--
                    <a class="btn-flat icon pull-right delete-user" data-toggle="tooltip" title="Delete user" data-placement="top">
                        <i class="icon-trash"></i>
                    </a>-->

                </div>

                <div class="row-fluid profile">
                    <div class="span9 bio"  style="border-bottom: none;">
                        <div class="profile-box">
                            <div class="span12 section">
                                <? if ($user->bio==""){
                                    $bio = "That's you.";
                                }else{
                                    $bio = $user->bio;
                                } ?>
                                <h6>About</h6>
                                <p id="bio"><? echo $bio; ?></p>
                                <p id="bioEdit" style="display:none;"><textarea cols="80" id="nb"><? echo $bio; ?></textarea></p> 
                            </div>

                        </div>
                    </div>

                    <div class="span3 pull-right">
                     <a class="btn-flat icon large pull-right edit" id="changeBioBtn">
                        Edit your info
                    </a>
                    <div id="editBio" style="display:none;">
                        <a class="btn-flat icon large pull-right edit" id="saveBioBtn" style="margin-right: 10px;">
                            Save
                        </a>
                        <a class="btn-flat icon large pull-right edit" id="cancelBioBtn" style="margin-right: 10px;">
                            Cancel
                        </a>
                    </div>

                </div>
            </div>
            <div class="row-fluid profile">
                <div class="span9 bio">

                    <h6>Lists</h6>
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
                                    Views
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
                                        <a  href="<? echo base_url('lists/view/'.$row->slug); ?>" target="_blank" ><? echo $row->list_name; ?></a>
                                    </td>
                                    <td>
                                        <span><? echo $row->views ; ?></span>
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
                                        <a class="btn-glow" href="<? echo base_url('lists/view/'.$row->slug); ?>" target="_blank">
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
            <div class="span3 pull-right">
                <a class="btn-flat icon large pull-right edit" data-toggle="modal" href="#newListModal" id="createList">
                    Create List
                </a>
            </div>
        </div>
        <div class="row-fluid profile">
            <div class="span9 bio">

                <h6>Favorite Labels</h6>
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
                                    <a href="<? echo base_url('label/view/'.$row->label_slug); ?>" target="_blank"><? echo $row->label_name; ?></a>
                                </td>
                                <td>
                                    <span><? echo $row->num_releases; ?></span>
                                </td>
                                <td>
                                    <a class="btn-glow" href="<? echo base_url('label/view/'.$row->label_slug); ?>" target="_blank">
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

<div id="newListModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="windowTitleLabel" aria-hidden="true">
    <div class="modal-header">
        <a href="#" class="close" data-dismiss="modal">&times;</a>
        <h3>Please enter list name:</h3>
    </div>
    <div class="modal-body">
        <div class="divDialogElements">
            <input class="xlarge" id="xlInput" name="xlInput" type="text" />
        </div>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="closeDialog ();">Cancel</a>
        <a href="#" class="btn btn-primary" onclick="okClicked ();">Create</a>
    </div>
</div>

