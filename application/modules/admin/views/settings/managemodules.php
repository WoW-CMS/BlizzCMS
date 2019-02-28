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
        <div class="uk-container uk-container-expand">
          <div class="uk-card uk-card-default">
            <div class="uk-card-header">
              <div class="uk-grid uk-grid-small">
                <div class="uk-width-auto">
                  <h4 class="uk-h4"><span class="uk-margin-small-right"><i class="fas fa-puzzle-piece"></i></span><?= $this->lang->line('admin_manage_modules'); ?></h4>
                </div>
                <div class="uk-width-expand"></div>
              </div>
            </div>
            <div class="uk-card-body">
              <div class="uk-overflow-auto uk-margin-small">
                <table class="uk-table uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-table-expand"><?= $this->lang->line('column_module'); ?></th>
                      <th class="uk-width-small uk-text-center"><?= $this->lang->line('column_action'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($this->admin_model->getModules() as $module): ?>
                    <tr>
                      <td><?= $module->name; ?></td>
                      <td class="uk-text-center" uk-margin>
                        <?php if($module->name == 'Installation'): ?>
                          <button class="uk-button uk-button-secondary uk-disabled"></button>
                        <?php else: ?>
                        <form action="" method="post" accept-charset="utf-8">
                          <?php if($module->status == 1): ?>
                          <button class="uk-button uk-button-danger" name="button_disable" value="<?= $module->id ?>" type="submit"><i class="fas fa-eye-slash"></i> <?= $this->lang->line('button_disable'); ?></button>
                          <?php else: ?>
                          <button class="uk-button uk-button-primary" name="button_enable" value="<?= $module->id ?>" type="submit"><i class="fas fa-eye"></i> <?= $this->lang->line('button_enable'); ?></button>
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
        </div>
      </section>
