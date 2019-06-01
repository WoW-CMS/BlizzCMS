    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-cog"></i> BlizzCMS</h3>
          </div>
          <div class="uk-width-auto">
            <a href="" class="uk-icon-button"><i class="fas fa-info"></i></a>
          </div>
        </div>
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-1-4@s">
            <div class="uk-card uk-card-secondary">
              <ul class="uk-nav uk-nav-default" uk-switcher="connect: #manage-updates">
                <li><a href="javascript:void(0)"><i class="fas fa-wrench"></i> <?= $this->lang->line('section_update_cms'); ?></a></li>
                <li><a href="javascript:void(0)"><i class="fas fa-tasks"></i> <?= $this->lang->line('section_check_information'); ?></a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@s">
            <ul id="manage-updates" class="uk-switcher">
              <li>
                <div class="uk-card uk-card-update uk-margin-small">
                  <div class="uk-card-body">
                    <div class="uk-grid uk-grid-small" data-uk-grid>
                      <div class="uk-width-auto@m uk-text-center uk-text-left@m">
                        <h3 class="uk-h3 uk-text-bold uk-margin-remove"><span uk-icon="icon: blizzcms-icon;ratio: 0.8"></span> V<?= $this->update_model->getCurrentVersion(); ?> </h3>
                        <p class="uk-margin-small uk-text-small"><?= $this->lang->line('cms_version_currently'); ?></p>
                      </div>
                      <div class="uk-width-expand uk-text-center uk-text-right@m">
                        <button href="<?= base_url('admin/cms/update') ?>" class="uk-button uk-button-primary uk-button-large" id="button_updatecms" onclick="UpdateCMS(event)"><i class="fas fa-sync fa-spin"></i> <?= $this->lang->line('button_update_version'); ?></button>
                      </div>
                    </div>
                    <p class="uk-text-small uk-margin-small"><span class="uk-text-bold uk-text-warning"><i class="fas fa-exclamation-triangle"></i> <?= $this->lang->line('notification_title_warning'); ?>:</span> <?= $this->lang->line('cms_warning_update'); ?></p>
                  </div>
                </div>
              </li>
              <li>
                <div class="uk-card uk-card-default uk-card-body">
                  <div class="uk-overflow-auto uk-margin">
                    <table class="uk-table uk-table-divider uk-table-small">
                      <thead>
                        <tr>
                          <th class="uk-table-expand"><?= $this->lang->line('table_header_information'); ?></th>
                          <th class="uk-table-expand"><?= $this->lang->line('table_header_value'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="uk-text-bold"><?= $this->lang->line('cms_php_version'); ?></td>
                          <td><?= phpversion() ?></td>
                        </tr>
                        <tr>
                          <td class="uk-text-bold"><?= $this->lang->line('cms_allow_fopen'); ?></td>
                          <td>
                            <?php if(ini_get('allow_url_fopen')): ?>
                            <span class="uk-label uk-label-success"><?= $this->lang->line('option_on'); ?></span>
                            <?php else: ?>
                            <span class="uk-label uk-label-danger"><?= $this->lang->line('option_off'); ?></span>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <td class="uk-text-bold"><?= $this->lang->line('cms_allow_include'); ?></td>
                          <td>
                            <?php if(ini_get('allow_url_include')): ?>
                            <span class="uk-label uk-label-success"><?= $this->lang->line('option_on'); ?></span>
                            <?php else: ?>
                            <span class="uk-label uk-label-danger"><?= $this->lang->line('option_off'); ?></span>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <td class="uk-text-bold"><?= $this->lang->line('cms_loaded_modules'); ?></td>
                          <td><?= $this->update_model->getApacheModules(); ?></td>
                        </tr>
                        <tr>
                          <td class="uk-text-bold"><?= $this->lang->line('cms_loaded_extensions'); ?></td>
                          <td><?= $this->update_model->getPHPExtensions(); ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <script>
      function UpdateCMS(e) {
        e.preventDefault();

        $.ajax({
          url:"<?= base_url($lang.'/admin/cms/update'); ?>",
          method:"POST",
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

            if (response == 'UpdnotFound') {
              $.amaran({
                'theme': 'awesome warning',
                'content': {
                  title: '<?= $this->lang->line('notification_title_warning'); ?>',
                  message: '<?= $this->lang->line('notification_cms_not_updated'); ?>',
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

            if (response == 'UpdErr') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('notification_cms_update_error'); ?>',
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

            if (response) {
              $.amaran({
                'theme': 'awesome ok',
                  'content': {
                  title: '<?= $this->lang->line('notification_title_success'); ?>',
                  message: '<?= $this->lang->line('notification_cms_updated'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            window.location.replace("<?= base_url('dbmigrate'); ?>");
          }
        });
      }
    </script>
