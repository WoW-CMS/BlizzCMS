<main class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
  <div class="uk-container">
    <div class="uk-section uk-section-xsmall">
      <h3 class="uk-h3 uk-heading-divider"><i class="fas fa-tasks"></i> CMS | Information</h3>
    </div>
    <div class="uk-grid uk-grid-medium" data-uk-grid>
      <div class="uk-width-1-4@m">
        <div class="uk-card uk-card-default blizzcms-card-tab uk-card-small">
          <div class="uk-card-header">
            <h4 class="uk-h4"><i class="fas fa-info-circle"></i> Menu</h4>
          </div>
          <div class="uk-card-body">
            <ul class="uk-tab-right" uk-tab="connect: #cms-verify; animation: uk-animation-fade; toggle: > *">
              <li class="uk-width-1-1"><a href="#"><i class="fas fa-crown"></i> Update</a></li>
              <li class="uk-width-1-1"><a href="#"><i class="fas fa-terminal"></i> Check configs</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="uk-width-3-4@m">
        <ul id="cms-verify" class="uk-switcher">
          <li>
            <div class="blizzcms-install-upgrade">
              <div class="uk-card uk-card-default uk-background-cover uk-card-hover">
                <div class="uk-card-body">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-auto@m uk-text-center uk-text-left@m">
                      <h3 class="uk-h3 uk-text-bold uk-margin-remove"><span uk-icon="icon: blizzcms-icon;ratio: 0.8"></span> <?= $this->update_model->getCurrentVersion() ?> </h3>
                      <p class="uk-margin-small uk-text-small">This is your recent version</p>
                    </div>
                    <div class="uk-width-expand uk-text-center uk-text-right@m">
                      <a href="<?= base_url('admin/autoupdate') ?>" class="uk-button uk-button-upgrade uk-button-large"><i class="fas fa-sync fa-spin"></i> Check recent updates</a>
                    </div>
                  </div>
                  <p><span class="uk-text-bold uk-text-warning">Nota:</span> Al actualizar el CMS podrías perder algunos datos referentes a la configuración, almacenados en application/config</p>
                </div>
              </div>
            </div>
          </li>
          <li>
            <div class="uk-card uk-card-default uk-card-small">
              <div class="uk-overflow-auto uk-margin">
                <table class="uk-table uk-table-hover uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-width-small">Informacion</th>
                      <th class="uk-table-expand">Valor</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="uk-text-bold">PHP Version</td>
                      <td><?= phpversion() ?></td>
                    </tr>
                    <tr>
                      <td class="uk-text-bold">Apache Version</td>
                      <td><?= apache_get_version() ?></td>
                    </tr>
                    <tr>
                      <td class="uk-text-bold">allow_url_fopen</td>
                      <?php if(ini_get('allow_url_fopen') ) { ?>
                        <td>On</td>
                      <?php } else { ?>
                        <td>Off</td>
                      <?php } ?>
                    </tr>
                    <tr>
                      <td class="uk-text-bold">allow_url_include</td>
                      <?php if(ini_get('allow_url_include') ) { ?>
                        <td>On</td>
                      <?php } else { ?>
                        <td>Off</td>
                      <?php } ?>
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
</main>
