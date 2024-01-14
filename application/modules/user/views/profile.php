<section class="uk-section uk-section-small bc-primary-section" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
          <li><a href="<?= site_url('user') ?>"><?= lang('dashboard') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('my_profile') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <div class="uk-margin" uk-grid>
      <div class="uk-width-1-3@s uk-width-1-4@m">
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h3 class="uk-card-title"><i class="fa-solid fa-rectangle-list"></i> <?= lang('menu') ?></h3>
          </div>
          <ul class="uk-nav-default" uk-nav>
            <?php foreach ($this->menu_model->display('panel') as $item): ?>
            <?php if ($item->type === ITEM_DROPDOWN): ?>
            <li class="uk-parent">
              <a href="#">
                <?= $item->icon !== '' ? '<span class="bc-li-icon"><i class="'.$item->icon.'"></i></span>' : '' ?>
                <?= $item->name ?> <span uk-nav-parent-icon></span>
              </a>
              <ul class="uk-nav-sub">
                <?php foreach ($item->childs as $subitem): ?>
                <li class="<?= is_route_active($subitem->url) ? 'uk-active' : '' ?>">
                  <a target="<?= $subitem->target ?>" href="<?= $subitem->url ?>">
                    <?= $subitem->icon !== '' ? '<span class="bc-li-icon"><i class="'.$subitem->icon.'"></i></span>' : '' ?>
                    <?= $subitem->name ?>
                  </a>
                </li>
                <?php endforeach ?>
              </ul>
            </li>
            <?php elseif ($item->type === ITEM_LINK): ?>
            <li class="<?= is_route_active($item->url) ? 'uk-active' : '' ?>">
              <a target="<?= $item->target ?>" href="<?= $item->url ?>">
                <?= $item->icon !== '' ? '<span class="bc-li-icon"><i class="'.$item->icon.'"></i></span>' : '' ?>
                <?= $item->name ?>
              </a>
            </li>
            <?php endif ?>
            <?php endforeach ?>
          </ul>
        </div>
      </div>
      <div class="uk-width-2-3@s uk-width-3-4@m">
        <?= $template['partials']['alerts'] ?>
        <?= form_open_multipart(current_url()) ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h3 class="uk-card-title"><?= lang('profile') ?></h3>
          </div>
          <div class="uk-card-body">
            <div class="uk-grid-small" uk-grid>
              <div class="uk-width-1-4@m">
                <div class="uk-text-center">
                  <div class="uk-flex uk-flex-center uk-margin-small">
                    <div class="uk-inline-clip uk-transition-toggle" tabindex="0">
                      <img id="avatar_img" class="uk-border-circle" src="<?= user_avatar() ?>" width="128" height="128" alt="<?= lang('avatar') ?>">
                      <div class="uk-transition-fade uk-position-cover uk-overlay uk-overlay-default uk-flex uk-flex-center uk-flex-middle">
                        <div class="uk-transition-slide-bottom-small uk-margin">
                          <div uk-form-custom>
                            <input type="file" id="avatar_input" name="file">
                            <span class="uk-link-reset"><i class="fa-solid fa-upload"></i> <?= lang('change') ?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <p class="uk-text-small uk-margin-small"><i class="fa-solid fa-circle-info"></i> <?= lang('avatar_photo_public') ?></p>
                </div>
              </div>
              <div class="uk-width-expand@m">
                <div class="uk-grid-small uk-margin-small" uk-grid>
                  <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('nickname') ?></label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" name="nickname" value="<?= set_value('nickname', $user->nickname) ?>" placeholder="<?= lang('nickname') ?>" autocomplete="off">
                    </div>
                    <?= form_error('nickname', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('username') ?></label>
                    <div class="uk-form-controls">
                      <input class="uk-input" type="text" value="<?= $user->username ?>" placeholder="<?= lang('username') ?>" autocomplete="off" disabled>
                    </div>
                  </div>
                  <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('language') ?></label>
                    <div class="uk-form-controls">
                      <select class="uk-select tail-single" id="select_language" name="language" autocomplete="off" data-placeholder="<?= lang('select_language') ?>">
                        <?php foreach ($languages as $key => $language): ?>
                        <option value="<?= $key ?>" <?= set_select('language', $key, $key === $user->language) ?>><?= $language['name'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>
                    <?= form_error('language', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                  </div>
                  <div class="uk-width-1-2@s">
                    <label class="uk-form-label"><?= lang('email') ?></label>
                    <div class="uk-form-controls">
                      <div class="uk-inline uk-width-1-1">
                        <a class="uk-form-icon uk-form-icon-flip" href="<?= site_url('user/security') ?>"><i class="fa-solid fa-pencil"></i></a>
                        <input class="uk-input" type="text" value="<?= $user->email ?>" placeholder="<?= lang('email') ?>" autocomplete="off" disabled>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button class="uk-button uk-button-default uk-margin-top" type="submit"><?= lang('update') ?></button>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</section>
