<?php
if (isset($_POST['button_createTopsite'])):
  $name = $_POST['topsite_name'];
  $url = $_POST['topsite_url'];
  $time = $_POST['topsite_time'];
  $points = $_POST['topsite_points'];
  $image = $_POST['topsite_image'];

  $this->admin_model->insertTopsite($name, $url, $time, $points, $image);
endif; ?>

      <div id="newTopsite" uk-modal="bg-close: false">
        <div class="uk-modal-dialog">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="uk-modal-header">
            <h3 class="uk-modal-title uk-text-uppercase"><i class="fas fa-poll-h"></i> <?= $this->lang->line('form_create_topsite'); ?></h3>
          </div>
          <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
            <div class="uk-modal-body">
              <div class="uk-margin-small">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase">Topsite <?= $this->lang->line('column_name'); ?></label>
                    <div class="uk-form-controls">
                      <input class="uk-input" name="topsite_name" type="text" placeholder="Name" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase">Topsite URL</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" name="topsite_url" type="url" placeholder="URL" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('column_time'); ?> (Hours)</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" name="topsite_time" type="number" min="1" placeholder="Hours" value="1" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('column_points'); ?></label>
                    <div class="uk-form-controls">
                      <input class="uk-input" name="topsite_points" type="number" min="1" placeholder="<?= $this->lang->line('column_points'); ?>" value="1" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase">URL Image</label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <input class="uk-input" name="topsite_image" type="url" placeholder="http://example.com/image.jpg" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-modal-footer uk-text-right actions">
              <button class="uk-button uk-button-danger uk-modal-close" type="button"><?= $this->lang->line('button_cancel'); ?></button>
              <button class="uk-button uk-button-primary" type="submit" name="button_createTopsite"><?= $this->lang->line('button_create'); ?></button>
            </div>
          </form>
        </div>
      </div>
