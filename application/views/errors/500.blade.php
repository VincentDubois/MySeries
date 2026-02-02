@extends('templates.erreur')
@section('content')
<div class="log">
  <h1>500 Erreur coté serveur</h1>
  @isset($log)
    <h2>Détail de l'erreur</h2>
    {!!$log!!}
  @endisset
  </div>
@endsection