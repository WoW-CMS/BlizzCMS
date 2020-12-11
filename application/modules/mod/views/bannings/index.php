    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove">Banned Users</h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><a href="<?= site_url('mod'); ?>"><?= lang('admin_nav_dashboard'); ?></a></li>
              <li><span>Banned Users</span></li>
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
                  <th class="uk-width-medium"><?= lang('reason'); ?></th>
                  <th class="uk-width-small">Length</th>
                  <th class="uk-width-small">Banned By</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Username</td>
                  <td>Disrespect to Moderators</td>
                  <td>16 Hours</td>
                  <td>Moderator</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>