Yii Zend Autoloader Application Component
=========================================

This is a quick component that simplifies setting up autoloading for the Zend Framework.

Steps
-----

1. Download the Zend Framework from [http://framework.zend.com/download/current/](http://framework.zend.com/download/current/) ("Zend Framework 1.11.3 Minimal" is recommended).
2. Extract it, and place the `Zend` directory in `protected/vendors/`, or another place of your choosing.
3. Place this `zend-autoloader` folder in `protected/extensions/components` (or somewhere else; you'll need to specify the path later).
4. Set up the configuration file to match `examples/main.php` (that is, set up the `'components'` and `'preload'` sections.


Example
-------

See the examples directory for a `main.php` configuration set up with the autoloader component.

(It's recommended that you include the same relevant parts in a file that can be included into both the `main.php` and `console.php` files.)
