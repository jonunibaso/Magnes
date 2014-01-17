
      $('.date-picker').datepicker( {
                format: " yyyy",
                viewMode: "years", 
                minViewMode: "years"
            });

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