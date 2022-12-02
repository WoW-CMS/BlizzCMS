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
            <li><a href="<?= site_url('admin/settings/captcha') ?>"><?= lang('captcha') ?></a></li>
            <li class="uk-active"><a href="<?= site_url('admin/settings/login') ?>"><?= lang('login') ?></a></li>
          </ul>
        </div>
      </div>
      <div class="uk-width-expand@s">
        <?= $template['partials']['alerts'] ?>
        <?= form_open(current_url()) ?>
          <h2 class="uk-h4 uk-text-bold uk-margin-remove"><?= lang('login') ?></h2>
          <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= lang('login_settings_list') ?></p>
          <div class="uk-card uk-card-default uk-margin-small-top uk-margin-bottom">
            <div class="uk-grid-small uk-grid-divider uk-child-width-1-1" uk-grid>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('max_attempts') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_login_max_attempts') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="max_attempts" value="<?= config_item('login_max_attempts') ?>" autocomplete="off">
                    </div>
                    <?= form_error('max_attempts', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('lockout_time') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_login_lockout_time') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-grid-small" uk-grid>
                      <div class="uk-width-1-3">
                        <div class="uk-form-controls">
                          <input class="uk-input" type="text" name="lockout_interval" value="<?= split_data(config_item('login_lockout_interval'), 'digits', 0) ?>" autocomplete="off">
                        </div>
                      </div>
                      <div class="uk-width-2-3">
                        <div class="uk-form-controls">
                          <select class="uk-select tail-single" id="select_lockout_option" name="lockout_option" autocomplete="off" data-placeholder="<?= lang('select_option') ?>">
                            <option value="M" <?= set_select('lockout_option', 'M', 'M' === split_data(config_item('login_lockout_interval'), 'not_digits', 0)) ?>><?= lang('minutes') ?></option>
                            <option value="H" <?= set_select('lockout_option', 'H', 'H' === split_data(config_item('login_lockout_interval'), 'not_digits', 0)) ?>><?= lang('hours') ?></option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?= form_error('lockout_interval', '<span class="uk-display-block uk-text-small uk-text-danger">', '</span>') ?>
                    <?= form_error('lockout_option', '<span class="uk-display-block uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('reset_attempts') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_login_reset_attempts') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-grid-small" uk-grid>
                      <div class="uk-width-1-3">
                        <div class="uk-form-controls">
                          <input class="uk-input" type="text" name="reset_interval" value="<?= split_data(config_item('login_reset_interval'), 'digits', 0) ?>" autocomplete="off">
                        </div>
                      </div>
                      <div class="uk-width-2-3">
                        <div class="uk-form-controls">
                          <select class="uk-select tail-single" id="select_reset_option" name="reset_option" autocomplete="off" data-placeholder="<?= lang('select_option') ?>">
                            <option value="M" <?= set_select('reset_option', 'M', 'M' === split_data(config_item('login_reset_interval'), 'not_digits', 0)) ?>><?= lang('minutes') ?></option>
                            <option value="H" <?= set_select('reset_option', 'H', 'H' === split_data(config_item('login_reset_interval'), 'not_digits', 0)) ?>><?= lang('hours') ?></option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?= form_error('reset_interval', '<span class="uk-display-block uk-text-small uk-text-danger">', '</span>') ?>
                    <?= form_error('reset_option', '<span class="uk-display-block uk-text-small uk-text-danger">', '</span>') ?>
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
