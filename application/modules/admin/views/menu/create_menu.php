    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-plus-circle"></i> <?= $this->lang->line('placeholder_create_menu'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/menu'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <?= form_open('', 'id="addmenuForm" onsubmit="AddMenuForm(event)"'); ?>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_name'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-pen"></i></span>
                      <input class="uk-input" type="text" id="menu_name" placeholder="<?= $this->lang->line('placeholder_name'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_url'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-link"></i></span>
                      <input class="uk-input" type="text" id="menu_url" placeholder="<?= $this->lang->line('placeholder_url'); ?>" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_icon_name'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fab fa-font-awesome-flag"></i></span>
                      <input class="uk-input" type="text" id="menu_icon" placeholder="<?= $this->lang->line('placeholder_icon_name'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_type'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" id="menu_main">
                      <option value="0"><?= $this->lang->line('notification_select_type'); ?></option>
                      <option value="1"><?= $this->lang->line('option_normal'); ?></option>
                      <option value="2"><?= $this->lang->line('option_dropdown'); ?></option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_child_menu'); ?> <span class="uk-text-bold">(<?= $this->lang->line('table_header_id'); ?>)</span></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"></span>
                      <input class="uk-input" type="text" id="menu_child" placeholder="<?= $this->lang->line('table_header_id'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_url_type'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" id="menu_type">
                      <option value="0"><?= $this->lang->line('notification_select_type'); ?></option>
                      <option value="1"><?= $this->lang->line('option_internal_url'); ?></option>
                      <option value="2"><?= $this->lang->line('option_external_url'); ?></option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_menu"><i class="fas fa-check-circle"></i> <?= $this->lang->line('button_create'); ?></button>
            </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </section>

    <script>
      function AddMenuForm(e) {
        e.preventDefault();

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
        if(main == 0 || type == 0){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: '<?= $this->lang->line('notification_select_type'); ?>',
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
          url:"<?= base_url($lang.'/admin/menu/add'); ?>",
          method:"POST",
          data:{name, url, icon, main, child, type},
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
                  message: '<?= $this->lang->line('notification_menu_created'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#addmenuForm')[0].reset();
          }
        });
      }
    </script>
