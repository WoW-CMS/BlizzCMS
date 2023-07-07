<section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-download"></i> <?= $this->lang->line('admin_nav_download'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('admin/download/create'); ?>" class="uk-icon-button"><i class="fas fa-pen"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-overflow-auto">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-table-shrink"><?= $this->lang->line('table_header_id'); ?></th>
                  <th class="uk-width-small"><?= $this->lang->line('placeholder_name'); ?></th>
                  <th class="uk-width-medium"><?= $this->lang->line('placeholder_url'); ?></th>
                  <th class="uk-width-small"><?= $this->lang->line('placeholder_category'); ?></th>
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_actions'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($this->admin_model->getDownload() as $download): ?>
                <tr>
                  <td><?= $download->id ?></td>
                  <td><?= $download->fileName ?></td>
                  <td><?= $download->url ?></td>
                  <td><?= $download->category ?></td>
                  <td>
                    <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                      <a href="<?= site_url('admin/download/edit/'.$download->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-edit"></i></a>
                      <button class="uk-button uk-button-danger" value="<?= $download->id ?>" id="button_delete<?= $download->id ?>" onclick="DeleteDownload(event, this.value)"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>

    <script>
      function DeleteDownload(e, value) {
        e.preventDefault();

        $.ajax({
          url:"<?= site_url('admin/download/delete'); ?>",
          method:"POST",
          data:{value},
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
                  message: '<?= $this->lang->line('notification_menu_deleted'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            window.location.replace("<?= site_url('admin/download'); ?>");
          }
        });
      }
    </script>