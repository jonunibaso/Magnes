<!-- main container -->
<div class="content">


    <div class="container-fluid">
        <div id="pad-wrapper">

                <div class="row-fluid">
                    <div class="span12">
                        <div id="fuelux-wizard" class="wizard row-fluid">
                            <ul class="wizard-steps">
                                <li data-target="#step1" class="active">
                                    <span class="step">1</span>
                                    <span class="title">Basic <br> Information</span>
                                </li>
                                <li data-target="#step2">
                                    <span class="step">2</span>
                                    <span class="title">Extra Information<br><span style="color:green">optional</span></span>
                                </li>
                                <li data-target="#step3">
                                    <span class="step">3</span>
                                    <span class="title">Cover<br><span style="color:green">optional</span>
                                </li>
                                <li data-target="#step4">
                                    <span class="step">4</span>
                                    <span class="title">Links</span>
                                </li>
                            </ul>                            
                        </div>

                        <form  name="input"  action="<? echo base_url('send/input'); ?>"  method="post" class="well" style="width:85%">

                            <div class="step-content">
                                <div class="step-pane active" id="step1">
                                    <div class="row-fluid form-wrapper">
                                        <div class="span8">


                                            <? if(validation_errors() != false) { ?>
                                            <div class="alert alert-error">
                                                <i class="icon-remove-sign"></i>
                                                <?php echo validation_errors(); ?>
                                            </div>
                                            <? } ?> 

                                            <div class="field-box">
                                                <label>Artist:</label>
                                                <input id="artist" name="artist" class="span8" type="text" maxlength="100" autocomplete="off" data-provide="typeahead" />
                                            </div>
                                            <div class="field-box">
                                                <label>Release:</label>
                                                <input id="title" name="title" class="span8" type="text"  maxlength="200" />
                                            </div>
                                            <div class="field-box">
                                                <label>Genre:</label>
                                                <div class="ui-select">
                                                    <select id="genre" name="genre" >
                                                        <option value="0" selected > - </option>
                                                        <?
                                                        $query = $this->db->query("SELECT * FROM music_genres");

                                                        foreach ($query->result_array() as $row)
                                                        {
                                                            echo "<option value='".$row['id']."'>".$row['genre']."</option>";
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="field-box">
                                                <label>Tracklist:</label>
                                                <textarea id="tracklist" name="tracklist" class="span8" rows="3"></textarea>
                                            </div>                                         
                                        </div>
                                    </div>

                                </div>
                                <div class="step-pane" id="step2">
                                    <div class="row-fluid form-wrapper">
                                        <div class="span8">
                                            <div class="field-box">
                                                <label>Release Year:</label>
                                                <input id="date" name="date" class="span4 date-picker" type="text" value="" data-date-format="dd-mm-yyyy" />
                                            </div>
                                            <div class="field-box">
                                                <label>Label:</label>
                                                <input id="discography" name="discography" class="span8" type="text" />
                                            </div>
                                            <div class="field-box">
                                                <label>Country:</label>
                                                <div class="ui-select">

                                                    <select id="country" name="country" >
                                                        <option value="0" selected > - </option>
                                                        <?
                                                        $query2 = $this->db->query("SELECT * FROM countries");

                                                        foreach ($query2->result_array() as $row2)
                                                        {
                                                            echo "<option value='".$row2['id']."'>".$row2['country_name']."</option>";
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="field-box">
                                                <label>Extra Info:</label>
                                                <textarea id="extra_info" name="extra_info" class="span8" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="step-pane" id="step3">
                                    <div class="row-fluid form-wrapper">
                                        <div class="span8">
                                            <div class="field-box">
                                                <label>Cover Img Url:</label>
                                                <input id="img_url" name="img_url" class="span8" type="text" />
                                            </div>
                                            <div id="img_url_container" style="width: 200px; height: 200px; border: 1px solid white; overflow: hidden;">

                                            </div>
                                            <input id="validated_img_url" name="validated_img_url" type="hidden" />

                                        </div>
                                    </div>
                                </div>
                                <div class="step-pane" id="step4">
                                    <div class="row-fluid">
                                        <div class="span11">
                                            <div id="link_adder">
                                             <div class="span1" style="font-size: 14px; padding-top: 5px;"> Link: </div> 
                                             <div class="row-fluid">
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
                                                <a id="btn_send_add_url" class="btn-flat new-product" style="font-size: 16px;">Add</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-fluid">
                                        <div class="span12" style="margin-top: 20px;">
                                         <table class="table table-hover" id="links_table">
                                            <thead>
                                                <tr>
                                                    <th class="span5">
                                                        Link
                                                    </th>
                                                    <th class="span2">
                                                        <span class="line"></span>Quality
                                                    </th>
                                                    <th class="span4">
                                                        <span class="line"></span>Type
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <div id="secret_links" display="hidden">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="wizard-actions">
        <button type="button" disabled class="btn-glow primary btn-prev"> 
            <i class="icon-chevron-left"></i> Prev
        </button>
        <button type="button" class="btn-glow primary btn-next" data-last="Finish">
            Next <i class="icon-chevron-right"></i>
        </button>
        <button type="submit" class="btn-glow success btn-finish">
            Publish!
        </button>
    </div>
</form>
</div>
</div>
</div>
</div>
</div>
<!-- end main container -->
