    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-card-default myaccount-card uk-margin-small">
          <div class="uk-card-header">
            <div class="uk-grid uk-grid-small">
              <div class="uk-width-expand@m">
                <h4 class="uk-h4 uk-text-bold"><i class="fas fa-pen-square"></i> <?= $this->lang->line('button_new_topic'); ?></h4>
              </div>
              <div class="uk-width-auto@m">
                <a href="<?= base_url('forum'); ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-arrow-circle-left"></i></a>
              </div>
            </div>
          </div>
          <div class="uk-card-body">
            <?= form_open('', 'id="newtopicForm" onsubmit="NewTopicForm(event)"'); ?>
            <div class="uk-margin uk-light">
              <label class="uk-form-label"><?= $this->lang->line('placeholder_title'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-pen fa-lg"></i></span>
                  <input class="uk-input" type="text" id="topic_title" placeholder="<?= $this->lang->line('placeholder_title'); ?>" required>
                </div>
              </div>
            </div>
            <div class="uk-margin uk-light">
              <label class="uk-form-label"><?= $this->lang->line('placeholder_description'); ?></label>
              <div class="uk-form-controls">
                <div class="uk-width-1-1">
                  <textarea class="uk-textarea tinyeditor" id="topic_description" rows="10"></textarea>
                </div>
              </div>
            </div>
            <?php if($this->wowauth->getRank($this->session->userdata('wow_sess_id')) >= config_item('admin_access_level')): ?>
            <div class="uk-margin">
              <div class="uk-form-controls">
                <div class="uk-grid uk-grid-small uk-child-width-auto uk-flex uk-flex-center" data-uk-grid>
                  <label><input class="uk-checkbox" type="checkbox" id="topic_pinned"> <?= $this->lang->line('placeholder_highl'); ?></label>
                  <label><input class="uk-checkbox" type="checkbox" id="topic_locked"> <?= $this->lang->line('placeholder_lock'); ?></label>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <div class="uk-margin">
              <button class="uk-button uk-button-default uk-width-1-1" type="submit" id="button_topic"><i class="fas fa-plus-circle"></i> <?= $this->lang->line('button_create'); ?></button>
            </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </section>
    <?= $tiny ?>
    <script>
      function NewTopicForm(e) {
        e.preventDefault();

        var category = "<?= $idlink ?>";
        var title =  $.trim($('#topic_title').val());
        var description = tinymce.get('topic_description').getContent();
        var content = tinymce.get('topic_description').getContent({format: 'text'}).replace('&nbsp;','').trim();
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
        if(content == "" || content == null || content == '<p> </p>'){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: '<?= $this->lang->line('notification_description_empty'); ?>',
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
          url:"<?= base_url($lang.'/forum/topic/new/'.$idlink); ?>",
          method:"POST",
          data:{category, title, description},
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
                  message: '<?= $this->lang->line('notification_topic_created'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#newtopicForm')[0].reset();
            window.location.replace("<?= base_url('forum/category/'.$idlink); ?>");
          }
        });
      }
    </script>
