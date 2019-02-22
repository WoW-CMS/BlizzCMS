<?php
if (isset($_POST['button_createPage'])):
  $desc = $_POST['page_description'];
  $title  = $_POST['page_title'];

  $this->admin_model->insertPage($title, $desc);
endif; ?>

      <div id="newPage" uk-modal="bg-close: false">
        <div class="uk-modal-dialog">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="uk-modal-header">
            <h3 class="uk-modal-title uk-text-uppercase"><i class="fas fa-file-alt"></i> <?= $this->lang->line('form_create_pages'); ?></h3>
          </div>
          <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
            <div class="uk-modal-body">
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_title'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                    <input class="uk-input" name="page_title" required type="text" placeholder="<?= $this->lang->line('form_title'); ?>">
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_description'); ?></label>
                <div class="uk-form-controls">
                  <textarea class="uk-textarea tinyeditor" name="page_description" rows="10" cols="80"></textarea>
                </div>
              </div>
            </div>
            <div class="uk-modal-footer uk-text-right actions">
              <button class="uk-button uk-button-danger uk-modal-close" type="button"><?= $this->lang->line('button_cancel'); ?></button>
              <button class="uk-button uk-button-primary" type="submit" name="button_createPage"><?= $this->lang->line('button_create'); ?></button>
            </div>
          </form>
        </div>
      </div>
