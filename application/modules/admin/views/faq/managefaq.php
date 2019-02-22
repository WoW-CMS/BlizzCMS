<?php
if (isset($_POST['button_delFaq'])):
  $this->admin_model->delSpecifyFaq($_POST['button_delFaq']);
endif; ?>

    <script src="<?= base_url('core/tinymce/tinymce.min.js'); ?>"></script>
    <script>tinymce.init({
        selector: '.tinyeditor',
        menubar: false,
        plugins: ['advlist autolink autosave link image lists charmap preview hr searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media table contextmenu directionality emoticons textcolor paste fullpage textcolor colorpicker textpattern'],
        toolbar: 'insert unlink emoticons | undo redo | formatselect fontselect fontsizeselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | blockquote | removeformat'});
    </script>
      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span data-uk-icon="icon: list"></span> <?= $this->lang->line('panel_admin_faq_list'); ?></h4>
                </div>
                <div class="uk-width-expand uk-text-right">
                  <a href="javascript:void(0)" class="uk-icon-button" uk-icon="icon: pencil" uk-toggle="target: #newFaq"></a>
                </div>
              </div>
            </div>
            <div class="uk-card-body">
              <div class="uk-overflow-auto uk-margin-small">
                <table class="uk-table uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-table-expand"><?= $this->lang->line('form_title'); ?></th>
                      <th class="uk-width-small"><?= $this->lang->line('column_type'); ?></th>
                      <th class="uk-width-small"><?= $this->lang->line('column_date'); ?></th>
                      <th class="uk-width-small uk-text-center"><?= $this->lang->line('column_action'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($this->admin_model->getFaq() as $faq): ?>
                    <tr>
                      <td><?= $faq->title ?></td>
                      <td><?= $this->admin_model->getFaqTypeName($faq->type); ?></td>
                      <td><?= date('Y-m-d', $faq->date); ?></td>
                      <td>
                        <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                        <a href="<?= base_url('admin/editfaq/'.$faq->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-edit"></i></a>
                        <form action="" method="post" accept-charset="utf-8">
                          <button class="uk-button uk-button-danger" name="button_delFaq" value="<?= $faq->id ?>" type="submit"><i class="fas fa-trash-alt"></i></button>
                        </form>
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
      </section>
