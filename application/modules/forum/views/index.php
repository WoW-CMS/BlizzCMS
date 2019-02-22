    <section class="uk-section uk-section-xsmall uk-padding-remove slider-section">
      <div class="uk-background-cover uk-height-small header-section"></div>
    </section>
    <section class="uk-section uk-section-small main-section" data-uk-height-viewport="expand: true">
      <div class="uk-container">
        <?php foreach($this->forum_model->getCategory() as $categorys): ?>
        <?php if($this->forum_model->getCategoryRows($categorys->id)): ?>
        <h5 class="uk-h5 uk-margin-small uk-text-uppercase uk-text-break"><i class="far fa-bookmark"></i> <?= $categorys->categoryName ?></h5>
        <?php endif; ?>
        <div class="uk-grid uk-grid-small uk-width-1-1 uk-child-width-1-3@m" uk-scrollspy="cls: uk-animation-fade" data-uk-grid>
          <?php foreach($this->forum_model->getCategoryForums($categorys->id) as $sections): ?>
          <?php if ($sections->type == 1 || $sections->type == 3): ?>
          <div>
            <a href="<?= base_url('forum/category/'.$sections->id) ;?>">
              <div class="uk-card uk-card-forum uk-card-hover">
                <div class="uk-card-body">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-auto">
                      <i class="card-icon" style="background-image: url('<?= base_url('includes/images/forums/'.$sections->icon); ?>')"></i>
                    </div>
                    <div class="uk-width-expand">
                      <h4 class="uk-h4 uk-margin-remove uk-text-break"><?= $sections->name ?></h4>
                      <p class="uk-margin-remove uk-text-break"><?= $sections->description ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <?php elseif($sections->type == 2): ?>
          <?php if($this->m_data->isLogged()): ?>
          <?php if($this->m_data->getRank($this->session->userdata('fx_sess_id')) > 0): ?>
          <div>
            <a href="<?= base_url('forum/category/'.$sections->id) ;?>">
              <div class="uk-card uk-card-forum uk-card-hover">
                <div class="uk-card-body">
                  <div class="uk-grid uk-grid-small" data-uk-grid>
                    <div class="uk-width-auto">
                      <i class="card-icon" style="background-image: url('<?= base_url('includes/images/forums/'.$sections->icon); ?>')"></i>
                    </div>
                    <div class="uk-width-expand">
                      <h4 class="uk-h4 uk-margin-remove uk-text-break"><?= $sections->name ?></h4>
                      <p class="uk-margin-remove uk-text-break"><?= $sections->description ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <?php endif; ?>
          <?php endif; ?>
          <?php endif; ?>
          <?php endforeach; ?>
        </div>
        <div class="space-large"></div>
        <?php endforeach; ?>
      </div>
    </section>
