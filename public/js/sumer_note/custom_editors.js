/**
 * Created by nicof on 21/03/2017.
 */
$(document).ready(function() {
    //Local vars
    var $gratuit=$('#gratuit');
    var startDate = $('#dataInici');
    var finalDate = $('#dataFinal');
    var $tags = $('#tags');
    var date =new Date($.now());

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
    var current_date=((date.getYear()+1900)+ '-' + ("0" + (date.getMonth() + 1)).slice(-2) + '-' + date.getDate()).toString();
    startDate.attr('value', current_date);
    finalDate.attr('value', current_date);

    //When Start Date changes min value in Final date change to startDate value
    startDate.change(function() {
        $('#dataFinal').attr('min',$(this).val())
    });

    //When gratuit field is on deactivate presus fields
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

    //When tags field change search for tipped coincidences with returned from url
    $tags.on('keyup paste',function(){
        $.ajax({
            url: "autocomplete?term=" + $tags.val(),
            success: function(result) {
                console.log(typeof result);
                $('#autocomplete option').remove();
                $.each( result, function( i, val ) {
                    $('#autocomplete').append('<option value="' + val +'">');
                });
            }
        });
    });
});