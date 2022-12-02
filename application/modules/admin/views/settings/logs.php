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
            <li class="uk-active"><a href="<?= site_url('admin/settings/logs') ?>"><?= lang('logs') ?></a></li>
            <li class="uk-nav-header"><?= lang('security') ?></li>
            <li><a href="<?= site_url('admin/settings/captcha') ?>"><?= lang('captcha') ?></a></li>
            <li><a href="<?= site_url('admin/settings/login') ?>"><?= lang('login') ?></a></li>
          </ul>
        </div>
      </div>
      <div class="uk-width-expand@s">
        <?= $template['partials']['alerts'] ?>
        <?= form_open(current_url()) ?>
          <h2 class="uk-h4 uk-text-bold uk-margin-remove"><?= lang('logs') ?></h2>
          <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= lang('logs_settings_list') ?></p>
          <div class="uk-card uk-card-default uk-margin-small-top uk-margin-bottom">
            <div class="uk-grid-small uk-grid-divider uk-child-width-1-1" uk-grid>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('logs_retention') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_logs_retention') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-grid-small" uk-grid>
                      <div class="uk-width-1-3">
                        <div class="uk-form-controls">
                          <input class="uk-input" type="text" name="value" value="<?= split_data(config_item('logs_keep_interval'), 'digits', 0) ?>" autocomplete="off">
                        </div>
                      </div>
                      <div class="uk-width-2-3">
                        <div class="uk-form-controls">
                          <select class="uk-select tail-single" id="select_option" name="option" autocomplete="off" data-placeholder="<?= lang('select_option') ?>">
                            <option value="D" <?= set_select('option', 'D', 'D' === split_data(config_item('logs_keep_interval'), 'not_digits', 0)) ?>><?= lang('days') ?></option>
                            <option value="M" <?= set_select('option', 'M', 'M' === split_data(config_item('logs_keep_interval'), 'not_digits', 0)) ?>><?= lang('months') ?></option>
                            <option value="Y" <?= set_select('option', 'Y', 'Y' === split_data(config_item('logs_keep_interval'), 'not_digits', 0)) ?>><?= lang('years') ?></option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <?= form_error('value', '<span class="uk-display-block uk-text-small uk-text-danger">', '</span>') ?>
                    <?= form_error('option', '<span class="uk-display-block uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('purge_logs') ?></p>
                    <p class="uk-text-small uk-margin-remove"><span class="uk-text-danger"><i class="fa-solid fa-circle-exclamation"></i></span> <?= lang('purge_logs_note') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <a href="<?= site_url('admin/settings/logs/purge') ?>" class="uk-button uk-button-secondary uk-button-small"><i class="fa-solid fa-dumpster-fire"></i> <?= lang('purge') ?></a>
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
