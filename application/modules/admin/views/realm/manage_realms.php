    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-server"></i> <?= $this->lang->line('admin_nav_realms'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/realms/create'); ?>" class="uk-icon-button"><i class="fas fa-cog"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-overflow-auto">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-width-small"><?= $this->lang->line('table_header_id'); ?></th>
                  <th class="uk-width-medium"><?= $this->lang->line('placeholder_name'); ?></th>
                  <th class="uk-width-medium"><?= $this->lang->line('placeholder_db_name'); ?></th>
                  <th class="uk-width-small">Soap Port</th>
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_actions'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php if(isset($realmsList) && !empty($realmsList)): ?>
                <?php foreach($realmsList as $realmsID): ?>
                <tr>
                  <td><?= $realmsID->realmID; ?></td>
                  <td><?= $this->wowrealm->getRealmName($realmsID->realmID); ?></td>
                  <td><?= $realmsID->char_database; ?></td>
                  <td><?= $realmsID->console_port; ?></td>
                  <td>
                    <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                      <a href="<?= base_url('admin/realms/edit/'.$realmsID->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-edit"></i></a>
                      <button class="uk-button uk-button-danger" value="<?= $realmsID->id ?>" id="button_delete<?= $realmsID->id ?>" onclick="DeleteRealm(event, this.value)"><i class="fas fa-trash-alt"></i></button>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <div class="uk-card-footer">
            <div class="uk-text-right">
              <?php if (isset($realmsList) && is_array($realmsList)) echo $pagination_links; ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
      function DeleteRealm(e, value) {
        e.preventDefault();

        $.ajax({
          url:"<?= base_url($lang.'/admin/realms/delete'); ?>",
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
                  message: '<?= $this->lang->line('notification_realm_deleted'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            window.location.replace("<?= base_url('admin/realms'); ?>");
          }
        });
      }
    </script>
