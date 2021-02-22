    <section class="uk-section uk-section-xsmall uk-padding-remove header-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-1-5@s"></div>
          <div class="uk-width-3-5@s">
            <h3 class="uk-h3 uk-text-uppercase uk-text-bold uk-margin-medium-top uk-margin-small-bottom"><?= lang('login'); ?></h3>
            <?= $template['partials']['alerts']; ?>
            <?= form_open(current_url()); ?>
            <div class="uk-margin uk-light">
              <label class="uk-form-label"><?= lang('username'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fas fa-user"></i></span>
                  <input class="uk-input" type="text" name="username" placeholder="<?= lang('username'); ?>">
                </div>
              </div>
              <?= form_error('username', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
            </div>
            <div class="uk-margin uk-light">
              <label class="uk-form-label"><?= lang('password'); ?> <span class="uk-float-right"><a href="<?= site_url('forgot'); ?>" class="uk-button uk-button-text"><?= lang('forgot_your_password'); ?></a></span></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fas fa-unlock-alt"></i></span>
                  <input class="uk-input" type="password"  name="password" placeholder="<?= lang('password'); ?>">
                </div>
              </div>
              <?= form_error('password', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
            </div>
            <?php if (config_item('captcha_login') === 'true'): ?>
            <div class="uk-margin-small">
              <div class="<?= (config_item('captcha_type') === 'hcaptcha') ? 'h-captcha' : 'g-recaptcha' ?>" data-sitekey="<?= config_item('captcha_public'); ?>"></div>
            </div>
            <?php endif; ?>
            <button class="uk-button uk-button-default uk-width-1-1 uk-margin-small" type="submit"><i class="fas fa-sign-in-alt"></i> <?= lang('login'); ?></button>
            <?= form_close(); ?>
          </div>
          <div class="uk-width-1-5@s"></div>
        </div>
      </div>
    </section>