<?php
if (isset($_POST['button_delTopsite'])):
  $this->admin_model->delTopsite($_POST['button_delTopsite']);
endif; ?>
    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-tasks"></i> <?= $this->lang->line('admin_nav_topsites'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/topsites/create'); ?>" class="uk-icon-button"><i class="fas fa-pen"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-overflow-auto">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-table-expand">Topsite <?= $this->lang->line('table_header_name'); ?></th>
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_time'); ?> (Hours)</th>
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_points'); ?></th>
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_action'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($this->admin_model->getTopsites() as $topsites): ?>
                <tr>
                  <td><?= $topsites->name ?></td>
                  <td class="uk-text-center"><?= $topsites->time ?></td>
                  <td class="uk-text-center"><?= $topsites->points ?></td>
                  <td>
                    <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                      <a href="<?= base_url('admin/topsites/edit/'.$topsites->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-edit"></i></a>
                      <form action="" method="post" accept-charset="utf-8">
                        <button class="uk-button uk-button-danger" name="button_delTopsite" value="<?= $topsites->id ?>" type="submit"><i class="fas fa-trash-alt"></i></button>
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
