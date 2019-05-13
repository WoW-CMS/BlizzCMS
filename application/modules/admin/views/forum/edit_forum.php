    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-edit"></i> <?= $this->lang->line('placeholder_edit_forum'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/forum/elements'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <?= form_open('', 'id="updateforumForm" onsubmit="UpdateForumForm(event)"'); ?>
              <div class="uk-margin-small">
                <label class="uk-form-label"><?= $this->lang->line('placeholder_title'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                    <input class="uk-input" type="text" id="forum_name" value="<?= $this->admin_model->getSpecifyForumName($idlink); ?>" placeholder="<?= $this->lang->line('placeholder_title'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label"><?= $this->lang->line('placeholder_description'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <input class="uk-input" type="text" id="forum_description" value="<?= $this->admin_model->getSpecifyForumDesc($idlink); ?>" placeholder="<?= $this->lang->line('placeholder_description'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label"><?= $this->lang->line('placeholder_icon_name'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <input class="uk-input" type="text" id="forum_icon" value="<?= $this->admin_model->getSpecifyForumIcon($idlink); ?>" placeholder="<?= $this->lang->line('placeholder_icon_name'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label"><?= $this->lang->line('placeholder_type'); ?></label>
                <div class="uk-form-controls">
                  <select class="uk-select" id="forum_type">
                    <option value="0"><?= $this->lang->line('notification_select_type'); ?></option>
                    <option value="1" <?php if($this->admin_model->getSpecifyForumType($idlink) == '1') echo 'selected'; ?>><?= $this->lang->line('option_everyone'); ?></option>
                    <option value="2" <?php if($this->admin_model->getSpecifyForumType($idlink) == '2') echo 'selected'; ?>><?= $this->lang->line('option_staff'); ?></option>
                    <option value="3" <?php if($this->admin_model->getSpecifyForumType($idlink) == '3') echo 'selected'; ?>><?= $this->lang->line('option_all'); ?></option>
                  </select>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label"><?= $this->lang->line('placeholder_category'); ?></label>
                <div class="uk-form-controls">
                  <select class="uk-select" id="forum_category">
                    <option value="0"><?= $this->lang->line('notification_select_category'); ?></option>
                    <?php foreach($this->admin_model->getForumCategoryList()->result() as $categ): ?>
                    <?php if ($categ->id == $this->admin_model->getForumCategoryName($idlink)): ?>
                    <option value="<?= $categ->id ?>" selected><?= $categ->name ?></option>
                    <?php else: ?>
                    <option value="<?= $categ->id ?>"><?= $categ->name ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="uk-margin-small">
                <button class="uk-button uk-button-primary uk-width-1-1" type="submit" name="button_upforum"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_save'); ?></button>
              </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </section>

    <script>
      function UpdateForumForm(e) {
        e.preventDefault();

        var id = "<?= $idlink ?>";
        var name = $.trim($('#forum_name').val());
        var description = $.trim($('#forum_description').val());
        var icon = $.trim($('#forum_icon').val());
        var type = $.trim($('#forum_type').val());
        var category = $.trim($('#forum_category').val());
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
        if(category == 0){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= $this->lang->line('notification_title_error'); ?>',
              message: '<?= $this->lang->line('notification_select_category'); ?>',
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
          url:"<?= base_url($lang.'/admin/forum/update'); ?>",
          method:"POST",
          data:{id, name, description, icon, type, category},
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
                  message: '<?= $this->lang->line('notification_forum_edited'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#updateforumForm')[0].reset();
            window.location.replace("<?= base_url('admin/forum/edit/'.$idlink); ?>");
          }
        });
      }
    </script>
