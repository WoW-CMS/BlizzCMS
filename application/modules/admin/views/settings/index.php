<?php
  $fileConfig = FCPATH.'application/config/config.php';
  $fileBlizzCMS = FCPATH.'application/config/blizzcms.php';
  $fileDatabase = FCPATH.'application/config/database.php';
  $filePlus = FCPATH.'application/config/plus.php';
  $fileBugtracker = FCPATH.'application/modules/bugtracker/config/bugtracker.php';
  $fileDonate = FCPATH.'application/modules/donate/config/donate.php';
  $fileStore = FCPATH.'application/modules/store/config/store.php';

if (isset($_POST['submitConfig'])):
  $data = array(
    'filename' => $fileConfig,
    'configURL' => str_replace(' ', '', $_POST['configURL']),
    'actualURL' => $this->admin_model->getConfigBaseUrl($fileConfig),
    'configLang' => $_POST['configLang'],
    'actualLang' => $this->admin_model->getConfigLanguage($fileConfig),
    'configCharSet' => str_replace(' ', '', $_POST['configCharSet']),
    'actualCharSet' => $this->admin_model->getConfigCharSet($fileConfig),
    'configSess' => str_replace(' ', '', $_POST['configSessExpiration']),
    'actualSess' => $this->admin_model->getConfigSessExpiration($fileConfig),
  );
  $this->admin_model->settingConfig($data);
endif;

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
endif;

if (isset($_POST['submitStore'])):
  $datastore = array(
    'filename' => $fileStore,
    'storeType' => $_POST['storeType'],
    'actualstoreType' => $this->admin_model->getStoreType($fileStore),
  );
  $this->admin_model->settingStore($datastore);
endif; ?>

      <?= $tiny ?>
      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
          <div class="uk-card uk-card-default uk-margin-small">
            <div class="uk-card-header">
              <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-cogs"></i></span><?= $this->lang->line('admin_nav_website_settings'); ?></h4>
            </div>
            <div class="uk-card-body">
              <div uk-grid>
                <div class="uk-width-auto@m">
                  <ul class="uk-tab-right" uk-tab="connect: #settings; animation: uk-animation-fade">
                    <li><a href="javascript:void(0)"><i class="fas fa-sliders-h"></i> Main Settings</a></li>
                    <li><a href="javascript:void(0)"><i class="fas fa-mouse-pointer"></i> Website Settings</a></li>
                    <li><a href="javascript:void(0)"><i class="fas fa-crown"></i> Ranks Settings</a></li>
                    <li><a href="javascript:void(0)"><i class="fas fa-database"></i> Databases Settings</a></li>
                    <li><a href="javascript:void(0)"><i class="fas fa-shield-alt"></i> reCaptcha Settings</a></li>
                    <li><a href="javascript:void(0)"><i class="fas fa-mail-bulk"></i> SMTP Settings</a></li>
                    <li><a href="javascript:void(0)"><i class="fas fa-user-plus"></i> Register Settings</a></li>
                    <li><a href="javascript:void(0)"><i class="fas fa-bug"></i> Bugtracker Settings</a></li>
                    <li><a href="javascript:void(0)"><i class="fab fa-paypal"></i> Donate Settings</a></li>
                    <li><a href="javascript:void(0)"><i class="fas fa-store"></i> Store Settings</a></li>
                  </ul>
                </div>
                <div class="uk-width-expand@m">
                  <ul id="settings" class="uk-switcher">
                    <li>
                      <form action="" method="post" accept-charset="utf-8">
                        <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-margin-small"><span><span class="uk-text-primary uk-text-bold">Main</span> Settings</span></h5>
                        <div class="uk-margin-small">
                          <div class="uk-grid uk-grid-small" data-uk-grid>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">Base Site URL</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-mouse-pointer"></i></span>
                                  <input class="uk-input" type="text" name="configURL" value="<?= $this->admin_model->getConfigBaseUrl($fileConfig); ?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">Default Language</label>
                              <div class="uk-form-controls">
                                <select class="uk-select" name="configLang">
                                  <option value="english" <?php if($this->admin_model->getConfigLanguage($fileConfig) == 'english') echo 'selected'; ?>>English</option>
                                  <option value="spanish" <?php if($this->admin_model->getConfigLanguage($fileConfig) == 'spanish') echo 'selected'; ?>>Spanish</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin-small">
                          <div class="uk-grid uk-grid-small" data-uk-grid>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">Default Character Set</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-code"></i></span>
                                  <input class="uk-input" type="text" name="configCharSet" value="<?= $this->admin_model->getConfigCharSet($fileConfig); ?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">Session Expiration</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-user-slash"></i></span>
                                  <input class="uk-input" type="text" name="configSessExpiration" value="<?= $this->admin_model->getConfigSessExpiration($fileConfig); ?>" required>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin">
                          <div class="uk-form-controls">
                            <button class="uk-button uk-button-primary uk-width-1-1" name="submitConfig" type="submit"><i class="fas fa-sync"></i> Update</button>
                          </div>
                        </div>
                      </form>
                    </li>
                    <li>
                      <form action="" method="post" accept-charset="utf-8">
                        <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-margin-small"><span><span class="uk-text-primary uk-text-bold">Website</span> Settings</span></h5>
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
                      </form>
                    </li>
                    <li>
                      <form action="" method="post" accept-charset="utf-8">
                        <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-margin-small"><span><span class="uk-text-primary uk-text-bold">Ranks</span> Settings</span></h5>
                        <div class="uk-margin-small">
                          <div class="uk-grid uk-grid-small" data-uk-grid>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">Administrator GMLevel</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-crown"></i></span>
                                  <input class="uk-input" type="text" name="adminLevel" value="<?= $this->admin_model->getRankAdminLevel($filePlus); ?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">Moderator GMLevel</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-gavel"></i></span>
                                  <input class="uk-input" type="text" name="modLevel" value="<?= $this->admin_model->getRankModLevel($filePlus); ?>" required>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="submitRanks" type="submit"><i class="fas fa-sync"></i> Update</button>
                        </div>
                      </form>
                    </li>
                    <li>
                      <form action="" method="post" accept-charset="utf-8">
                        <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-margin-small"><span><span class="uk-text-primary uk-text-bold">Website</span> Database Settings</span></h5>
                        <div class="uk-margin-small">
                          <div class="uk-grid uk-grid-small" data-uk-grid>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">Database Hostname</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-database"></i></span>
                                  <input class="uk-input" type="text" name="databaseCmsHost" value="<?= $this->admin_model->getDatabaseCmsHost($fileDatabase); ?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">Database Name</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-database"></i></span>
                                  <input class="uk-input" type="text" name="databaseCmsName" value="<?= $this->admin_model->getDatabaseCmsName($fileDatabase); ?>" required>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin-small">
                          <div class="uk-grid uk-grid-small" data-uk-grid>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">Database Username</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-user"></i></span>
                                  <input class="uk-input" type="text" name="databaseCmsUser" value="<?= $this->admin_model->getDatabaseCmsUser($fileDatabase); ?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">Database Password</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-key"></i></span>
                                  <input class="uk-input" type="text" name="databaseCmsPassword" value="<?= $this->admin_model->getDatabaseCmsPassword($fileDatabase); ?>" required>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-margin-top uk-margin-small-bottom"><span><span class="uk-text-primary uk-text-bold">Auth</span> Database Settings</span></h5>
                        <div class="uk-margin-small">
                          <div class="uk-grid uk-grid-small" data-uk-grid>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">Database Hostname</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-database"></i></span>
                                  <input class="uk-input" type="text" name="databaseAuthHost" value="<?= $this->admin_model->getDatabaseAuthHost($fileDatabase); ?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">Database Name</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-database"></i></span>
                                  <input class="uk-input" type="text" name="databaseAuthName" value="<?= $this->admin_model->getDatabaseAuthName($fileDatabase); ?>" required>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin-small">
                          <div class="uk-grid uk-grid-small" data-uk-grid>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">Database Username</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-user"></i></span>
                                  <input class="uk-input" type="text" name="databaseAuthUser" value="<?= $this->admin_model->getDatabaseAuthUser($fileDatabase); ?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">Database Password</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-key"></i></span>
                                  <input class="uk-input" type="text" name="databaseAuthPassword" value="<?= $this->admin_model->getDatabaseAuthPassword($fileDatabase); ?>" required>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="submitDatabase" type="submit"><i class="fas fa-sync"></i> Update</button>
                        </div>
                      </form>
                    </li>
                    <li>
                      <form action="" method="post" accept-charset="utf-8">
                        <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-margin-small"><span><span class="uk-text-primary uk-text-bold">reCaptcha</span> Settings</span></h5>
                        <div class="uk-margin-small">
                          <label class="uk-form-label uk-text-uppercase">reCaptcha Site Key</label>
                          <div class="uk-form-controls">
                            <div class="uk-inline uk-width-1-1">
                              <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-key"></i></span>
                              <input class="uk-input" type="text" name="recaptchaKey" value="<?= $this->admin_model->getRecaptchaKey($filePlus); ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="submitCaptcha" type="submit"><i class="fas fa-sync"></i> Update</button>
                        </div>
                      </form>
                    </li>
                    <li>
                      <form action="" method="post" accept-charset="utf-8">
                        <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-margin-small"><span><span class="uk-text-primary uk-text-bold">SMTP</span> Settings</span></h5>
                        <div class="uk-margin-small">
                          <div class="uk-grid uk-grid-small" data-uk-grid>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">SMTP Hostname</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-mail-bulk"></i></span>
                                  <input class="uk-input" type="text" name="smtpHost" value="<?= $this->admin_model->getSMTPHost($filePlus); ?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="uk-width-1-4@s">
                              <label class="uk-form-label uk-text-uppercase">SMTP Port</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <input class="uk-input" type="number" name="smtpPort" value="<?= $this->admin_model->getSMTPPort($filePlus); ?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="uk-width-1-4@s">
                              <label class="uk-form-label uk-text-uppercase">SMTP Encryption</label>
                              <div class="uk-form-controls">
                                <select class="uk-select" name="smtpCrypto">
                                  <option value="ssl" <?php if($this->admin_model->getSMTPCrypto($filePlus) == 'ssl') echo 'selected'; ?>>SSL</option>
                                  <option value="tls" <?php if($this->admin_model->getSMTPCrypto($filePlus) == 'tls') echo 'selected'; ?>>TLS</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin-small">
                          <div class="uk-grid uk-grid-small" data-uk-grid>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">SMTP Username</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-user"></i></span>
                                  <input class="uk-input" type="text" name="smtpUser" value="<?= $this->admin_model->getSMTPUser($filePlus); ?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">SMTP Password</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-key"></i></span>
                                  <input class="uk-input" type="text" name="smtpPass" value="<?= $this->admin_model->getSMTPPass($filePlus); ?>" required>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-margin-small"><span><span class="uk-text-primary uk-text-bold">Email</span> Settings</span></h5>
                        <div class="uk-margin-small">
                          <div class="uk-grid uk-grid-small" data-uk-grid>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">Sender Email</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-envelope"></i></span>
                                  <input class="uk-input" type="email" name="senderEmail" value="<?= $this->admin_model->getSenderEmail($filePlus); ?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">Sender Name</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-user-circle"></i></span>
                                  <input class="uk-input" type="text" name="senderName" value="<?= $this->admin_model->getSenderName($filePlus); ?>" required>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="submitSMTP" type="submit"><i class="fas fa-sync"></i> Update</button>
                        </div>
                      </form>
                    </li>
                    <li>
                      <form action="" method="post" accept-charset="utf-8">
                        <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-margin-small"><span><span class="uk-text-primary uk-text-bold">Register</span> Settings</span></h5>
                        <div class="uk-alert-primary uk-margin-small" uk-alert>
                          <p><i class="fas fa-info-circle"></i> If you enable this option is necessary that you configure SMTP for sending emails.</p>
                        </div>
                        <div class="uk-margin-small">
                          <label class="uk-form-label uk-text-uppercase">Account Activation</label>
                          <div class="uk-form-controls">
                            <select class="uk-select" name="registerType">
                              <option value="TRUE" <?php if($this->admin_model->getRegisterType($filePlus) == TRUE) echo 'selected'; ?>>Enabled</option>
                              <option value="FALSE" <?php if($this->admin_model->getRegisterType($filePlus) == FALSE) echo 'selected'; ?>>Disabled</option>
                            </select>
                          </div>
                        </div>
                        <div class="uk-margin">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="submitRegister" type="submit"><i class="fas fa-sync"></i> Update</button>
                        </div>
                      </form>
                    </li>
                    <li>
                      <form action="" method="post" accept-charset="utf-8">
                        <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-margin-small"><span><span class="uk-text-primary uk-text-bold">Bugtracker</span> Settings</span></h5>
                        <div class="uk-margin-small">
                          <label class="uk-form-label uk-text-uppercase">Description Text</label>
                          <div class="uk-form-controls">
                            <div class="uk-width-1-1">
                              <textarea class="uk-textarea tinyeditor" name="bugtrackerText" rows="10" cols="80"><?= $this->admin_model->getBugtrackerText($fileBugtracker); ?></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="submitBugtracker" type="submit"><i class="fas fa-sync"></i> Update</button>
                        </div>
                      </form>
                    </li>
                    <li>
                      <form action="" method="post" accept-charset="utf-8">
                        <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-margin-small"><span><span class="uk-text-primary uk-text-bold">Donate</span> Settings</span></h5>
                        <div class="uk-margin-small">
                          <div class="uk-grid uk-grid-small" data-uk-grid>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">PayPal Currency</label>
                              <div class="uk-form-controls">
                                <div class="uk-inline uk-width-1-1">
                                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-file-invoice-dollar"></i></span>
                                  <input class="uk-input" type="text" name="paypalCurrency" value="<?= $this->admin_model->getPaypalCurrency($fileDonate); ?>" required>
                                </div>
                              </div>
                            </div>
                            <div class="uk-width-1-2@s">
                              <label class="uk-form-label uk-text-uppercase">PayPal Mode</label>
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
                          <label class="uk-form-label uk-text-uppercase">PayPal Client ID</label>
                          <div class="uk-form-controls">
                            <div class="uk-inline uk-width-1-1">
                              <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-key"></i></span>
                              <input class="uk-input" type="text" name="paypalclientId" value="<?= $this->admin_model->getPaypalClientID($fileDonate); ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin-small">
                          <label class="uk-form-label uk-text-uppercase">PayPal Secret Password</label>
                          <div class="uk-form-controls">
                            <div class="uk-inline uk-width-1-1">
                              <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-key"></i></span>
                              <input class="uk-input" type="text" name="paypalPassword" value="<?= $this->admin_model->getPaypalPassword($fileDonate); ?>" required>
                            </div>
                          </div>
                        </div>
                        <div class="uk-margin">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="submitDonate" type="submit"><i class="fas fa-sync"></i> Update</button>
                        </div>
                      </form>
                    </li>
                    <li>
                      <form action="" method="post" accept-charset="utf-8">
                        <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-margin-small"><span><span class="uk-text-primary uk-text-bold">Store</span> Settings</span></h5>
                        <div class="uk-margin-small">
                          <label class="uk-form-label uk-text-uppercase">Store Type</label>
                          <div class="uk-form-controls">
                            <select class="uk-select" name="storeType">
                              <option value="1" <?php if($this->admin_model->getStoreType($fileStore) == '1') echo 'selected'; ?>>Store with Images</option>
                              <option value="2" <?php if($this->admin_model->getStoreType($fileStore) == '2') echo 'selected'; ?>>Store with Icons</option>
                            </select>
                          </div>
                        </div>
                        <div class="uk-margin">
                          <button class="uk-button uk-button-primary uk-width-1-1" name="submitStore" type="submit"><i class="fas fa-sync"></i> Update</button>
                        </div>
                      </form>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
