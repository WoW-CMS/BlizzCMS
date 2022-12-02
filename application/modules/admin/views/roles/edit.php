<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/roles') ?>"><?= lang('roles') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('edit_role') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <?= form_open(current_url()) ?>
      <div class="uk-card uk-card-default">
        <div class="uk-card-body">
          <div class="uk-grid-small uk-margin-small" uk-grid>
            <div class="uk-width-1-1">
              <label class="uk-form-label"><?= lang('name') ?></label>
              <div class="uk-form-controls">
                <input class="uk-input" type="text" name="name" value="<?= $role->name ?>" placeholder="<?= lang('name') ?>" autocomplete="off">
              </div>
              <?= form_error('name', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
            <div class="uk-width-1-1">
              <label class="uk-form-label"><?= lang('description') ?></label>
              <div class="uk-form-controls">
                <textarea class="uk-textarea" name="description" rows="3" autocomplete="off"><?= $role->description ?></textarea>
              </div>
              <?= form_error('description', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
            </div>
          </div>
        </div>
      </div>
      <div class="uk-margin" uk-grid>
        <div class="uk-width-1-3@s uk-width-1-4@m">
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <h3 class="uk-card-title"><?= lang('permissions') ?></h3>
            </div>
            <ul class="uk-nav uk-nav-default" uk-switcher="connect: #perms_container; animation: uk-animation-fade">
              <li><a href="#"><?= lang('base') ?></a></li>
              <li><a href="#"><?= lang('admin') ?></a></li>
              <li><a href="#"><?= lang('user') ?></a></li>
              <li><a href="#"><?= lang('pages') ?></a></li>
              <li><a href="#"><?= lang('menus') ?></a></li>
              <li><a href="#"><?= lang('modules') ?></a></li>
            </ul>
          </div>
        </div>
        <div class="uk-width-2-3@s uk-width-3-4@m">
          <ul id="perms_container" class="uk-switcher uk-margin">
            <li>
              <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s" uk-grid>
                <?php foreach ($base as $item): ?>
                <div>
                  <div class="uk-card uk-card-default">
                    <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                      <div class="uk-width-expand">
                        <h6 class="uk-h6 uk-text-bold uk-text-truncate uk-margin-remove"><?= $item['description'] ?></h6>
                        <p class="uk-text-small uk-margin-remove"><?= lang('key') ?>: <span class="uk-text-bold uk-text-primary"><?= $item['key'] ?></span></p>
                      </div>
                      <div class="uk-width-auto">
                        <label class="uk-switch uk-display-block">
                          <input type="checkbox" name="permissions[]" value="<?= $item['id'] ?>" <?= set_checkbox('permissions[]', $item['id'], $item['checked']) ?>>
                          <div class="uk-switch-slider"></div>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endforeach ?>
              </div>
            </li>
            <li>
              <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s" uk-grid>
                <?php foreach ($admin as $item): ?>
                <div>
                  <div class="uk-card uk-card-default">
                    <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                      <div class="uk-width-expand">
                        <h6 class="uk-h6 uk-text-bold uk-text-truncate uk-margin-remove"><?= $item['description'] ?></h6>
                        <p class="uk-text-small uk-margin-remove"><?= lang('key') ?>: <span class="uk-text-bold uk-text-primary"><?= $item['key'] ?></span></p>
                      </div>
                      <div class="uk-width-auto">
                        <label class="uk-switch uk-display-block">
                          <input type="checkbox" name="permissions[]" value="<?= $item['id'] ?>" <?= set_checkbox('permissions[]', $item['id'], $item['checked']) ?>>
                          <div class="uk-switch-slider"></div>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endforeach ?>
              </div>
            </li>
            <li>
              <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s" uk-grid>
                <?php foreach ($user as $item): ?>
                <div>
                  <div class="uk-card uk-card-default">
                    <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                      <div class="uk-width-expand">
                        <h6 class="uk-h6 uk-text-bold uk-text-truncate uk-margin-remove"><?= $item['description'] ?></h6>
                        <p class="uk-text-small uk-margin-remove"><?= lang('key') ?>: <span class="uk-text-bold uk-text-primary"><?= $item['key'] ?></span></p>
                      </div>
                      <div class="uk-width-auto">
                        <label class="uk-switch uk-display-block">
                          <input type="checkbox" name="permissions[]" value="<?= $item['id'] ?>" <?= set_checkbox('permissions[]', $item['id'], $item['checked']) ?>>
                          <div class="uk-switch-slider"></div>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endforeach ?>
              </div>
            </li>
            <li>
              <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@s" uk-grid>
                <?php foreach ($pages as $item): ?>
                <div>
                  <div class="uk-card uk-card-default">
                    <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                      <div class="uk-width-expand">
                        <h6 class="uk-h6 uk-text-bold uk-text-truncate uk-margin-remove"><?= $item['description'] ?></h6>
                        <p class="uk-text-small uk-margin-remove"><?= lang('key') ?>: <span class="uk-text-bold uk-text-primary"><?= $item['key'] ?></span></p>
                      </div>
                      <div class="uk-width-auto">
                        <label class="uk-switch uk-display-block">
                          <input type="checkbox" name="permissions[]" value="<?= $item['id'] ?>" <?= set_checkbox('permissions[]', $item['id'], $item['checked']) ?>>
                          <div class="uk-switch-slider"></div>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <?php endforeach ?>
              </div>
            </li>
            <li>
              <ul class="uk-margin" uk-accordion>
                <li class="uk-open">
                  <a class="uk-accordion-title" href="#"><i class="fa-solid fa-grip"></i> <?= lang('menus') ?></a>
                  <div class="uk-accordion-content">
                    <ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: #menus_container; animation: uk-animation-fade" uk-margin>
                      <?php foreach ($menus as $key => $menu): ?>
                      <li><a href="#"><?= html_escape($key) ?></a></li>
                      <?php endforeach ?>
                    </ul>
                  </div>
                </li>
              </ul>
              <ul id="menus_container" class="uk-switcher">
                <?php foreach ($menus as $key => $menu): ?>
                <li>
                  <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@m uk-margin-small" uk-grid>
                    <?php foreach ($menu as $item): ?>
                    <div>
                      <div class="uk-card uk-card-default">
                        <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                          <div class="uk-width-expand">
                            <h6 class="uk-h6 uk-text-bold uk-text-truncate uk-margin-remove"><?= $item['description'] ?></h6>
                            <p class="uk-text-small uk-margin-remove"><?= lang('key') ?>: <span class="uk-text-bold uk-text-primary"><?= $item['key'] ?></span></p>
                          </div>
                          <div class="uk-width-auto">
                            <label class="uk-switch uk-display-block">
                              <input type="checkbox" name="permissions[]" value="<?= $item['id'] ?>" <?= set_checkbox('permissions[]', $item['id'], $item['checked']) ?>>
                              <div class="uk-switch-slider"></div>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach ?>
                  </div>
                </li>
                <?php endforeach ?>
              </ul>
            </li>
            <li>
              <ul class="uk-margin" uk-accordion>
                <li class="uk-open">
                  <a class="uk-accordion-title" href="#"><i class="fa-solid fa-grip"></i> <?= lang('modules') ?></a>
                  <div class="uk-accordion-content">
                    <ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: #mods_container; animation: uk-animation-fade" uk-margin>
                      <?php foreach ($modules as $key => $mod): ?>
                      <li><a href="#"><?= html_escape($key) ?></a></li>
                      <?php endforeach ?>
                    </ul>
                  </div>
                </li>
              </ul>
              <ul id="mods_container" class="uk-switcher">
                <?php foreach ($modules as $key => $mod): ?>
                <li>
                  <div class="uk-grid-small uk-child-width-1-1 uk-child-width-1-2@m uk-margin-small" uk-grid>
                    <?php foreach ($mod as $item): ?>
                    <div>
                      <div class="uk-card uk-card-default">
                        <div class="uk-grid-small uk-flex uk-flex-middle uk-padding-small" uk-grid>
                          <div class="uk-width-expand">
                            <h6 class="uk-h6 uk-text-bold uk-text-truncate uk-margin-remove"><?= $item['description'] ?></h6>
                            <p class="uk-text-small uk-margin-remove"><?= lang('key') ?>: <span class="uk-text-bold uk-text-primary"><?= $item['key'] ?></span></p>
                          </div>
                          <div class="uk-width-auto">
                            <label class="uk-switch uk-display-block">
                              <input type="checkbox" name="permissions[]" value="<?= $item['id'] ?>" <?= set_checkbox('permissions[]', $item['id'], $item['checked']) ?>>
                              <div class="uk-switch-slider"></div>
                            </label>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php endforeach ?>
                  </div>
                </li>
                <?php endforeach ?>
              </ul>
            </li>
          </ul>
          <button class="uk-button uk-button-primary" type="submit"><?= lang('save') ?></button>
        </div>
      </div>
    <?= form_close() ?>
  </div>
</section>
