

$(window).ready(function(){
	$.ajax({
      url: "https://api.soundcloud.com/tracks.json?" + $('#sc_search').serialize()+"&limit=5",
      dataType: 'json',
      beforeSend: 
        function(data){
          $('#sounds').empty();
        },
      success:
        function(data){
          $('#sounds').html('')
          var items = [];
          $.each(data, function(key, val){
            if(val.artwork_url==null){
              val.artwork_url = CI.base_url+"img/nocover_small.jpg";
            }
            items.push("<div id='' class='tracks_list blockquote-box clearfix'><div class='square pull-left'><img src='"+val.artwork_url+"'/></div><a data-artist='"+val.user.username+"' data-title='"+val.title+ "' data-url='" + val.stream_url + "' href='javascript:void();'><h4>"+val.title+"</h4><p><span class='plays'>" + val.playback_count+ " plays  -  <b>"+ val.user.username+  "</b></p></a> </div>");
          });

          $('#sounds').html(items.join(' '));
          trackClick();

        }
      
    });

});

var clientid = 'client_id=0bcc7c4bcd2b5b55b23ab538c02f70c0';

function trackClick(){

  $('.tracks_list a').click(function(){
  
    var s_url= $(this).data('url') +"?"+ clientid;
    var s_title= $(this).data('title');
    var artist = $(this).data('artist');
    $(this).addClass('playedSong');
    	
    $('#navbar h2').html(s_title);
    var audioPlayer = document.getElementById('player');
  audioPlayer.src = s_url;
  audioPlayer.load();
  document.getElementById('player').play();
  $('#player_title').html('Playing: '+s_title);
    return false;
  
  });
}