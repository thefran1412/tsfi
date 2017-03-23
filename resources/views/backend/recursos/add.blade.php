@extends('layouts.backend')
<style> .note-editor.note-frame .note-editing-area .note-editable{
        padding-left:20px;}</style>
@section('css')
    <link href="{{ URL::asset('/js/sumer_note/summernote.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('/css/backend/extra.css') }}" rel="stylesheet">

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
                    <h2>Crea un Recurso</h2>
                </div>
            </div>
        </div>
        @include('partials.errors')
        {!! Form::open(array('route' => 'resource_store', 'class' => 'form')) !!}
            <div class="form-group row">
                {!! Form::label('Título del Recurso', null, array(
                        'class'=>'control-label col-sm-2')) !!}
                <div class="col-sm-8">
                    {!! Form::text('name', null,
                        array('required',
                                'name' => 'titolRecurs',
                                'class'=>'form-control')) !!}<br>
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('Autor del Recurso', null, array(
                        'class'=>'control-label col-sm-2')) !!}
                <div class="col-sm-4">
                {!! Form::text('name', null,
                        array('name' => 'creatPer',
                        'class'=>'form-control')) !!}<br>
                </div>
            </div>

            <div class="form-group row">
                {!! Form::label('Subtítulo:', null,
                        array('class'=>'control-label col-sm-2')) !!}
                <div class="col-sm-4">
                    {!! Form::text('name', null,
                            array('name' => 'subTitol',
                                    'class'=>'form-control')) !!}<br>
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('Descripción breve', null,
                        array('class'=>'control-label col-sm-2')) !!}
                <div class="col-sm-8">
                {!! Form::textarea('message', null,
                    array('name'=>'descBreu',
                            'class'=>'form-control input-sm summernote')) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('Descripción detallada 1', null,
                        array('class'=>'control-label col-sm-2')) !!}
                <div class="col-sm-8">
                    {!! Form::textarea('message', null,
                        array('name'=>'descDetaill1',
                                'class'=>'form-control input-sm summernote')) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('Descripción detallada 2', null,
                        array('class'=>'control-label col-sm-2')) !!}
                <div class="col-sm-8">
                    {!! Form::textarea('message', null,
                        array('name'=>'descDetaill2',
                                'class'=>'form-control input-sm summernote')) !!}
                </div>
            </div>Form::number('name', 'value');
            <div class="form-group row">
                {!! Form::label('Relevancia:', null,
                        array('class'=>'control-label col-sm-2')) !!}
                <div class="col-sm-2">
                    {!! Form::number('name', null,
                        array('name'=>'relevancia',
                                'class'=>'form-control number',
                                'min'=>'0',
                                'max'=>'11' )) !!}
                </div>
            </div>
            <div class="form-group row">
                {!! Form::label('Fecha inicial', null,
                        array('class'=>'control-label col-sm-1')) !!}
                <div class="col-sm-2">
                    {!! Form::date('name', "{{ $current_time }}",
                        array('name'=>'dataInici',
                                'class'=>'form-control',
                                'id'=>'dataInici',
                                'min'=>"{{ $current_time }}")) !!}
                </div>
                {!! Form::label('Fecha Final', null,
                        array('class'=>'control-label col-sm-1')) !!}
                <div class="col-sm-2">
                    {!! Form::date('name', "{{ $current_time }}",
                        array('name'=>'dataFinal',
                                'class'=>'form-control',
                                'id'=>'dataInici',
                                'min'=>"{{ $current_time }}")) !!}
                </div>
                <label class="control-label col-sm-3" for="dataFinal">Fecha final</label>
                <div class="col-sm-2">
                    <input id="dataFinal" type="date" name="dataFinal" min="{{ $current_time }}" value="{{ $current_time }}">
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="checkbox">
                            <label>
                                <input id="id_gratuit" name="gratuit" type="checkbox" value="">Gratuit
                            </label>
                        </div>
                    </div>
                    <label class="control-label col-sm-2" for="preuInferior">Precio menos que:</label>
                    <div class="col-sm-2">
                        <input type="number" placeholder="&#8364;" class="form-control input-sm number" min="0" id="preuInferior" name="preuInferior">
                    </div>
                    <label class="control-label col-sm-2" for="preuSuperior">Precio mas que:</label>
                    <div class="col-md-2 col-0-offset-2">
                        <input type="number" placeholder="&#8364;" class="form-control input-sm number" min="0" id="preuSuperior" name="preuSuperior">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="checkbox">
                            Selecciona una imagen para subirla:
                                <input type="file" name="fotoResum" id="fileToUpload">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <h1>Contact TODOParrot</h1>

    <ul>
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>





    <div class="form-group">
        {!! Form::label('Your E-mail Address') !!}
        {!! Form::text('email', null,
            array('required',
                  'class'=>'form-control',
                  'placeholder'=>'Your e-mail address')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('Your Message') !!}
        {!! Form::textarea('message', null,
            array('required',
                  'class'=>'form-control',
                  'placeholder'=>'Your message')) !!}
    </div>

    <div class="form-group row">
        {!! Form::submit('Crear',
          array('class'=>'btn btn-primary')) !!}
    </div>
    {!! Form::close() !!}

@endsection

@section('script')
    {{--Summer Note--}}
    <script src="{{ URL::asset('http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js') }}"></script>
    <script src="{{ URL::asset('/js/sumer_note/summernote.js') }}"></script>
    <script src="{{ URL::asset('/js/sumer_note/summernote-es-ES.js') }}"></script>
    <script src="{{ URL::asset('/js/sumer_note/custom_editors.js') }}"></script>
    {{--End Summer Note scripts--}}
@endsection