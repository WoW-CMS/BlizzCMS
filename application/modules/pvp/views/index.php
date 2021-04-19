    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('pvp_statistics'); ?></h4>
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
                <span class="uk-label uk-label-success uk-text-bold"><?= lang('top_2v2'); ?></span>
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
                      <?php foreach ($this->pvp_model->get_top_teams($realm->id) as $team): ?>
                        <tr>
                          <td><?= $team->name; ?></td>
                          <td>
                            <?php foreach ($this->pvp_model->get_team_members($realm->id, $team->arenateamid) as $member): ?>
                            <img class="uk-border-circle" src="<?= $template['uploads'].'icons/class/'.class_icon($this->pvp_model->get_char_class($realm->id, $member->guid)); ?>" width="20" height="20" alt="<?= $this->pvp_model->get_char_name($realm->id, $member->guid); ?>">
                            <?php endforeach; ?>
                          </td>
                          <td><?= $team->rating; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </dir>
              <div>
                <span class="uk-label uk-label-warning uk-text-bold"><?= lang('top_3v3'); ?></span>
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
                      <?php foreach ($this->pvp_model->get_top_teams($realm->id, 3) as $team): ?>
                        <tr>
                          <td><?= $team->name; ?></td>
                          <td>
                            <?php foreach ($this->pvp_model->get_team_members($realm->id, $team->arenateamid) as $member): ?>
                            <img class="uk-border-circle" src="<?= $template['uploads'].'icons/class/'.class_icon($this->pvp_model->get_char_class($realm->id, $member->guid)); ?>" width="20" height="20" alt="<?= $this->pvp_model->get_char_name($realm->id, $member->guid); ?>">
                            <?php endforeach; ?>
                          </td>
                          <td><?= $team->rating; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <dir>
                <span class="uk-label uk-label-danger uk-text-bold"><?= lang('top_5v5'); ?></span>
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
                      <?php foreach ($this->pvp_model->get_top_teams($realm->id, 5) as $team): ?>
                        <tr>
                          <td><?= $team->name; ?></td>
                          <td>
                            <?php foreach ($this->pvp_model->get_team_members($realm->id, $team->arenateamid) as $member): ?>
                            <img class="uk-border-circle" src="<?= $template['uploads'].'icons/class/'.class_icon($this->pvp_model->get_char_class($realm->id, $member->guid)); ?>" width="20" height="20" alt="<?= $this->pvp_model->get_char_name($realm->id, $member->guid); ?>">
                            <?php endforeach; ?>
                          </td>
                          <td><?= $team->rating; ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </dir>
            </div>
            <div class="uk-margin">
              <span class="uk-label uk-text-bold"><?= lang('top_20'); ?></span>
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
                    <?php foreach ($this->pvp_model->get_top_pvp($realm->id) as $player): ?>
                      <tr>
                        <td><?= $player->name; ?></td>
                        <td><img class="uk-border-circle" src="<?= $template['uploads'].'icons/race/'.race_icon($player->race); ?>" width="20" height="20" alt="Race"></td>
                        <td><img class="uk-border-circle" src="<?= $template['uploads'].'icons/class/'.class_icon($player->class); ?>" width="20" height="20" alt="Class"></td>
                        <td><img class="uk-border-circle" src="<?= $template['uploads'].'icons/faction/'.faction_icon($player->race); ?>" width="20" height="20" alt="Faction"></td>
                        <td><?= $player->totalKills; ?></td>
                        <td><?= $player->todayKills; ?></td>
                        <td><?= $player->yesterdayKills; ?></td>
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
