<section class="uk-section uk-section-xsmall bc-primary-section" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-grid-small" uk-grid>
      <div class="uk-width-1-4@s"></div>
      <div class="uk-width-1-2@s">
        <h1 class="uk-h3 uk-text-uppercase uk-text-bold uk-margin-medium-top uk-margin-remove-bottom"><?= lang('forgot_password') ?></h1>
        <p class="uk-margin-remove-top uk-margin-small-bottom"><?= lang('fill_form_password_reset') ?></p>
        <?= $template['partials']['alerts'] ?>
        <?= form_open(current_url()) ?>
          <div class="uk-grid-small uk-margin-small" uk-grid>
            <div class="uk-width-1-1">
              <label class="uk-form-label"><?= lang('email') ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fa-solid fa-envelope"></i></span>
                  <input class="uk-input" type="text" name="email" placeholder="<?= lang('email') ?>" autocomplete="off">
                </div>
              </div>
              <?= form_error('email', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <?php if (config_item('captcha_forgot_page')): ?>
            <div class="uk-width-1-1">
              <?= captcha_widget() ?>
            </div>
            <?php endif ?>
          </div>
          <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small-top" type="submit"><?= lang('send') ?></button>
        <?= form_close() ?>
      </div>
      <div class="uk-width-1-4@s"></div>
    </div>
  </div>
</section>
