    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fab fa-paypal"></i> <?= $this->lang->line('admin_nav_donations'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="" class="uk-icon-button"><i class="fas fa-info"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-card-body">
          <div id="categoryList"></div>
        </div>
      </div>
    </section>

      <script>
        $(document).ready(function(){
          function fetch_data(){
            $.ajax({
              url:"<?= base_url($lang.'/admin/donatelist'); ?>",
              method:"POST",
              success:function(data){
                $('#categoryList').html(data);
              }
            });
          }
          fetch_data();

          function edit_data(id, text, colum_name){
            $.ajax({
              url:"<?= base_url($lang.'/admin/editdonation'); ?>",
              method:"POST",
              data:{id:id, text:text, colum_name:colum_name},
              dataType:"text",
              success:function(){
                $.amaran({
                  'theme': 'awesome ok',
                  'content': {
                    title: '<?= $this->lang->line('notification_title_success'); ?>',
                    message: '<?= $this->lang->line('notification_donation_updated'); ?>',
                    info: '',
                    icon: 'fas fa-check-circle'
                  },
                  'position': 'top right',
                  'inEffect': 'slideRight',
                  'outEffect': 'slideRight'
                });
                fetch_data();
              },
              error:function(){
                $.amaran({
                  'theme': 'awesome error',
                  'content': {
                    title: '<?= $this->lang->line('notification_title_error'); ?>',
                    message: '<?= $this->lang->line('notification_incorrect_update'); ?>',
                    info: '',
                    icon: 'fas fa-times-circle'
                  },
                  'position': 'top right',
                  'inEffect': 'slideRight',
                  'outEffect': 'slideRight'
                });
                fetch_data();
              }
            });
          }
          $(document).on('blur', '#donateName', function(){
            var id = $(this).data("id1");
            var text = $('#donateName').val();
            if(text == ''){
              $.amaran({
                'theme': 'awesome warning',
                'content':{
                  title: '<?= $this->lang->line('notification_title_warning'); ?>',
                  message: '<?= $this->lang->line('notification_name_empty'); ?>',
                  info: '',
                  icon: 'fas fa-exclamation-circle'
                },
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              return false;
            }
            edit_data(id, text, "name");
          });
          $(document).on('blur', '#donatePrice', function(){
            var id = $(this).data("id4");
            var price = $('#donatePrice').val();
            if(price == ''){
              $.amaran({
                'theme': 'awesome warning',
                'content': {
                  title: '<?= $this->lang->line('notification_title_warning'); ?>',
                  message: '<?= $this->lang->line('notification_price_empty'); ?>',
                  info: '',
                  icon: 'fas fa-exclamation-circle'
                },
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              return false;
            }
            edit_data(id, price, "price");
          });
          $(document).on('blur', '#donateTax', function(){
            var id = $(this).data("id5");
            var tax = $('#donateTax').val();
            if(tax == ''){
              $.amaran({
                'theme': 'awesome warning',
                'content': {
                  title: '<?= $this->lang->line('notification_title_warning'); ?>',
                  message: '<?= $this->lang->line('notification_tax_empty'); ?>',
                  info: '',
                  icon: 'fas fa-exclamation-circle'
                },
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              return false;
            }
            edit_data(id, tax, "tax");
          });
          $(document).on('blur', '#donatePoints', function(){
            var id = $(this).data("id6");
            var points = $('#donatePoints').val();
            if(points == ''){
              $.amaran({
                'theme': 'awesome warning',
                'content': {
                  title: '<?= $this->lang->line('notification_title_warning'); ?>',
                  message: '<?= $this->lang->line('notification_points_empty'); ?>',
                  info: '',
                  icon: 'fas fa-exclamation-circle'
                },
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              return false;
            }
            edit_data(id, points, "points");
          });
          $(document).on('click', '#button_adddonation', function(){
            var donationname = $('#newdonatename').val();
            var donationprice = $('#newdonateprice').val();
            var donationtax = $('#newonateTax').val();
            var donationpoints = $('#newdonatepoints').val();
            if(donationname == ''){
              $.amaran({
                'theme': 'awesome warning',
                'content': {
                  title: '<?= $this->lang->line('notification_title_warning'); ?>',
                  message: '<?= $this->lang->line('notification_name_empty'); ?>',
                  info: '',
                  icon: 'fas fa-exclamation-circle'
                },
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight'
              });
              return false;
            }
            $.ajax({
              url:"<?= base_url($lang.'/admin/adddonation'); ?>",
              method:"POST",
              data:{donationname:donationname, donationprice:donationprice, donationtax:donationtax, donationpoints:donationpoints},
              dataType:"text",
              success:function(){
                $.amaran({
                  'theme': 'awesome ok',
                  'content': {
                    title: '<?= $this->lang->line('notification_title_success'); ?>',
                    message: '<?= $this->lang->line('notification_donation_added'); ?>',
                    info: '',
                    icon: 'fas fa-plus-circle'
                  },
                  'position': 'top right',
                  'inEffect': 'slideRight',
                  'outEffect': 'slideRight'
                });
                fetch_data();
              }
            });
          });
          $(document).on('click', '#button_deleteDonate', function(){
            var id = $(this).data("id3");
            $.ajax({
              url:"<?= base_url($lang.'/admin/deletedonation'); ?>",
              method:"POST",
              data:{id:id},
              dataType:"text",
              success:function(data){
                $.amaran({
                  'theme': 'awesome error',
                  'content': {
                    title: '<?= $this->lang->line('notification_title_success'); ?>',
                    message: '<?= $this->lang->line('notification_donation_deleted'); ?>',
                    info: '',
                    icon: 'fas fa-minus-circle'
                  },
                  'position': 'top right',
                  'inEffect': 'slideRight',
                  'outEffect': 'slideRight'
                });
                fetch_data();
              }
            });
          });
        });
      </script>
