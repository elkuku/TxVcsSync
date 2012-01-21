<?php defined('_JEXEC') || die('=;)'); ?>
<!doctype html>
<html>
    <head>
<jdoc:include type="head" />

        <!--
        <script src="themes/<?= $this->template ?>/js/mootools-core-1.4.2-full-nocompat.js" type="text/javascript"></script>
        <script src="themes/<?= $this->template ?>/js/mootools-more-1.4.0.1.js" type="text/javascript"></script>

        <script src="themes/<?= $this->template ?>/js/<?= $this->template ?>.js" type="text/javascript"></script>
        -->
        <link href="themes/<?= $this->template ?>/css/<?= $this->template ?>.css" media="screen" rel="stylesheet" type="text/css" />

    </head>
    <body>
        <h1><?= JFactory::getConfig()->get('appName') ?></h1>

        <jdoc:include type="message" />
        <jdoc:include type="component" name="main" />

        <div class="footer">
            &bull; <?= JFactory::getConfig()->get('appName').' <span class="version">'.trim(JFile::read(JPATH_BASE.'/version.txt')).'</span>' ?>
            &bull; Made 2012 by <a href="http://github.com/elkuku">El KuKu</a>
            &bull; Running on <a class="icon-joomla" href="http://github.com/joomla/joomla-platform">Joomla! Platform</a>
            <?= JPlatform::getShortVersion() ?>
            &bull;
        </div>
    </body>
</html>
