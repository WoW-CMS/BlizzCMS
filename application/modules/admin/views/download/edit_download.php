<section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-edit"></i> <?= $this->lang->line('placeholder_edit_download'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/download'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <?= form_open('', 'id="updatedownloadForm" onsubmit="UpdateDownloadForm(event)"'); ?>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_name'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-pen"></i></span>
                      <input class="uk-input" type="text" id="down_name" value="<?= $this->admin_model->getDownloadSpecifyfileName($idlink); ?>" placeholder="<?= $this->lang->line('placeholder_name'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_url'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-link"></i></span>
                      <input class="uk-input" type="text" id="down_url" value="<?= $this->admin_model->getDownloadSpecifyUrl($idlink); ?>" placeholder="<?= $this->lang->line('placeholder_url'); ?>" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('option_image'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fab fa-font-awesome-flag"></i></span>
                      <input class="uk-input" type="text" id="down_image" value="<?= $this->admin_model->getDownloadSpecifyImage($idlink); ?>" placeholder="<?= $this->lang->line('option_image'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_category'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" id="down_category">
                      <option value="0"><?= $this->lang->line('placeholder_select_category'); ?></option>
                      <option value="1" <?php if($this->admin_model->getDownloadSpecifyCategory($idlink) == '1') echo 'selected'; ?>>Client</option>
                      <option value="2" <?php if($this->admin_model->getDownloadSpecifyCategory($idlink) == '2') echo 'selected'; ?>>Addon</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_size'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-bars"></i></span>
                      <input class="uk-input" type="text" id="down_weight" value="<?= $this->admin_model->getDownloadSpecifyWeight($idlink); ?>" placeholder="1 BG" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_type'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" id="down_type">
                      <option value="0"><?= $this->lang->line('notification_select_type'); ?></option>
                      <option value="Rar" <?php if($this->admin_model->getDownloadSpecifyType($idlink) == 'Rar') echo 'selected'; ?>>Rar</option>
                      <option value="Zip" <?php if($this->admin_model->getDownloadSpecifyType($idlink) == 'Zip') echo 'selected'; ?>>Zip</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_download"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_save'); ?></button>
            </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </section>

    <script>
      function UpdateDownloadForm(e) {
        e.preventDefault();

        var id = "<?= $idlink ?>";
        var fileName = $.trim($('#down_name').val());
        var url = $.trim($('#down_url').val());
        var image = $.trim($('#down_image').val());
        var category = $.trim($('#down_category').val());
        var weight = $.trim($('#down_weight').val());
        var type = $.trim($('#down_type').val());
        if(fileName == ''){
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
        if(category == 0 || type == 0){
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
          url:"<?= base_url($lang.'/admin/download/update'); ?>",
          method:"POST",
          data:{id, fileName, url, image, category, weight, type},
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
                  message: '<?= $this->lang->line('notification_menu_edited'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#updatedownloadForm')[0].reset();
            window.location.replace("<?= base_url('admin/download/edit/'.$idlink); ?>");
          }
        });
      }
    </script>