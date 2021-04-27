# test_headbands
A simple module for Magento 2.4

The module is a directory that contains blocks, controllers, models, helper, etc...

Magento 2’s Architecture
Each folder holds one part of the architecture, as follows:
  Api: includes any PHP classes which are exposed to the API.
  Block: includes PHP view classes as part of module logic Model View Controller(MVC) vertical implementation.
  Controller: includes PHP controller classes as part of module logic MVC vertical implementation.
  etc: includes configuration files; especially the module.xml, which is required.
  Helper: includes aggregated functionality.
  i18n: includes localization files.
  Model: includes PHP model classes as part of module logic MVC vertical implementation.
  Observer: includes files for executing commands which are from the listener.
  Setup: includes classes for module database structure and data setup. These data are invoked when installing or upgrading.
  Ui: includes data generation files.
  view: includes view files, containing static view files, email templates, design templates, and layout files.

