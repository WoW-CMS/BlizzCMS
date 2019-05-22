    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-edit"></i> Edit Donate Plan</h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/donate'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <?= form_open('', 'id="updateplanForm" onsubmit="UpdatePlanForm(event)"'); ?>
              <div class="uk-margin-small">
                <label class="uk-form-label"><?= $this->lang->line('placeholder_name'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip"><i class="fas fa-pen"></i></span>
                    <input class="uk-input" type="text" id="plan_name" value="<?= $this->admin_model->getDonateSpecifyName($idlink); ?>" placeholder="<?= $this->lang->line('placeholder_name'); ?>" required>
                  </div>
                </div>
              </div>
            <div class="uk-margin-small">
              <div class="uk-grid-small" uk-grid>
                <div class="uk-inline uk-width-1-3@s">
                  <label class="uk-form-label"><?= $this->lang->line('table_header_price'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <input class="uk-input" type="number" id="plan_price" placeholder="<?= $this->lang->line('table_header_price'); ?>" min="1" value="<?= $this->admin_model->getDonateSpecifyPrice($idlink); ?>" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-3@s">
                  <label class="uk-form-label"><?= $this->lang->line('table_header_tax'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <input class="uk-input" type="number" id="plan_tax" placeholder="<?= $this->lang->line('table_header_tax'); ?>" min="0" value="<?= $this->admin_model->getDonateSpecifyTax($idlink); ?>" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" required>
                    </div>
                  </div>
                </div>
                <div class="uk-inline uk-width-1-3@s">
                  <label class="uk-form-label"><?= $this->lang->line('table_header_points'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <input class="uk-input" type="number" id="plan_points" placeholder="<?= $this->lang->line('table_header_points'); ?>" min="1" value="<?= $this->admin_model->getDonateSpecifyPoints($idlink); ?>" step="1" required>
                    </div>
                  </div>
                </div>
              </div>
            </div>
              <div class="uk-margin-small">
                <button class="uk-button uk-button-primary uk-width-1-1" type="submit" id="button_upplan"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_save'); ?></button>
              </div>
            <?= form_close(); ?>
          </div>
        </div>
      </div>
    </section>

    <script>
      function UpdatePlanForm(e) {
        e.preventDefault();

        var id = "<?= $idlink ?>";
        var name = $('#plan_name').val();
        var price = $('#plan_price').val();
        var tax = $('#plan_tax').val();
        var points = $('#plan_points').val();
        if(name == ''){
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
        $.ajax({
          url:"<?= base_url($lang.'/admin/donate/update'); ?>",
          method:"POST",
          data:{id, title, price, tax, points},
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
                  message: '<?= $this->lang->line('notification_category_created'); ?>',
                  info: '',
                  icon: 'fas fa-check-circle'
                },
                'delay': 5000,
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
            }
            $('#updateplanForm')[0].reset();
            window.location.replace("<?= base_url('admin/donate/edit/'.$idlink); ?>");
          }
        });
      }
    </script>
