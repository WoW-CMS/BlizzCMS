## Refactor

### Changes

- Add missing languages to system
- Update HMVC
- Add pagination library to autoload
- Use ``lang()`` (helper function) instead ``$this->lang->line()``
- Use config ``time_reference`` instead function ``date_default_timezone_set()`` on each controller
- Add load settings from db
- Rename global models ``$this->website`` instead ``$this->wowauth``, ``$this->base`` instead ``$this->wowgeneral`` and ``$this->realm`` instead ``$this->wowrealm``
- Remove global model ``Module``
- Use ``layouts`` views for default theme instead different ``theme`` folders
- Remove unused function ``$this->base->getMaxLevel()``
- Remove unused function ``$this->base->getExpansionName()``
- Remove unused function ``$this->base->getGender()``
- Remove function ``$this->base->getMaintenance()``
- Remove function ``$this->website->getMaintenancePermission()``
- Remove function ``$this->website->sessionConnect()``
- Remove unused function ``$this->website->getRankByLevel()``
- Remove unused function ``$this->website->getSpecifyEmail()``
- Remove unused function ``$this->website->getExpansionID()``
- Remove unused function ``$this->website->getLastIPID()``
- Remove unused function ``$this->website->getLastLoginID()``
- Remove unneeded ``->select('*')``
- Rename session data
- Remove function ``$this->home_model->getDiscordInfo()``
- Use ``config_item()`` instead ``$this->config->item()``
- Use ``$template['title']`` in HTML title tag
- Move home module to main controllers
- Move news module to main controllers
- Move page module to main controllers
- Override function ``show_404()``

### Bugs Fixed

- 

### Deprecations

- Deprecated ``$this->base->getTimestamp()`` in favor of ``now()``
- Deprecated ``$this->base->getRaceName()`` in favor of ``race_name()``
- Deprecated ``$this->base->getRaceIcon()`` in favor of ``race_icon()``
- Deprecated ``$this->base->getClassName()`` in favor of ``class_name()``
- Deprecated ``$this->base->getClassIcon()`` in favor of ``class_icon()``
- Deprecated ``$this->base->getFaction()`` in favor of ``faction_icon()``
- Deprecated ``$this->base->moneyConversor()`` in favor of ``money_converter()``
- Deprecated ``$this->base->moneyConversor()`` in favor of ``time_converter()``
- Deprecated ``$this->base->getMenu()`` in favor of ``$this->base->get_menu()``
- Deprecated ``$this->base->getMenuChild()`` in favor of ``$this->base->get_parent_menu()``
- Deprecated ``$this->home_model->getSlides()`` in favor of ``$this->base->get_slides()``
- Deprecated ``$this->news_model->getCommentCount()`` in favor of ``$this->base->count_news_comments()``