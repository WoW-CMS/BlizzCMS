    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-margin-remove-top uk-margin-small-bottom">
          <div class="uk-grid uk-grid-small" data-uk-grid>
            <div class="uk-width-expand">
              <h4 class="uk-h4 uk-text-bold"><i class="far fa-file-alt"></i> <?= $this->page_model->getName($uri); ?></h4>
            </div>
            <div class="uk-width-auto">
              <p class="uk-text-small"><i class="far fa-clock"></i> <?= date('F j, Y', $this->page_model->getDate($uri)); ?></p>
            </div>
          </div>
        </div>
        <article class="uk-article">
          <div class="uk-card uk-card-default uk-card-body uk-margin-small">
            <?= $this->page_model->getDesc($uri); ?>
          </div>
        </article>
      </div>
    </section>
