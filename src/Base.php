<?php
/**
 * File containing the \AWMports\ezcBase\Base class.
 *
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 * 
 *   http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 *
 * @package Base
 * @version //autogentag//
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

/**
 * Base class implements the methods needed to use the eZ components.
 *
 * @package Base
 * @version //autogentag//
 * @mainclass
 */

namespace AWMports\ezcBase;

class Base
{
    /**
     * Used for dependency checking, to check for a PHP extension.
     */
    const DEP_PHP_EXTENSION = "extension";

    /**
     * Used for dependency checking, to check for a PHP version.
     */
    const DEP_PHP_VERSION = "version";

    /**
     * Denotes the production mode
     */
    const MODE_PRODUCTION = 0;

    /**
     * Denotes the development mode
     */
    const MODE_DEVELOPMENT = 1;

    /**
     * Indirectly it determines the path where the autoloads are stored.
     *
     * @var string
     */
    private static $libraryMode = "devel";

    /**
     * Contains the current working directory, which is used when the
     * $libraryMode is set to "custom".
     *
     * @var string
     */
    private static $currentWorkingDirectory = null;

    /**
     * The full path to the autoload directory.
     *
     * @var string
     */
    protected static $packageDir = null;

    /**
     * Contains which development mode is used. It's "development" by default,
     * because of backwards compatibility reasons.
     */
    private static $runMode = self::MODE_DEVELOPMENT;

    /**
     * removed protected static $repositoryDirs = array();
     */

    /**
     * removed protected static $autoloadArray = array();
     */

    /**
     * removed protected static $externalAutoloadArray = array();
     */

    /**
     * Options for the \AWMports\ezcBase\Base class.
     *
     * @var \AWMports\ezcBase\Options
     */
    static private $options;

    /**
     * removed static public function setOptions( ezcBaseAutoloadOptions $options )
     */
     
    /**
     * removed public static function autoload( $className )
     */

    /**
     * Sets the current working directory to $directory.
     *
     * @param string $directory
     */
    public static function setWorkingDirectory( $directory )
    {
        self::$libraryMode = 'custom';
        self::$currentWorkingDirectory = $directory;
    }

    /**
     * Figures out the base path of the Zeta Components installation.
     *
     * It stores the path that it finds in a static member variable. The path
     * depends on the installation method of the Zeta Components. The SVN version
     * has a different path than the PEAR installed version.
     */
    protected static function setPackageDir()
    {
        if ( \AWMports\ezcBase\Base::$packageDir !== null )
        {
            return;
        }

        // Get the path to the components.
        $baseDir = dirname( __FILE__ );

        switch ( \AWMports\ezcBase\Base::$libraryMode )
        {
            case "custom":
                \AWMports\ezcBase\Base::$packageDir = self::$currentWorkingDirectory . '/';
                break;
            case "devel":
            case "tarball":
                \AWMports\ezcBase\Base::$packageDir = $baseDir. "/../../";
                break;
            case "pear";
                \AWMports\ezcBase\Base::$packageDir = $baseDir. "/../";
                break;
        }
    }

    /**
     * removed public static function requireFile( $fileName, $className, $prefix )
     */

    /**
     * removed public static function loadFile( $file )
     */

    /**
     * removed public static function loadExternalFile( $file )
     */

    /**
     * Checks for dependencies on PHP versions or extensions
     *
     * The function as called by the $component component checks for the $type
     * dependency. The dependency $type is compared against the $value. The
     * function aborts the script if the dependency is not matched.
     *
     * @param string $component
     * @param int $type
     * @param mixed $value
     */
    public static function checkDependency( $component, $type, $value )
    {
        switch ( $type )
        {
            case self::DEP_PHP_EXTENSION:
                if ( extension_loaded( $value ) )
                {
                    return;
                }
                else
                {
                    // Can not be tested as it would abort the PHP script.
                    die( "\nThe {$component} component depends on the default PHP extension '{$value}', which is not loaded.\n" );
                }
                break;

            case self::DEP_PHP_VERSION:
                $phpVersion = phpversion();
                if ( version_compare( $phpVersion, $value, '>=' ) )
                {
                    return;
                }
                else
                {
                    // Can not be tested as it would abort the PHP script.
                    die( "\nThe {$component} component depends on the PHP version '{$value}', but the current version is '{$phpVersion}'.\n" );
                }
                break;
        }
    }

    /**
     * removed public static function getRepositoryDirectories()
     */

    /**
     * removed public static function addClassRepository( $basePath, $autoloadDirPath = null, $prefix = null )
     */

    /**
     * Returns the base path of the Zeta Components installation
     *
     * This method returns the base path, including a trailing directory
     * separator.
     *
     * @return string
     */
    public static function getInstallationPath()
    {
        self::setPackageDir();

        $path = realpath( self::$packageDir );
        if ( substr( $path, -1 ) !== DIRECTORY_SEPARATOR )
        {
            $path .= DIRECTORY_SEPARATOR;
        }
        return $path;
    }

    /**
     * Sets the development mode to the one specified.
     *
     * @param int $runMode
     */
    public static function setRunMode( $runMode )
    {
        if ( !in_array( $runMode, array( \AWMports\ezcBase\Base::MODE_PRODUCTION, \AWMports\ezcBase\Base::MODE_DEVELOPMENT ) ) )
        {
            throw new \AWMports\ezcBase\Exceptions\ValueException( 'runMode', $runMode, '\AWMports\ezcBase\Base::MODE_PRODUCTION or \AWMports\ezcBase\Base::MODE_DEVELOPMENT' );
        }

        self::$runMode = $runMode;
    }

    /**
     * Returns the current development mode.
     *
     * @return int
     */
    public static function getRunMode()
    {
        return self::$runMode;
    }

    /**
     * Returns true when we are in development mode.
     *
     * @return bool
     */
    public static function inDevMode()
    {
        return self::$runMode == \AWMports\ezcBase\Base::MODE_DEVELOPMENT;
    }

    /**
     * Returns the installation method
     *
     * Possible return values are 'custom', 'devel', 'tarball' and 'pear'. Only
     * 'tarball' and 'pear' are returned for user-installed versions.
     *
     * @return string
     */
    public static function getInstallMethod()
    {
        return self::$libraryMode;
    }
}
?>
