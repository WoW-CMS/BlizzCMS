<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= lang('installation') ?> — BlizzCMS</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.ico') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/uikit.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/tail.select.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/install.css') ?>">
    <script src="<?= base_url('assets/js/uikit.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/uikit-icons.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/tail.select.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/purecounter.min.js') ?>"></script>
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
              <h6 class="uk-h6 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-remove"><span><i class="fa-solid fa-gears"></i> <?= lang('install_main_settings') ?></span></h6>
              <p class="uk-text-meta uk-margin-remove-top uk-margin-small-bottom"><?= lang('install_main_settings_note') ?></p>
              <?= form_open(current_url()) ?>
                <div class="uk-grid-small uk-margin-small" uk-grid>
                  <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('site_name') ?></label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="name" value="<?= set_value('name') ?>" autocomplete="off">
                    </div>
                    <?= form_error('name', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('realmlist') ?></label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="realmlist" value="<?= set_value('realmlist') ?>" autocomplete="off">
                    </div>
                    <?= form_error('realmlist', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-width-1-1">
                    <label class="uk-form-label"><?= lang('expansion') ?></label>
                    <div class="uk-form-controls">
                      <select class="uk-select tail-single" id="select_expansion" name="expansion" autocomplete="off" data-placeholder="<?= lang('select_expansion') ?>">
                        <?php foreach (config_item('expansions') as $key => $expansion): ?>
                        <option value="<?= $key ?>" <?= set_select('expansion', $key) ?>><?= $expansion['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <?= form_error('expansion', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('emulator') ?></label>
                    <div class="uk-form-controls">
                      <select class="uk-select tail-single" id="select_emulator" name="emulator" autocomplete="off" data-placeholder="<?= lang('select_emulator') ?>">
                        <?php foreach (config_item('emulators') as $key => $emulator): ?>
                        <option value="<?= $key ?>" <?= set_select('emulator', $key) ?>><?= $emulator['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <?= form_error('emulator', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('bnet_authentication') ?></label>
                    <div class="uk-form-controls">
                      <select class="uk-select tail-single" id="select_bnet" name="bnet" autocomplete="off" data-placeholder="<?= lang('select_option') ?>">
                        <option value="false" <?= set_select('bnet', 'false') ?>><?= lang('disable') ?></option>
                        <option value="true" <?= set_select('bnet', 'true') ?>><?= lang('enable') ?></option>
                      </select>
                    </div>
                    <?= form_error('bnet', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
                <button class="uk-button uk-button-default uk-margin-small-top" type="submit"><?= lang('install') ?></button>
              <?= form_close() ?>
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
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
  </body>
</html>
