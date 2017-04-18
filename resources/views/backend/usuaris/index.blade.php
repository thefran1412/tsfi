@extends('layouts.backend')
@section('titol')
    <i class="fa fa-angle-right"></i>
    <a href="{{ action('backend\Backend@config') }}">Configuració</a>
    <i class="fa fa-angle-right"></i>
    <a href="{{ action('backend\Usuaris@index') }}">Usuari</a>
@endsection
@section('content')

    <div class="container">
        <form class="form-horizontal">
            <fieldset>
                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">Nom de l'usuari</label>
                    <div class="col-md-4">
                        <input id="textinput" name="textinput" type="text" placeholder="{{ $usuari->name }}" class="form-control input-md">
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">date attended</label>
                    <div class="col-md-4">
                        <input id="textinput" name="textinput" type="text" placeholder="date attended" class="form-control input-md">

                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textinput">host</label>
                    <div class="col-md-4">
                        <input id="textinput" name="textinput" type="text" placeholder="host" class="form-control input-md">

                    </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="selectbasic">country</label>
                    <div class="col-md-4">
                        <select id="selectbasic" name="selectbasic" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                </div>

                <!-- Textarea -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="textarea">trade show introduction</label>
                    <div class="col-md-4">
                        <textarea class="form-control" id="textarea" name="textarea">trade show introduction</textarea>
                    </div>
                </div>

                <!-- File Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="filebutton">upload photo</label>
                    <div class="col-md-4">
                        <input id="filebutton" name="filebutton" class="input-file" type="file">
                    </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="singlebutton"></label>
                    <div class="col-md-4">
                        <button id="singlebutton" name="singlebutton" class="btn btn-primary">submit</button>
                    </div>
                </div>

            </fieldset>
        </form>

    </div>





@endsection


@section('script')
    <script src="{{URL::asset('js/jquery-ui.min.js')}}"></script>
@endsection
