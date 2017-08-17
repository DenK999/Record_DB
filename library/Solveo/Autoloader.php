<?php

namespace Solveo;

class Autoloader {

    /**
     *
     * @var array $namespace to autoload function
     */
    protected $namespaceMap = array();
    
    
    public function __construct()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

    public function addNamespace(string $namespace, string $rootDir) {

        $namespace = trim($namespace, '\\') . '\\';

        $rootDir = rtrim($rootDir, DIRECTORY_SEPARATOR) . '/';

        if (is_dir($rootDir)) {
            $this->namespaceMap[$namespace] = $rootDir;

            return true;
        }

        return false;
    }
    
    /**
     * 
     * @param type $className
     * @return path file
     */
    protected function autoload($className) {
        $namespace = $className;

        while (false !== ($position = strrpos($namespace, '\\'))) {

            $namespace = substr($className, 0, $position + 1);

            $relativeClass = substr($className, $position + 1);

            $mappedFile = $this->loadMappedFile($namespace, $relativeClass);

            if ($mappedFile) {
                return $mappedFile;
            }

            $namespace = rtrim($namespace, '\\');
        }
    }

    /**
     * 
     * @param string $namespace
     * @param string $relativeClass
     * @return boolean
     */
    protected function loadMappedFile(string $namespace, string $relativeClass) {
        if (!isset($this->namespaceMap[$namespace])) {
            return false;
        }

        $file = $this->namespaceMap[$namespace] . str_replace('\\', '/', $relativeClass) . '.php';

        if (file_exists($file)) {
            require $file;
            return true;
        }

        return false;
    }

}
