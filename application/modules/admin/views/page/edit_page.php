    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-edit"></i> <?= $this->lang->line('placeholder_edit_page'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/pages'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <?= form_open('', 'id="updatepageForm" onsubmit="UpdatePageForm(event)"'); ?>
            <div class="uk-margin-small">
              <label class="uk-form-label"><?= $this->lang->line('placeholder_title'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                  <input class="uk-input" type="text" id="page_title" value="<?= $this->admin_model->getPagesSpecifyName($idlink); ?>" placeholder="<?= $this->lang->line('placeholder_title'); ?>" required>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <label class="uk-form-label"><?= $this->lang->line('placeholder_uri'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: link"></span>
                  <input class="uk-input" type="text" id="page_uri" value="<?= $this->admin_model->getPagesSpecifyURI($idlink); ?>" placeholder="<?= $this->lang->line('placeholder_uri'); ?>" required>
                </div>
              </div>
            </div>
            <div class="uk-margin-small">
              <label class="uk-form-label"><?= $this->lang->line('placeholder_description'); ?></label>
              <div class="uk-form-controls">
                <textarea class="uk-textarea tinyeditor" id="page_description" rows="12"><?= $this->admin_model->getPagesSpecifyDesc($idlink); ?></textarea>
              </div>
            </div>
            <div class="uk-margin-small">
              <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_uppage"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_save'); ?></button>
            </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </section>
    <?= $tiny ?>
    <script>
      function UpdatePageForm(e) {
        e.preventDefault();

        var id = "<?= $idlink ?>";
        var title = $.trim($('#page_title').val());
        var uri = $.trim($('#page_uri').val());
        var description = tinymce.get('page_description').getContent();
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
        $.ajax({
          url:"<?= base_url($lang.'/admin/pages/update'); ?>",
          method:"POST",
          data:{id, title, uri, description},
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
                  message: '<?= $this->lang->line('notification_page_edited'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#updatepageForm')[0].reset();
            window.location.replace("<?= base_url('admin/pages/edit/'.$idlink); ?>");
          }
        });
      }
    </script>
