<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper(['url','html']); ?>
<div class="container">
   <div class="columns">
      <div class="column col-6">
        <div class="panel m-2 bg-secondary">
          <div class="columns col-gapless">
          <div class="panel-image column col-5">
            <img src="<?php echo $serie->urlImage; ?>" class="img-responsive p-centered">
          </div>
          <div class="panel-body column p-2 col-7">
            <div class="panel-title h5 text-center text-primary">
              <?php echo $serie->nom.' ('.substr($serie->premiere,0,4).')'; ?></div>
            <p class="text-dark text-justify">
              <?php echo $serie->resume; ?>
            </p>
          </div>
        </div>
          </div>
        </div>
        </a>
      </div>
   </div>
  </div>
 </div>
</div>
