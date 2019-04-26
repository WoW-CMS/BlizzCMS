    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-ban"></i> Banned Users</h3>
          </div>
          <div class="uk-width-auto">
            <a href="" class="uk-icon-button"><i class="fas fa-info"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-card-body">
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
    </section>