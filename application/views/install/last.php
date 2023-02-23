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
            <?= $this->load->view('static/alerts') ?>
            <ul class="uk-subnav uk-subnav-pill uk-margin-remove-bottom" uk-switcher="connect: #option-type">
              <li class="<?= $option === 'fresh' ? 'uk-active' : '' ?>">
                <a href="#"><i class="fa-solid fa-asterisk"></i> <?= lang('install_fresh_install') ?></a>
              </li>
              <li class="<?= $option === 'previous' ? 'uk-active' : '' ?>">
                <a href="#"><i class="fa-solid fa-arrow-rotate-right"></i> <?= lang('install_previous_data') ?></a>
              </li>
            </ul>
            <div class="uk-card uk-card-default uk-card-body">
              <ul id="option-type" class="uk-switcher">
                <li>
                  <p class="uk-text-small uk-margin-small"><?= lang('install_fresh_install_note') ?></p>
                  <?= form_open(current_url()) ?>
                    <h6 class="uk-h6 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-small"><span> <?= lang('install_admin_account') ?></span></h6>
                    <?= form_hidden('option', 'fresh') ?>
                    <div class="uk-grid-small uk-margin-small" uk-grid>
                      <div class="uk-width-1-2@s">
                        <label class="uk-form-label"><?= lang('nickname') ?></label>
                        <div class="uk-form-controls">
                          <input class="uk-input" type="text" name="nickname" value="<?= set_value('nickname') ?>" autocomplete="off">
                        </div>
                        <?= form_error('nickname', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                      </div>
                      <div class="uk-width-1-2@s">
                        <label class="uk-form-label"><?= lang('username') ?></label>
                        <div class="uk-form-controls">
                          <input class="uk-input" type="text" name="username" value="<?= set_value('username') ?>" autocomplete="off">
                        </div>
                        <?= form_error('username', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                      </div>
                      <div class="uk-width-1-1">
                        <label class="uk-form-label"><?= lang('email') ?></label>
                        <div class="uk-form-controls">
                          <input class="uk-input" type="text" name="email" value="<?= set_value('email') ?>" autocomplete="off">
                        </div>
                        <?= form_error('email', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                      </div>
                      <div class="uk-width-1-2@s">
                        <label class="uk-form-label"><?= lang('password') ?></label>
                        <div class="uk-form-controls">
                          <input class="uk-input" type="password" name="password" autocomplete="new-password">
                        </div>
                        <?= form_error('password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                      </div>
                      <div class="uk-width-1-2@s">
                        <label class="uk-form-label"><?= lang('confirm_password') ?></label>
                        <div class="uk-form-controls">
                          <input class="uk-input" type="password" name="confirm_password" autocomplete="new-password">
                        </div>
                        <?= form_error('confirm_password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                      </div>
                    </div>
                    <button class="uk-button uk-button-default uk-margin-small-top" type="submit"><?= lang('submit') ?></button>
                  <?= form_close() ?>
                </li>
                <li>
                  <p class="uk-text-small uk-margin-small"><?= lang('install_previous_data_note') ?></p>
                  <p class="uk-text-small uk-text-uppercase uk-text-bold uk-text-warning uk-margin-small"><i class="fa-solid fa-triangle-exclamation fa-fade"></i> <?= lang('warning') ?></p>
                  <ul class="uk-list uk-list-square uk-text-small uk-margin-small">
                    <li><?= lang('install_previous_data_warning') ?></li>
                  </ul>
                  <?= form_open(current_url()) ?>
                    <h6 class="uk-h6 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-small"><span> <?= lang('install_admin_account') ?></span></h6>
                    <?= form_hidden('option', 'previous') ?>
                    <div class="uk-margin-small">
                      <label class="uk-form-label"><?= lang('username') ?></label>
                      <div class="uk-form-controls">
                        <input class="uk-input" type="text" name="previous_username" autocomplete="off">
                      </div>
                      <?= form_error('previous_username', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                    </div>
                    <button class="uk-button uk-button-default uk-margin-small-top" type="submit"><?= lang('submit') ?></button>
                  <?= form_close() ?>
                </li>
              </ul>
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
