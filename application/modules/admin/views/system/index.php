    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('system'); ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin'); ?>"><?= lang('dashboard'); ?></a></li>
              <li><span><?= lang('system'); ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto"></div>
        </div>
        <div class="uk-card uk-card-default">
          <ul class="uk-subnav" uk-margin>
            <li class="uk-active"><a href="<?= site_url('admin/system'); ?>"><span class="uk-margin-small-right"><i class="fas fa-list-alt"></i></span>Index</a></li>
            <li>
              <a href="#"><span class="uk-margin-small-right"><i class="fas fa-tools"></i></span><?= lang('settings'); ?><span uk-icon="icon: triangle-down"></span></a>
              <div uk-dropdown="mode: click;">
                <ul class="uk-nav uk-dropdown-nav">
                  <li><a href="<?= site_url('admin/system/general'); ?>"><?= lang('general'); ?></a></li>
                  <li><a href="<?= site_url('admin/system/captcha'); ?>"><?= lang('captcha'); ?></a></li>
                  <li><a href="<?= site_url('admin/system/email'); ?>"><?= lang('email_preferences'); ?></a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
        <?= $template['partials']['alerts']; ?>
        <div class="uk-grid uk-child-width-1-1 uk-child-width-1-2@s uk-margin-small" data-uk-grid>
          <div>
            <div class="uk-card uk-card-default uk-card-body">
              <div class="uk-grid uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                <div class="uk-width-auto uk-padding-small">
                  <i class="fas fa-copy fa-3x"></i>
                </div>
                <div class="uk-width-expand">
                  <h5 class="uk-h5 uk-text-bold uk-margin-remove"><?= lang('cms_cache'); ?></h5>
                  <p class="uk-text-small uk-margin-remove"><?= lang('cms_cache_info'); ?></p>
                  <a href="<?= site_url('admin/system/cache'); ?>" class="uk-button uk-button-primary uk-margin-small"><i class="fas fa-eraser"></i> <?= lang('empty_now'); ?></a>
                </div>
              </div>
            </div>
          </div>
          <div>
            <div class="uk-card uk-card-default uk-card-body">
              <div class="uk-grid uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
                <div class="uk-width-auto uk-padding-small">
                  <i class="fas fa-database fa-3x"></i>
                </div>
                <div class="uk-width-expand">
                  <h5 class="uk-h5 uk-text-bold uk-margin-remove"><?= lang('cms_sessions'); ?></h5>
                  <p class="uk-text-small uk-margin-remove"><?= lang('cms_sessions_info'); ?></p>
                  <a href="<?= site_url('admin/system/sessions'); ?>" class="uk-button uk-button-primary uk-margin-small"><i class="fas fa-eraser"></i> <?= lang('empty_now'); ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>