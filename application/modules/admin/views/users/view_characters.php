<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
          <li><a href="<?= site_url('admin/users') ?>"><?= lang('users') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('user') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <div class="uk-margin" uk-grid>
      <div class="uk-width-1-3@s uk-width-1-4@m">
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-flex uk-flex-center uk-margin-small-bottom">
            <img class="uk-border-circle uk-box-shadow-medium" src="<?= user_avatar($user->id) ?>" width="128" height="128" alt="<?= lang('avatar') ?>">
          </div>
          <div class="uk-text-center uk-margin-small-top">
            <h4 class="uk-h4 uk-margin-remove"><?= $user->username ?></h4>
            <p class="uk-text-small uk-margin-remove"><?= lang('registered_in') ?> <?= format_date($user->created_at, 'M j, Y') ?></p>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-margin">
          <ul class="uk-nav-default" uk-nav>
            <li><a href="<?= site_url('admin/users/view/'.$user->id) ?>"><?= lang('user') ?></a></li>
            <li class="uk-active"><a href="<?= site_url('admin/users/view/'.$user->id.'/characters') ?>"><?= lang('characters') ?></a></li>
            <li><a href="<?= site_url('admin/users/view/'.$user->id.'/logs') ?>"><?= lang('logs') ?></a></li>
          </ul>
        </div>
      </div>
      <div class="uk-width-expand@s">
        <?= $template['partials']['alerts'] ?>
        <?php foreach ($list as $item): ?>
        <div class="uk-card uk-card-default uk-margin">
          <div class="uk-card-header">
            <div class="uk-grid-small uk-margin-small uk-flex uk-flex-middle" uk-grid>
              <div class="uk-width-expand">
                <h3 class="uk-card-title"><?= lang('realm') ?> (<span class="uk-text-primary"><?= html_escape($item->realm) ?></span>)</h3>
              </div>
              <div class="uk-width-auto"></div>
            </div>
          </div>
          <div class="uk-card-body uk-padding-remove">
            <div class="uk-overflow-auto">
              <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
                <thead>
                  <tr>
                    <th><?= lang('guid') ?></th>
                    <th class="uk-table-expand"><?= lang('name') ?></th>
                    <th class="uk-table-shrink"><?= lang('race') ?></th>
                    <th class="uk-table-shrink"><?= lang('class') ?></th>
                    <th class="uk-width-small uk-text-center"><?= lang('level') ?></th>
                    <th class="uk-width-medium"><?= lang('money') ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($item->characters as $character): ?>
                  <tr>
                    <td><?= $character->guid ?></td>
                    <td><?= html_escape($character->name) ?></td>
                    <td class="uk-text-center">
                      <img class="uk-preserve-width uk-border-circle" src="<?= $template['assets'].'img/icons/race/'.$character->race.'-'.$character->gender.'.png' ?>" width="24" height="24" alt="<?= race_name($character->race) ?>">
                    </td>
                    <td class="uk-text-center">
                      <img class="uk-preserve-width uk-border-circle" src="<?= $template['assets'].'img/icons/class/'.$character->class.'.png' ?>" width="24" height="24" alt="<?= class_name($character->class) ?>">
                    </td>
                    <td class="uk-text-center"><?= $character->level ?></td>
                    <td>
                      <span class="bc-gold-money"><?= money_pieces($character->money) ?></span> <span class="bc-silver-money"><?= money_pieces($character->money, 's') ?></span> <span class="bc-copper-money"><?= money_pieces($character->money, 'c') ?></span>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</section>
