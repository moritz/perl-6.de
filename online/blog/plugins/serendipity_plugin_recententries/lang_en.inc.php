<?php # $Id: lang_en.inc.php 1381 2006-08-15 10:14:56Z elf2000 $

/**
 *  @version $Revision: 1381 $
 *  @author Translator Name <yourmail@example.com>
 *  EN-Revision: Revision of lang_en.inc.php
 */

@define('PLUGIN_RECENTENTRIES_TITLE', 'Recent Entries');
@define('PLUGIN_RECENTENTRIES_BLAHBLAH', 'Shows the titles and dates of the most recent entries');
@define('PLUGIN_RECENTENTRIES_NUMBER', 'Number of entries');
@define('PLUGIN_RECENTENTRIES_NUMBER_BLAHBLAH', 'How many entries should be displayed? (Default: 10)');
@define('PLUGIN_RECENTENTRIES_NUMBER_FROM', 'Skip front page entries');
@define('PLUGIN_RECENTENTRIES_NUMBER_FROM_DESC', 'Only recent entries that are not on the front page will be shown. (Default: latest ' . $serendipity['fetchLimit'] . ' will be skipped)');
@define('PLUGIN_RECENTENTRIES_NUMBER_FROM_RADIO_ALL', 'Show all');
@define('PLUGIN_RECENTENTRIES_NUMBER_FROM_RADIO_RECENT', 'Skip front page items');

?>
