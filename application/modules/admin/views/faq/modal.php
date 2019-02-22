<?php
if (isset($_POST['button_createFaq'])):
  $title  = $_POST['faq_title'];
  $type = $_POST['faq_type'];
  $description = $_POST['faq_description'];

  $this->admin_model->insertFaq($title, $type, $description);
endif; ?>

      <div id="newFaq" uk-modal="bg-close: false">
        <div class="uk-modal-dialog">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="uk-modal-header">
            <h3 class="uk-modal-title uk-text-uppercase"><i class="fas fa-question-circle"></i> <?= $this->lang->line('form_create_faq'); ?></h3>
          </div>
          <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
            <div class="uk-modal-body">
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_faq_title'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                    <input class="uk-input" name="faq_title" required type="text" placeholder="<?= $this->lang->line('form_faq_title'); ?>">
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_type'); ?></label>
                <div class="uk-form-controls">
                  <select class="uk-select" name="faq_type">
                    <?php foreach($this->admin_model->getFaqTypeList()->result() as $type): ?>
                    <option value="<?= $type->id ?>"><?= $type->title ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_description'); ?></label>
                <div class="uk-form-controls">
                  <textarea class="uk-textarea tinyeditor" name="faq_description" rows="10" cols="80"></textarea>
                </div>
              </div>
            </div>
            <div class="uk-modal-footer uk-text-right actions">
              <button class="uk-button uk-button-danger uk-modal-close" type="button"><?= $this->lang->line('button_cancel'); ?></button>
              <button class="uk-button uk-button-primary" type="submit" name="button_createFaq"><?= $this->lang->line('button_create'); ?></button>
            </div>
          </form>
        </div>
      </div>
