<?php
if (isset($_POST['button_deleteRealm'])):
  $value = $_POST['button_deleteRealm'];
  $this->admin_model->delSpecifyRealm($value);
endif; ?>

    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-server"></i> <?= $this->lang->line('admin_nav_manage_realms'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/realms/create'); ?>" class="uk-icon-button"><i class="fas fa-cog"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-overflow-auto">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
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
                  <td>
                    <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                      <a href="<?= base_url('admin/realms/edit/'.$realmsID->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-edit"></i></a>
                      <form action="" method="post" accept-charset="utf-8">
                        <button class="uk-button uk-button-danger" name="button_deleteRealm" value="<?= $realmsID->id ?>" type="submit"><i class="fas fa-trash-alt"></i></button>
                      </form>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
