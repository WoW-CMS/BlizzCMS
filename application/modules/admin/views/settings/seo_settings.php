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
                <li><a href="<?= base_url('admin/settings/module'); ?>"><i class="fas fa-puzzle-piece"></i> <?= $this->lang->line('section_module_settings'); ?></a></li>
                <li><a href="<?= base_url('admin/settings/optional'); ?>"><i class="fas fa-layer-group"></i> <?= $this->lang->line('section_optional_settings'); ?></a></li>
                <li class="uk-active"><a href="<?= base_url('admin/settings/seo'); ?>"><i class="fas fa-search"></i> <?= $this->lang->line('section_seo_settings'); ?></a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@s">
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-body">
                <h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-text-center uk-margin-small"><span><?= $this->lang->line('section_seo_settings'); ?></span></h5>
                <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-small">Meta Tags</h5>
                <?= form_open('', 'id="updateseoForm" onsubmit="UpdateSeoForm(event)"'); ?>
                <div class="uk-margin-small">
                  <label class="uk-form-label">Meta Tags Status</label>
                  <div class="uk-form-controls">
                    <select class="uk-select" id="seo_metastatus">
                      <option value="TRUE" <?php if($this->config->item('seo_meta_enable') == TRUE) echo 'selected'; ?>><?= $this->lang->line('option_enabled'); ?></option>
                      <option value="FALSE" <?php if($this->config->item('seo_meta_enable') == FALSE) echo 'selected'; ?>><?= $this->lang->line('option_disabled'); ?></option>
                    </select>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">Website Descripion</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-pen-square"></i></span>
                          <input class="uk-input" type="text" id="seo_description" value="<?= $this->config->item('seo_meta_desc'); ?>">
                        </div>
                      </div>
                    </div>
                    <div class="uk-width-1-2@s">
                      <label class="uk-form-label">Website Keywords</label>
                      <div class="uk-form-controls">
                        <div class="uk-inline uk-width-1-1">
                          <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-pen-square"></i></span>
                          <input class="uk-input" type="text" id="seo_keywords" value="<?= $this->config->item('seo_meta_keywords'); ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-small">Twitter Tags</h5>
                <div class="uk-margin-small">
                  <label class="uk-form-label">Twitter Tags Status</label>
                  <div class="uk-form-controls">
                    <select class="uk-select" id="seo_twitterstatus">
                      <option value="TRUE" <?php if($this->config->item('seo_twitter_enable') == TRUE) echo 'selected'; ?>><?= $this->lang->line('option_enabled'); ?></option>
                      <option value="FALSE" <?php if($this->config->item('seo_twitter_enable') == FALSE) echo 'selected'; ?>><?= $this->lang->line('option_disabled'); ?></option>
                    </select>
                  </div>
                </div>
                <h5 class="uk-h5 uk-heading-bullet uk-text-uppercase uk-text-bold uk-margin-small">Open Graph Tags</h5>
                <div class="uk-margin-small">
                  <label class="uk-form-label">Open Graph Tags Status</label>
                  <div class="uk-form-controls">
                    <select class="uk-select" id="seo_graphstatus">
                      <option value="TRUE" <?php if($this->config->item('seo_og_enable') == TRUE) echo 'selected'; ?>><?= $this->lang->line('option_enabled'); ?></option>
                      <option value="FALSE" <?php if($this->config->item('seo_og_enable') == FALSE) echo 'selected'; ?>><?= $this->lang->line('option_disabled'); ?></option>
                    </select>
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
      function UpdateSeoForm(e) {
        e.preventDefault();

        var meta = $.trim($('#seo_metastatus').val());
        var description = $.trim($('#seo_description').val());
        var keywords = $.trim($('#seo_keywords').val());
        var twitter = $.trim($('#seo_twitterstatus').val());
        var graph = $.trim($('#seo_graphstatus').val());
        if(meta == ''){
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
          url:"<?= base_url($lang.'/admin/settings/seo/update'); ?>",
          method:"POST",
          data:{meta, description, keywords, twitter, graph},
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
            $('#updateseoForm')[0].reset();
            window.location.replace("<?= base_url('admin/settings/seo'); ?>");
          }
        });
      }
    </script>
