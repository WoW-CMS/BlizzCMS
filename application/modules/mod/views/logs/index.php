    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove">Guardian Logs</h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('mod'); ?>"><?= lang('admin_nav_dashboard'); ?></a></li>
              <li><span>Guardian Logs</span></li>
            </ul>
          </div>
          <div class="uk-width-auto"></div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header">
            <h4 class="uk-h4"></h4>
          </div>
          <div class="uk-card-body uk-padding-remove">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-width-small"><?= lang('username'); ?></th>
                  <th class="uk-width-small"><?= lang('date'); ?></th>
                  <th class="uk-width-medium"><?= lang('type'); ?></th>
                  <th class="uk-width-medium"><?= lang('information'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($this->mod_model->getLogs() as $logs): ?>
                  <tr>
                    <td><?= $this->website->get_user($logs->user_id, 'nickname'); ?></td>
                    <td><?= date('d-m-Y', $logs->created_at) ?></td>
                    <td>
                      <?php if ($logs->type == 1): ?>
                        Forums/Topic
                      <?php else: ?>
                        Forums/Comment
                      <?php endif; ?>
                    </td>
                    <td><?= $logs->function; ?> <?= $logs->annotation; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>