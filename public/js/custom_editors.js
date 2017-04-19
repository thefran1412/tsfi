/**
 * Created by nicof on 21/03/2017.
 */

// fix date validation for chrome

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
    var $podcast_box = $('#podcast_preview');
    var podcastN = $podcast_box.children('iframe').length;
    var imgN = $imageslider.children('img').length;
    var $podcast_preview = $('#podcast_preview');


    //Assing current Date to Date start end fields
    // var dia = date.getDate();
    // if (dia < 10){
    //     dia  = ('0' + dia).toString();
    // }
    // var current_date=((date.getYear()+1900)+ '-' + ("0" + (date.getMonth() + 1)).slice(-2) + '-' + dia).toString();
    // startDate.attr('value', current_date);
    // $finalDate.attr('value', current_date);

    $('#dataInici').datetimepicker({
        format: "yyyy-mm-dd  hh:ii",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left",
        todayHighlight: true,
        keyboardNavigation: true,
        startDate: new Date()
    });
    $('#dataFinal').datetimepicker({
        format: "yyyy-mm-dd  hh:ii",
        autoclose: true,
        todayBtn: true,
        pickerPosition: "bottom-left",
        todayHighlight: true,
        keyboardNavigation: true,
        startDate: new Date()
    });
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
            if((videourl.indexOf('src=')+5) >0) {
                src = videourl.substring(videourl.indexOf('src=')+5);
                if (src.match('/."./')){
                    src = src.substring(0, src.indexOf('"'));
                }else if (src.match('/.*\'.*/')){
                    src = src.substring(0, src.indexOf('\''));
                }
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
    $podcast_box.innerHeight(($videoslider.innerWidth()*2)/3);
    $videoSize.width($videoslider.width());
    $videoSize.height($videoslider.height());
    $imgSize.width($imageslider.width());
    $imgSize.height($imageslider.height());
    $(window).resize(function() {
        var $videoSize = $('iframe');
        var $imgSize = $('.img_slider');
        $videoslider.innerHeight(($videoslider.innerWidth()*2)/3);
        $imageslider.innerHeight(($videoslider.innerWidth()*2)/3);
        $podcast_box.innerHeight(($videoslider.innerWidth()*2)/3);
        $videoSize.width($videoslider.width());
        $videoSize.height($videoslider.height());
        $imgSize.width($videoslider.width());
        $imgSize.height($videoslider.height());
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
    $(document).on('click', '#deletevideo', function(){
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
        $('#errorAdd').hide();
        var maxSize = 2097190;
        var img_types = ['jpg','png','jpge'];
        var $inputimage = $('.image_upload');
        if (this.files && this.files[0]) {
            var fileSize = this.files[0].size;
            var filetype = this.files[0].type;
            if(filetype.indexOf('image') === -1){
                bootstrap_alert('El fitxer ha de ser una imatge.', 'danger', $('.images'));
                return false;
            }else{
                if (fileSize<maxSize){
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
                }else{
                    bootstrap_alert('El tamany de la imatge es mes gran que ' + parseInt(maxSize/1000000) + 'MB.', 'danger', $('.images'));
                }
            }
        }
    });

    $(document).on('change', '#fotoResum', function(){
        $('#errorAdd').hide();
        $('.currentfotoresum').children().remove();
        var maxSize = 5242880;
        // var maxSize = 2097190;
        var img_types = ['jpg','png','jpge'];
        var $inputimage = $('#fotoResum');
        if (this.files && this.files[0]) {
            var fileSize = this.files[0].size;
            var filetype = this.files[0].type;
            if(filetype.indexOf('image') === -1){
                bootstrap_alert('El fitxer ha de ser una imatge.', 'danger', $('.currentfotoresum'));
                return false;
            }else{
                if (fileSize<maxSize){
                    var reader = new FileReader();
                    reader.onload = function (e) {// <input type="text" value="{{ $image->titolImatge }}" name="delimageresource" class="image{{ $key }}" style="display: none;">
                        $('.currentfotoresum').append('<img name="delimageresource" width="250" height="180" alt="imagen"'+
                            ' class="previousimgresource" src="' + e.target.result + '"/>');
                        imgN++;
                    };
                    reader.readAsDataURL(this.files[0]);
                }else{
                    bootstrap_alert('El tamany de la imatge es mes gran que ' + parseInt(maxSize/1000000) + 'MB.', 'danger', $('.currentfotoresum'));
                }
            }
        }
    });
    
    //Delete image
    $(document).on('click', '#imagedelete', function(){
        $('#errorAdd').hide();
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
        $('.img_slider').fadeOut(0);
        $('.img_active').fadeIn(0);
    });

    $(document).on('click', '.addPodcast', function () {
        var podcasturl = $('#addpodcast').val();
        if (podcasturl.indexOf('iframe')){
            podcasturl = podcasturl.substring(podcasturl.indexOf('iframe')+6);
            podcasturl = podcasturl.substring(0, podcasturl.indexOf('iframe'));
            if((podcasturl.indexOf('src=')) >0) {
                src = podcasturl.substring(podcasturl.indexOf('src=') + 5);
                if (src.match('/.*".*/')) {
                    src = src.substring(0, src.indexOf('"'));
                } else if (src.match('/.*\'.*/')) {
                    src = src.substring(0, src.indexOf('\''));
                } else {
                    src = src.substring(0, src.indexOf(' ') - 2);
                }
                addInPodcastpodcast(src);
                $('#errorAdd').hide();
            }
        }else {
            $('#errorAdd').hide();
            bootstrap_alert('Iframe no válido.', 'danger', $podcast_preview)
        }
    });
    var addInPodcastpodcast = function (src) {
        $('.old_podcast_active').removeClass('old_podcast_active');
        $('.podcast_active').removeClass('podcast_active');
        $('#podcast_preview').append('<iframe width="' + $podcast_box.width() + '" height="' + $podcast_box.height()
            + '" src="' + src + '" name="podcast' + podcastN + '" class="podcast_item podcast_active"></iframe>');
        $('#slider_podcast_wrapper').append('<input name="podcast' + podcastN + '" value="' + src + '" hidden/>');
        $('.podcast_item').fadeOut(0);
        $('.podcast_active').fadeIn(0);
        podcastN++;
    };

    //Slider podcast init podcast, and previous and next functions
    $('.podcast_item').first().addClass('podcast_active');
    $('.podcast_item').hide();
    $('.podcast_active').show();

    $('#podcast_next').click(function(){
        $('.podcast_active').removeClass('podcast_active').addClass('old_podcast_active');
        if ( $('.old_podcast_active').is(':last-child')) {
            $('.podcast_item').first().addClass('podcast_active');
        }
        else{
            $('.old_podcast_active').next().addClass('podcast_active');
        }
        $('.old_podcast_active').removeClass('old_podcast_active');
        $('.podcast_item').fadeOut(0);
        $('.podcast_active').fadeIn(0);
    });

    $('#podcast_previous').click(function(){
        $('.podcast_active').removeClass('podcast_active').addClass('old_podcast_active');
        if ( $('.old_podcast_active').is(':first-child')) {
            $('.podcast_item').last().addClass('podcast_active');
        }
        else{
            $('.old_podcast_active').prev().addClass('podcast_active');
        }
        $('.old_podcast_active').removeClass('old_podcast_active');
        $('.podcast_item').fadeOut(0);
        $('.podcast_active').fadeIn(0);
    });

    //Delet podcast from podcast podcast
    $(document).on('click', '#podcastdelete', function(){
        $('.podcast_active').removeClass('podcast_active').addClass('old_podcast_active');
        if ( $('.old_podcast_active').is(':last-child')) {
            $('.podcast_item').first().addClass('podcast_active');
        }
        else{
            $('.old_podcast_active').next().addClass('podcast_active');
        }
        var name = $('.old_podcast_active').attr('name');
        if (name == null){
            var name = $('.podcast_active').attr('name');
        }
        $('iframe[name="'+ name +'"]').remove();
        $('input[name="'+ name +'"]').remove();
        $('.podcast_item').fadeOut(0);
        $('.podcast_active').fadeIn(0);
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
});

