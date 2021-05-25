<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $template['title'] ?></title>
    <link rel="icon" type="image/x-icon" href="<?= $template['assets'].'images/favicon.ico' ?>">
    <link rel="stylesheet" href="<?= $template['assets'].'uikit/css/uikit.min.css' ?>">
    <link rel="stylesheet" href="<?= $template['assets'].'css/default.css' ?>">
    <script src="<?= $template['assets'].'uikit/js/uikit.min.js' ?>"></script>
    <script src="<?= $template['assets'].'uikit/js/uikit-icons.min.js' ?>"></script>
    <script src="<?= $template['assets'].'js/jquery.min.js' ?>"></script>
    <script src="<?= $template['assets'].'fontawesome/js/all.js' ?>" defer></script>
    <?= $template['head_data'] ?>
  </head>
  <body>
    <div class="uk-navbar-container uk-navbar-transparent">
      <div class="uk-container">
        <nav class="uk-navbar" data-uk-navbar>
          <div class="uk-navbar-left">
            <a href="<?= site_url() ?>" class="uk-navbar-item uk-logo uk-margin-small-right"><?= config_item('app_name') ?></a>
          </div>
          <div class="uk-navbar-right">
            <ul class="uk-navbar-nav">
              <?php if (! $this->website->isLogged()): ?>
              <li class="uk-visible@m"><a href="<?= site_url('register') ?>"><i class="fas fa-user-plus"></i>&nbsp;<?= lang('register') ?></a></li>
              <li class="uk-visible@m"><a href="<?= site_url('login') ?>"><i class="fas fa-sign-in-alt"></i>&nbsp;<?= lang('login') ?></a></li>
              <?php else: ?>
              <li class="uk-visible@m">
                <a href="#">
                  <img class="uk-border-circle" src="<?= $template['uploads'].'avatars/'.$this->website->user_avatar() ?>" width="30" height="30" alt="Avatar">
                  <span class="uk-text-middle uk-text-bold">&nbsp;<?= $this->session->userdata('nickname') ?>&nbsp;<i class="fas fa-caret-down"></i></span>
                </a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li><a href="<?= site_url('user') ?>"><i class="fas fa-user-circle"></i> <?= lang('user_panel') ?></a></li>
                    <?php if ($this->auth->is_admin()): ?>
                    <li><a href="<?= site_url('admin') ?>"><i class="fas fa-cog"></i> <?= lang('admin_panel') ?></a></li>
                    <?php endif ?>
                    <li><a href="<?= site_url('logout') ?>"><i class="fas fa-sign-out-alt"></i> <?= lang('logout') ?></a></li>
                  </ul>
                </div>
              </li>
              <?php if (mod_located('store')): ?>
              <li>
                <a href="#"><i class="fas fa-shopping-cart"></i>&nbsp;<span class="uk-badge"><?= $this->cart->total_items() ?></span></a>
                <div class="uk-navbar-dropdown">
                  <div class="cart-container">
                    <?php if ($this->cart->total_items()): ?>
                    <p class="uk-text-center uk-margin-small"><?= lang_vars('cart_items', [$this->cart->total_items()]) ?></p>
                    <a href="<?= site_url('store/cart') ?>" class="uk-button uk-button-default uk-button-small uk-width-1-1"><i class="fas fa-shopping-cart"></i> <?= lang('view_cart') ?></a>
                    <?php else: ?>
                    <p class="uk-text-center uk-margin-remove"><?= lang('cart_empty') ?></p>
                    <?php endif ?>
                  </div>
                </div>
              </li>
              <?php endif ?>
              <?php endif ?>
            </ul>
          </div>
        </nav>
      </div>
    </div>
    <div class="uk-navbar-container">
      <div class="uk-container">
        <nav class="uk-navbar" uk-navbar="mode: click">
          <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
              <?php foreach ($this->base->get_menu() as $item): ?>
              <?php if ($item->type === TYPE_DROPDOWN): ?>
              <li class="uk-visible@m">
                <a href="#">
                  <i class="<?= $item->icon ?>"></i>&nbsp;<?= $item->name ?>&nbsp;<i class="fas fa-caret-down"></i>
                </a>
                <div class="uk-navbar-dropdown">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <?php foreach ($this->base->get_menu($item->id) as $subitem): ?>
                      <li>
                        <a target="<?= $subitem->target ?>" href="<?= $subitem->url ?>">
                          <i class="<?= $subitem->icon ?>"></i>&nbsp;<?= $subitem->name ?>
                        </a>
                      </li>
                    <?php endforeach ?>
                  </ul>
                </div>
              </li>
              <?php elseif ($item->type === TYPE_DEFAULT): ?>
              <li class="uk-visible@m">
                <a target="<?= $item->target ?>" href="<?= $item->url ?>">
                  <i class="<?= $item->icon ?>"></i>&nbsp;<?= $item->name ?>
                </a>
              </li>
              <?php endif ?>
              <?php endforeach ?>
            </ul>
            <a class="uk-navbar-toggle uk-hidden@m" uk-navbar-toggle-icon href="#mobile" uk-toggle></a>
          </div>
          <div class="uk-navbar-right">
            <?php if ($this->website->isLogged()): ?>
            <div class="uk-navbar-item">
              <ul class="uk-subnav uk-subnav-divider subnav-points">
                <li><span uk-tooltip="title: <?= lang('donor_points') ?>;pos: bottom"><i class="dp-icon"></i></span> <?= $this->website->get_user(null, 'dp') ?></li>
                <li><span uk-tooltip="title: <?= lang('vote_points') ?>;pos: bottom"><i class="vp-icon"></i></span> <?= $this->website->get_user(null, 'vp') ?></li>
              </ul>
            </div>
            <?php endif ?>
          </div>
        </nav>
        <div id="mobile" data-uk-offcanvas="flip: true">
          <div class="uk-offcanvas-bar">
            <button class="uk-offcanvas-close" type="button" uk-close></button>
            <div class="uk-panel">
              <p class="uk-logo uk-text-center uk-margin-small"><?= config_item('app_name') ?></p>
              <?php if ($this->website->isLogged()): ?>
              <div class="uk-padding-small uk-padding-remove-vertical uk-margin-small uk-text-center">
                <img class="uk-border-circle" src="<?= $template['uploads'].'avatars/'.$this->website->user_avatar() ?>" width="36" height="36" alt="Avatar">
                <span class="uk-label"><?= $this->session->userdata('nickname') ?></span>
              </div>
              <?php endif ?>
              <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                <?php if (! $this->website->isLogged()): ?>
                <li><a href="<?= site_url('register') ?>"><i class="fas fa-user-plus"></i> <?= lang('register') ?></a></li>
                <li><a href="<?= site_url('login') ?>"><i class="fas fa-sign-in-alt"></i> <?= lang('login') ?></a></li>
                <?php else: ?>
                <li><a href="<?= site_url('user') ?>"><i class="far fa-user-circle"></i> <?= lang('user_panel') ?></a></li>
                <?php if ($this->auth->is_admin()): ?>
                <li><a href="<?= site_url('admin') ?>"><i class="fas fa-cog"></i> <?= lang('admin_panel') ?></a></li>
                <?php endif ?>
                <li><a href="<?= site_url('logout') ?>"><i class="fas fa-sign-out-alt"></i> <?= lang('logout') ?></a></li>
                <?php endif ?>
                <?php foreach ($this->base->get_menu() as $item): ?>
                <?php if ($item->type === TYPE_DROPDOWN): ?>
                <li class="uk-parent">
                  <a href="#">
                    <i class="<?= $item->icon ?>"></i>&nbsp;<?= $item->name ?>
                  </a>
                  <ul class="uk-nav-sub">
                    <?php foreach ($this->base->get_menu($item->id) as $subitem): ?>
                    <li>
                      <a target="<?= $subitem->target ?>" href="<?= $subitem->url ?>">
                        <i class="<?= $subitem->icon ?>"></i>&nbsp;<?= $subitem->name ?>
                      </a>
                    </li>
                    <?php endforeach ?>
                  </ul>
                </li>
                <?php elseif ($item->type === TYPE_DEFAULT): ?>
                <li>
                  <a target="<?= $item->target ?>" href="<?= $item->url ?>">
                    <i class="<?= $item->icon ?>"></i>&nbsp;<?= $item->name ?>
                  </a>
                </li>
                <?php endif ?>
                <?php endforeach ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?= $template['body'] ?>

    <section class="uk-section uk-section-xsmall footer-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-auto@s">
            <p class="uk-text-small uk-text-bold uk-text-center uk-text-left@s">Proudly powered by <a target="_blank" href="https://wow-cms.com" class="uk-text-uppercase">BlizzCMS</a></p>
          </div>
          <div class="uk-width-expand@s">
            <p class="uk-text-small uk-text-center uk-text-right@s">Copyright <i class="far fa-copyright"></i> <?= date('Y') ?> <span class="uk-text-bold"><?= config_item('app_name') ?></span>. <?= lang('rights_reserved') ?></p>
          </div>
        </div>
      </div>
    </section>
    <?= $template['body_data'] ?>
  </body>
</html>
