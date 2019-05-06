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

namespace SmartSolutionsItaly\CakePHP\Manifest;

use Cake\Core\Configure;
use Cake\Utility\Xml;
use SmartSolutionsItaly\CakePHP\Marketplace\Marketplace;

/**
 * Generates the application's manifest.
 * @package SmartSolutionsItaly\CakePHP\Manifest
 * @author Lucio Benini <dev@smartsolutions.it>
 * @since 1.0.0
 */
class Manifest
{
    /**
     * Generates the manifest.
     * @return array The manifest.
     * @since 1.0.0
     */
    public static function generate(): array
    {
        $manifest = [
            'name' => Configure::read('App.siteName'),
            'short_name' => Configure::read('App.siteName'),
            'lang' => Configure::read('App.language'),
            'start_url' => Configure::read('Manifest.startUrl', '/'),
            'display' => Configure::read('Manifest.display', 'standalone'),
            'orientation' => Configure::read('Manifest.orientation', 'portrait'),
            'theme_color' => Configure::read('Appearance.colors.theme', '#000000'),
            'icons' => static::icons(192, 168, 144, 96, 72, 48),
            'background_color' => Configure::read('Appearance.colors.background', '#ffffff')
        ];

        $manifest = static::addRelatedApplications($manifest, ['GooglePlay', 'AppleITunes']);

        $manifest['prefer_related_applications'] = !empty($manifest['related_applications']);

        return $manifest;
    }

    /**
     * Gets the application's icons.
     * @param mixed ...$sizes The icons' sizes.
     * @return array The application's icons.
     * @since 1.0.0
     */
    public static function icons(...$sizes): array
    {
        $icons = [];
        $path = static::getImagesFolder();

        foreach ($sizes as $size) {
            $icons[] = [
                'src' => $path . '/branding/' . $size . '.png',
                'sizes' => $size . 'x' . $size,
                'type' => 'image/png'
            ];
        }

        return $icons;
    }

    /**
     * Gets the images folder.
     * @return string The images folder.
     * @since 1.0.0
     */
    protected static function getImagesFolder(): string
    {
        return trim((string)Configure::read('App.imageBaseUrl', 'img'), '\/');
    }

    /**
     * Adds the marketplace data to the given manifest.
     * @param array $manifest The manifest to update.
     * @param array $marketplaces The marketplaces to add.
     * @return array The updated manifest.
     * @since 1.0.0
     */
    protected static function addRelatedApplications(array $manifest, array $marketplaces = []): array
    {
        foreach ($marketplaces as $marketplace) {
            $provider = Marketplace::create($marketplace);

            if ($provider->isActive()) {
                $manifest['related_applications'][] = $provider->getManifest();
            }
        }

        return $manifest;
    }

    /**
     * Returns the XML "ieconfig" document for Microsoft browsers.
     * @return mixed The XML "ieconfig" document for Microsoft browsers.
     * @since 1.0.0
     */
    public static function ieconfig()
    {
        $path = static::getImagesFolder() . '/tiles/';
        $out = [
            'browserconfig' => [
                'msapplication' => [
                    'tile' => [
                        'square70x70logo' => [
                            '@src' => Configure::read('Manifest.tiles.small', $path . 'small.png')
                        ],
                        'square150x150logo' => [
                            '@src' => Configure::read('Manifest.tiles.medium', $path . 'medium.png')
                        ],
                        'wide310x150logo' => [
                            '@src' => Configure::read('Manifest.tiles.wide', $path . 'wide.png')
                        ],
                        'square310x310logo' => [
                            '@src' => Configure::read('Manifest.tiles.large', $path . 'large.png')
                        ],
                        'TileColor' => Configure::read('Appearance.colors.theme', '#ffffff'),
                        'TileImage' => [
                            '@src' => Configure::read('Manifest.tiles.medium', $path . 'medium.png')
                        ]
                    ]
                ]
            ]
        ];

        return Xml::fromArray($out)->asXML();
    }

    /**
     * Generates the "site.webmanifest" for Chrome Apps.
     * @return array The manifest.
     * @since 1.0.0
     */
    public static function chrome()
    {
        return [
            'name' => Configure::read('App.siteName'),
            'short_name' => Configure::read('App.siteName'),
            'icons' => Configure::read('Manifest.chrome.icon', static::getImagesFolder() . '/android-chrome-192x192.png'),
            'display' => Configure::read('Manifest.display', 'standalone'),
            'theme_color' => Configure::read('Appearance.colors.theme', '#000000'),
            'background_color' => Configure::read('Appearance.colors.background', '#ffffff')
        ];
    }
}
