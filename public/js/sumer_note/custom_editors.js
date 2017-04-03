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
});