<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('appearance') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <div class="uk-margin" uk-grid>
      <div class="uk-width-1-3@s uk-width-1-4@m">
        <div class="uk-card uk-card-default">
          <ul class="uk-nav-default" uk-nav>
            <li class="uk-nav-header"><?= lang('base') ?></li>
            <li class="uk-active"><a href="<?= site_url('admin/appearance') ?>"><?= lang('themes') ?></a></li>
            <li><a href="<?= site_url('admin/languages') ?>"><?= lang('languages') ?></a></li>
            <li class="uk-nav-header"><?= lang('sections') ?></li>
            <li><a href="<?= site_url('admin/menus') ?>"><?= lang('menus') ?></a></li>
            <li><a href="<?= site_url('admin/slides') ?>"><?= lang('slides') ?></a></li>
          </ul>
        </div>
      </div>
      <div class="uk-width-expand@s">
        <div class="uk-card uk-card-default uk-card-header uk-margin">
          <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
            <div class="uk-width-expand">
              <h3 class="uk-card-title"><?= lang('themes') ?></h3>
            </div>
            <div class="uk-width-auto">
              <a href="<?= site_url('admin/appearance/upload') ?>" class="uk-button uk-button-default uk-button-small"><i class="fa-solid fa-upload"></i> <?= lang('upload') ?></a>
            </div>
          </div>
        </div>
        <div class="uk-grid-match uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m" uk-grid>
          <?php foreach ($themes as $key => $theme): ?>
          <div>
            <div class="uk-card uk-card-default">
              <div class="uk-card-media-top uk-cover-container">
                <?php if (! empty($theme['preview'])): ?>
                <img src="<?= base_url('application/themes/'.$key.'/'.$theme['preview']) ?>" alt="<?= lang('preview') ?>" uk-cover>
                <?php else: ?>
                <img src="<?= $template['assets'].'img/img-not-found.svg' ?>" alt="<?= lang('preview') ?>" uk-cover>
                <?php endif ?>
                <canvas width="600" height="400"></canvas>
              </div>
              <div class="uk-card-footer">
                <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                  <div class="uk-width-expand">
                    <h5 class="uk-h5 uk-text-bold uk-text-truncate uk-margin-remove-bottom">
                      <?php if ($theme['active']): ?>
                      <span class="uk-text-success" uk-tooltip="<?= lang('active') ?>"><i class="fa-solid fa-circle-check"></i> </span>
                      <?php endif ?>
                      <?= html_escape($theme['name']) ?>
                    </h5>
                    <a target="_blank" href="<?= $theme['author']['website'] ?>" class="uk-button uk-button-text uk-text-truncate"><?= html_escape($theme['author']['name']) ?></a>
                  </div>
                  <div class="uk-width-auto">
                    <div class="uk-inline">
                      <button class="uk-button uk-button-default uk-button-small" type="button"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                      <div uk-dropdown="mode: click; boundary: ! .uk-container">
                        <ul class="uk-nav uk-dropdown-nav">
                          <?php if (! $theme['active']): ?>
                          <li><a href="<?= site_url('admin/appearance/activate/'.$key) ?>"><span class="bc-li-icon"><i class="fa-solid fa-fill-drip"></i></span><?= lang('activate') ?></a></li>
                          <li class="uk-nav-divider"></li>
                          <li><a href="<?= site_url('admin/appearance/delete/'.$key) ?>" class="uk-text-danger"><span class="bc-li-icon"><i class="fa-solid fa-folder-minus"></i></span><?= lang('delete') ?></a></li>
                          <?php else: ?>
                          <li><a href="<?= site_url('admin/appearance/deactivate') ?>"><span class="bc-li-icon"><i class="fa-solid fa-arrow-rotate-left"></i></span><?= lang('deactivate') ?></a></li>
                          <?php endif ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
</section>
