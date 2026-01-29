@extends('templates.main')
@section('content')

<div class="container hero">
   <div class="columns ">
      <div class="column col-auto p-2 m-2">
        <div class="panel bg-secondary">
          <div class="panel-image">
            <a href="{!!$personne['url']!!}">
              <img {!!cache_src($personne['urlImage'])!!} class="img-responsive p-centered">
            </a>
          </div>
            <div class="panel-title text-center bg-primary">
            <div class="h5 text-secondary">{{$personne['nom']}}</div>
            <div class="h6 text-light">{{$personne['pays']}}</div>
            <div class="text-gray h6 text-center">
                {{$personne['naissance'] ? date("d/m/Y",strtotime($personne['naissance'])) : ''}} -
                {{$personne['mort'] ? date("d/m/Y",strtotime($personne['mort'])) : ''}}
            </div>
          </div>
          </div>
        </div>
    <div class="column p-2">
      <div class="columns">
  @foreach($serie as $element)
    <div class="column col-auto my-2">
        <div class="panel bg-secondary ">
          <div class="columns col-gapless">
        <a href="{!!url_page('serie',['idSerie'=>$element['s_id']])!!}" class="hover-up column col-auto bg-dark">
        <div class="panel-title text-center text-secondary h5">{{$element['s_nom']}}</div>
        <div class="panel-image">
            <img {!! cache_src($element['s_image']) !!} class="img-responsive p-centered">
        </div>
        @if(isset($element['crew']) && count($element['crew'])>0)
            <div class="panel-title p-2 text-centered bg-gray">
              @foreach($element['crew'] as $crew)
                  <span class="label label-rounded label-primary">{{$crew['titre']}}</span>
              @endforeach
            </div>
        @endif

      </a>
        @isset($element['character'])
        @foreach($element['character'] as $role)
          <div class="column panel-subtitle">
            <div class="panel bg-gray">
              <div class="panel-title text-center h5">{{$role['p_nom']}}</div>
          <div class="panel-image">
            <img {!! cache_src($role['p_image']); !!} class="img-responsive p-centered">
        </div>
            </div>
          </div>
        @endforeach
        @endisset
    </div>
    </div>
</div>
@endforeach
</div>
</div>
</div>

@endsection
