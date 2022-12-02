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
            <li class="uk-active"><a href="<?= site_url('admin/settings/avatar') ?>"><?= lang('avatar') ?></a></li>
            <li><a href="<?= site_url('admin/settings/discussion') ?>"><?= lang('discussion') ?></a></li>
            <li><a href="<?= site_url('admin/settings/seo') ?>"><?= lang('seo') ?></a></li>
            <li><a href="<?= site_url('admin/settings/mailer') ?>"><?= lang('mailer') ?></a></li>
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
          <h2 class="uk-h4 uk-text-bold uk-margin-remove"><?= lang('avatar') ?></h2>
          <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= lang('avatar_settings_list') ?></p>
          <div class="uk-card uk-card-default uk-margin-small-top uk-margin-bottom">
            <div class="uk-grid-small uk-grid-divider uk-child-width-1-1" uk-grid>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('max_size') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_avatar_max_size') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="max_size" value="<?= config_item('avatar_max_size') ?>" autocomplete="off">
                    </div>
                    <?= form_error('max_size', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('background') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_avatar_background') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input uk-width-1-5" type="color" name="background" value="<?= config_item('avatar_api_background') ?>" autocomplete="off">
                    </div>
                    <?= form_error('background', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('color') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_avatar_color') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input uk-width-1-5" type="color" name="color" value="<?= config_item('avatar_api_color') ?>" autocomplete="off">
                    </div>
                    <?= form_error('color', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
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
