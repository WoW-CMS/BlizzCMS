<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BlizzCMS – Installer</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/uikit.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/install.css') ?>">
    <script src="<?= base_url('assets/js/uikit.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/uikit-icons.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/fontawesome/js/all.min.js') ?>" defer></script>
  </head>
  <body>
    <header>
      <div class="uk-navbar-container uk-navbar-transparent">
        <div class="uk-container">
          <nav class="uk-navbar" uk-navbar>
            <div class="uk-navbar-left">
              <a href="<?= current_url() ?>" class="uk-navbar-item uk-logo">BlizzCMS</a>
            </div>
            <div class="uk-navbar-right">
              <div class="uk-navbar-item">
                <a target="_blank" href="https://discord.wow-cms.com" class="uk-icon-button discord"><i class="fab fa-discord"></i></a>
              </div>
              <div class="uk-navbar-item">
                <a target="_blank" href="https://github.com/WoW-CMS" class="uk-icon-button github uk-margin-small-right"><i class="fab fa-github"></i></a>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <section class="uk-section uk-section-xsmall">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-1-4@s"></div>
          <div class="uk-width-1-2@s">
            <h1 class="uk-h1 step-title uk-text-bold uk-text-center uk-margin-remove">Installer</h1>
            <p class="uk-text-center uk-margin-remove-top uk-margin-bottom"><?= lang('requirements_title') ?></p>
            <ul class="uk-list uk-list-divider uk-margin-small">
              <?php foreach ($requirements as $value): ?>
              <li>
                <div class="uk-grid-small" uk-grid>
                  <div class="uk-width-expand"><i class="far fa-circle fa-xs"></i> <?= $value['requirement'] ?></div>
                  <div><?php echo ($value['enable']) ? '<span class="uk-text-success"><i class="fas fa-check-circle"></i></span>' : '<span class="uk-text-danger"><i class="fas fa-times-circle"></i></span>' ?></div>
                </div>
              </li>
              <?php endforeach ?>
            </ul>
            <?php if ($button): ?>
            <a href="<?= site_url('install/settings') ?>" class="uk-button uk-button-primary uk-width-1-1 uk-margin"><i class="fas fa-angle-double-right"></i> <?= lang('continue_button') ?> <i class="fas fa-angle-double-left"></i></a>
            <?php else: ?>
            <a href="<?= current_url() ?>" class="uk-button uk-button-primary uk-width-1-1 uk-margin"><i class="fas fa-sync fa-spin"></i> <?= lang('refresh_button') ?></a>
            <?php endif ?>
          </div>
          <div class="uk-width-1-4@s"></div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall">
      <div class="uk-container">
        <h5 class="uk-h5 uk-text-center uk-margin-remove">Copyright <i class="far fa-copyright"></i> <?= date('Y') ?> <span class="uk-text-bold">WoW-CMS</span>. <?= lang('rights_reserved') ?></h5>
      </div>
    </section>
  </body>
</html>