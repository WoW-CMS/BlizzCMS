<section class="uk-section uk-section-small bc-primary-section" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-margin-top uk-margin-bottom" uk-grid>
      <div class="uk-width-expand">
      <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url() ?>"><?= lang('home') ?></a></li>
          <li><a href="<?= site_url('user') ?>"><?= lang('dashboard') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('security') ?></h1>
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
        <div class="uk-card uk-card-default uk-margin">
          <div class="uk-card-header">
            <h3 class="uk-card-title"><?= lang('security_settings') ?></h3>
          </div>
          <div class="uk-card-body">
            <ul class="uk-list uk-list-divider">
              <li>
                <a class="uk-link-toggle" href="<?= site_url('user/security/email') ?>">
                  <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                      <i class="fa-solid fa-envelope fa-xl"></i>
                    </div>
                    <div class="uk-width-expand">
                      <h5 class="uk-h5 uk-margin-remove"><span class="uk-link-heading"><?= lang('email') ?></span></h5>
                      <p class="uk-text-small uk-margin-remove"><?= lang('update_account_email') ?></p>
                    </div>
                  </div>
                </a>
              </li>
              <li>
                <a class="uk-link-toggle" href="<?= site_url('user/security/password') ?>">
                  <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                      <i class="fa-solid fa-key fa-xl"></i>
                    </div>
                    <div class="uk-width-expand">
                      <h5 class="uk-h5 uk-margin-remove"><span class="uk-link-heading"><?= lang('password') ?></span></h5>
                      <p class="uk-text-small uk-margin-remove"><?= lang('update_account_password') ?></p>
                    </div>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-margin">
          <div class="uk-card-header">
            <h3 class="uk-card-title"><?= lang('security_activity') ?></h3>
          </div>
          <div class="uk-card-body uk-padding-remove">
            <div class="uk-overflow-auto">
              <table class="uk-table uk-table-divider uk-table-small">
                <thead>
                  <tr>
                    <th class="uk-width-1-5"><?= lang('date') ?></th>
                    <th class="uk-table-shrink"><?= lang('status') ?></th>
                    <th class="uk-table-expand"><?= lang('action') ?></th>
                    <th class="uk-width-medium"><?= lang('ip') ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (isset($logs) && ! empty($logs)): ?>
                  <?php foreach ($logs as $item): ?>
                  <tr>
                    <td><?= $item->created_at ?></td>
                    <td class="uk-text-center">
                      <?php if ($item->status === Log_model::STATUS_SUCCEEDED): ?>
                      <span class="uk-text-success"><i class="fa-solid fa-circle-check fa-lg"></i></span>
                      <?php else: ?>
                      <span class="uk-text-danger"><i class="fa-solid fa-circle-xmark fa-lg"></i></span>
                      <?php endif ?>
                    </td>
                    <td><?= $item->message ?></td>
                    <td><?= $item->ip ?></td>
                  </tr>
                  <?php endforeach ?>
                  <?php endif ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <?= $pagination ?>
      </div>
    </div>
  </div>
</section>
