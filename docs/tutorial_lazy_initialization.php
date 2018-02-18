<?php
require('AUTOLOAD.php');

// Create a custom class implementing the singleton pattern
class customSingleton
{
    protected static $instance;

    public static function getInstance()
    {
        if ( self::$instance === null )
        {
            self::$instance = new customSingleton();
            \AWMports\ezcBase\Init::fetchConfig( 'customKey', self::$instance );
        }

        return self::$instance;
    }
}

// Implement your configuration class
class customSingletonConfiguration implements \AWMports\ezcBase\Interfaces\ConfigurationInitializer
{
    public static function configureObject( $object )
    {
        echo "Configure customSingleton.\n";
        $object->value = 42;
    }
}

// Register for lazy initilization
\AWMports\ezcBase\Init::setCallback( 'customKey', 'customSingletonConfiguration' );

// Configure on first initilization
$object = customSingleton::getInstance();
var_dump( $object->value );

?>
