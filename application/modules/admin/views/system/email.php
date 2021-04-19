    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('email_preferences'); ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin'); ?>"><?= lang('dashboard'); ?></a></li>
              <li><a href="<?= site_url('admin/system'); ?>"><?= lang('system'); ?></a></li>
              <li><span><?= lang('email_preferences'); ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto"></div>
        </div>
        <div class="uk-card uk-card-default">
          <ul class="uk-subnav" uk-margin>
            <li><a href="<?= site_url('admin/system'); ?>"><span class="uk-margin-small-right"><i class="fas fa-list-alt"></i></span>Index</a></li>
            <li class="uk-active">
              <a href="#"><span class="uk-margin-small-right"><i class="fas fa-tools"></i></span><?= lang('settings'); ?><span uk-icon="icon: triangle-down"></span></a>
              <div uk-dropdown="mode: click;">
                <ul class="uk-nav uk-dropdown-nav">
                  <li><a href="<?= site_url('admin/system/general'); ?>"><?= lang('general'); ?></a></li>
                  <li><a href="<?= site_url('admin/system/captcha'); ?>"><?= lang('captcha'); ?></a></li>
                  <li class="uk-active"><a href="<?= site_url('admin/system/email'); ?>"><?= lang('email_preferences'); ?></a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
        <?= $template['partials']['alerts']; ?>
        <?= form_open(current_url()); ?>
        <div class="uk-card uk-card-default uk-margin-small">
          <div class="uk-card-body">
            <div class="uk-margin-small-bottom">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-1-2@s uk-width-1-4@m">
                  <label class="uk-form-label"><?= lang('protocol'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="email_protocol">
                      <option value="" hidden selected><?= lang('select_protocol'); ?></option>
                      <option value="mail" <?php if ('mail' === config_item('email_protocol')) echo 'selected'; ?>><?= lang('mail'); ?></option>
                      <option value="sendmail" <?php if ('sendmail' === config_item('email_protocol')) echo 'selected'; ?>><?= lang('sendmail'); ?></option>
                      <option value="smtp" <?php if ('smtp' === config_item('email_protocol')) echo 'selected'; ?>><?= lang('smtp'); ?></option>
                    </select>
                  </div>
                  <?= form_error('email_protocol', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-width-1-2@s uk-width-1-4@m">
                  <label class="uk-form-label"><?= lang('encryption'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="email_crypto">
                      <option value="" hidden selected><?= lang('select_encryption'); ?></option>
                      <option value="ssl" <?php if ('ssl' === config_item('email_crypto')) echo 'selected'; ?>><?= lang('ssl'); ?></option>
                      <option value="tls" <?php if ('tls' === config_item('email_crypto')) echo 'selected'; ?>><?= lang('tls'); ?></option>
                    </select>
                  </div>
                  <?= form_error('email_crypto', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-width-1-2@s uk-width-1-4@m">
                  <label class="uk-form-label"><?= lang('hostname'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-mail-bulk"></i></span>
                      <input class="uk-input" type="text" name="email_host" value="<?= config_item('email_hostname'); ?>" placeholder="<?= lang('hostname'); ?>">
                    </div>
                  </div>
                  <?= form_error('email_host', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-width-1-2@s uk-width-1-4@m">
                  <label class="uk-form-label"><?= lang('port'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-ethernet"></i></span>
                      <input class="uk-input" type="text" name="email_port" value="<?= config_item('email_port'); ?>" placeholder="<?= lang('port'); ?>">
                    </div>
                  </div>
                  <?= form_error('email_port', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('username'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-user"></i></span>
                      <input class="uk-input" type="text" name="email_user" value="<?= config_item('email_username'); ?>" placeholder="<?= lang('username'); ?>">
                    </div>
                  </div>
                  <?= form_error('email_user', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('password'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-key"></i></span>
                      <input class="uk-input" type="password" name="email_pass" placeholder="••••••••••••••••••••">
                    </div>
                  </div>
                  <?= form_error('email_pass', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('sender_email'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-envelope"></i></span>
                      <input class="uk-input" type="email" name="email_sender" value="<?= config_item('email_sender'); ?>" placeholder="<?= lang('email'); ?>">
                    </div>
                  </div>
                  <?= form_error('email_sender', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('sender_name'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-user-circle"></i></span>
                      <input class="uk-input" type="text" name="email_sender_name" value="<?= config_item('email_sender_name'); ?>" placeholder="<?= lang('name'); ?>">
                    </div>
                  </div>
                  <?= form_error('email_sender_name', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom uk-heading-line"><span><?= lang('register_validation'); ?></span></h5>
            <div class="uk-grid uk-grid-small uk-flex uk-flex-middle uk-margin-small" data-uk-grid>
              <div class="uk-width-expand">
                <label class="uk-form-label"><i class="fas fa-toggle-off"></i> <?= lang('enable_register_validation'); ?></label>
                <?= form_error('register', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
              </div>
              <div class="uk-width-auto">
                <label class="uk-switch">
                  <input type="checkbox" name="register" value="true" <?php if ('true' == config_item('register_validation')) echo 'checked'; ?>>
                  <div class="uk-switch-slider"></div>
                </label>
              </div>
            </div>
          </div>
        </div>
        <button class="uk-button uk-button-primary uk-margin-small" type="submit"><i class="fas fa-sync"></i> <?= lang('update'); ?></button>
        <?= form_close(); ?>
      </div>
    </section>