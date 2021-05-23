    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small uk-flex uk-flex-middle" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('topsites'); ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('admin'); ?>"><?= lang('dashboard'); ?></a></li>
              <li><span><?= lang('topsites'); ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto">
            <a href="<?= site_url('vote/admin/create'); ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-pen"></i> <?= lang('create'); ?></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <ul class="uk-subnav" uk-margin>
            <li class="uk-active"><a href="<?= site_url('vote/admin'); ?>"><span class="uk-margin-small-right"><i class="fas fa-list-alt"></i></span><?= lang('home'); ?></a></li>
            <li><a href="<?= site_url('vote/admin/logs'); ?>"><span class="uk-margin-small-right"><i class="fas fa-list"></i></span><?= lang('logs'); ?></a></li>
          </ul>
        </div>
        <?= $template['partials']['alerts']; ?>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h5 class="uk-h5 uk-text-uppercase uk-text-bold"><i class="fas fa-list-ul"></i> <?= lang('topsites'); ?></h5>
          </div>
          <div class="uk-card-body uk-padding-remove">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-table-expand"><?= lang('name'); ?></th>
                  <th class="uk-width-small uk-visible@s"><?= lang('time'); ?></th>
                  <th class="uk-width-small uk-visible@s"><?= lang('points'); ?></th>
                  <th class="uk-width-small"><?= lang('actions'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($topsites as $item): ?>
                <tr>
                  <td><?= $item->name; ?></td>
                  <td class="uk-visible@s"><?= $item->time; ?></td>
                  <td class="uk-visible@s"><?= $item->points; ?></td>
                  <td>
                    <div class="uk-button-group">
                      <a href="<?= site_url('vote/admin/edit/'.$item->id); ?>" class="uk-button uk-button-primary uk-button-small"><i class="fas fa-edit"></i> <?= lang('edit'); ?></a>
                      <div class="uk-inline">
                        <button class="uk-button uk-button-primary uk-button-small" type="button"><i class="fas fa-ellipsis-v"></i></button>
                        <div uk-dropdown="mode: click;boundary: ! .uk-container;">
                          <ul class="uk-nav uk-dropdown-nav">
                            <li><a href="<?= site_url('vote/admin/delete/'.$item->id); ?>"><i class="fas fa-trash-alt"></i> <?= lang('delete'); ?></a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
        <?= $links; ?>
      </div>
    </section>