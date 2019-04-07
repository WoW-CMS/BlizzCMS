<?php
if (isset($_POST['button_delPage'])):
    $this->admin_model->delPage($_POST['button_delPage']);
endif; ?>

    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-file-alt"></i> <?= $this->lang->line('card_title_pages_list'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="<?= base_url('admin/pages/create'); ?>" class="uk-icon-button"><i class="fas fa-pen"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-overflow-auto">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-width-small"><?= $this->lang->line('placeholder_title'); ?></th>
                  <th class="uk-width-medium"><?= $this->lang->line('placeholder_uri'); ?></th>
                  <th class="uk-width-small"><?= $this->lang->line('table_header_date'); ?></th>
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_action'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($this->admin_model->getPages() as $pages): ?>
                <tr>
                  <td><?= $pages->title ?></td>
                  <td><?= base_url('page/').$pages->uri_friendly; ?></td>
                  <td><?= date('Y-m-d', $pages->date); ?></td>
                  <td>
                    <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                    <a href="<?= base_url('admin/pages/edit/'.$pages->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-edit"></i></a>
                      <form action="" method="post" accept-charset="utf-8">
                        <button class="uk-button uk-button-danger" name="button_delPage" value="<?= $pages->id ?>" type="submit"><i class="fas fa-trash-alt"></i></button>
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
