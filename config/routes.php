<?php
/**
 * cakephp-manifest (https://github.com/smartsolutionsitaly/cakephp-manifest)
 * Copyright (c) 2019 Smart Solutions S.r.l. (https://smartsolutions.it)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @category  cakephp-plugin
 * @package   cakephp-manifest
 * @author    Lucio Benini <dev@smartsolutions.it>
 * @copyright 2019 Smart Solutions S.r.l. (https://smartsolutions.it)
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @link      https://smartsolutions.it Smart Solutions S.r.l.
 * @since     1.0.0
 */

namespace SmartSolutionsItaly\CakePHP\Manifest\Config;

use Cake\Routing\Router;

Router::plugin('SmartSolutionsItaly/CakePHP/Manifest', ['path' => '/manifest'], function ($routes) {
    $routes->get('', ['controller' => 'Manifest', 'action' => 'index'])
        ->setExtensions(['json']);
});

Router::plugin('SmartSolutionsItaly/CakePHP/Manifest', ['path' => '/ieconfig'], function ($routes) {
    $routes->get('', ['controller' => 'Manifest', 'action' => 'ieconfig'])
        ->setExtensions(['xml']);
});

Router::plugin('SmartSolutionsItaly/CakePHP/Manifest', ['path' => '/site'], function ($routes) {
    $routes->get('', ['controller' => 'Manifest', 'action' => 'chrome'])
        ->setExtensions(['webmanifest']);
});