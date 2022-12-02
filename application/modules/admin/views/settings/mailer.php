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
            <li class="uk-active"><a href="<?= site_url('admin/settings/mailer') ?>"><?= lang('mailer') ?></a></li>
            <li><a href="<?= site_url('admin/settings/logs') ?>"><?= lang('logs') ?></a></li>
            <li class="uk-nav-header"><?= lang('security') ?></li>
            <li><a href="<?= site_url('admin/settings/captcha') ?>"><?= lang('captcha') ?></a></li>
            <li><a href="<?= site_url('admin/settings/login') ?>"><?= lang('login') ?></a></li>
          </ul>
        </div>
      </div>
      <div class="uk-width-expand@s">
        <?= $template['partials']['alerts'] ?>
        <?= form_open(current_url()) ?>
          <div class="uk-grid-small uk-margin-small-bottom uk-flex uk-flex-middle" uk-grid>
            <div class="uk-width-expand">
              <h2 class="uk-h4 uk-text-bold uk-margin-remove"><?= lang('mailer') ?></h2>
              <p class="uk-text-small uk-margin-remove"><?= lang('mailer_settings_list') ?></p>
            </div>
            <div class="uk-width-auto">
              <a href="<?= site_url('admin/settings/mailer/test') ?>" class="uk-button uk-button-secondary uk-button-small"><i class="fa-solid fa-envelope-circle-check"></i> <?= lang('verify') ?></a>
            </div>
          </div>
          <div class="uk-card uk-card-default uk-margin-small">
            <div class="uk-grid-small uk-grid-divider uk-child-width-1-1" uk-grid>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('protocol') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_protocol') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <select class="uk-select tail-single" id="select_protocol" name="protocol" autocomplete="off" data-placeholder="<?= lang('select_protocol') ?>">
                        <option value="mail" <?= set_select('protocol', 'mail', 'mail' === config_item('mailer_protocol')) ?>><?= lang('mail') ?></option>
                        <option value="sendmail" <?= set_select('protocol', 'sendmail', 'sendmail' === config_item('mailer_protocol')) ?>><?= lang('sendmail') ?></option>
                        <option value="smtp" <?= set_select('protocol', 'smtp', 'smtp' === config_item('mailer_protocol')) ?>><?= lang('smtp') ?></option>
                      </select>
                    </div>
                    <?= form_error('protocol', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('encryption') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_encryption') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <select class="uk-select tail-single" id="select_encryption" name="encryption" autocomplete="off" data-placeholder="<?= lang('select_encryption') ?>">
                        <option value="" <?= set_select('encryption', '', '' === config_item('mailer_encryption')) ?>><?= lang('none') ?></option>
                        <option value="ssl" <?= set_select('encryption', 'ssl', 'ssl' === config_item('mailer_encryption')) ?>><?= lang('ssl') ?></option>
                        <option value="tls" <?= set_select('encryption', 'tls', 'tls' === config_item('mailer_encryption')) ?>><?= lang('tls') ?></option>
                      </select>
                    </div>
                    <?= form_error('encryption', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('hostname') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_hostname') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="hostname" value="<?= config_item('mailer_hostname') ?>" autocomplete="off">
                    </div>
                    <?= form_error('hostname', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('port') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_port') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="port" value="<?= config_item('mailer_port') ?>" autocomplete="off">
                    </div>
                    <?= form_error('port', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('username') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_username') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="username" value="<?= config_item('mailer_username') ?>" autocomplete="off">
                    </div>
                    <?= form_error('username', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('password') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_password') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="password" name="password" placeholder="••••••••••••••••••••" autocomplete="new-password">
                    </div>
                    <?= form_error('password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('from_name') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_name') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="from_name" value="<?= config_item('mailer_from_name') ?>" autocomplete="off">
                    </div>
                    <?= form_error('from_name', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('from_email') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_email') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="from_email" value="<?= config_item('mailer_from_email') ?>" autocomplete="off">
                    </div>
                    <?= form_error('from_email', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <h2 class="uk-h4 uk-text-bold uk-margin-top uk-margin-remove-bottom"><?= lang('mailer_on_sections') ?></h2>
          <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= lang('mailer_sections_list') ?></p>
          <div class="uk-card uk-card-default uk-margin-small-top uk-margin-bottom">
            <div class="uk-grid-small uk-grid-divider uk-child-width-1-1" uk-grid>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('account_confirmation') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('status_account_confirmation') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <label class="uk-switch uk-display-block">
                      <input type="checkbox" name="account_confirmation" value="true" <?= set_checkbox('account_confirmation', 'true', config_item('mailer_account_confirmation')) ?>>
                      <div class="uk-switch-slider"></div>
                    </label>
                    <?= form_error('account_confirmation', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
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
