@extends('layouts.backend')

@section('titol')
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Recursos@index') }}">Recursos</a>
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Recursos@edit', ['id' => $recurs->recurs_id]) }}">Editar</a>
@endsection

@section('content')

{!!Form::model($recurs, ['action'=> ['backend\Recursos@update', $recurs->recurs_id], 'method' =>'PUT'])!!}
    <div>
        {!!Form::label('creatPer', 'Autor: ')!!}
        {!!Form::text('creatPer', null, ['class' => 'form-controll', 'placeholder' => 'Introdueix el sub titol'])!!}
    </div>
    <div>
        {!!Form::label('titolRecurs', 'Titol: ')!!}
        {!!Form::text('titolRecurs', null, ['class' => 'form-controll', 'placeholder' => 'Introdueix el titol'])!!}
    </div>
    <div>
        {!!Form::label('subTitol', 'Sub Titol: ')!!}
        {!!Form::text('subTitol', null, ['class' => 'form-controll', 'placeholder' => 'Introdueix el sub titol'])!!}
    </div>
    <div>
        {!!Form::label('descBreu', 'Descripció Breu: ')!!}
        {!!Form::text('descBreu', null, ['class' => 'form-controll', 'placeholder' => 'Introdueix descripció breu'])!!}
    </div>
    <div>
        {!!Form::label('descDetaill1', 'Descripció Detallada 1: ')!!}
        {!!Form::text('descDetaill1', null, ['class' => 'form-controll', 'placeholder' => 'Introdueix descripció detall 1'])!!}
    </div>
    <div>
        {!!Form::label('descDetaill2', 'Descripció Detallada 2: ')!!}
        {!!Form::text('descDetaill2', null, ['class' => 'form-controll', 'placeholder' => 'Introdueix descripció detall 2'])!!}
    </div>
    <div>
        {!!Form::label('relevancia', 'Relevancia: ')!!}
        {!!Form::number('relevancia', null, ['class' => 'form-controll', 'placeholder' => 'Introdueix relevancia'])!!}
    </div>
    <div>
        {!!Form::label('dataInici', 'Data Inici: ')!!}
        {!!Form::date('dataInici', null, ['class' => 'form-controll', 'placeholder' => 'Introdueix data inicial'])!!}
    </div>
    <div>
        {!!Form::label('dataFinal', 'Data Final: ')!!}
        {!!Form::date('dataFinal', null, ['class' => 'form-controll', 'placeholder' => 'Introdueix data final'])!!}
    </div>
    <div>
        {!!Form::label('gratuit', 'Gratuit: ')!!}
        {!!Form::number('gratuit', null, ['class' => 'form-controll', 'placeholder' => 'Introdueix gratuit'])!!}
    </div>
    <div>
        {!!Form::label('preuInferior', 'Preu Inferior: ')!!}
        {!!Form::number('preuInferior', null, ['class' => 'form-controll', 'placeholder' => 'Introdueix preu inferior'])!!}
    </div>
    <div>
        {!!Form::label('preuSuperior', 'Preu Superior: ')!!}
        {!!Form::number('preuSuperior', null, ['class' => 'form-controll', 'placeholder' => 'Introdueix preu superior'])!!}
    </div>
    <div>
        {!!Form::label('Visible', 'Visible: ')!!}
        {!!Form::number('Visible', null, ['class' => 'form-controll', 'placeholder' => 'Introdueix visible'])!!}
    </div>
    <div>
        {!!Form::submit('Guardar canvis', ['class' => 'form-controll'])!!}
    </div>
{!!Form::close()!!}

{{-- <a href="{{ route('backend.recursos.update', $recurs->recurs_id) }}">edit</a> --}}
@endsection