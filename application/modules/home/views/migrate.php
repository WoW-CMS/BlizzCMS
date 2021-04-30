<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Migration | BlizzCMS Plus</title>
    <script src="<?= base_url('assets/core/js/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/core/fontawesome/js/all.min.js'); ?>" defer></script>
    <link rel="stylesheet" href="<?= base_url('assets/core/uikit/css/uikit.min.css'); ?>"/>
    <link rel="stylesheet" href="<?= base_url('assets/core/css/install.css'); ?>"/>
    <script src="<?= base_url('assets/core/uikit/js/uikit.min.js'); ?>"></script>
    <script src="<?= base_url('assets/core/uikit/js/uikit-icons.min.js'); ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/core/amaranjs/css/amaran.min.css'); ?>"/>
    <script src="<?= base_url('assets/core/amaranjs/js/jquery.amaran.min.js'); ?>"></script>
  </head>
  <body>
    <header>
      <div class="uk-navbar-container uk-navbar-transparent">
        <div class="uk-container">
          <nav class="uk-navbar" uk-navbar>
            <div class="uk-navbar-left">
              <a target="_blank" href="https://wow-cms.com" class="uk-navbar-item uk-logo">BlizzCMS<sup class="uk-text-success">+</a>
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
            <h1 class="uk-h1 step-title uk-text-bold uk-text-center uk-margin-remove">Migration</h1>
            <p class="uk-text-small uk-text-center uk-margin-remove-top uk-margin-bottom">Complete this last step to finish the migration of <span class="uk-text-bold">BlizzCMS<sup class="uk-text-success">+</sup></span></p>
            <?= form_open('confmigrate') ?>
              <h5 class="uk-h5 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-sync fa-spin"></i> Website Settings</span></h5>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label">Server Name:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="website_name" placeholder="MyServer" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label">Realmlist:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="website_realmlist" placeholder="logon.domain.com" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label">Expansion:</label>
                    <div class="uk-form-controls">
                      <select class="uk-select" name="website_expansion">
                        <option value="1">Vanilla</option>
                        <option value="2">The Burning Crusade</option>
                        <option value="3">Wrath of the Lich King</option>
                        <option value="4">Cataclysm</option>
                        <option value="5">Mist of Pandaria</option>
                        <option value="6">Warlords of Draenor</option>
                        <option value="7">Legion</option>
                        <option value="8">Battle for Azeroth</option>
                        <option value="9">ShadowLands</option>
                      </select>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label">Discord Invitation ID:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="website_invitation" pattern=".{,7}" placeholder="WGGGVgX" required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label">Emulator:</label>
                    <div class="uk-form-controls">
                      <select class="uk-select" name="website_emulator">
                        <option value="srp6">SRP6</option>
                        <option value="old-trinity">Battle.Net (Sha_pass_hash)</option>
                        <option value="hex">cMangos (Mangos)</option>
                        <option value="default">Default</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label">Bnet Enabled?:</label>
                    <div class="uk-form-controls">
                      <select class="uk-select" name="website_bnet">
                        <option value="1">Yes</option>
                        <option value="2">No</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <div class="uk-margin">
                <button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit"><i class="fas fa-sync fa-spin"></i> Finish Migration</button>
              </div>
            <?= form_close(); ?>
          </div>
          <div class="uk-width-1-4@s"></div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall">
      <div class="uk-container">
        <h5 class="uk-h5 uk-text-center uk-margin-remove">Copyright <i class="far fa-copyright"></i> <?= date('Y'); ?> <span class="uk-text-bold">WoW-CMS</span>. All rights reserved</h5>
      </div>
    </section>
  </body>
</html>
