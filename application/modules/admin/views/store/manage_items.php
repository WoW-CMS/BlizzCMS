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
                <li><a href="<?= base_url('admin/store'); ?>"><i class="fas fa-tags"></i> Store Categories</a></li>
                <li class="uk-active"><a href="<?= base_url('admin/store/items'); ?>"><i class="fas fa-boxes"></i> Store Items</a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@s">
            <div class="uk-card uk-card-default uk-card-body">
              <div class="uk-overflow-auto">
                <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-width-small"><?= $this->lang->line('table_header_id'); ?></th>
                      <th class="uk-width-medium"><?= $this->lang->line('table_header_name'); ?></th>
                      <th class="uk-width-small"><?= $this->lang->line('store_item_price'); ?> DP</th>
                      <th class="uk-width-small"><?= $this->lang->line('store_item_price'); ?> VP</th>
                      <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_action'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($this->admin_model->getShopAll()->result() as $storeall): ?>
                    <tr>
                      <td><?= $storeall->itemid ?></td>
                      <td><?= $storeall->name ?></td>
                      <td><?= $storeall->price_dp ?></td>
                      <td><?= $storeall->price_vp ?></td>
                      <td>
                        <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                          <a href="<?= base_url('admin/store/item/edit/'.$storeall->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-edit"></i></a>
                          <button class="uk-button uk-button-danger" value="<?= $storeall->id ?>" id="button_delete<?= $storeall->id ?>" onclick="DeleteItem(event, this.value)"><i class="fas fa-trash-alt"></i></button>
                        </div>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
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
            window.location.replace("<?= base_url('admin/store/items'); ?>");
          }
        });
      }
    </script>
