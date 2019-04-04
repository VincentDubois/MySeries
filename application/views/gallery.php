<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper(['url','html']); ?>

<div class="hero bg-secondary">
  <div class="hero-body">
    <div class="container">
      <div class="columns">
    <?php foreach ($serie_list as $serie): ?>
      <div class="column col-2 col-xs-12 col-sm-6 col-md-4 col-lg-3">
      <div class="card my-2 bg-dark">
        <div class="card-image">
          <img src="<?php echo $serie->urlImage; ?>" class="img-responsive p-centered">
        </div>
      <div class="card-header">
    <div class="card-title h6 text-center text-secondary"><?php echo $serie->nom; ?></div>
  </div>
</div>
</div>
    <?php endforeach; ?>
  </div>
  </div>
  </div>
</div>
