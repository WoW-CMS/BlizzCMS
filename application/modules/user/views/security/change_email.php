<section class="uk-section uk-section-small bc-primary-section" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
          <li><a href="<?= site_url('user') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('user/security') ?>"><?= lang('security') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('email') ?></h1>
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
                <span class="bc-li-icon"><i class="<?= $item->icon ?>"></i></span><?= $item->name ?> <span uk-nav-parent-icon></span>
              </a>
              <ul class="uk-nav-sub">
                <?php foreach ($item->childs as $subitem): ?>
                <li class="<?= is_route_active($subitem->url) ? 'uk-active' : '' ?>">
                  <a target="<?= $subitem->target ?>" href="<?= $subitem->url ?>">
                    <span class="bc-li-icon"><i class="<?= $subitem->icon ?>"></i></span><?= $subitem->name ?>
                  </a>
                </li>
                <?php endforeach ?>
              </ul>
            </li>
            <?php elseif ($item->type === ITEM_LINK): ?>
            <li class="<?= is_route_active($item->url) ? 'uk-active' : '' ?>">
              <a target="<?= $item->target ?>" href="<?= $item->url ?>">
                <span class="bc-li-icon"><i class="<?= $item->icon ?>"></i></span><?= $item->name ?>
              </a>
            </li>
            <?php endif ?>
            <?php endforeach ?>
          </ul>
        </div>
      </div>
      <div class="uk-width-2-3@s uk-width-3-4@m">
        <?= $template['partials']['alerts'] ?>
        <?= form_open(current_url()) ?>
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <h3 class="uk-card-title"><i class="fa-solid fa-envelope"></i> <?= lang('email') ?></h3>
            </div>
            <div class="uk-card-body">
              <div class="uk-grid-small uk-margin-small" uk-grid>
                <div class="uk-width-1-1">
                  <label class="uk-form-label"><?= lang('new_email') ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fa-solid fa-envelope"></i></span>
                      <input class="uk-input" type="text" name="new_email" value="<?= set_value('new_email') ?>" placeholder="<?= lang('new_email') ?>" autocomplete="off">
                    </div>
                  </div>
                  <?= form_error('new_email', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
                <div class="uk-width-1-1">
                  <label class="uk-form-label"><?= lang('password') ?></label>
                  <div class="uk-form-controls">
                    <div class="uk-inline uk-width-1-1">
                      <span class="uk-form-icon"><i class="fa-solid fa-key"></i></span>
                      <input class="uk-input" type="password" name="password" placeholder="<?= lang('password') ?>" autocomplete="off">
                    </div>
                  </div>
                  <?= form_error('password', '<span class="uk-text-small uk-text-danger">', '</span>') ?>
                </div>
              </div>
            </div>
          </div>
          <button class="uk-button uk-button-default uk-margin-top" type="submit"><?= lang('change') ?></button>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</section>
