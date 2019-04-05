<?php
if (isset($_POST['button_createForum'])):
  $name = $_POST['forum_name'];
  $desc = $_POST['forum_description'];
  $icon = $_POST['forum_icon'];
  $type = $_POST['forum_type'];
  $cate = $_POST['forum_cate'];

  $this->admin_model->insertForum($name, $cate, $desc, $icon, $type);
endif; ?>

    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="far fa-comments"></i> <?= $this->lang->line('placeholder_create_forums'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/forums'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
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
                    <input class="uk-input" name="forum_description" type="text" placeholder="<?= $this->lang->line('placeholder_forum_description'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_forum_icon_name'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <input class="uk-input" name="forum_icon" type="text" placeholder="<?= $this->lang->line('placeholder_forum_icon'); ?>" required>
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
              <div class="uk-margin-small">
                <button class="uk-button uk-button-primary uk-width-1-1" name="button_createForum" type="submit"><i class="fas fa-check-circle"></i> <?= $this->lang->line('button_create'); ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
