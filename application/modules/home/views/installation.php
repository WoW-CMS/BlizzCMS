<?php
if (isset($_POST['finishingIt'])):
  $mailUser = $_POST['rankMail'];
  $hostname = $_POST['hostname'];
  $username = $_POST['host_user'];
  $password = $_POST['host_pass'];
  $database = $_POST['host_db'];
  $realm_id = $_POST['host_realmid'];
  $soaphost = $_POST['soap_hostname'];
  $soapuser = $_POST['soap_user'];
  $soappass = $_POST['soap_pass'];
  $soapport = $_POST['soap_port'];

  $qq = $this->m_data->getIDEmail($mailUser);

  if ($qq != '0'):
    $this->admin_model->getADDADMRank($qq, '1');
  endif;

  $this->m_modules->insertRealm($hostname, $username, $password, $database, $realm_id, $soaphost, $soapuser, $soappass, $soapport);

  $this->home_model->updateInstallation();

  redirect(base_url(),'refresh');
endif; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?= base_url('includes/images/favicon.ico'); ?>">
    <title>Installation | <?= $this->config->item('ProjectName'); ?></title>
    <!-- UIkit -->
    <link rel="stylesheet" href="<?= base_url('core/uikit/css/uikit.min.css'); ?>"/>
    <script src="<?= base_url('core/uikit/js/uikit.min.js'); ?>"></script>
    <script src="<?= base_url('core/uikit/js/uikit-icons.min.js'); ?>"></script>
    <!-- Font Awesome -->
    <script src="<?= base_url('core/fontawesome/js/all.min.js'); ?>"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('core/css/install.css'); ?>">
    <!-- JQuery -->
    <script src="<?= base_url('core/js/jquery-3.3.1.min.js'); ?>"></script>
  </head>
  <body>
    <div class="uk-section uk-section-xsmall uk-flex" uk-height-viewport="offset-top: true;offset-bottom: true">
      <div class="uk-container">
        <h3 class="uk-h3 uk-text-center blizzcms-logo-install">BlizzCMS</h3>
        <p class="uk-text-center">Fill this last form to finish the installation of <strong>BlizzCMS</strong>, if you need <strong>support</strong> you can enter our discord to help you.</p>
        <div class="uk-card uk-card-body">
          <form action="" method="POST" accept-charset="utf-8" autocomplete="off">
            <h3 class="uk-card-title uk-text-uppercase uk-text-bold uk-text-center"><i class="fas fa-wrench"></i> Last Settings</h3>
            <hr class="uk-hr">
            <div class="uk-child-width-1-2@s" uk-grid>
              <div>
                <h3 class="uk-card-title uk-text-uppercase uk-text-bold uk-text-center"><i class="far fa-star"></i> ADM Rank</h3>
                <p>Please enter the email of the account that will receive the administrator rank. If you do not have an account available please write "<strong>NULL</strong>" <i>without the quotes</i></p>
                <div class="uk-margin uk-light">
                  <label class="uk-form-label uk-text-uppercase">Account <strong>Email</strong></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" placeholder="EMAIL" name="rankMail" required>
                  </div>
                </div>
              </div>
              <div>
                <h3 class="uk-card-title uk-text-uppercase uk-text-bold uk-text-center"><i class="fas fa-server"></i> Create REALM</h3>
                <div class="uk-margin uk-light">
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><strong>Character</strong> Database Hostname</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="hostname" type="text" placeholder="Example: 127.0.0.1" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><strong>Character</strong> Database Name</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="host_db" type="text" placeholder="Example: characters" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><strong>Character</strong> Database User</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="host_user" type="text" placeholder="Example: root" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><strong>Character</strong> Database Password</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="host_pass" type="password" placeholder="Example: ascent">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <label class="uk-form-label uk-text-uppercase"><strong>Realm ID</strong></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" name="host_realmid" type="number" placeholder="Auth -> realmlist -> ID" required>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><strong>Soap</strong> Hostname</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="soap_hostname" type="text" placeholder="Example: 127.0.0.1" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><strong>Soap</strong> Port</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="soap_port" type="number" placeholder="Example: 7878" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><strong>Soap</strong> User</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="soap_user" type="text" placeholder="Example: blizzcms" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><strong>Soap</strong> Password</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="soap_pass" type="password" placeholder="Example: ascent" required>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin">
              <button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit" name="finishingIt"><i class="fas fa-cog fa-spin"></i> Finish installation</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="uk-section-xsmall">
      <div class="uk-container uk-container-expand uk-text-center uk-position-relative">
        <div class="uk-flex-inline uk-flex-center uk-margin-small">
          <a target="_blank" href="https://gitlab.com/ProjectCMS/BlizzCMS" class="uk-icon-button uk-light uk-margin-small-right"><i class="fab fa-gitlab"></i></a>
          <a target="_blank" href="https://discord.gg/SZteAfB" class="uk-icon-button  uk-light uk-margin-small-right"><i class="fab fa-discord"></i></a>
        </div>
        <h5 class="uk-h5 uk-margin-remove">Proudly powered by <span class="uk-text-bold">ProjectCMS</span></h5>
      </div>
    </div>
  </body>
</html>
