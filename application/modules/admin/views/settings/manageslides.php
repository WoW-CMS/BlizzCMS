<?php
if (isset($_POST['button_delSlide'])):
  $this->admin_model->delSpecifySlide($_POST['button_delSlide']);
endif; ?>

      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
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
              echo '<div class="uk-width-1-1@l uk-width-1-1@xl"><div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('image_upload_error').'</p></div></div>';
          } ?>
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-images"></i></span><?= $this->lang->line('admin_manage_slides'); ?></h4>
                </div>
                <div class="uk-width-expand uk-text-right">
                  <a href="javascript:void(0)" class="uk-icon-button" uk-toggle="target: #newSlide"><i class="fas fa-cog"></i></a>
                </div>
              </div>
            </div>
            <div class="uk-card-body">
              <div class="uk-overflow-auto uk-margin-small">
                <table class="uk-table uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-table-expand"><?= $this->lang->line('form_title'); ?></th>
                      <th class="uk-width-small uk-text-center"><?= $this->lang->line('column_action'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($this->admin_model->getAdminSlideList()->result() as $slides): ?>
                    <tr>
                      <td><?= $slides->title ?></td>
                      <td class="uk-text-center" uk-margin>
                        <form action="" method="post" accept-charset="utf-8">
                          <button class="uk-button uk-button-danger" name="button_delSlide" value="<?= $slides->id ?>" type="submit"><i class="fas fa-trash-alt"></i></button>
                        </form>
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
