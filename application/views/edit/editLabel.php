
<!-- main container -->
<div class="content">

 <div class="container-fluid">
    <div id="pad-wrapper" class="form-page">
        <div class="row-fluid form-wrapper">
            <!-- left column -->
            <div class="span8 column">
                <div class="field-box">
                    <div class="release_info">Label:</div>
                    <div class="span8 release_data">
                        <a href="<? echo base_url('label/view/'.$label->label_slug );?>" class="link" data-original-title="Search more <? echo $label->label_name; ?> Releases">
                            <? echo $label->label_name; ?>
                        </a>

                    </div>
                </div>
                <div class="field-box">
                    <div class="release_info">Id:</div>
                    <div class="span8 release_data"><? echo $label->id; ?></div>
                </div>
                <div class="field-box">
                    <div class="release_info">Slug:</div>
                    <div class="span8 release_data"><? echo $label->label_slug; ?></div>
                </div>
                <div class="field-box">
                    <div class="release_info">Rename:</div>
                    <div class="span8 release_data"><input id="newName" class="span8" type="text" maxlength="100" name="newName" value="<? echo $label->label_name; ?>" /></div>
                </div>
                <div class="field-box">
                    <div class="release_info">
                    <button onclick="labelRename(<? echo $label->id;  ?>);" class="btn-glow primary btn-next" data-last="Finish" type="button">Rename</button>
                    </div>
                    <div class="span8 release_data" style="border: none;"></div>
                </div>
                <div class="field-box" style="margin-top: 60px;">
                    <div class="release_info">Insert ino:</div>
                    <div class="span8 release_data"  style="border: none;">
                        <div class="ui-select" style="width: 400px">
                            <select id="intoId" name="intoId" >
                                <option value="-1" selected > - </option>

                                <?
                                $query = $this->db->query("SELECT * FROM labels ORDER BY label_name DESC");

                                foreach ($query->result_array() as $row)
                                {
                                    if($row['id']!=$label->id){
                                        echo "<option value='".$row['id']."'>".$row['label_name']." - ".$row['id']."</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <button onclick="labelInsertInto(<? echo $label->id;  ?>);" class="btn-glow primary btn-next" data-last="Finish" type="button">Insert into</button> 
            </div>
        </div>


    </div>
</div>
</div>
<!-- end main container -->
