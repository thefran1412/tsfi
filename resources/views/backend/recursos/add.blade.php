@extends('layouts.backend')
@section('css')
    <link href="{{ URL::asset('/js/sumer_note/summernote.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/backend/extra.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/multi-select.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/backend/resourceadd.css') }}" rel="stylesheet">

@endsection

@section('titol')
    <i class="fa fa-angle-right"></i>
    <a href="{{ action('backend\Recursos@index') }}">Recursos</a>
    <i class="fa fa-angle-right"></i>
    <a href="{{ action('backend\Recursos@add') }}">Afegir</a>
@endsection

@section('content')

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row justify-content-lg-center text-center">
                    <h2>Edita el recurso </h2>
                </div>
            </div>
        </div>
        @include('partials.errors')
        {!! Form::open(array('route' => 'resource_store', 'class' => 'form', 'files' => true)) !!}
        <div class="form-group row">
            {!! Form::label('titolRecurs', 'Título del Recurso', ['class'=>'control-label col-sm-2']) !!}
            <div class="col-sm-8">
                {!! Form::text('titolRecurs', null,['required', 'class'=>'form-control']) !!}<br>
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('creatPer', 'Autor del Recurso', ['class'=>'control-label col-sm-2']) !!}
            <div class="col-sm-4">
                {!! Form::text('creatPer', null, ['class'=>'form-control']) !!}<br>
            </div>
        </div>

        <div class="form-group row">
            {!! Form::label('subTitol', 'Subtítulo:', ['class'=>'control-label col-sm-2']) !!}
            <div class="col-sm-4">
                {!! Form::text('subTitol', null, ['class'=>'form-control']) !!}<br>
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('descBreu', 'Descripción breve',
                    array('class'=>'control-label col-sm-2')) !!}
            <div class="col-sm-8">
                {!! Form::textarea('descBreu', null, ['class'=>'form-control input-sm summernote']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('descDetaill1', 'Descripción detallada 1', ['class'=>'control-label col-sm-2']) !!}
            <div class="col-sm-8">
                {!! Form::textarea('descDetaill1', null, ['class'=>'form-control input-sm summernote']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('descDetaill2', 'Descripción detallada 2' , ['class'=>'control-label col-sm-2']) !!}
            <div class="col-sm-8">
                {!! Form::textarea('descDetaill2', null, ['class'=>'form-control input-sm summernote']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('relevancia', 'Relevancia:', ['class'=>'control-label col-sm-2']) !!}
            <div class="col-sm-2">
                {!! Form::number('relevancia', null, ['class'=>'form-control number', 'min'=>'0', 'max'=>'11']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('dataInici', 'Fecha inicial:', ['class'=>'control-label col-sm-2']) !!}
            <div class="col-sm-3">
                {!! Form::date('dataInici', null, ['class'=>'form-control', 'placeholder'=> 'YYYY/MM/DD']) !!}
            </div>
            {!! Form::label('dataFinal', 'Fecha Final:', ['class'=>'control-label col-sm-2']) !!}
            <div class="col-sm-3">
                {!! Form::date('dataFinal', null, ['class'=>'form-control', 'placeholder'=> 'YYYY/MM/DD']) !!}
            </div>
            </div><div class="form-group row">
                {!! Form::label('gratuit', 'El recurso esta visible?', ['class'=>'control-label col-sm-3']) !!}
                <div class="col-sm-1">
                    {!! Form::checkbox('visible', 'false', false, []) !!}
                </div>
            </div>
        <div id="error_preus"></div>
        <div class="form-group row">
            {!! Form::label('gratuit', 'Gratuit:', ['class'=>'control-label col-sm-1']) !!}
            <div class="col-sm-1">
                    {!! Form::checkbox('gratuit', 'false', false, []) !!}
            </div>
            {!! Form::label('preuInferior', 'Precio menos que:', ['class'=>'control-label col-sm-2']) !!}
            <div class="col-sm-2">
                {!! Form::number('preuInferior', null, ['class'=>'form-control number', 'placeholder'=>'€', 'min'=>'0']) !!}
            </div>
            {!! Form::label('preuSuperior', 'Precio mas que:', ['class'=>'control-label col-sm-2']) !!}
            <div class="col-sm-2">
                {!! Form::number('preuSuperior', null, ['class'=>'form-control number', 'placeholder'=>'€', 'min'=>'0']) !!}
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-8">
                Selecciona una imagen para subirla:
                {!! Form::file('fotoResum') !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::Label('categorias', 'Categorias:', ['class'=>'control-label col-sm-3']) !!}
            <div class="col-sm-3">
                {{ Form::select('categorias', $categorias, null,['class' => 'form-control']) }}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::Label('edat', 'Edats a qui s\'hadreça el recurs:', ['class'=>'control-label col-sm-3']) !!}
            <div class="col-sm-3">
                {!! Form::select('multipleage[]', $edats, null, ['id' => 'multipleage','multiple'=>'multiple', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            {!! Form::Label('entitats', 'Escoje la entidad a la cual pertenece el recrso:', ['class'=>'control-label col-sm-3']) !!}
            <div class="col-sm-3">
                {!! Form::select('entitats', $entitats, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            <div id="boxOfTags" class="col-md-4 col-md-offset-3">
            </div>
        </div>
        <div class="form-group row">
            <label for="tags" class="control-label col-sm-3">Tags: </label>
            <div class="col-sm-4">
                <input type="text" id="tags" name='tags' placeholder="escribe una categoria para añadir." class="form-control" list="autocomplete" autocomplete="true">
                <datalist id="autocomplete">
                </datalist>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn addTag">Add</button>
            </div>
        </div>
        <div class="form-group row">
            {!! Form::label('linkrecurs', 'Entra los enlaces del recurso:', ['class'=>'control-label col-sm-3']) !!}
            <div class="col-sm-4">
                {!! Form::textarea('linkrecurs', null, ['class'=>'form-control',
                'placeholder'=>'separa los enlaces por ;',
                'rows'=>"3",
                 'cols'=>"50"]) !!}<br>
            </div>
        </div>
        <div class="form-group row">
            <div id="slider-video-wrapper" class="col-md-4 col-md-offset-3 slider">
                <div id="video_slider">
                </div>
                <div id="left"><button id="button-previous" type="button" class="btn btn-default btn-xs glyphicon glyphicon-chevron-left"></button></div>
                <div id="right"><button id="button-next"  type="button" class="btn btn-default btn-xs glyphicon glyphicon-chevron-right"></button></div>
                <div id="center"><button id="deletevideo"  type="button" class="btn btn-danger btn-xs glyphicon glyphicon-remove"></button></div>
            </div>
        </div>
        <div class="row">
            <div id="videoInput" class="col-md-4 col-md-offset-3">

            </div>
        </div>
        <br>
        <div class="form-group row">
            <label for="selectFormat" class="control-label col-md-3">Selecciona el formato de video.</label>
            <div class="col-md-3">
                <select class="form-control col-md-4" id="selectFormat">
                    <option>Selecciona una opción</option>
                    <option value="1">Upload video (20 mb max)</option>
                    <option value="2">Embed video</option>
                    <option value="3">Link video</option>
                </select>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <div id="slider-image-wrapper" class="col-md-4 col-md-offset-3 slider">
                <div id="image_slider">
                </div>
                <div id="left"><button id="image_button-previous" type="button" class="btn btn-default btn-xs glyphicon glyphicon-chevron-left"></button></div>
                <div id="right"><button id="image_button-next"  type="button" class="btn btn-default btn-xs glyphicon glyphicon-chevron-right"></button></div>
                <div id="center"><button id="imagedelete"  type="button" class="btn btn-danger btn-xs glyphicon glyphicon-remove"></button></div>
            </div>
        </div>
        <div class="form-group row images">
            <input type='file' name="" class="image_upload"/>
        </div><br>
        <div class="form-group row">
            <div id="slider_podcast_wrapper" class="col-md-4 col-md-offset-3 slider">
                <input name="podcast0" value="https://www.ivoox.com/player_ej_17386712_4_1.html?c1=ff6600" hidden>
                <input name="podcast1" value="https://www.ivoox.com/player_ej_3411781_4_1.html?c1=ff6600" hidden>
                <input name="podcast2" value="https://www.ivoox.com/player_ej_538279_4_1.html?c1=ff6600" hidden>
                <div id="podcast_preview">
                    <iframe name="podcast0" class="podcast_item" src='https://www.ivoox.com/player_ej_17386712_4_1.html?c1=ff6600'></iframe>
                    <iframe name="podcast1" class="podcast_item" src='https://www.ivoox.com/player_ej_3411781_4_1.html?c1=ff6600'></iframe>
                    <iframe name="podcast2" class="podcast_item" src='https://www.ivoox.com/player_ej_538279_4_1.html?c1=ff6600'></iframe>
                </div>
                <div id="left"><button id="podcast_previous" type="button" class="btn btn-default btn-xs glyphicon glyphicon-chevron-left"></button></div>
                <div id="right"><button id="podcast_next"  type="button" class="btn btn-default btn-xs glyphicon glyphicon-chevron-right"></button></div>
                <div id="center"><button id="podcastdelete"  type="button" class="btn btn-danger btn-xs glyphicon glyphicon-remove"></button></div>
            </div>
        </div>
        <div class="form-group row">
            <label for="addpodcast" class="control-label col-md-3">Añade un podcast</label>
            <div class="col-md-3">
                <textarea type="text" id="addpodcast" class="form-control" placeholder="iframe podcast"></textarea>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn addPodcast">Add</button>
            </div>
        </div>
        <div class="form-group row">
            <label for="target" class="control-label col-md-3">Perfils del recurs</label>
            <div class="col-md-3">
                {!! Form::select('target', $targets, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <br>
            <div id="error_submit"></div>
            <div class="form-group row">
                <div class="col-sm-10">
                    {!!Form::submit('Create', ['class' => 'btn btn-primary'])!!}
                </div>
            </div>
            {!!Form::close()!!}
    </div>

@endsection

@section('script')
    {{--Summer Note--}}
    <script src="{{ URL::asset('/js/sumer_note/jquery_sumernote.js') }}"></script>
    <script src="{{ URL::asset('/js/sumer_note/summernote.js') }}"></script>
    <script src="{{ URL::asset('/js/sumer_note/summernote-es-ES.js') }}"></script>
    <script src="{{ URL::asset('/js/custom_editors.js') }}"></script>
    {{--End Summer Note scripts--}}
    {{--Autocomplete js--}}
    <script src="{{URL::asset('js/jquery-ui.min.js')}}"></script>
    {{--end autocompelete--}}
    {{--Multi select--}}
    <script src="{{URL::asset('js/jquery.multi-select.js')}}"></script>
    {{--end Multi select--}}
    {{--Google maps--}}
    {{--<script src="{{ URL::asset('/js/createEntity.js') }}"></script>--}}
    {{--<script src="{{ URL::asset('https://maps.googleapis.com/maps/api/js?key=AIzaSyC6W8jZVCTHjiEWUf12Gi5oCfehmzPj8mg&libraries=places&callback=initMap') }}" async defer></script>--}}
    {{--end Google maps--}}
@endsection