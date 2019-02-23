      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-list-ul"></i></span><?= $this->lang->line('admin_chars_list'); ?></h4>
                </div>
                <div class="uk-width-expand"></div>
              </div>
            </div>
            <div class="uk-card-body">
              <ul uk-accordion>
                <?php foreach ($this->m_data->getRealms()->result() as $charsMultiRealm):
                  $multiRealm = $this->m_data->realmConnection($charsMultiRealm->username, $charsMultiRealm->password, $charsMultiRealm->hostname, $charsMultiRealm->char_database);
                ?>
                <li>
                  <a class="uk-accordion-title" href="#"><span class="uk-margin-small-right"><i class="fas fa-server"></i></span>Realm - <?= $this->m_general->getRealmName($charsMultiRealm->realmID); ?></a>
                  <div class="uk-accordion-content">
                    <div class="uk-overflow-auto uk-margin-small">
                      <table class="uk-table uk-table-divider uk-table-small">
                        <thead>
                          <tr>
                            <th class="uk-table-expand"><?= $this->lang->line('column_own'); ?></th>
                            <th class="uk-width-small uk-text-center"><?= $this->lang->line('column_name'); ?></th>
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
