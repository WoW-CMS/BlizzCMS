    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <ul class="uk-nav uk-nav-default myaccount-nav">
              <?php if($this->wowmodule->getStatusModule('User Panel')): ?>
              <li><a href="<?= base_url('panel'); ?>"><i class="fas fa-user-circle"></i> <?= $this->lang->line('tab_account'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->wowmodule->getStatusModule('Donation') == '1'): ?>
              <li><a href="<?= base_url('donate'); ?>"><i class="fas fa-hand-holding-usd"></i> <?=$this->lang->line('navbar_donate_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getStatusModule('Vote') == '1'): ?>
              <li><a href="<?= base_url('vote'); ?>"><i class="fas fa-vote-yea"></i> <?=$this->lang->line('navbar_vote_panel'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getStatusModule('Store') == '1'): ?>
              <li><a href="<?= base_url('store'); ?>"><i class="fas fa-store"></i> <?=$this->lang->line('tab_store'); ?></a></li>
              <?php endif; ?>
              <li class="uk-nav-divider"></li>
              <?php if($this->wowmodule->getStatusModule('Bugtracker') == '1'): ?>
              <li class="uk-active"><a href="<?= base_url('bugtracker'); ?>"><i class="fas fa-bug"></i> <?=$this->lang->line('tab_bugtracker'); ?></a></li>
              <?php endif; ?>
              <?php if($this->wowmodule->getStatusModule('Changelogs') == '1'): ?>
              <li><a href="<?= base_url('changelogs'); ?>"><i class="fas fa-scroll"></i> <?=$this->lang->line('tab_changelogs'); ?></a></li>
              <?php endif; ?>
            </ul>
          </div>
          <div class="uk-width-3-4@m">
            <div class="uk-card-default myaccount-card uk-margin-small">
              <div class="uk-card-header">
                <div class="uk-grid uk-grid-small">
                  <div class="uk-width-expand@m">
                    <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-bug"></i> <?= $this->lang->line('placeholder_create_bug_report'); ?></h4>
                  </div>
                  <div class="uk-width-auto@m">
                    <a href="<?= base_url('bugtracker'); ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-arrow-circle-left"></i></a>
                  </div>
                </div>
              </div>
              <div class="uk-card-body">
                <?= form_open('', 'id="reportForm" onsubmit="ReportForm(event)"'); ?>
                <div class="uk-margin uk-light">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_title'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-pen fa-lg"></i></span>
                      <input class="uk-input" type="text" id="report_title" placeholder="<?= $this->lang->line('placeholder_title'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= $this->lang->line('placeholder_type'); ?></label>
                      <div class="uk-form-controls">
                        <select class="uk-select" id="report_type">
                          <option value="0"><?= $this->lang->line('notification_select_type'); ?></option>
                          <?php foreach($this->bugtracker_model->getTypes()->result() as $types): ?>
                          <option value="<?= $types->id; ?>"><?= $types->title ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label"><?= $this->lang->line('table_header_priority'); ?></label>
                      <div class="uk-form-controls">
                        <select class="uk-select" id="report_priority">
                          <option value="0"><?= $this->lang->line('notification_select_priority'); ?></option>
                          <?php foreach($this->bugtracker_model->getPriorities()->result() as $priorities): ?>
                          <option value="<?= $priorities->id; ?>"><?= $priorities->title ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin uk-light">
                  <label class="uk-form-label"><?= $this->lang->line('placeholder_description'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-width-1-1">
                      <textarea class="uk-textarea tinyeditor" id="report_description" rows="12"></textarea>
                    </div>
                  </div>
                </div>
                <div class="uk-margin">
                  <button class="uk-button uk-button-default uk-width-1-1" id="button_report" type="submit"><i class="fas fa-plus-circle"></i> <?= $this->lang->line('button_create'); ?></button>
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
        if(priority == 0){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: '<?= $this->lang->line('notification_select_priority'); ?>',
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
          url:"<?= base_url($lang.'/bugtracker/create'); ?>",
          method:"POST",
          data:{title, description, type, priority},
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
            $('#reportForm')[0].reset();
            window.location.replace("<?= base_url('bugtracker'); ?>");
          }
        });
      }
    </script>
