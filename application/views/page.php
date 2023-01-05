<section class="uk-section uk-section-small bc-primary-section" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-margin-top uk-margin-medium-bottom" uk-grid>
      <div class="uk-width-expand">
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= html_escape($page->title) ?></h1>
        <p class="uk-text-meta uk-margin-remove"><i class="fa-solid fa-calendar-day"></i> <time datetime="<?= format_date($page->created_at, 'c') ?>"><?= format_date($page->created_at, 'M j, Y, h:i A') ?></time></p>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $page->content ?>
  </div>
</section>
