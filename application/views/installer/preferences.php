<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BlizzCMS – Installer</title>
    <script src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/fontawesome/js/all.min.js'); ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/uikit/css/uikit.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/install.css'); ?>">
    <script src="<?= base_url('assets/uikit/js/uikit.min.js'); ?>"></script>
    <script src="<?= base_url('assets/uikit/js/uikit-icons.min.js'); ?>"></script>
  </head>
  <body>
    <header>
      <div class="uk-navbar-container uk-navbar-transparent">
        <div class="uk-container">
          <nav class="uk-navbar" uk-navbar>
            <div class="uk-navbar-left">
              <a href="<?= current_url(); ?>" class="uk-navbar-item uk-logo">BlizzCMS</a>
            </div>
            <div class="uk-navbar-right">
              <div class="uk-navbar-item">
                <a target="_blank" href="https://gitlab.com/WoW-CMS" class="uk-icon-button gitlab uk-margin-small-right"><i class="fab fa-gitlab"></i></a>
                <a target="_blank" href="https://discord.gg/vZG9vpS" class="uk-icon-button discord"><i class="fab fa-discord"></i></a>
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
            <p class="uk-text-center uk-margin-remove-top uk-margin-bottom"><?= lang('preferences_title'); ?></p>
            <?= form_open(current_url()); ?>
              <h5 class="uk-h5 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-cog"></i> Preferences</span></h5>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('website_name'); ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="name" value="<?= set_value('name'); ?>" placeholder="<?= lang('name'); ?>">
                    </div>
                    <?= form_error('name', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('realmlist'); ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="realmlist" value="<?= set_value('realmlist'); ?>" placeholder="<?= lang('realmlist'); ?>">
                    </div>
                    <?= form_error('realmlist', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small uk-light">
                <label class="uk-form-label"><?= lang('expansion'); ?>:</label>
                <div class="uk-form-controls">
                  <select class="uk-select" name="expansion">
                    <option value="" hidden selected><?= lang('select_expansion'); ?></option>
                    <?php foreach (config_item('supported_expansions') as $key => $expansion): ?>
                    <option value="<?= $key; ?>" <?= set_select('expansion', $key); ?>><?= $expansion; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <?= form_error('expansion', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
              </div>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('emulator'); ?>:</label>
                    <div class="uk-form-controls">
                      <select class="uk-select" name="emulator">
                        <option value="" hidden selected><?= lang('select_emulator'); ?></option>
                        <option value="azeroth" <?= set_select('emulator', 'azeroth'); ?>>AzerothCore</option>
                        <option value="cmangos" <?= set_select('emulator', 'cmangos'); ?>>CMaNGOS</option>
                        <option value="mangos" <?= set_select('emulator', 'mangos'); ?>>MaNGOS</option>
                        <option value="old_trinity" <?= set_select('emulator', 'old_trinity'); ?>>TrinityCore</option>
                        <option value="trinity" <?= set_select('emulator', 'trinity'); ?>>TrinityCore (SRP6)</option>
                      </select>
                    </div>
                    <?= form_error('emulator', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('bnet_account'); ?>:</label>
                    <div class="uk-form-controls">
                      <select class="uk-select" name="bnet">
                        <option value="" hidden selected><?= lang('select_option'); ?></option>
                        <option value="true" <?= set_select('bnet', 'true'); ?>><?= lang('enable'); ?></option>
                        <option value="false" <?= set_select('bnet', 'false'); ?>><?= lang('disable'); ?></option>
                      </select>
                    </div>
                    <?= form_error('bnet', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                  </div>
                </div>
              </div>
              <button class="uk-button uk-button-primary uk-width-1-1 uk-margin" type="submit"><i class="fas fa-mouse-pointer"></i> <?= lang('finish_button') ?></button>
            <?= form_close(); ?>
          </div>
          <div class="uk-width-1-4@s"></div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall">
      <div class="uk-container">
        <h5 class="uk-h5 uk-text-center uk-margin-remove">Copyright <i class="far fa-copyright"></i> <?= date('Y'); ?> <span class="uk-text-bold">WoW-CMS</span>. <?= lang('rights_reserved'); ?></h5>
      </div>
    </section>
  </body>
</html>