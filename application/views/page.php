    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold uk-margin-remove"><?= html_escape($page->title) ?></h4>
            <p class="uk-text-meta uk-margin-remove"><i class="far fa-clock"></i> <?= date('F j, Y, H:i', strtotime($page->created_at)) ?></p>
          </div>
          <div class="uk-width-auto"></div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <article class="uk-article">
          <div class="uk-card uk-card-default uk-card-body uk-margin-small">
            <?= $page->description ?>
          </div>
        </article>
      </div>
    </section>
