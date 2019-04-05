<?php
if (isset($_POST['finishingIt'])):
  $realm_id = $_POST['char_realmid'];
  $hostname = $_POST['char_hostname'];
  $database = $_POST['char_database'];
  $username = $_POST['char_username'];
  $password = $_POST['char_password'];
  $soaphost = $_POST['soap_hostname'];
  $soapport = $_POST['soap_port'];
  $soapuser = $_POST['soap_username'];
  $soappass = $_POST['soap_password'];

  $this->m_modules->insertRealm($hostname, $username, $password, $database, $realm_id, $soaphost, $soapuser, $soappass, $soapport);

  $this->home_model->updateInstallation();

  redirect(base_url(),'refresh');
endif; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?= base_url('theme/'.$this->config->item('theme_name').'/images/favicon.ico'); ?>">
    <title>Installation | BlizzCMS Plus</title>
    <link rel="stylesheet" href="<?= base_url('includes/core/uikit/css/uikit.min.css'); ?>"/>
    <script src="<?= base_url('includes/core/uikit/js/uikit.min.js'); ?>"></script>
    <script src="<?= base_url('includes/core/uikit/js/uikit-icons.min.js'); ?>"></script>
    <script src="<?= base_url('includes/core/fontawesome/js/all.min.js'); ?>" defer></script>
    <link rel="stylesheet" href="<?= base_url('includes/core/css/install.css'); ?>"/>
    <script src="<?= base_url('includes/core/js/jquery-3.3.1.min.js'); ?>"></script>
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
        <h1 class="uk-h1 step-title uk-text-bold uk-text-center uk-margin-remove">Installation</h1>
        <p class="uk-text-small uk-text-center uk-margin-remove-top uk-margin-bottom">Complete this last step to finish the installation of <span class="uk-text-bold">BlizzCMS<sup class="uk-text-success">+</sup></span></p>
        <form action="" method="POST" accept-charset="utf-8" autocomplete="off">
          <h5 class="uk-h5 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-server"></i> Create Realm</span></h5>
          <div class="uk-margin-small-top uk-margin-bottom uk-light">
            <div class="uk-grid uk-grid-small" data-uk-grid>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label"><strong>Character</strong> Database Hostname:</label>
                <div class="uk-form-controls">
                  <input name="char_hostname" class="uk-input" type="text" id="char_hostname" placeholder="Hostname" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label"><strong>Character</strong> Database Name:</label>
                <div class="uk-form-controls">
                  <input name="char_database" class="uk-input" type="text" id="char_database" placeholder="Database" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label"><strong>Character</strong> Database Username:</label>
                <div class="uk-form-controls">
                  <input name="char_username" class="uk-input" type="text" id="char_username" placeholder="Username" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label"><strong>Character</strong> Database Password:</label>
                <div class="uk-form-controls">
                  <input name="char_password" class="uk-input" type="password" id="char_password" placeholder="Password">
                </div>
              </div>
            </div>
          </div>
          <h5 class="uk-h5 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-exchange-alt"></i> SOAP Settings</span></h5>
          <div class="uk-margin-small uk-light">
            <div class="uk-grid uk-grid-small" data-uk-grid>
              <div class="uk-inline uk-width-1-2@s uk-width-1-5@m">
                <label class="uk-form-label"><strong>Realm</strong> ID:</label>
                <div class="uk-form-controls">
                  <input class="uk-input" name="char_realmid" type="number" placeholder="Auth ID" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-5@m">
                <label class="uk-form-label"><strong>Soap</strong> Hostname:</label>
                <div class="uk-form-controls">
                  <input name="soap_hostname" class="uk-input" type="text" id="soap_hostname" placeholder="Hostname" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-5@m">
                <label class="uk-form-label"><strong>Soap</strong> Port:</label>
                <div class="uk-form-controls">
                  <input name="soap_port" class="uk-input" type="text" id="soap_port" placeholder="Port" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-5@m">
                <label class="uk-form-label"><strong>Soap</strong> Username:</label>
                <div class="uk-form-controls">
                  <input name="soap_username" class="uk-input" type="text" id="soap_username" placeholder="Username" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-5@m">
                <label class="uk-form-label"><strong>Soap</strong> Password:</label>
                <div class="uk-form-controls">
                  <input name="soap_password" class="uk-input" type="password" id="soap_password" placeholder="Password">
                </div>
              </div>
            </div>
          </div>
          <div class="uk-margin">
            <button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit" name="finishingIt"><i class="fas fa-cog fa-spin"></i> Finish installation</button>
          </div>
        </form>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall">
      <div class="uk-container">
        <h5 class="uk-h5 uk-text-center uk-margin-remove">Copyright <i class="far fa-copyright"></i> <?= date('Y') ?> <span class="uk-text-bold">WoW-CMS</span>. All rights reserved</h5>
      </div>
    </section>
  </body>
</html>
