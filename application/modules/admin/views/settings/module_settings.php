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
                <li><a href="<?= base_url('admin/settings'); ?>"><i class="fas fa-cog"></i> General Settings</a></li>
                <li class="uk-active"><a href="<?= base_url('admin/settings/module'); ?>"><i class="fas fa-puzzle-piece"></i> Module Settings</a></li>
                <li><a href="<?= base_url('admin/settings/optional'); ?>"><i class="fas fa-layer-group"></i> Optional Settings</a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@s">
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-body">
                <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-text-center uk-margin-small"><span>Modules Settings</span></h5>
                <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-small">Donate</h5>
                <?= form_open('', 'id="updategeneralForm" onsubmit="UpdateGeneralForm(event)"'); ?>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">PayPal Currency</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-file-invoice-dollar"></i></span>
                          <input class="uk-input" type="text" id="paypal_currency" value="<?= $this->config->item('paypal_currency'); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">PayPal Mode</label>
                      <div class="uk-form-controls">
                        <select class="uk-select" id="paypal_mode">
                          <option value="sandbox" <?php if($this->config->item('paypal_mode') == 'sandbox') echo 'selected'; ?>>Sandbox</option>
                          <option value="live" <?php if($this->config->item('paypal_mode') == 'live') echo 'selected'; ?>>Live</option>
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
                      <input class="uk-input" type="text" id="paypal_client" value="<?= $this->config->item('paypal_userid'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label">PayPal Secret Password</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-key"></i></span>
                      <input class="uk-input" type="text" id="paypal_password" value="<?= $this->config->item('paypal_secretpass'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_update"><i class="fas fa-sync"></i> Update</button>
                </div>
                <?= form_close(); ?>
                <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom">Bugtracker</h5>
                <div class="uk-margin-small">
                  <label class="uk-form-label">Default Description</label>
                  <div class="uk-form-controls">
                    <div class="uk-width-1-1">
                      <textarea class="uk-textarea tinyeditor" rows="12" id="bugtracker_description"><?= $this->config->item('textarea'); ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_update"><i class="fas fa-sync"></i> Update</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?= $tiny ?>
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
