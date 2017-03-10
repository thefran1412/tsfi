@if(! $errors->isEmpty())
<div class="alert alert-danger">
    <p>Revisa los siguientes requisitos</p>
    <ul>
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif