    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-bookmark"></i> <?= $this->lang->line('admin_nav_manage_categories'); ?></h3>
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
              url:"<?= base_url($lang.'/admin/categorylist'); ?>",
              method:"POST",
              success:function(data){
                $('#categoryList').html(data);
              }
            });
          }
          fetch_data();

          function edit_data(id, text, colum_name){
            $.ajax({
              url:"<?= base_url($lang.'/admin/editcategory'); ?>",
              method:"POST",
              data:{id:id, text:text, colum_name:colum_name},
              dataType:"text",
              success:function(data){
                $.amaran({
                  'theme': 'awesome ok',
                  'content': {
                    title: '<?= $this->lang->line('notification_title_success'); ?>',
                    message: '<?= $this->lang->line('notification_category_updated'); ?>',
                    info: '',
                    icon: 'fas fa-check-circle'
                  },
                  'position': 'top right',
                  'inEffect': 'slideRight',
                  'outEffect': 'slideRight'
                });
              }
            });
          }
          $(document).on('blur', '#categoryName', function(){
            var id = $(this).data("id1");
            var text = $('#categoryName').val();
            edit_data(id, text, "categoryName");
          });
          $(document).on('click', '#button_addCategory', function(){
            var categoryname = $('#newcategoryname').val();
            if(categoryname == ''){
              $.amaran({
                'theme': 'awesome warning',
                'content': {
                  title: '<?= $this->lang->line('notification_title_warning'); ?>',
                  message: '<?= $this->lang->line('notification_title_empty'); ?>',
                  info: '',
                  icon: 'fas fa-exclamation-circle',
                },
                'position': 'top right',
                'inEffect': 'slideRight',
                'outEffect': 'slideRight',
              });
              return false;
            }
            $.ajax({
              url:"<?= base_url($lang.'/admin/addcategory'); ?>",
              method:"POST",
              data:{categoryname:categoryname},
              dataType:"text",
              success:function(){
                $.amaran({
                  'theme': 'awesome ok',
                  'content': {
                    title: '<?= $this->lang->line('notification_title_success'); ?>',
                    message: '<?= $this->lang->line('notification_category_added'); ?>',
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
          $(document).on('click', '#button_deleteCategory', function(){
            var id = $(this).data("id3");
            $.ajax({
                url:"<?= base_url($lang.'/admin/deletecategory'); ?>",
                method:"POST",
                data:{id:id},
                dataType:"text",
                success:function(data){
                  $.amaran({
                    'theme': 'awesome error',
                    'content': {
                      title: '<?= $this->lang->line('notification_title_success'); ?>',
                      message: '<?= $this->lang->line('notification_category_deleted'); ?>',
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
