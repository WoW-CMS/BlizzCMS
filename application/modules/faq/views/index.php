    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="far fa-question-circle"></i> <?= $this->lang->line('tab_faq'); ?></h4>
        <?php if($this->faq_model->getAll()->num_rows()): ?>
        <div class="uk-margin-small-top">
          <ul uk-tab="connect: #faq">
            <?php foreach($this->faq_model->getFaqType() as $type): ?>
            <li><a href="#"><?= $type->title ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <ul id="faq" class="uk-switcher uk-margin">
          <?php foreach($this->faq_model->getFaqType() as $type): ?>
          <li>
            <div class="uk-grid uk-grid-small uk-child-width-1-2@s" data-uk-grid>
              <?php foreach($this->faq_model->getFaqList($type->id) as $list): ?>
              <div>
                <h5 class="uk-h5 uk-text-uppercase uk-margin-small"><i class="fas fa-question-circle"></i> <?= $list->title ?></h5>
                <div class="uk-card uk-card-default uk-card-body">
                  <?= $list->description ?>
                </div>
              </div>
              <?php endforeach; ?>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <div class="uk-alert-warning" uk-alert>
          <p class="uk-text-center"><i class="fas fa-exclamation-triangle"></i> <?= $this->lang->line('alert_faq_not_found'); ?></p>
        </div>
        <?php endif; ?>
      </div>
    </section>
