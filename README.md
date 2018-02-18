AWMports\ezcBase
================

This is a port of the `zetacomponents/base` package to use PSR-4 namespaced
class and filename structure.

The initial fork is of `zetacomponents/base` version 1.9.1

This fork is likely broken and should currently not be used.

__THIS FORK SHOULD NOT YET BE USED__

About AWMports
--------------

AWMports (prounounced ‘A W Imports’) is a collection of Composer installable PHP
libraries that either predate PHP-FIG or otherwise do not use namespaced
classes in a manner that is easily compatible with PSR-4 style auto-loaders.

Initial attempts will be to port Zeta Components and perhaps some abandoned PECL
packages.

AWMports is a project of Alice Wonder Miscreations.

About Zeta Components
---------------------

The Zeta Components website is at [zetacomponents.org](http://zetacomponents.org/)

Current development takes place on [github](https://github.com/zetacomponents)

It is a *fantastic* collection of re-usable PHP libraries and their code also
is one of the better ways to learn about PHP object oriented programming, with
actual real-world implementations of many techniques I confess I really did not
have a good grasp on before reading their code.


Substantial Changes from Upstream
=================================

There are some substantial changes in this fork.

PSR-4 Autoloading
-----------------

All classes are now namespaced. The top level namespace is `AWMimports` and the
second level namespace is `ezcBase`.

In cases where upstream had the class file in a subdirectory of `src/` a third
level namespace is used, the name of the subdirectory with first letter upper
case.

The class names have been modified to remove the `ezcBase` prefix as that
purpose is now served by the namespace.

The filenames of the classes has been changed to match the class name, in
accordance with the PSR-4 namespace standard.

### Removed Classes

The following upstream classes have been completely removed:

* `ezcBaseAutoloadException`  
  __Reason:__ Autoloading has been removed from the `Base` class in favor of
  PSR-4 autoloading. That exception class is no longer needed.

* `ezcBaseDoubleClassRepositoryPrefixException`  
  __Reason:__ Autoloading has been removed from the `Base` class. Also,
  namespaces solves the problem that exception was needed for.

* `ezcBaseMetaDataPearReader`  
  __Reason:__ This fork is not part of the PEAR project.

* `ezcBaseMetaDataTarballReader`  
  __Reason:__ This fork will not make use of the `release-info.xml` file that
  class needs.
  
* `ezcBaseAutoloadOptions`  
  __Reason:__ Autoloading has been removed from the `Base` class in favor of
  PSR-4 autoloading.
  
* `ezcBaseRepositoryDirectory`  
  __Reason:__ This fork will not be maintaining a repository directory, which
  appears to have only been needed for the Base class autoloading.
  
### Removed Files

The following files have been completely removed:

* `base_autoload.php`  
  __Reason:__ This fork will use PSR-4 style autoloading. A classmap is not
  needed.
  
* `ezc_bootstrap.php`  
  __Reason:__ This file calls the PHP `spl_autoload_register` function for the
  autoloader in the Base class, which has been removed.
  
### Changes to the Base class

When Zeta Components first shipped, PHP autoloading really sucked. It was
proper for Zeta Components to provide its own autoloading facilities.

With improvements to PHP autoloading and the PSR-4 standard that makes it easy
to use autoloading, the autoloading facilities of the Base (upstream `ezcBase`)
class simply are no longer needed and have become redundant.

Functions within the Base class related to autoloading have been removed:

* `protected static $repositoryDirs = array();`
* `protected static $autoloadArray = array();`
* `protected static $externalAutoloadArray = array();`
* `static public function setOptions( ezcBaseAutoloadOptions $options )`
* `public static function autoload( $className )`
* `protected static function requireFile( $fileName, $className, $prefix )`
* `protected static function loadFile( $file )`
* `protected static function loadExternalFile( $file )`
* `public static function getRepositoryDirectories()`
* `public static function addClassRepository( $basePath, $autoloadDirPath = null, $prefix = null )`

Calls to those functions should not be made. Only four of the removed methods are public:

* `ezcBase::autoload`
* `ezcBase::setOptions`
* `ezcBase::getRepositoryDirectories`
* `ezcBase::addClassRepository`

Libraries that used those methods will need to be updated not to use those methods.


Library and Application Porting
-------------------------------

To port existing libraries and applications from zetacomponents/base to AWMports/ezcBase:

    Zeta Components Class Name                     Namespaced Equivalent
    --------------------------------------------------------------------------
    ezcBase                                   -->  \AWMports\ezcBase\Base
    ezcBaseConfigurationInitializer           -->  \AWMports\ezcBase\Interfaces\ConfigurationInitializer
    ezcBaseException                          -->  \AWMports\ezcBase\Exceptions\Exception
    ezcBaseExportable                         -->  \AWMports\ezcBase\Interfaces\Exportable
    ezcBaseExtensionNotFoundException         -->  \AWMports\ezcBase\Exceptions\ExtensionNotFoundException
    ezcBaseFeatures                           -->  \AWMports\ezcBase\Features
    ezcBaseFile                               -->  \AWMports\ezcBase\File
    ezcBaseFileException                      -->  \AWMports\ezcBase\Exceptions\FileException
    ezcBaseFileFindContext                    -->  \AWMports\ezcBase\Structs\FileFindContext
    ezcBaseFileIoException                    -->  \AWMports\ezcBase\Exceptions\FileIoException
    ezcBaseFileNotFoundException              -->  \AWMports\ezcBase\Exceptions\FileNotFoundException
    ezcBaseFilePermissionException            -->  \AWMports\ezcBase\Exceptions\FilePermissionException
    ezcBaseFunctionalityNotSupportedException -->  \AWMports\ezcBase\Exceptions\FunctionalityNotSupportedException
    ezcBaseInit                               -->  \AWMports\ezcBase\Init
    ezcBaseInitCallbackConfiguredException    -->  \AWMports\ezcBase\Exceptions\InitCallbackConfiguredException
    ezcBaseInitInvalidCallbackClassException  -->  \AWMports\ezcBase\Exceptions\InitInvalidCallbackClassException
    ezcBaseInvalidParentClassException        -->  \AWMports\ezcBase\Exceptions\InvalidParentClassException
    ezcBaseOptions                            -->  \AWMports\ezcBase\Options
    ezcBasePersistable                        -->  \AWMports\ezcBase\Interfaces\Persistable
    ezcBasePropertyNotFoundException          -->  \AWMports\ezcBase\Exceptions\PropertyNotFoundException
    ezcBasePropertyPermissionException        -->  \AWMports\ezcBase\Exceptions\PropertyPermissionException
    ezcBaseMetadata                           -->  \AWMports\ezcBase\MetaData
    ezcBaseSettingNotFoundException           -->  \AWMports\ezcBase\Exceptions\SettingNotFoundException
    ezcBaseSettingValueException              -->  \AWMports\ezcBase\Exceptions\SettingValueException
    ezcBaseStruct                             -->  \AWMports\ezcBase\Struct
    ezcBaseValueException                     -->  \AWMports\ezcBase\Exceptions\ValueException
    ezcBaseWhateverException                  -->  \AWMports\ezcBase\Exceptions\WhateverException
    
