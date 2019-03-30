<?php
if (isset($_POST['button_updateItem'])):
  $group   = $_POST['groupname'];

  $this->admin_model->updateSpecifyGroup($idlink, $group);
endif; ?>

      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-edit"></i></span><?= $this->lang->line('panel_admin_edit_group'); ?></h4>
                </div>
                <div class="uk-width-expand uk-text-right">
                  <a href="<?= base_url('admin/groups'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
                </div>
              </div>
            </div>
            <div class="uk-card-body">
              <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_group_title'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                      <input class="uk-input" name="groupname" type="text" value="<?= $this->admin_model->getGroupName($idlink); ?>" placeholder="<?= $this->lang->line('form_group_title'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <button class="uk-button uk-button-primary uk-width-1-1" name="button_updateItem" type="submit"><i class="fas fa-sync-alt"></i> <?= $this->lang->line('button_save'); ?></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
