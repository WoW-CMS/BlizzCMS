<section class="uk-section uk-padding-remove bc-slider-section">
    <div class="uk-position-relative uk-visible-toggle" uk-slideshow="animation: fade; autoplay: true; autoplay-interval: 10000; pause-on-hover: true; min-height: 125; max-height: 250">
        <ul class="uk-slideshow-items">
            <li>
                <img src="assets/images/placeholder.jpg" alt="Título del Slide" uk-cover>
                <div class="uk-container uk-position-relative uk-margin-large-top">
                    <h2 class="uk-h2 uk-position-medium uk-text-left uk-margin-remove">Título del Slide</h2>
                    <p class="uk-position-medium uk-text-left uk-margin-remove">Descripción del Slide</p>
                </div>
            </li>
        </ul>
        <div class="uk-position-bottom-center uk-position-small">
            <ul class="uk-slideshow-nav uk-dotnav"></ul>
        </div>
    </div>
</section>

<section class="uk-section uk-section-xsmall bc-default-section" uk-height-viewport="expand: true">
    <div class="uk-container">
        <div class="uk-margin" uk-grid>
            <div class="uk-width-3-5@s uk-width-2-3@m">
                <h3 class="uk-h4 uk-text-bold uk-margin-small">Últimas Noticias</h3>
                <div class="uk-grid-medium uk-child-width-1-1" uk-grid>
                    <?php if (! empty($articles) && is_array($articles)): ?>
                        <?php foreach ($articles as $article_item): ?>
                            <div>
                                <div class="uk-card uk-card-default uk-card-hover uk-grid-collapse" uk-grid>
                                    <div class="uk-width-1-3@s uk-card-media-left uk-cover-container">
                                        <img src="<?= esc($article_item->image_url) ?>" alt="Título de la Noticia" uk-cover>
                                        <canvas width="500" height="250"></canvas>
                                    </div>
                                    <div class="uk-width-2-3@s">
                                        <div class="uk-card-body">
                                            <h4 class="uk-h4 uk-text-bold uk-margin-remove">
                                                <a class="uk-link-reset" href="#"><?= esc($article_item->title) ?></a>
                                            </h4>
                                            <p class="uk-text-meta uk-margin-remove-top uk-margin-small-bottom">
                                                <i class="fa-solid fa-calendar-day"></i> <time datetime="2024-03-26"><?= esc($article_item->published_at) ?></time>
                                            </p>
                                            <p class="uk-text-small uk-margin-small"><?= esc(strlen($article_item->content) > 100 ? substr($article_item->content, 0, 300) . '...' : $article_item->content) ?></p>
                                            <div class="uk-grid-small uk-flex uk-flex-middle uk-margin-top" uk-grid>
                                                <div class="uk-width-expand uk-text-meta">
                                                    <span class="uk-margin-small-right" uk-tooltip="Comentarios"><i class="fa-solid fa-comment"></i> <?= esc($article_item->view_count) ?></span> <span uk-tooltip="Vistas"><i class="fa-solid fa-eye"></i> <?= esc($article_item->view_count) ?></span>
                                                </div>
                                                <div class="uk-width-auto">
                                                    <a href="#" class="uk-button uk-button-default uk-button-small">Leer Más</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="uk-width-2-5@s uk-width-1-3@m">
                <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                        <h5 class="uk-h5 uk-text-bold uk-margin-remove">Estado del Reino</h5>
                    </div>
                    <div class="uk-card-body">
                        <div class="uk-grid-small" uk-grid>
                            <div class="uk-width-expand">
                                <h5 class="uk-h5 uk-text-bold uk-margin-small">Nombre del Reino</h5>
                            </div>
                            <div class="uk-width-auto">
                                <div class="bc-status-dot"></div>
                            </div>
                        </div>
                        <div class="bc-stacked-bars">
                            <div class="bc-progressbar bc-alliance-bar" style="width: 80%"></div>
                            <div class="bc-progressbar bc-horde-bar" style="width: 20%"></div>
                        </div>
                        <div class="bc-realmlist">
                            <i class="fa-solid fa-gamepad"></i> Realmlist : Test.realm.com
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
