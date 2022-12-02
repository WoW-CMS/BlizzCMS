<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('realms') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <div class="uk-card uk-card-default">
      <div class="uk-card-header">
        <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
          <div class="uk-width-expand">
            <h3 class="uk-card-title"><?= lang('realms') ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('admin/realms/add') ?>" class="uk-button uk-button-default uk-button-small"><i class="fa-solid fa-pen"></i> <?= lang('add') ?></a>
          </div>
        </div>
      </div>
      <div class="uk-card-body uk-padding-remove">
        <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
          <thead>
            <tr>
              <th class="uk-table-expand"><?= lang('name') ?></th>
              <th class="uk-width-medium uk-visible@s"><?= lang('maximum_capacity') ?></th>
              <th class="uk-width-small"><?= lang('actions') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($realms as $item): ?>
            <tr>
              <td><?= $item->realm_name ?></td>
              <td class="uk-visible@s"><?= $item->realm_capacity ?></td>
              <td>
                <div class="uk-button-group">
                  <a href="<?= site_url('admin/realms/edit/'.$item->id) ?>" class="uk-button uk-button-primary uk-button-small"><?= lang('edit') ?></a>
                  <div class="uk-inline">
                    <button class="uk-button uk-button-primary uk-button-small" type="button"><i class="fa-solid fa-caret-down"></i></button>
                    <div uk-dropdown="mode: click; boundary: ! .uk-container">
                      <ul class="uk-nav uk-dropdown-nav">
                        <li><a href="<?= site_url('admin/realms/soap/'.$item->id) ?>"><span class="bc-li-icon"><i class="fa-solid fa-terminal"></i></span><?= lang('check_soap') ?></a></li>
                        <li class="uk-nav-divider"></li>
                        <li><a href="<?= site_url('admin/realms/delete/'.$item->id) ?>" class="uk-text-danger"><span class="bc-li-icon"><i class="fa-solid fa-trash-can"></i></span><?= lang('delete') ?></a></li>
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
      <?= $pagination ?>
    </div>
  </div>
</section>
