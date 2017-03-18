@extends('layouts.backend')

@section('titol', 'Categories')

@section('css')
     <link rel="stylesheet" href="/css/backend/datatables.css">
     <link rel="stylesheet" href="/css/backend/categories.css">
@endsection

@section('script')
         <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
             $('#pendientes').DataTable();
             $('#reportados').DataTable();
             $('#aprovados').DataTable();
        } );
    </script>
@endsection

@section('content')
     <div class="leftCreate">
          <div class="createHeader">
               <h2>Afegir Categoria</h2>
          </div>
     </div>
     <div class="rightTable">
          <div class="section">
            <div class="sectionHeader">
                <h2>Pendientes</h2>
                <i class="fa fa-angle-down"></i>    
            </div>
            <div class="sectionBody">
                <table id="pendientes" class="table" cellspacing="0" border="0" cellpadding="0" width="100%">
                    <thead >
                        <tr>
                            <th>Nom</th>
                            <th>Descripció</th>
                            <th>Codi</th>
                            <th>Accions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $categoria)
                            <tr>
                              <th><a href="{{action('backend\Recursos@edit', ['id' => $categoria->recurs_id])}}">{{$categoria->nomCategoria}}</a></th>
                              <th>{{$categoria->descCategoria}}</th>
                              <th>{{$categoria->codiCategoria}}</th>
                              <th>
                                   <a title="Editar" href="#" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                   <a title="Borrar" href="#" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                              </th>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
     </div>
@endsection
