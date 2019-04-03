<?php
if (isset($_POST['button_delSlide'])):
  $this->admin_model->delSpecifySlide($_POST['button_delSlide']);
endif; ?>

    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-images"></i> <?= $this->lang->line('admin_nav_manage_slides'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="javascript:void(0)" class="uk-icon-button" uk-toggle="target: #newSlide"><i class="fas fa-cog"></i></a>
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
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-overflow-auto">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-table-expand"><?= $this->lang->line('placeholder_title'); ?></th>
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_action'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($this->admin_model->getAdminSlideList()->result() as $slides): ?>
                <tr>
                  <td><?= $slides->title ?></td>
                  <td>
                    <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                      <a href="" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-edit"></i></a>
                      <form action="" method="post" accept-charset="utf-8">
                        <button class="uk-button uk-button-danger" name="button_delSlide" value="<?= $slides->id ?>" type="submit"><i class="fas fa-trash-alt"></i></button>
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
    </section>
