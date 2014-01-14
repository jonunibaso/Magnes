$("#artist").typeahead({
    minLength: 3,
    source: function(query, process) {

        $.post(CI.base_url+'artist/search', {q: query, limit: 8 }, function(data) {

                 objects = []; // going to browser
                 map = {}; // storing for later
                 $.each(data, function(i, entity) {
                    map[entity.artist_name] = entity;
                    objects.push(entity.artist_name);
                });
                 return process(objects);


             },"json");

    },
    updater: function (item) {
            // update hidden field with ID
            $('#artist').val(map[item].id);
            

            return item;
        }
    });

$("#img_url").focusout(function() {

    iurl =  $("#img_url").val();

    $("<img>", {
        src: iurl,
        error: function() { 
            $("#validated_img_url").val(''); 
            $("#img_url_container").html("");

        },
        load: function() { 
           $("#img_url_container").html("<img width='200' src='"+iurl+"' />");
           $("#validated_img_url").val(iurl);
       }
   });


});

$(function () {
    var $wizard = $('#fuelux-wizard'),
    $btnPrev = $('.wizard-actions .btn-prev'),
    $btnNext = $('.wizard-actions .btn-next'),
    $btnFinish = $(".wizard-actions .btn-finish");

    $wizard.wizard().on('finished', function(e) {
                // wizard complete code
            }).on("changed", function(e) {
                var step = $wizard.wizard("selectedItem");
                // reset states
                $btnNext.removeAttr("disabled");
                $btnPrev.removeAttr("disabled");
                $btnNext.show();
                $btnFinish.hide();

                if (step.step === 1) {
                    $btnPrev.attr("disabled", "disabled");
                } else if (step.step === 4) {
                    $btnNext.hide();
                    $btnFinish.show();
                }
            });

            $btnPrev.on('click', function() {
                $wizard.wizard('previous');
            });
            $btnNext.on('click', function() {
                $wizard.wizard('next');
            });

            $('.date-picker').datepicker( {
                format: " yyyy",
                viewMode: "years", 
                minViewMode: "years"
            });

        });