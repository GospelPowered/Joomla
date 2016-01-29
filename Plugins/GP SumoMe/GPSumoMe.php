<?php
/**
 * @version    $version 1.0 Gospel Powered
 * @copyright  Copyright (C) 2016 Gospel Powered (http://www.gospelpowered.com) All rights reserved.
 * @license    GNU/GPL v2, see LICENSE.txt
 *
 * Email: support@gospelpowered.com
 *
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 *
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');

class plgSystemGPSumoMe extends JPlugin
{
    function plgGPSumoMe(&$subject, $config)
    {
        parent::__construct($subject, $config);
        $this->_plugin = JPluginHelper::getPlugin('system', 'GPSumoMe');
        $this->_params = new JParameter($this->_plugin->params);
    }

    function onAfterRender()
    {
        $siteId = $this->params->get('site_id', '');

        $javascript = '';
        $app = JFactory::getApplication();

        if ($app->isAdmin()) {
            return;
        }

        $buffer = JResponse::getBody();

        $javascript .= "<script type=\"text/javascript\" src=\"//load.sumome.com\" data-sumo-site-id=\"" . $siteId . "\" async=\"async\"></script>";

        $buffer = preg_replace("/<\/head>/", "\n\n" . $javascript . "\n\n</head>", $buffer);

        JResponse::setBody($buffer);

        return true;
    }
}
?>
