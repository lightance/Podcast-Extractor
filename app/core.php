<?
mb_internal_encoding('UTF-8');

function classAutoloader($name) {
  $namespaces = explode('\\', $name);
  $class = array_pop($namespaces);

  // base path
  $basePath = $_SERVER['DOCUMENT_ROOT'] . dirname($_SERVER['SCRIPT_NAME']) . '/app/class';

  // namespaces path
  $namespacesPath = '';
  foreach ($namespaces as $namespace_) {
    $namespacesPath .= '/' . '_'.$namespace_;
  }

  // class path
  $classPath = '/' . str_replace('_', '/', $class) . '.php';

  // final path
  $path = $basePath . $namespacesPath . $classPath;
  include_once($path);
}
spl_autoload_register('classAutoloader');