    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-book"></i> Guardian Logs</h3>
          </div>
          <div class="uk-width-auto">
            <a href="https://docs.wow-cms.com/" class="uk-icon-button"><i class="fas fa-info"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-overflow-auto">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-width-small"><?= $this->lang->line('placeholder_username'); ?></th>
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_date'); ?></th>
                  <th class="uk-width-medium uk-text-center">Type</th>
                  <th class="uk-width-medium uk-text-center">Information</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($this->mod_model->getLogs()->result() as $logs): ?>
                  <tr>
                    <td><?= $this->wowauth->getUsernameID($logs->userid); ?></td>
                    <td class="uk-text-center"><?= date('d-m-Y', $logs->datetime) ?></td>
                    <td class="uk-text-center">
                      <?php if($logs->type == 1): ?>
                        Topic
                      <?php else: ?>
                        Comment
                      <?php endif; ?>
                    </td>
                    <td class="uk-text-center"><?= $logs->function ?><?= $logs->annotation ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
