 <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-download"></i> <?= lang('placeholder_create_download'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('admin/download'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <?= form_open('', 'id="adddownloadForm" onsubmit="AddDownloadForm(event)"'); ?>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_name'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-pen"></i></span>
                      <input class="uk-input" type="text" id="down_name" placeholder="<?= lang('placeholder_name'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_url'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-link"></i></span>
                      <input class="uk-input" type="text" id="down_url" placeholder="<?= lang('placeholder_url'); ?>" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('option_image'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fab fa-font-awesome-flag"></i></span>
                      <input class="uk-input" type="text" id="down_image" placeholder="<?= lang('option_image'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_category'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" id="down_category">
                      <option value="0"><?= lang('placeholder_select_category'); ?></option>
                      <option value="1">Client</option>
                      <option value="2">Addon</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_size'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"></span>
                      <input class="uk-input" type="text" id="down_size" placeholder="1 GB" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_size'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" id="down_type">
                      <option value="0"><?= lang('placeholder_select_type'); ?></option>
                      <option value="Rar">Rar</option>
                      <option value="Zip">Zip</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_download"><i class="fas fa-check-circle"></i> <?= lang('button_create'); ?></button>
            </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </section>

    <script>
      function AddDownloadForm(e) {
        e.preventDefault();

        var fileName = $.trim($('#down_name').val());
        var url = $.trim($('#down_url').val());
        var image = $.trim($('#down_image').val());
        var category = $.trim($('#down_category').val());
        var weight = $.trim($('#down_size').val());
        var type = $.trim($('#down_type').val());
        if(fileName == ''){
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
        if(category == 0 || type == 0){
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
          url:"<?= site_url('admin/download/add'); ?>",
          method:"POST",
          data:{fileName, url, image, category, weight, type},
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
                  message: '<?= lang('notification_menu_created'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#adddownloadForm')[0].reset();
          }
        });
      }
    </script>