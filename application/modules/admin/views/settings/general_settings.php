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
                <li class="uk-active"><a href="<?= base_url('admin/settings'); ?>"><i class="fas fa-cog"></i> <?= $this->lang->line('section_general_settings'); ?></a></li>
                <li><a href="<?= base_url('admin/settings/module'); ?>"><i class="fas fa-puzzle-piece"></i> <?= $this->lang->line('section_module_settings'); ?></a></li>
                <li><a href="<?= base_url('admin/settings/optional'); ?>"><i class="fas fa-layer-group"></i> <?= $this->lang->line('section_optional_settings'); ?></a></li>
                <li><a href="<?= base_url('admin/settings/seo'); ?>"><i class="fas fa-search"></i> <?= $this->lang->line('section_seo_settings'); ?></a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@s">
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-body">
                <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-text-center uk-margin-small"><span><?= $this->lang->line('section_general_settings'); ?></span></h5>
                <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-small">BlizzCMS</h5>
                <?= form_open('', 'id="updategeneralForm" onsubmit="UpdateGeneralForm(event)"'); ?>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label"><?= $this->lang->line('conf_website_name'); ?></label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-mouse-pointer"></i></span>
                          <input class="uk-input" type="text" id="project_name" value="<?= $this->config->item('website_name'); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label"><?= $this->lang->line('conf_realmlist'); ?></label>
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
                      <label class="uk-form-label"><?= $this->lang->line('conf_theme_name'); ?></label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-columns"></i></span>
                          <input class="uk-input" type="text" id="theme_name" value="<?= $this->config->item('theme_name'); ?>" required>
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label"><?= $this->lang->line('conf_timezone'); ?></label>
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
                      <label class="uk-form-label"><?= $this->lang->line('conf_maintenance_mode'); ?></label>
                      <div class="uk-form-controls">
                        <select class="uk-select" id="maintenance_mode">
                          <option value="0" <?php if($this->config->item('maintenance_mode') == '0') echo 'selected'; ?>><?= $this->lang->line('option_disabled'); ?></option>
                          <option value="1" <?php if($this->config->item('maintenance_mode') == '1') echo 'selected'; ?>><?= $this->lang->line('option_enabled'); ?></option>
                        </select>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label"><?= $this->lang->line('conf_discord_invid'); ?></label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fab fa-discord"></i></span>
                          <input class="uk-input" type="text" id="discord_invitation" pattern=".{,7}" value="<?= $this->config->item('discord_invitation'); ?>" required>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label"><?= $this->lang->line('conf_social_facebook'); ?></label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fab fa-facebook-f"></i></span>
                          <input class="uk-input" type="url" id="social_facebook" value="<?= $this->config->item('social_facebook'); ?>">
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label"><?= $this->lang->line('conf_social_twitter'); ?></label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fab fa-twitter"></i></span>
                          <input class="uk-input" type="url" id="social_twitter" value="<?= $this->config->item('social_twitter'); ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label"><?= $this->lang->line('conf_social_youtube'); ?></label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fab fa-youtube"></i></span>
                          <input class="uk-input" type="url" id="social_youtube" value="<?= $this->config->item('social_youtube'); ?>">
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s"></div>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_settings"><i class="fas fa-sync"></i> <?= $this->lang->line('button_update'); ?></button>
                </div>
                <?= form_close(); ?>
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
        var maintenance = $.trim($('#maintenance_mode').val());
        var discord = $.trim($('#discord_invitation').val());
        var realmlist = $.trim($('#realmlist').val());
        var theme = $.trim($('#theme_name').val());
        var facebook = $.trim($('#social_facebook').val());
        var twitter = $.trim($('#social_twitter').val());
        var youtube = $.trim($('#social_youtube').val());
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
          data:{project, timezone, maintenance, discord, realmlist, theme, facebook, twitter, youtube},
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
            $('#updategeneralForm')[0].reset();
            window.location.replace("<?= base_url('admin/settings'); ?>");
          }
        });
      }
    </script>
