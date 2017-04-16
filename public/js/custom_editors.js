/**
 * Created by nicof on 21/03/2017.
 */
$(document).ready(function() {
    //Local vars
    var urlAutocomplete = document.location.origin + "/admin/recursos/autocomplete";
    var $gratuit=$('#gratuit');
    var $preuInferior=$('#preuInferior');
    var $preuSuperior=$('#preuSuperior');
    var startDate = $('#dataInici');
    var $finalDate = $('#dataFinal');
    var $tags = $('#tags');
    var allTags;
    // var $tagSelected = $('.tagDelete');
    // var date = new Date($.now());
    var tagNameId = 0;
    var $addTag = $('.addTag');
    var $boxOfTags = $('#boxOfTags');
    var $videoInput = $('#videoInput');
    var videoType;
    var $videoslider = $('#video_slider');
    var videoembedN = $('#slider-video-wrapper').children('input').length;
    var $imageslider = $('#image_slider');
    var imgN = $imageslider.children('img').length;


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
        if (obj.name === 'descBreu'){
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
    // var dia = date.getDate();
    // if (dia < 10){
    //     dia  = ('0' + dia).toString();
    // }
    // var current_date=((date.getYear()+1900)+ '-' + ("0" + (date.getMonth() + 1)).slice(-2) + '-' + dia).toString();
    // startDate.attr('value', current_date);
    // $finalDate.attr('value', current_date);

    //When Start Date changes min value in Final date change to startDate value
    startDate.change(function() {
        $finalDate.attr('min',$(this).val());
        var d1=new Date(startDate.val());
        var d2=new Date($finalDate.val());
        if (d1.getTime() > d2.getTime()){
            $finalDate.val($(this).val());
        }
    });

    //Apply default value to preus
    if ( $gratuit.attr( "value" ) !== "false") {
        $preuInferior.attr('readonly', true);
        $preuSuperior.attr('readonly', true);
    }else{
        $preuSuperior.removeAttr('readonly');
        $preuInferior.removeAttr('readonly');
    }
    //When gratuit field is on, deactivate presus fields
    $gratuit.change(function () {
        if ( $gratuit.attr( "value" ) !== "false") {
            $gratuit.attr('value', false);
            $preuInferior.removeAttr('readonly');
            $preuSuperior.removeAttr('readonly');
        }else{
            $gratuit.attr('value', true);
            $preuInferior.attr('readonly', true);
            $preuSuperior.attr('readonly', true);
        }
    });

    //Check if preu superiro allways is superior and also preu inferior is less than preu superior
    $preuInferior.on('change',function(){
        $('#errorAdd').hide();
        if (parseInt($preuInferior.val()) < parseInt($preuSuperior.val())){
            bootstrap_alert('El Preu inferior a de ser mes de  '+
                $preuSuperior.val() + '&euro;', 'warning', $('#error_preus'))
        }
    });
    $preuSuperior.on('change',function(){
        $('#errorAdd').hide();
        if (parseInt($preuInferior.val()) < parseInt($preuSuperior.val())){
            bootstrap_alert('El Preu mes alt a de ser menys de  '+
                $preuInferior.val()+'&euro;', 'warning', $('#error_preus'))
        }
    });
    // Age multiselect script library
    $('#multipleage').multiSelect();

    //Add tags
    $.ajax({
        url: urlAutocomplete,
        success: function(result) {
            allTags = result;
        }
    });

    //When typing in tags field jump this function for auto-complete drop down list
    $tags.on('keyup paste',function(){
        $('#autocomplete option').remove();
        if ($tags.val().length > 2){
            var count = 0;
            $.each( allTags, function( i, val ) {
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
        if (allTags.indexOf($(this).val()) === -1) {
            allTags.push($(this).attr("value"));
        }
        $('.tagDelete[name="'+ name +'"]').remove();
    });
    //Close alert deleting it
    $(document).on('click', '.closeAlert', function(){
        $(this).parent().parent().remove();
    });
    $addTag.on('click', function () {
        tagNameId = $boxOfTags.find('input').length;
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
                var index = allTags.indexOf($tags.val());
                if ( index > -1) {
                    allTags.splice(index, 1);
                }
                $('#errorAdd').hide();
            }else{
                bootstrap_alert('Introduce un tag de mas de 2 caracteres.', 'danger', $boxOfTags);
            }
        }else {
            bootstrap_alert('Ya has introducido ese tag.', 'danger', $boxOfTags.parent());
        }
    });
    var bootstrap_alert = function (message, type, where) {
        where.after('<div class="form-group row">' +
                        '<div id="errorAdd" class="alert alert-' + type + ' col-md-4 col-md-offset-3">' +
                            message + '<button type="button" class="btn btn-default btn-xs glyphicon glyphicon-remove closeAlert"></button>' +
                    '</div> </div>')
    };

    $(document).on('change', '#selectFormat', function(){// $videoInput  $videoslider

        $videoInput.find('div').remove();
        if ($("option:selected", this).val() === '1'){//upload
            $videoInput.append('<div class="col-sm-10"><input id="videoRecurs" name="videoRecurs" type="file"></div>');
        }else if ($("option:selected", this).val() === '2'){//embed
            videoType = 2;
            $videoInput.append('<div class="col-sm-10"><textarea class="form-control" placeholder="Inserta el codigo enbed del video." '+
                'rows="5" cols="60" name="videoRecurs" id="videoRecurs"></textarea></div>' +
                '<div class="col-md-2"> <button type="button" id="addVideoButton" class="btn addTag">Add</button></div>');
        }else if (($("option:selected", this).val() === '3')) {//link
            videoType = 3;
            $videoInput.append('<div class="col-sm-10"><input type="text" id="videoRecurs" name="videoRecurs" '+
                'placeholder="Escribe el link del video" class="form-control col-sm-3"></div>' +
            '<div class="col-md-2"> <button type="button" id="addVideoButton" class="btn addTag">Add</button></div>');
        }
    });
    $(document).on('click', '#addVideoButton', function(){
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
                $('#errorAdd').hide();
            }else if (videourl.indexOf('vimeo') >= 0){//https://vimeo.com/211265585
                videoId = videourl.substring(videourl.indexOf('com/')+4);
                src = "https://player.vimeo.com/video/" + videoId;
                $('#errorAdd').hide();
            }else {
                $('#errorAdd').hide();
                bootstrap_alert('El enlace no es valido asegurate que el video es de youtube o vimeo', 'danger', $videoslider);
            }
        }else{
            if((videourl.indexOf('src="')+4) >0) {
                src = videourl.substring(videourl.indexOf('src="')+4);
                src = src.substring(1, src.indexOf(' ')-1);
                $('#errorAdd').hide();
            }else{
                $('#errorAdd').hide();
                bootstrap_alert('Iframe no válido.', 'danger', $videoslider)
            }
        }
        addInSlider(src);
        $('#slider-video-wrapper').append('<input type="text" class="none" value="'+src+'" name="video' + videoembedN + '" hidden>');
        videoembedN++;
    });

    var $videoSize = $('iframe');
    var $imgSize = $('.img_slider');
    $videoslider.innerHeight(($videoslider.innerWidth()*2)/3);
    $imageslider.innerHeight(($videoslider.innerWidth()*2)/3);
    $videoSize.width($videoslider.width());
    $videoSize.height($videoslider.height());
    $imgSize.width($videoslider.width());
    $imgSize.height($videoslider.height());
    $(window).resize(function() {
        var $videoSize = $('iframe');
        $videoslider.innerHeight(($videoslider.innerWidth()*2)/3);
        $imageslider.innerHeight(($videoslider.innerWidth()*2)/3);
        $videoSize.width($videoslider.width());
        $videoSize.height($videoslider.height());
        $imgSize.width($videoslider.width());
        $imgSize.height($videoslider.height());
    });

    //before do submit
    $('#recurs_form').submit(function() {
        $('#errorAdd').parent().remove();
        if ($preuInferior.val() === '' && $preuSuperior.val() === ''){
            if ($gratuit.attr('value') === 'false'){
                bootstrap_alert('Se ha de especificar si el recurso es gratuito o especificar un precio mayor o menor.',
                    'danger', $('#error_submit'));
                return false;
            }
        }
        return true; // return false to cancel form action
    });

    //Add in video carousel
    var addInSlider = function (src) {
        $('.old_video_active').removeClass('old_video_active');
        $('.video_active').removeClass('video_active');
        $('#video_slider').append('<iframe name="video' + videoembedN + '" width="'+ $videoslider.width() + '" height="' + $videoslider.height() + '"'+
            ' class="slider_item video_active" src="' + src + '"></iframe>');
        $('.slider_item').fadeOut(0);
        $('.video_active').fadeIn(0);
    };

    //Slider Video init slider, and previous and next functions
    $('.slider_item').first().addClass('video_active');
    $('.slider_item').hide();
    $('.video_active').show();

    $('#button-next').click(function(){

        $('.video_active').removeClass('video_active').addClass('old_video_active');
        if ( $('.old_video_active').is(':last-child')) {
            $('.slider_item').first().addClass('video_active');
        }
        else{
            $('.old_video_active').next().addClass('video_active');
        }
        $('.old_video_active').removeClass('old_video_active');
        $('.slider_item').fadeOut(0);
        $('.video_active').fadeIn(0);
    });

    $('#button-previous').click(function(){
        $('.video_active').removeClass('video_active').addClass('old_video_active');
        if ( $('.old_video_active').is(':first-child')) {
            $('.slider_item').last().addClass('video_active');
        }
        else{
            $('.old_video_active').prev().addClass('video_active');
        }
        $('.old_video_active').removeClass('old_video_active');
        $('.slider_item').fadeOut(0);
        $('.video_active').fadeIn(0);
    });

    //Delet video from Video Slider
    $(document).on('click', '#button-delete-video', function(){
        $('.video_active').removeClass('video_active').addClass('old_video_active');
        if ( $('.old_video_active').is(':last-child')) {
            $('.slider_item').first().addClass('video_active');
        }
        else{
            $('.old_video_active').next().addClass('video_active');
        }
        var name = $('.old_video_active').attr('name');
        if (name == null){
            var name = $('.video_active').attr('name');
        }
        $('iframe[name="'+ name +'"]').remove();
        $('input[name="'+ name +'"]').remove();
        $('.slider_item').fadeOut(0);
        $('.video_active').fadeIn(0);
    });

    //Image slider init slider, and previous and next functions
    $('.img_slider').first().addClass('img_active');
    $('.img_slider').hide();
    $('.img_active').show();

    $('#image_button-next').click(function(){

        $('.img_active').removeClass('img_active').addClass('old_img_active');
        if ( $('.old_img_active').is(':last-child')) {
            $('.img_slider').first().addClass('img_active');
        }
        else{
            $('.old_img_active').next().addClass('img_active');
        }
        $('.old_img_active').removeClass('old_img_active');
        $('.img_slider').fadeOut(0);
        $('.img_active').fadeIn(0);
    });

    $('#image_button-previous').click(function(){
        $('.img_active').removeClass('img_active').addClass('old_img_active');
        if ( $('.old_img_active').is(':first-child')) {
            $('.img_slider').last().addClass('img_active');
        }
        else{
            $('.old_img_active').prev().addClass('img_active');
        }
        $('.old_img_active').removeClass('old_img_active');
        $('.img_slider').fadeOut(0);
        $('.img_active').fadeIn(0);
    });

    $(document).on('change', '.image_upload', function(){
        var $inputimage = $('.image_upload');
        if (this.files && this.files[0]) {
            $inputimage.addClass('image' + imgN);
            $inputimage.hide();
            $inputimage.attr('name','image' + imgN).removeClass('image_upload');
            $('.old_img_active').removeClass('old_img_active');
            $('.img_active').removeClass('img_active');
            var reader = new FileReader();
            reader.onload = function (e) {
                $imageslider.append('<img name="image' + imgN + '" width="'+ $imageslider.width() +
                    '" height="' + $imageslider.height() + '" alt="imagen"'+
                    ' class="img_slider img_active" src="' + e.target.result + '"/>');
                imgN++;
            };
            $('.images').append('<input type="file" name="" class="image_upload"/>');
            $('.img_slider').fadeOut(0);
            $('.img_active').fadeIn(0);
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    //Delete image
    $(document).on('click', '#image_button-delete', function(){
        $('.img_active').removeClass('img_active').addClass('old_img_active');
        if ( $('.old_img_active').is(':last-child')) {
            $('.img_slider').first().addClass('img_active');
        }
        else{
            $('.old_img_active').next().addClass('img_active');
        }
        var name = $('.old_img_active').attr('name');
        if (name == null){
            var name = $('.img_active').attr('name');
        }
        $('img[name="'+ name +'"]').remove();
        $('input[class="'+ name +'"]').remove();
        $('.slider_item').fadeOut(0);
        $('.img_active').fadeIn(0);
    });
});

