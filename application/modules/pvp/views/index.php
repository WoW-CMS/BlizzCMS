    <section class="uk-section uk-section-small header-section">
      <div class="uk-container">
        <div class="uk-grid uk-grid-small uk-margin-top uk-margin-bottom" data-uk-grid>
          <div class="uk-width-expand">
            <h4 class="uk-h4 uk-text-uppercase uk-text-bold"><?= lang('pvp_statistics') ?></h4>
          </div>
          <div class="uk-width-auto"></div>
        </div>
      </div>
    </section>
    <section class="uk-section uk-section-xsmall main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <div class="uk-grid uk-grid-medium" data-uk-grid>
          <div class="uk-width-1-4@m">
            <div class="uk-card uk-card-default">
              <div class="uk-card-header">
                <h5 class="uk-h5 uk-text-bold"><i class="fas fa-server"></i> <?= lang('realm') ?></h5>
              </div>
              <ul class="uk-nav uk-nav-default aside-nav" uk-switcher="connect: #realm-statistics;animation: uk-animation-fade">
                <?php foreach ($realms as $realm): ?>
                <li><a href="#"><?= $realm->name ?></a></li>
                <?php endforeach ?>
              </ul>
            </div>
          </div>
          <div class="uk-width-3-4@m">
            <ul id="realm-statistics" class="uk-switcher">
              <?php foreach ($realms as $realm): ?>
              <li>
                <h5 class="uk-h5 uk-text-bold uk-margin-small"><i class="fas fa-trophy"></i> <?= lang('top_arena_teams') ?></h5>
                <div class="uk-grid uk-grid-small uk-child-width-1-1 uk-child-width-1-3@m" data-uk-grid>
                  <div>
                    <div class="uk-card uk-card-default">
                      <div class="uk-card-header">
                        <h5 class="uk-h5 uk-text-bold"><?= lang('teams_2v2') ?></h5>
                      </div>
                      <div class="uk-card-body uk-padding-remove">
                        <div class="uk-overflow-auto">
                          <table class="uk-table uk-table-small uk-table-divider">
                            <tbody>
                              <?php foreach ($this->pvp_model->get_top_teams($realm->id) as $t => $team): ?>
                              <tr>
                                <td><?= ordinal($t+1) ?></td>
                                <td>
                                  <h5 class="uk-h5 uk-text-bold uk-margin-remove"><?= $team->name ?></h5>
                                  <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= $team->rating ?> <?= lang('rating') ?></p>
                                  <?php foreach ($this->pvp_model->get_team_members($realm->id, $team->arenateamid) as $member): ?>
                                  <img class="uk-border-circle" src="<?= $template['uploads'].'icons/class/'.$this->pvp_model->get_char_class($realm->id, $member->guid).'.png' ?>" width="20" height="20" alt="Class" uk-tooltip="<?= $this->pvp_model->get_char_name($realm->id, $member->guid) ?>">
                                  <?php endforeach ?>
                                </td>
                              </tr>
                              <?php endforeach ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div>
                    <div class="uk-card uk-card-default">
                      <div class="uk-card-header">
                        <h5 class="uk-h5 uk-text-bold"><?= lang('teams_3v3') ?></h5>
                      </div>
                      <div class="uk-card-body uk-padding-remove">
                        <div class="uk-overflow-auto">
                          <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
                            <tbody>
                              <?php foreach ($this->pvp_model->get_top_teams($realm->id, 3) as $t => $team): ?>
                              <tr>
                                <td><?= ordinal($t+1) ?></td>
                                <td>
                                  <h5 class="uk-h5 uk-text-bold uk-margin-remove"><?= $team->name ?></h5>
                                  <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= $team->rating ?> <?= lang('rating') ?></p>
                                  <?php foreach ($this->pvp_model->get_team_members($realm->id, $team->arenateamid) as $member): ?>
                                  <img class="uk-border-circle" src="<?= $template['uploads'].'icons/class/'.$this->pvp_model->get_char_class($realm->id, $member->guid).'.png' ?>" width="20" height="20" alt="Class" uk-tooltip="<?= $this->pvp_model->get_char_name($realm->id, $member->guid) ?>">
                                  <?php endforeach ?>
                                </td>
                              </tr>
                              <?php endforeach ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div>
                    <div class="uk-card uk-card-default">
                      <div class="uk-card-header">
                        <h5 class="uk-h5 uk-text-bold"><?= lang('teams_5v5') ?></h5>
                      </div>
                      <div class="uk-card-body uk-padding-remove">
                        <div class="uk-overflow-auto">
                          <table class="uk-table uk-table-small uk-table-divider">
                            <tbody>
                              <?php foreach ($this->pvp_model->get_top_teams($realm->id, 5) as $t => $team): ?>
                              <tr>
                                <td><?= ordinal($t+1) ?></td>
                                <td>
                                  <h5 class="uk-h5 uk-text-bold uk-margin-remove"><?= $team->name ?></h5>
                                  <p class="uk-text-small uk-margin-remove-top uk-margin-small-bottom"><?= $team->rating ?> <?= lang('rating') ?></p>
                                  <?php foreach ($this->pvp_model->get_team_members($realm->id, $team->arenateamid) as $member): ?>
                                  <img class="uk-border-circle" src="<?= $template['uploads'].'icons/class/'.$this->pvp_model->get_char_class($realm->id, $member->guid).'.png' ?>" width="20" height="20" alt="Class" uk-tooltip="<?= $this->pvp_model->get_char_name($realm->id, $member->guid) ?>">
                                  <?php endforeach ?>
                                </td>
                              </tr>
                              <?php endforeach ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <h5 class="uk-h5 uk-text-bold uk-margin-top uk-margin-small-bottom"><i class="fas fa-medal"></i> <?= lang('top_honorable_kills') ?></h5>
                <div class="uk-card uk-card-default">
                  <div class="uk-card-body uk-padding-remove">
                    <div class="uk-overflow-auto">
                      <table class="uk-table uk-table-small uk-table-divider">
                        <thead>
                          <tr>
                            <th class="uk-width-small"><?= lang('rank') ?></th>
                            <th class="uk-table-expand"><?= lang('name') ?></th>
                            <th class="uk-width-small"><?= lang('level') ?></th>
                            <th class="uk-width-small"><?= lang('race') ?></th>
                            <th class="uk-width-small"><?= lang('class') ?></th>
                            <th class="uk-width-small"><?= lang('total_kills') ?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($this->pvp_model->get_top_pvp($realm->id) as $p => $player): ?>
                          <tr>
                            <td><?= ordinal($p+1) ?></td>
                            <td><?= $player->name ?></td>
                            <td><?= $player->level ?></td>
                            <td><img class="uk-border-circle" src="<?= $template['uploads'].'icons/race/'.$player->race.'-'.$player->gender.'.png' ?>" width="20" height="20" alt="<?= race_name($player->race) ?>"></td>
                            <td><img class="uk-border-circle" src="<?= $template['uploads'].'icons/class/'.$player->class.'.png' ?>" width="20" height="20" alt="<?= class_name($player->class) ?>"></td>
                            <td><?= $player->totalKills ?></td>
                          </tr>
                          <?php endforeach ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </li>
              <?php endforeach ?>
            </ul>
          </div>
        </div>
      </div>
    </section>
