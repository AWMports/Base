<?php
/**
 * File containing the \AWMports\ezcBase\Exceptions\FilePermissionException class
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
 * @version //autogen//
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */

/**
 * \AWMports\ezcBase\Exceptions\FilePermissionException is thrown whenever a permission problem with
 * a file, directory or stream occurred.
 *
 * @package Base
 * @version //autogen//
 */

namespace AWMports\ezcBase\Exceptions;

class FilePermissionException extends \AWMports\ezcBase\Exceptions\Exception
{
    /**
     * Constructs a new ezcPropertyPermissionException for the property $name.
     *
     * @param string $path The name of the file.
     * @param int    $mode The mode of the property that is allowed
     *               (\AWMports\ezcBase\Exceptions\FileException::READ, \AWMports\ezcBase\Exceptions\FileException::WRITE,
     *               \AWMports\ezcBase\Exceptions\FileException::EXECUTE,
     *               \AWMports\ezcBase\Exceptions\FileException::CHANGE or
     *               \AWMports\ezcBase\Exceptions\FileException::REMOVE).
     * @param string $message A string with extra information.
     */
    function __construct( $path, $mode, $message = null )
    {
        switch ( $mode )
        {
            case \AWMports\ezcBase\Exceptions\FileException::READ:
                $operation = "The file '{$path}' can not be opened for reading";
                break;
            case \AWMports\ezcBase\Exceptions\FileException::WRITE:
                $operation = "The file '{$path}' can not be opened for writing";
                break;
            case \AWMports\ezcBase\Exceptions\FileException::EXECUTE:
                $operation = "The file '{$path}' can not be executed";
                break;
            case \AWMports\ezcBase\Exceptions\FileException::CHANGE:
                $operation = "The permissions for '{$path}' can not be changed";
                break;
            case \AWMports\ezcBase\Exceptions\FileException::REMOVE:
                $operation = "The file '{$path}' can not be removed";
                break;
            case ( \AWMports\ezcBase\Exceptions\FileException::READ || \AWMports\ezcBase\Exceptions\FileException::WRITE ):
                $operation = "The file '{$path}' can not be opened for reading and writing";
                break;
        }

        $messagePart = '';
        if ( $message )
        {
            $messagePart = " ($message)";
        }

        parent::__construct( "$operation.$messagePart" );
    }
}
?>
