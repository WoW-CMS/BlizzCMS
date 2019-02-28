<?php
if (isset($_POST['button_updateForum'])):
  $name = $_POST['forum_name'];
  $desc = $_POST['forum_description'];
  $icon = $_POST['forum_icon'];
  $type = $_POST['forum_type'];
  $cate = $_POST['forum_cate'];

  $this->admin_model->updateSpecifyForum($idlink, $name, $cate, $desc, $icon, $type);
endif; ?>

      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-edit"></i></span><?= $this->lang->line('panel_admin_edit_forum'); ?></h4>
                </div>
                <div class="uk-width-expand uk-text-right">
                  <a href="<?= base_url('admin/manageforums'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
                </div>
              </div>
            </div>
            <div class="uk-card-body">
              <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_forum_title'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                      <input class="uk-input" name="forum_name" type="text" value="<?= $this->admin_model->getSpecifyForumName($idlink); ?>" placeholder="<?= $this->lang->line('form_forum_title'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_forum_description'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <input class="uk-input" name="forum_description" type="text" value="<?= $this->admin_model->getSpecifyForumDesc($idlink); ?>" placeholder="<?= $this->lang->line('form_forum_description'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_forum_icon_name'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <input class="uk-input" name="forum_icon" type="text" value="<?= $this->admin_model->getSpecifyForumIcon($idlink); ?>" placeholder="<?= $this->lang->line('placeholder_forum_icon'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_type'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="forum_type">
                      <option value="1" <?php if($this->admin_model->getSpecifyForumType($idlink) == '1') echo 'selected'; ?>><?= $this->lang->line('option_everyone'); ?></option>
                      <option value="2" <?php if($this->admin_model->getSpecifyForumType($idlink) == '2') echo 'selected'; ?>><?= $this->lang->line('option_staff'); ?></option>
                      <option value="3" <?php if($this->admin_model->getSpecifyForumType($idlink) == '3') echo 'selected'; ?>><?= $this->lang->line('option_all'); ?></option>
                    </select>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_category'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="forum_cate">
                      <?php foreach($this->admin_model->getForumCategoryListAjax()->result() as $categ): ?>
                      <?php if ($categ->id == $this->admin_model->getSpecifyForumCategory($idlink)): ?>
                      <option value="<?= $categ->id ?>" selected><?= $categ->categoryName ?></option>
                      <?php else: ?>
                      <option value="<?= $categ->id ?>"><?= $categ->categoryName ?></option>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <button class="uk-button uk-button-primary uk-width-1-1" name="button_updateForum" type="submit"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_save'); ?></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
