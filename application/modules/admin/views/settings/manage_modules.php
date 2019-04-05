<?php
if (isset($_POST['button_disable'])):
  $value = $_POST['button_disable'];
  $this->admin_model->disableSpecifyModule($value);
endif;

if (isset($_POST['button_enable'])):
  $value = $_POST['button_enable'];
  $this->admin_model->enableSpecifyModule($value);
endif; ?>

    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-puzzle-piece"></i> <?= $this->lang->line('admin_nav_manage_modules'); ?></h3>
          </div>
          <div class="uk-width-auto">
            <a href="" class="uk-icon-button"><i class="fas fa-info"></i></a>
          </div>
        </div>
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-overflow-auto">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-table-expand"><?= $this->lang->line('table_header_module'); ?></th>
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_action'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($this->admin_model->getModules() as $module): ?>
                <tr>
                  <td><?= $module->name; ?></td>
                  <td class="uk-text-center" uk-margin>
                    <?php if($module->name == 'Installation'): ?>
                      <button class="uk-button uk-button-secondary uk-disabled"><i class="fas fa-eye-slash"></i></button>
                    <?php else: ?>
                    <form action="" method="post" accept-charset="utf-8">
                      <?php if($module->status == 1): ?>
                      <button class="uk-button uk-button-danger" name="button_disable" value="<?= $module->id ?>" type="submit"><i class="fas fa-eye-slash"></i></button>
                      <?php else: ?>
                      <button class="uk-button uk-button-primary" name="button_enable" value="<?= $module->id ?>" type="submit"><i class="fas fa-eye"></i></button>
                      <?php endif; ?>
                    </form>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
