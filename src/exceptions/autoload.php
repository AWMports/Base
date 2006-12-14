<?php
/**
 * File containing the ezcBaseAutoloadException class
 *
 * @package Base
 * @version //autogen//
 * @copyright Copyright (C) 2005, 2006 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 */
/**
 * ezcBaseAutoloadException is thrown whenever a class can not be found with
 * the autoload mechanism.
 *
 * @package Base
 * @version //autogen//
 */
class ezcBaseAutoloadException extends ezcBaseException
{
    /**
     * Constructs a new ezcBaseAutoloadException for the $className that was
     * searched for in the autoload files $fileNames from the directories
     * specified in $dirs.
     */
    function __construct( $className, $files, $dirs )
    {
        $paths = array();
        foreach ( $dirs as $dir )
        {
            $paths[] = realpath( $dir[1] );
        }
        parent::__construct( "Could not find a class to file mapping for '{$className}'. Searched for ". implode( ' and ', $files ) . " in: " . implode( ', ', $paths ) );
    }
}
?>