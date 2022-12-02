<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/appearance') ?>"><?= lang('appearance') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('languages') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <div class="uk-margin" uk-grid>
      <div class="uk-width-1-3@s uk-width-1-4@m">
        <div class="uk-card uk-card-default">
          <ul class="uk-nav-default" uk-nav>
            <li class="uk-nav-header"><?= lang('base') ?></li>
            <li><a href="<?= site_url('admin/appearance') ?>"><?= lang('themes') ?></a></li>
            <li class="uk-active"><a href="<?= site_url('admin/languages') ?>"><?= lang('languages') ?></a></li>
            <li class="uk-nav-header"><?= lang('sections') ?></li>
            <li><a href="<?= site_url('admin/menus') ?>"><?= lang('menus') ?></a></li>
            <li><a href="<?= site_url('admin/slides') ?>"><?= lang('slides') ?></a></li>
          </ul>
        </div>
      </div>
      <div class="uk-width-expand@s">
        <?= $template['partials']['alerts'] ?>
        <div class="uk-card uk-card-default uk-card-header uk-margin">
          <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
            <div class="uk-width-expand">
              <h3 class="uk-card-title"><?= lang('languages') ?></h3>
            </div>
            <div class="uk-width-auto">
              <a target="_blank" href="https://wow-cms.github.io/docs/blizzcms" class="uk-button uk-button-default uk-button-small"><i class="fa-solid fa-square-arrow-up-right"></i></a>
            </div>
          </div>
        </div>
        <div class="uk-grid-small uk-child-width-1-1" uk-grid>
          <?php foreach ($languages as $key => $language): ?>
          <div>
            <div class="uk-card uk-card-default uk-card-body">
              <div class="uk-grid-medium uk-flex uk-flex-middle" uk-grid>
                <div class="uk-width-auto">
                  <i class="fa-solid fa-language fa-xl"></i>
                </div>
                <div class="uk-width-expand">
                  <h5 class="uk-text-bold uk-margin-remove">
                    <?php if ($language['default']): ?>
                    <span class="uk-text-primary" uk-tooltip="<?= lang('default') ?>"><i class="fa-solid fa-star"></i> </span>
                    <?php endif ?>
                    <?= html_escape($language['name']) ?>
                  </h5>
                  <p class="uk-text-small uk-text-uppercase uk-margin-remove"><?= html_escape($language['locale']) ?> </p>
                </div>
                <div class="uk-width-auto">
                  <div class="uk-button-group">
                    <?php if ($language['default']): ?>
                    <button class="uk-button uk-button-primary uk-button-small" type="button" disabled><?= lang('delete') ?></button>
                    <button class="uk-button uk-button-primary uk-button-small" type="button" disabled><i class="fa-solid fa-caret-down"></i></button>
                    <?php else: ?>
                    <?php if ($language['active']): ?>
                    <a href="<?= site_url('admin/languages/delete/'.$key) ?>" class="uk-button uk-button-primary uk-button-small"><?= lang('delete') ?></a>
                    <div class="uk-inline">
                      <button class="uk-button uk-button-primary uk-button-small" type="button"><i class="fa-solid fa-caret-down"></i></button>
                      <div uk-dropdown="mode: click; boundary: ! .uk-container">
                        <ul class="uk-nav uk-dropdown-nav">
                          <li><a href="<?= site_url('admin/languages/set/'.$key) ?>"><span class="bc-li-icon"><i class="fa-solid fa-arrow-rotate-right"></i></span><?= lang('set_default') ?></a></li>
                        </ul>
                      </div>
                    </div>
                    <?php else: ?>
                    <a href="<?= site_url('admin/languages/add/'.$key) ?>" class="uk-button uk-button-primary uk-button-small"><?= lang('add') ?></a>
                    <?php endif ?>
                    <?php endif ?>
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
