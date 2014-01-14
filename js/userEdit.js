$.pnotify.defaults.history = false;

function closeDialog () {
  $('#newListModal').modal('hide'); 
};

function okClicked () {

  ln = document.getElementById ("xlInput").value;
  $.ajax({
    url:  CI.base_url+"user/createList",
    type:'POST',
    data: { name: ln },
    success: function(out_id){

      new_link = "<tr><td><a href='"+ out_id +"' target='_blank'>"+ ln + "</a>";
      new_link +=  "</td><td>0</td>";
      new_link +=  "<td>0</td>";
      new_link +=  "<td><a class='btn-glow'><i class='icon-eye-open'></i>";
      new_link += "View</a></td>";
      new_link += "</tr>";
      $('#lists_table').append(new_link);
      closeDialog ();
    } 
  });
};

$('#changeAvatarBtn').on('click', function()
{
 $('#changeAvatarBtn').fadeOut('slow', function(){
  $('#imageform').fadeIn('slow');
});
});

$('#changeBioBtn').on('click', function()
{
 $('#bio').fadeOut('slow', function(){
  $('#bioEdit').fadeIn('slow');
});
 $('#changeBioBtn').fadeOut('slow', function(){
  $('#editBio').fadeIn('slow');
});
});

$('#cancelBioBtn').on('click', function()
{
 $('#bioEdit').fadeOut('slow', function(){
  $('#bio').fadeIn('slow');
});
 $('#editBio').fadeOut('slow', function(){
  $('#changeBioBtn').fadeIn('slow');
});
});

$('#saveBioBtn').on('click', function()
{
  newBio = $('#nb').val();

  $.ajax({
    url:  CI.base_url+"user/ajaxbio",
    type:'POST',
    data: { nb: newBio },
    success: function(output_string){
      $('#bio').html(newBio);
      $('#bioEdit').fadeOut('slow', function(){
        $('#bio').fadeIn('slow');
      });
      $('#editBio').fadeOut('slow', function(){
        $('#changeBioBtn').fadeIn('slow');
      });
    } 
  });

});


$('#photoimg').on('change', function()
{
  $("#avatarImg").html('loading...');
  $("#avatarImg").html('<img src="'+CI.base_url+'img/loader.gif" alt="Uploading...."/>');

  $("#imageform").ajaxForm({
    success: newImage,
    target: '#avatarImg'
  }).submit();

});

function newImage(responseText, statusText, xhr, $form) {

  if( responseText.indexOf("<img") === -1 ){
    alert(responseText);
    $("#avatarImg").html('<img src="'+CI.base_url+'img/contact-img.png" class="avatar img-circle" />');

    $.pnotify({
      title: 'Error!',
      text: responseText ,
      type: 'error',
      opacity: .9
    });
  }else{
    $('#imageform').fadeOut('slow', function(){
      $('#changeAvatarBtn').fadeIn('slow');
    });
  }

}