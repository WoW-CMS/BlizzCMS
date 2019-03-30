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
endif;
?>

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
    <section class="uk-section uk-section-xsmall" uk-height-viewport="offset-top: true;offset-bottom: true">
      <div class="uk-container">
        <div class="uk-text-center"><img class="uk-border-circle" src="images/ProjectsCMS.png" width="80" height="80" alt="" uk-scrollspy="cls: uk-animation-fade; delay: 200"></div>
        <h3 class="uk-h3 blizzcms-logo uk-text-center uk-margin-small-top">BlizzCMS<sup class="uk-text-success">+</sup></h3>
        <p class="uk-text-center">We are pleased to present a new improved version of <span class="uk-text-bold">BlizzCMS v1</span>. This version has recent updates in framework, module reworks and more also in the same way this version include a new <span class="uk-text-bold uk-text-success">licensing system</span> and will be strictly in <span class="uk-text-bold uk-text-danger">closed source</span> so if you find any bug this can be reported in the main repository of BlizzCMS.</p>
        <div class="uk-card uk-card-body">
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
            <div class="uk-grid uk-grid-large uk-child-width-1-1 uk-child-width-1-2@s" data-uk-grid>
              <div>
                <h4 class="uk-h4 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-cogs"></i> Website Settings</span></h4>
                <div class="uk-margin uk-light">
                  <label class="uk-form-label uk-text-uppercase">Server Name:</label>
                  <div class="uk-form-controls">
                    <input name="ProjectName" class="uk-input" type="text" id="ProjectName" placeholder="Example: MyServer" required>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase">Expansion:</label>
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
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase">Language:</label>
                      <div class="uk-form-controls">
                        <select name="language" class="uk-select" id="language" style="background-color: rgba(0,0,0,.15);">
                          <option value="english">English</option>
                          <option value="spanish">Spanish</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase">Realmlist:</label>
                      <div class="uk-form-controls">
                        <input name="realmlist" class="uk-input" type="text" id="realmlist" placeholder="Example: logon.domain.com" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase">Discord INV ID:</label>
                      <div class="uk-form-controls">
                        <input name="discord_inv" class="uk-input" type="text" id="discord_inv" placeholder="Example: WGGGVgX" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <label class="uk-form-label uk-text-uppercase">License Key:</label>
                  <div class="uk-form-controls">
                    <input name="license_plus" class="uk-input" type="text" id="license_plus" placeholder="XXXXX-XXXXX-XXXXX-XXXXX" required>
                  </div>
                </div>
              </div>
              <div>
                <h4 class="uk-h4 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-database"></i> Database Settings</span></h4>
                <div class="uk-margin uk-light">
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><strong>Website</strong> Database Hostname:</label>
                      <div class="uk-form-controls">
                        <input name="hostname" class="uk-input" type="text" id="hostname" placeholder="Example: 127.0.0.1" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><strong>Website</strong> Database Name:</label>
                      <div class="uk-form-controls">
                        <input name="database" class="uk-input" type="text" id="database" placeholder="Example: website" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><strong>Website</strong> Database Username:</label>
                      <div class="uk-form-controls">
                        <input name="username" class="uk-input" type="text" id="username" placeholder="Example: root" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><strong>Website</strong> Database Password:</label>
                      <div class="uk-form-controls">
                        <input name="password" class="uk-input" type="password" id="password" placeholder="Example: ascent">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><strong>Auth</strong> Database Hostname:</label>
                      <div class="uk-form-controls">
                        <input name="hostname2" class="uk-input" type="text" id="hostname2" placeholder="Example: 127.0.0.1" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><strong>Auth</strong> Database Name:</label>
                      <div class="uk-form-controls">
                        <input name="database2" class="uk-input" type="text" id="database2" placeholder="Example: auth" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><strong>Auth</strong> Database Username:</label>
                      <div class="uk-form-controls">
                        <input name="username2" class="uk-input" type="text" id="username2" placeholder="Example: root" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><strong>Auth</strong> Database Password:</label>
                      <div class="uk-form-controls">
                        <input name="password2" class="uk-input" type="password" id="password2" placeholder="Example: ascent">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit" form="form_install"><i class="fas fa-spinner fa-pulse"></i> Start Installation</button>
                </div>
              </div>
            </div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-1-2@s">
            <h5 class="uk-h5 uk-margin-remove">Copyright <i class="far fa-copyright"></i> <?= date('Y') ?> <span class="uk-text-bold">WoW-CMS</span>. All rights reserved</h5>
          </div>
          <div class="uk-width-1-2@s">
            <div class="uk-align-center uk-align-right@s uk-light">
              <a target="_blank" href="https://gitlab.com/WoW-CMS" class="uk-icon-button gitlab uk-margin-small-right"><i class="fab fa-gitlab"></i></a>
              <a target="_blank" href="https://discord.gg/7QcXfJE" class="uk-icon-button discord"><i class="fab fa-discord"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </body>
</html>
