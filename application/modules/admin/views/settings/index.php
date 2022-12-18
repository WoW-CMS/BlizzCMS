<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
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
            <li class="uk-active"><a href="<?= site_url('admin/settings') ?>"><?= lang('general') ?></a></li>
            <li><a href="<?= site_url('admin/settings/avatar') ?>"><?= lang('avatar') ?></a></li>
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
          <h2 class="uk-h4 uk-text-bold uk-margin-remove"><?= lang('general') ?></h2>
          <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= lang('general_settings_list') ?></p>
          <div class="uk-card uk-card-default uk-margin-small">
            <div class="uk-grid-small uk-grid-divider uk-child-width-1-1" uk-grid>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('site_name') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_site_name') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="name" value="<?= config_item('app_name') ?>" autocomplete="off">
                    </div>
                    <?= form_error('name', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('realmlist') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_realmlist') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="realmlist" value="<?= config_item('app_realmlist') ?>" autocomplete="off">
                    </div>
                    <?= form_error('realmlist', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('expansion') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_expansion') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <select class="uk-select tail-single" id="select_expansion" name="expansion" autocomplete="off" data-placeholder="<?= lang('select_expansion') ?>">
                        <?php foreach (config_item('expansions') as $key => $expansion): ?>
                        <option value="<?= $key ?>" <?= set_select('expansion', $key, $key === config_item('app_expansion')) ?>><?= $expansion['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <?= form_error('expansion', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('emulator') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_emulator') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <select class="uk-select tail-single" id="select_emulator" name="emulator" autocomplete="off" data-placeholder="<?= lang('select_emulator') ?>">
                        <?php foreach (config_item('emulators') as $key => $emulator): ?>
                        <option value="<?= $key ?>" <?= set_select('emulator', $key, $key === config_item('app_emulator')) ?>><?= $emulator['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <?= form_error('emulator', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('bnet_authentication') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_bnet_authentication') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <select class="uk-select tail-single" id="select_bnet" name="bnet" autocomplete="off" data-placeholder="<?= lang('select_option') ?>">
                        <option value="false" <?= set_select('bnet', 'false', ! config_item('app_emulator_bnet')) ?>><?= lang('disable') ?></option>
                        <option value="true" <?= set_select('bnet', 'true', config_item('app_emulator_bnet')) ?>><?= lang('enable') ?></option>
                      </select>
                    </div>
                    <?= form_error('bnet', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <h2 class="uk-h4 uk-text-bold uk-margin-top uk-margin-remove-bottom"><?= lang('social_networks') ?></h2>
          <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= lang('social_settings_list') ?></p>
          <div class="uk-card uk-card-default uk-margin-small-top uk-margin-bottom">
            <div class="uk-grid-small uk-grid-divider uk-child-width-1-1" uk-grid>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('discord') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_discord_id') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="discord" value="<?= config_item('social_discord') ?>" autocomplete="off">
                    </div>
                    <?= form_error('discord', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('facebook') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_facebook_group') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="facebook" value="<?= config_item('social_facebook') ?>" autocomplete="off">
                    </div>
                    <?= form_error('facebook', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('twitter') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_twitter_user') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="twitter" value="<?= config_item('social_twitter') ?>" autocomplete="off">
                    </div>
                    <?= form_error('twitter', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('youtube') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_youtube_channel') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="youtube" value="<?= config_item('social_youtube') ?>" autocomplete="off">
                    </div>
                    <?= form_error('youtube', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <h2 class="uk-h4 uk-text-bold uk-margin-top uk-margin-remove-bottom"><?= lang('main_pages') ?></h2>
          <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= lang('pages_settings_list') ?></p>
          <div class="uk-card uk-card-default uk-margin-small-top uk-margin-bottom">
            <div class="uk-grid-small uk-grid-divider uk-child-width-1-1" uk-grid>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('register_page') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('status_register_page') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <label class="uk-switch uk-display-block">
                      <input type="checkbox" name="register_page" value="true" <?= set_checkbox('show_register_page', 'true', config_item('show_register_page')) ?>>
                      <div class="uk-switch-slider"></div>
                    </label>
                    <?= form_error('register_page', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('forgot_password_page') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('status_forgot_page') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <label class="uk-switch uk-display-block">
                      <input type="checkbox" name="forgot_page" value="true" <?= set_checkbox('show_forgot_page', 'true', config_item('show_forgot_page')) ?>>
                      <div class="uk-switch-slider"></div>
                    </label>
                    <?= form_error('forgot_page', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
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
