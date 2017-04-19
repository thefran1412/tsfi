@extends('layouts.backend', ['active' => 2])

@section('css')
    <link href="{{ URL::asset('/js/sumer_note/summernote.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/backend/extra.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/multi-select.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/backend/resourceadd.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/backend/add.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/backend/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endsection

@section('script')
    <script src="{{URL::asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{ URL::asset('/js/custom_editors.js') }}"></script>
    <script src="{{URL::asset('js/jquery.multi-select.js')}}"></script>
    <script src="{{ URL::asset('/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::asset('/js/map_back.js') }}"></script>
    <script src="{{ URL::asset('https://maps.googleapis.com/maps/api/js?key=AIzaSyC6W8jZVCTHjiEWUf12Gi5oCfehmzPj8mg&libraries=places&callback=initMap') }}" async defer></script>
@endsection

@section('titol')
    <i class="fa fa-angle-right"></i>
    <a href="{{ action('backend\Recursos@index') }}">Recursos</a>
    <i class="fa fa-angle-right"></i>
    <a href="{{ action('backend\Recursos@add') }}">Afegir</a>
@endsection

@section('content')
    <div class="section">
        @include('partials.errors')
        {!! Form::open(array('id' => 'create', 'route' => 'resource_store', 'class' => 'form', 'files' => true)) !!}
        <div class="paper">
            <div class="paperfull">
                {!! Form::label('titolRecurs', 'Título del Recurso', ['class'=>'control-label']) !!}
                {!! Form::text('titolRecurs', null,['required', 'class'=>'form-control']) !!}<br>
            </div>
            <div class="paperdiv">
                {!! Form::label('subTitol', 'Subtítulo:', ['class'=>'control-label']) !!}
                {!! Form::text('subTitol', null, ['class'=>'form-control']) !!}<br>
            </div>
            <div class="paperdiv">
                {!! Form::label('creatPer', 'Autor del Recurso', ['class'=>'control-label']) !!}
                {!! Form::text('creatPer', null, ['class'=>'form-control']) !!}<br>
            </div>
            <div class="paperfull">
            {!! Form::label('descBreu', 'Descripción breve',
                    array('class'=>'control-label')) !!}
                {!! Form::textarea('descBreu', null, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="paper">
            <div class="paperfull">
                {!! Form::label('descDetaill1', 'Descripción detallada 1', ['class'=>'control-label']) !!}
                {!! Form::textarea('descDetaill1', null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="paper">
            <div class="paperfull">
                {!! Form::label('descDetaill2', 'Descripción detallada 2' , ['class'=>'control-label']) !!}
                    {!! Form::textarea('descDetaill2', null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="paper">
            <div class="paperdiv">
                {!! Form::label('relevancia', 'Relevancia:', ['class'=>'control-label']) !!}
                {!! Form::number('relevancia', null, ['class'=>'form-control number', 'min'=>'0', 'max'=>'11']) !!}
            </div>
            <div class="paperdiv">
                {!! Form::label('dataInici', 'Fecha inicial:', ['class'=>'control-label']) !!}
                {!! Form::datetime('dataInici', null, ['class'=>'form-control', 'placeholder'=> 'YYYY-MM-DD']) !!}
            </div>
            <div class="paperdiv">
                {!! Form::label('dataFinal', 'Fecha Final:', ['class'=>'control-label']) !!}
                {!! Form::datetime('dataFinal', null, ['class'=>'form-control', 'placeholder'=> 'YYYY-MM-DD']) !!}
            </div>

            <div class="paperdiv">
                {!! Form::label('gratuit', 'Gratuit:', ['class'=>'control-label']) !!}
                {!! Form::checkbox('gratuit', 'false', false, []) !!}
            </div>
                
            <div class="paperdiv">
                {!! Form::label('preuInferior', 'Precio menos que:', ['class'=>'control-label']) !!}
                {!! Form::number('preuInferior', null, ['class'=>'form-control number', 'placeholder'=>'€', 'min'=>'0']) !!}
            </div>
            <div class="paperdiv">
                {!! Form::label('preuSuperior', 'Precio mas que:', ['class'=>'control-label']) !!}
                {!! Form::number('preuSuperior', null, ['class'=>'form-control number', 'placeholder'=>'€', 'min'=>'0']) !!}
            </div>

        </div>
        
        <div class="paper">
            <div class="paperfull upload">
                {!! Form::file('fotoResum', ['id' => 'fotoResum']) !!}
            </div>
        </div>
        <div class="paper">
            <div class="paperdiv">
                {!! Form::Label('categorias', 'Categorias:', ['class'=>'control-label']) !!}
                {{ Form::select('categorias', $categorias, null,['class' => 'form-control']) }}
            </div>
            <div class="paperdiv">
                {!! Form::Label('entitats', 'Escoje la entidad a la cual pertenece el recrso:', ['class'=>'control-label']) !!}
                {!! Form::select('entitats', $entitats, null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="paper">
            <div class="paperfull">
                {!! Form::Label('edat', 'Edats a qui s\'hadreça el recurs:', ['class'=>'control-label']) !!}
                {!! Form::select('multipleage[]', $edats, null, ['id' => 'multipleage','multiple'=>'multiple', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="paper">
                <div id="boxOfTags">
                </div>
            <div class="paperfull">
                <label for="tags">Tags: </label>
                <div>
                    <input type="text" id="tags" name='tags' placeholder="escribe una tag para añadir." class="form-control" list="autocomplete" autocomplete="true">
                    <datalist id="autocomplete">
                    </datalist>
                </div>
            </div>
            <div>
                <button type="button" class="btn addTag">Add</button>
            </div>
        </div>
        <div class="paper">
            <div class="paperfull">
                {!! Form::label('linkrecurs', 'Entra los enlaces del recurso:', ['class'=>'control-label col-sm-3']) !!}
                {!! Form::textarea('linkrecurs', null, ['class'=>'form-control',
                'placeholder'=>'separa los enlaces por ;',
                'rows'=>"3",
                 'cols'=>"50"]) !!}<br>
            </div>
        </div>
        <div class="paper">
            
            <div class="paperfull">
                <label for="selectFormat" class="control-label col-md-3">Selecciona el formato de video.</label>
            <div class="col-md-3">
                <select class="form-control col-md-4" id="selectFormat">
                    <option>Selecciona una opción</option>
                    <option value="1">Upload video (20 mb max)</option>
                    <option value="2">Embed video</option>
                    <option value="3">Link video</option>
                </select>
            </div>
            <div class="row">
                <div id="videoInput" class="col-md-4 col-md-offset-3">

                </div>
            </div>
            <div id="slider-video-wrapper" class="col-md-4 col-md-offset-3 slider">
                <div id="video_slider">
                </div>
                <div id="left"><button id="button-previous" type="button" class="btn btn-default btn-xs glyphicon glyphicon-chevron-left"></button></div>
                <div id="right"><button id="button-next"  type="button" class="btn btn-default btn-xs glyphicon glyphicon-chevron-right"></button></div>
                <div id="center"><button id="deletevideo"  type="button" class="btn btn-danger btn-xs glyphicon glyphicon-remove"></button></div>
            </div>
            </div>
        </div>
        <div class="paper">
            
            <div class="paperfull">
                <div class="form-group row images">
                    <input type='file' name="" class="image_upload"/>
                </div>
            </div>

            <div class="paperfull">
                <div id="slider-image-wrapper" class="col-md-4 col-md-offset-3 slider">
                    <div id="image_slider">
                    </div>
                    <div id="left"><button id="image_button-previous" type="button" class="btn btn-default btn-xs glyphicon glyphicon-chevron-left"></button></div>
                    <div id="right"><button id="image_button-next"  type="button" class="btn btn-default btn-xs glyphicon glyphicon-chevron-right"></button></div>
                    <div id="center"><button id="imagedelete"  type="button" class="btn btn-danger btn-xs glyphicon glyphicon-remove"></button></div>
                </div>
            </div>
        </div>
        <div class="paper">
            <div class="paperfull">
                <div id="slider_podcast_wrapper" class="col-md-4 col-md-offset-3 slider">
                    <div id="podcast_preview">
                    </div>
                </div>
            </div>

            <div class="paperfull">
                <label for="addpodcast" class="control-label">Añade un podcast</label>
                <div class="col-md-3">
                    <textarea type="text" id="addpodcast" class="form-control" placeholder="iframe podcast"></textarea>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn addPodcast">Add</button>
                </div>
            </div>
        </div>
        <div class="paper">
            <div class="paperfull">
                <label for="target" class="control-label">Perfils del recurs</label>
                <div class="col-md-3">
                    {!! Form::select('target', $targets, null, ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="paper">
            {!!Form::label('adreca', 'Adreça: ')!!}
            {!!Form::text('adreca', null, ['class' => 'form-control location', 'placeholder' => 'Adreça de la entitat', 'id' => 'pac-input'])!!}
            {!!Form::hidden('lat', null, ['class' => 'form-control', 'id' => 'lat'])!!}
            {!!Form::hidden('lng', null, ['class' => 'form-control', 'id' => 'lng'])!!}

            <div id="map" class="form-group"></div>
            <div id="infowindow-content">
                <span id="place-name" class="title"></span>
                <span id="place-address"></span>
            </div>
            </div>
            <div class="paper">
                <div class="paperfull">
                    <label class="control-label col-md-4">
                        Guardar recurs com visible?
                        <input type="radio" value="1" name="visible" checked></label>
                </div>
                <div  class="paperfull">
                    <label class="control-label col-md-4">
                        Guardar el recurso como pendent?
                        <input type="radio" value="0" name="visible"></label>
                </div>
                <div  class="paperfull">
                    <label class="control-label">
                        Borrar el recurs?
                        <input type="radio" value="2" name="visible"></label>
                </div>
                <br>
            </div>
        <div id="error_submit"></div>
        <div class="form-group row">
            <div class="col-sm-10">
                {!!Form::submit('Create', ['class' => 'btn btn-primary'])!!}
            </div>
        </div>
        {!!Form::close()!!}
    </div>

@endsection
