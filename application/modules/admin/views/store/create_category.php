    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-plus-circle"></i> <?= $this->lang->line('placeholder_create_category'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/store'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <?= form_open('', 'id="addcategoryForm" onsubmit="AddCategoryForm(event)"'); ?>
              <div class="uk-margin-small">
                <div class="uk-grid-small" uk-grid>
                  <div class="uk-inline uk-width-1-3@s">
                    <label class="uk-form-label"><?= $this->lang->line('placeholder_name'); ?></label>
                    <div class="uk-form-controls">
                      <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                        <input class="uk-input" type="text" id="store_category_name" placeholder="<?= $this->lang->line('placeholder_name'); ?>" required>
                      </div>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-3@s">
                    <label class="uk-form-label"><?= $this->lang->line('table_header_realm'); ?></label>
                    <div class="uk-form-controls">
                      <select class="uk-select" id="store_category_realm">
                        <option value="0"><?= $this->lang->line('notification_select_realm'); ?></option>
                        <?php foreach ($this->wowrealm->getRealms()->result() as $MultiRealm): ?>
                        <option value="<?= $MultiRealm->realmID ?>"><?= $this->wowrealm->getRealmName($MultiRealm->realmID); ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-3@s">
                    <label class="uk-form-label"><?= $this->lang->line('placeholder_type'); ?></label>
                    <div class="uk-form-controls">
                      <select class="uk-select" id="store_category_main">
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
                      <select class="uk-select" id="store_category_child">
                        <option value="0"><?= $this->lang->line('notification_select_category'); ?></option>
                        <?php foreach($this->admin_model->getDropDownsSpecify()->result() as $child): ?>
                          <option value="<?= $child->id ?>"><?= $child->name ?></option>
                        <?php endforeach; ?>
                      </select>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_route'); ?></label>
                  <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <input class="uk-input" type="text" id="store_category_route" placeholder="<?= $this->lang->line('placeholder_route'); ?>" required>
                  </div>
                </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_group"><i class="fas fa-check-circle"></i> <?= $this->lang->line('button_create'); ?></button>
              </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </section>

    <script>
      function AddCategoryForm(e) {
        e.preventDefault();

        var name = $.trim($('#store_category_name').val());
        var realm = $.trim($('#store_category_realm').val());
        var route = $.trim($('#store_category_route').val());
        var main = $.trim($('#store_category_main').val());
        var father = $.trim($('#store_category_child').val());

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
        if(realm == 0){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: '<?= $this->lang->line('notification_select_realm'); ?>',
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
          url:"<?= base_url($lang.'/admin/store/category/add'); ?>",
          method:"POST",
          data:{name, route, realm, main, father},
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

            if (response == 'Rouerr') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('notification_route_inuse'); ?>',
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
                  message: '<?= $this->lang->line('notification_category_created'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#addcategoryForm')[0].reset();
          }
        });
      }
    </script>
