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
              <p class="uk-text-meta uk-margin-remove-top uk-margin-small-bottom"><?= lang('install_requirements') ?></p>
              <h6 class="uk-h6 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-remove"><span><i class="fa-solid fa-circle-info"></i> PHP</span></h6>
              <div class="uk-grid-small uk-flex uk-flex-middle uk-margin-small-bottom" uk-grid>
                <div class="uk-width-auto">
                  <?= $version_supported ? '<span class="uk-text-success"><i class="fa-regular fa-circle-check fa-lg"></i></span>' : '<span class="uk-text-danger"><i class="fa-regular fa-circle-xmark fa-lg"></i></span>' ?>
                </div>
                <div class="uk-width-expand">
                  <p class="uk-text-bold uk-margin-remove"><?= $version ?></p>
                  <p class="uk-text-meta uk-margin-remove"><?= lang('install_required_version') ?></p>
                </div>
              </div>
              <h6 class="uk-h6 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-top uk-margin-remove-bottom"><span><i class="fa-solid fa-gear"></i> <?= lang('install_php_extensions') ?></span></h6>
              <div class="uk-grid-small uk-grid-match uk-child-width-1-2 uk-child-width-1-3@s uk-child-width-1-5@m uk-flex-center uk-margin-small" uk-grid>
                <?php foreach ($verified_extensions as $item): ?>
                <div>
                  <div class="uk-tile uk-tile-default">
                    <span class="uk-text-success"><i class="fa-regular fa-circle-check"></i></span> <?= $item ?>
                  </div>
                </div>
                <?php endforeach ?>
                <?php foreach ($missing_extensions as $item): ?>
                <div>
                  <div class="uk-tile uk-tile-muted">
                    <i class="fa-regular fa-circle-xmark fa-fade"></i> <?= $item ?>
                  </div>
                </div>
                <?php endforeach ?>
              </div>
              <h6 class="uk-h6 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-top uk-margin-remove-bottom"><span><i class="fa-solid fa-box"></i> <?= lang('install_dependencies') ?></span></h6>
              <div class="uk-grid-small uk-flex uk-flex-middle uk-margin-small-bottom" uk-grid>
                <div class="uk-width-auto">
                  <?= $dependencies ? '<span class="uk-text-success"><i class="fa-regular fa-circle-check fa-lg"></i></span>' : '<span class="uk-text-danger"><i class="fa-regular fa-circle-xmark fa-lg"></i></span>' ?>
                </div>
                <div class="uk-width-expand">
                  <p class="uk-text-bold uk-margin-remove"><?= $dependencies ? lang('installed') : lang('not_installed') ?></p>
                  <p class="uk-text-meta uk-margin-remove"><?= lang('install_required_dependencies') ?></p>
                </div>
              </div>
              <?php if ($next_step): ?>
              <a href="<?= site_url('install/cms') ?>" class="uk-button uk-button-default uk-margin-small-top"><?= lang('continue') ?></a>
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
