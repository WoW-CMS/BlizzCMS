<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/settings') ?>"><?= lang('settings') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('settings') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <div class="uk-margin" uk-grid>
      <div class="uk-width-1-3@s uk-width-1-4@m">
        <div class="uk-card uk-card-default">
          <ul class="uk-nav-default" uk-nav>
            <li class="uk-nav-header"><?= lang('base') ?></li>
            <li><a href="<?= site_url('admin/settings') ?>"><?= lang('general') ?></a></li>
            <li><a href="<?= site_url('admin/settings/avatar') ?>"><?= lang('avatar') ?></a></li>
            <li><a href="<?= site_url('admin/settings/discussion') ?>"><?= lang('discussion') ?></a></li>
            <li><a href="<?= site_url('admin/settings/seo') ?>"><?= lang('seo') ?></a></li>
            <li><a href="<?= site_url('admin/settings/mailer') ?>"><?= lang('mailer') ?></a></li>
            <li><a href="<?= site_url('admin/settings/logs') ?>"><?= lang('logs') ?></a></li>
            <li class="uk-nav-header"><?= lang('security') ?></li>
            <li class="uk-active"><a href="<?= site_url('admin/settings/captcha') ?>"><?= lang('captcha') ?></a></li>
            <li><a href="<?= site_url('admin/settings/login') ?>"><?= lang('login') ?></a></li>
          </ul>
        </div>
      </div>
      <div class="uk-width-expand@s">
        <?= $template['partials']['alerts'] ?>
        <?= form_open(current_url()) ?>
          <h2 class="uk-h4 uk-text-bold uk-margin-remove"><?= lang('captcha') ?></h2>
          <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= lang('captcha_settings_list') ?></p>
          <div class="uk-card uk-card-default uk-margin-small">
            <div class="uk-grid-small uk-grid-divider uk-child-width-1-1" uk-grid>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('type') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_type') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <select class="uk-select tail-single" id="select_type" name="captcha_type" autocomplete="off" data-placeholder="<?= lang('select_type') ?>">
                        <option value="hcaptcha" <?= set_select('captcha_type', 'hcaptcha', 'hcaptcha' === config_item('captcha_type')) ?>><?= lang('hcaptcha') ?></option>
                        <option value="recaptcha" <?= set_select('captcha_type', 'recaptcha', 'recaptcha' === config_item('captcha_type')) ?>><?= lang('recaptcha') ?></option>
                        <option value="turnstile" <?= set_select('captcha_type', 'turnstile', 'turnstile' === config_item('captcha_type')) ?>><?= lang('turnstile') ?></option>
                      </select>
                    </div>
                    <?= form_error('captcha_type', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('size') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_size') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <select class="uk-select tail-single" id="select_size" name="captcha_size" autocomplete="off" data-placeholder="<?= lang('select_size') ?>">
                        <option value="normal" <?= set_select('captcha_size', 'normal', 'normal' === config_item('captcha_size')) ?>><?= lang('normal') ?></option>
                        <option value="compact" <?= set_select('captcha_size', 'compact', 'compact' === config_item('captcha_size')) ?>><?= lang('compact') ?></option>
                      </select>
                    </div>
                    <?= form_error('captcha_size', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('theme') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_theme') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <select class="uk-select tail-single" id="select_theme" name="captcha_theme" autocomplete="off" data-placeholder="<?= lang('select_theme') ?>">
                        <option value="light" <?= set_select('captcha_theme', 'light', 'light' === config_item('captcha_theme')) ?>><?= lang('light') ?></option>
                        <option value="dark" <?= set_select('captcha_theme', 'dark', 'dark' === config_item('captcha_theme')) ?>><?= lang('dark') ?></option>
                      </select>
                    </div>
                    <?= form_error('captcha_theme', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('site_key') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_site_key') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="captcha_sitekey" value="<?= config_item('captcha_sitekey') ?>" autocomplete="off">
                    </div>
                    <?= form_error('captcha_sitekey', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('secret_key') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_secret_key') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="captcha_secretkey" placeholder="••••••••••••••••••••" autocomplete="off">
                    </div>
                    <?= form_error('captcha_secretkey', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <h2 class="uk-h4 uk-text-bold uk-margin-top uk-margin-remove-bottom"><?= lang('captcha_on_pages') ?></h2>
          <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= lang('captcha_pages_list') ?></p>
          <div class="uk-card uk-card-default uk-margin-small-top uk-margin-bottom">
            <div class="uk-grid-small uk-grid-divider uk-child-width-1-1" uk-grid>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('login_page') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('status_captcha_login_page') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <label class="uk-switch uk-display-block">
                      <input type="checkbox" name="captcha_login_page" value="true" <?= set_checkbox('captcha_login_page', 'true', config_item('captcha_login_page')) ?>>
                      <div class="uk-switch-slider"></div>
                    </label>
                    <?= form_error('captcha_login_page', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('register_page') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('status_captcha_register_page') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <label class="uk-switch uk-display-block">
                      <input type="checkbox" name="captcha_register_page" value="true" <?= set_checkbox('captcha_register_page', 'true', config_item('captcha_register_page')) ?>>
                      <div class="uk-switch-slider"></div>
                    </label>
                    <?= form_error('captcha_register_page', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('forgot_password_page') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('status_captcha_forgot_page') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <label class="uk-switch uk-display-block">
                      <input type="checkbox" name="captcha_forgot_page" value="true" <?= set_checkbox('captcha_forgot_page', 'true', config_item('captcha_forgot_page')) ?>>
                      <div class="uk-switch-slider"></div>
                    </label>
                    <?= form_error('captcha_forgot_page', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <button class="uk-button uk-button-primary" type="submit"><?= lang('save') ?></button>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</section>
