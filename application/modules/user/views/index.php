<section class="uk-section uk-section-small bc-primary-section" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('dashboard') ?></h1>
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
        <div class="uk-margin" uk-grid>
          <div class="uk-width-2-3@s">
            <div class="uk-card uk-card-default bc-card-gradient">
              <div class="uk-card-body">
                <div class="uk-grid-small" uk-grid>
                  <div class="uk-width-auto">
                    <div class="uk-flex uk-flex-center">
                      <img class="uk-border-circle bc-card-avatar" src="<?= user_avatar() ?>" width="48" height="48" alt="<?= $user->nickname ?>">
                    </div>
                  </div>
                  <div class="uk-width-expand">
                    <h4 class="uk-h4 uk-margin-remove"><?= lang('welcome_back') ?> <span class="uk-text-bold"><?= $user->nickname ?></span>!</h4>
                    <p class="uk-text-small uk-margin-remove"><i class="fa-solid fa-calendar"></i> <?= locate_date('now') ?></p>
                    <p class="uk-text-meta uk-margin-small"><?= lang('welcome_back_note') ?> <a href="<?= site_url('user/profile') ?>"><?= lang('my_profile') ?></a>.</p>
                  </div>
                </div>
              </div>
              <div class="uk-card-footer">
                <div class="uk-grid-collapse" uk-grid>
                  <div class="uk-width-expand@s">
                    <table class="uk-table bc-table-xsmall">
                      <tbody>
                        <tr>
                          <td class="uk-width-1-2"><i class="fa-regular fa-circle-dot fa-2xs"></i> <?= lang('registered_in') ?>:</td>
                          <td>
                            <time datetime="<?= $user->created_at ?>"><?= locate_date($user->created_at) ?></time>
                          </td>
                        </tr>
                        <tr>
                          <td class="uk-width-1-2"><i class="fa-regular fa-circle-dot fa-2xs"></i> <?= lang('role') ?>:</td>
                          <td class="uk-text-truncate"><?= $this->role_model->get_name($user->role) ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <div class="uk-width-expand@s">
                    <table class="uk-table bc-table-xsmall">
                      <tbody>
                        <tr>
                          <td class="uk-width-1-2"><i class="fa-regular fa-circle-dot fa-2xs"></i> <?= lang('voting_points') ?>:</td>
                          <td><span class="bc-vp-points"><?= $user->vp ?></span></td>
                        </tr>
                        <tr>
                          <td class="uk-width-1-2"><i class="fa-regular fa-circle-dot fa-2xs"></i> <?= lang('donation_points') ?>:</td>
                          <td><span class="bc-dp-points"><?= $user->dp ?></span></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="uk-width-1-3@s"></div>
        </div>
      </div>
    </div>
  </div>
</section>
