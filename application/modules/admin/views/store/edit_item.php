    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-edit"></i> <?= $this->lang->line('placeholder_edit_item'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/store/items'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <?= form_open('', 'id="updateitemForm" onsubmit="UpdateItemForm(event)"'); ?>
              <div class="uk-margin-small">
                <label class="uk-form-label"><?= $this->lang->line('placeholder_name'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                    <input class="uk-input" type="text" id="item_name" value="<?= $this->admin_model->getItemSpecifyName($idlink); ?>" placeholder="<?= $this->lang->line('placeholder_name'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label"><?= $this->lang->line('placeholder_description'); ?></label>
                <div class="uk-form-controls">
                  <textarea class="uk-textarea" id="item_description" rows="3"><?= $this->admin_model->getItemSpecifyDescription($idlink); ?></textarea>
                </div>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid-small" uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= $this->lang->line('placeholder_category'); ?></label>
                    <div class="uk-form-controls">
                      <select class="uk-select" id="item_category">
                        <option value="0"><?= $this->lang->line('notification_select_category'); ?></option>
                        <?php foreach ($this->admin_model->getCategoryStore()->result() as $category): ?>
                        <option value="<?= $category->id ?>" <?php if($this->admin_model->getItemSpecifyCategory($idlink) == $category->id) echo 'selected'; ?>><?= $category->name ?> - <?= $this->wowrealm->getRealmName($category->realmid); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= $this->lang->line('placeholder_type'); ?></label>
                    <div class="uk-form-controls">
                      <select class="uk-select" id="item_type">
                        <option value="0"><?= $this->lang->line('notification_select_type'); ?></option>
                        <option value="1" <?php if($this->admin_model->getItemSpecifyType($idlink) == 1) echo 'selected'; ?>><?= $this->lang->line('placeholder_item'); ?></option>
                        <option value="2" <?php if($this->admin_model->getItemSpecifyType($idlink) == 2) echo 'selected'; ?>><?= $this->lang->line('table_header_money'); ?></option>
                        <option value="3" <?php if($this->admin_model->getItemSpecifyType($idlink) == 3) echo 'selected'; ?>><?= $this->lang->line('table_header_level'); ?></option>
                        <option value="4" <?php if($this->admin_model->getItemSpecifyType($idlink) == 4) echo 'selected'; ?>><?= $this->lang->line('option_rename'); ?></option>
                        <option value="5" <?php if($this->admin_model->getItemSpecifyType($idlink) == 5) echo 'selected'; ?>><?= $this->lang->line('option_customize'); ?></option>
                        <option value="6" <?php if($this->admin_model->getItemSpecifyType($idlink) == 6) echo 'selected'; ?>><?= $this->lang->line('option_change_faction'); ?></option>
                        <option value="7" <?php if($this->admin_model->getItemSpecifyType($idlink) == 7) echo 'selected'; ?>><?= $this->lang->line('option_change_race'); ?></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid-small" uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= $this->lang->line('placeholder_icon_name'); ?></label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" id="item_icon" value="<?= $this->admin_model->getItemSpecifyIcon($idlink); ?>" placeholder="inv_belt_45">
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= $this->lang->line('table_header_price'); ?> <?= $this->lang->line('placeholder_type'); ?></label>
                    <div class="uk-form-controls">
                      <select class="uk-select" id="item_price_type">
                        <option value="0"><?= $this->lang->line('table_header_price'); ?> <?= $this->lang->line('notification_select_type'); ?></option>
                        <option value="1" <?php if($this->admin_model->getItemSpecifyPriceType($idlink) == 1) echo 'selected'; ?>><?= $this->lang->line('option_dp'); ?></option>
                        <option value="2" <?php if($this->admin_model->getItemSpecifyPriceType($idlink) == 2) echo 'selected'; ?>><?= $this->lang->line('option_vp'); ?></option>
                        <option value="3" <?php if($this->admin_model->getItemSpecifyPriceType($idlink) == 3) echo 'selected'; ?>><?= $this->lang->line('option_dp_vp'); ?></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid-small" uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= $this->lang->line('option_dp'); ?> <?= $this->lang->line('table_header_price'); ?></label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="number" id="item_dp_price" value="<?= $this->admin_model->getItemSpecifyDpPrice($idlink); ?>" placeholder="0" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= $this->lang->line('option_vp'); ?> <?= $this->lang->line('table_header_price'); ?></label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="number" id="item_vp_price" value="<?= $this->admin_model->getItemSpecifyVpPrice($idlink); ?>" placeholder="0" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label"><?= $this->lang->line('placeholder_command'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <input class="uk-input" type="text" id="item_command" value="<?= $this->admin_model->getItemSpecifyCommand($idlink); ?>" required>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <button class="uk-button uk-button-primary uk-width-1-1" id="button_upitem" type="submit"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_save'); ?></button>
              </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </section>

    <script>
      function UpdateItemForm(e) {
        e.preventDefault();

        var id = "<?= $idlink ?>";
        var name = $.trim($('#item_name').val());
        var description = $.trim($('#item_description').val());
        var category = $.trim($('#item_category').val());
        var type = $.trim($('#item_type').val());
        var icon = $.trim($('#item_icon').val());
        var price_type = $.trim($('#item_price_type').val());
        var dp_price = $.trim($('#item_dp_price').val());
        var vp_price = $.trim($('#item_vp_price').val());
        var command = $.trim($('#item_command').val());
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
        if(category == 0){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: '<?= $this->lang->line('notification_select_category'); ?>',
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
        if(type == 0 || price_type == 0){
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
          url:"<?= base_url($lang.'/admin/store/item/update'); ?>",
          method:"POST",
          data:{id, name, description, category, type, price_type, dp_price, vp_price, icon, command},
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
                  message: '<?= $this->lang->line('notification_item_edited'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#updateitemForm')[0].reset();
            window.location.replace("<?= base_url('admin/store/item/edit/'.$idlink); ?>");
          }
        });
      }
    </script>
