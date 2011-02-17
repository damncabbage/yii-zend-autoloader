<?php

class DCZendAutoloader extends CApplicationComponent
{
	/**
	 * @var string Path to the folder that contains Zend/ and the rest of the ZF
	 *             libraries; optional, and only useful if you don't already have
	 *             the folder listed under 'import' in your config file.
	 */
	public $basePath;

	/**
	 * @var array(string,string,...) An array of custom namespaces the Zend_Loader_Autoloader
	 *                               should import, eg. 'My_'
	 */
	public $customNamespaces = array();


	/**
	 * Set up Zend_Loader_Autoloader to listen for any autoload requests.
	 */
	public function init()
	{
		$path = $this->basePath;
		if (strlen($path)) {
			// Normalise: strip a trailing "/" if present.
			if (strlen($path) > 1 && $path[strlen($path)-1] == '/') {
				$path = substr($path, 0, strlen($path)-1);
			}

			// Add this library path to PHP's include_path if it's not
			// already there (common for library paths outside of protected/).
			$this->addIncludePath($path);

			// Add a / for ease below.
			$path .= '/';
		}

		// Get Yii out of the way.
		spl_autoload_unregister(array('YiiBase','autoload'));

		// Bring in Zend and set it up to take new autoload events.
		require_once($path.'Zend/Loader/Autoloader.php');
		$autoloader = Zend_Loader_Autoloader::getInstance();

		// Any custom namespaces, eg. 'My_'
		foreach ($this->customNamespaces as $namespace) {
			$autoloader->registerNamespace($namespace);
		}

		// ... and we're back in the room.
		spl_autoload_register(array('YiiBase','autoload'));
	}


	/**
	 * Adapted from Ricardo Ferro's add_include_path from:
	 * http://www.php.net/manual/en/function.get-include-path.php#83189
	 */
	protected function addIncludePath($path)
	{
		if (!file_exists($path) OR (file_exists($path) && filetype($path) !== 'dir')) {
			throw new CException(Yii::t('Include path {path} does not exist.', array('path'=>$path)));
		}
		$paths = explode(PATH_SEPARATOR, get_include_path());
		if (array_search($path, $paths) === false) {
			array_push($paths, $path);
		}
		set_include_path(implode(PATH_SEPARATOR, $paths));
	}

}
