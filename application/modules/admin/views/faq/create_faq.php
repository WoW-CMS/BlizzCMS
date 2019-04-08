    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-question-circle"></i> <?= $this->lang->line('placeholder_create_faq'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/faq'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <?= form_open('', 'id="addfaqForm" onsubmit="AddFaqForm(event)"'); ?>
            <div class="uk-margin-small">
              <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_faq_title'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                  <input class="uk-input" type="text" id="faq_title" placeholder="<?= $this->lang->line('placeholder_faq_title'); ?>" required>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_type'); ?></label>
              <div class="uk-form-controls">
                <select class="uk-select" id="faq_type">
                  <option value="0"><?= $this->lang->line('notification_select_type'); ?></option>
                  <?php foreach($this->admin_model->getFaqTypeList()->result() as $type): ?>
                  <option value="<?= $type->id ?>"><?= $type->title ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="uk-margin-small">
              <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_description'); ?></label>
              <div class="uk-form-controls">
                <textarea class="uk-textarea tinyeditor" id="faq_description" rows="12"></textarea>
              </div>
            </div>
            <div class="uk-margin-small">
              <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_faq"><i class="fas fa-check-circle"></i> <?= $this->lang->line('button_create'); ?></button>
            </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </section>
    <?= $tiny ?>
    <script>
      function AddFaqForm(e) {
        e.preventDefault();

        var title = $.trim($('#faq_title').val());
        var type = $('#faq_type').val();
        var description = tinymce.get('faq_description').getContent();
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
          url:"<?= base_url($lang.'/admin/faq/add'); ?>",
          method:"POST",
          data:{title, type, description},
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
            $('#addfaqForm')[0].reset();
          }
        });
      }
    </script>
