<section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
	<div class="uk-container">
		<div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
			<div class="uk-width-expand uk-heading-line">
				<h3 class="uk-h3"><i class="fas fa-sliders-h"></i> <?= $this->lang->line('section_rank_list'); ?></h3>
			</div>
			<div class="uk-width-auto">
				<a href="" class="uk-icon-button"><i class="fas fa-info"></i></a>
			</div>
		</div>
		<div class="uk-grid uk-grid-small" data-uk-grid>
			<div class="uk-width-1-4@s">
				<div class="uk-card uk-card-secondary">
					<ul class="uk-nav uk-nav-default">
						<li class="uk-active"><a href="<?= base_url('admin/permissions'); ?>"><i class="fas fa-cog"></i> <?= $this->lang->line('section_rank_list'); ?></a></li>
						<li><a href="<?= base_url('admin/permissions/create'); ?>"><i class="fas fa-cog"></i> <?= $this->lang->line('section_rank_create'); ?></a></li>
					</ul>
				</div>
			</div>
			<div class="uk-width-3-4@s">
				<div class="uk-card uk-card-default uk-margin-small">
					<div class="uk-card-body">
						<h5 class="uk-h5 uk-heading-line uk-text-uppercase uk-text-bold uk-text-center uk-margin-small"><span><?= $this->lang->line('section_rank_list'); ?></span></h5>
						<table class="uk-table uk-table-hover uk-table-middle uk-table-divider uk-table-small">
							<thead>
							<tr>
								<th class="uk-width-small uk-text-center"><?= $this->lang->line('placeholder_name'); ?></th>
								<th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_actions'); ?></th>
							</tr>
							</thead>
							<tbody>
							<?php if(isset($viewrank) && !empty($viewrank)): ?>
								<?php foreach($viewrank as $ranks): ?>
									<?php foreach ($this->admin_model->getRank($ranks->permission_id)->result() as $perms): ?>
									<tr>
										<td class="uk-text-center"><?= $perms->permission ?></td>
										<td>
											<div class="uk-flex uk-flex-left uk-flex-center@m uk-margin-small">
												<a href="<?= base_url('admin/permissions/add/'.$perms->id); ?>" class="uk-button uk-button-primary uk-margin-small-right"><i class="fas fa-cog"></i></a>
												<a href="<?= base_url('admin/permissions/delete/'.$perms->id); ?>" class="uk-button uk-button-danger"><i class="fas fa-ban"></i></a>
											</div>
										</td>
									</tr>
									<?php endforeach; ?>
								<?php endforeach; ?>
							<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
