<?php
require_once 'config/config.php';
require_once 'class/Core.php';

$core = new Core;
$check = $core->init($config);
$target = '../migration/';

if ($_POST):
    $core->setInput($_POST);

    if ($core->reWrite())
      $core->removeFiles($target);
endif; ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Migration | BlizzCMS Plus</title>
    <script src="../assets/core/js/jquery.min.js"></script>
    <script src="../assets/core/fontawesome/js/all.min.js"></script>
    <link rel="stylesheet" href="../assets/core/uikit/css/uikit.min.css"/>
    <link rel="stylesheet" href="../assets/core/css/install.css"/>
    <script src="../assets/core/uikit/js/uikit.min.js"></script>
    <script src="../assets/core/uikit/js/uikit-icons.min.js"></script>
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
                <a target="_blank" href="https://github.com/WoW-CMS" class="uk-icon-button github uk-margin-small-right"><i class="fab fa-github"></i></a>
                <a target="_blank" href="https://discord.wow-cms.com" class="uk-icon-button discord"><i class="fab fa-discord"></i></a>
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
            <h1 class="uk-h1 step-title uk-text-bold uk-text-center uk-margin-remove">Migration</h1>
            <p class="uk-text-small uk-text-center uk-margin-remove-top uk-margin-bottom">Please fill the form with your corresponding information to proceed with the migration.</p>
            <?php if ($core->PHPVersion()): ?>
              <div class="uk-alert-success" uk-alert>
                <p><i class="fas fa-check-circle"></i> PHP Version <span class="uk-text-bold">(<?= PHP_VERSION; ?>)</span> is compatible</p>
              </div>
            <?php else: ?>
              <div class="uk-alert-danger" uk-alert>
                <p><i class="fas fa-times-circle"></i> PHP Version <span class="uk-text-bold">(<?= PHP_VERSION; ?>)</span> is not compatible, please use a version higher than 7.1. 7.3 or 7.4 are recommended.</p>
              </div>
            <?php endif; ?>
            <?php if ($core->getError()): ?>
              <?php echo "<div class='uk-alert-danger' uk-alert><h5 class='uk-text-uppercase uk-text-bold uk-margin-remove'><i class='fas fa-exclamation-circle'></i> Error</h5><ul class='uk-margin-remove'>"; ?>
              <?php foreach ($core->getError() as $item): ?>
                <?php echo "<li>$item</li>"; ?>
              <?php endforeach; ?>
              <?php echo "</ul></div>"; ?>
            <?php endif; ?>
            <?php if (!extension_loaded('curl')): ?>
              <div class="uk-alert-danger" uk-alert>
                <p><i class="fas fa-times-circle"></i> The php curl extension is required</p>
              </div>
            <?php endif; ?>
            <?php if (!extension_loaded('gd')): ?>
              <div class="uk-alert-danger" uk-alert>
                <p><i class="fas fa-times-circle"></i> The php gd extension is required</p>
              </div>
            <?php endif; ?>
            <?php if (!extension_loaded('mbstring')): ?>
              <div class="uk-alert-danger" uk-alert>
                <p><i class="fas fa-times-circle"></i> The php mbstring extension is required</p>
              </div>
            <?php endif; ?>
            <?php if (!extension_loaded('mysqli')): ?>
              <div class="uk-alert-danger" uk-alert>
                <p><i class="fas fa-times-circle"></i> The php mysqli extension is required</p>
              </div>
            <?php endif; ?>
            <?php if (!extension_loaded('openssl')): ?>
              <div class="uk-alert-danger" uk-alert>
                <p><i class="fas fa-times-circle"></i> The php openssl extension is required</p>
              </div>
            <?php endif; ?>
            <?php if (!extension_loaded('soap')): ?>
              <div class="uk-alert-danger" uk-alert>
                <p><i class="fas fa-times-circle"></i> The php soap extension is required</p>
              </div>
            <?php endif; ?>
            <?php if (!extension_loaded('gmp')): ?>
              <div class="uk-alert-danger" uk-alert>
                <p><i class="fas fa-times-circle"></i> The php gmp extension is required</p>
              </div>
            <?php endif; ?>
            <form id="form_install" action="" method="POST" accept-charset="utf-8" autocomplete="off">
              <h5 class="uk-h5 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-cog fa-spin"></i> General Settings</span></h5>
              <div class="uk-margin-small uk-light">
                <label class="uk-form-label">Website Main Language:</label>
                <div class="uk-form-controls">
                  <select name="language" class="uk-select" id="language">
                    <option value="english">English</option>
                    <option value="spanish">Spanish</option>
                    <option value="german">German</option>
                  </select>
                </div>
              </div>
              <h5 class="uk-h5 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-database"></i> Database Settings</span></h5>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Website</strong> Database Hostname:</label>
                    <div class="uk-form-controls">
                      <input name="hostname" class="uk-input" type="text" id="hostname" placeholder="Hostname" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Website</strong> Database Name:</label>
                    <div class="uk-form-controls">
                      <input name="database" class="uk-input" type="text" id="database" placeholder="Database" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Website</strong> Database Username:</label>
                    <div class="uk-form-controls">
                      <input name="username" class="uk-input" type="text" id="username" placeholder="Username" required>
                    </div>
                  </div>
                  <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Website</strong> Database Password:</label>
                    <div class="uk-form-controls">
                      <input name="password" class="uk-input" type="password" id="password" placeholder="Password">
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-top uk-margin-small-bottom uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Auth</strong> Database Hostname:</label>
                    <div class="uk-form-controls">
                      <input name="hostname2" class="uk-input" type="text" id="hostname2" placeholder="Hostname" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Auth</strong> Database Name:</label>
                    <div class="uk-form-controls">
                      <input name="database2" class="uk-input" type="text" id="database2" placeholder="Database" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Auth</strong> Database Username:</label>
                    <div class="uk-form-controls">
                      <input name="username2" class="uk-input" type="text" id="username2" placeholder="Username" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><strong>Auth</strong> Database Password:</label>
                    <div class="uk-form-controls">
                      <input name="password2" class="uk-input" type="password" id="password2" placeholder="Password">
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin">
                <?php if ($core->checkExtension() && $core->PHPVersion()): ?>
                  <button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit" form="form_install"><i class="fas fa-cog fa-spin"></i> Write settings Files</button>
                <?php endif; ?>
              </div>
            </form>
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
