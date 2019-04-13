    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-edit"></i> <?= $this->lang->line('card_title_edit_item'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/items'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <?= form_open('', 'id="updateitemForm" onsubmit="UpdateItemForm(event)"'); ?>
              <div class="uk-margin-small">
                <label class="uk-form-label"><?= $this->lang->line('placeholder_store_item_name'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                    <input class="uk-input" type="text" id="item_name" value="<?= $this->admin_model->getItemSpecifyName($idlink); ?>" placeholder="<?= $this->lang->line('placeholder_store_item_name'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid-small" uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?= $this->lang->line('placeholder_category'); ?></label>
                    <div class="uk-form-controls">
                      <select class="uk-select" id="item_category">
                        <?php foreach ($this->admin_model->getCategoryStore()->result() as $groupsStore): ?>
                        <?php if ($groupsStore->id == $this->admin_model->getItemSpecifyGroup($idlink)): ?>
                        <option value="<?= $groupsStore->id ?>" selected><?= $groupsStore->name ?></option>
                        <?php else: ?>
                        <option value="<?= $groupsStore->id ?>"><?= $groupsStore->name ?></option>
                        <?php endif; ?>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?=$this->lang->line('placeholder_type');?></label>
                    <div class="uk-form-controls">
                      <select class="uk-select" id="item_type">
                        <option value="1"><?=$this->lang->line('option_item');?></option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid-small" uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?=$this->lang->line('store_item_price');?> DP</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="number" id="item_dp_price" value="<?= $this->admin_model->getItemSpecifyDpPrice($idlink); ?>" placeholder="0" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?=$this->lang->line('store_item_price');?> VP</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="number" id="item_vp_price" value="<?= $this->admin_model->getItemSpecifyVpPrice($idlink); ?>" placeholder="0" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid-small" uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?=$this->lang->line('placeholder_store_item_id');?></label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" id="item_id" value="<?= $this->admin_model->getItemSpecifyId($idlink); ?>" placeholder="Item Id" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label"><?=$this->lang->line('placeholder_forum_icon_name');?></label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" id="item_icon" value="<?= $this->admin_model->getItemSpecifyIcon($idlink); ?>" placeholder="inv_belt_45">
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label"><?=$this->lang->line('placeholder_store_image_name');?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <input class="uk-input" type="text" id="item_image" value="<?= $this->admin_model->getItemSpecifyImg($idlink); ?>" placeholder="image.jpg">
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
        var category = $.trim($('#item_category').val());
        var type = $.trim($('#item_type').val());
        var dp_price = $.trim($('#item_dp_price').val());
        var vp_price = $.trim($('#item_vp_price').val());
        var itemid = $.trim($('#item_id').val());
        var icon = $.trim($('#item_icon').val());
        var image = $.trim($('#item_image').val());
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
        if(image == ''){
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
          url:"<?= base_url($lang.'/admin/items/update'); ?>",
          method:"POST",
          data:{id, name, category, type, dp_price, vp_price, itemid, icon, image},
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
            $('#updateitemForm')[0].reset();
          }
        });
      }
    </script>
