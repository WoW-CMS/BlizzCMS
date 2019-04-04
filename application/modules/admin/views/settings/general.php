<?php
  $fileBlizzCMS = FCPATH.'application/config/blizzcms.php';
  $fileDatabase = FCPATH.'application/config/database.php';
  $filePlus = FCPATH.'application/config/plus.php';
  $fileBugtracker = FCPATH.'application/modules/bugtracker/config/bugtracker.php';
  $fileDonate = FCPATH.'application/modules/donate/config/donate.php';

if (isset($_POST['submitBlizzCMS'])):
  $datafx = array(
    'filename' => $fileBlizzCMS,
    'blizzcmsName' => str_replace(' ', '', $_POST['blizzcmsProjectName']),
    'actualName' => $this->admin_model->getProjectName($fileBlizzCMS),
    'blizzcmsTimeZone' => str_replace(' ', '', $_POST['blizzcmsTimeZone']),
    'actualTimeZone' => $this->admin_model->getTimeZone($fileBlizzCMS),
    'blizzcmsDiscord' => str_replace(' ', '', $_POST['blizzcmsDiscordInv']),
    'actualDiscord' => $this->admin_model->getDiscordInv($fileBlizzCMS),
    'blizzcmsRealmlist' => str_replace(' ', '', $_POST['blizzcmsRealmlist']),
    'actualRealmlist' => $this->admin_model->getRealmlist($fileBlizzCMS),
    'blizzcmsStaffColor' => str_replace(' ', '', $_POST['blizzcmsStaffColor']),
    'actualStaffColor' => $this->admin_model->getStaffColor($fileBlizzCMS),
    'blizzcmsThemeName' => str_replace(' ', '', $_POST['blizzcmsTheme']),
    'actualTheme' => $this->admin_model->getThemeName($fileBlizzCMS),
  );

  $this->admin_model->settingBlizzCMS($datafx);
endif;

if (isset($_POST['submitRanks'])):
  $dataranks = array(
    'filename' => $filePlus,
    'adminLevel' => $_POST['adminLevel'],
    'actualadminLevel' => $this->admin_model->getRankAdminLevel($filePlus),
    'modLevel' => $_POST['modLevel'],
    'actualmodLevel' => $this->admin_model->getRankModLevel($filePlus),
  );
  $this->admin_model->settingRegister($dataranks);
endif;

if (isset($_POST['submitDatabase'])):
  $datadb = array(
    'filename' => $fileDatabase,
    'dbCmsHost' => str_replace(' ', '', $_POST['databaseCmsHost']),
    'actualdbCmsHost' => $this->admin_model->getDatabaseCmsHost($fileDatabase),
    'dbCmsUser' => str_replace(' ', '', $_POST['databaseCmsUser']),
    'actualdbCmsUser' => $this->admin_model->getDatabaseCmsUser($fileDatabase),
    'dbCmsPassword' => str_replace(' ', '', $_POST['databaseCmsPassword']),
    'actualdbCmsPassword' => $this->admin_model->getDatabaseCmsPassword($fileDatabase),
    'dbCmsName' => str_replace(' ', '', $_POST['databaseCmsName']),
    'actualdbCmsdbName' => $this->admin_model->getDatabaseCmsName($fileDatabase),
    'dbAuthHost' => str_replace(' ', '', $_POST['databaseAuthHost']),
    'actualdbAuthHost' => $this->admin_model->getDatabaseAuthHost($fileDatabase),
    'dbAuthUser' => str_replace(' ', '', $_POST['databaseAuthUser']),
    'actualdbAuthUser' => $this->admin_model->getDatabaseAuthUser($fileDatabase),
    'dbAuthPassword' => str_replace(' ', '', $_POST['databaseAuthPassword']),
    'actualdbAuthPassword' => $this->admin_model->getDatabaseAuthPassword($fileDatabase),
    'dbAuthName' => str_replace(' ', '', $_POST['databaseAuthName']),
    'actualdbAuthName' => $this->admin_model->getDatabaseAuthName($fileDatabase),
  );
  $this->admin_model->settingDatabase($datadb);
endif;

if (isset($_POST['submitCaptcha'])):
  $datacaptcha = array(
    'filename' => $filePlus,
    'recaptchaKey' => str_replace(' ', '', $_POST['recaptchaKey']),
    'actualrecaptchaKey' => $this->admin_model->getRecaptchaKey($filePlus),
  );
  $this->admin_model->settingRecaptcha($datacaptcha);
endif;

if (isset($_POST['submitSMTP'])):
  $datasmtp = array(
    'filename' => $filePlus,
    'smtpHost' => str_replace(' ', '', $_POST['smtpHost']),
    'actualsmtpHost' => $this->admin_model->getSMTPHost($filePlus),
    'smtpUser' => str_replace(' ', '', $_POST['smtpUser']),
    'actualsmtpUser' => $this->admin_model->getSMTPUser($filePlus),
    'smtpPass' => str_replace(' ', '', $_POST['smtpPass']),
    'actualsmtpPass' => $this->admin_model->getSMTPPass($filePlus),
    'smtpPort' => str_replace(' ', '', $_POST['smtpPort']),
    'actualsmtpPort' => $this->admin_model->getSMTPPort($filePlus),
    'smtpCrypto' => str_replace(' ', '', $_POST['smtpCrypto']),
    'actualsmtpCrypto' => $this->admin_model->getSMTPCrypto($filePlus),
    'senderEmail' => str_replace(' ', '', $_POST['senderEmail']),
    'actualsenderEmail' => $this->admin_model->getSenderEmail($filePlus),
    'senderName' => str_replace(' ', '', $_POST['senderName']),
    'actualsenderName' => $this->admin_model->getSenderName($filePlus),
  );
  $this->admin_model->settingRecaptcha($datasmtp);
endif;

if (isset($_POST['submitRegister'])):
  $dataregister = array(
    'filename' => $filePlus,
    'registerType' => $_POST['registerType'],
    'actualregisterType' => $this->admin_model->getRegisterType($filePlus),
  );
  $this->admin_model->settingRegister($dataregister);
endif;

if (isset($_POST['submitBugtracker'])):
  $databugtracker = array(
    'filename' => $fileBugtracker,
    'bugtrackerText' => str_replace(' ', '', $_POST['bugtrackerText']),
    'actualbugtrackerText' => $this->admin_model->getBugtrackerText($fileBugtracker),
  );
  $this->admin_model->settingBugtracker($databugtracker);
endif;

if (isset($_POST['submitDonate'])):
  $datadonate = array(
    'filename' => $fileDonate,
    'paypalCurrency' => str_replace(' ', '', $_POST['paypalCurrency']),
    'actualpaypalCurrency' => $this->admin_model->getPaypalCurrency($fileDonate),
    'paypalMode' => $_POST['paypalMode'],
    'actualpaypalMode' => $this->admin_model->getPaypalMode($fileDonate),
    'paypalclientId' => str_replace(' ', '', $_POST['paypalclientId']),
    'actualpaypalclientId' => $this->admin_model->getPaypalClientID($fileDonate),
    'paypalPassword' => str_replace(' ', '', $_POST['paypalPassword']),
    'actualpaypalPassword' => $this->admin_model->getPaypalPassword($fileDonate),
  );
  $this->admin_model->settingDonate($datadonate);
endif; ?>

    <?= $tiny ?>
    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-sliders-h"></i> <?= $this->lang->line('admin_nav_manage_settings'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="" class="uk-icon-button"><i class="fas fa-info"></i></a>
          </div>
        </div>
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-1-4@s">
            <div class="uk-card uk-card-secondary">
              <ul class="uk-nav uk-nav-default">
                <li class="uk-active"><a href="<?= base_url('admin/settings'); ?>"><i class="fas fa-cog"></i> General Settings</a></li>
                <li><a href="<?= base_url('admin/settings/database'); ?>"><i class="fas fa-database"></i> Databases Settings</a></li>
                <li><a href="<?= base_url('admin/settings/optional'); ?>"><i class="fas fa-layer-group"></i> Optional Settings</a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@s">
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-body">
                <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-text-center uk-margin-small"><span>General Settings</span></h5>
                <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-small">BlizzCMS</h5>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase">Project Name</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-mouse-pointer"></i></span>
                          <input class="uk-input" type="text" name="blizzcmsProjectName" value="<?= $this->admin_model->getProjectName($fileBlizzCMS); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase">Realmlist</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-mouse-pointer"></i></span>
                          <input class="uk-input" type="text" name="blizzcmsRealmlist" value="<?= $this->admin_model->getRealmlist($fileBlizzCMS); ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase">Discord ID</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fab fa-discord"></i></span>
                          <input class="uk-input" type="text" name="blizzcmsDiscordInv" value="<?= $this->admin_model->getDiscordInv($fileBlizzCMS); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase">Timezone</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="far fa-clock"></i></span>
                          <input class="uk-input" type="text" name="blizzcmsTimeZone" value="<?= $this->admin_model->getTimeZone($fileBlizzCMS); ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase">Forum STAFF Color</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-palette"></i></span>
                          <input class="uk-input" type="text" name="blizzcmsStaffColor" value="<?= $this->admin_model->getStaffColor($fileBlizzCMS); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase">Theme Name</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-columns"></i></span>
                          <input class="uk-input" type="text" name="blizzcmsTheme" value="<?= $this->admin_model->getThemeName($fileBlizzCMS); ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-primary uk-width-1-1" name="submitBlizzCMS" type="submit"><i class="fas fa-sync"></i> Update</button>
                </div>
              </div>
            </div>
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-body">
                <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-text-center uk-margin-small"><span>Modules Settings</span></h5>
                <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-small">Donate</h5>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">PayPal Currency</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-file-invoice-dollar"></i></span>
                          <input class="uk-input" type="text" name="paypalCurrency" value="<?= $this->admin_model->getPaypalCurrency($fileDonate); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">PayPal Mode</label>
                      <div class="uk-form-controls">
                        <select class="uk-select" name="paypalMode">
                          <option value="sandbox" <?php if($this->admin_model->getPaypalMode($fileDonate) == 'sandbox') echo 'selected'; ?>>Sandbox</option>
                          <option value="live" <?php if($this->admin_model->getPaypalMode($fileDonate) == 'live') echo 'selected'; ?>>Live</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label">PayPal Client ID</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-key"></i></span>
                      <input class="uk-input" type="text" name="paypalclientId" value="<?= $this->admin_model->getPaypalClientID($fileDonate); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label">PayPal Secret Password</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-key"></i></span>
                      <input class="uk-input" type="text" name="paypalPassword" value="<?= $this->admin_model->getPaypalPassword($fileDonate); ?>" required>
                    </div>
                  </div>
                </div>
                <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom">Bugtracker</h5>
                <div class="uk-margin-small">
                  <label class="uk-form-label">Description Text</label>
                  <div class="uk-form-controls">
                    <div class="uk-width-1-1">
                      <textarea class="uk-textarea tinyeditor" rows="12" name="bugtrackerText"><?= $this->admin_model->getBugtrackerText($fileBugtracker); ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-primary uk-width-1-1" name="submitCaptcha" type="submit"><i class="fas fa-sync"></i> Update</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
