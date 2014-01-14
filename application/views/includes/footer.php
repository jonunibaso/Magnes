<?
$CurrentSecc = $this->uri->segment(1, 0);
if($CurrentSecc===0){
	$CurrentSecc = "front";
}
?>

<div style="clear:both"></div>
<hr />
<div class="row-fluid" style="">
  <div class="span12" style="margin: auto auto;">
    <div class="alert alert-info">
      <b>TheMagnes.com does not claim ownership or copyright of any media posted on this site.</b>
      <br> The files themselves are hosted by private or public third-parties. We do not DIRECTLY host any media. Files should only be used for promotional uses. You must delete them after 24 hours of downloading.
      <br> We do not encourage copyrighting. You should support the Artists/Producers/Others for their work. If enjoy the music , we highly encourage you to acquire original copies to support the industry or artists.
    </div>
    </div>
    </div>
    <script type="text/javascript"> 
      var CI = { 
        'base_url': '<?php echo base_url(); ?>', 
      }; 
    </script> 

    <script src="<? echo base_url('lib/jquery-2.0.2.min.js');?>"></script>
    <script src="<? echo base_url('lib/bootstrap.min.js');?>"></script>
    <script src="<? echo base_url('lib/bootstrap-datepicker.js');?>"></script>
    <script src="<? echo base_url('lib/jquery-ui-1.10.2.custom.min.js');?>"></script>
    <script src="<? echo base_url('lib/jail.js');?>"></script>

    <script src="<? echo base_url('js/theme.js');?>"></script>


    <? if ($CurrentSecc=="send"){ ?>

    <script src="<? echo base_url('lib/fuelux.wizard.js');?>"></script>
    <script src="<? echo base_url('js/sendRelease.js');?>"></script>
    <script src="<? echo base_url('js/linkChecker.js');?>"></script>

    <? } if ($CurrentSecc=="edit"){ ?>

    <script src="<? echo base_url('js/adminEdit.js');?>"></script>


    <? } if ($CurrentSecc=="release"){ ?>

    <script type="text/javascript" src="<? echo base_url('lib/jquery.pnotify.min.js');?>"></script>

    <script src="<? echo base_url('js/linkChecker.js');?>"></script>

      <? if ($this->ion_auth->is_admin()) { ?>

      <script type="text/javascript">

        $('#toggleHotBtn').on('click', function()
        {

          $.ajax({
            url:  CI.base_url+"release/toggleHot",
            type:'POST',
            data: { id: $('#release_id').val() },
            success: function(output_string){
              txt = $('#toggleHotBtn').html();
              if(txt.indexOf('IS')>0){
                $('#toggleHotBtn').html('<i class="icon-fire"></i>NOT Hot');
              }else{
                $('#toggleHotBtn').html('<i class="icon-fire"></i>IS Hot');
              }
            } 
          });
        });

      $('#saveTrackBtn').on('click', function()
      {
        newTrack = $('#tracklist').val();

        $.ajax({
          url:  CI.base_url+"release/updateTrack",
          type:'POST',
          data: { id: $('#release_id').val(), nt: newTrack },
          success: function(output_string){
            alert('updated');
          } 
        });

      });

      $('#saveStatusBtn').on('click', function()
      {
        newStatus = $('#releaseStatus').val();
        releaseID = $('#release_id').val();

        $.ajax({
          url:  CI.base_url+"release/updateStatus",
          type:'POST',
          data: { id: $('#release_id').val(), ns: newStatus },
          success: function(output_string){
            alert('updated');
          } 
        });

      });

      </script>

    <? }

  } if ($CurrentSecc=="search"){  ?>

  <script type="text/javascript">
    $('#search_input').val('<? echo str_replace('-',' ',$search_name); ?>');
    $('#search_input').focus();
  </script>

<? } if ($CurrentSecc=="auth"){ ?>

  <script type="text/javascript">
    $("#account_submenu").slideDown("fast");
  </script>
  
 <? } if ($CurrentSecc=="user"){ ?>

  <script src="<? echo base_url('lib/jquery.form.js');?>"></script>
  <script type="text/javascript" src="<? echo base_url('lib/jquery.pnotify.min.js');?>"></script>
  <link rel="styesheet" href="<? echo base_url('css/lib/jquery.pnotify.default.css'); ?>" type="text/css" media="screen" > 
  <script src="<? echo base_url('js/userEdit.js');?>"></script>

<? } ?>

<? if ($this->ion_auth->logged_in()) { ?>
  <script src="<? echo base_url('js/userActions.js');?>"></script>

<? } ?>


</body>
</html>