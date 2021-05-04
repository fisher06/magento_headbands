# test_headbands
## A simple module for Magento 2.4
The module is a directory that contains blocks, controllers, models, helper, etc...

## Magento 2’s Architecture
Each folder holds one part of the architecture, as follows:

  **Api**: includes any PHP classes which are exposed to the API.
  
  **Block**: includes PHP view classes as part of module logic Model View Controller(MVC) vertical implementation.
  
  **Controller**: includes PHP controller classes as part of module logic MVC vertical implementation.
  
  **etc**: includes configuration files; especially the module.xml, which is required.
  
  **Helper**: includes aggregated functionality.
  
  **i18n**: includes localization files.
  
  **Model**: includes PHP model classes as part of module logic MVC vertical implementation.
  
  **Observer**: includes files for executing commands which are from the listener.
  
  **Setup**: includes classes for module database structure and data setup. These data are invoked when installing or upgrading.
  
  **Ui**: includes data generation files.
  
  **view**: includes view files, containing static view files, email templates, design templates, and layout files.
 
## Create module for Magento 2

### Step 1: Create etc/module.xml file.
Create etc folder and add the module.xml file   
app/code/Test/Headbands/etc/module.xml
```
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="../../../../../lib/internal/Magento/Framework/Module/etc/module.xsd">
    <module name="Test_Headbands" setup_version="0.1.0">
        <sequence>
            <module name="Magento_Directory" />
            <module name="Magento_Config" />
        </sequence>
    </module>
</config>
```
### Step 2: Create etc/registration.php file
app/code/Test/Headbands/registration.php
```
<?php

\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'Test_Headbands',
    __DIR__
);
```
### Step 3: Enable the module
Run the command as:
```
#List of modules
php bin/magento module:status
#Enable the module
php bin/magento module:enable Test_Headbands
#Upgrade the database
php bin/magento setup:upgrade
```
### Step 4: Handling Data Storage
app/code/Test/Headbands/Setup/InstallSchema.php

### Step 5: Create CRUD Models - Resource Model and Model Collection

### Step 6: Create Admin Grid
#### Create routes admin
#### Create routes admin
#### Create admin menu
#### Create Controller
#### Create Admin Grid using Component || using Layout
##### uiForm Branch
##### main Branch

### Step 7: Create 
