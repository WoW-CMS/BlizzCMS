    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-edit"></i> Edit Menu</h3>
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
                  <label class="uk-form-label">Name</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-pen"></i></span>
                      <input class="uk-input" type="text" id="menu_name" value="<?= $this->admin_model->getMenuSpecifyName($idlink); ?>" placeholder="Menu Name" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label">URL</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-link"></i></span>
                      <input class="uk-input" type="text" id="menu_url" value="<?= $this->admin_model->getMenuSpecifyUrl($idlink); ?>" placeholder="Menu URL" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label">Icon</label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fab fa-font-awesome-flag"></i></span>
                      <input class="uk-input" type="text" id="menu_icon" value="<?= $this->admin_model->getMenuSpecifyIcon($idlink); ?>" placeholder="Icon Name" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label">Menu Type</label>
                  <div class="uk-form-controls">
                    <select class="uk-select" id="menu_main">
                      <option value="0" <?php if($this->admin_model->getMenuSpecifyMain($idlink) == 0) echo 'selected'; ?>><?= $this->lang->line('notification_select_type'); ?></option>
                      <option value="1" <?php if($this->admin_model->getMenuSpecifyMain($idlink) == 1) echo 'selected'; ?>>Normal</option>
                      <option value="2" <?php if($this->admin_model->getMenuSpecifyMain($idlink) == 2) echo 'selected'; ?>>Dropdown</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label">Child Menu <span class="uk-text-bold">(#ID)</span></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-bars"></i></span>
                      <input class="uk-input" type="number" id="menu_child" value="<?= $this->admin_model->getMenuSpecifyChild($idlink); ?>" placeholder="Menu ID" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label">URL Type</label>
                  <div class="uk-form-controls">
                    <select class="uk-select" id="menu_type">
                      <option value="0"><?= $this->lang->line('notification_select_type'); ?></option>
                      <?php foreach ($this->admin_model->getMenuTypeList()->result() as $type): ?>
                      <?php if ($type->id == $this->admin_model->getMenuSpecifyType($idlink)): ?>
                      <option value="<?= $type->id ?>" selected><?= $type->title ?></option>
                      <?php else: ?>
                      <option value="<?= $type->id ?>"><?= $type->title ?></option>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_upmenu"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_save'); ?></button>
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
        if(type == 0 || main == 0){
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
          url:"<?= base_url($lang.'/admin/menu/update'); ?>",
          method:"POST",
          data:{id, name, url, icon, main, child, type},
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
            $('#updatemenuForm')[0].reset();
            window.location.replace("<?= base_url('admin/menu/edit/'.$idlink); ?>");
          }
        });
      }
    </script>
