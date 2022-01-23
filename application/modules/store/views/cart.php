    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h5 class="uk-h5 uk-text-bold"><i class="fas fa-shopping-cart"></i> <?= $this->lang->line('tab_cart'); ?></h5>
          </div>
          <div class="uk-card-body">
            <div class="uk-overflow-auto uk-width-1-1 uk-margin-small">
              <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
                <thead>
                  <tr>
                    <th class="uk-width-medium"><i class="fas fa-info-circle"></i> <?= $this->lang->line('table_header_item_name'); ?></th>
                    <th class="uk-width-medium"><i class="fas fa-list-ul"></i> <?= $this->lang->line('table_header_character'); ?></th>
                    <th class="uk-width-small"><i class="fas fa-coins"></i> <?= $this->lang->line('table_header_price'); ?></th>
                    <th class="uk-table-shrink"><i class="fas fa-sort-numeric-up"></i> <?= $this->lang->line('table_header_quantity'); ?></th>
                    <th class="uk-table-shrink"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if($this->cart->total_items() > 0): ?>
                  <?php foreach($this->cart->contents() as $item): ?>
                  <tr>
                    <td><?= $item["name"]; ?></td>
                    <td>
                      <div class="uk-form-controls uk-light">
                        <select class="uk-select uk-width-1-1" onchange="updateCharacter(this, '<?php echo $item["rowid"]; ?>')">
                          <option value="0"><?= $this->lang->line('notification_select_character'); ?></option>
                          <?php foreach($this->wowrealm->getGeneralCharactersSpecifyAcc($this->wowrealm->getRealmConnectionData($this->store_model->getCategoryRealmId($item["category"])) ,$this->session->userdata('wow_sess_id'))->result() as $listchar): ?>
                          <option value="<?= $listchar->guid ?>" <?php if($listchar->guid == $item["guid"]) echo 'selected'; ?>><?= $listchar->name ?> - (<?= $this->lang->line('table_header_realm'); ?>: <?= $this->wowrealm->getRealmName($this->store_model->getCategoryRealmId($item["category"])); ?>)</option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </td>
                    <td>
                      <?php if($this->store_model->getPriceType($item["id"]) == 1): ?>
                      <span class="uk-text-small"><span uk-tooltip="title: <?= $this->lang->line('panel_dp'); ?>"><i class="dp-icon"></i></span><?= $item["dp"]; ?></span>
                      <?php elseif($this->store_model->getPriceType($item["id"]) == 2): ?>
                      <span class="uk-text-small"><span uk-tooltip="title: <?= $this->lang->line('panel_vp'); ?>"><i class="vp-icon"></i></span><?= $item["vp"]; ?></span>
                      <?php elseif($this->store_model->getPriceType($item["id"]) == 3): ?>
                      <span class="uk-text-small"><span uk-tooltip="title: <?= $this->lang->line('panel_dp'); ?>"><i class="dp-icon"></i></span><?= $item["dp"]; ?> <span class="uk-badge">&amp;</span> <span uk-tooltip="title: <?= $this->lang->line('panel_vp'); ?>"><i class="vp-icon"></i></span><?= $item["vp"]; ?></span>
                      <?php endif; ?>
                    </td>
                    <td>
                      <div class="uk-form-controls uk-light">
                        <input class="uk-input uk-width-1-1" type="number" type="number" min="0" oninput="this.value = 
 						!!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" value="<?= $item["qty"]; ?>" onchange="updateQuantity(this, '<?php echo $item["rowid"]; ?>')">
                      </div>
                    </td>
                    <td>
                      <button class="uk-button uk-button-danger" value="<?= $item["rowid"]; ?>" id="button_delete<?= $item["rowid"]; ?>" onclick="deleteItem(event, this.value)"><i class="fas fa-trash-alt"></i></button>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
          <div class="uk-card-footer">
            <div class="uk-grid uk-grid-small" data-uk-grid>
              <div class="uk-width-expand@s">
                <a href="<?= base_url('store'); ?>" class="uk-button uk-button-default uk-button-small"><i class="fas fa-arrow-circle-left"></i> <?= $this->lang->line('button_buying'); ?></a>
              </div>
              <div class="uk-width-auto@s uk-flex uk-flex-middle">
                <?php if($this->cart->total_items() > 0): ?>
                <p class="uk-margin-small uk-text-small"><span class="uk-text-uppercase uk-text-bold">Total:</span> <span uk-tooltip="title: <?= $this->lang->line('panel_dp'); ?>"><i class="dp-icon"></i></span><?= $this->cart->total_dp(); ?> <span class="uk-badge">&amp;</span> <span uk-tooltip="title: <?= $this->lang->line('panel_vp'); ?>"><i class="vp-icon"></i></span><?= $this->cart->total_vp(); ?></p>
                <?php endif; ?>
              </div>
              <div class="uk-width-auto@s">
                <?php if($this->cart->total_items() > 0): ?>
                <button class="uk-button uk-button-default uk-button-small" value="1" id="button_checkout" onclick="Checkout(event, this.value)"><?= $this->lang->line('button_checkout'); ?> <i class="fas fa-shopping-cart"></i></button>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
      $('#button_checkout').click(function(){
        var button = $(this);
        button.attr('disabled', 'disabled');
        setTimeout(function() {
         button.removeAttr('disabled');
        },8000);
      });
      function updateQuantity(obj, rowid) {
        $.ajax({
          url:"<?= base_url($lang.'/cart/updatequantity'); ?>",
          type:"GET",
          data:{rowid:rowid, qty:obj.value},
          dataType:"text",
          success: function(response) {
            if(!response){
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('notification_store_cart_error'); ?>',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }

            if(response){
              location.reload();
            }
          }
        });
      }
      function updateCharacter(obj, rowid) {
        $.ajax({
          url:"<?= base_url($lang.'/cart/updatecharacter'); ?>",
          type:"GET",
          data:{rowid:rowid, char:obj.value},
          dataType:"text",
          success: function(response) {
            if(!response){
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('notification_store_cart_error'); ?>',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }

            if(response){
              location.reload();
            }
          }
        });
      }
      function deleteItem(e, value) {
        e.preventDefault();

        $.ajax({
          url:"<?= base_url($lang.'/cart/delete'); ?>",
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
                  message: '<?= $this->lang->line('notification_store_item_removed'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 6000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            location.reload();
          }
        });
      }
      function Checkout(e, value) {
        e.preventDefault();

        $.ajax({
          url:"<?= base_url($lang.'/cart/checkout'); ?>",
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

            if (response == 'Selchars') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('notification_store_chars_error'); ?>',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 8000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              return false;
            }

            if (response == 'insPoints') {
              $.amaran({
                'theme': 'awesome error',
                'content': {
                  title: '<?= $this->lang->line('notification_title_error'); ?>',
                  message: '<?= $this->lang->line('notification_store_item_insufficient_points'); ?>',
                  info: '',
                  icon: 'fas fa-times-circle'
                },
                'delay': 8000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              return false;
            }

            if (response) {
              $.amaran({
                'theme': 'awesome ok',
                  'content': {
                  title: '<?= $this->lang->line('notification_title_success'); ?>',
                  message: '<?= $this->lang->line('notification_store_item_purchased'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 8000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            location.reload();
          }
        });
      }
    </script>
