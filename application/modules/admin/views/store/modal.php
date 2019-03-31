<?php
if (isset($_POST['button_createGroup'])):
  $name = $_POST['group_name'];

  $this->admin_model->insertGroup($name);
endif;

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

      <div id="newGroup" uk-modal="bg-close: false">
        <div class="uk-modal-dialog">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="uk-modal-header">
            <h3 class="uk-modal-title uk-text-uppercase"><i class="fas fa-object-group"></i> <?= $this->lang->line('placeholder_create_group'); ?></h3>
          </div>
          <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
            <div class="uk-modal-body">
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_group_title'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                    <input class="uk-input" name="group_name" required type="text" placeholder="<?= $this->lang->line('placeholder_group_title'); ?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-modal-footer uk-text-right actions">
              <button class="uk-button uk-button-danger uk-modal-close" type="button"><?= $this->lang->line('button_cancel'); ?></button>
              <button class="uk-button uk-button-primary" type="submit" name="button_createGroup"><?= $this->lang->line('button_create'); ?></button>
            </div>
          </form>
        </div>
      </div>

      <div id="newItem" uk-modal="bg-close: false">
        <div class="uk-modal-dialog">
          <button class="uk-modal-close-default" type="button" uk-close></button>
          <div class="uk-modal-header">
            <h3 class="uk-modal-title uk-text-uppercase"><i class="fas fa-tag"></i> <?= $this->lang->line('placeholder_create_item'); ?></h3>
          </div>
          <form action="" method="post" enctype="multipart/form-data" accept-charset="utf-8" autocomplete="off">
            <div class="uk-modal-body">
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?= $this->lang->line('placeholder_store_item_name'); ?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: pencil"></span>
                    <input class="uk-input" name="itemname" required type="text" placeholder="<?= $this->lang->line('placeholder_store_item_name'); ?>">
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
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('store_item_price');?> DP</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" name="priceDP" type="number" placeholder="0" value="0" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('store_item_price');?> VP</label>
                    <div class="uk-form-controls">
                      <input class="uk-input" name="priceVP" type="number" placeholder="0" value="0" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <div class="uk-grid uk-grid-small" data-uk-grid>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('placeholder_store_item_id');?></label>
                    <div class="uk-form-controls">
                      <input class="uk-input" name="itemID" type="text" placeholder="Item Id" required>
                    </div>
                  </div>
                  <div class="uk-inline uk-width-1-2@s">
                    <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('placeholder_forum_icon_name');?></label>
                    <div class="uk-form-controls">
                      <input class="uk-input" name="iconName" type="text" placeholder="inv_belt_45" value="inv_belt_45" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-margin-small">
                <label class="uk-form-label uk-text-uppercase"><?=$this->lang->line('placeholder_store_image_name');?></label>
                <div class="uk-form-controls">
                  <div class="uk-inline uk-width-1-1">
                    <input class="uk-input" name="imageName" type="text" placeholder="image.jpg" value="image.jpg">
                  </div>
                </div>
              </div>
            </div>
            <div class="uk-modal-footer uk-text-right actions">
              <button class="uk-button uk-button-danger uk-modal-close" type="button"><?= $this->lang->line('button_cancel'); ?></button>
              <button class="uk-button uk-button-primary" type="submit" name="button_createItem"><?= $this->lang->line('button_create'); ?></button>
            </div>
          </form>
        </div>
      </div>
