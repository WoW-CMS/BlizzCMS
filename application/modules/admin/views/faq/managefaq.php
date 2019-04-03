<?php
if (isset($_POST['button_delFaq'])):
  $this->admin_model->delSpecifyFaq($_POST['button_delFaq']);
endif; ?>

    <?= $tiny ?>
    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-question-circle"></i> <?= $this->lang->line('card_title_faq_list'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="javascript:void(0)" class="uk-icon-button" uk-toggle="target: #newFaq"><i class="fas fa-pen"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-overflow-auto">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-table-expand"><?= $this->lang->line('placeholder_title'); ?></th>
                  <th class="uk-width-small"><?= $this->lang->line('table_header_type'); ?></th>
                  <th class="uk-width-small"><?= $this->lang->line('table_header_date'); ?></th>
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_action'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($this->admin_model->getFaq() as $faq): ?>
                <tr>
                  <td><?= $faq->title ?></td>
                  <td><?= $this->admin_model->getFaqTypeName($faq->type); ?></td>
                  <td><?= date('Y-m-d', $faq->date); ?></td>
                  <td>
                    <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                      <a href="<?= base_url('admin/editfaq/'.$faq->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-edit"></i></a>
                      <form action="" method="post" accept-charset="utf-8">
                        <button class="uk-button uk-button-danger" name="button_delFaq" value="<?= $faq->id ?>" type="submit"><i class="fas fa-trash-alt"></i></button>
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
