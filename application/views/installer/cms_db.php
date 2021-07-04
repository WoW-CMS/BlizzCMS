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
            <?= $this->load->view('static/alerts') ?>
            <div class="uk-card uk-card-default uk-card-body">
              <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-remove"><span><i class="fas fa-database"></i> <?= lang('cms_database') ?></span></h5>
              <p class="uk-text-meta uk-margin-remove-top uk-margin-small-bottom"><?= lang('cms_database_data') ?></p>
              <?= form_open(current_url()) ?>
              <div class="uk-margin-small">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('hostname') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="hostname" value="<?= set_value('hostname', 'localhost') ?>">
                    </div>
                    <?= form_error('hostname', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('port') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="port" value="<?= set_value('port', 3306) ?>">
                    </div>
                    <?= form_error('port', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('database') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="database" value="<?= set_value('database') ?>">
                    </div>
                    <?= form_error('database', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('prefix') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="prefix" value="<?= set_value('prefix', 'bc_') ?>">
                    </div>
                    <?= form_error('prefix', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('username') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="username" value="<?= set_value('username') ?>">
                    </div>
                    <?= form_error('username', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('password') ?>:</label>
                    <div class="uk-form-controls">
                      <input name="password" class="uk-input" type="password">
                    </div>
                    <?= form_error('password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <button class="uk-button uk-button-default uk-margin-small-top" type="submit"><?= lang('continue') ?> <i class="fas fa-arrow-right"></i></button>
              <?= form_close() ?>
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