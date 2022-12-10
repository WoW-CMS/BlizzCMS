<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('users') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <div class="uk-card uk-card-default">
      <div class="uk-card-header">
        <div class="uk-grid-small uk-margin-small uk-flex uk-flex-middle" uk-grid>
          <div class="uk-width-expand">
            <h3 class="uk-card-title"><?= lang('users') ?></h3>
          </div>
          <div class="uk-width-auto">
            <button href="#filter_toggle" class="uk-button uk-button-default uk-button-small" type="button" uk-toggle="target: #filter_toggle; animation: uk-animation-slide-top-small"><i class="fa-solid fa-filter"></i></button>
          </div>
        </div>
      </div>
      <div class="uk-card-body uk-padding-remove">
        <div id="filter_toggle" class="uk-padding-small" hidden>
          <h6 class="uk-h6 uk-text-bold uk-text-uppercase uk-margin-small"><i class="fa-solid fa-filter fa-lg"></i> <?= lang('filter') ?></h6>
          <form action="<?= current_url() ?>" method="get" accept-charset="utf-8">
            <div class="uk-grid-small" uk-grid>
              <div class="uk-width-expand@s">
                <div class="uk-inline uk-width-1-1">
                  <span class="uk-form-icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                  <input class="uk-input" type="text" name="search" value="<?= $search ?>" placeholder="<?= lang('search') ?>" autocomplete="off">
                </div>
              </div>
              <div class="uk-width-auto@s">
                <button class="uk-button uk-button-primary" type="submit"><?= lang('search') ?></button>
              </div>
            </div>
          </form>
        </div>
        <table class="uk-table uk-table-middle uk-table-divider uk-table-small uk-margin-remove">
          <thead>
            <tr>
              <th class="uk-table-expand"><?= lang('username') ?></th>
              <th class="uk-width-medium uk-visible@s"><?= lang('nickname') ?></th>
              <th class="uk-width-medium uk-visible@s"><?= lang('email') ?></th>
              <th class="uk-width-medium"><?= lang('role') ?></th>
              <th class="uk-width-small"><?= lang('actions') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users as $item): ?>
            <tr>
              <td>
                <img class="uk-preserve-width uk-border-circle bc-margin-xsmall-right" src="<?= user_avatar($item->id) ?>" width="32" height="32" alt="<?= lang('avatar') ?>">
                <span class="uk-text-middle"><?= $item->username ?></span>
              </td>
              <td class="uk-visible@s"><?= $item->nickname ?></td>
              <td class="uk-visible@s"><?= hide_email($item->email) ?></td>
              <td><?= $this->role_model->get_name($item->role) ?></td>
              <td>
                <div class="uk-button-group">
                  <a href="<?= site_url('admin/users/view/'.$item->id) ?>" class="uk-button uk-button-primary uk-button-small"><?= lang('view') ?></a>
                  <div class="uk-inline">
                    <button class="uk-button uk-button-primary uk-button-small" type="button"><i class="fa-solid fa-caret-down"></i></button>
                    <div uk-dropdown="mode: click; boundary: ! .uk-container">
                      <ul class="uk-nav uk-dropdown-nav">
                        <?php if ($item->role == Role_model::ROLE_BANNED): ?>
                        <li><a href="<?= site_url('admin/bans/delete?user='.$item->username) ?>"><span class="bc-li-icon"><i class="fa-solid fa-user-minus"></i></span><?= lang('delete_ban') ?></a></li>
                        <?php else: ?>
                        <li><a href="<?= site_url('admin/bans/add?user='.$item->username) ?>"><span class="bc-li-icon"><i class="fa-solid fa-user-plus"></i></span><?= lang('add_ban') ?></a></li>
                        <?php endif ?>
                      </ul>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
    <?= $pagination ?>
  </div>
</section>
