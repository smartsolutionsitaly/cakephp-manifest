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

namespace SmartSolutionsItaly\CakePHP\Manifest\Controller;

use Cake\Controller\Controller;
use SmartSolutionsItaly\CakePHP\Manifest\Manifest;

/**
 * Manifest controller.
 * @package SmartSolutionsItaly\CakePHP\Manifest\Controller
 * @author Lucio Benini <dev@smartsolutions.it>
 * @since 1.0.0
 */
class ManifestController extends Controller
{
    /**
     * Handles the "index" action.
     * @return \Cake\Http\Response
     * @since 1.0.0
     */
    public function index()
    {
        $manifest = Manifest::generate();

        $this->set(compact($manifest));
        $this->set('_serialize', [
            'manifest'
        ]);

        return $this->getResponse()
            ->withType('json')
            ->withStringBody(json_encode($manifest));
    }

    /**
     * Generates the "ieconfig.xml" file and returns it.
     * @return \Cake\Http\Response
     * @since 1.0.0
     */
    public function ieconfig()
    {
        return $this->getResponse()
            ->withType('xml')
            ->withStringBody(Manifest::ieconfig());
    }

    /**
     * Generates the "site.webmanifest" file and returns it.
     * @return \Cake\Http\Response
     * @since 1.0.0
     */
    public function chrome()
    {
        return $this->getResponse()
            ->withType('json')
            ->withStringBody(json_encode(Manifest::chrome()));
    }
}
