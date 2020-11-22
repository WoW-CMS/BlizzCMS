    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-edit"></i> <?= lang('placeholder_edit_topsite'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/topsites'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <?= form_open('', 'id="updatetopsiteForm" onsubmit="UpdateTopsiteForm(event)"'); ?>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_name'); ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" id="topsite_name" placeholder="<?= lang('placeholder_name'); ?>" value="<?= $this->admin_model->getTopsiteSpecifyName($idlink); ?>" required>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('placeholder_url'); ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="url" id="topsite_url" placeholder="<?= lang('placeholder_url'); ?>" value="<?= $this->admin_model->getTopsiteSpecifyURL($idlink); ?>" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('table_header_time'); ?> <span class="uk-text-bold">(<?= lang('placeholder_hours'); ?>)</span></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="number" id="topsite_time" min="1" placeholder="Hours" value="<?= $this->admin_model->getTopsiteSpecifyTime($idlink); ?>" required>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= lang('table_header_points'); ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="number" id="topsite_points" min="1" placeholder="<?= lang('table_header_points'); ?>" value="<?= $this->admin_model->getTopsiteSpecifyPoints($idlink); ?>" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <label class="uk-form-label">URL Image</label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <input class="uk-input" type="url" id="topsite_image" placeholder="http://example.com/image.jpg" value="<?= $this->admin_model->getTopsiteSpecifyImage($idlink); ?>" required>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_uptopsite"><i class="fas fa-sync-alt"></i> <?= lang('button_save'); ?></button>
            </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </section>

    <script>
      function UpdateTopsiteForm(e) {
        e.preventDefault();

        var id = "<?= $idlink ?>";
        var name = $('#topsite_name').val();
        var url = $('#topsite_url').val();
        var time = $('#topsite_time').val();
        var points = $('#topsite_points').val();
        var image = $('#topsite_image').val();
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
        $.ajax({
          url:"<?= base_url($lang.'/admin/topsites/update'); ?>",
          method:"POST",
          data:{id, name, url, time, points, image},
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
                  message: '<?= lang('notification_topsite_edited'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#updatetopsiteForm')[0].reset();
            window.location.replace("<?= base_url('admin/topsites/edit/'.$idlink); ?>");
          }
        });
      }
    </script>
