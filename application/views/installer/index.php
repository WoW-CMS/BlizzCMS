<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BlizzCMS – <?= lang('installer') ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/uikit.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/install.css') ?>">
    <script src="<?= base_url('assets/js/uikit.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/uikit-icons.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
    <script src="<?= base_url('assets/fontawesome/js/all.min.js') ?>" defer></script>
  </head>
  <body>
    <div class="uk-navbar-container uk-navbar-transparent">
      <div class="uk-container">
        <nav class="uk-navbar" data-uk-navbar>
          <div class="uk-navbar-left"></div>
          <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
              <li>
                <a href="#"><i class="fas fa-language"></i> <?= $this->language->current_name() ?></a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <?php foreach ($this->language->list() as $lang): ?>
                    <li><a href="<?= site_url('switcher/'.$lang['code']) ?>"><?= $lang['name'] ?></a></li>
                    <?php endforeach ?>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <section class="uk-section uk-section-xsmall">
      <div class="uk-container">
        <div class="uk-grid" data-uk-grid>
          <div class="uk-width-1-5@s"></div>
          <div class="uk-width-3-5@s">
            <h1 class="uk-logo uk-text-center">BlizzCMS</h1>
            <div class="uk-card uk-card-default uk-card-body">
              <p class="uk-text-meta uk-margin-remove-top uk-margin-small-bottom"><?= lang('cms_requirements') ?></p>
              <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-remove"><span><i class="fas fa-info"></i> PHP</span></h5>
              <div class="uk-grid uk-grid-small uk-flex uk-flex-middle uk-margin-small-bottom" data-uk-grid>
                <div class="uk-width-auto">
                  <?= $info['enable'] ? '<span class="uk-text-success"><i class="far fa-check-circle fa-lg"></i></span>' : '<span class="uk-text-danger"><i class="far fa-times-circle fa-lg"></i></span>' ?>
                </div>
                <div class="uk-width-expand">
                  <p class="uk-text-bold uk-margin-remove"><?= $info['version'] ?></p>
                  <p class="uk-text-meta uk-margin-remove"><?= lang('required_version') ?></p>
                </div>
              </div>
              <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-top uk-margin-remove-bottom"><span><i class="fas fa-puzzle-piece"></i> <?= lang('extensions') ?></span></h5>
              <div class="uk-grid uk-grid-small uk-grid-match uk-child-width-1-2 uk-child-width-1-4@m uk-margin-small" data-uk-grid>
                <?php foreach ($extensions as $item): ?>
                <div>
                  <div class="uk-tile uk-tile-default <?php if ($item['enable']) echo 'tile-success' ?>">
                    <?= $item['enable'] ? '<span class="uk-text-success"><i class="far fa-check-circle"></i></span>' : '<i class="far fa-times-circle"></i>' ?> <?= $item['name'] ?>
                  </div>
                </div>
                <?php endforeach ?>
              </div>
              <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-top uk-margin-remove-bottom"><span><i class="fas fa-pen-alt"></i> <?= lang('writable_permission') ?></span></h5>
              <div class="uk-grid uk-grid-small uk-grid-match uk-child-width-1-2 uk-child-width-1-3@m uk-margin-small" data-uk-grid>
                <?php foreach ($permissions as $item): ?>
                <div>
                  <div class="uk-tile uk-tile-default <?php if ($item['enable']) echo 'tile-success' ?>">
                    <?= $item['enable'] ? '<span class="uk-text-success"><i class="far fa-check-circle"></i></span>' : '<i class="far fa-times-circle"></i>' ?> <?= $item['name'] ?>
                  </div>
                </div>
                <?php endforeach ?>
              </div>
              <?php if ($button): ?>
              <a href="<?= site_url('install/cms') ?>" class="uk-button uk-button-default uk-margin-small-top"><?= lang('continue') ?> <i class="fas fa-arrow-right"></i></a>
              <?php else: ?>
              <a href="<?= current_url() ?>" class="uk-button uk-button-default uk-margin-small-top"><i class="fas fa-redo"></i> <?= lang('reload') ?></a>
              <?php endif ?>
            </div>
          </div>
          <div class="uk-width-1-5@s"></div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall">
      <div class="uk-container">
        <h5 class="uk-h5 uk-text-center uk-margin-remove">Copyright <i class="far fa-copyright"></i> <?= date('Y') ?> <span class="uk-text-bold">WoW-CMS</span>. <?= lang('rights_reserved') ?></h5>
        <ul class="uk-subnav uk-flex uk-flex-center uk-margin-small">
          <li><a target="_blank" href="https://discord.wow-cms.com" class="uk-icon-button discord"><i class="fab fa-discord"></i></a></li>
          <li><a target="_blank" href="https://github.com/WoW-CMS" class="uk-icon-button github"><i class="fab fa-github"></i></a></li>
          <li><a target="_blank" href="https://ko-fi.com/wowcms" class="uk-icon-button ko-fi"><i class="fas fa-coffee"></i></a></li>
        </ul>
      </div>
    </section>
  </body>
</html>