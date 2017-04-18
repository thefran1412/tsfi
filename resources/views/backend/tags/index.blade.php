@extends('layouts.backend')

@section('titol')
  <i class="fa fa-angle-right"></i>
  <a href="{{ action('backend\Tags@index') }}">Tags</a>
@endsection

@section('css')
     <link rel="stylesheet" href="{{ URL::asset('/css/backend/datatables.css') }}">
     <link rel="stylesheet" href="{{ URL::asset('/css/backend/crud.css') }}">
@endsection

@section('script')
         <script src="{{ URL::asset('https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js') }}"></script>
    <script>
        $(document).ready(function() {
             $('#tags').DataTable();
        } );
    </script>
@endsection

@section('content')
     <div class="leftCreate">
          <div class="createHeader">
               <h2>Afegir Tag</h2>
          </div>
          <div class="createBody">
            {!!Form::open(['action' => 'backend\Tags@store', 'method' => 'post'])!!}
              <div>
                  {!!Form::label('nomTags', 'Nom: ')!!}
                  {!!Form::text('nomTags', null, ['class' => 'form-control', 'placeholder' => 'Nom del tag'])!!}
              </div>
              {{-- <div>
                  {!!Form::label('desc', 'Descripció: ')!!}
                  {!!Form::textarea('desc', null, ['class' => 'form-control', 'placeholder' => 'Descripció del tag'])!!}
              </div> --}}
              <div>
                  {!!Form::submit('Guardar canvis', ['class' => 'btn btn-primary'])!!}
              </div>
          {!!Form::close()!!}
          </div>
     </div>
     <div class="rightTable">
          <div class="section">
            <div class="sectionHeader">
                <h2>Pendientes</h2>
                <i class="fa fa-angle-down"></i>    
            </div>
            <div class="sectionBody">
                <table id="tags" class="table" cellspacing="0" border="0" cellpadding="0" width="100%">
                    <thead >
                        <tr>
                            <th>Nom</th>
                            {{-- <th>Descripció</th> --}}
                            <th>Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                            <tr>
                              <th><a href="{{action('backend\Tags@edit', ['id' => $tag->tags_id])}}">{{$tag->nomTags}}</a></th>
                              {{-- <th>{{$tag->descTag}}</th> --}}
                              <th>
                                <div class="actions">
                                  <a title="Editar" href="{{action('backend\Tags@edit', ['id' => $tag->tags_id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                  {!!Form::open(['action' => ['backend\Tags@destroy', $tag->tags_id], 'method' => 'delete'])!!}
                                  {!!Form::submit('Borrar', ['class' => 'btn btn-danger'])!!}
                                  {!!Form::close()!!}
                                </div>
                              </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
     </div>
@endsection
