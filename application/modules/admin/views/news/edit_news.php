    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-edit"></i> <?= $this->lang->line('placeholder_edit_news'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/news'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <?php if(isset($_POST['button_upnews'])) {
          $title = $_POST['news_title'];
          $desc  = $_POST['news_description'];
          $image = $_FILES["news_image"];

          if ($image['type'] == 'image/jpeg')
          {
            $random = $this->wowauth->randomUTF();
            $name_new = sha1($image['name'].$random).'.jpg';

            move_uploaded_file($image["tmp_name"], "./assets/images/news/" . $name_new);

            $this->admin_model->updateSpecifyNews($idlink, $title, $desc, $name_new);
          }
          elseif($image['type'] == 'image/png') {
            $random = $this->wowauth->randomUTF();
            $name_new = sha1($image['name'].$random).'.png';

            move_uploaded_file($image["tmp_name"], "./assets/images/news/" . $name_new);

            $this->admin_model->updateSpecifyNews($idlink, $title, $desc, $name_new);
          }
          else
            echo '<div class="uk-width-1-1@l uk-width-1-1@xl"><div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('alert_upload_error').'</p></div></div>';
        } ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
              <div class="uk-margin-small">
                <label class="uk-form-label"><?= $this->lang->line('placeholder_title'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                    <input class="uk-input" type="text" name="news_title" value="<?= $this->admin_model->getNewsSpecifyName($idlink); ?>" placeholder="<?= $this->lang->line('placeholder_title'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label"><?= $this->lang->line('placeholder_description'); ?></label>
                <div class="uk-form-controls">
                  <textarea class="uk-textarea tinyeditor" name="news_description" rows="12"><?= $this->admin_model->getNewsSpecifyDesc($idlink); ?></textarea>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label"><?= $this->lang->line('placeholder_upload_image'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <div uk-form-custom="target: true">
                      <input type="file" name="news_image" required>
                      <input class="uk-input uk-form-width-medium" type="text" disabled>
                      <button class="uk-button uk-button-primary" type="button" tabindex="-1"><i class="fas fa-file-upload"></i> <?= $this->lang->line('button_select'); ?></button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <button class="uk-button uk-button-primary uk-width-1-1" type="submit" name="button_upnews"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_save'); ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <?= $tiny ?>
