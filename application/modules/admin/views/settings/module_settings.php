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
                <li><a href="<?= base_url('admin/settings'); ?>"><i class="fas fa-cog"></i> <?= $this->lang->line('section_general_settings'); ?></a></li>
                <li class="uk-active"><a href="<?= base_url('admin/settings/module'); ?>"><i class="fas fa-puzzle-piece"></i> <?= $this->lang->line('section_module_settings'); ?></a></li>
                <li><a href="<?= base_url('admin/settings/optional'); ?>"><i class="fas fa-layer-group"></i> <?= $this->lang->line('section_optional_settings'); ?></a></li>
                <li><a href="<?= base_url('admin/settings/seo'); ?>"><i class="fas fa-search"></i> <?= $this->lang->line('section_seo_settings'); ?></a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@s">
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-body">
                <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-text-center uk-margin-small"><span><?= $this->lang->line('section_module_settings'); ?></span></h5>
                <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-small"><?= $this->lang->line('tab_donate'); ?></h5>
                <?= form_open('', 'id="updatedonateForm" onsubmit="UpdateDonateForm(event)"'); ?>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-3@s">
                      <label class="uk-form-label"><?= $this->lang->line('conf_paypal_currency'); ?></label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-file-invoice-dollar"></i></span>
                          <input class="uk-input" type="text" id="paypal_currency" value="<?= $this->config->item('paypal_currency'); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-3@s">
                      <label class="uk-form-label"><?= $this->lang->line('conf_paypal_currency_symbol'); ?></label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-file-invoice-dollar"></i></span>
                          <input class="uk-input" type="text" id="paypal_currency_symbol" value="<?= $this->config->item('paypal_currency_symbol'); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-3@s">
                      <label class="uk-form-label"><?= $this->lang->line('conf_paypal_mode'); ?></label>
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
                  <label class="uk-form-label"><?= $this->lang->line('conf_paypal_client'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-key"></i></span>
                      <input class="uk-input" type="text" id="paypal_client" value="<?= $this->config->item('paypal_userid'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label"><?= $this->lang->line('conf_paypal_secretpass'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-key"></i></span>
                      <input class="uk-input" type="text" id="paypal_password" value="<?= $this->config->item('paypal_secretpass'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_update"><i class="fas fa-sync"></i> <?= $this->lang->line('button_update'); ?></button>
                </div>
                <?= form_close(); ?>
                <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-top uk-margin-small-bottom"><?= $this->lang->line('tab_bugtracker'); ?></h5>
                <?= form_open('', 'id="updatebugtrackerForm" onsubmit="UpdateBugtrackerForm(event)"'); ?>
                <div class="uk-margin-small">
                  <label class="uk-form-label"><?= $this->lang->line('conf_default_description'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-width-1-1">
                      <textarea class="uk-textarea tinyeditor" rows="12" id="bugtracker_description"><?= $this->config->item('textarea'); ?></textarea>
                    </div>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_update"><i class="fas fa-sync"></i> <?= $this->lang->line('button_update'); ?></button>
                </div>
                <?= form_close(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?= $tiny ?>
    <script>
      function UpdateDonateForm(e) {
        e.preventDefault();

        var currency = $.trim($('#paypal_currency').val());
        var mode = $.trim($('#paypal_mode').val());
        var client = $.trim($('#paypal_client').val());
        var password = $.trim($('#paypal_password').val());
        var symbol = $.trim($('#paypal_currency_symbol').val());
        if(currency == ''){
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
          url:"<?= base_url($lang.'/admin/settings/module/updonate'); ?>",
          method:"POST",
          data:{currency, mode, client, password, symbol},
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
                  message: '<?= $this->lang->line('notification_settings_updated'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            window.location.replace("<?= base_url('admin/settings/'); ?>");
          }
        });
      }

      function UpdateBugtrackerForm(e) {
        e.preventDefault();

        var description = tinymce.get('bugtracker_description').getContent();
        if(description == ''){
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
          url:"<?= base_url($lang.'/admin/settings/module/upbugtracker'); ?>",
          method:"POST",
          data:{description},
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
                  message: '<?= $this->lang->line('notification_settings_updated'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            window.location.replace("<?= base_url('admin/settings/'); ?>");
          }
        });
      }
    </script>
