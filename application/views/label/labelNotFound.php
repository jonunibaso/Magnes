
<!-- main container -->
<div class="content">

    <div class="container-fluid">

        <div id="pad-wrapper" style="margin-top: 0px;">


            <div class="table-products" style="margin-top: 60px;">
                <div class="row-fluid head">
                    <div class="span12">
                        <h4>The label you was searching was not found</h4>
                    </div>

                    <div class="span12" style="font-size: 16px;">
                        <a href="<? echo base_url('/label/'); ?>" style="color: #007ab7;">You can search here the full label list</a>
                    </div>
                </div>
                <br>
            </div>
            <? 
            if($release){
                ?>
                <div class="row-fluid" style="">
                    <div class="span8">

                        <div id="pad-wrapper">
                            <!-- header -->
                            <div class="row-fluid header" style="margin-bottom: 20px;">
                                <div class="span8">
                                    <h3 class="name">Similar labels:</h3>
                                </div>
                            </div>
                            <?
                            foreach ($release as $row) { ?>

                            <a href="<? echo base_url('label/view/'.$row->label_slug);?>" class="link" data-original-title="Search <? echo $row->label_name; ?> Releases"  style="font-size: 18px;">
                                <?
                                echo $row->label_name; 
                                ?></a><br>
                                <?

                            }
                            ?>
                            </div>
                            </div>
                            </div>


                            <?
                        } ?>
                    </div>
                </div>
            </div>
