    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-shopping-cart"></i> <?= $this->lang->line('admin_nav_manage_store'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/store/category/create'); ?>" class="uk-icon-button"><i class="fas fa-pen"></i></a>
          </div>
        </div>
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-1-4@s">
            <div class="uk-card uk-card-secondary">
              <ul class="uk-nav uk-nav-default">
                <li class="uk-active"><a href="<?= base_url('admin/store'); ?>"><i class="fas fa-tags"></i> <?= $this->lang->line('section_store_categories'); ?></a></li>
                <li><a href="<?= base_url('admin/store/items'); ?>"><i class="fas fa-boxes"></i> <?= $this->lang->line('section_store_items'); ?></a></li>
                <li><a href="<?= base_url('admin/store/top'); ?>"><i class="fas fa-parachute-box"></i> <?= $this->lang->line('section_store_top'); ?></a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@s">
            <div class="uk-card uk-card-default uk-card-body">
              <div class="uk-overflow-auto table-tab">
                <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-table-expand"><?= $this->lang->line('placeholder_category'); ?></th>
                      <th class="uk-table-expand"><?= $this->lang->line('table_header_realm'); ?></th>
                      <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_actions'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($storecategoryList) && !empty($storecategoryList)): ?>
                    <?php foreach($storecategoryList as $list): ?>
                    <tr>
                      <td><?= $list->name; ?></td>
                      <td><?= $this->wowrealm->getRealmName($list->realmid); ?></td>
                      <td>
                        <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                          <a href="<?= base_url('admin/store/category/edit/'.$list->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-edit"></i></a>
                          <button class="uk-button uk-button-danger" value="<?= $list->id ?>" id="button_delete<?= $list->id ?>" onclick="DeleteCategory(event, this.value)"><i class="fas fa-trash-alt"></i></button>
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
                  <?php if (isset($storecategoryList) && is_array($storecategoryList)) echo $pagination_links; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
      function DeleteCategory(e, value) {
        e.preventDefault();

        $.ajax({
          url:"<?= base_url($lang.'/admin/store/category/delete'); ?>",
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
                  message: '<?= $this->lang->line('notification_category_deleted'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            window.location.replace("<?= base_url('admin/store'); ?>");
          }
        });
      }
    </script>
