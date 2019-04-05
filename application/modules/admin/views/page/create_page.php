<?php
if (isset($_POST['button_createPage'])):
  $desc = $_POST['page_description'];
  $uri  = $_POST['page_uri'];
  $title  = $_POST['page_title'];
  if($this->admin_model->pagecheckUri($uri) == TRUE){
    $uri = $_POST['page_uri'];
    $rand = rand(5, 15);
    $uri2 = $uri."-".$rand;
    $this->admin_model->insertPage($uri2, $title, $desc);
  } else {
    $this->admin_model->insertPage($uri, $title, $desc);
  }
endif; ?>

    <?= $tiny ?>
    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-file-alt"></i> <?= $this->lang->line('placeholder_create_pages'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/pages'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_title'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                    <input class="uk-input" name="page_title" type="text" placeholder="<?= $this->lang->line('placeholder_title'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_uri'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: link"></span>
                    <input class="uk-input" name="page_uri" type="text" placeholder="<?= $this->lang->line('placeholder_uri'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_description'); ?></label>
                <div class="uk-form-controls">
                  <textarea class="uk-textarea tinyeditor" name="page_description" rows="10" cols="80"></textarea>
                </div>
              </div>
              <div class="uk-margin-small">
                <button class="uk-button uk-button-primary uk-width-1-1" name="button_createPage" type="submit"><i class="fas fa-check-circle"></i> <?= $this->lang->line('button_create'); ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
