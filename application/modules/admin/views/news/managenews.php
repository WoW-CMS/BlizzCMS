<?php
if (isset($_POST['button_delNew'])):
  $this->admin_model->delSpecifyNew($_POST['button_delNew']);
endif; ?>

      <?= $tiny ?>
      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
          <?php if(isset($_POST['button_createNew'])) {
            $title = $_POST['new_title'];
            $desc  = $_POST['new_description'];
            $type  = $_POST['new_destac'];
            $image = $_FILES["new_imageup"];

            if ($image['type'] == 'image/jpeg')
            {
              $random = $this->m_data->randomUTF();
              $name_new = sha1($image['name'].$random).'.jpg';

              move_uploaded_file($image["tmp_name"], "./includes/images/news/" . $name_new);

              $this->admin_model->insertNews($title, $name_new, $desc, $type);
            }
            elseif($image['type'] == 'image/png') {
              $random = $this->m_data->randomUTF();
              $name_new = sha1($image['name'].$random).'.png';

              move_uploaded_file($image["tmp_name"], "./includes/images/news/" . $name_new);

              $this->admin_model->insertNews($title, $name_new, $desc, $type);
            }
            else
              echo '<div class="uk-width-1-1@l uk-width-1-1@xl"><div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><p><i class="fas fa-exclamation-circle"></i> '.$this->lang->line('image_upload_error').'</p></div></div>';
          } ?>
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-newspaper"></i></span><?= $this->lang->line('card_title_news_list'); ?></h4>
                </div>
                <div class="uk-width-expand uk-text-right">
                  <a href="javascript:void(0)" class="uk-icon-button" uk-toggle="target: #newNews"><i class="fas fa-pen"></i></a>
                </div>
              </div>
            </div>
            <div class="uk-card-body">
              <div class="uk-overflow-auto uk-margin-small">
                <table class="uk-table uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-table-expand"><?= $this->lang->line('placeholder_title'); ?></th>
                      <th class="uk-width-small"><?= $this->lang->line('table_header_date'); ?></th>
                      <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_action'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($this->admin_model->getAdminNewsList()->result() as $news): ?>
                    <tr>
                      <td><?= $news->title ?></td>
                      <td><?= date('Y-m-d', $news->date); ?></td>
                      <td>
                        <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                        <a href="<?= base_url('admin/editnews/'.$news->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-edit"></i></a>
                        <form action="" method="post" accept-charset="utf-8">
                          <button class="uk-button uk-button-danger" name="button_delNew" value="<?= $news->id ?>" type="submit"><i class="fas fa-trash-alt"></i></button>
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
