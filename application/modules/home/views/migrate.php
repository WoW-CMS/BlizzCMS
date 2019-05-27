<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Migration | BlizzCMS Plus</title>
    <script src="<?= base_url('assets/core/js/jquery.min.js'); ?>"></script>
    <script src="<?= base_url('assets/core/fontawesome/js/all.min.js'); ?>" defer></script>
    <link rel="stylesheet" href="<?= base_url('assets/core/uikit/css/uikit.min.css'); ?>"/>
    <link rel="stylesheet" href="<?= base_url('assets/core/css/install.css'); ?>"/>
    <script src="<?= base_url('assets/core/uikit/js/uikit.min.js'); ?>"></script>
    <script src="<?= base_url('assets/core/uikit/js/uikit-icons.min.js'); ?>"></script>
    <link rel="stylesheet" href="<?= base_url('assets/core/amaranjs/css/amaran.min.css'); ?>"/>
    <script src="<?= base_url('assets/core/amaranjs/js/jquery.amaran.min.js'); ?>"></script>
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
            <h1 class="uk-h1 step-title uk-text-bold uk-text-center uk-margin-remove">Migration</h1>
            <p class="uk-text-small uk-text-center uk-margin-remove-top uk-margin-bottom">Complete this last step to finish the migration of <span class="uk-text-bold">BlizzCMS<sup class="uk-text-success">+</sup></span></p>
            <?= form_open('', 'id="migrateForm" onsubmit="MigrateForm(event)"'); ?>
              <h5 class="uk-h5 uk-heading-line uk-margin-small uk-text-uppercase uk-text-bold"><span><i class="fas fa-sync fa-spin"></i> Website Settings</span></h5>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label">Server Name:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" id="website_name" placeholder="MyServer" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label">Realmlist:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" id="website_realmlist" placeholder="logon.domain.com" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small uk-light">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label">Expansion:</label>
                    <div class="uk-form-controls">
                      <select class="uk-select" id="website_expansion">
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
                    <label class="uk-form-label">Discord Invitation ID:</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" id="website_invitation" pattern=".{,7}" placeholder="WGGGVgX" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small uk-light">
                <label class="uk-form-label">License Key:</label>
                <div class="uk-form-controls">
                  <input class="uk-input" type="text" id="website_license" placeholder="XXXXX-XXXXX-XXXXX-XXXXX" pattern="^[A-Z0-9]{5,}-?[A-Z0-9]{5,}-?[A-Z0-9]{5,}-?[A-Z0-9]{5,}$" required>
                </div>
              </div>
              <div class="uk-margin">
                <button class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom" type="submit" id="button_migrate"><i class="fas fa-sync fa-spin"></i> Finish Migration</button>
              </div>
            <?= form_close(); ?>
            <script>
              function MigrateForm(e) {
                e.preventDefault();

                var name = $('#website_name').val();
                var realmlist = $('#website_realmlist').val();
                var expansion = $('#website_expansion').val();
                var invitation = $('#website_invitation').val();
                var license = $('#website_license').val();
                if(name == ''){
                  $.amaran({
                    'theme': 'awesome error',
                    'content': {
                      title: '<?= $this->lang->line('notification_title_error'); ?>',
                      message: '<?= $this->lang->line('notification_name_empty'); ?>',
                      info: '',
                      icon: 'fas fa-times-circle'
                    },
                    'delay': 5000,
                    'position': 'top right',
                    'inEffect': 'slideRight',
                    'outEffect': 'slideRight'
                  });
                  return false;
                }
                $.ajax({
                  url:"<?= base_url($lang.'/confmigrate'); ?>",
                  method:"POST",
                  data:{name, invitation, realmlist, expansion, license},
                  dataType:"text",
                  beforeSend: function(){
                    $.amaran({
                      'theme': 'awesome info',
                      'content': {
                        title: '<?= $this->lang->line('notification_title_info'); ?>',
                        message: '<?= $this->lang->line('notification_checking'); ?>',
                        info: '',
                        icon: 'fas fa-sign-in-alt'
                      },
                      'delay': 5000,
                      'position': 'top right',
                      'inEffect': 'slideRight',
                      'outEffect': 'slideRight'
                    });
                  },
                  success:function(response){
                    if(!response)
                      alert(response);

                    if (response) {
                      $.amaran({
                        'theme': 'awesome ok',
                          'content': {
                          title: '<?= $this->lang->line('notification_title_success'); ?>',
                          message: '<?= $this->lang->line('notification_migration'); ?>',
                          info: '',
                          icon: 'fas fa-check-circle'
                        },
                        'delay': 5000,
                        'position': 'top right',
                        'inEffect': 'slideRight',
                        'outEffect': 'slideRight'
                      });
                    }
                    $('#migrateForm')[0].reset();
                    window.location.replace("<?= base_url('dbmigrate'); ?>");
                  }
                });
              }
            </script>
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
