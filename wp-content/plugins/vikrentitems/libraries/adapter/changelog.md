# Framework Changelog

### 10.1.30

*Release date - 03 November 2020*

##### ADD

* Implemented `JPayment::getOrder()` and `JPayment::getParams()` methods.
* Implemented `JController` redirect methods.
* Implemented `JController::registerTask()` method.
* Implemented `JTable` management methods.
* `JTable` now extends `JObject` to support the errors management.
* Implemented `JDatabaseQuery::selectRowNumber()` method.
* Created `JHtmlContentLanguage` class.
* Implemented `JeventDispatcher::register()` method.
* Added `isset` magic method to `JUser` class.
* Implemented SMS framework.
* Created `JHelperUsergroups` class.
* Implemented `JModuleHelper::getModule()` method.
* Added support for `$module` object while displaying a widget.
* Implemented `VikRequest::setCookie()` method.

##### CHANGE

* `JHtmlFormbehavior::chosen` do not use anymore select2 for dropdowns rendering.
* `JConfig` is now able to recover the list_limit also in case of AJAX requests.
* `JInputCookie::set()` now supports an array of options.

##### FIX

* `JHtml::script()` is now able to load different scripts with the same base name.
* `JHtml::stylesheet()` is now able to load different files with the same base name.
* Fixed wrong class on `JHtml::date()`.
* Fixed ID notation for toolbar buttons.
* Fixed `JHtmlFormBehavior::choosen()` script declaration in case of select with no options.
* `JHtmlBootstrap::tooltip()` now appends by default the tooltip at the end of the body.
* `JDate` now uses the correct localized names of months.
* The input now contains a clean task without the controller after the execution.
* Fixed JS plugins usage after saving a widget.

### 10.1.29

*Release date - 15 September 2020*

##### ADD

* Implemented further request methods on `JHttp` class.
* Implemented `JHtml::addIncludePath()` method.
* Added support for `JEvent` abstract class.
* `JEventDispatcher::attach()` method is now able to register the methods of a class as hooks.

##### FIX

* Form fieldsets do not report the title in case it shouldn't be displayed.
* Fixed missing default value when rendering a form.
* The system now automatically generates an ID in case `JFormField` doesn't specify it.
* Added support for text domains that might include hyphens.
* Fixed headers when sending an HTTP request through `JHttp`.
* Scripts declarations are now properly loaded on AJAX requests.
* Fixed URL encoding while creating the query string.

### 10.1.28

*Release date - 14 May 2020*

##### ADD

* Implemented `JDate::monthToString()` method.
* Implemented `JLanguage::getFirstDay()` method.
* Implemented `JLanguage::isRtl()` method.
* Added support for `vik_widget_before_dispatch_site` action.
* Added support for `vik_widget_after_dispatch_site` action.
* Added support for `vik_plugin_load_language` filter.

##### FIX

* TinyMCE editor is now able to set/get contents even if not active.
* Popovers always use "body" as container.
* Widgets overrides are now supported also for **Windows** platforms.
* `JDate::format()` is now able to translate days and months.

---

### 10.1.27

*Release date - 20 November 2019*

##### ADD

* Implemented `JForm::bind()` method.
* Added support for options and attributes in `JHtml::stylesheet()`.

##### FIX

* `JRoute` now supports also query string parameters of type `array`.
* Fixed an issue that prevented to display HTML tags within popovers.
* View overrides are now supported also for **Windows** platforms.
* `JObject::get()` now returns the default value also for NULL properties.
* `JInputFilter::clean()` now properly unslashes escaped values from arrays.

---

### 10.1.26

*Release date - 25 October 2019*

##### CHANGE

* `JVersion::getShortVersion()` now tries to extract a short version from any nightlies
* Added support for **joomla.version** classmap within `jimport`

---

### 10.1.25

*Release date - 19 September 2019*

##### ADD

* Added support for `vik_before_include_script` filter
* Added support for `vik_before_include_style` filter

---

### 10.1.24

*Release date - 11 July 2019*

##### ADD

* Implemented `JInput::delete()` method
* Added support for `allowUserRegistration` users setting
* Created `JModelLegacy` alias
* Implemented `JModel::addIncludePath()` method to search models on several directories
* Added support for native `UsersModelRegistration` class/model
* Added support for `groups` property in `JUser` class

##### CHANGE

* Changed the overrides path for the layout files of the plugins
* `JLanguage` is now able to auto-detect the standard languages folder
* All the superglobals are now passed by reference while instantiating `JInput`

---

### 10.1.23

*Release date - 21 June 2019*

##### ADD

* Created `JFilterInput` alias
* Added support for internal list limit (screen options)
* Created `JHttp` class and response adapter
* Implemented `JFile::exists()` method

##### FIX

* Fixed `JDatabaseQuery::clear()` method, which was emptying all in case of unsupported statements
* Fixed `JDocument::setTitle()` method to use the correct WP hook
* Fixed `JEventDispatcher` class to support return values and referenced arguments (apply_filters_ref_array)

---

### 10.1.22

*Release date - 10 June 2019*

##### ADD

* Added support for jQuery in `<head>` every time a widget is instantiated

##### CHANGE

* `JHtmlBehavior::component()` now excludes styles and links from being removed

##### FIX

* Fixed the way the scripts are loaded after adding a new widget
* `JHtml::calendar()` is now able to fetch timestamps with `string` type

---

### 10.1.21

*Release date - 07 June 2019*

##### ADD

* Added support for `vik_date_default_timezone` filter
* `JController` displays a minified error in case of AJAX requests (exceptions component handling)
* `JSession::start()` adds a filter to close the session every time wp_remote_post() is called (Site Health issue)
* Added support for **spacer** form field

##### CHANGE

* `JPagination` is now able to use a default layout in case it was not forced
* `JHtml::script()` now supports jQuery UI Slider addon
* Menu Item field now recovers the shortcode prefix from `modowner` property
* Widget language handlers can be placed also within "languages" folder
* Widgets now support module class suffix parameter
* Widgets now support a default **title** field
* Widgets now support Joomla JS instance
* Widgets now strip HTML tags from the description
* The `JWidget::useScript()` method now loads select2 JS plugin

##### FIX

* Fixed **languages** configuration settings, which were returning an empty string for default locale

---

### 10.1.20

*Release date - 29 May 2019*

##### ADD

* Added `JCryptCipherCrypto` and `JCryptKey` classes
* Added some `JDocument` methods to access HTML properties (dir, charset and lang)
* Implemented `JView::escape()` method
* Editors now support a custom id

##### CHANGE

* Completed `JPathwaySite` implementation
* Changed control "id" attribute into "idfield" (@see `JForm`)
* `JHtml::script()` is now able to include tooltip add-on

##### FIX

* Fixed usage of layouts, which are now compatible with widgets
* Fixed `JForm` to start supporting custom options

---

### 10.1.19

*Release date - 27 May 2019*

##### ADD

* Added `JHtmlDate` helper class for relative dates
* Implemented `JDate::__toString()` magic method
* Implemented `JText::plural()` method for string pluralizations
* Added support for behavior.modal helper
* Bootstrap modals can be closed using ESC button (only if specified)
* Implemented `JMenu` class and its child for site client
* Implemented `JApplication::getMenu()` method
* `JView` now owns the document property 
* Added `JTable` class and default children classes
* Implemented `JDatabase::getTableColumns()` method
* Added `JPathway` class and its child for site client
* Implemented `JApplication::getPathway()` method
* Added `JRouter` class and some native classes
* Implemented `JApplication::getRouter()` method

##### CHANGE

* `JHtml::script()` now includes dialog add-on when jQuery UI is called

##### FIX

* Fixed the way `JHtml::script()` generates ID, if not provided
* Fixed `JRoute` to start supporting external routers
* Fixed `JHtmlBehavior::component()` method to exclude `script` tags

---

### 10.1.18

*Release date - 23 May 2019*

##### ADD

* Implemented `JFormFieldMedia`
* Added `JRegistry` proxy
* Added `JPath::find()` method

##### CHANGE

* Changed usage of layouts

##### FIX

* Fixed default style generated by `JHtmlBehavior::renderModal()`
* Fixed `JView` to consider custom layouts properly

---

### 10.1.17

*Release date - 21 May 2019*

##### ADD

* Implemented `JHtmlNumber` class
* Added `JLayoutFile::escape()` method
* System editors are now accessible via javascript

##### CHANGE

* `JHtml::script()` now supports options and attributes
* `JDocument::addScriptDeclaration()` doesn't check anymore if the script has been already used

##### FIX

* Fixed `JHtml::script()` dependencies detection
* Fixed TinyMCE bug while accessing it via AJAX more than once

---

### 10.1.16

*Release date - 16 May 2019*

##### ADD

* Implemented `JVersion` class
* Implemented `JHtmlFormbehavior` class
* Implemented `JHtmlSelect` class
* Implemented `JHtmlBootstrap` class
* Implemented `JHtmlUser` class
* Implemented `JHtmlAccess` class
* Implemented `ArrayHelper` class
* Added `JComponentHelper::getComponent()` method
* Added `JDate::dayToString()` method
* Added support for 2 new events
* `JDatabase` now converts `#__users` columns to WordPress standards

##### FIX

* Fixed `JAccess::checkGroup()` method that didn't adjust caps in case of no asset key
* Fixed `JHtml::calendar()` method to start supporting timestamp and `JDate` arguments
* Fixed `JForm::load()` method to support [addincludepath] attributes based on Joomla paths
* Fixed `JMail::addRecipient()` notice
* Fixed usage of `JInputFiles` and `VikRequest` classes

---

### 10.1.15

*Release date - 07 May 2019*

##### ADD

* Added `JApplication::getUserState()` method
* Added `JApplication::setUserState()` method
* Added `JView::getName()` method

##### FIX

* Fixed how `JDatabase` handles the query limits

---

### 10.1.14

*Release date - 30 April 2019*

* Added support for javascript `JText` class

---

### 10.1.13

*Release date - 18 April 2019*

* Added filters to show/hide/suppress database errors

---

### 10.1.12

*Release date - 08 March 2019*

* Fixed `JText::sprintf()` that was always considering strings for JS purposes

---

### 10.1.11

*Release date - 19 February 2019*

* Added support for `JEventDispatcher` class

---

### 10.1.10

*Release date - 14 February 2019*

* Fixed `JFactory::getMailer()` method

---

### 10.1.9

*Release date - 31 January 2019*

* Implemented language form field

---

### 10.1.8

*Release date - 28 January 2019*

##### ADD

* Added support for empty Itemid

##### FIX

* Fixed router in case of no shortcodes found

---

### 10.1.7

*Release date - 14 January 2019*

* Added getters to `JUri` class

---

### 10.1.6

*Release date - 29 November 2018*

##### ADD

* Added  `JMail::useSmtp()` method
* Added setter magic method in `JMail` class

---

### 10.1.5

*Release date - 21 November 2018*

##### ADD

* Added `JApplication::logout()` method
* Added `JDatabase::getNullDate()` method

---

### 10.1.4

*Release date - 09 November 2018*

##### ADD

* Created `JConfig` class, used to wrap the system configuration.
* Implemented `JFactory::getConfig()` method to return a `JConfig` object.
* Added support for sitename setting.

---

### 10.1.3

*Release date - 03 October 2018*

##### ADD

* Implemented `JDate::getDefaultTimezone()` method to keep and get the framework's current timezone.

---

### 10.1.2

*Release date - 15 May 2018*

##### ADD

* Implemented `JView::_getTemplateBasePath()` method to allow the customers
to create their own view overrides to avoid let them being replaced
by the Wordpress updates.
The overrides must be built as `[WP_UPLOAD_DIR]/[PLUGIN_NAME]/[admin|site]/[VIEW_NAME]/[LAYOUT_FILE].php`

##### CHANGE

* Changed `JFormFieldModuleLayout::getInput()` method to scan also the overrides directory.
In this way, the users can select a specific override as layout of the widget.
The overrides must be built as `[WP_UPLOAD_DIR]/[PLUGIN_NAME]/modules/[MODULE_NAME]/[LAYOUT_FILE].php`.

---

### 10.1.1

*Release date - 04 May 2018*

##### ADD

* The method `JPayment::isCaller()` has been 
implemented to make sure the caller is the same.
* Added a new filter to change the database prefix before it is used.

##### CHANGE

* `do_action()` functions that required multiple arguments
have been replaced with `do_action_ref_array()`.

##### FIX

* Fixed `JUser::authorise()` method to extend the validation of the capabilities.

---

### 10.1.0

*Release date - 27 April 2018*

##### ADD

* Extendable payment gateways framework.
* A lot of hooks can be used to extend/enhance the payments.

---

### 10.0.1

*Release date - 20 April 2018*

##### CHANGE

* It is no more needed to load the language file (.mo) of the widget 
as all the translations are contained within the main language file.

---

### 10.0.0

*Release date - 08 April 2018*

* Initial framework release
