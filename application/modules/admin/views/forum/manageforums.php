<?php
if (isset($_POST['button_deleteForum'])):
  $this->admin_model->deleteForum($_POST['button_deleteForum']);
endif; ?>

    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-comment-dots"></i> <?= $this->lang->line('admin_nav_manege_forums'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="javascript:void(0)" class="uk-icon-button" uk-toggle="target: #newForum"><i class="fas fa-pen"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-overflow-auto">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-table-expand"><?= $this->lang->line('placeholder_title'); ?></th>
                  <th class="uk-table-expand"><?= $this->lang->line('placeholder_category'); ?></th>
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_action'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($this->admin_model->getForumForumList()->result() as $list): ?>
                <tr>
                  <td><?= $list->name; ?></td>
                  <td><?= $this->admin_model->getSpecifyForumCategoryName($list->category); ?></td>
                  <td>
                    <div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
                      <a href="<?= base_url('admin/editforum/'.$list->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-edit"></i></a>
                      <form action="" method="post" accept-charset="utf-8">
                        <button class="uk-button uk-button-danger" name="button_deleteForum" value="<?= $list->id ?>" type="submit"><i class="fas fa-trash-alt"></i></button>
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
