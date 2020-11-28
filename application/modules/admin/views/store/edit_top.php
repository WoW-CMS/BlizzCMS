    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-edit"></i> <?= lang('placeholder_edit_top'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/store/top'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <?= form_open('', 'id="updatetopForm" onsubmit="UpdateTopForm(event)"'); ?>
              <div class="uk-margin-small">
                <label class="uk-form-label"><?= lang('placeholder_item'); ?></label>
                <div class="uk-form-controls">
                  <select class="uk-select" id="store_top_item">
                    <option value="0"><?= lang('notification_select_item'); ?></option>
                    <?php foreach ($this->admin_model->getStoreItems() as $item): ?>
                    <option value="<?= $item->id ?>"<?php if($this->admin_model->getTopSpecifyItem($idlink) == $item->id) echo 'selected'; ?>><?= $item->name ?> (<?= $this->admin_model->getStoreCategoryName($item->category); ?> - <?= $this->realm->getRealmName($this->admin_model->getStoreCategoryRealm($item->category)); ?>)</option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="uk-margin-small">
                <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_uptop"><i class="fas fa-sync-alt"></i> <?= lang('button_save'); ?></button>
              </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </section>

    <script>
      function UpdateTopForm(e) {
        e.preventDefault();

        var id = "<?= $idlink ?>";
        var item = $('#store_top_item').val();
        if(item == 0){
          $.amaran({
            'theme': 'awesome error',
            'content': {
              title: '<?= lang('notification_title_error'); ?>',
              message: '<?= lang('notification_select_item'); ?>',
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
          url:"<?= base_url('admin/store/top/update'); ?>",
          method:"POST",
          data:{id, item},
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
                  message: '<?= lang('notification_top_edited'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#updatetopForm')[0].reset();
            window.location.replace("<?= base_url('admin/store/top/edit/'.$idlink); ?>");
          }
        });
      }
    </script>
