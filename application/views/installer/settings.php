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
    <section class="uk-section uk-section-small">
      <div class="uk-container">
        <div class="uk-grid" data-uk-grid>
          <div class="uk-width-1-5@s"></div>
          <div class="uk-width-3-5@s">
            <h1 class="uk-logo uk-text-center">BlizzCMS</h1>
            <div class="uk-card uk-card-default uk-card-body">
              <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-margin-remove"><span><i class="fas fa-cogs"></i> <?= lang('basic_settings') ?></span></h5>
              <p class="uk-text-meta uk-margin-remove-top uk-margin-small-bottom"><?= lang('basic_settings_data') ?></p>
              <?= form_open(current_url()) ?>
              <div class="uk-margin-small">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('website_name') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="name" value="<?= set_value('name') ?>">
                    </div>
                    <?= form_error('name', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('realmlist') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="realmlist" value="<?= set_value('realmlist') ?>">
                    </div>
                    <?= form_error('realmlist', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label"><?= lang('expansion') ?>:</label>
                <div class="uk-form-controls">
                  <select class="uk-select" name="expansion">
                    <option value="" hidden selected><?= lang('select_expansion') ?></option>
                    <?php foreach ($expansions as $key => $expansion): ?>
                    <option value="<?= $key ?>" <?= set_select('expansion', $key) ?>><?= $expansion ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <?= form_error('expansion', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('emulator') ?>:</label>
                    <div class="uk-form-controls">
                      <select class="uk-select" name="emulator">
                        <option value="" hidden selected><?= lang('select_emulator') ?></option>
                        <option value="azeroth" <?= set_select('emulator', 'azeroth') ?>>AzerothCore</option>
                        <option value="cmangos" <?= set_select('emulator', 'cmangos') ?>>CMaNGOS</option>
                        <option value="mangos" <?= set_select('emulator', 'mangos') ?>>MaNGOS</option>
                        <option value="old_trinity" <?= set_select('emulator', 'old_trinity') ?>>TrinityCore</option>
                        <option value="trinity" <?= set_select('emulator', 'trinity') ?>>TrinityCore (SRP6)</option>
                      </select>
                    </div>
                    <?= form_error('emulator', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('bnet_account') ?>:</label>
                    <div class="uk-form-controls">
                      <select class="uk-select" name="bnet">
                        <option value="" hidden selected><?= lang('select_option') ?></option>
                        <option value="true" <?= set_select('bnet', 'true') ?>><?= lang('enable') ?></option>
                        <option value="false" <?= set_select('bnet', 'false') ?>><?= lang('disable') ?></option>
                      </select>
                    </div>
                    <?= form_error('bnet', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <button class="uk-button uk-button-default uk-margin-small-top" type="submit"><i class="fas fa-spinner"></i> <?= lang('install_now') ?></button>
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