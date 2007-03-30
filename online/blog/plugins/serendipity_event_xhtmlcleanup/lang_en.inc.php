<?php # $Id: lang_en.inc.php 1381 2006-08-15 10:14:56Z elf2000 $

/**
 *  @version $Revision: 1381 $
 *  @author Translator Name <yourmail@example.com>
 *  EN-Revision: Revision of lang_en.inc.php
 */

@define('PLUGIN_EVENT_XHTMLCLEANUP_NAME', 'Fix common XHTML errors');
@define('PLUGIN_EVENT_XHTMLCLEANUP_DESC', 'This plugin corrects common issues with XHTML markup in entries. It assists in keeping your blog XHTML compliant.');
@define('PLUGIN_EVENT_XHTMLCLEANUP_XHTML', 'Encode XML-parsed data?');
@define('PLUGIN_EVENT_XHTMLCLEANUP_XHTML_DESC', 'This plugin uses a XML parsing method to ensure XHTML validity of your code. This xml parsing may convert already valid entities to unescaped entities, so the plugin encodes all entities after the parsing. Set this flag to OFF if that introduces double encoding for you!');
@define('PLUGIN_EVENT_XHTMLCLEANUP_UTF8', 'Cleanup UTF-8 entities?');
@define('PLUGIN_EVENT_XHTMLCLEANUP_UTF8_DESC', 'If enabled, HTML entities derived from UTF-8 characters will be properly converted and not double-encoded in your output.');

?>
