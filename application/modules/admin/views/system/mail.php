    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('mail_smtp') ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
              <li><a href="<?= site_url('admin/system') ?>"><?= lang('system') ?></a></li>
              <li><span><?= lang('mail_smtp') ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto"></div>
        </div>
        <div class="uk-card uk-card-default">
          <ul class="uk-subnav" uk-margin>
            <li><a href="<?= site_url('admin/system') ?>"><span class="uk-margin-small-right"><i class="fas fa-list-alt"></i></span><?= lang('home') ?></a></li>
            <li class="uk-active">
              <a href="#"><span class="uk-margin-small-right"><i class="fas fa-sliders-h"></i></span><?= lang('settings') ?><span uk-icon="icon: triangle-down"></span></a>
              <div uk-dropdown="mode: click;">
                <ul class="uk-nav uk-dropdown-nav">
                  <li><a href="<?= site_url('admin/system/general') ?>"><?= lang('general') ?></a></li>
                  <li><a href="<?= site_url('admin/system/captcha') ?>"><?= lang('captcha') ?></a></li>
                  <li class="uk-active"><a href="<?= site_url('admin/system/mail') ?>"><?= lang('mail_smtp') ?></a></li>
                </ul>
              </div>
            </li>
            <li><a href="<?= site_url('admin/system/logs') ?>"><span class="uk-margin-small-right"><i class="fas fa-list"></i></span><?= lang('logs') ?></a></li>
          </ul>
        </div>
        <?= $template['partials']['alerts'] ?>
        <?= form_open(current_url()) ?>
        <div class="uk-card uk-card-default uk-margin-small">
          <div class="uk-card-body">
            <div class="uk-margin-small-bottom">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-1-2@s uk-width-1-4@m">
                  <label class="uk-form-label"><?= lang('mailer') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="mailer">
                      <option value="" hidden selected><?= lang('select_mailer') ?></option>
                      <option value="mail" <?php if ('mail' === config_item('mail_mailer')) echo 'selected' ?>><?= lang('mail') ?></option>
                      <option value="sendmail" <?php if ('sendmail' === config_item('mail_mailer')) echo 'selected' ?>><?= lang('sendmail') ?></option>
                      <option value="smtp" <?php if ('smtp' === config_item('mail_mailer')) echo 'selected' ?>><?= lang('smtp') ?></option>
                    </select>
                  </div>
                  <?= form_error('mailer', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-2@s uk-width-1-4@m">
                  <label class="uk-form-label"><?= lang('encryption') ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="encryption">
                      <option value="" hidden selected><?= lang('select_encryption') ?></option>
                      <option value="ssl" <?php if ('ssl' === config_item('mail_encryption')) echo 'selected' ?>><?= lang('ssl') ?></option>
                      <option value="tls" <?php if ('tls' === config_item('mail_encryption')) echo 'selected' ?>><?= lang('tls') ?></option>
                    </select>
                  </div>
                  <?= form_error('encryption', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-2@s uk-width-1-4@m">
                  <label class="uk-form-label"><?= lang('hostname') ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-mail-bulk"></i></span>
                      <input class="uk-input" type="text" name="hostname" value="<?= config_item('mail_hostname') ?>">
                    </div>
                  </div>
                  <?= form_error('hostname', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-2@s uk-width-1-4@m">
                  <label class="uk-form-label"><?= lang('port') ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-ethernet"></i></span>
                      <input class="uk-input" type="text" name="port" value="<?= config_item('mail_port') ?>">
                    </div>
                  </div>
                  <?= form_error('port', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('username') ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-user"></i></span>
                      <input class="uk-input" type="text" name="username" value="<?= config_item('mail_username') ?>">
                    </div>
                  </div>
                  <?= form_error('username', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('password') ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-key"></i></span>
                      <input class="uk-input" type="password" name="password" placeholder="••••••••••••••••••••">
                    </div>
                  </div>
                  <?= form_error('password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <label class="uk-form-label"><?= lang('sender') ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fas fa-user-circle"></i></span>
                  <input class="uk-input" type="text" name="sender" value="<?= config_item('mail_sender') ?>">
                </div>
              </div>
              <?= form_error('sender', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom uk-heading-line"><span><?= lang('register_validation') ?></span></h5>
            <div class="uk-grid uk-grid-small uk-flex uk-flex-middle uk-margin-small" data-uk-grid>
              <div class="uk-width-expand">
                <label class="uk-form-label"><i class="fas fa-toggle-off"></i> <?= lang('enable_register_validation') ?></label>
                <?= form_error('validation', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
              </div>
              <div class="uk-width-auto">
                <label class="uk-switch">
                  <input type="checkbox" name="validation" value="true" <?php if ('true' == config_item('mail_validation')) echo 'checked' ?>>
                  <div class="uk-switch-slider"></div>
                </label>
              </div>
            </div>
          </div>
        </div>
        <button class="uk-button uk-button-primary uk-margin-small" type="submit"><i class="fas fa-sync"></i> <?= lang('update') ?></button>
        <?= form_close() ?>
      </div>
    </section>