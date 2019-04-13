    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="far fa-image"></i> Add Image to Slideshow</h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/slides'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <?php if(isset($_POST['button_createSlide'])) {
          $title = $_POST['slide_title'];
          $image = $_FILES["slide_imageup"];

          if ($image['type'] == 'image/jpeg')
          {
            $random = $this->m_data->randomUTF();
            $name_slider = sha1($image['name'].$random).'.jpg';

            move_uploaded_file($image["tmp_name"], "./assets/images/slides/" . $name_slider);

            $this->admin_model->insertNewSlides($title, $name_slider);
          }
          elseif($image['type'] == 'image/png') {
            $random = $this->m_data->randomUTF();
            $name_new = sha1($image['name'].$random).'.png';

            move_uploaded_file($image["tmp_name"], "./assets/images/slides/" . $name_slider);

            $this->admin_model->insertNewSlides($title, $name_slider);
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
                    <input class="uk-input" type="text" name="slide_title" placeholder="<?= $this->lang->line('placeholder_title'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label"><?= $this->lang->line('placeholder_upload_file'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <div uk-form-custom="target: true">
                      <input type="file" required name="slide_imageup">
                      <input class="uk-input uk-form-width-medium" type="text" placeholder="Select file" disabled>
                      <button class="uk-button uk-button-primary" type="button" tabindex="-1"><i class="fas fa-file-upload"></i> Select</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <button class="uk-button uk-button-primary uk-width-1-1" name="button_createSlide" type="submit"><i class="fas fa-check-circle"></i> <?= $this->lang->line('button_create'); ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
