/**
 * Created by nicof on 21/03/2017.
 */
$(document).ready(function() {
    //Local vars
    var $gratuit=$('#gratuit');
    var startDate = $('#dataInici');
    var finalDate = $('#dataFinal');
    var $tags = $('#tags');
    var $allTags;
    var $tagSelected = $('.tagDelete');
    var date =new Date($.now());
    var tagNameId = 0;
    var $addTag = $('.addTag');
    var $boxOfTags = $('#boxOfTags');
    var $videoInput = $('#videoInput');
    var $videoBox = $('#videoBox');
    var videoType;
    $videoBox.innerHeight(($videoBox.innerWidth()*2)/3);


    //Summer Note script
    $('.summernote').each(function(i, obj) {
        var altura = 200;
        var tool_tips = [
            ["style", ["style"]],
            ["font", ["bold", "underline", "clear"]],
            ["fontname", ["fontname"]],
            ["color", ["color"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["table", ["table"]],
            ["insert", ["link"
                //  ,"picture", "video"
            ]],
            ["view", ["fullscreen", "codeview", "help"]]];
        if (obj.name == 'descBreu'){
            altura = 100;
            tool_tips = [
                ["style", ["style"]],
                ["font", ["bold", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ["color", ["color"]],
                ["para", ["paragraph"]],
                ["insert", ["link"]],
                ["view", ["fullscreen", "codeview", "help"]]
            ]
        }
        $(obj).summernote({
            onblur: function(e) {
                var id = $(obj).data('id');
                var sHTML = $(obj).code();
                alert(sHTML);
            },
            height: altura,
            lang: 'es-ES',
            toolbar: tool_tips
        });
    });

    //Assing current Date to Date start end fields
    var dia = date.getDate();
    if (dia < 10){
        dia  = ('0' + dia).toString();
    }
    var current_date=((date.getYear()+1900)+ '-' + ("0" + (date.getMonth() + 1)).slice(-2) + '-' + dia).toString();
    startDate.attr('value', current_date);
    finalDate.attr('value', current_date);

    //When Start Date changes min value in Final date change to startDate value
    startDate.change(function() {
        finalDate.attr('min',$(this).val());
        finalDate.attr('min',$(this).val());
    });

    //When gratuit field is on, deactivate presus fields
    $gratuit.change(function () {
        var attr = $gratuit.attr( "checked" );
        if ( $gratuit.attr( "value" ) !== "false") {
            $gratuit.attr('value', false);
            $('#preuInferior').attr('readonly', true);
            $('#preuSuperior').attr('readonly', true);
        }else{
            $gratuit.attr('value', true);
            $('#preuInferior').removeAttr('readonly');
            $('#preuSuperior').removeAttr('readonly');
        }
    });

    // Age multiselect script library
    $('#multipleage').multiSelect();

    //Add tags and
    $.ajax({
        url: "autocomplete",
        success: function(result) {
            $allTags = result;
        }
    });

    //When typing in tags field jump this function for auto-complete drop down list
    $tags.on('keyup paste',function(){
        $('#autocomplete option').remove();
        if ($tags.val().length > 2){
            var count = 0;
            $.each( $allTags, function( i, val ) {
                var pass = val.indexOf($tags.val())>=0;
                if(pass){
                    if (count < 5) {
                        $('#autocomplete').append('<option value="' + val + '">');
                        count ++;
                    }
                }
            });
        }
    });
    //Delete clicked tag and add the deleted tag to the list
    $(document).on('click', '.tagDelete', function(){
        var name = $(this).attr("name");
        $allTags.push($(this).attr("value"));
        $('.tagDelete[name="'+ name +'"]').remove();
    });
    //Close alert deleting it
    $(document).on('click', '.closeAlert', function(){
        $(this).parent().parent().remove();
    });
    $addTag.on('click', function () {
        var inputValues = [];
        $boxOfTags.find(".tagDelete").each(function (data, value) {
            inputValues.push(value.value)
        });
        if (inputValues.length < 1 || !(inputValues.indexOf($tags.val()) >= 0) ){
            if ($tags.val().length >= 3){
                $boxOfTags.append('<input type="text" name="tag'+ tagNameId +'"'+
                    ' class="btn btn-primary btn-xs tagDelete" value="'+ $tags.val() +'"'+' ' +
                    'style="max-width: '+ (($tags.val().length+1)*8)+'px"'+
                    ' readonly>');
                var index = $allTags.indexOf($tags.val());
                if ( index > -1) {
                    $allTags.splice(index, 1);
                }
                $('#errorAdd').hide();
            }else{
                bootstrap_alert('Introduce un tag de mas de 2 caracteres.', 'danger', $boxOfTags);
            }
        }else {
            bootstrap_alert('Ya has introducido ese tag.', 'danger', $boxOfTags.parent());
        }
            tagNameId ++;
    });
    var bootstrap_alert = function (message, type, where) {
        where.after('<div class="form-group row">' +
                        '<div id="errorAdd" class="alert alert-' + type + ' col-md-4 col-md-offset-3">' +
                            message + '<button type="button" class="btn btn-default btn-xs glyphicon glyphicon-remove closeAlert"></button>' +
                    '</div> </div>')
    };
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function(){
            /* Toggle between adding and removing the "active" class,
             to highlight the button that controls the panel */
            this.classList.toggle("active");

            /* Toggle between hiding and showing the active panel */
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        }
    }
    $(document).on('change', '#selectFormat', function(){// $videoInput  $videoBox
        var $videoRecurs = $('#videoRecurs');
        console.log($("option:selected", this).val());
        $videoInput.find('div').remove();
        if ($("option:selected", this).val() === '1'){//upload
            console.log($(this).val());
            $videoInput.append('<div class="col-sm-10"><input id="videoRecurs" name="videoRecurs" type="file"></div>');
        }else if ($("option:selected", this).val() === '2'){//embed
            videoType = 2;
            $videoInput.append('<div class="col-sm-10"><textarea class="form-control" placeholder="Inserta el codigo enbed del video." '+
                'rows="5" cols="60" name="videoRecurs" id="videoRecurs"></textarea></div>' +
                '<div class="col-md-2"> <button type="button" id="testVideoButton" class="btn addTag">Test</button></div>');
            console.log('es 2 o 3');
        }else if (($("option:selected", this).val() === '3')) {//link
            videoType = 3;
            $videoInput.append('<div class="col-sm-10"><input type="text" id="videoRecurs" name="videoRecurs" '+
                'placeholder="Escribe el link del video" class="form-control col-sm-3"></div>' +
            '<div class="col-md-2"> <button type="button" id="testVideoButton" class="btn addTag">Test</button></div>');
            console.log('else');
        }
    });
    $(document).on('click', '#testVideoButton', function(){
        $videoBox.children().remove();
        var $videoRecurs = $('#videoRecurs');
        var videourl = $videoRecurs.val();
        var videoId;
        var src = null;

        if (videoType === 3){
            if (videourl.indexOf('youtube') >= 0 && videourl.indexOf('v=') > 6){
                if (videourl.indexOf('&') >= 0){
                    videoId = videourl.substring(videourl.indexOf('v=')+2, videourl.indexOf('&'));
                }else{
                    videoId = videourl.substring(videourl.indexOf('v=')+2);
                }
                src = "https://www.youtube.com/embed/" + videoId;
                $videoBox.append('<iframe width="'+ $videoBox.width() + '" height="' + $videoBox.height() +
                    '" src="https://www.youtube.com/embed/' + videoId +
                    '" frameborder="0" allowfullscreen></iframe>');
                $('#errorAdd').hide();
            }else if (videourl.indexOf('vimeo') >= 0){//https://vimeo.com/211265585
                videoId = videourl.substring(videourl.indexOf('com/')+4);
                src = "https://player.vimeo.com/video/" + videoId;
                $videoBox.append('<iframe width="'+ $videoBox.width() + '" height="' + $videoBox.height() +
                    '" src="https://player.vimeo.com/video/' + videoId +
                    '" frameborder="0" allowfullscreen></iframe>');
                $('#errorAdd').hide();
            }else {
                $('#errorAdd').hide();
                bootstrap_alert('El enlace no es valido asegurate que el video es de youtube o vimeo', 'danger', $videoBox);
            }
        }else{
            if((videourl.indexOf('src="')+4) >0) {
                src = videourl.substring(videourl.indexOf('src="')+4);
                src = src.substring(1, src.indexOf(' ')-1);
                $videoBox.append('<iframe width="'+ $videoBox.width() + '" height="' + $videoBox.height() +
                    '" src="' + src +
                    '" frameborder="0" allowfullscreen></iframe>');
                $('#errorAdd').hide();
            }else{
                $('#errorAdd').hide();
                bootstrap_alert('Iframe no válido.', 'danger', $videoBox)
            }
        }
        $videoBox.append('<input type="text" value="'+src+'" name="videoembed" hidden>')
    });
    $(window).resize(function() {
        var $videoSize = $('iframe');
        $videoBox.innerHeight(($videoBox.innerWidth()*2)/3);
        $videoSize.width($videoBox.width());
        $videoSize.height($videoBox.height());
    });

    function isUrlValid(url) {
        return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
    }

});