<?php
if (isset($_POST['button_updateItem'])):
  $itemname   = $_POST['itemname'];
  $group      = $_POST['groupSelect'];
  $type       = $_POST['type_store'];
  $pricedp    = $_POST['priceDP'];
  $pricevp    = $_POST['priceVP'];
  $itemid     = $_POST['itemID'];
  $iconname   = $_POST['iconName'];
  $imagename  = $_POST['imageName'];
  $description = $_POST['description'];

  $this->admin_model->updateSpecifyItem($idlink, $itemname, $group, $type, $pricedp, $pricevp, $itemid, $iconname, $imagename, $description);
endif; ?>

      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-edit"></i></span><?= $this->lang->line('panel_admin_edit_item'); ?></h4>
                </div>
                <div class="uk-width-expand uk-text-right">
                  <a href="<?= base_url('admin/manageitems'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
                </div>
              </div>
            </div>
            <div class="uk-card-body">
              <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_store_item_name'); ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                      <input class="uk-input" name="itemname" type="text" value="<?= $this->admin_model->getItemSpecifyName($idlink); ?>" placeholder="<?= $this->lang->line('form_store_item_name'); ?>" required>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('form_category'); ?></label>
                  <div class="uk-form-controls">
                    <select class="uk-select" name="groupSelect">
                      <?php foreach ($this->admin_model->getCategoryStore()->result() as $groupsStore): ?>
                      <?php if ($groupsStore->id == $this->admin_model->getItemSpecifyGroup($idlink)): ?>
                      <option value="<?= $groupsStore->id ?>" selected><?= $groupsStore->name ?></option>
                      <?php else: ?>
                      <option value="<?= $groupsStore->id ?>"><?= $groupsStore->name ?></option>
                      <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('form_type');?></label>
                  <div class="uk-form-controls">
                    <label><input class="uk-radio" type="radio" name="type_store" id="item1" value="1" checked> <?=$this->lang->line('option_item');?></label>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('store_item_price');?> DP</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="priceDP" type="number" value="<?= $this->admin_model->getItemSpecifyDpPrice($idlink); ?>" placeholder="0" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('store_item_price');?> VP</label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="priceVP" type="number" value="<?= $this->admin_model->getItemSpecifyVpPrice($idlink); ?>" placeholder="0" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <div class="uk-grid-small" uk-grid>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('form_store_item_id');?></label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="itemID" type="text" value="<?= $this->admin_model->getItemSpecifyId($idlink); ?>" placeholder="Item Id" required>
                      </div>
                    </div>
                    <div class="uk-inline uk-width-1-2@s">
                      <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('form_forum_icon_name');?></label>
                      <div class="uk-form-controls">
                        <input class="uk-input" name="iconName" type="text" value="<?= $this->admin_model->getItemSpecifyIcon($idlink); ?>" placeholder="inv_belt_45">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="uk-margin-small">
                  <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('form_store_image_name');?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <input class="uk-input" name="imageName" type="text" value="<?= $this->admin_model->getItemSpecifyImg($idlink); ?>" placeholder="image.jpg">
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
