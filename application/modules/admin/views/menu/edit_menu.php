    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-edit"></i> <?= lang('placeholder_edit_menu'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/menu'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <?= form_open('', 'id="updatemenuForm" onsubmit="UpdateMenuForm(event)"'); ?>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_name'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-pen"></i></span>
                      <input class="uk-input" type="text" id="menu_name" value="<?= $this->admin_model->getMenuSpecifyName($idlink); ?>" placeholder="<?= lang('placeholder_name'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_url'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-link"></i></span>
                      <input class="uk-input" type="text" id="menu_url" value="<?= $this->admin_model->getMenuSpecifyUrl($idlink); ?>" placeholder="<?= lang('placeholder_url'); ?>" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_icon_name'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fab fa-font-awesome-flag"></i></span>
                      <input class="uk-input" type="text" id="menu_icon" value="<?= $this->admin_model->getMenuSpecifyIcon($idlink); ?>" placeholder="<?= lang('placeholder_icon_name'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_type'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" id="menu_main">
                      <option value="0"><?= lang('notification_select_type'); ?></option>
                      <option value="1" <?php if($this->admin_model->getMenuSpecifyMain($idlink) == '1') echo 'selected'; ?>><?= lang('option_normal'); ?></option>
                      <option value="2" <?php if($this->admin_model->getMenuSpecifyMain($idlink) == '2') echo 'selected'; ?>><?= lang('option_dropdown'); ?></option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_child_menu'); ?> <span class="uk-text-bold">(<?= lang('table_header_id'); ?>)</span></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-bars"></i></span>
                      <input class="uk-input" type="number" id="menu_child" value="<?= $this->admin_model->getMenuSpecifyChild($idlink); ?>" placeholder="<?= lang('table_header_id'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_url_type'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" id="menu_type">
                      <option value="0"><?= lang('notification_select_type'); ?></option>
                      <option value="1" <?php if($this->admin_model->getMenuSpecifyType($idlink) == '1') echo 'selected'; ?>><?= lang('option_internal_url'); ?></option>
                      <option value="2" <?php if($this->admin_model->getMenuSpecifyType($idlink) == '2') echo 'selected'; ?>><?= lang('option_external_url'); ?></option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_upmenu"><i class="fas fa-sync-alt"></i> <?= lang('button_save'); ?></button>
            </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </section>

    <script>
      function UpdateMenuForm(e) {
        e.preventDefault();

        var id = "<?= $idlink ?>";
        var name = $.trim($('#menu_name').val());
        var url = $.trim($('#menu_url').val());
        var icon = $.trim($('#menu_icon').val());
        var main = $.trim($('#menu_main').val());
        var child = $.trim($('#menu_child').val());
        var type = $.trim($('#menu_type').val());
        if(name == ''){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= lang('notification_title_error'); ?>',
              message: '<?= lang('notification_name_empty'); ?>',
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
        if(main == 0 || type == 0){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= lang('notification_title_error'); ?>',
              message: '<?= lang('notification_select_type'); ?>',
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
          url:"<?= base_url($lang.'/admin/menu/update'); ?>",
          method:"POST",
          data:{id, name, url, icon, main, child, type},
          dataType:"text",
          beforeSend: function(){
            $.amaran({
              'theme': 'awesome info',
              'content': {
                title: '<?= lang('notification_title_info'); ?>',
                message: '<?= lang('notification_checking'); ?>',
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
                  title: '<?= lang('notification_title_success'); ?>',
                  message: '<?= lang('notification_menu_edited'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#updatemenuForm')[0].reset();
            window.location.replace("<?= base_url('admin/menu/edit/'.$idlink); ?>");
          }
        });
      }
    </script>
