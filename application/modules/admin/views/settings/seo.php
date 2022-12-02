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
            <li class="uk-active"><a href="<?= site_url('admin/settings/seo') ?>"><?= lang('seo') ?></a></li>
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
          <h2 class="uk-h4 uk-text-bold uk-margin-remove"><?= lang('seo') ?></h2>
          <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= lang('seo_settings_list') ?></p>
          <div class="uk-card uk-card-default uk-margin-small-top uk-margin-bottom">
            <div class="uk-grid-small uk-grid-divider uk-child-width-1-1" uk-grid>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('seo_tags') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('status_seo_meta_tags') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <label class="uk-switch uk-display-block">
                      <input type="checkbox" name="seo_tags" value="true" <?= set_checkbox('seo_tags', 'true', config_item('seo_tags')) ?>>
                      <div class="uk-switch-slider"></div>
                    </label>
                    <?= form_error('seo_tags', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('open_graph_tags') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('status_open_graph_tags') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <label class="uk-switch uk-display-block">
                      <input type="checkbox" name="og_tags" value="true" <?= set_checkbox('og_tags', 'true', config_item('seo_og_tags')) ?>>
                      <div class="uk-switch-slider"></div>
                    </label>
                    <?= form_error('og_tags', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div>
                <div class="uk-grid-small uk-padding-small" uk-grid>
                  <div class="uk-width-expand">
                    <p class="uk-text-secondary uk-text-bold uk-margin-remove"><?= lang('meta_description') ?></p>
                    <p class="uk-text-small uk-margin-remove"><?= lang('enter_seo_description') ?></p>
                  </div>
                  <div class="uk-width-1-2 uk-width-2-5@m">
                    <div class="uk-form-controls">
                      <textarea class="uk-textarea" name="meta_description" rows="3" autocomplete="off"><?= config_item('seo_description_tag') ?></textarea>
                    </div>
                    <?= form_error('meta_description', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
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
