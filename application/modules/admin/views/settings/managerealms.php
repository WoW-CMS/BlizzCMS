<?php
if (isset($_POST['button_deleteRealm'])):
  $value = $_POST['button_deleteRealm'];
  $this->admin_model->delSpecifyRealm($value);
endif; ?>

      <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-server"></i></span><?= $this->lang->line('admin_nav_manage_realms'); ?></h4>
                </div>
                <div class="uk-width-expand uk-text-right">
                  <a href="javascript:void(0)" class="uk-icon-button" uk-toggle="target: #newRealm"><i class="fas fa-cog"></i></a>
                </div>
              </div>
            </div>
            <div class="uk-card-body">
              <div class="uk-overflow-auto uk-margin-small">
                <table class="uk-table uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-width-small"><?= $this->lang->line('table_header_realm_id'); ?></th>
                      <th class="uk-width-medium"><?= $this->lang->line('table_header_realm_name'); ?></th>
                      <th class="uk-width-medium"><?= $this->lang->line('table_header_realm_char_database'); ?></th>
                      <th class="uk-width-small">Soap Port</th>
                      <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_action'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($this->m_data->getRealms()->result() as $realmsID): ?>
                    <tr>
                      <td><?= $realmsID->realmID; ?></td>
                      <td><?= $this->m_general->getRealmName($realmsID->realmID); ?></td>
                      <td><?= $realmsID->char_database; ?></td>
                      <td><?= $realmsID->console_port; ?></td>
                      <td class="uk-text-center" uk-margin>
                        <form action="" method="post" accept-charset="utf-8">
                          <button class="uk-button uk-button-danger" name="button_deleteRealm" value="<?= $realmsID->id ?>" type="submit"><i class="fas fa-trash-alt"></i></button>
                        </form>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
