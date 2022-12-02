<section class="uk-section uk-section-xsmall" uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-flex uk-flex-middle uk-margin" uk-grid>
      <div class="uk-width-expand">
        <ul class="uk-breadcrumb uk-margin-remove">
          <li><a href="<?= site_url('admin') ?>"><?= lang('dashboard') ?></a></li>
        </ul>
        <h1 class="uk-h3 uk-text-bold uk-margin-remove"><?= lang('roles') ?></h1>
      </div>
      <div class="uk-width-auto"></div>
    </div>
    <?= $template['partials']['alerts'] ?>
    <div class="uk-card uk-card-default">
      <div class="uk-card-header">
        <div class="uk-grid-small uk-flex uk-flex-middle" uk-grid>
          <div class="uk-width-expand">
            <h3 class="uk-card-title"><?= lang('roles') ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('admin/roles/add') ?>" class="uk-button uk-button-default uk-button-small"><i class="fa-solid fa-pen"></i> <?= lang('add') ?></a>
          </div>
        </div>
      </div>
      <div class="uk-card-body uk-padding-remove">
        <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
          <thead>
            <tr>
              <th class="uk-table-expand"><?= lang('name') ?></th>
              <th class="uk-width-small"><?= lang('actions') ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($roles as $item): ?>
            <tr>
              <td>
                <h5 class="uk-text-bold uk-margin-remove"><?= html_escape($item->name) ?></h5>
                <p class="uk-text-small uk-margin-remove"><?= word_limiter($item->description, 15) ?></p>
              </td>
              <td>
                <div class="uk-button-group">
                  <a href="<?= site_url('admin/roles/edit/'.$item->id) ?>" class="uk-button uk-button-primary uk-button-small"><?= lang('edit') ?></a>
                  <div class="uk-inline">
                    <button class="uk-button uk-button-primary uk-button-small" type="button"><i class="fa-solid fa-caret-down"></i></button>
                    <div uk-dropdown="mode: click; boundary: ! .uk-container">
                      <ul class="uk-nav uk-dropdown-nav">
                        <li><a href="<?= site_url('admin/roles/delete/'.$item->id) ?>" class="uk-text-danger"><span class="bc-li-icon"><i class="fa-solid fa-trash-can"></i></span><?= lang('delete') ?></a></li>
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
