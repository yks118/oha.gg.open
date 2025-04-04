<?php

namespace Config;

use CodeIgniter\Config\AutoloadConfig;

/**
 * -------------------------------------------------------------------
 * AUTOLOADER CONFIGURATION
 * -------------------------------------------------------------------
 *
 * This file defines the namespaces and class maps so the Autoloader
 * can find the files as needed.
 *
 * NOTE: If you use an identical key in $psr4 or $classmap, then
 *       the values in this file will overwrite the framework's values.
 *
 * NOTE: This class is required prior to Autoloader instantiation,
 *       and does not extend BaseConfig.
 *
 * @immutable
 */
class Autoload extends AutoloadConfig
{
    /**
     * -------------------------------------------------------------------
     * Namespaces
     * -------------------------------------------------------------------
     * This maps the locations of any namespaces in your application to
     * their location on the file system. These are used by the autoloader
     * to locate files the first time they have been instantiated.
     *
     * The 'Config' (APPPATH . 'Config') and 'CodeIgniter' (SYSTEMPATH) are
     * already mapped for you.
     *
     * You may change the name of the 'App' namespace if you wish,
     * but this should be done prior to creating any namespaced classes,
     * else you will need to modify all of those classes for this to work.
     *
     * @var array<string, list<string>|string>
     */
    public $psr4 = [
        APP_NAMESPACE => APPPATH,

        // CMS
        'Modules\Core'  => ROOTPATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Core',

        // Nexon
        'Modules\Nexon\Core'                => ROOTPATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Nexon' . DIRECTORY_SEPARATOR . 'Core',
        'Modules\Nexon\Baram'               => ROOTPATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Nexon' . DIRECTORY_SEPARATOR . 'Baram',
        'Modules\Nexon\BaramY'              => ROOTPATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Nexon' . DIRECTORY_SEPARATOR . 'BaramY',
        'Modules\Nexon\CrazyArcade'         => ROOTPATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Nexon' . DIRECTORY_SEPARATOR . 'CrazyArcade',
        'Modules\Nexon\FirstDescendant'     => ROOTPATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Nexon' . DIRECTORY_SEPARATOR . 'FirstDescendant',
        'Modules\Nexon\Hit2'                => ROOTPATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Nexon' . DIRECTORY_SEPARATOR . 'Hit2',
        'Modules\Nexon\KartRiderRushPlus'   => ROOTPATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Nexon' . DIRECTORY_SEPARATOR . 'KartRiderRushPlus',
        'Modules\Nexon\Mabinogi'            => ROOTPATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Nexon' . DIRECTORY_SEPARATOR . 'Mabinogi',
        'Modules\Nexon\MabinogiHeroes'      => ROOTPATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Nexon' . DIRECTORY_SEPARATOR . 'MabinogiHeroes',
        'Modules\Nexon\MapleStoryM'         => ROOTPATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Nexon' . DIRECTORY_SEPARATOR . 'MapleStoryM',
        'Modules\Nexon\SuddenAttack'        => ROOTPATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Nexon' . DIRECTORY_SEPARATOR . 'SuddenAttack',
        'Modules\Nexon\Supervive'           => ROOTPATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Nexon' . DIRECTORY_SEPARATOR . 'Supervive',
        'Modules\Nexon\V4'                  => ROOTPATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'Nexon' . DIRECTORY_SEPARATOR . 'V4',

        // NCSOFT
        'Modules\NcSoft\Core'       => ROOTPATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'NcSoft' . DIRECTORY_SEPARATOR . 'Core',
        'Modules\NcSoft\Lineage2M'  => ROOTPATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . 'NcSoft' . DIRECTORY_SEPARATOR . 'Lineage2M',
    ];

    /**
     * -------------------------------------------------------------------
     * Class Map
     * -------------------------------------------------------------------
     * The class map provides a map of class names and their exact
     * location on the drive. Classes loaded in this manner will have
     * slightly faster performance because they will not have to be
     * searched for within one or more directories as they would if they
     * were being autoloaded through a namespace.
     *
     * Prototype:
     *   $classmap = [
     *       'MyClass'   => '/path/to/class/file.php'
     *   ];
     *
     * @var array<string, string>
     */
    public $classmap = [];

    /**
     * -------------------------------------------------------------------
     * Files
     * -------------------------------------------------------------------
     * The files array provides a list of paths to __non-class__ files
     * that will be autoloaded. This can be useful for bootstrap operations
     * or for loading functions.
     *
     * Prototype:
     *   $files = [
     *       '/path/to/my/file.php',
     *   ];
     *
     * @var list<string>
     */
    public $files = [];

    /**
     * -------------------------------------------------------------------
     * Helpers
     * -------------------------------------------------------------------
     * Prototype:
     *   $helpers = [
     *       'form',
     *   ];
     *
     * @var list<string>
     */
    public $helpers = [];
}
