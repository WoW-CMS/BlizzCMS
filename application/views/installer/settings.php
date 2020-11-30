<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Migration | BlizzCMS Plus</title>
    <script src="<?= base_url('assets/core/js/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/core/fontawesome/js/all.min.js'); ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/core/uikit/css/uikit.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/core/css/install.css'); ?>">
    <script src="<?= base_url('assets/core/uikit/js/uikit.min.js'); ?>"></script>
    <script src="<?= base_url('assets/core/uikit/js/uikit-icons.min.js'); ?>"></script>
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
            <h1 class="uk-h1 step-title uk-text-bold uk-text-center uk-margin-remove">Installer</h1>
            <p class="uk-text-small uk-text-center uk-margin-remove-top uk-margin-bottom">Please fill the form with your corresponding information to proceed with the installation.</p>
            <?php if ($this->session->flashdata('error')): ?>
            <div class="uk-alert-danger uk-margin-small" uk-alert>
              <a class="uk-alert-close" uk-close></a>
              <p><i class="fas fa-database"></i> <?= $this->session->flashdata('error'); ?></p>
            </div>
            <?php endif; ?>
            <?= form_open(current_url()); ?>
              <h5 class="uk-h5 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-cog fa-spin"></i> General</span></h5>
              <div class="uk-margin-small uk-light">
                <label class="uk-form-label">Website Main Language:</label>
                <div class="uk-form-controls">
                  <select name="language" class="uk-select">
                    <option value="english">English</option>
                    <option value="spanish">Spanish</option>
                  </select>
                </div>
                <?= form_error('language', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
              </div>
              <h5 class="uk-h5 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-database"></i> Website Database</span></h5>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Website</strong> Database Hostname:</label>
                    <div class="uk-form-controls">
                      <input name="website_hostname" class="uk-input" type="text" placeholder="Hostname">
                    </div>
                    <?= form_error('website_hostname', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Website</strong> Database Port:</label>
                    <div class="uk-form-controls">
                      <input name="website_port" class="uk-input" type="text" placeholder="Port">
                    </div>
                    <?= form_error('website_port', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Website</strong> Database Name:</label>
                    <div class="uk-form-controls">
                      <input name="website_database" class="uk-input" type="text" placeholder="Database">
                    </div>
                    <?= form_error('website_database', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Website</strong> Database Prefix:</label>
                    <div class="uk-form-controls">
                      <input name="website_prefix" class="uk-input" type="text" placeholder="Prefix">
                    </div>
                    <?= form_error('website_prefix', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Website</strong> Database Username:</label>
                    <div class="uk-form-controls">
                      <input name="website_username" class="uk-input" type="text" placeholder="Username">
                    </div>
                    <?= form_error('website_username', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                  </div>
                  <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Website</strong> Database Password:</label>
                    <div class="uk-form-controls">
                      <input name="website_password" class="uk-input" type="password" placeholder="Password">
                    </div>
                    <?= form_error('website_password', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                  </div>
                </div>
              </div>
              <h5 class="uk-h5 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-database"></i> Auth Database</span></h5>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Auth</strong> Database Hostname:</label>
                    <div class="uk-form-controls">
                      <input name="auth_hostname" class="uk-input" type="text" placeholder="Hostname">
                    </div>
                    <?= form_error('auth_hostname', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Auth</strong> Database Port:</label>
                    <div class="uk-form-controls">
                      <input name="auth_port" class="uk-input" type="text" placeholder="Port">
                    </div>
                    <?= form_error('auth_port', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Auth</strong> Database Name:</label>
                    <div class="uk-form-controls">
                      <input name="auth_database" class="uk-input" type="text" placeholder="Database">
                    </div>
                    <?= form_error('website_database', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Auth</strong> Database Prefix:</label>
                    <div class="uk-form-controls">
                      <input name="auth_prefix" class="uk-input" type="text" placeholder="Prefix">
                    </div>
                    <?= form_error('website_prefix', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Auth</strong> Database Username:</label>
                    <div class="uk-form-controls">
                      <input name="auth_username" class="uk-input" type="text" placeholder="Username">
                    </div>
                    <?= form_error('auth_username', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Auth</strong> Database Password:</label>
                    <div class="uk-form-controls">
                      <input name="auth_password" class="uk-input" type="password" placeholder="Password">
                    </div>
                    <?= form_error('auth_password', '<span class="uk-text-small uk-text-danger">', '</span>'); ?>
                  </div>
                </div>
              </div>
              <div class="uk-margin">
                <button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit"><i class="fas fa-cog fa-spin"></i> Write settings Files</button>
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