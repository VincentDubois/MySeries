@extends('templates.main')
@section('content')

@isset($categories)
<div class="panel bg-gray">
  <div class="panel-body">
   @foreach ($categories as $tag)
     <a href="{!!url_page('category',$tag)!!}">
       <span class="label label-rounded m-1 {{ $tag['nom'] == $current_cat ? "label-primary" : "label-secondary" }} ">
       {{$tag['nom'].' ('.$tag['count'].') '}}</span></a>
   @endforeach
  </div>
</div>
@endisset
@isset($serie_list)
<div class="hero bg-secondary">
 <div class="hero-body">
  <div class="container">
   <div class="columns">
    @foreach($serie_list as $serie)
      <div class="column col-2 col-xs-12 col-sm-6 col-md-4 col-lg-3" >
        <a href="{!!url_page('serie',['idSerie' => $serie['id']])!!}" class="panel my-2 hover-up bg-dark my-badge"
          @if( ($serie['new'] ?? 0) >0)
            data-badge="{{$serie['new']}}"
          @endif
          >
          <div class="panel-image">
            <img {{cache_src($serie['urlImage'])}} class="img-responsive p-centered">
          </div>
          <div class="panel-body p-2">
            <div class="panel-title h6 text-center text-secondary">{!! $serie['nom'] !!}</div>
          </div>
        </a>
      </div>
    @endforeach
   </div>
  </div>
 </div>
</div>
@endisset

@endsection
