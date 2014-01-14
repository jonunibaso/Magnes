 $('#toggleFavLabelBtn').on('click', function()
 {

  $.ajax({
    url:  CI.base_url+"label/toggleFav",
    type:'POST',
    data: { slug: $('#label_slug').val() },
    success: function(output_string){
      txt = $('#toggleFavLabelBtn').html();
      if(txt.indexOf('Add')>0){
        $('#toggleFavLabelBtn').html('<i class="icon-star"></i>Favorite');
        $('#toggleFavLabelBtn').addClass("active");
      }else{
        $('#toggleFavLabelBtn').html('<i class="icon-star"></i>Add Favorites');
        $('#toggleFavLabelBtn').removeClass("active");

      }
    } 
  });
 
});