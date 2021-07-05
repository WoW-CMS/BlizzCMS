    <section class="uk-section uk-section-xsmall header-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-1-5@s"></div>
          <div class="uk-width-3-5@s">
            <h3 class="uk-h3 uk-text-uppercase uk-text-bold uk-margin-medium-top uk-margin-small-bottom"><?= lang('forgot_password') ?></h3>
            <?= $template['partials']['alerts'] ?>
            <?= form_open(current_url()) ?>
            <div class="uk-margin uk-light">
              <label class="uk-form-label"><?= lang('email') ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fas fa-envelope"></i></span>
                  <input class="uk-input" type="email" name="email" placeholder="<?= lang('email') ?>">
                </div>
                <?= form_error('email', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
              </div>
            </div>
            <?php if (config_item('captcha_forgot') === 'true'): ?>
            <div class="uk-margin-small">
              <div class="<?= (config_item('captcha_type') === 'hcaptcha') ? 'h-captcha' : 'g-recaptcha' ?>" data-sitekey="<?= config_item('captcha_public') ?>" data-theme="<?= config_item('captcha_theme') ?>"></div>
            </div>
            <?php endif ?>
            <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small" type="submit"><i class="fas fa-paper-plane"></i> <?= lang('send') ?></button>
            <?= form_close() ?>
          </div>
          <div class="uk-width-1-5@s"></div>
        </div>
      </div>
    </section>