<?php
if (isset($_POST['finishingIt'])):
  $hostname = $_POST['hostname'];
  $username = $_POST['host_user'];
  $password = $_POST['host_pass'];
  $database = $_POST['host_db'];
  $realm_id = $_POST['host_realmid'];
  $soaphost = $_POST['soap_hostname'];
  $soapuser = $_POST['soap_user'];
  $soappass = $_POST['soap_pass'];
  $soapport = $_POST['soap_port'];

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
    <title>Installation | <?= $this->config->item('ProjectName'); ?></title>
    <link rel="stylesheet" href="<?= base_url('includes/core/uikit/css/uikit.min.css'); ?>"/>
    <script src="<?= base_url('includes/core/uikit/js/uikit.min.js'); ?>"></script>
    <script src="<?= base_url('includes/core/uikit/js/uikit-icons.min.js'); ?>"></script>
    <script src="<?= base_url('includes/core/fontawesome/js/all.min.js'); ?>" defer></script>
    <link rel="stylesheet" href="<?= base_url('includes/core/css/install.css'); ?>"/>
    <script src="<?= base_url('includes/core/js/jquery-3.3.1.min.js'); ?>"></script>
  </head>
  <body>
    <section class="uk-section uk-section-xsmall" uk-height-viewport="offset-top: true;offset-bottom: true">
      <div class="uk-container">
        <h3 class="uk-h3 blizzcms-logo uk-text-center uk-margin-small-top">BlizzCMS<sup class="uk-text-success">+</sup></h3>
        <p class="uk-text-center">Complete this last step to finish the installation of <span class="uk-text-bold">BlizzCMS<sup class="uk-text-success">+</sup></span>, If you need help or you have some problem you can enter our discord to help you.</p>
        <div class="uk-card uk-card-body">
          <form action="" method="POST" accept-charset="utf-8" autocomplete="off">
            <div class="uk-child-width-1-2@s" uk-grid>
              <div>
                <h4 class="uk-h4 uk-heading-line uk-text-uppercase uk-text-bold"><span><i class="fas fa-server"></i> Create Realm</span></h4>
                <div class="uk-margin uk-light">
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-2@m">
                      <label class="uk-form-label uk-text-uppercase"><strong>Character</strong> Database Hostname:</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="hostname" type="text" placeholder="Example: 127.0.0.1" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@m">
                      <label class="uk-form-label uk-text-uppercase"><strong>Character</strong> Database Name:</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="host_db" type="text" placeholder="Example: characters" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-2@m">
                      <label class="uk-form-label uk-text-uppercase"><strong>Character</strong> Database User:</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="host_user" type="text" placeholder="Example: root" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@m">
                      <label class="uk-form-label uk-text-uppercase"><strong>Character</strong> Database Password:</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="host_pass" type="password" placeholder="Example: ascent">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-3@m">
                      <label class="uk-form-label uk-text-uppercase"><strong>Realm ID</strong>:</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="host_realmid" type="number" placeholder="Auth Realm ID" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-3@m">
                      <label class="uk-form-label uk-text-uppercase"><strong>Soap</strong> Hostname:</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="soap_hostname" type="text" placeholder="Example: 127.0.0.1" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-3@m">
                      <label class="uk-form-label uk-text-uppercase"><strong>Soap</strong> Port:</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="soap_port" type="number" placeholder="Example: 7878" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-2@m">
                      <label class="uk-form-label uk-text-uppercase"><strong>Soap</strong> User:</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="soap_user" type="text" placeholder="Example: blizzcms" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@m">
                      <label class="uk-form-label uk-text-uppercase"><strong>Soap</strong> Password:</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="soap_pass" type="password" placeholder="Example: ascent" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <h4 class="uk-h4 uk-heading-line uk-text-uppercase uk-text-bold"><span><i class="fas fa-crown"></i> ADMIN Rank</span></h4>
                <p>Please enter the email of the account that will receive the administrator rank. If you do not have an account available please write "<strong>NULL</strong>" <i>without the quotes</i></p>
                <div class="uk-margin uk-light">
                  <label class="uk-form-label uk-text-uppercase">Account <strong>Email</strong>:</label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" placeholder="EMAIL" name="rankMail" required>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit" name="finishingIt"><i class="fas fa-cog fa-spin"></i> Finish installation</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-1-2@s">
            <h5 class="uk-h5 uk-margin-remove">Copyright <i class="far fa-copyright"></i> <?= date('Y'); ?> <span class="uk-text-bold">WoW-CMS</span>. All rights reserved</h5>
          </div>
          <div class="uk-width-1-2@s">
            <div class="uk-align-center uk-align-right@s uk-light">
              <a target="_blank" href="https://gitlab.com/WoW-CMS" class="uk-icon-button gitlab uk-margin-small-right"><i class="fab fa-gitlab"></i></a>
              <a target="_blank" href="https://discord.gg/vZG9vpS" class="uk-icon-button discord"><i class="fab fa-discord"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
