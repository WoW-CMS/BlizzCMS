<?php
require_once 'config/config.php';
require_once 'class/Core.php';

$isCompleted = FALSE;
$core = new Core;
$check = $core->init($config);
$target = '../install/';

if ($_POST):
    $core->setInput($_POST);

    if ($core->checkDB()):
        $core->createTables();

        if ($core->reWrite())
            $isCompleted = TRUE;
    endif;
endif;

if (isset($_POST['delete_install'])):
    $core->removeFiles($target);
endif; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Installation | BlizzCMS Plus</title>
    <link rel="stylesheet" href="../includes/core/uikit/css/uikit.min.css"/>
    <script src="../includes/core/uikit/js/uikit.min.js"></script>
    <script src="../includes/core/uikit/js/uikit-icons.min.js"></script>
    <script src="../includes/core/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="../includes/core/css/install.css"/>
    <script src="../includes/core/js/jquery-3.3.1.min.js"></script>
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
        <p class="uk-text-small uk-text-center uk-margin-remove-top uk-margin-bottom">Please fill the form with your corresponding information to proceed with the installation.</p>
        <?php if ($core->getError()): ?>
          <?php echo "<div class='uk-alert-danger' uk-alert><h3 class='uk-text-bold uk-margin-remove'><i class='fas fa-exclamation-circle'></i> Error</h3><ul class='uk-margin-small-top'>"; ?>
          <?php foreach ($core->getError() as $item): ?>
            <?php echo "<li>$item</li>"; ?>
          <?php endforeach; ?>
          <?php echo "</ul></div>"; ?>
        <?php endif; ?>
        <form id="form_install" action="" method="POST" accept-charset="utf-8" autocomplete="off">
          <?php if ($isCompleted): ?>
            <?php echo "<div class='uk-alert-success' uk-alert><h3 class='uk-text-bold uk-margin-remove'><i class='far fa-check-circle'></i> Successful</h3>The installation was successful, Now press the button <span class='uk-text-bold'>Continue installation</span> for delete install folder and continue</div><div class='uk-margin'><button class='uk-button uk-button-primary uk-width-1-1' type='submit' name='delete_install'><i class='fas fa-spinner fa-spin'></i> Continue installation</button></div>"; ?>
          <?php elseif ($check): ?>
            <?php echo "<div class='uk-alert-danger' uk-alert><h3 class='uk-text-bold uk-margin-remove'><i class='fas fa-exclamation-circle'></i> Error</h3><ul class='uk-margin-small-top'>"; ?>
            <?php foreach ($check as $item): ?>
              <?php echo "<li>$item</li>"; ?>
            <?php endforeach; ?>
            <?php echo "</ul></div>"; ?>
          <?php else: ?>
          <h5 class="uk-h5 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-cog fa-spin"></i> General Settings</span></h5>
          <div class="uk-margin-small uk-light">
            <div class="uk-grid uk-grid-small" data-uk-grid>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label">Server Name:</label>
                <div class="uk-form-controls">
                  <input name="ProjectName" class="uk-input" type="text" id="ProjectName" placeholder="MyServer" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label">Expansion:</label>
                <div class="uk-form-controls">
                  <select name="expansion_id" class="uk-select" id="expansion_id" style="background-color: rgba(0,0,0,.15);">
                    <option value="1">Vanilla</option>
                    <option value="2">The Burning Crusade</option>
                    <option value="3">Wrath of the Lich King</option>
                    <option value="4">Cataclysm</option>
                    <option value="5">Mist of Pandaria</option>
                    <option value="6">Warlords of Draenor</option>
                    <option value="7">Legion</option>
                    <option value="8">Battle for Azeroth</option>
                  </select>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label">Realmlist:</label>
                <div class="uk-form-controls">
                  <input name="realmlist" class="uk-input" type="text" id="realmlist" placeholder="logon.domain.com" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label">Facebook URL <span class="uk-text-bold">(Optional)</span></label>
                <div class="uk-form-controls">
                  <input name="social_facebook" class="uk-input" type="url" id="social_facebook" placeholder="https://facebook.com/groupname">
                </div>
              </div>
            </div>
          </div>
          <div class="uk-margin uk-light">
            <div class="uk-grid uk-grid-small" data-uk-grid>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label">License Key:</label>
                <div class="uk-form-controls">
                  <input name="license_plus" class="uk-input" type="text" id="license_plus" placeholder="XXXXX-XXXXX-XXXXX-XXXXX" pattern="^[A-Z0-9]{5,}-?[A-Z0-9]{5,}-?[A-Z0-9]{5,}-?[A-Z0-9]{5,}$" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label">Language:</label>
                <div class="uk-form-controls">
                  <select name="language" class="uk-select" id="language" style="background-color: rgba(0,0,0,.15);">
                    <option value="english">English</option>
                    <option value="spanish">Spanish</option>
                  </select>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label">Discord inv ID:</label>
                <div class="uk-form-controls">
                  <input name="discord_inv" class="uk-input" type="text" id="discord_inv" placeholder="WGGGVgX" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label">Twitter URL <span class="uk-text-bold">(Optional)</span></label>
                <div class="uk-form-controls">
                  <input name="social_facebook" class="uk-input" type="url" id="social_twitter" placeholder="https://twitter.com/name">
                </div>
              </div>
            </div>
          </div>
          <h5 class="uk-h5 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-cog fa-spin"></i> Database Settings</span></h5>
          <div class="uk-margin-small uk-light">
            <div class="uk-grid uk-grid-small" data-uk-grid>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label"><strong>Website</strong> Database Hostname:</label>
                <div class="uk-form-controls">
                  <input name="hostname" class="uk-input" type="text" id="hostname" placeholder="Hostname" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label"><strong>Website</strong> Database Name:</label>
                <div class="uk-form-controls">
                  <input name="database" class="uk-input" type="text" id="database" placeholder="Database" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label"><strong>Website</strong> Database Username:</label>
                <div class="uk-form-controls">
                  <input name="username" class="uk-input" type="text" id="username" placeholder="Username" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label"><strong>Website</strong> Database Password:</label>
                <div class="uk-form-controls">
                  <input name="password" class="uk-input" type="password" id="password" placeholder="Password">
                </div>
              </div>
            </div>
          </div>
          <div class="uk-margin uk-light">
            <div class="uk-grid uk-grid-small" data-uk-grid>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label"><strong>Auth</strong> Database Hostname:</label>
                <div class="uk-form-controls">
                  <input name="hostname2" class="uk-input" type="text" id="hostname2" placeholder="Hostname" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label"><strong>Auth</strong> Database Name:</label>
                <div class="uk-form-controls">
                  <input name="database2" class="uk-input" type="text" id="database2" placeholder="Database" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label"><strong>Auth</strong> Database Username:</label>
                <div class="uk-form-controls">
                  <input name="username2" class="uk-input" type="text" id="username2" placeholder="Username" required>
                </div>
              </div>
              <div class="uk-inline uk-width-1-2@s uk-width-1-4@m">
                <label class="uk-form-label"><strong>Auth</strong> Database Password:</label>
                <div class="uk-form-controls">
                  <input name="password2" class="uk-input" type="password" id="password2" placeholder="Password">
                </div>
              </div>
            </div>
          </div>
          <div class="uk-margin">
            <button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit" form="form_install"><i class="fas fa-mouse-pointer"></i> Start Installation</button>
          </div>
          <?php endif; ?>
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
