<?php # $Id: lang_en.inc.php 1381 2006-08-15 10:14:56Z elf2000 $

/**
 *  @version $Revision: 1381 $
 *  @author Translator Name <yourmail@example.com>
 *  EN-Revision: Revision of lang_en.inc.php
 */

@define('PLUGIN_EVENT_MAILER_NAME', 'Send entries via E-Mail');
@define('PLUGIN_EVENT_MAILER_DESC', 'Let you send a newly created entry via E-Mail to a specific address');
@define('PLUGIN_EVENT_MAILER_RECIPIENT', 'Mail recipient');
@define('PLUGIN_EVENT_MAILER_RECIPIENTDESC', 'E-Mail address you want to send the entries to (suggested: a mailing list)');
@define('PLUGIN_EVENT_MAILER_LINK', 'Mail link to article?');
@define('PLUGIN_EVENT_MAILER_LINKDESC', 'Include a link to the article in the mail.');
@define('PLUGIN_EVENT_MAILER_STRIPTAGS', 'Remove HTML?');
@define('PLUGIN_EVENT_MAILER_STRIPTAGSDESC', 'Remove HTML-Tags from the mail.');
@define('PLUGIN_EVENT_MAILER_CONVERTP', 'Convert HTML-paragraphs to newlines?');
@define('PLUGIN_EVENT_MAILER_CONVERTPDESC', 'Adds a newline after each HTML paragraph. This is very useful if you enable HTML removing, so that your paragraphs can be kept if not manually entered.');
@define('PLUGIN_EVENT_MAILER_RECIPIENTS', 'Mail recipient (seperate multiple recipients with a space)');
@define('PLUGIN_EVENT_MAILER_NOTSENDDECISION', 'This entry was not sent via E-Mail because you decided to not send it.');
@define('PLUGIN_EVENT_MAILER_SENDING', 'Sending');
@define('PLUGIN_EVENT_MAILER_ISTOSENDIT', 'Send this entry via E-Mail');


?>
