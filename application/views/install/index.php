<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= lang('installation') ?> — BlizzCMS</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/uikit.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/install.css') ?>">
    <script src="<?= base_url('assets/js/uikit.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/uikit-icons.min.js') ?>"></script>
    <script src="<?= base_url('assets/fontawesome/js/all.min.js') ?>" defer></script>
  </head>
  <body>
    <nav class="uk-navbar-container uk-navbar-transparent">
      <div class="uk-container">
        <div uk-navbar>
          <div class="uk-navbar-left"></div>
          <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
              <li>
                <a href="#">
                  <i class="fa-solid fa-language"></i> <span class="uk-text-uppercase"><?= $this->multilanguage->current_language('locale') ?></span>
                </a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <?php foreach ($this->multilanguage->languages() as $lang): ?>
                    <li class="<?= $lang['locale'] === $this->multilanguage->current_language('locale') ? 'uk-active' : '' ?>">
                      <a href="<?= site_url('lang/'.$lang['locale']) ?>"><?= $lang['name'] ?></a>
                    </li>
                    <?php endforeach ?>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <section class="uk-section uk-section-xsmall">
      <div class="uk-container">
        <div uk-grid>
          <div class="uk-width-1-5@s"></div>
          <div class="uk-width-3-5@s">
            <div class="uk-flex uk-flex-center uk-margin">
              <h1 class="uk-logo uk-margin-remove">BlizzCMS</h1>
            </div>
            <div class="uk-card uk-card-default uk-card-body">
              <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= lang('install_welcome') ?></p>
              <h6 class="uk-h6 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-small"><span><?= lang('install_requirements_check') ?></span></h6>
              <div class="uk-grid-small uk-grid-divider uk-child-width-1-1 uk-margin-small" uk-grid>
                <div>
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-width-expand">
                      <h6 class="uk-h6 uk-text-uppercase uk-text-bold uk-margin-remove"><?= $version_supported ? '<span class="uk-text-success"><i class="fa-solid fa-check"></i></span>' : '<span class="uk-text-danger"><i class="fa-solid fa-xmark"></i></span>' ?> PHP</h6>
                      <p class="uk-text-meta uk-margin-remove"><?= lang('install_required_version') ?></p>
                    </div>
                    <div class="uk-width-auto">
                      <?= $version ?> <i class="fa-solid fa-server"></i>
                    </div>
                  </div>
                </div>
                <div>
                  <h6 class="uk-h6 uk-text-uppercase uk-text-bold uk-margin-remove"><?= empty($missing_extensions) ? '<span class="uk-text-success"><i class="fa-solid fa-check"></i></span>' : '<span class="uk-text-danger"><i class="fa-solid fa-xmark"></i></span>' ?> <?= lang('install_php_extensions') ?></h6>
                  <p class="uk-text-meta uk-margin-remove"><?= lang('install_required_extensions') ?></p>
                  <?php if (! empty($missing_extensions) && is_array($missing_extensions)): ?>
                  <p class="uk-text-small uk-text-emphasis uk-margin-small"><i class="fa-solid fa-circle-question fa-fade"></i> <?= lang('install_how_comply_requirement') ?></p>
                  <ul class="uk-list uk-list-square uk-text-small uk-margin-remove">
                    <li>
                      <?= lang('install_missing_extensions') ?>
                      <pre><?= implode(', ', $missing_extensions) ?></pre>
                    </li>
                  </ul>
                  <?php endif ?>
                </div>
                <div>
                  <h6 class="uk-h6 uk-text-uppercase uk-text-bold uk-margin-remove"><?= $dependencies ? '<span class="uk-text-success"><i class="fa-solid fa-check"></i></span>' : '<span class="uk-text-danger"><i class="fa-solid fa-xmark"></i></span>' ?> <?= lang('install_dependencies') ?></h6>
                  <p class="uk-text-meta uk-margin-remove"><?= lang('install_required_dependencies') ?></p>
                  <?php if (! $dependencies): ?>
                  <p class="uk-text-small uk-text-emphasis uk-margin-small"><i class="fa-solid fa-circle-question fa-fade"></i> <?= lang('install_how_comply_requirement') ?></p>
                  <ul class="uk-list uk-list-square uk-text-small uk-margin-remove">
                    <li><?= lang('install_missing_composer') ?></li>
                    <li>
                      <?= lang('install_missing_dependencies') ?>
                      <pre>composer install --no-plugins --no-scripts</pre>
                    </li>
                  </ul>
                  <?php endif ?>
                </div>
                <div>
                  <h6 class="uk-h6 uk-text-uppercase uk-text-bold uk-margin-remove"><?= empty($missing_permissions) ? '<span class="uk-text-success"><i class="fa-solid fa-check"></i></span>' : '<span class="uk-text-danger"><i class="fa-solid fa-xmark"></i></span>' ?> <?= lang('install_permissions') ?></h6>
                  <p class="uk-text-meta uk-margin-remove"><?= lang('install_required_permissions') ?></p>
                  <?php if (! empty($missing_permissions)): ?>
                  <p class="uk-text-small uk-text-emphasis uk-margin-small"><i class="fa-solid fa-circle-question fa-fade"></i> <?= lang('install_how_comply_requirement') ?></p>
                  <ul class="uk-list uk-list-square uk-text-small uk-margin-remove">
                    <li><?= lang('install_missing_permissions') ?></li>
                  </ul>
                  <?php endif ?>
                </div>
              </div>
              <?php if ($next_step): ?>
              <a href="<?= site_url('install/database') ?>" class="uk-button uk-button-default uk-margin-small-top"><?= lang('continue') ?></a>
              <?php else: ?>
              <a href="<?= current_url() ?>" class="uk-button uk-button-default uk-margin-small-top"><?= lang('reload') ?></a>
              <?php endif ?>
            </div>
          </div>
          <div class="uk-width-1-5@s"></div>
        </div>
      </div>
    </section>
    <footer class="uk-section uk-section-xsmall">
      <div class="uk-container">
        <h5 class="uk-h5 uk-text-center uk-margin-remove"><i class="fa-regular fa-copyright"></i> <?= date('Y') ?> <span class="uk-text-bold">WoW-CMS</span>. <?= lang('rights_reserved') ?></h5>
        <ul class="uk-subnav uk-flex uk-flex-center uk-margin-small">
          <li><a target="_blank" href="https://discord.wow-cms.com" class="uk-icon-button discord"><i class="fa-brands fa-discord"></i></a></li>
          <li><a target="_blank" href="https://github.com/WoW-CMS" class="uk-icon-button github"><i class="fa-brands fa-github"></i></a></li>
        </ul>
      </div>
    </footer>
  </body>
</html>
