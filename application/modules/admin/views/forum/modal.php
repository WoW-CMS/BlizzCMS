<?php
if (isset($_POST['button_createForum'])):
  $name = $_POST['forum_name'];
  $desc = $_POST['forum_description'];
  $icon = $_POST['forum_icon'];
  $type = $_POST['forum_type'];
  $cate = $_POST['forum_cate'];

  $this->admin_model->insertForum($name, $cate, $desc, $icon, $type);
endif; ?>

      <div id="newForum" uk-modal="bg-close: false">
        <div class="uk-modal-dialog">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="uk-modal-header">
            <h3 class="uk-modal-title uk-text-uppercase"><i class="far fa-comments"></i> <?= $this->lang->line('placeholder_create_forums'); ?></h3>
          </div>
          <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
            <div class="uk-modal-body">
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_forum_title'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                    <input class="uk-input" name="forum_name" type="text" placeholder="<?= $this->lang->line('placeholder_forum_title'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_forum_description'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <input class="uk-input" name="forum_description" required type="text" placeholder="<?= $this->lang->line('placeholder_forum_description'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_forum_icon_name'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <input class="uk-input" name="forum_icon" required type="text" placeholder="<?= $this->lang->line('placeholder_forum_icon'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_type'); ?></label>
                <div class="uk-form-controls">
                  <select class="uk-select" name="forum_type">
                    <option value="1"><?= $this->lang->line('option_everyone'); ?></option>
                    <option value="2"><?= $this->lang->line('option_staff'); ?></option>
                    <option value="3"><?= $this->lang->line('option_all'); ?></option>
                  </select>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_category'); ?></label>
                <div class="uk-form-controls">
                  <select class="uk-select" name="forum_cate">
                    <?php foreach($this->admin_model->getForumCategoryListAjax()->result() as $categ): ?>
                    <option value="<?= $categ->id ?>"><?= $categ->categoryName ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="uk-modal-footer uk-text-right actions">
              <button class="uk-button uk-button-danger uk-modal-close" type="button"><?= $this->lang->line('button_cancel'); ?></button>
              <button class="uk-button uk-button-primary" type="submit" name="button_createForum"><?= $this->lang->line('button_create'); ?></button>
            </div>
          </form>
        </div>
      </div>
