<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper(['url','html']);?>

<div class="container">
   <div class="columns col-oneline col-gapless">
      <div class="column col-8 p-2">
        <div class="panel m-2 bg-secondary">
          <div class="columns col-gapless">
          <div class="panel-image column col-5">
            <img src="<?php echo $serie->urlImage; ?>" class="img-responsive p-centered">
          </div>
          <div class="panel-body column p-2 col-7">
            <div class="bg-gray p-1 m-1">
            <div class="panel-title h5 text-center text-primary">
              <?php echo $serie->nom.' ('.substr($serie->premiere,0,4).')'; ?></div>
            <p class="text-dark text-justify bg-gray">
              <?php echo $serie->resume; ?>
            </p>
          </div>
          </div>

  <div class="panel-body column p-2 col-12 ">
   <div class="timeline text-dark">
       <?php foreach($season as $element): ?>
                  <div class="timeline-item">
                    <div class="timeline-left"><a class="timeline-icon icon-lg" href="#"><i class="icon icon-plus"></i></a></div>
                    <div class="timeline-content">
                      <div class="tile bg-gray p-2 m-1">
                        <div class="tile-content">
                          <p class="tile-subtitle h5 text-primary">
                            <?php echo date("Y",strtotime($element->debut)). " : Saison ". $element->saison ." ( ". $element->nb. " épisodes ) ";?></p>
                          <p class="tile-title"><?php   echo "Du " . date("d/m/Y",strtotime($element->debut)); ?></p>
                          <p class="tile-title"><?php   echo "Au " . date("d/m/Y",strtotime($element->fin)); ?></p>
                        </div>
                        <div class="tile-action">
                          <button class="btn">Détail</button>
                        </div>
                      </div>
                    </div>
                  </div>
        <?php endforeach; ?>
</div>
</div>
</div>
</div>
</div>

  <div class="column col-4">
     <div class="columns col-gapless py-2">
      <?php foreach ($cast as $element): ?>
          <div class="popover popover-left column col-3 col-xs-12 col-sm-6 col-md-4 col-lg-3">
            <img src="<?php echo $element->p_image; ?>" class="img-responsive p-centered p-2">
          <div class="popover-container">
          <div class="btn-group float-right">
            <a class="btn btn-primary" href="<?php echo site_url('personne/'.$element->a_id); ?>">
              <?php echo $element->p_nom; ?></a>
            <a class="btn " href="#"><?php echo $element->a_nom; ?></a>
    </div></div></div>
    <?php endforeach; ?>
</div>
</div>
</div>
  </div>
 </div>
