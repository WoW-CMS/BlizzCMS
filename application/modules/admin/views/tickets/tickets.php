<section class="uk-section uk-section-xsmall" data-uk-height-viewport="expand: true">
  <div class="uk-container uk-container-xlarge">
    <div class="uk-grid uk-grid-small uk-margin-small" data-uk-grid>
      <div class="uk-width-expand uk-heading-line">
        <h3 class="uk-h3"><i class="fas fa-scroll"></i> <?= $this->lang->line('admin_nav_Tickets'); ?> > <?= $this->wowrealm->getRealmName($idlink); ?></h3>
      </div>
      <div class="uk-width-auto">
        <a href="<?= base_url('admin/tickets'); ?>" class="uk-icon-button"><i class="fas fa-arrow-circle-left"></i></a>
      </div>
    </div>
    <div class="uk-grid uk-grid-small" data-uk-grid>
      <div class="uk-width-1-1">
        <div class="uk-card uk-card-default uk-card-body">
          <div class="uk-overflow-auto">
            <table class="uk-table uk-table-middle uk-table-divider uk-table-small">
              <thead>
                <tr>
                  <th class="uk-width-small"><?= $this->lang->line('table_header_id'); ?></th>
                  <th class="uk-width-medium"><?= $this->lang->line('table_header_name'); ?></th>
                  <th class="uk-width-large uk-text-center"><?= $this->lang->line('placeholder_subject'); ?></th>
                  <th class="uk-width-small uk-text-center"><?= $this->lang->line('table_header_time'); ?></th>
                  <th class="uk-width-medium uk-text-center"><?= $this->lang->line('table_header_actions'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php if(isset($ticketsList) && !empty($ticketsList)): ?>
                <?php foreach($ticketsList as $ticket): ?>
                <tr>
                  <td><?= $ticket->id ?></td>
                  <td><?= $ticket->name ?></td>
                  <td><?= $ticket->description ?></td>
                  <td class="uk-text-center uk-text-mute"><?= date('H:i, d Y', $ticket->createTime); ?></td>
                  <td class="uk-text-center">
                    <a class="uk-button uk-button-primary uk-margin-small-right" href="#ticket-<?= $ticket->id ?>" uk-toggle><i class="fas fa-info-circle fa-lg"></i></a>
                    <div id="ticket-<?= $ticket->id ?>" uk-modal>
                      <div class="uk-modal-dialog" style="width: 960px;">
                        <button class="uk-modal-close-default" type="button" uk-close></button>
                        <div class="uk-modal-header">
                          <h2 class="uk-modal-title"><?= $this->lang->line('admin_nav_Tickets'); ?> <i class="fas fa-hashtag"></i> <?= $ticket->id ?> - <?= $ticket->name ?></h2>
                        </div>
                        <div class="uk-modal-body">
                          <div class="uk-scrollspy-inview uk-animation-slide-bottom" uk-scrollspy-class="">
                            <div class="uk-column-1-1 uk-column-1-2@s uk-column-divider">
                              <div>
                                <p class="uk-text-small"><i class="fas fa-hashtag"></i> <?= $this->lang->line('table_header_guid'); ?> : <?= $ticket->playerGuid ?></p>
                                <p class="uk-text-small"><i class="fas fa-user-circle"></i> <?= $this->lang->line('table_header_id'); ?> : <?= $this->wowrealm->getAccountCharGuid($multirealm, $ticket->playerGuid) ?> </p>
                                <p class="uk-text-small"><i class="fas fa-layer-group"></i> <?= $this->lang->line('table_header_level'); ?> : <?= $this->wowrealm->getCharLevel($ticket->playerGuid, $multirealm) ?></p>
                                <p class="uk-text-small"><i class="fas fa-question"></i></i> <?= $this->lang->line('table_header_status'); ?> : <?php if($this->wowrealm->getCharActive($ticket->playerGuid, $multirealm) == '1'): ?> <b><?= $this->lang->line('online') ?></b> <?php else: ?> <b><?= $this->lang->line('offline') ?></b> <?php endif; ?> </p>
                                <p class="uk-text-small"><i class="fas fa-server"></i> <?= $this->lang->line('table_header_realm'); ?> : <?= $this->wowrealm->getRealmName($idlink) ?></p>
                              </div>
                              <div>
                                <p class="uk-text-small"><i class="fas fa-info-circle"></i> <?= $this->lang->line('table_header_race'); ?> : <?= $this->wowgeneral->getRaceName($this->wowrealm->getCharRace($ticket->playerGuid, $multirealm)) ?></p>
                                <p class="uk-text-small"><i class="fas fa-info-circle"></i> <?= $this->lang->line('table_header_class'); ?> : <?= $this->wowgeneral->getClassName($this->wowrealm->getCharClass($ticket->playerGuid, $multirealm)) ?></span></p>
                                <p class="uk-text-small"><i class="fas fa-info-circle"></i> <?= $this->lang->line('table_header_faction'); ?> : <?= $this->wowgeneral->getFaction($this->wowrealm->getCharRace($ticket->playerGuid, $multirealm)) ?></p>
                                <p class="uk-text-small"><i class="fas fa-star"></i> <?= $this->lang->line('panel_last_ip'); ?> : <?= $this->wowauth->getLastIPID($this->wowrealm->getAccountCharGuid($multirealm, $ticket->playerGuid)) ?> </span></p>
                                <p class="uk-text-small"><i class="fas fa-clock"></i> <?= $this->lang->line('table_header_date'); ?> : <?= date('H:i, m/d/Y', $ticket->createTime); ?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
          <div class="uk-card-footer">
            <div class="uk-text-right">
              <?php if (isset($ticketsList) && is_array($ticketsList)) echo $pagination_links; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
