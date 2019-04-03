    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-list-ul"></i> <?= $this->lang->line('admin_nav_chars_list'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="" class="uk-icon-button"><i class="fas fa-info"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-body">
            <ul uk-accordion>
              <?php foreach ($this->m_data->getRealms()->result() as $charsMultiRealm):
                $multiRealm = $this->m_data->realmConnection($charsMultiRealm->username, $charsMultiRealm->password, $charsMultiRealm->hostname, $charsMultiRealm->char_database);
              ?>
              <li>
                <a class="uk-accordion-title" href="#"><span class="uk-margin-small-right"><i class="fas fa-server"></i></span>Realm - <?= $this->m_general->getRealmName($charsMultiRealm->realmID); ?></a>
                <div class="uk-accordion-content">
                  <div class="uk-overflow-auto uk-margin-small">
                    <table class="uk-table uk-table-hover uk-table-middle uk-table-divider uk-table-small">
                      <thead>
                        <tr>
                          <th class="uk-table-expand"><?= $this->lang->line('table_header_own'); ?></th>
                          <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_name'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($this->admin_model->getAdminCharactersList($multiRealm)->result() as $chars): ?>
                        <tr>
                          <td class="uk-table-link"><a href="<?= base_url('admin/managecharacter/'.$chars->guid.'/'.$charsMultiRealm->id); ?>" class="uk-link-reset"><?= $this->m_data->getUsernameID($chars->account); ?></a></td>
                          <td class="uk-table-link"><a href="<?= base_url('admin/managecharacter/'.$chars->guid.'/'.$charsMultiRealm->id); ?>" class="uk-link-reset"><?= $chars->name ?></a></td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </section>
