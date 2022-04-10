<?php
class Autoloader
{
    public $prefixes = array();
    public function addNamespace(string $prefix, string $dir)
    {
        if (isset($this->prefixes[$prefix]) === false) {
            $this->prefixes[$prefix] = $dir;
        }

    }

    public function register()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

    public function autoload($class)
    {
        $path = explode('\\', $class);
        if (isset($this->prefixes[$path[0]])) {
            $path[0]=$this->prefixes[$path[0]];
            $className = array_pop($path).'.php';
            $route = '';
            foreach ($path as $item){
                $route .= "$item".'/';
            }
            require_once $route.$className;

            }else{
            @throw new Exception('Class not found');
        }


    }
}
$a = new Autoloader();
$a ->addNamespace('Hillel', $_SERVER['DOCUMENT_ROOT'].'/src');
$a ->register();



