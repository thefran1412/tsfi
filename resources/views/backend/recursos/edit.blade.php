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
    <a href="{{ action('backend\Recursos@edit', ['id' => $recurs->recurs_id]) }}">Editar</a>
@endsection

@section('content')
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
        <div class="col-sm-2">
            {!! Form::date('dataInici', null, ['class'=>'form-control']) !!}
        </div>
        {!! Form::label('dataFinal', 'Fecha Final:', ['class'=>'control-label col-sm-2']) !!}
        <div class="col-sm-2">
            {!! Form::date('dataFinal', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label('gratuit', 'Gratuit:', ['class'=>'control-label col-sm-1']) !!}
        <div class="col-sm-1">
            {!! Form::checkbox('gratuit', null, false, []) !!}
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
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </div>
    d
@endsection
@section('script')
    <script src="{{ URL::asset('http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js') }}"></script>
    <script src="{{ URL::asset('/js/sumer_note/summernote.js') }}"></script>
    <script src="{{ URL::asset('/js/sumer_note/summernote-es-ES.js') }}"></script>
    <script src="{{ URL::asset('/js/sumer_note/custom_editors.js') }}"></script>
@endsection

{{-- <a href="{{ route('backend.recursos.update', $recurs->recurs_id) }}">edit</a> --}}