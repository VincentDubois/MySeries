@extends('templates.main')
@section('content')
<div class="container">
   <div class="columns col-oneline col-gapless">
      <div class="column col-8 p-2">
        <div class="panel bg-secondary">
          <div class="columns col-gapless">
          <div class="panel-image column col-5 p-2">
            <a href="{!!$serie['url']!!}">
              <img {!!cache_src($serie['urlImage'])!!} class="img-responsive p-centered">
            </a>
          </div>
          <div class="panel-body column p-2 col-7">
            <div class="bg-gray p-1 m-1">
            <div class="panel-title h5 text-center text-primary">
              @if(isset($id))
                <form action="{!!url_action('follow',['idSerie'=>$serie['id'],'saison'=>$saison])!!}" method="post">
                  <button action="submit" name="follow" value="{{ $serie['follow'] ? 'false' : 'true' }}"
                       class="btn btn-action s-circle">
                    <i class="icon {{ $serie['follow'] ? 'icon-cross' : 'icon-plus'}}"></i></button>
                  {!!$serie['nom']!!} <span class="h6 text-gray">{{$serie['premiere'] ? substr($serie['premiere'],0,4) : 'Date inconnue'}}</span>
                </form>
              @else
                {!!$serie['nom']!!} <span class="h6 text-gray">{{$serie['premiere'] ? substr($serie['premiere'],0,4) : 'Date inconnue'}}</span>
              @endif
              </div>
            <p class="text-dark text-justify bg-gray">
              {!! $serie['resume'] !!}
              @foreach($genre as $tag)
                <a href="{!!url_page('category',$tag)!!}"><span class="label label-rounded label-secondary">{!!$tag['nom']!!}</span></a>
              @endforeach
              @isset($next['id'])
              <h6 class="text-gray m-2">
                <a href="{!!url_page('serie',['idSerie'=>$serie['id'],'saison'=>$next['saison']])."#$next[saison]"!!}" class="btn btn-action s-circle">
                  <i class="icon icon-forward"></i></a>
                  Prochain épisode le {{date("d/m/Y",strtotime($next['premiere']))}}
              </h6>
              @endisset
            </p>
          </div>
          </div>
  </div>
    <div class="panel-nav p-centered">
    <ul class="pagination">
  <li class="page-item {{ ($saison<=1) ? 'disabled' : '' }}">
    <a href="{!!url_page('serie',['idSerie'=>$serie['id'],'saison'=>$saison-1])!!}">Précédente</a>
  </li>

  @foreach($nav_saison as $nav)
    <li class="page-item {{ $nav == $saison ? 'active' : ''}}">
      @if($nav != null)
        <a href="{!!url_page('serie',['idSerie'=>$serie['id'], 'saison'=>$nav]) !!}">{{$nav}}</a>
      @else
        ...
      @endif
    </li>
  @endforeach
   
  <li class="page-item {{ ($saison>=$last_saison) ? 'disabled' : '' }}">
    <a href="{!!url_page('serie',['idSerie'=>$serie['id'],'saison'=>$saison+1])!!}">Suivante</a>
  </li>
</ul>
</div>
<div class="panel-title label h5 label-rounded label-primary p-2 m-2"> Saison {{$saison}} <span class="h6 text-gray">
  {{$description_saison}}
</span></div>
   <div class="timeline panel-body text-dark py-2">
       @foreach($episode as $element)
                  <div class="timeline-item">
                    <div class="timeline-left">
                      <a class="timeline-icon icon-lg" href="#{{$element['numero']}}">{{$element['numero']}}</a></div>
                    <div class="timeline-content">
                      <div class="tile" id="{{$element['numero']}}">
                        <div class="tile-content">
                          <p class="tile-title">
                            @isset($element['vu'])
                            <form class="form-group mx-2"
                            action="{!! url_action('vu',['idSerie'=>$element['idSerie'],'saison'=>$saison,'idEpisode'=>$element['id'],'numero'=>$element['numero']])!!}"
                            method="post">
                            @endisset
                            <span class="h5 text-primary">{!!$element['nom'] !!}</span>
                            <span class="h6 text-gray">
                            Diffusion le {{ date("d/m/Y",strtotime($element['premiere'])) .
                             ((isset($element['duree']) && $element['duree'] != 0) ? ' durée '.$element['duree']." minutes" : '')
                            }} 
                          </span>
                          @isset($element['vu'])
                            <label class="form-checkbox float-right">
                            <input type="checkbox" name="vu"
                              {!!$element['vu'] ? 'checked="checked"' : '' !!}
                              action="submit" onChange='submit();'>
                            <i class="form-icon"></i> Vu
                            </label>
                            </form>
                          @endisset
                          </p>
                          <div class="tile-subtitle columns bg-gray">
                          <div class="col-7 p-2">
                            <p class="text-justify">{!!$element['resume']!!}</p>
                          </div>
                          <div class="col-5 flex-centered">
                            <a href="{{$element['url']}}">
                              <img {!!cache_src($element['urlImage'],false)!!} class="img-responsive p-2">
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
        @endforeach
</div>
</div>
</div>
  <div class="column col-4 p-2">
    <div class="panel container bg-secondary my-2">
     <div class="columns">
      @foreach($cast as $element)
          <div class="panel-image column col-3 col-xs-12 col-sm-6 col-md-4 col-lg-3 my-2">
          <div class="popover popover-left">
            <a href="{!!url_page('personne',['idPersonne'=>$element['a_id']])!!}">
              <img {{cache_src($element['p_image'])}} class="img-responsive p-centered">
            </a>
          <div class="popover-container">
          <div class="btn-group float-right">
            <a class="btn btn-primary" href="{!!url_page('personne',['idPersonne'=>$element['a_id']])!!}">
              {{$element['p_nom']}}</a>
            <a class="btn " href="{!!url_page('personne',['idPersonne'=>$element['a_id']])!!}"> {{$element['a_nom']}}</a>
    </div>
  </div>
</div>
</div>
    @endforeach
</div>
<div class="panel-action py-2">
    @foreach ($crew as $element)
      <div class="btn-group btn-group my-2 col-12">
        <a href="#" class="btn btn-primary disabled">{{$element['titre']}}</a>
        <a href="{!!url_page('personne',['idPersonne'=>$element['id']])!!}" class="btn btn-secondary">{{$element['nom']}}</a>
      </div>
    @endforeach

</div>
</div>
</div>
</div>

  @endsection
