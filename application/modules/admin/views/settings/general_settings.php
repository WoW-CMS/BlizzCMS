<?php
  $fileBugtracker = FCPATH.'application/modules/bugtracker/config/bugtracker.php';
  $fileDonate = FCPATH.'application/modules/donate/config/donate.php';

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
                <li><a href="<?= base_url('admin/settings/optional'); ?>"><i class="fas fa-layer-group"></i> Optional Settings</a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@s">
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-body">
                <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-text-center uk-margin-small"><span>General Settings</span></h5>
                <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-small">BlizzCMS</h5>
                <?= form_open('', 'id="updategeneralForm" onsubmit="UpdateGeneralForm(event)"'); ?>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">Project Name</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-mouse-pointer"></i></span>
                          <input class="uk-input" type="text" id="project_name" value="<?= $this->config->item('website_name'); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">Realmlist</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-mouse-pointer"></i></span>
                          <input class="uk-input" type="text" id="realmlist" value="<?= $this->config->item('realmlist'); ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">Discord ID</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fab fa-discord"></i></span>
                          <input class="uk-input" type="text" id="discord_invitation" value="<?= $this->config->item('discord_invitation'); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">Timezone</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="far fa-clock"></i></span>
                          <input class="uk-input" type="text" id="time_zone" value="<?= $this->config->item('timezone'); ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">Forum STAFF Color</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-palette"></i></span>
                          <input class="uk-input" type="text" id="staff_color" value="<?= $this->config->item('staff_forum_color'); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">Theme Name</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-columns"></i></span>
                          <input class="uk-input" type="text" id="theme_name" value="<?= $this->config->item('theme_name'); ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_settings"><i class="fas fa-sync"></i> Update</button>
                </div>
                <?= form_close(); ?>
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

    <script>
      function UpdateGeneralForm(e) {
        e.preventDefault();

        var project = $.trim($('#project_name').val());
        var timezone = $.trim($('#time_zone').val());
        var discord = $.trim($('#discord_invitation').val());
        var realmlist = $.trim($('#realmlist').val());
        var staffcolor = $.trim($('#staff_color').val());
        var theme = $.trim($('#theme_name').val());
        if(project == ''){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: '<?= $this->lang->line('notification_title_empty'); ?>',
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
          url:"<?= base_url($lang.'/admin/settings/update'); ?>",
          method:"POST",
          data:{project, timezone, discord, realmlist, staffcolor, theme},
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
                  message: '<?= $this->lang->line('notification_report_created'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#updategeneralForm')[0].reset();
            window.location.replace("<?= base_url('admin/settings'); ?>");
          }
        });
      }
    </script>
