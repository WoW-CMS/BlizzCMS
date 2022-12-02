<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $template['title'] ?></title>
    <link rel="icon" type="image/x-icon" href="<?= $template['assets'].'img/favicon.ico' ?>">
    <link rel="stylesheet" href="<?= $template['assets'].'css/uikit.min.css' ?>">
    <link rel="stylesheet" href="<?= $template['assets'].'css/tail.select.min.css' ?>">
    <link rel="stylesheet" href="<?= $template['assets'].'css/dashboard.css' ?>">
    <script src="<?= $template['assets'].'js/uikit.min.js' ?>"></script>
    <script src="<?= $template['assets'].'js/uikit-icons.min.js' ?>"></script>
    <script src="<?= $template['assets'].'js/tail.select.min.js' ?>"></script>
    <script src="<?= $template['assets'].'js/purecounter.min.js' ?>"></script>
    <script src="<?= $template['assets'].'fontawesome/js/all.min.js' ?>" defer></script>
    <?= $template['head_tags'] ?>
  </head>
  <body>
    <header class="uk-background-secondary">
      <div class="uk-container">
        <nav class="bc-navbar-container" uk-navbar>
          <div class="uk-navbar-left">
            <a class="uk-navbar-item uk-logo uk-visible@s" href="<?= site_url('admin') ?>">BlizzCMS</a>
            <a href="#offcanvas_nav" class="uk-navbar-toggle uk-hidden@m" uk-navbar-toggle-icon uk-toggle></a>
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
              <li>
                <a href="#">
                  <img class="uk-border-circle" src="<?= user_avatar() ?>" width="32" height="32" alt="<?= lang('avatar') ?>">
                  <span class="uk-text-middle"><span uk-icon="icon: triangle-down"></span></span>
                </a>
                <div class="uk-navbar-dropdown" uk-drop="boundary: ! .uk-container">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li>
                      <a href="<?= site_url('user') ?>"><span class="bc-li-icon"><i class="fa-solid fa-circle-user"></i></span><?= lang('user_panel') ?></a>
                    </li>
                    <li>
                      <a href="<?= site_url('logout') ?>"><span class="bc-li-icon"><i class="fa-solid fa-right-from-bracket"></i></span><?= lang('logout') ?></a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </nav>
        <nav class="uk-navbar-container uk-margin-top uk-visible@m" uk-navbar>
          <div class="uk-navbar-left">
            <ul class="uk-navbar-nav">
              <li class="<?= is_route_active('admin') ? 'uk-active' : '' ?>">
                <a href="<?= site_url('admin') ?>"><span class="bc-li-icon"><i class="fa-solid fa-gauge fa-lg"></i></span><?= lang('dashboard') ?></a>
              </li>
              <li>
                <a href="#">
                  <span class="bc-li-icon"><i class="fa-solid fa-gears fa-lg"></i></span><?= lang('management') ?> <span uk-navbar-parent-icon></span>
                </a>
                <div class="uk-navbar-dropdown" uk-drop="boundary: ! .uk-container">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li class="<?= is_route_active('admin/settings') ? 'uk-active' : '' ?>">
                      <a href="<?= site_url('admin/settings') ?>"><?= lang('settings') ?></a>
                    </li>
                    <li class="<?= is_route_active('admin/appearance') ? 'uk-active' : '' ?>">
                      <a href="<?= site_url('admin/appearance') ?>"><?= lang('appearance') ?></a>
                    </li>
                    <li class="<?= is_route_active('admin/modules') ? 'uk-active' : '' ?>">
                      <a href="<?= site_url('admin/modules') ?>"><?= lang('modules') ?></a>
                    </li>
                    <li class="<?= is_route_active('admin/realms') ? 'uk-active' : '' ?>">
                      <a href="<?= site_url('admin/realms') ?>"><?= lang('realms') ?></a>
                    </li>
                    <li class="<?= is_route_active('admin/logs') ? 'uk-active' : '' ?>">
                      <a href="<?= site_url('admin/logs') ?>"><?= lang('logs') ?></a>
                    </li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="#">
                  <span class="bc-li-icon"><i class="fa-solid fa-users fa-lg"></i></span><?= lang('accounts') ?> <span uk-navbar-parent-icon></span>
                </a>
                <div class="uk-navbar-dropdown" uk-drop="boundary: ! .uk-container">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li class="<?= is_route_active('admin/users') ? 'uk-active' : '' ?>">
                      <a href="<?= site_url('admin/users') ?>"><?= lang('users') ?></a>
                    </li>
                    <li class="<?= is_route_active('admin/roles') ? 'uk-active' : '' ?>">
                      <a href="<?= site_url('admin/roles') ?>"><?= lang('roles') ?></a>
                    </li>
                    <li class="<?= is_route_active('admin/bans') ? 'uk-active' : '' ?>">
                      <a href="<?= site_url('admin/bans') ?>"><?= lang('bans') ?></a>
                    </li>
                  </ul>
                </div>
              </li>
              <li>
                <a href="#">
                  <span class="bc-li-icon"><i class="fa-solid fa-object-ungroup fa-lg"></i></span><?= lang('sections') ?> <span uk-navbar-parent-icon></span>
                </a>
                <div class="uk-navbar-dropdown" uk-drop="boundary: ! .uk-container">
                  <ul class="uk-nav uk-navbar-dropdown-nav">
                    <li class="<?= is_route_active('admin/news') ? 'uk-active' : '' ?>">
                      <a href="<?= site_url('admin/news') ?>"><?= lang('news') ?></a>
                    </li>
                    <li class="<?= is_route_active('admin/pages') ? 'uk-active' : '' ?>">
                      <a href="<?= site_url('admin/pages') ?>"><?= lang('pages') ?></a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
          <div class="uk-navbar-right"></div>
        </div>
      </nav>
    </header>

    <?= $template['body'] ?>

    <footer class="uk-section uk-section-xsmall">
      <div class="uk-container uk-container-expand">
        <hr class="uk-hr">
        <div class="uk-grid-small" uk-grid>
          <div class="uk-width-expand@s">
            <p class="uk-text-small uk-text-center uk-text-left@s">{elapsed_time}</p>
          </div>
          <div class="uk-width-auto@s">
            <p class="uk-text-small uk-text-center uk-text-right@s"><i class="fa-regular fa-copyright"></i> <?= date('Y') ?> <span class="uk-text-bold">WoW-CMS</span> - <?= lang('rights_reserved') ?></p>
          </div>
        </div>
      </div>
    </footer>

    <div id="offcanvas_nav" uk-offcanvas="flip: true; overlay: true">
      <div class="uk-offcanvas-bar">
        <ul class="uk-nav-default" uk-nav>
          <li class="<?= is_route_active('admin') ? 'uk-active' : '' ?>">
            <a href="<?= site_url('admin') ?>"><span class="bc-li-icon"><i class="fa-solid fa-gauge fa-lg"></i></span><?= lang('dashboard') ?></a>
          </li>
          <li class="uk-parent">
            <a href="#">
              <span class="bc-li-icon"><i class="fa-solid fa-gears fa-lg"></i></span><?= lang('management') ?> <span uk-nav-parent-icon></span>
            </a>
            <ul class="uk-nav-sub">
              <li class="<?= is_route_active('admin/settings') ? 'uk-active' : '' ?>">
                <a href="<?= site_url('admin/settings') ?>"><?= lang('settings') ?></a>
              </li>
              <li class="<?= is_route_active('admin/appearance') ? 'uk-active' : '' ?>">
                <a href="<?= site_url('admin/appearance') ?>"><?= lang('appearance') ?></a>
              </li>
              <li class="<?= is_route_active('admin/modules') ? 'uk-active' : '' ?>">
                <a href="<?= site_url('admin/modules') ?>"><?= lang('modules') ?></a>
              </li>
              <li class="<?= is_route_active('admin/realms') ? 'uk-active' : '' ?>">
                <a href="<?= site_url('admin/realms') ?>"><?= lang('realms') ?></a>
              </li>
              <li class="<?= is_route_active('admin/logs') ? 'uk-active' : '' ?>">
                <a href="<?= site_url('admin/logs') ?>"><?= lang('logs') ?></a>
              </li>
            </ul>
          </li>
          <li class="uk-parent">
            <a href="#">
              <span class="bc-li-icon"><i class="fa-solid fa-users fa-lg"></i></span><?= lang('accounts') ?> <span uk-nav-parent-icon></span>
            </a>
            <ul class="uk-nav-sub">
              <li class="<?= is_route_active('admin/users') ? 'uk-active' : '' ?>">
                <a href="<?= site_url('admin/users') ?>"><?= lang('users') ?></a>
              </li>
              <li class="<?= is_route_active('admin/roles') ? 'uk-active' : '' ?>">
                <a href="<?= site_url('admin/roles') ?>"><?= lang('roles') ?></a>
              </li>
              <li class="<?= is_route_active('admin/bans') ? 'uk-active' : '' ?>">
                <a href="<?= site_url('admin/bans') ?>"><?= lang('bans') ?></a>
              </li>
            </ul>
          </li>
          <li class="uk-parent">
            <a href="#">
              <span class="bc-li-icon"><i class="fa-solid fa-object-ungroup fa-lg"></i></span><?= lang('sections') ?> <span uk-nav-parent-icon></span>
            </a>
            <ul class="uk-nav-sub">
              <li class="<?= is_route_active('admin/news') ? 'uk-active' : '' ?>">
                <a href="<?= site_url('admin/news') ?>"><?= lang('news') ?></a>
              </li>
              <li class="<?= is_route_active('admin/pages') ? 'uk-active' : '' ?>">
                <a href="<?= site_url('admin/pages') ?>"><?= lang('pages') ?></a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    <script src="<?= $template['assets'].'js/main.js' ?>"></script>
    <?= $template['body_tags'] ?>
  </body>
</html>
