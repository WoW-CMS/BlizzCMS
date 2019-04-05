<?php
if (isset($_POST['button_createTopsite'])):
  $name = $_POST['topsite_name'];
  $url = $_POST['topsite_url'];
  $time = $_POST['topsite_time'];
  $points = $_POST['topsite_points'];
  $image = $_POST['topsite_image'];

  $this->admin_model->insertTopsite($name, $url, $time, $points, $image);
endif; ?>
    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-poll-h"></i> <?= $this->lang->line('placeholder_create_topsite'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/topsites'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
              <div class="uk-margin-small">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase">Topsite <?= $this->lang->line('table_header_name'); ?></label>
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
                    <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('table_header_time'); ?> (Hours)</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" name="topsite_time" type="number" min="1" placeholder="Hours" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('table_header_points'); ?></label>
                    <div class="uk-form-controls">
                      <input class="uk-input" name="topsite_points" type="number" min="1" placeholder="<?= $this->lang->line('table_header_points'); ?>" required>
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
              <div class="uk-margin-small">
                <button class="uk-button uk-button-primary uk-width-1-1" name="button_createTopsite" type="submit"><i class="fas fa-check-circle"></i> <?= $this->lang->line('button_create'); ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
