    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('tab_pvp_statistics'); ?></h4>
          </div>
          <div class="uk-width-auto"></div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <ul class="uk-subnav uk-subnav-pill" uk-switcher="connect: .pvp-statistics">
          <?php foreach ($realms as $realm): ?>
          <li><a href="#"><i class="fas fa-server"></i> <?= $realm->name; ?></a></li>
          <?php endforeach; ?>
        </ul>
        <ul class="uk-switcher pvp-statistics uk-margin-small">
          <?php foreach ($realms as $realm): ?>
          <li>
            <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-child-width-1-3@m" data-uk-grid>
              <dir>
                <span class="uk-label uk-label-success uk-text-bold"><?= lang('statistics_top_2v2'); ?></span>
                <div class="uk-overflow-auto uk-margin-small">
                  <table class="uk-table dark-table uk-table-divider uk-table-small">
                    <thead>
                      <tr>
                        <th class="uk-width-small"><?= lang('team_name'); ?></th>
                        <th class="uk-width-small"><?= lang('members'); ?></th>
                        <th class="uk-width-small"><?= lang('rating'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($this->pvp_model->get_teams_2v2($realm->id) as $tops2v2): ?>
                        <tr>
                          <td><?= $tops2v2->name; ?></td>
                          <td>
                            <?php foreach ($this->pvp_model->get_team_members($realm->id, $tops2v2->arenaTeamId) as $mmberteam): ?>
                            <img class="uk-border-circle" src="<?= $template['uploads'].'icons/class/'.class_icon($this->pvp_model->get_char_class($realm->id, $mmberteam->guid)); ?>" width="20" height="20" alt="<?= $this->pvp_model->get_char_name($realm->id, $mmberteam->guid); ?>">
                            <?php endforeach; ?>
                          </td>
                          <td><?= $tops2v2->rating; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </dir>
              <div>
                <span class="uk-label uk-label-warning uk-text-bold"><?= lang('statistics_top_3v3'); ?></span>
                <div class="uk-overflow-auto uk-margin-small">
                  <table class="uk-table dark-table uk-table-divider uk-table-small">
                    <thead>
                      <tr>
                        <th class="uk-width-small"><?= lang('team_name'); ?></th>
                        <th class="uk-width-small"><?= lang('members'); ?></th>
                        <th class="uk-width-small"><?= lang('rating'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($this->pvp_model->get_teams_3v3($realm->id) as $tops3v3): ?>
                        <tr>
                          <td><?= $tops3v3->name; ?></td>
                          <td>
                            <?php foreach ($this->pvp_model->get_team_members($realm->id, $tops3v3->arenaTeamId) as $mmberteam): ?>
                            <img class="uk-border-circle" src="<?= $template['uploads'].'icons/class/'.class_icon($this->pvp_model->get_char_class($realm->id, $mmberteam->guid)); ?>" width="20" height="20" alt="<?= $this->pvp_model->get_char_name($realm->id, $mmberteam->guid); ?>">
                            <?php endforeach; ?>
                          </td>
                          <td><?= $tops3v3->rating; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <dir>
                <span class="uk-label uk-label-danger uk-text-bold"><?= lang('statistics_top_5v5'); ?></span>
                <div class="uk-overflow-auto uk-margin-small">
                  <table class="uk-table dark-table uk-table-divider uk-table-small">
                    <thead>
                      <tr>
                        <th class="uk-width-small"><?= lang('team_name'); ?></th>
                        <th class="uk-width-small"><?= lang('members'); ?></th>
                        <th class="uk-width-small"><?= lang('rating'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($this->pvp_model->get_teams_5v5($realm->id) as $tops5v5): ?>
                        <tr>
                          <td><?= $tops5v5->name; ?></td>
                          <td>
                            <?php foreach ($this->pvp_model->get_team_members($realm->id, $tops5v5->arenaTeamId) as $mmberteam): ?>
                            <img class="uk-border-circle" src="<?= $template['uploads'].'icons/class/'.class_icon($this->pvp_model->get_char_class($realm->id, $mmberteam->guid)); ?>" width="20" height="20" alt="<?= $this->pvp_model->get_char_name($realm->id, $mmberteam->guid); ?>">
                            <?php endforeach; ?>
                          </td>
                          <td><?= $tops5v5->rating; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </dir>
            </div>
            <div class="uk-margin">
              <span class="uk-label uk-text-bold"><?= lang('statistics_top_20'); ?></span>
              <div class="uk-overflow-auto uk-margin-small">
                <table class="uk-table dark-table uk-table-divider uk-table-small">
                  <thead>
                    <tr>
                      <th class="uk-table-expand"><?= lang('name'); ?></th>
                      <th class="uk-table-expand"><?= lang('race'); ?></th>
                      <th class="uk-table-expand"><?= lang('class'); ?></th>
                      <th class="uk-table-expand"><?= lang('faction'); ?></th>
                      <th class="uk-table-expand"><?= lang('total_kills'); ?></th>
                      <th class="uk-table-expand"><?= lang('today_kills'); ?></th>
                      <th class="uk-table-expand"><?= lang('yersterday_kills'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($this->pvp_model->get_top_pvp($realm->id) as $tops): ?>
                      <tr>
                        <td><?= $tops->name; ?></td>
                        <td><img class="uk-border-circle" src="<?= $template['uploads'].'icons/race/'.race_icon($tops->race); ?>" width="20" height="20" alt="Race"></td>
                        <td><img class="uk-border-circle" src="<?= $template['uploads'].'icons/class/'.class_icon($tops->class); ?>" width="20" height="20" alt="Class"></td>
                        <td><img class="uk-border-circle" src="<?= $template['uploads'].'icons/faction/'.faction_icon($tops->race); ?>" width="20" height="20" alt="Faction"></td>
                        <td><?= $tops->totalKills; ?></td>
                        <td><?= $tops->todayKills; ?></td>
                        <td><?= $tops->yesterdayKills; ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </section>
