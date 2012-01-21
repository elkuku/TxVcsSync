<?php
/**
 * Configuration class.
 */

defined('_JEXEC') or die;

/**
 * Configuration class.
 */
final class JConfig
{
    /**
     * The path to the Joomla! platform.
     * If left blank, an environment variable JOOMLA_PLATFORM_PATH is expected.
     *
     * @var string
     */
    public $platformPath = '';

    /**
     * The application theme.
     *
     * @var    string
     */
    public $theme = 'greenbook';

    /**
     * The applications "first" name.
     *
     * @var string
     */
    public $appName = 'TxVcsSync';

    /**
     * Database settings
     */
    public $dbtype = 'sqlite';
    public $db = 'txvcssync.sdb';
    public $dbprefix = 'txvcs_';

}//class
