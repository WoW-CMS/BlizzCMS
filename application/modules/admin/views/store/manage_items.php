    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-shopping-cart"></i> <?= $this->lang->line('admin_nav_manage_store'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/store/item/create'); ?>" class="uk-icon-button"><i class="fas fa-pen"></i></a>
          </div>
        </div>
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-1-4@s">
            <div class="uk-card uk-card-secondary">
              <ul class="uk-nav uk-nav-default">
                <li><a href="<?= base_url('admin/store'); ?>"><i class="fas fa-tags"></i> <?= $this->lang->line('section_store_categories'); ?></a></li>
                <li class="uk-active"><a href="<?= base_url('admin/store/items'); ?>"><i class="fas fa-boxes"></i> <?= $this->lang->line('section_store_items'); ?></a></li>
                <li><a href="<?= base_url('admin/store/top'); ?>"><i class="fas fa-parachute-box"></i> <?= $this->lang->line('section_store_top'); ?></a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@s">
            <div class="uk-card uk-card-default uk-card-body">
              <div class="uk-overflow-auto">
                <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-width-medium"><?= $this->lang->line('table_header_name'); ?></th>
                      <th class="uk-width-medium"><?= $this->lang->line('placeholder_category'); ?></th>
                      <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_price'); ?> <?= $this->lang->line('placeholder_type'); ?></th>
                      <th class="uk-width-small uk-text-center"><?= $this->lang->line('option_dp'); ?> <?= $this->lang->line('table_header_price'); ?></th>
                      <th class="uk-width-small uk-text-center"><?= $this->lang->line('option_dp'); ?> <?= $this->lang->line('table_header_price'); ?></th>
                      <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_actions'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(isset($storeitemList) && !empty($storeitemList)): ?>
                    <?php foreach($storeitemList as $item): ?>
                    <tr>
                      <td><?= $item->name ?></td>
                      <td><?= $this->admin_model->getStoreCategoryName($item->category); ?> - <?= $this->wowrealm->getRealmName($this->admin_model->getStoreCategoryRealm($item->category)); ?></td>
                      <td class="uk-text-center"><?= $item->price_type ?></td>
                      <td class="uk-text-center"><?= $item->dp ?></td>
                      <td class="uk-text-center"><?= $item->vp ?></td>
                      <td>
                        <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                          <a href="<?= base_url('admin/store/item/edit/'.$item->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-edit"></i></a>
                          <button class="uk-button uk-button-danger" value="<?= $item->id ?>" id="button_delete<?= $item->id ?>" onclick="DeleteItem(event, this.value)"><i class="fas fa-trash-alt"></i></button>
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
                  <?php if (isset($storeitemList) && is_array($storeitemList)) echo $pagination_links; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
      function DeleteItem(e, value) {
        e.preventDefault();

        $.ajax({
          url:"<?= base_url($lang.'/admin/store/items/delete'); ?>",
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
                  message: '<?= $this->lang->line('notification_item_deleted'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            window.location.replace("<?= base_url('admin/store/items'); ?>");
          }
        });
      }
    </script>
