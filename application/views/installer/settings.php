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
            <p class="uk-text-center uk-margin-remove-top uk-margin-bottom"><?= lang('settings_title') ?></p>
            <?php if ($this->session->flashdata('error')): ?>
            <div class="uk-alert-danger uk-margin-small" uk-alert>
              <a class="uk-alert-close" uk-close></a>
              <p><i class="fas fa-database"></i> <?= $this->session->flashdata('error') ?></p>
            </div>
            <?php endif ?>
            <?= form_open(current_url()) ?>
              <h5 class="uk-h5 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-cog"></i> General</span></h5>
              <div class="uk-margin-small uk-light">
                <label class="uk-form-label"><?= lang('language') ?>:</label>
                <div class="uk-form-controls">
                  <select class="uk-select" name="language">
                    <option value="" hidden selected><?= lang('select_language') ?></option>
                    <?php foreach (config_item('supported_languages') as $value): ?>
                    <option value="<?= $value ?>" <?= set_select('language', $value) ?>><?= ucfirst($value) ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <?= form_error('language', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
              </div>
              <h5 class="uk-h5 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-database"></i> Website Database</span></h5>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('hostname') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="website_hostname" value="<?= set_value('website_hostname') ?>" placeholder="<?= lang('hostname') ?>">
                    </div>
                    <?= form_error('website_hostname', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('port') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="website_port" value="<?= set_value('website_port') ?>" placeholder="<?= lang('port') ?>">
                    </div>
                    <?= form_error('website_port', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('database') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="website_database" value="<?= set_value('website_database') ?>" placeholder="<?= lang('database') ?>">
                    </div>
                    <?= form_error('website_database', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('prefix') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="website_prefix" value="<?= set_value('website_prefix') ?>" placeholder="<?= lang('prefix') ?>">
                    </div>
                    <?= form_error('website_prefix', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('username') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="website_username" value="<?= set_value('website_username') ?>" placeholder="<?= lang('username') ?>">
                    </div>
                    <?= form_error('website_username', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('password') ?>:</label>
                    <div class="uk-form-controls">
                      <input name="website_password" class="uk-input" type="password" placeholder="<?= lang('password') ?>">
                    </div>
                    <?= form_error('website_password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <h5 class="uk-h5 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-database"></i> Auth Database</span></h5>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('hostname') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="auth_hostname" value="<?= set_value('auth_hostname') ?>" placeholder="<?= lang('hostname') ?>">
                    </div>
                    <?= form_error('auth_hostname', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('port') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="auth_port" value="<?= set_value('auth_port') ?>" placeholder="<?= lang('port') ?>">
                    </div>
                    <?= form_error('auth_port', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('database') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="auth_database" value="<?= set_value('auth_database') ?>" placeholder="<?= lang('database') ?>">
                    </div>
                    <?= form_error('website_database', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('prefix') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="auth_prefix" value="<?= set_value('auth_prefix') ?>" placeholder="<?= lang('prefix') ?>">
                    </div>
                    <?= form_error('website_prefix', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('username') ?>:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="auth_username" value="<?= set_value('auth_username') ?>" placeholder="<?= lang('username') ?>">
                    </div>
                    <?= form_error('auth_username', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('password') ?>:</label>
                    <div class="uk-form-controls">
                      <input name="auth_password" class="uk-input" type="password" placeholder="<?= lang('password') ?>">
                    </div>
                    <?= form_error('auth_password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                </div>
              </div>
              <button class="uk-button uk-button-primary uk-width-1-1 uk-margin" type="submit"><i class="fas fa-database"></i> <?= lang('proceed_button') ?></button>
            <?= form_close() ?>
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