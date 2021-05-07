<section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
	<div class="uk-background-cover uk-height-small header-section"></div>
</section>
<section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
	<div class="uk-container">
		<div class="uk-grid uk-grid-medium" data-uk-grid>
			<div class="uk-width-1-1">
				<div class="uk-width-auto">
					<h4 class="uk-h4 uk-text-uppercase uk-text-bold"><i class="fas fa-download"></i> Download</h4>
				</div>
				<div class="uk-width-expand@s">
					<div class="uk-child-width-1-1" uk-grid>
						<div>
							<div uk-grid>
								<div class="uk-width-auto@m">
									<ul class="uk-tab-left" uk-tab="connect: #component-tab-left; animation: uk-animation-slide-left-medium, uk-animation-slide-right-medium">
										<li><a href="#">Client</a></li>
										<li><a href="#">Addons</a></li>
									</ul>
								</div>
								<div class="uk-width-expand@m">
									<ul id="component-tab-left" class="uk-switcher">
										<li>
											<table class="uk-table uk-table-middle uk-table-divider">
												<thead>
													<tr>
														<th class="uk-width-small">Version</th>
														<th class="uk-width-medium">Name</th>
														<th>Size</th>
														<th>Type</th>
														<th>Download</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($this->download_model->getGame()->result() as $files): ?>
													<tr>
														<td><div style="background:url(<?=base_url('assets/images/forums/wow-icons/' . $files->image);?>); width: 50px; height: 50px;)"></div></td>
														<td><?=$files->fileName?></td>
														<td><?=$files->weight?></td>
														<td><?=$files->type?></td>
														<td><a class="uk-button uk-label-success uk-button-small" href="<?=$files->url?>" target="_blank"><i class="fas fa-download"></i> Download</a></td>
													</tr>
													<?php endforeach;?>
												</tbody>
											</table>
										</li>
										<li>
											<table class="uk-table uk-table-middle uk-table-divider">
												<thead>
													<tr>
														<th class="uk-width-small">Version</th>
														<th class="uk-width-large">Name</th>
														<th>Size</th>
														<th>Download</th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($this->download_model->getAddons()->result() as $files): ?>
													<tr>
														<td><div style="background:url(<?=base_url('assets/images/forums/wow-icons/' . $files->image);?>); width: 50px; height: 50px;)"></div></td>
														<td><?=$files->fileName?></td>
														<td><?=$files->weight?></td>
														<td><a class="uk-button uk-label-success uk-button-small" href="<?=$files->url?>" target="_blank"><i class="fas fa-download"></i> Download</a></td>
													</tr>
													<?php endforeach;?>
												</tbody>
											</table>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>