    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('general'); ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin'); ?>"><?= lang('dashboard'); ?></a></li>
              <li><a href="<?= site_url('admin/system'); ?>"><?= lang('system'); ?></a></li>
              <li><span><?= lang('general'); ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto"></div>
        </div>
        <div class="uk-card uk-card-default">
          <ul class="uk-subnav" uk-margin>
            <li><a href="<?= site_url('admin/system'); ?>"><span class="uk-margin-small-right"><i class="fas fa-list-alt"></i></span><?= lang('home'); ?></a></li>
            <li class="uk-active">
              <a href="#"><span class="uk-margin-small-right"><i class="fas fa-sliders-h"></i></span><?= lang('settings'); ?><span uk-icon="icon: triangle-down"></span></a>
              <div uk-dropdown="mode: click;">
                <ul class="uk-nav uk-dropdown-nav">
                  <li class="uk-active"><a href="<?= site_url('admin/system/general'); ?>"><?= lang('general'); ?></a></li>
                  <li><a href="<?= site_url('admin/system/captcha'); ?>"><?= lang('captcha'); ?></a></li>
                  <li><a href="<?= site_url('admin/system/email'); ?>"><?= lang('email_preferences'); ?></a></li>
                </ul>
              </div>
            </li>
            <li><a href="<?= site_url('admin/system/logs'); ?>"><span class="uk-margin-small-right"><i class="fas fa-list"></i></span><?= lang('logs'); ?></a></li>
          </ul>
        </div>
        <?= $template['partials']['alerts']; ?>
        <?= form_open(current_url()); ?>
        <div class="uk-card uk-card-default uk-margin-small">
          <div class="uk-card-body">
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('website_name'); ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="name" value="<?= config_item('app_name'); ?>">
                  </div>
                  <?= form_error('name', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('realmlist'); ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="realmlist" value="<?= config_item('realmlist'); ?>">
                  </div>
                  <?= form_error('realmlist', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('theme_name'); ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="theme" value="<?= config_item('theme_name'); ?>">
                  </div>
                  <?= form_error('theme', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('expansion'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="expansion">
                      <option value="" hidden selected><?= lang('select_expansion'); ?></option>
                      <?php foreach (config_item('supported_expansions') as $key => $expansion): ?>
                      <option value="<?= $key; ?>" <?php if ($key === (int) config_item('expansion')) echo 'selected'; ?>><?= $expansion; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <?= form_error('expansion', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('emulator'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="emulator">
                      <option value="" hidden selected><?= lang('select_emulator'); ?></option>
                      <option value="azeroth" <?php if ('azeroth' === config_item('emulator')) echo 'selected'; ?>>AzerothCore</option>
                      <option value="cmangos" <?php if ('cmangos' === config_item('emulator')) echo 'selected'; ?>>CMaNGOS</option>
                      <option value="mangos" <?php if ('mangos' === config_item('emulator')) echo 'selected'; ?>>MaNGOS</option>
                      <option value="old_trinity" <?php if ('old_trinity' === config_item('emulator')) echo 'selected'; ?>>TrinityCore</option>
                      <option value="trinity" <?php if ('trinity' === config_item('emulator')) echo 'selected'; ?>>TrinityCore (SRP6)</option>
                    </select>
                  </div>
                  <?= form_error('emulator', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('bnet_account'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="bnet">
                      <option value="" hidden selected><?= lang('select_option'); ?></option>
                      <option value="false" <?php if ('false' === config_item('emulator_bnet')) echo 'selected'; ?>><?= lang('enable'); ?></option>
                      <option value="true" <?php if ('true' === config_item('emulator_bnet')) echo 'selected'; ?>><?= lang('disable'); ?></option>
                    </select>
                  </div>
                  <?= form_error('bnet', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom uk-heading-line"><span><?= lang('social_configuration'); ?></span></h5>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('discord_server'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fab fa-discord"></i></span>
                      <input class="uk-input" type="text" name="discord" value="<?= config_item('discord_server_id'); ?>">
                    </div>
                  </div>
                  <?= form_error('discord', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('facebook_url'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fab fa-facebook-f"></i></span>
                      <input class="uk-input" type="url" name="facebook" value="<?= config_item('facebook_url'); ?>">
                    </div>
                  </div>
                  <?= form_error('facebook', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('twitter_url'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fab fa-twitter"></i></span>
                      <input class="uk-input" type="url" name="twitter" value="<?= config_item('twitter_url'); ?>">
                    </div>
                  </div>
                  <?= form_error('twitter', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('youtube_url'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fab fa-youtube"></i></span>
                      <input class="uk-input" type="url" name="youtube" value="<?= config_item('youtube_url'); ?>">
                    </div>
                  </div>
                  <?= form_error('youtube', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-width-1-2@s"></div>
              </div>
            </div>
            <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom uk-heading-line"><span><?= lang('main_ranks_configuration'); ?></span></h5>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('admin_access_level'); ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="admin_access" value="<?= config_item('admin_access_level'); ?>">
                  </div>
                  <?= form_error('admin_access', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('mod_access_level'); ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" name="mod_access" value="<?= config_item('mod_access_level'); ?>">
                  </div>
                  <?= form_error('mod_access', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                </div>
                <div class="uk-width-1-2@s"></div>
              </div>
            </div>
          </div>
        </div>
        <button class="uk-button uk-button-primary uk-margin-small" type="submit"><i class="fas fa-sync"></i> <?= lang('update'); ?></button>
        <?= form_close(); ?>
      </div>
    </section>