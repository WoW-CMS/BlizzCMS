    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('captcha'); ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin'); ?>"><?= lang('dashboard'); ?></a></li>
              <li><a href="<?= site_url('admin/system'); ?>"><?= lang('system'); ?></a></li>
              <li><span><?= lang('captcha'); ?></span></li>
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
                  <li class="uk-active"><a href="<?= site_url('admin/system/captcha'); ?>"><?= lang('captcha'); ?></a></li>
                  <li><a href="<?= site_url('admin/system/email'); ?>"><?= lang('email_preferences'); ?></a></li>
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
              <label class="uk-form-label"><?= lang('type'); ?></label>
              <div class="uk-form-controls">
                <select class="uk-select" name="captcha_type">
                  <option value="" hidden selected><?= lang('select_type'); ?></option>
                  <option value="recaptcha" <?php if ('recaptcha' === config_item('captcha_type')) echo 'selected'; ?>><?= lang('recaptcha'); ?></option>
                  <option value="hcaptcha" <?php if ('hcaptcha' === config_item('captcha_type')) echo 'selected'; ?>><?= lang('hcaptcha'); ?></option>
                </select>
              </div>
              <?= form_error('email_protocol', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('public_key'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-user"></i></span>
                      <input class="uk-input" type="text" name="captcha_public" value="<?= config_item('captcha_public'); ?>" placeholder="<?= lang('public_key'); ?>">
                    </div>
                  </div>
                  <?= form_error('captcha_public', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('private_key'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fas fa-lock"></i></span>
                      <input class="uk-input" type="text" name="captcha_private" value="<?= config_item('captcha_private'); ?>" placeholder="••••••••••••••••••••">
                    </div>
                  </div>
                  <?= form_error('captcha_private', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom uk-heading-line"><span><?= lang('captcha_on_pages'); ?></span></h5>
            <div class="uk-grid uk-grid-small uk-flex uk-flex-middle uk-margin-small-bottom" data-uk-grid>
              <div class="uk-width-expand">
                <label class="uk-form-label"><i class="fas fa-toggle-off"></i> <?= lang('enable_captcha_login'); ?></label>
                <?= form_error('captcha_login', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
              </div>
              <div class="uk-width-auto">
                <label class="uk-switch">
                  <input type="checkbox" name="captcha_login" value="true" <?php if ('true' == config_item('captcha_login')) echo 'checked'; ?>>
                  <div class="uk-switch-slider"></div>
                </label>
              </div>
            </div>
            <div class="uk-grid uk-grid-small uk-flex uk-flex-middle uk-margin-small-bottom" data-uk-grid>
              <div class="uk-width-expand">
                <label class="uk-form-label"><i class="fas fa-toggle-off"></i> <?= lang('enable_captcha_register'); ?></label>
                <?= form_error('captcha_register', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
              </div>
              <div class="uk-width-auto">
                <label class="uk-switch">
                  <input type="checkbox" name="captcha_register" value="true" <?php if ('true' == config_item('captcha_register')) echo 'checked'; ?>>
                  <div class="uk-switch-slider"></div>
                </label>
              </div>
            </div>
            <div class="uk-grid uk-grid-small uk-flex uk-flex-middle uk-margin-small-bottom" data-uk-grid>
              <div class="uk-width-expand">
                <label class="uk-form-label"><i class="fas fa-toggle-off"></i> <?= lang('enable_captcha_forgot'); ?></label>
                <?= form_error('captcha_forgot', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
              </div>
              <div class="uk-width-auto">
                <label class="uk-switch">
                  <input type="checkbox" name="captcha_forgot" value="true" <?php if ('true' == config_item('captcha_forgot')) echo 'checked'; ?>>
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