<section class="uk-section uk-section-small bc-primary-section" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-expand">
        <h1 class="uk-h3 uk-text-uppercase uk-text-bold uk-text-center uk-margin-remove"><?= $heading ?></h1>
        <p class="uk-text-meta uk-text-center uk-margin-remove"><?= $message ?></p>
        <div class="uk-flex uk-flex-center uk-margin-top">
          <a href="<?= site_url('login') ?>" class="uk-button uk-button-default"><i class="fa-solid fa-right-to-bracket"></i> <?= lang('login') ?></a>
        </div>
      </div>
      <div class="uk-width-auto"></div>
    </div>
  </div>
</section>
