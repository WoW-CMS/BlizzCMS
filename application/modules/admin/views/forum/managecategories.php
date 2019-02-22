      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span data-uk-icon="icon: list"></span> <?= $this->lang->line('admin_manage_categories'); ?></h4>
                </div>
                <div class="uk-width-expand"></div>
              </div>
            </div>
            <div class="uk-card-body">
              <!-- ajax -->
              <div id="categoryList"></div>
              <!-- ajax -->
            </div>
          </div>
        </div>
      </section>

      <script>
        $(document).ready(function(){
          function fetch_data(){
            $.ajax({
              url:"<?= base_url('admin/getCategoryList'); ?>",
              method:"POST",
              success:function(data){
                $('#categoryList').html(data);
              }
            });
          }
          fetch_data();

          function edit_data(id, text, colum_name){
            $.ajax({
              url:"<?= base_url('admin/updateCategory'); ?>",
              method:"POST",
              data:{id:id, text:text, colum_name:colum_name},
              dataType:"text",
              success:function(data){
                $.amaran({
                  'theme': 'awesome ok',
                  'content': {
                    title: '<?= $this->lang->line('notify_title_success'); ?>',
                    message: '<?= $this->lang->line('notify_category_updated'); ?>',
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
                  title: '<?= $this->lang->line('notify_title_warning'); ?>',
                  message: '<?= $this->lang->line('notify_title_empty'); ?>',
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
              url:"<?= base_url('admin/insertCategory'); ?>",
              method:"POST",
              data:{categoryname:categoryname},
              dataType:"text",
              success:function(){
                $.amaran({
                  'theme': 'awesome ok',
                  'content': {
                    title: '<?= $this->lang->line('notify_title_success'); ?>',
                    message: '<?= $this->lang->line('notify_category_added'); ?>',
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
                url:"<?= base_url('admin/deleteCategory'); ?>",
                method:"POST",
                data:{id:id},
                dataType:"text",
                success:function(data){
                  $.amaran({
                    'theme': 'awesome error',
                    'content': {
                      title: '<?= $this->lang->line('notify_title_success'); ?>',
                      message: '<?= $this->lang->line('notify_category_deleted'); ?>',
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
