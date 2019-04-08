<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper(['url','html','image_cache']);?>
<div class="container">
   <div class="columns col-gapless">
      <div class="column col-auto m-2">
        <div class="panel bg-secondary">
          <div class="panel-image">
            <img <?php cache_src($personne->urlImage);?> class="img-responsive p-centered">
          </div>
            <div class="panel-title text-center bg-dark">
            <div class="h5 text-secondary"><?=$personne->nom ?></div>
            <div class="h6 text-light"><?=$personne->pays ?></div>
            <div class="text-gray h6 text-center">
                <?=date("d/m/Y",strtotime($personne->naissance))?> -
                <?=$personne->mort ? date("d/m/Y",strtotime($personne->mort)) : ''?>
            </div>
          </div>
          </div>
        </div>
  <div class="column m-2 col-auto">
  <?php foreach ($serie as $element): ?>
    <div class="panel m-2">
        <div class="columns col-gapless bg-secondary">
        <a href="<?php echo site_url('serie/'.$element['s_id']); ?>" class="hover-up column col-auto bg-dark">
        <div class="panel-title text-center text-secondary h5"><?=$element['s_nom']?></div>
          <div class="panel-image py-2">
            <img <?php cache_src($element['s_image']); ?> class="img-responsive p-centered">
        </div>
      </a>
        <?php foreach ($element['character'] as $role): ?>
          <div class="column panel-content col-auto">
            <div class="panel bg-gray m-2">
              <div class="panel-title text-center h5"><?=$role['p_nom']?></div>
          <div class="panel-image">
            <img <?php cache_src($role['p_image']); ?> class="img-responsive p-centered">
        </div>
            </div>
          </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endforeach; ?>

</div></div>
