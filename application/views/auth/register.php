    <section class="uk-section uk-section-xsmall uk-padding-remove header-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-1-5@s"></div>
          <div class="uk-width-3-5@s">
            <h3 class="uk-h3 uk-text-uppercase uk-text-bold  uk-margin-medium-top uk-margin-small-bottom"><?= lang('button_register'); ?></h3>
            <?= form_open(current_url()); ?>
            <?= $template['partials']['alerts']; ?>
            <div class="uk-margin uk-light">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_nickname'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-user"></i></span>
                      <input class="uk-input" type="text" name="nickname" placeholder="<?= lang('placeholder_nickname'); ?>">
                    </div>
                  </div>
                  <?= form_error('nickname', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_username'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-user"></i></span>
                      <input class="uk-input" type="text" name="username" placeholder="<?= lang('placeholder_username'); ?>">
                    </div>
                  </div>
                  <?= form_error('username', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <div class="uk-margin uk-light">
              <label class="uk-form-label"><?= lang('placeholder_email'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fas fa-envelope"></i></span>
                  <input class="uk-input" type="email" name="email" placeholder="<?= lang('placeholder_email'); ?>">
                </div>
              </div>
              <?= form_error('email', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
            </div>
            <div class="uk-margin uk-light">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_password'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-lock"></i></span>
                      <input class="uk-input" type="password" name="password" placeholder="<?= lang('placeholder_password'); ?>">
                    </div>
                  </div>
                  <?= form_error('password', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_password'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-lock"></i></span>
                      <input class="uk-input" type="password" name="confirm_password" placeholder="<?= lang('placeholder_re_password'); ?>">
                    </div>
                  </div>
                  <?= form_error('confirm_password', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <?php if (config_item('captcha_register') == 'true'): ?>
            <div class="uk-margin-small">
              <div class="g-recaptcha" data-sitekey="<?= config_item('captcha_public'); ?>"></div>
            </div>
            <?php endif; ?>
            <button class="uk-button uk-button-default uk-width-1-1" type="submit"><i class="fas fa-user-plus"></i> <?= lang('button_register'); ?></button>
            <?= form_close(); ?>
          </div>
          <div class="uk-width-1-5@s"></div>
        </div>
      </div>
    </section>