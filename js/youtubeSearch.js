$(window).ready(function(){

var search_input = $('#q').val();
var keyword= encodeURIComponent(search_input);
// Youtube API 
var yt_url='http://gdata.youtube.com/feeds/api/videos?q='+keyword+'&format=5&max-results=6&v=2&alt=jsonc';

$.ajax({
	type: "GET",
	url: yt_url,
	dataType:"jsonp",
	success: function(response)
		{

			if(response.data.items)
			{
				var final = "<div class='row-fluid'>";
				var count  = 0;
				$.each(response.data.items, function(i,data)
				{
				count = count +1;
				var video_id=data.id;
				var video_title=data.title;
				var video_viewCount=data.viewCount;
				// IFRAME Embed for YouTube
				var video_frame="<iframe width='100%' height='200' src='http://www.youtube.com/embed/"+video_id+"' frameborder='0' type='text/html'></iframe>";
				if (count == 3 || count == 5){
					final+= "</div><div class='row-fluid'>";
				}
				final+= " <div class='span6'>"+video_frame+"</div>";


				});
				final+= "</div>";
				$("#youtubes").html(final); // Result

			}
			else
			{
				$("#youtubes").html("<div id='no'>No Video</div>");
			}

		}
});

});

