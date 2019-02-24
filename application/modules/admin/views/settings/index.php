<?php
  $fileConfig = FCPATH.'application/config/config.php';
  $fileFixCore = FCPATH.'application/config/blizzcms.php';
  $fileDatabase = FCPATH.'application/config/database.php';
  $fileCaptcha = FCPATH.'application/config/plus.php';
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

if (isset($_POST['submitFixCore'])):
  $datafx = array(
    'filename' => $fileFixCore,
    'blizzcmsName' => str_replace(' ', '', $_POST['blizzcmsProjectName']),
    'actualName' => $this->admin_model->getFixCoreProjectName($fileFixCore),
    'blizzcmsTimeZone' => str_replace(' ', '', $_POST['blizzcmsTimeZone']),
    'actualTimeZone' => $this->admin_model->getFixCoreTimeZone($fileFixCore),
    'blizzcmsDiscord' => str_replace(' ', '', $_POST['blizzcmsDiscordInv']),
    'actualDiscord' => $this->admin_model->getFixCoreDiscordInv($fileFixCore),
    'blizzcmsRealmlist' => str_replace(' ', '', $_POST['blizzcmsRealmlist']),
    'actualRealmlist' => $this->admin_model->getFixCoreRealmlist($fileFixCore),
    'blizzcmsStaffColor' => str_replace(' ', '', $_POST['blizzcmsStaffColor']),
    'actualStaffColor' => $this->admin_model->getFixCoreStaffColor($fileFixCore),
    'blizzcmsThemeName' => str_replace(' ', '', $_POST['blizzcmsTheme']),
    'actualTheme' => $this->admin_model->getFixCoreThemeName($fileFixCore),
  );

  $this->admin_model->settingFixCore($datafx);
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
    'filename' => $fileCaptcha,
    'recaptchaKey' => str_replace(' ', '', $_POST['recaptchaKey']),
    'actualrecaptchaKey' => $this->admin_model->getRecaptchaKey($fileCaptcha),
  );
  $this->admin_model->settingRecaptcha($datacaptcha);
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
              <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-cogs"></i></span><?= $this->lang->line('admin_settings'); ?></h4>
            </div>
            <div class="uk-card-body">
              <ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-fade; toggle: > *">
                <li><a href="#"><i class="fas fa-cog"></i> Main Settings</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Website Settings</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Database Settings</a></li>
              </ul>
              <ul class="uk-switcher uk-margin-small">
                <li>
                  <form action="" method="post" accept-charset="utf-8">
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">Base Site URL</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: cog"></span>
                          <input class="uk-input" type="text" name="configURL" value="<?= $this->admin_model->getConfigBaseUrl($fileConfig); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">Default Language</label>
                      <div class="uk-form-controls">
                        <select class="uk-select" name="configLang">
                          <option value="english" <?php if($this->admin_model->getConfigLanguage($fileConfig) == 'english') echo 'selected'; ?>>English</option>
                          <option value="spanish" <?php if($this->admin_model->getConfigLanguage($fileConfig) == 'spanish') echo 'selected'; ?>>Spanish</option>
                        </select>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">Default Character Set</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: cog"></span>
                          <input class="uk-input" type="text" name="configCharSet" value="<?= $this->admin_model->getConfigCharSet($fileConfig); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">Session Expiration</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: cog"></span>
                          <input class="uk-input" type="text" name="configSessExpiration" value="<?= $this->admin_model->getConfigSessExpiration($fileConfig); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <div class="uk-form-controls">
                        <button class="uk-button uk-button-primary uk-width-1-1" name="submitConfig" type="submit"><i class="fas fa-sync-alt"></i> Update</button>
                      </div>
                    </div>
                  </form>
                </li>
                <li>
                  <form action="" method="post" accept-charset="utf-8">
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">Project Name</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: cog"></span>
                          <input class="uk-input" type="text" name="blizzcmsProjectName" value="<?= $this->admin_model->getFixCoreProjectName($fileFixCore); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">Timezone</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                            <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: cog"></span>
                          <input class="uk-input" type="text" name="blizzcmsTimeZone" value="<?= $this->admin_model->getFixCoreTimeZone($fileFixCore); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">Discord ID</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: cog"></span>
                          <input class="uk-input" type="text" name="blizzcmsDiscordInv" value="<?= $this->admin_model->getFixCoreDiscordInv($fileFixCore); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">Realmlist</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: cog"></span>
                          <input class="uk-input" type="text" name="blizzcmsRealmlist" value="<?= $this->admin_model->getFixCoreRealmlist($fileFixCore); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">Forum STAFF Color</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: cog"></span>
                          <input class="uk-input" type="text" name="blizzcmsStaffColor" value="<?= $this->admin_model->getFixCoreStaffColor($fileFixCore); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">Theme Name</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: cog"></span>
                          <input class="uk-input" type="text" name="blizzcmsTheme" value="<?= $this->admin_model->getFixCoreThemeName($fileFixCore); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <button class="uk-button uk-button-primary uk-width-1-1" name="submitFixCore" type="submit"><i class="fas fa-sync-alt"></i> Update</button>
                    </div>
                  </form>
                </li>
                <li>
                  <form action="" method="post" accept-charset="utf-8">
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase"><strong>Website</strong> Database Hostname</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: database"></span>
                          <input class="uk-input" type="text" name="databaseCmsHost" value="<?= $this->admin_model->getDatabaseCmsHost($fileDatabase); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase"><strong>Website</strong> Database Username</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: database"></span>
                          <input class="uk-input" type="text" name="databaseCmsUser" value="<?= $this->admin_model->getDatabaseCmsUser($fileDatabase); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase"><strong>Website</strong> Database Password</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: database"></span>
                          <input class="uk-input" type="text" name="databaseCmsPassword" value="<?= $this->admin_model->getDatabaseCmsPassword($fileDatabase); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase"><strong>Website</strong> Database Name</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: database"></span>
                          <input class="uk-input" type="text" name="databaseCmsName" value="<?= $this->admin_model->getDatabaseCmsName($fileDatabase); ?>" required>
                        </div>
                      </div>
                    </div>
                    <hr class="uk-divider-icon">
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase"><strong>Auth</strong> Database Hostname</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: database"></span>
                          <input class="uk-input" type="text" name="databaseAuthHost" value="<?= $this->admin_model->getDatabaseAuthHost($fileDatabase); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase"><strong>Auth</strong> Database Username</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: database"></span>
                          <input class="uk-input" type="text" name="databaseAuthUser" value="<?= $this->admin_model->getDatabaseAuthUser($fileDatabase); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase"><strong>Auth</strong> Database Password</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: database"></span>
                          <input class="uk-input" type="text" name="databaseAuthPassword" value="<?= $this->admin_model->getDatabaseAuthPassword($fileDatabase); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase"><strong>Auth</strong> Database Name</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: database"></span>
                          <input class="uk-input" type="text" name="databaseAuthName" value="<?= $this->admin_model->getDatabaseAuthName($fileDatabase); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <button class="uk-button uk-button-primary uk-width-1-1" name="submitDatabase" type="submit"><i class="fas fa-sync-alt"></i> Update</button>
                    </div>
                  </form>
                </li>
              </ul>
            </div>
          </div>
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-cogs"></i></span>Module Settings</h4>
            </div>
            <div class="uk-card-body">
              <ul class="uk-subnav uk-subnav-pill" uk-switcher="animation: uk-animation-fade; toggle: > *">
                <li><a href="#"><i class="fas fa-cog"></i> Recaptcha Settings</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Bugtracker Settings</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Donate Settings</a></li>
                <li><a href="#"><i class="fas fa-cog"></i> Store Settings</a></li>
              </ul>
              <ul class="uk-switcher uk-margin-small">
                <li>
                  <form action="" method="post" accept-charset="utf-8">
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">Recaptcha Site Key</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: cog"></span>
                          <input class="uk-input" type="text" name="recaptchaKey" value="<?= $this->admin_model->getRecaptchaKey($fileCaptcha); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <button class="uk-button uk-button-primary uk-width-1-1" name="submitCaptcha" type="submit"><i class="fas fa-sync-alt"></i> Update</button>
                    </div>
                  </form>
                </li>
                <li>
                  <form action="" method="post" accept-charset="utf-8">
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">Description Text</label>
                      <div class="uk-form-controls">
                        <div class="uk-width-1-1">
                          <textarea class="uk-textarea tinyeditor" name="bugtrackerText" rows="10" cols="80"><?= $this->admin_model->getBugtrackerText($fileBugtracker); ?></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <button class="uk-button uk-button-primary uk-width-1-1" name="submitBugtracker" type="submit"><i class="fas fa-sync-alt"></i> Update</button>
                    </div>
                  </form>
                </li>
                <li>
                  <form action="" method="post" accept-charset="utf-8">
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">PayPal Currency</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: cog"></span>
                          <input class="uk-input" type="text" name="paypalCurrency" value="<?= $this->admin_model->getPaypalCurrency($fileDonate); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">PayPal Mode</label>
                      <div class="uk-form-controls">
                        <select class="uk-select" name="paypalMode">
                          <option value="sandbox" <?php if($this->admin_model->getPaypalMode($fileDonate) == 'sandbox') echo 'selected'; ?>>Sandbox</option>
                          <option value="live" <?php if($this->admin_model->getPaypalMode($fileDonate) == 'live') echo 'selected'; ?>>Live</option>
                        </select>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">PayPal Client ID</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: cog"></span>
                          <input class="uk-input" type="text" name="paypalclientId" value="<?= $this->admin_model->getPaypalClientID($fileDonate); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">PayPal Secret Password</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: cog"></span>
                          <input class="uk-input" type="text" name="paypalPassword" value="<?= $this->admin_model->getPaypalPassword($fileDonate); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <button class="uk-button uk-button-primary uk-width-1-1" name="submitDonate" type="submit"><i class="fas fa-sync-alt"></i> Update</button>
                    </div>
                  </form>
                </li>
                <li>
                  <form action="" method="post" accept-charset="utf-8">
                    <div class="uk-margin-small">
                      <label class="uk-form-label uk-text-uppercase">Store Type</label>
                      <div class="uk-form-controls">
                        <select class="uk-select" name="storeType">
                          <option value="1" <?php if($this->admin_model->getStoreType($fileStore) == '1') echo 'selected'; ?>>Store with Images</option>
                          <option value="2" <?php if($this->admin_model->getStoreType($fileStore) == '2') echo 'selected'; ?>>Store with Icons</option>
                        </select>
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <button class="uk-button uk-button-primary uk-width-1-1" name="submitStore" type="submit"><i class="fas fa-sync-alt"></i> Update</button>
                    </div>
                  </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>
