    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('tab_online'); ?></h4>
          </div>
          <div class="uk-width-auto"></div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: .onlineplayers">
          <?php foreach ($realms as $realm): ?>
          <li><a href="#"><i class="fas fa-server"></i> <?= $realm->name; ?></a></li>
          <?php endforeach; ?>
        </ul>
        <ul class="uk-switcher onlineplayers uk-margin-small">
          <?php foreach ($realms as $realm): ?>
          <li>
            <div class="uk-overflow-auto uk-margin-small">
              <table class="uk-table dark-table uk-table-divider uk-table-small">
                <thead>
                  <tr>
                    <th class="uk-table-expand"><?= lang('name'); ?></th>
                    <th class="uk-table-expand"><?= lang('level'); ?></th>
                    <th class="uk-table-expand"><?= lang('race'); ?></th>
                    <th class="uk-table-expand"><?= lang('class'); ?></th>
                    <th class="uk-table-expand"><?= lang('zone'); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($this->online_model->get_players($realm->id) as $online): ?>
                  <tr>
                    <td><?= $online->name; ?></td>
                    <td><?= $online->level; ?></td>
                    <td><img class="uk-border-circle" src="<?= $template['uploads'].'icons/race/'.race_icon($online->race); ?>" width="20" height="20" alt="<?= race_name($online->race); ?>"></td>
                    <td><img class="uk-border-circle" src="<?= $template['uploads'].'icons/class/'.class_icon($online->class); ?>" width="20" height="20" alt="<?= class_name($online->class); ?>"></td>
                    <td><?= $this->base->zone_name($online->zone); ?></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>
