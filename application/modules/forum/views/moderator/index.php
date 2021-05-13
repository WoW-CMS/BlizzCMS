    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-margin-remove"><?= lang('dashboard'); ?></h4>
            <ul class="uk-breadcrumb uk-margin-remove">
              <li><span><?= lang('dashboard'); ?></span></li>
            </ul>
          </div>
          <div class="uk-width-auto"></div>
        </div>
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-3-4@s">
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <h4 class="uk-h4">Latest Moderator Actions</h4>
              </div>
              <div class="uk-card-body uk-padding-remove">
                <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-width-small"><?= lang('username'); ?></th>
                      <th class="uk-width-small uk-text-center"><?= lang('date'); ?></th>
                      <th class="uk-width-medium uk-text-center"><?= lang('actions'); ?></th>
                      <th class="uk-width-medium uk-text-center"><?= lang('information'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Username</td>
                      <td>26/04/2019</td>
                      <td>Threads Deleted Permanently</td>
                      <td>Forum: General</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="uk-card uk-card-default uk-margin-small">
              <div class="uk-card-header">
                <h4 class="uk-h4">Latest Moderator Actions Bans Ending Soon</h4>
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
          <div class="uk-width-1-4@s">
            <div class="uk-card uk-card-secondary uk-card-body">
              <div class="uk-grid uk-grid-small uk-grid-divider uk-grid-match uk-child-width-1-1" data-uk-grid>
                <div>
                  <div class="uk-text-center">
                    <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove">Forum Threads</h5>
                    <h1 class="uk-h1 uk-margin-small"><span class="number-counter uk-text-primary" data-from="0" data-to="" data-speed="2000" data-refresh-interval="50"></span><span class="uk-margin-small-left"><i class="fas fa-file-alt"></i></span></h1>
                    <p class="uk-text-small uk-margin-remove">Total threads awaiting moderation</p>
                  </div>
                </div>
                <div>
                  <div class="uk-text-center">
                    <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove">Forum Post</h5>
                    <h1 class="uk-h1 uk-margin-small"><span class="number-counter uk-text-primary" data-from="0" data-to="" data-speed="2000" data-refresh-interval="50"></span><span class="uk-margin-small-left"><i class="fas fa-comment-dots"></i></span></h1>
                    <p class="uk-text-small uk-margin-remove">Total post awaiting moderation</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>