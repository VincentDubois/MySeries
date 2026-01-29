@extends('templates.main')
@section('content')
<div class="hero bg-secondary">
 <div class="hero-body">
  <div class="container">
     <div class="columns">
     @foreach ($serie_list as $element)
     <div class="column col-12 my-2">
       <div class="panel bg-secondary" id="<?=$element['id']?>">
         <div class="columns col-gapless">
       <a href="{!!url_page('serie',['idSerie'=> $element['id']])!!}" class="hover-up column col-auto bg-dark">
       <div class="panel-title text-center text-secondary h5">{!!$element['nom']!!}</div>
       <div class="panel-subtitle">
        <div class="bar">
          
          <div class="bar-item text-gray" role="progressbar" style="width:{!!$element['progress']!!}%"
             aria-valuenow="{!!$element['vu']!!}" aria-valuemin="0" aria-valuemax="{!!$element['total']!!}">
           {!!$element['vu'].'/'.$element['total']!!}</div>
        </div>
      </div>
       <div class="panel-image">
           <img {!!cache_src($element['urlImage'])!!} class="img-responsive p-centered">
       </div>

     </a>
        @if(isset($element['episode']))
        @foreach($element['episode'] as $i=>$episode)
        @if($i<3 && $i < count($element['episode']))
         <div class="column col-auto panel-subtitle">
           <a href="{!!url_page('serie',$episode).'#'.$episode['numero'] !!}"
              class="panel hover-up">
             <div class="panel-subtitle text-center text-gray h6">
               {{'S'.$episode['saison'].'E'.$episode['numero']}}</div>
             <div class="panel-title text-center h5">{!! $episode['nom'] !!}</div>
         <div class="panel-image">
           <img {!!cache_src($episode['urlImage']) !!} class="img-responsive p-centered">
       </div>
            <div class="panel-subtitle text-center text-secondary bg-dark h6">
             Diffusion le {{ date("d/m/Y", strtotime($episode['premiere'])) }}
            </div>
          </a>
          <div class="text-dark bg-secondary h6">
            <form class="form-group mx-2"
            action="{!! url_action('vu',  ['idSerie'=>$episode['idSerie'],'idEpisode'=>$episode['id']]).'#'.$episode['numero'] !!}"
            method="post">
  <label class="form-checkbox">
    <input type="checkbox" action="submit" name="vu" onChange='submit();'>
    <i class="form-icon"></i> Episode déjà vu
  </label>
</form>
 </div>
         </div>
     @endif
     @endforeach
     @endif

     </div>
     </div>
     </div>
     @endforeach
   </div>
  </div>
 </div>
</div>

@endsection