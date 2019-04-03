<?php
if (isset($_POST['button_delPage'])):
    $this->admin_model->delPage($_POST['button_delPage']);
endif; ?>

    <?= $tiny ?>
    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-file-alt"></i> <?= $this->lang->line('card_title_pages_list'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="javascript:void(0)" class="uk-icon-button" uk-toggle="target: #newPage"><i class="fas fa-pen"></i></a>
          </div>
        </div>
        <?php if (isset($_GET['newpage'])): ?>
        <div class="uk-alert-primary uk-margin-small" uk-alert>
          <a class="uk-alert-close" uk-close></a>
          <p><?= $this->lang->line('alert_new_page_url'); ?>: <b><a href="<?= base_url('page/').$_GET['newpage']; ?>"><?= base_url('page/').$_GET['newpage']; ?></a></b></p>
        </div>
        <?php endif; ?>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-overflow-auto">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-table-expand"><?= $this->lang->line('placeholder_title'); ?></th>
                  <th class="uk-width-small"><?= $this->lang->line('table_header_date'); ?></th>
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_action'); ?></th>
                  <?= $this->admin_model->pagecheckUri('tos'); ?>
                </tr>
              </thead>
              <tbody>
                <?php foreach($this->admin_model->getPages() as $pages): ?>
                <tr>
                  <td><?= $pages->title ?></td>
                  <td><?= date('Y-m-d', $pages->date); ?></td>
                  <td>
                    <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                    <a href="<?= base_url('admin/editpages/'.$pages->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-edit"></i></a>
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
