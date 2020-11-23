## Refactor

### Changes

- Add missing languages to system
- Update HMVC
- Add pagination library to autoload
- Use ``lang`` (helper function) instead ``$this->lang->line()``
- Use config ``time_reference`` instead function ``date_default_timezone_set()`` on each controller
- Remove unused function ``$this->wowgeneral->getMaxLevel()``
- Remove unused function ``$this->wowgeneral->getExpansionName()``
- Remove unused function ``$this->wowgeneral->getGender()``
- Remove function ``$this->wowgeneral->getMaintenance()``
- Remove function ``$this->wowauth->getMaintenancePermission()``
- Remove function ``$this->wowauth->sessionConnect()``
- Remove unused function ``$this->wowauth->getRankByLevel()``
- Remove unused function ``$this->wowauth->getSpecifyEmail()``
- Remove unused function ``$this->wowauth->getExpansionID()``
- Remove unused function ``$this->wowauth->getLastIPID()``
- Remove unused function ``$this->wowauth->getLastLoginID()``

### Bugs Fixed

- 

### Deprecations

- Deprecated ``$this->wowgeneral->getTimestamp()`` in favor of ``now()``
- Deprecated ``$this->wowgeneral->getRaceName()`` in favor of ``race_name()``
- Deprecated ``$this->wowgeneral->getRaceIcon()`` in favor of ``race_icon()``
- Deprecated ``$this->wowgeneral->getClassName()`` in favor of ``class_name()``
- Deprecated ``$this->wowgeneral->getClassIcon()`` in favor of ``class_icon()``
- Deprecated ``$this->wowgeneral->getFaction()`` in favor of ``faction_icon()``
- Deprecated ``$this->wowgeneral->moneyConversor()`` in favor of ``money_converter()``
- Deprecated ``$this->wowgeneral->moneyConversor()`` in favor of ``time_converter()``
