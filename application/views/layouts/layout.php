<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $template['title'] ?></title>
    <link rel="icon" type="image/x-icon" href="<?= $template['assets'].'img/favicon.ico' ?>">
    <link rel="stylesheet" href="<?= $template['assets'].'css/uikit.min.css' ?>">
    <link rel="stylesheet" href="<?= $template['assets'].'css/tail.select.min.css' ?>">
    <link rel="stylesheet" href="<?= $template['assets'].'css/default.css' ?>">
    <script src="<?= $template['assets'].'js/uikit.min.js' ?>"></script>
    <script src="<?= $template['assets'].'js/uikit-icons.min.js' ?>"></script>
    <script src="<?= $template['assets'].'js/tail.select.min.js' ?>"></script>
    <script src="<?= $template['assets'].'js/purecounter.min.js' ?>"></script>
    <script src="<?= $template['assets'].'fontawesome/js/all.min.js' ?>" defer></script>
    <?= $template['head_tags'] ?>
  </head>
  <body>
    <nav class="uk-navbar-container uk-navbar-transparent">
      <div class="uk-container">
        <div uk-navbar>
          <div class="uk-navbar-left">
            <a href="<?= site_url() ?>" class="uk-navbar-item uk-logo"><?= config_item('app_name') ?></a>
          </div>
          <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
              <li>
                <a href="#">
                  <i class="fa-solid fa-language"></i> <span class="uk-text-uppercase"><?= $this->multilanguage->current_language('locale') ?></span>
                </a>
                <div class="uk-navbar-dropdown" uk-drop="boundary: ! .uk-container">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <?php foreach ($this->multilanguage->languages() as $lang): ?>
                    <li>
                      <a href="<?= site_url('lang/'.$lang['locale']) ?>"><?= $lang['name'] ?></a>
                    </li>
                    <?php endforeach ?>
                  </ul>
                </div>
              </li>
              <?php if (! is_logged_in()): ?>
              <li class="uk-visible@s">
                <a href="<?= site_url('login') ?>"><i class="fa-solid fa-right-to-bracket"></i> <?= lang('login') ?></a>
              </li>
              <?php else: ?>
              <li>
                <a href="#">
                  <img class="uk-border-circle" src="<?= user_avatar() ?>" width="32" height="32" alt="<?= lang('avatar') ?>">
                  <span class="uk-text-middle"><span uk-icon="icon: triangle-down"></span></span>
                </a>
                <div class="uk-navbar-dropdown" uk-drop="boundary: ! .uk-container">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li class="<?= is_route_active('user') ? 'uk-active' : '' ?>">
                      <a href="<?= site_url('user') ?>"><span class="bc-li-icon"><i class="fa-solid fa-circle-user"></i></span><?= lang('user_panel') ?></a>
                    </li>
                    <?php if (has_permission('view.admin', 'admin')): ?>
                    <li>
                      <a href="<?= site_url('admin') ?>"><span class="bc-li-icon"><i class="fa-solid fa-gear"></i></span><?= lang('admin_panel') ?></a>
                    </li>
                    <?php endif ?>
                    <li>
                      <a href="<?= site_url('logout') ?>"><span class="bc-li-icon"><i class="fa-solid fa-right-from-bracket"></i></span><?= lang('logout') ?></a>
                    </li>
                  </ul>
                </div>
              </li>
              <?php if (is_module_installed('store')): ?>
              <li>
                <a href="#">
                  <i class="fa-solid fa-cart-shopping"></i> <span class="uk-badge"><?= $this->cart->total_items() ?></span>
                </a>
                <div class="uk-navbar-dropdown" uk-drop="boundary: ! .uk-container">
                  <div class="cart-container">
                    <?php if ($this->cart->total_items()): ?>
                    <p class="uk-text-center uk-margin-small"><?= lang_vars('cart_have_products', [$this->cart->total_items()]) ?></p>
                    <a href="<?= site_url('store/cart') ?>" class="uk-button uk-button-default uk-button-small uk-width-1-1"><?= lang('view_cart') ?></a>
                    <?php else: ?>
                    <p class="uk-text-center uk-margin-remove"><?= lang('cart_is_empty') ?></p>
                    <?php endif ?>
                  </div>
                </div>
              </li>
              <?php endif ?>
              <?php endif ?>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <div class="uk-navbar-container">
      <div class="uk-container">
        <nav uk-navbar="mode: click">
          <div class="uk-navbar-left">
            <a href="#offcanvas_nav" class="uk-navbar-toggle uk-hidden@s" uk-navbar-toggle-icon uk-toggle></a>
            <ul class="uk-navbar-nav">
              <?php foreach ($this->menu_model->display() as $item): ?>
              <?php if ($item->type === ITEM_DROPDOWN): ?>
              <li class="uk-visible@s">
                <a href="#">
                  <?= $item->icon !== '' ? '<span class="bc-li-icon"><i class="'.$item->icon.'"></i></span>' : '' ?>
                  <?= $item->name ?> <span uk-navbar-parent-icon></span>
                </a>
                <div class="uk-navbar-dropdown" uk-drop="boundary: ! .uk-container">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <?php foreach ($item->childs as $subitem): ?>
                    <li class="<?= is_route_active($subitem->url) ? 'uk-active' : '' ?>">
                      <a target="<?= $subitem->target ?>" href="<?= $subitem->url ?>">
                        <?= $subitem->icon !== '' ? '<span class="bc-li-icon"><i class="'.$subitem->icon.'"></i></span>' : '' ?>
                        <?= $subitem->name ?>
                      </a>
                    </li>
                    <?php endforeach ?>
                  </ul>
                </div>
              </li>
              <?php elseif ($item->type === ITEM_LINK): ?>
              <li class="<?= is_route_active($item->url) ? 'uk-visible@s uk-active' : 'uk-visible@s' ?>">
                <a target="<?= $item->target ?>" href="<?= $item->url ?>">
                  <?= $item->icon !== '' ? '<span class="bc-li-icon"><i class="'.$item->icon.'"></i></span>' : '' ?>
                  <?= $item->name ?>
                </a>
              </li>
              <?php endif ?>
              <?php endforeach ?>
            </ul>
          </div>
          <div class="uk-navbar-right">
            <?php if (is_logged_in()): ?>
            <div class="uk-navbar-item">
              <ul class="uk-subnav uk-subnav-divider">
                <li>
                  <span class="bc-vp-points" uk-tooltip="title: <?= lang('voting_points') ?>;pos: bottom"><?= user('vp') ?></span>
                </li>
                <li>
                  <span class="bc-dp-points" uk-tooltip="title: <?= lang('donation_points') ?>;pos: bottom"><?= user('dp') ?></span>
                </li>
              </ul>
            </div>
            <?php endif ?>
          </div>
        </nav>
      </div>
    </div>

    <?= $template['body'] ?>

    <footer class="uk-section uk-section-xsmall bc-footer-section">
      <div class="uk-container">
        <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
          <div class="uk-width-auto@s">
            <p class="uk-text-small uk-text-bold uk-text-center uk-text-left@s"><?= lang('powered_by') ?> <a target="_blank" href="https://wow-cms.com">BlizzCMS</a></p>
          </div>
          <div class="uk-width-expand@s">
            <p class="uk-text-small uk-text-center uk-text-right@s"><i class="fa-regular fa-copyright"></i> <?= date('Y') ?> <span class="uk-text-bold"><?= config_item('app_name') ?></span> - <?= lang('rights_reserved') ?></p>
          </div>
        </div>
      </div>
    </footer>

    <div id="offcanvas_nav" uk-offcanvas="flip: true; overlay: true">
      <div class="uk-offcanvas-bar">
        <div class="uk-panel">
          <ul class="uk-nav-default" uk-nav>
            <?php if (! is_logged_in()): ?>
            <li>
              <a href="<?= site_url('login') ?>"><span class="bc-li-icon"><i class="fa-solid fa-right-to-bracket"></i></span><?= lang('login') ?></a>
            </li>
            <?php endif ?>
            <?php foreach ($this->menu_model->display() as $item): ?>
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
    </div>
    <script src="<?= $template['assets'].'js/main.js' ?>"></script>
    <?= $template['body_tags'] ?>
  </body>
</html>
