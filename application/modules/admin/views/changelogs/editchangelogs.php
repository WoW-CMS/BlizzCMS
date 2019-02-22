    <script src="<?= base_url(); ?>core/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({
        selector: '.tinyeditor',
        menubar: false,
        plugins: ['advlist autolink autosave link image lists charmap preview hr searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media table contextmenu directionality emoticons textcolor paste fullpage textcolor colorpicker textpattern'],
        toolbar: 'insert unlink emoticons | undo redo | formatselect fontselect fontsizeselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | blockquote | removeformat'});
    </script>
      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
          <?php if(isset($_POST['button_updateChangelog'])) {
            $title = $_POST['chang_title'];
            $desc  = $_POST['chang_description'];
            $image = $_FILES["chang_image"];

            if ($image['type'] == 'image/jpeg')
            {
              $random = $this->m_data->randomUTF();
              $img_chang = sha1($image['name'].$random).'.jpg';

              move_uploaded_file($image["tmp_name"], "./includes/images/changelogs/".$img_chang);

              $this->admin_model->updateSpecifyChangelog($idlink, $title, $desc, $img_chang);
            }
            else
              echo '<div class="uk-width-1-1@l uk-width-1-1@xl"><div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('image_upload_error').'</p></div></div>';
          } ?>
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span data-uk-icon="icon: file-edit"></span> <?= $this->lang->line('panel_admin_edit_changelogs'); ?> - <?= $this->admin_model->getChangelogSpecifyName($idlink); ?></h4>
                </div>
                <div class="uk-width-expand"></div>
              </div>
            </div>
            <div class="uk-card-body">
              <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_title'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                      <input class="uk-input" name="chang_title" type="text" value="<?= $this->admin_model->getChangelogSpecifyName($idlink); ?>" placeholder="<?= $this->lang->line('form_title'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_description'); ?></label>
                  <div class="uk-form-controls">
                    <textarea class="uk-textarea tinyeditor" name="chang_description" rows="10" cols="80"><?= $this->admin_model->getChangelogSpecifyDesc($idlink); ?></textarea>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_upload_file'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <div uk-form-custom="target: true">
                        <input type="file" required name="chang_image">
                        <input class="uk-input uk-form-width-medium" type="text" placeholder="Select file" disabled>
                        <button class="uk-button uk-button-primary" type="button" tabindex="-1"><i class="fas fa-file-upload"></i> Select</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <button class="uk-button uk-button-primary uk-width-1-1" name="button_updateChangelog" type="submit"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_save'); ?></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
