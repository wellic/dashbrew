<?php

class Autoload {

    static protected $namespaces = [
        'Slim' => 'Slim',
    ];

    static public function loader($className) {

        $className = ltrim($className, '\\');
        $fileName  = '';
        $namespace = '';
        if ($lastNsPos = strrpos($className, '\\')) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }

        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className);

        foreach(self::$namespaces as $ns => $nsDir){
            if($ns == $fileName || 0 === strpos($fileName, $ns . DIRECTORY_SEPARATOR)){
                $fileName = $nsDir . DIRECTORY_SEPARATOR . $fileName;
                break;
            }
        }

        require __DIR__ . DIRECTORY_SEPARATOR . $fileName . '.php';
    }
}

spl_autoload_register('Autoload::loader');
