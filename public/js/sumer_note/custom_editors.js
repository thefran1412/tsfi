/**
 * Created by nicof on 21/03/2017.
 */
$(document).ready(function() {
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
    var startDate = $('#dataInici');
    var finalDate = $('#dataFinal');
    var date =new Date($.now());
    var current_date=((date.getYear()+1900)+ '-' + ("0" + (date.getMonth() + 1)).slice(-2) + '-' + date.getDate()).toString();
    startDate.attr('value', current_date);
    finalDate.attr('value', current_date);

    startDate.change(function() {
        $('#dataFinal').attr('min',$(this).val())
    });
    var $gratuit=$('#id_gratuit');
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
});