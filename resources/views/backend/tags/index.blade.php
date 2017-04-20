@extends('layouts.backend', ['add' => 'true', 'active' => 4])

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


@section('add')
  <div class="section">
            <div class="sectionHeader">
                <h2>Afegir Tag</h2>
                <i class="fa fa-angle-down"></i>    
            </div>
            <div class="sectionBody">
                {!!Form::open(['action' => 'backend\Tags@store', 'method' => 'post'])!!}
              <div>
                  {!!Form::label('nomTags', 'Nom: ')!!}
                  {!!Form::text('nomTags', null, ['class' => 'form-control', 'placeholder' => 'Nom del tag'])!!}
              </div>
              <div class="mar">
                  {!!Form::submit('Guardar canvis', ['class' => 'btn btn-primary'])!!}
              </div>
          {!!Form::close()!!}
            </div>
     </div>
@endsection



@section('content')
     <div class="rightTable">
          <div class="section">
            <div class="sectionHeader">
                <h2>Tags</h2>
                <i class="fa fa-angle-down"></i>    
            </div>
            <div class="sectionBody">
                <table id="tags" class="table" cellspacing="0" border="0" cellpadding="0" width="100%">
                    <thead >
                        <tr>
                            <th>Nom</th>
                            <th>Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                            <tr>
                              <th><a href="{{action('backend\Tags@edit', ['id' => $tag->tags_id])}}">{{$tag->nomTags}}</a></th>
                              <th>
                                <div class="actions">
                                  <a title="Editar" href="{{action('backend\Tags@edit', ['id' => $tag->tags_id])}}" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                  {!!Form::open(['action' => ['backend\Tags@destroy', $tag->tags_id], 'method' => 'delete', 'id' => 'dle'.$tag->tags_id, 'class' => $tag->tags_id])!!}
                                  {!!Form::submit('Borrar', ['class' => 'btn btn-danger del'])!!}
                                  {!!Form::close()!!}
                                </div>
                              </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
     </div>
@endsection
