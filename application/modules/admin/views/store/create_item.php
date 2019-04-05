<?php
if (isset($_POST['button_createItem'])):
  $itemname   = $_POST['itemname'];
  $category   = $_POST['categorySelect'];
  $type       = $_POST['type_store'];
  $pricedp    = $_POST['priceDP'];
  $pricevp    = $_POST['priceVP'];
  $itemid     = $_POST['itemID'];
  $iconname   = $_POST['iconName'];
  $imagename  = $_POST['imageName'];

  $this->admin_model->insertShop($itemid, $type, $itemname, $pricedp, $pricevp, $iconname, $category, $imagename);
endif; ?>

    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-tag"></i> <?= $this->lang->line('placeholder_create_item'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/items'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_store_item_name'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                    <input class="uk-input" name="itemname" type="text" placeholder="<?= $this->lang->line('placeholder_store_item_name'); ?>" required>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_category'); ?></label>
                <div class="uk-form-controls">
                  <select class="uk-select" name="categorySelect">
                    <?php foreach ($this->admin_model->getCategoryStore()->result() as $groupsStore): ?>
                    <option value="<?= $groupsStore->id ?>"><?= $groupsStore->name ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('placeholder_type');?></label>
                <div class="uk-form-controls">
                  <label><input class="uk-radio" type="radio" name="type_store" id="item1" value="1" checked> <?=$this->lang->line('option_item');?></label>
                </div>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid-small" uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('store_item_price');?> DP</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" name="priceDP" type="number" placeholder="0" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('store_item_price');?> VP</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" name="priceVP" type="number" placeholder="0" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid-small" uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('placeholder_store_item_id');?></label>
                    <div class="uk-form-controls">
                      <input class="uk-input" name="itemID" type="text" placeholder="Item Id" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('placeholder_forum_icon_name');?></label>
                    <div class="uk-form-controls">
                      <input class="uk-input" name="iconName" type="text" placeholder="inv_belt_45">
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('placeholder_store_image_name');?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <input class="uk-input" name="imageName" type="text" placeholder="image.jpg">
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <button class="uk-button uk-button-primary uk-width-1-1" name="button_createItem" type="submit"><i class="fas fa-check-circle"></i> <?= $this->lang->line('button_create'); ?></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
