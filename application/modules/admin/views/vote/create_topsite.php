    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-plus-circle"></i> <?= $this->lang->line('placeholder_create_topsite'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/topsites'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <?= form_open('', 'id="addtopsiteForm" onsubmit="AddTopsiteForm(event)"'); ?>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_name'); ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" id="topsite_name" placeholder="<?= $this->lang->line('placeholder_name'); ?>" required>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_url'); ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="url" id="topsite_url" placeholder="<?= $this->lang->line('placeholder_url'); ?>" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('table_header_time'); ?> <span class="uk-text-bold">(<?= $this->lang->line('placeholder_hours'); ?>)</span></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="number" id="topsite_time" min="1" placeholder="Hours" required>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-2@s">
                  <label class="uk-form-label"><?= $this->lang->line('table_header_points'); ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="number" id="topsite_points" min="1" placeholder="<?= $this->lang->line('table_header_points'); ?>" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <label class="uk-form-label">URL Image</label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <input class="uk-input" type="url" id="topsite_image" placeholder="http://example.com/image.jpg" required>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_topsite"><i class="fas fa-check-circle"></i> <?= $this->lang->line('button_create'); ?></button>
            </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </section>

    <script>
      function AddTopsiteForm(e) {
        e.preventDefault();

        var name = $('#topsite_name').val();
        var url = $('#topsite_url').val();
        var time = $('#topsite_time').val();
        var points = $('#topsite_points').val();
        var image = $('#topsite_image').val();
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
        $.ajax({
          url:"<?= base_url($lang.'/admin/topsites/add'); ?>",
          method:"POST",
          data:{name, url, time, points, image},
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
                  message: '<?= $this->lang->line('notification_topsite_created'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#addtopsiteForm')[0].reset();
          }
        });
      }
    </script>
