

window.onload = function() {
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
            items.push("<li style='height: 90px'><div id='tracks_list'><div style='float:left; width: 150px; height: 90px;'><img src='"+val.artwork_url+"'/></div><div style='float:left;'><a data-artist='"+val.user.username+"' data-title='"+val.title+ "' data-url=" + val.stream_url + " href='javascript:void();'><h2>"+val.title+"</h2>\
            <span class='plays'>" + val.playback_count+ " plays  -  <b>"+ val.user.username+  "</b></span></a></div></li>");
          });
          $('#sounds').html("<ul>"+items.join(' ')+"</ul>");
          trackClick();

        }
    });

};

var clientid = 'client_id=0bcc7c4bcd2b5b55b23ab538c02f70c0';

function trackClick(){
  $('#tracks_list a').click(function(){
  
    var s_url= $(this).data('url') +"?"+ clientid;
    var s_title= $(this).data('title');
    var artist = $(this).data('artist');
    $(this).addClass('playedSong');
    	/*
    $('#navbar h2').html(title);
    var audioPlayer = document.getElementById('player');
  audioPlayer.src = url;
  audioPlayer.load();
  document.getElementById('player').play();
  document.title="Playing - Soundcloud Instant"
    return false;
    */
    SCM.play({title:s_title,url:s_url});
  });
}