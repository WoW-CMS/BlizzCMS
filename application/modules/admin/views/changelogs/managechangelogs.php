<?php
if (isset($_POST['button_delChangelog'])):
  $this->admin_model->delChangelog($_POST['button_delChangelog']);
endif; ?>

    <script src="<?= base_url(); ?>core/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({
        selector: '.tinyeditor',
        menubar: false,
        plugins: ['advlist autolink autosave link image lists charmap preview hr searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media table contextmenu directionality emoticons textcolor paste fullpage textcolor colorpicker textpattern'],
        toolbar: 'insert unlink emoticons | undo redo | formatselect fontselect fontsizeselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | blockquote | removeformat'});
    </script>
      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
          <?php if(isset($_POST['button_createChangelog'])) {
            $title  = $_POST['chang_title'];
            $desc = $_POST['chang_description'];
            $image = $_FILES["chang_imageup"];

            if ($image['type'] == 'image/jpeg')
            {
              $random = $this->m_data->randomUTF();
              $name_img = sha1($image['name'].$random).'.jpg';

              move_uploaded_file($image["tmp_name"], "./includes/images/changelogs/" . $name_img);

              $this->admin_model->insertChangelog($title, $name_img, $desc);
            }
            else
              echo '<div class="uk-width-1-1@l uk-width-1-1@xl"><div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('image_upload_error').'</p></div></div>';
          } ?>
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span data-uk-icon="icon: list"></span> <?= $this->lang->line('panel_admin_changelogs_list'); ?></h4>
                </div>
                <div class="uk-width-expand uk-text-right">
                  <a href="javascript:void(0)" class="uk-icon-button" uk-icon="icon: pencil" uk-toggle="target: #newChangelog"></a>
                </div>
              </div>
            </div>
            <div class="uk-card-body">
              <div class="uk-overflow-auto uk-margin-small">
                <table class="uk-table uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-table-expand"><?= $this->lang->line('form_title'); ?></th>
                      <th class="uk-width-small"><?= $this->lang->line('column_date'); ?></th>
                      <th class="uk-width-small uk-text-center"><?= $this->lang->line('column_action'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($this->admin_model->getChangelogs() as $changelogs): ?>
                    <tr>
                      <td><?= $changelogs->title ?></td>
                      <td><?= date('Y-m-d', $changelogs->date); ?></td>
                      <td>
                        <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                        <a href="<?= base_url('admin/editchangelogs/'.$changelogs->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-edit"></i></a>
                        <form action="" method="post" accept-charset="utf-8">
                          <button class="uk-button uk-button-danger" name="button_delChangelog" value="<?= $changelogs->id ?>" type="submit"><i class="fas fa-trash-alt"></i></button>
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
