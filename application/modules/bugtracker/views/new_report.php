    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <li><a href="<?= base_url('user'); ?>"><i class="fas fa-user-circle"></i> <?= lang('tab_account'); ?></a></li>
              <li class="uk-nav-divider"></li>
              <li><a href="<?= base_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?=lang('navbar_donate_panel'); ?></a></li>
              <li><a href="<?= base_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?=lang('navbar_vote_panel'); ?></a></li>
              <li><a href="<?= base_url('store'); ?>"><i class="fas fa-store"></i> <?=lang('tab_store'); ?></a></li>
              <li class="uk-nav-divider"></li>
              <li class="uk-active"><a href="<?= base_url('bugtracker'); ?>"><i class="fas fa-bug"></i> <?=lang('tab_bugtracker'); ?></a></li>
              <li><a href="<?= base_url('changelogs'); ?>"><i class="fas fa-scroll"></i> <?=lang('tab_changelogs'); ?></a></li>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <div class="uk-card-default myaccount-card uk-margin-small">
              <div class="uk-card-header">
                <div class="uk-grid uk-grid-small">
                  <div class="uk-width-expand@m">
                    <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-bug"></i> <?= lang('create_bug_report'); ?></h4>
                  </div>
                  <div class="uk-width-auto@m">
                    <a href="<?= base_url('bugtracker'); ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-arrow-circle-left"></i></a>
                  </div>
                </div>
              </div>
              <div class="uk-card-body">
                <?= form_open('', 'id="reportForm" onsubmit="ReportForm(event)"'); ?>
                <div class="uk-margin uk-light">
                  <label class="uk-form-label"><?= lang('title'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-pen fa-lg"></i></span>
                      <input class="uk-input" type="text" id="report_title" placeholder="<?= lang('title'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= lang('type'); ?></label>
                      <div class="uk-form-controls">
                        <select class="uk-select" id="report_type">
                          <option value="0"><?= lang('select_type'); ?></option>
                          <?php foreach ($this->bugtracker_model->all_types() as $types): ?>
                          <option value="<?= $types->id; ?>"><?= $types->title ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= lang('priority'); ?></label>
                      <div class="uk-form-controls">
                        <select class="uk-select" id="report_priority">
                          <option value="0"><?= lang('select_priority'); ?></option>
                          <?php foreach ($this->bugtracker_model->all_priorities() as $priorities): ?>
                          <option value="<?= $priorities->id; ?>"><?= $priorities->title ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <label class="uk-form-label"><?= lang('description'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-width-1-1">
                      <textarea class="uk-textarea tinyeditor" id="report_description" rows="12"></textarea>
                    </div>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-default uk-width-1-1" id="button_report" type="submit"><i class="fas fa-plus-circle"></i> <?= lang('create'); ?></button>
                </div>
                <?= form_close(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?= $tiny ?>
    <script>
      function ReportForm(e) {
        e.preventDefault();

        var title =  $.trim($('#report_title').val());
        var description = tinymce.get('report_description').getContent();
        var type = $('#report_type').val();
        var priority = $('#report_priority').val();
        var content = tinymce.get('report_description').getContent({format: 'text'}).replace('&nbsp;','').trim();
        if(title == ''){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= lang('notification_title_error'); ?>',
              message: '<?= lang('notification_title_empty'); ?>',
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
              title: '<?= lang('notification_title_error'); ?>',
              message: '<?= lang('select_type'); ?>',
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
        if(priority == 0){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= lang('notification_title_error'); ?>',
              message: '<?= lang('select_priority'); ?>',
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
              title: '<?= lang('notification_title_error'); ?>',
              message: '<?= lang('notification_description_empty'); ?>',
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
          url:"<?= base_url('bugtracker/create'); ?>",
          method:"POST",
          data:{title, description, type, priority},
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
                  message: '<?= lang('notification_report_created'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#reportForm')[0].reset();
            window.location.replace("<?= base_url('bugtracker'); ?>");
          }
        });
      }
    </script>
