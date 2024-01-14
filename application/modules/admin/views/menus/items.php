<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/appearance') ?>"><?= lang('appearance') ?></a></li>
          <li><a href="<?= site_url('admin/menus') ?>"><?= lang('menus') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('menus') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <div class="uk-margin" uk-grid>
      <div class="uk-width-1-3@s uk-width-1-4@m">
        <div class="uk-card uk-card-default">
          <ul class="uk-nav-default" uk-nav>
            <li class="uk-nav-header"><?= lang('base') ?></li>
            <li><a href="<?= site_url('admin/appearance') ?>"><?= lang('themes') ?></a></li>
            <li><a href="<?= site_url('admin/languages') ?>"><?= lang('languages') ?></a></li>
            <li class="uk-nav-header"><?= lang('sections') ?></li>
            <li class="uk-active"><a href="<?= site_url('admin/menus') ?>"><?= lang('menus') ?></a></li>
            <li><a href="<?= site_url('admin/slides') ?>"><?= lang('slides') ?></a></li>
          </ul>
        </div>
      </div>
      <div class="uk-width-expand@s">
        <?= $template['partials']['alerts'] ?>
        <div class="uk-card uk-card-default uk-card-header uk-margin">
          <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
            <div class="uk-width-expand">
              <p class="uk-text-small uk-margin-remove"><?= lang('menu_builder') ?></p>
              <h3 class="uk-card-title uk-margin-remove"><?= html_escape($menu->name) ?></h3>
            </div>
            <div class="uk-width-auto">
              <a href="<?= site_url('admin/menus/'.$menu->id.'/add') ?>" class="uk-button uk-button-default uk-button-small"><i class="fa-solid fa-pen"></i> <?= lang('add') ?></a>
            </div>
          </div>
        </div>
        <div class="uk-grid-small uk-child-width-1-1" uk-grid>
          <?php foreach ($items as $item): ?>
          <div>
            <div class="uk-card uk-card-default uk-card-body">
              <div class="uk-flex uk-flex-middle" uk-grid>
                <div class="uk-width-auto">
                  <div class="uk-button-vertical-group">
                    <?php if ((int) $item->sort > 1): ?>
                    <a href="<?= site_url('admin/menus/'.$menu->id.'/move/'.$item->id.'/up') ?>" class="uk-button uk-button-default bc-button-xsmall"><i class="fa-solid fa-caret-up"></i></a>
                    <?php else: ?>
                    <button class="uk-button uk-button-default bc-button-xsmall" type="button" disabled><i class="fa-solid fa-caret-up"></i></button>
                    <?php endif ?>
                    <?php if ((int) $item->sort < $this->menu_item_model->last_item_sort($item->menu_id, $item->parent)): ?>
                    <a href="<?= site_url('admin/menus/'.$menu->id.'/move/'.$item->id.'/down') ?>" class="uk-button uk-button-default bc-button-xsmall"><i class="fa-solid fa-caret-down"></i></a>
                    <?php else: ?>
                    <button class="uk-button uk-button-default bc-button-xsmall" type="button" disabled><i class="fa-solid fa-caret-down"></i></button>
                    <?php endif ?>
                  </div>
                </div>
                <div class="uk-width-expand">
                  <h5 class="uk-text-bold uk-margin-remove"><?= html_escape($item->name) ?></h5>
                  <p class="uk-text-small uk-text-uppercase uk-margin-remove">
                    <?= $item->type === ITEM_DROPDOWN ? '<i class="fa-solid fa-list"></i>' : '<i class="fa-solid fa-link"></i>' ?> <?= $item->type ?>
                  </p>
                </div>
                <div class="uk-width-auto">
                  <div class="uk-button-group">
                    <a href="<?= site_url('admin/menus/'.$menu->id.'/edit/'.$item->id) ?>" class="uk-button uk-button-primary uk-button-small"><?= lang('edit') ?></a>
                    <div class="uk-inline">
                      <button class="uk-button uk-button-primary uk-button-small" type="button"><i class="fa-solid fa-caret-down"></i></button>
                      <div uk-dropdown="mode: click; boundary: ! .uk-container">
                        <ul class="uk-nav uk-dropdown-nav">
                          <li><a href="<?= site_url('admin/menus/'.$menu->id.'/delete/'.$item->id) ?>" class="uk-text-danger"><span class="bc-li-icon"><i class="fa-solid fa-trash-can"></i></span><?= lang('delete') ?></a></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php if ($item->type === ITEM_DROPDOWN && ! empty($this->menu_item_model->find_all(['menu_id'=> $menu->id, 'parent' => $item->id]))): ?>
            <div class="uk-grid-small uk-margin-small" uk-grid>
              <div class="uk-width-auto">
                <div class="uk-padding-small"></div>
              </div>
              <div class="uk-width-expand">
                <div class="uk-grid-small uk-child-width-1-1" uk-grid>
                  <?php foreach ($this->menu_item_model->find_all(['menu_id'=> $menu->id, 'parent' => $item->id]) as $subitem): ?>
                  <div>
                    <div class="uk-card uk-card-default uk-card-body">
                      <div class="uk-flex uk-flex-middle" uk-grid>
                        <div class="uk-width-auto">
                          <div class="uk-button-vertical-group">
                            <?php if ($subitem->sort > 1): ?>
                            <a href="<?= site_url('admin/menus/'.$menu->id.'/move/'.$subitem->id.'/up') ?>" class="uk-button uk-button-default bc-button-xsmall"><i class="fa-solid fa-caret-up"></i></a>
                            <?php else: ?>
                            <button class="uk-button uk-button-default bc-button-xsmall" type="button" disabled><i class="fa-solid fa-caret-up"></i></button>
                            <?php endif ?>
                            <?php if ($subitem->sort < $this->menu_item_model->last_item_sort($subitem->menu_id, $subitem->parent)): ?>
                            <a href="<?= site_url('admin/menus/'.$menu->id.'/move/'.$subitem->id.'/down') ?>" class="uk-button uk-button-default bc-button-xsmall"><i class="fa-solid fa-caret-down"></i></a>
                            <?php else: ?>
                            <button class="uk-button uk-button-default bc-button-xsmall" type="button" disabled><i class="fa-solid fa-caret-down"></i></button>
                            <?php endif ?>
                          </div>
                        </div>
                        <div class="uk-width-expand">
                          <h5 class="uk-text-bold uk-margin-remove"><?= html_escape($subitem->name) ?></h5>
                          <p class="uk-text-small uk-text-uppercase uk-margin-remove">
                            <?= $subitem->type === ITEM_DROPDOWN ? '<i class="fa-solid fa-list"></i>' : '<i class="fa-solid fa-link"></i>' ?> <?= $subitem->type ?>
                          </p>
                        </div>
                        <div class="uk-width-auto">
                          <div class="uk-button-group">
                            <a href="<?= site_url('admin/menus/'.$menu->id.'/edit/'.$subitem->id) ?>" class="uk-button uk-button-primary uk-button-small"><?= lang('edit') ?></a>
                            <div class="uk-inline">
                              <button class="uk-button uk-button-primary uk-button-small" type="button"><i class="fa-solid fa-caret-down"></i></button>
                              <div uk-dropdown="mode: click; boundary: ! .uk-container">
                                <ul class="uk-nav uk-dropdown-nav">
                                  <li><a href="<?= site_url('admin/menus/'.$menu->id.'/delete/'.$subitem->id) ?>" class="uk-text-danger"><span class="bc-li-icon"><i class="fa-solid fa-trash-can"></i></span><?= lang('delete') ?></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php endforeach ?>
                </div>
              </div>
            </div>
            <?php endif ?>
          </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
</section>
