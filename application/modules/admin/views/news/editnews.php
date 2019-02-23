    <script src="<?= base_url(); ?>core/tinymce/tinymce.min.js"></script>
    <script>tinymce.init({
        selector: '.tinyeditor',
        menubar: false,
        plugins: ['advlist autolink autosave link image lists charmap preview hr searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media table contextmenu directionality emoticons textcolor paste fullpage textcolor colorpicker textpattern'],
        toolbar: 'insert unlink emoticons | undo redo | formatselect fontselect fontsizeselect | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | blockquote | removeformat'});
    </script>
      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
          <?php if(isset($_POST['button_updateNews'])) {
            $title = $_POST['new_title'];
            $desc  = $_POST['new_description'];
            $type  = $_POST['new_destac'];
            $image = $_FILES["new_imageup"];

            if ($image['type'] == 'image/jpeg')
            {
              $random = $this->m_data->randomUTF();
              $name_new = sha1($image['name'].$random).'.jpg';

              move_uploaded_file($image["tmp_name"], "./includes/images/news/" . $name_new);

              $this->admin_model->updateSpecifyNews($idlink, $title, $name_new, $desc, $type);
            }
            elseif($image['type'] == 'image/png') {
              $random = $this->m_data->randomUTF();
              $name_new = sha1($image['name'].$random).'.png';

              move_uploaded_file($image["tmp_name"], "./includes/images/news/" . $name_new);

              $this->admin_model->updateSpecifyNews($idlink, $title, $name_new, $desc, $type);
            }
            else
              echo '<div class="uk-width-1-1@l uk-width-1-1@xl"><div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('image_upload_error').'</p></div></div>';
          } ?>
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-edit"></i></span><?= $this->lang->line('panel_admin_edit_news'); ?> - <?= $this->admin_model->getNewsSpecifyName($idlink); ?></h4>
                </div>
                <div class="uk-width-expand uk-text-right">
                  <a href="<?= base_url('admin/managenews'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
                </div>
              </div>
            </div>
            <div class="uk-card-body">
              <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_news_title'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                      <input class="uk-input" name="new_title" type="text" value="<?= $this->admin_model->getNewsSpecifyName($idlink); ?>" placeholder="<?= $this->lang->line('form_news_title'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_description'); ?></label>
                  <div class="uk-form-controls">
                    <textarea class="uk-textarea tinyeditor" name="new_description" rows="10" cols="80"><?= $this->admin_model->getNewsSpecifyDesc($idlink); ?></textarea>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_highl'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="new_destac">
                      <option value="1"><?= $this->lang->line('option_no'); ?></option>
                      <option value="2"><?= $this->lang->line('option_yes'); ?></option>
                    </select>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_upload_file'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <div uk-form-custom="target: true">
                        <input type="file" name="new_imageup" required>
                        <input class="uk-input uk-form-width-medium" type="text" placeholder="Select file" disabled>
                        <button class="uk-button uk-button-primary" type="button" tabindex="-1"><i class="fas fa-file-upload"></i> Select</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <button class="uk-button uk-button-primary uk-width-1-1" name="button_updateNews" type="submit"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_save'); ?></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
