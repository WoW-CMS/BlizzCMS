    <section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
          <div class="uk-width-expand uk-heading-line">
            <h3 class="uk-h3"><i class="fas fa-cog"></i> BlizzCMS</h3>
          </div>
          <div class="uk-width-auto">
            <a href="" class="uk-icon-button"><i class="fas fa-info"></i></a>
          </div>
        </div>
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-1-4@s">
            <div class="uk-card uk-card-secondary">
              <ul class="uk-nav uk-nav-default" uk-switcher="connect: #manage-updates">
                <li><a href="javascript:void(0)"><i class="fas fa-wrench"></i> <?= $this->lang->line('section_update_cms'); ?></a></li>
                <li><a href="javascript:void(0)"><i class="fas fa-tasks"></i> <?= $this->lang->line('section_check_information'); ?></a></li>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@s">
			<?php if ($this->session->flashdata('success')): ?>
			<div class="uk-alert-success uk-margin-small" uk-alert>
			<a class="uk-alert-close" uk-close></a>
			<h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><i class="fa-solid fa-circle-check"></i> <?= $this->lang->line('notification_title_success') ?></h5>
				<p class="uk-text-small uk-margin-remove"><?= $this->session->flashdata('success') ?></p>
			</div>
			<?php elseif ($this->session->flashdata('info')): ?>
			<div class="uk-alert-primary uk-margin-small" uk-alert>
			<a class="uk-alert-close" uk-close></a>
			<h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><i class="fa-solid fa-circle-info"></i> <?= $this->lang->line('notification_title_info') ?></h5>
				<p class="uk-text-small uk-margin-remove"><?= $this->session->flashdata('info') ?></p>
			</div>
			<?php elseif ($this->session->flashdata('warning')): ?>
			<div class="uk-alert-warning uk-margin-small" uk-alert>
			<a class="uk-alert-close" uk-close></a>
			<h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><i class="fa-solid fa-circle-exclamation"></i> <?= $this->lang->line('notification_title_warning') ?></h5>
				<p class="uk-text-small uk-margin-remove"><?= $this->session->flashdata('warning') ?></p>
			</div>
			<?php elseif ($this->session->flashdata('error')): ?>
			<div class="uk-alert-danger uk-margin-small" uk-alert>
				<a class="uk-alert-close" uk-close></a>
			<h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><i class="fa-solid fa-circle-xmark"></i> <?= $this->lang->line('notification_title_error') ?></h5>
				<p class="uk-text-small uk-margin-remove"><?= $this->session->flashdata('error') ?></p>
			</div>
			<?php elseif ($this->session->flashdata('error_list')): ?>
			<div class="uk-alert-danger uk-margin-small" uk-alert>
			<a class="uk-alert-close" uk-close></a>
			<h5 class="uk-h5 uk-text-bold uk-text-uppercase uk-margin-remove"><i class="fa-solid fa-circle-xmark"></i> <?= $this->lang->line('notification_title_error') ?></h5>
			<ul class="uk-list uk-list-hyphen uk-margin-remove">
				<?= $this->session->flashdata('error_list') ?>
			</ul>
			</div>
			<?php endif ?>
            <ul id="manage-updates" class="uk-switcher">
              <li>
                <div class="uk-card uk-card-update uk-margin-small">
                  <div class="uk-card-body">
                    <div class="uk-grid uk-grid-small" data-uk-grid>
                      <div class="uk-width-auto@m uk-text-center uk-text-left@m">
		  				<h3 class="uk-h3 uk-text-bold uk-margin-remove"><span uk-icon="icon: blizzcms-icon;ratio: 0.8"></span> V<?= $latest_version ?> </h3>
                        <p class="uk-margin-small uk-text-small"><?= $this->lang->line('cms_version_currently'); ?></p>
                      </div>
                      <div class="uk-width-expand uk-text-center uk-text-right@m">
                        <a href="<?= base_url('admin/cms/update') ?>" class="uk-button uk-button-primary uk-button-large"><i class="fas fa-sync fa-spin"></i> <?= $this->lang->line('button_update_version'); ?></a>
                      </div>
                    </div>
                    <p class="uk-text-small uk-margin-small"><span class="uk-text-bold uk-text-warning"><i class="fas fa-exclamation-triangle"></i> <?= $this->lang->line('notification_title_warning'); ?>:</span> <?= $this->lang->line('cms_warning_update'); ?></p>
                  </div>
                </div>
              </li>
              <li>
                <div class="uk-card uk-card-default uk-card-body">
                  <div class="uk-overflow-auto uk-margin">
                    <table class="uk-table uk-table-divider uk-table-small">
                      <thead>
                        <tr>
                          <th class="uk-table-expand"><?= $this->lang->line('table_header_information'); ?></th>
                          <th class="uk-table-expand"><?= $this->lang->line('table_header_value'); ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="uk-text-bold"><?= $this->lang->line('cms_php_version'); ?></td>
                          <td><?= phpversion() ?></td>
                        </tr>
                        <tr>
                          <td class="uk-text-bold"><?= $this->lang->line('cms_allow_fopen'); ?></td>
                          <td>
                            <?php if(ini_get('allow_url_fopen')): ?>
                            <span class="uk-label uk-label-success"><?= $this->lang->line('option_on'); ?></span>
                            <?php else: ?>
                            <span class="uk-label uk-label-danger"><?= $this->lang->line('option_off'); ?></span>
                            <?php endif; ?>
                          </td>
                        </tr>
                        <tr>
                          <td class="uk-text-bold"><?= $this->lang->line('cms_allow_include'); ?></td>
                          <td>
                            <?php if(ini_get('allow_url_include')): ?>
                            <span class="uk-label uk-label-success"><?= $this->lang->line('option_on'); ?></span>
                            <?php else: ?>
                            <span class="uk-label uk-label-danger"><?= $this->lang->line('option_off'); ?></span>
                            <?php endif; ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
