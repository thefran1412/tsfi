@extends('layouts.backend')
@section('title', 'Dashboard')
@section('content')
	<div class="dashWrap">
		<div class="dash">
			<h2>Recursos Aprovats</h2>
			<h1>{{ $visibles }}</h1>
		</div>
		<div class="dash">
			<h2>Recursos Per Aprovar</h2>
			<h1>{{ $pendents }}</h1>
		</div>
		<div class="dash">
			<h2>Entitats</h2>
			<h1>{{ $entitats }}</h1>
		</div>
	</div>


@endsection
