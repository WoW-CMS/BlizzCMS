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
            <li><a href="<?= site_url('admin/users/view/'.$user->id.'/characters') ?>"><?= lang('characters') ?></a></li>
            <li class="uk-active"><a href="<?= site_url('admin/users/view/'.$user->id.'/logs') ?>"><?= lang('logs') ?></a></li>
          </ul>
        </div>
      </div>
      <div class="uk-width-expand@s">
        <?= $template['partials']['alerts'] ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <div class="uk-grid-small uk-margin-small uk-flex uk-flex-middle" uk-grid>
              <div class="uk-width-expand">
                <h3 class="uk-card-title"><?= lang('logs') ?></h3>
              </div>
              <div class="uk-width-auto">
                <button class="uk-button uk-button-default uk-button-small" type="button" uk-toggle="target: #filter_toggle; animation: uk-animation-slide-top-small"><i class="fa-solid fa-filter"></i></button>
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
            <div class="uk-overflow-auto">
              <table class="uk-table uk-table-divider uk-table-small">
                <thead>
                  <tr>
                    <th class="uk-width-small"><?= lang('date') ?></th>
                    <th class="uk-width-small"><?= lang('ip') ?></th>
                    <th class="uk-table-shrink"><?= lang('status') ?></th>
                    <th class="uk-width-small"><?= lang('object') ?></th>
                    <th class="uk-width-small"><?= lang('event') ?></th>
                    <th class="uk-table-expand"><?= lang('message') ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($logs as $item): ?>
                  <tr>
                    <td><?= $item->created_at ?></td>
                    <td><?= $item->ip ?></td>
                    <td class="uk-text-center">
                      <?php if ($item->status === Log_model::STATUS_SUCCEEDED): ?>
                      <span class="uk-text-success"><i class="fa-regular fa-circle-check fa-xl"></i></span>
                      <?php else: ?>
                      <span class="uk-text-danger"><i class="fa-regular fa-circle-xmark fa-xl"></i></span>
                      <?php endif ?>
                    </td>
                    <td><?= html_escape($item->object) ?></td>
                    <td><?= html_escape($item->event) ?></td>
                    <td>
                      <?= html_escape($item->message) ?>
                      <?php if (is_json($item->data)): ?>
                      <ul class="uk-list uk-list-collapse uk-margin-remove">
                        <?php foreach (json_decode($item->data, true) as $key => $value): ?>
                        <li>
                          <span class="bc-text-key"><?= html_escape($key) ?>:</span> <span class="uk-text-bold"><?= html_escape($value) ?></span>
                        </li>
                        <?php endforeach ?>
                      </ul>
                      <?php endif ?>
                      <?php if (! empty($item->uri)): ?>
                      <a href="<?= site_url($item->uri) ?>" class="uk-link"><?= lang('view_in_editor') ?></a>
                      <?php endif ?>
                    </td>
                  </tr>
                  <?php endforeach ?>
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
