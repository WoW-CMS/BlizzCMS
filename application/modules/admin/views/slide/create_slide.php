    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-plus-circle"></i> <?= $this->lang->line('placeholder_create_slide'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/slides'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <?= form_open('', 'id="addslideForm" onsubmit="AddSlideForm(event)"'); ?>
            <div class="uk-margin-small">
              <label class="uk-form-label"><?= $this->lang->line('placeholder_title'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <input class="uk-input" type="text" id="slide_title" placeholder="<?= $this->lang->line('placeholder_title'); ?>" required>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <label class="uk-form-label"><?= $this->lang->line('placeholder_description'); ?></label>
              <div class="uk-form-controls">
                <textarea class="uk-textarea" id="slide_description" rows="3"></textarea>
              </div>
            </div>
            <div class="uk-margin-small">
              <div class="uk-grid uk-grid-small" data-uk-grid>
                <div class="uk-inline uk-width-1-3@s">
                  <label class="uk-form-label"><?=$this->lang->line('placeholder_type');?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" id="slide_type">
                      <option value="0"><?= $this->lang->line('notification_select_type'); ?></option>
                      <option value="1"><?= $this->lang->line('option_image'); ?></option>
                      <option value="2"><?= $this->lang->line('option_video'); ?></option>
                      <option value="3"><?= $this->lang->line('option_iframe'); ?></option>
                    </select>
                  </div>
                </div>
                <div class="uk-inline uk-width-2-3@s">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_route'); ?></label>
                  <div class="uk-form-controls">
                    <input class="uk-input" type="text" id="slide_route" placeholder="URL or Image Name" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_slide"><i class="fas fa-check-circle"></i> <?= $this->lang->line('button_create'); ?></button>
            </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </section>

    <script>
      function AddSlideForm(e) {
        e.preventDefault();

        var title = $('#slide_title').val();
        var description = $('#slide_description').val();
        var type = $('#slide_type').val();
        var route = $('#slide_route').val();
        if(title == ''){
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
        if(type == 0){
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
          url:"<?= base_url($lang.'/admin/slides/add'); ?>",
          method:"POST",
          data:{title, description, type, route},
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
                  message: '<?= $this->lang->line('notification_slide_created'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#addslideForm')[0].reset();
          }
        });
      }
    </script>
