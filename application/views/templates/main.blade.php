@php
require_once 'application/helpers/queries/User.php';
@endphp
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>My Series</title>
    <link rel="stylesheet" href="{{URL_CSS}}spectre.min.css">
    <link rel="stylesheet" href="{{URL_CSS}}spectre-icons.min.css">
    <link rel="stylesheet" href="{{URL_CSS}}spectre-exp.min.css">
    <link rel="stylesheet" href="{{URL_CSS}}custom.css">
</head>
<body>
  <header class="navbar bg-primary">
  <section class="navbar-section">
    <a href="{{BASE_URL}}"
       class="navbar-brand mr-2 px-2 text-secondary">
           <img class="icon icon-2x" src="{{URL_PUBLIC}}icon.png">
           Mes Séries
    </a>
    <a href="{!!url_page('category')!!}" class="btn btn-primary">Catégories</a>

   @if(is_logged())
      <a href="{!!url_page('home')!!}" class="btn btn-primary">Perso</a>
    @endif
  </section>

@if(is_logged())
  <section class="navbar-section">
    <form action="{!!url_action('logout')!!}" method="post">
    <div class="input-group input-inline">
      <span class="input-group-addon text-primary">
        <i class="form-icon icon icon-people text-primary"></i>
        {{$email}} </span>
      <button type="submit" class="btn btn-secondary input-group-btn">Déconnexion</button>
    </div>
  </form>
  </section>
@else
  <section class="navbar-section">
    <form action="{!!url_action('login')!!}" method="post">
    <div class="input-group input-inline has-icon-left">
        <input class="form-input" name="email" type="email" placeholder="email">
        <i class="form-icon icon icon-people text-primary"></i>
      <input class="form-input" name="password" type="password" placeholder="password">
      <button type="submit" class="btn btn-secondary input-group-btn">Se connecter/S'inscrire</button>
    </div>
  </form>
  </section>
@endif
</header>

@yield("content")
 
@isset($_SESSION['info'])
      <p id="info">{{$_SESSION['info']}}</p>@php unset($_SESSION['info']); @endphp
@endisset

<p class="footer bg-secondary text-center">
  Site réalisé avec
 <a href="https://picturepan2.github.io/spectre/">Spectre CSS.</a>

  Données sur les séries par <a href="https://www.tvmaze.com/">TV Maze</a>
</p>
</body>
</html>

