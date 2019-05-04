    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-3-4@s">
            <h3 class="uk-h3 uk-margin-small uk-heading-bullet">Latest Moderator Actions</h3>
            <div class="uk-card uk-card-default uk-card-body uk-margin-small-top uk-margin-medium-bottom">
              <div class="uk-overflow-auto">
                <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-width-small"><?= $this->lang->line('placeholder_username'); ?></th>
                      <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_date'); ?></th>
                      <th class="uk-width-medium uk-text-center"><?= $this->lang->line('table_header_actions'); ?></th>
                      <th class="uk-width-medium uk-text-center">Information</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Username</td>
                      <td class="uk-text-center">26/04/2019</td>
                      <td class="uk-text-center">Threads Deleted Permanently</td>
                      <td class="uk-text-center">Forum: General</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <h3 class="uk-h3 uk-margin-small uk-heading-bullet">Latest Moderator Actions Bans Ending Soon</h3>
            <div class="uk-card uk-card-default uk-card-body uk-margin-small">
              <div class="uk-overflow-auto">
                <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-width-small"><?= $this->lang->line('placeholder_username'); ?></th>
                      <th class="uk-width-medium uk-text-center">Reason</th>
                      <th class="uk-width-small uk-text-center">Length</th>
                      <th class="uk-width-small uk-text-center">Banned By</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Username</td>
                      <td class="uk-text-center">Disrespect to Moderators</td>
                      <td class="uk-text-center">16 Hours</td>
                      <td class="uk-text-center">Moderator</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="uk-width-1-4@s">
            <div class="uk-card uk-card-secondary uk-card-body uk-margin-small">
              <div class="uk-grid uk-grid-small uk-grid-divider uk-grid-match uk-child-width-1-1" data-uk-grid>
                <div>
                  <div class="uk-text-center">
                    <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove">Forum Threads</h5>
                    <h1 class="uk-h1 uk-margin-small"><span class="blizzcms-count uk-text-primary" data-from="0" data-to="" data-speed="2000" data-refresh-interval="50"></span><span class="uk-margin-small-left"><i class="fas fa-file-alt"></i></span></h1>
                    <p class="uk-text-small uk-margin-remove">Total threads awaiting moderation</p>
                  </div>
                </div>
                <div>
                  <div class="uk-text-center">
                    <h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove">Forum Post</h5>
                    <h1 class="uk-h1 uk-margin-small"><span class="blizzcms-count uk-text-primary" data-from="0" data-to="" data-speed="2000" data-refresh-interval="50"></span><span class="uk-margin-small-left"><i class="fas fa-comment-dots"></i></span></h1>
                    <p class="uk-text-small uk-margin-remove">Total post awaiting moderation</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
