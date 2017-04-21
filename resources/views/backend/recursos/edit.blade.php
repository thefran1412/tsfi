@extends('layouts.backend', ['active' => 2])
@section('css')
    <link href="{{ URL::asset('/css/backend/extra.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/multi-select.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/backend/resourceadd.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/backend/add.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/backend/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">

@endsection

@section('titol')
    <i class="fa fa-angle-right"></i>
    <a href="{{ action('backend\Recursos@index') }}">Recursos</a>
    <i class="fa fa-angle-right"></i>
    <a href="{{ action('backend\Recursos@add') }}">Editar</a>
@endsection
@section('script')
    <script src="{{URL::asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{ URL::asset('/js/custom_editors.js') }}"></script>
    <script src="{{URL::asset('js/jquery.multi-select.js')}}"></script>
    <script src="{{ URL::asset('/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ URL::asset('https://maps.googleapis.com/maps/api/js?key=AIzaSyC6W8jZVCTHjiEWUf12Gi5oCfehmzPj8mg&libraries=places&callback=geocodeLatLng') }}" async defer></script>
    <script src="{{ URL::asset('/js/map_back.js') }}"></script>
    <script type="text/javascript">
            @if ($recursLoc)
            console.log({{$recursLoc->latitud}});
              {{--initMap({{$recursLoc->latitud}}, {{$recursLoc->longitud}});--}}
              {{--*/ $geoloc = $recursLoc->latitud.','.$recursLoc->longitud /*--}}
            var geoloc = '{{ $recursLoc->longitud.','.$recursLoc->latitud}}';
            function geocodeLatLng(name) {
                var geocoder = new google.maps.Geocoder;
                var myLatLng = {lat:  41.627619, lng: 3};
                var infowindow = new google.maps.InfoWindow;
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: myLatLng,
                    zoom: zoom,
                    scrollwheel: false
                });
                var infowindowContent;
                infowindowContent = document.getElementById('infowindow-content');
                infowindow.setContent(infowindowContent);
                var input = '{{ $recursLoc->latitud.','.$recursLoc->longitud }}';
                var latlngStr = input.split(',', 2);
                var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
                input = document.getElementById('pac-input');

                autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.bindTo('bounds', map);

                autocomplete.addListener('place_changed', function() {

                    infowindow.close();

                    place = autocomplete.getPlace();

                    if (place.geometry.viewport) {
                        map.fitBounds(place.geometry.viewport);
                        //exec
                    } else {
                        map.setCenter(place.geometry.location);
                        map.setZoom(17);
                    }
                    marker = new google.maps.Marker({
                        map: map
                    });
                    marker.addListener('click', function() {
                        infowindow.open(map, marker);
                    });
                    // Set the position of the marker using the place ID and location.
                    marker.setPlace({
                        placeId: place.place_id,
                        location: place.geometry.location
                    });

                    marker.setVisible(true);

                    lat = place.geometry.location.lat();
                    lng = place.geometry.location.lng();

                    infowindowContent.children['place-name'].textContent = place.name;
                    infowindow.open(map, marker);
                });
                geocoder.geocode({'location': latlng}, function (results, status) {
                    if (status === 'OK') {
                        if (results[1]) {
                            map.setZoom(11);
                            var marker = new google.maps.Marker({
                                position: latlng,
                                map: map
                            });
                            infowindow.setContent(results[1].formatted_address);
                            infowindow.open(map, marker);
                        } else {
                            window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                    }
                });
            }
            @else
              initMap();
            @endif

    </script>
@endsection
@section('content')

    <div class="section">
        @include('partials.errors')
        @include('partials.errors')
        {!! Form::open(['id'=>'create', 'route' => 'resource_update', 'url'=>'/admin/recursos/'.$id.'/edit','class' => 'form', 'files' => true]) !!}
        <div class="paper">
            <div class="paperfull">
                {!! Form::label('titolRecurs', 'Título del Recurso', ['class'=>'control-label']) !!}
                {!! Form::text('titolRecurs', $recurso->titolRecurs,['required', 'class'=>'form-control']) !!}
            </div>
            <div class="paperdiv">
                {!! Form::label('creatPer', 'Autor del Recurso', ['class'=>'control-label']) !!}
                {!! Form::text('creatPer', $recurso->creatPer, ['class'=>'form-control']) !!}
            </div>
            <div class="paperdiv">
                {!! Form::label('subTitol', 'Subtítulo:', ['class'=>'control-label']) !!}
                {!! Form::text('subTitol', $recurso->subTitol, ['class'=>'form-control']) !!}
            </div>
            <div class="paperfull">
                {!! Form::label('descBreu', 'Descripción breve', array('class'=>'control-label')) !!}
                {!! Form::textarea('descBreu', $recurso->descBreu, ['class'=>'form-control input-sm summernote']) !!}
            </div>
        </div>
        <div class="paper">
            <div class="paperfull">
                {!! Form::label('descDetaill1', 'Descripción detallada 1', ['class'=>'control-label']) !!}
                {!! Form::textarea('descDetaill1', $recurso->descDetaill1, ['class'=>'form-control input-sm summernote']) !!}
            </div>
        </div>
        <div class="paper">
            <div class="paperfull">
                {!! Form::label('descDetaill2', 'Descripción detallada 2' , ['class'=>'control-label']) !!}
                {!! Form::textarea('descDetaill2', $recurso->descDetaill2, ['class'=>'form-control input-sm summernote']) !!}
            </div>
        </div>
        <div id="error_preus"></div>
        <div class="paper">
            <div class="paperdiv">
                {!! Form::label('relevancia', 'Relevancia:', ['class'=>'control-label']) !!}
                {!! Form::number('relevancia', $recurso->relevancia, ['class'=>'form-control number', 'min'=>'0', 'max'=>'11']) !!}
            </div>
            <div class="paperdiv">
                {!! Form::label('dataInici', 'Fecha inicial:', ['class'=>'control-label']) !!}
                {!! Form::datetime('dataInici', Carbon\Carbon::parse($recurso->dataInici)->format('Y-m-d H:i'), ['class'=>'form-control', 'placeholder'=> 'YYYY-MM-DD']) !!}
            </div>
            <div class="paperdiv">
                {!! Form::label('dataFinal', 'Fecha Final:', ['class'=>'control-label']) !!}
                {!! Form::datetime('dataFinal', Carbon\Carbon::parse($recurso->dataFinal)->format('Y-m-d H:i'), ['class'=>'form-control', 'placeholder'=> 'YYYY-MM-DD']) !!}
            </div>
            <div class="paperdiv">
                {!! Form::label('gratuit', 'Gratuit:', ['class'=>'control-label col-sm-1']) !!}
                @if($recurso->gratuit > 0)
                    {!! Form::checkbox('gratuit', 'true', true, []) !!}
                @else
                    {!! Form::checkbox('gratuit', 'false', false, []) !!}
                @endif
            </div>
            <div class="paperdiv">
                {!! Form::label('preuInferior', 'Precio menos que:', ['class'=>'control-label']) !!}
                {!! Form::number('preuInferior', $recurso->preuInferior, ['class'=>'form-control number', 'placeholder'=>'€', 'min'=>'0']) !!}
            </div>
            <div class="paperdiv">
                {!! Form::label('preuSuperior', 'Precio mas que:', ['class'=>'control-label']) !!}
                {!! Form::number('preuSuperior', $recurso->preuSuperior, ['class'=>'form-control number', 'placeholder'=>'€', 'min'=>'0']) !!}
            </div>
        </div>
        <div class="paper">
            <div class="paperfull">
                {!! Form::label('fotoResum', 'Para cambiar la imagen selecciona una nueva:', ['class'=>'control-label']) !!}
                {!! Form::file('fotoResum', ['id' => 'fotoResum']) !!}

            </div>
            <div class="paperfull upload currentfotoresum">
                @if($recurso->fotoResum)
                    <img align="middle" name="previousimgresource" src="/img/image/{{ $recurso->fotoResum }}" width="300px" height="180px">
                    <input type="text" value="{{ $recurso->fotoResum }}" name="previousimgresource" style="display: none;">
                @endif
            </div>
        </div>
        <div class="paper">
            <div class="paperdiv">
                {!! Form::Label('categorias', 'Categorias:', ['class'=>'control-label ']) !!}
                {!! Form::select('categorias', $categorias, $selectedCategoria,['class' => 'form-control']) !!}
            </div>
            <div class="paperdiv">
                {!! Form::Label('entitats', 'Escoje la entidad a la cual pertenece el recrso:', ['class'=>'control-label ']) !!}
                {!! Form::select('entitats', $entitats, $selectedEntitat, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="paper">
            <div class="paperfull">
                {!! Form::Label('edat', 'Edats a qui s\'hadreça el recurs:', ['class'=>'control-label ']) !!}
                {!! Form::select('multipleage[]', $edats, $arrayedats, ['id' => 'multipleage','multiple'=>'multiple', 'class' => 'form-control']) !!}
            </div>
        </div>
        <div class="paper">
            <div id="boxOfTags" class="col-md-4 col-md-offset-3">
                @for ($i = 0; $i < count($selectedTags); $i++)
                    <input type="text" name="tag{{ $i }}" class="btn btn-primary btn-xs tagDelete" value="{{ $selectedTags[$i]->nomTags }}"
                           style="max-width: {{ (strlen($selectedTags[$i]->nomTags) * 8) + 5 }}px" readonly>
                @endfor
            </div>
            <div class="paperfull">
                <label for="tags">Tags: </label>
                    <input type="text" id="tags" name='tags' placeholder="escribe una categoria para añadir." class="form-control" list="autocomplete" autocomplete="true">
                    <datalist id="autocomplete">
                    </datalist>
            </div>
            <div>
                <button type="button" class="btn addTag">Add</button>
            </div>
        </div>
        <div class="paper">
            <div class="paperfull">
            {!! Form::label('linkrecurs', 'Entra los enlaces del recurso:', ['class'=>'control-label ']) !!}
                <textarea class="form-control" placeholder="separa los enlaces por ;" rows="12" cols="50" name="linkrecurs" id="linkrecurs">@foreach($selectedLinks as $link){{ $link }}
@endforeach</textarea>
            </div>
        </div>

        <div class="paper">
            <div class="paperfull">
                <label for="selectFormat" class="control-label col-md-3">Selecciona el formato de video.</label>
                <div class="col-md-3">
                <select class="form-control col-md-4" id="selectFormat">
                    <option>Selecciona una opción</option>
                    <option value="2">Embed video</option>
                    <option value="3">Link video</option>
                </select>
                </div>
        <div class="row">
            <div id="videoInput" class="col-md-4 col-md-offset-3">

            </div>
        </div>
            <div id="slider-video-wrapper" class="col-md-4 col-md-offset-3 slider">
                @if($video_recurs)

                    @foreach($video_recurs as $key => $video)
                        <input type="text" class="none" value="{{$video->urlVideo}}" name="video{{$key}}" hidden>
                    @endforeach
                @endif
                <div id="video_slider">
                    @if($video_recurs)
                        @foreach($video_recurs as $key => $video)
                            <iframe name="video{{$key}}" class="slider_item" src="{{$video->urlVideo}}"></iframe>
                        @endforeach
                    @endif
                </div>
                <div id="left"><button id="button-previous" type="button" class="btn btn-default btn-xs glyphicon glyphicon-chevron-left"></button></div>
                <div id="right"><button id="button-next"  type="button" class="btn btn-default btn-xs glyphicon glyphicon-chevron-right"></button></div>
                <div id="center"><button id="deletevideo"  type="button" class="btn btn-danger btn-xs glyphicon glyphicon-remove"></button></div>
            </div>
        </div>
        

        </div>
        <div class="paper">
        <div class="paperfull images">
            @if($image_recurs)
                @foreach($image_recurs as $key => $image)
                    <input type="text" value="{{ $image->titolImatge }}" name="delimage{{ $key }}" class="image{{ $key }}" style="display: none;">
                @endforeach
            @endif
            <input type='file' name="" class="image_upload"/>
        </div>
        <div class="paperfull" id="img_slider">
            <div id="slider-image-wrapper" class="col-md-4 col-md-offset-3 slider">
                <div id="image_slider">
                    @if($image_recurs)
                        @foreach($image_recurs as $key => $image)
                            <img name="image{{ $key }}" alt="{{ $image->descImatge }}" class="img_slider" src="/img/image/{{ $image->imatge }}"/>
                        @endforeach
                    @endif
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
                @if($podcast_recurs)
                    @foreach($podcast_recurs as $key => $podcast)
                        <input type="text" value="{{ $podcast->podCast }}" name="podcast{{ $key }}" style="display: none;">
                    @endforeach
                @endif
                <div id="podcast_preview">
                    @if($podcast_recurs)
                        @foreach($podcast_recurs as $key => $podcast)
                            <iframe name="podcast{{ $key }}" class="podcast_item" src="{{ $podcast->podCast }}"></iframe>
                        @endforeach
                    @endif
                </div>
                <div id="left"><button id="podcast_previous" type="button" class="btn btn-default btn-xs glyphicon glyphicon-chevron-left"></button></div>
                <div id="right"><button id="podcast_next"  type="button" class="btn btn-default btn-xs glyphicon glyphicon-chevron-right"></button></div>
                <div id="center"><button id="podcastdelete"  type="button" class="btn btn-danger btn-xs glyphicon glyphicon-remove"></button></div>
                </div>
            </div>
            <div class="paperfull">
                <label for="addpodcast" class="control-label col-md-3">Añade un podcast</label>
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
                <label for="target" class="control-label col-md-3">Perfils del recurs</label>
                <div class="col-md-3">
                        {!! Form::select('target', $targets, $selectedtarget, ['class' => 'form-control']) !!}
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
                <label class="control-label col-md-5">
                    Guardar recurs com visible?
                    <input type="radio" value="1" name="visible" @if($recurso->visible === 1) checked @endif></label>
            </div>
        <div class="paperfull">
                <label class="control-label col-md-5">
                    Guardar el recurso como pendent?
                    <input type="radio" value="0" name="visible" @if($recurso->visible === 0) checked @endif></label>
            </div>
        <div class="paperfull">
                <label class="control-label col-md-5">
                    Borrar el recurs?
                    <input type="radio" value="2" name="visible" @if($recurso->visible === 2) checked @endif></label>
            </div>
            </div>
        
        <div id="error_submit"></div>
        <div>
            <div class="col-sm-10">
                {!!Form::submit('Actualizar', ['class' => 'btn btn-primary'])!!}
            </div>
        </div>
        {!!Form::close()!!}
    </div>


@endsection