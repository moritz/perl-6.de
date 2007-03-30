<?php # $Id: lang_en.inc.php 1457 2006-10-26 09:41:10Z garvinhicking $

/**
 *  @version $Revision: 1457 $
 *  @author Translator Name <yourmail@example.com>
 *  EN-Revision: Revision of lang_en.inc.php
 */

@define('PLUGIN_EVENT_SPAMBLOCK_TITLE', 'Spam Protector');
@define('PLUGIN_EVENT_SPAMBLOCK_DESC', 'A variety of methods to prevent comment spam');
@define('PLUGIN_EVENT_SPAMBLOCK_ERROR_BODY', 'Spam Prevention: Invalid message.');
@define('PLUGIN_EVENT_SPAMBLOCK_ERROR_IP', 'Spam Prevention: You cannot post a comment so soon after submitting another one.');

@define('PLUGIN_EVENT_SPAMBLOCK_ERROR_KILLSWITCH', 'This blog is in "Emergency Comment Blockage Mode", please come back another time');
@define('PLUGIN_EVENT_SPAMBLOCK_BODYCLONE', 'Do not allow duplicate comments');
@define('PLUGIN_EVENT_SPAMBLOCK_BODYCLONE_DESC', 'Do not allow users to submit a comment which contains the same body as an already submitted comment');
@define('PLUGIN_EVENT_SPAMBLOCK_KILLSWITCH', 'Emergency comment shutdown');
@define('PLUGIN_EVENT_SPAMBLOCK_KILLSWITCH_DESC', 'Temporarily disable comments for all entries. Useful if your blog is under spam attack.');
@define('PLUGIN_EVENT_SPAMBLOCK_IPFLOOD', 'IP block interval');
@define('PLUGIN_EVENT_SPAMBLOCK_IPFLOOD_DESC', 'Only allow an IP to submit a comment every n minutes. Useful to prevent comment floods.');
@define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS', 'Enable Captchas');
@define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_DESC', 'Will force the user to input a random string displayed in a specially crafted image. This will disallow automated submits to your blog. Please remember that people with decreased vision may find it hard to read those captchas.');
@define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_USERDESC', 'To prevent automated Bots from commentspamming, please enter the string you see in the image below in the appropriate input box. Your comment will only be submitted if the strings match. Please ensure that your browser supports and accepts cookies, or your comment cannot be verified correctly.');
@define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_USERDESC2', 'Enter the string you see here in the input box!');
@define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_USERDESC3', 'Enter the string from the spam-prevention image above: ');
@define('PLUGIN_EVENT_SPAMBLOCK_ERROR_CAPTCHAS', 'You did not enter the correct string displayed in the spam-prevention image box. Please look at the image and enter the values displayed there.');
@define('PLUGIN_EVENT_SPAMBLOCK_ERROR_NOTTF', 'Captchas disabled on your server. You need GDLib and freetype libraries compiled to PHP, and need the .TTF files residing in your directory.');

@define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_TTL', 'Force captchas after how many days');
@define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_TTL_DESC', 'Captchas can be enforced depending on the age of your articles. Enter the amount of days after which entering a correct captcha is necessary. If set to 0, captchas will always be used.');
@define('PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATION', 'Force comment moderation after how many days');
@define('PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATION_DESC', 'You can automatically set all comments for entries to be moderated. Enter the age of an entry in days, after which it should be auto-moderated. 0 means no auto-moderation.');
@define('PLUGIN_EVENT_SPAMBLOCK_LINKS_MODERATE', 'How many links before a comment gets moderated');
@define('PLUGIN_EVENT_SPAMBLOCK_LINKS_MODERATE_DESC', 'When a comment reaches a certain amount of links, that comment can be set to be moderated. 0 means that no link-checking is done.');
@define('PLUGIN_EVENT_SPAMBLOCK_LINKS_REJECT', 'How many links before a comment gets rejected');
@define('PLUGIN_EVENT_SPAMBLOCK_LINKS_REJECT_DESC', 'When a comment reaches a certain amount of links, that comment can be set to be rejected. 0 means that no link-checking is done.');

@define('PLUGIN_EVENT_SPAMBLOCK_NOTICE_MODERATION', 'Because of some conditions, your comment has been marked to require moderation by the owner of this blog.');
@define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHA_COLOR', 'Background color of the captcha');
@define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHA_COLOR_DESC', 'Enter RGB values: 0,255,255');

@define('PLUGIN_EVENT_SPAMBLOCK_LOGFILE', 'Logfile location');
@define('PLUGIN_EVENT_SPAMBLOCK_LOGFILE_DESC', 'Information about rejected/moderated posts can be written to a logfile. Set this to an empty string if you want to disable logging.');

@define('PLUGIN_EVENT_SPAMBLOCK_REASON_KILLSWITCH', 'Emergency Comment Blockage');
@define('PLUGIN_EVENT_SPAMBLOCK_REASON_BODYCLONE', 'Duplicate comment');
@define('PLUGIN_EVENT_SPAMBLOCK_REASON_IPFLOOD', 'IP-block');
@define('PLUGIN_EVENT_SPAMBLOCK_REASON_CAPTCHAS', 'Invalid captcha (Entered: %s, Expected: %s)');
@define('PLUGIN_EVENT_SPAMBLOCK_REASON_FORCEMODERATION', 'Auto-moderation after X days');
@define('PLUGIN_EVENT_SPAMBLOCK_REASON_LINKS_REJECT', 'Too many hyperlinks');
@define('PLUGIN_EVENT_SPAMBLOCK_REASON_LINKS_MODERATE', 'Too many hyperlinks');
@define('PLUGIN_EVENT_SPAMBLOCK_HIDE_EMAIL', 'Hide E-Mail addresses of commenting users');
@define('PLUGIN_EVENT_SPAMBLOCK_HIDE_EMAIL_DESC', 'Will show no E-Mail addresses of commenting users');
@define('PLUGIN_EVENT_SPAMBLOCK_HIDE_EMAIL_NOTICE', 'E-Mail addresses will not be displayed and will only be used for E-Mail notifications');

@define('PLUGIN_EVENT_SPAMBLOCK_LOGTYPE', 'Choose logging method');
@define('PLUGIN_EVENT_SPAMBLOCK_LOGTYPE_DESC', 'Logging of rejected comments can be done in Database or to a plaintext file');
@define('PLUGIN_EVENT_SPAMBLOCK_LOGTYPE_FILE', 'File (see "logfile" option below)');
@define('PLUGIN_EVENT_SPAMBLOCK_LOGTYPE_DB', 'Database');
@define('PLUGIN_EVENT_SPAMBLOCK_LOGTYPE_NONE', 'No Logging');

@define('PLUGIN_EVENT_SPAMBLOCK_API_COMMENTS', 'How to treat comments made via APIs');
@define('PLUGIN_EVENT_SPAMBLOCK_API_COMMENTS_DESC', 'This affects the moderation of comments made via API calls (Trackbacks, WFW:commentAPI comments). If set to "moderate", all those comments always need to be approved first. If set to "reject", the are completely disallowed. If set to "none", the comments will be treated as usual comments.');
@define('PLUGIN_EVENT_SPAMBLOCK_API_MODERATE', 'moderate');
@define('PLUGIN_EVENT_SPAMBLOCK_API_REJECT', 'reject');
@define('PLUGIN_EVENT_SPAMBLOCK_REASON_API', 'No API-created comments (like trackbacks) allowed');

@define('PLUGIN_EVENT_SPAMBLOCK_FILTER_ACTIVATE', 'Activate wordfilter');
@define('PLUGIN_EVENT_SPAMBLOCK_FILTER_ACTIVATE_DESC', 'Searches comments for certain strings and marks them as spam.');

@define('PLUGIN_EVENT_SPAMBLOCK_FILTER_URLS', 'Wordfilter for URLs');
@define('PLUGIN_EVENT_SPAMBLOCK_FILTER_URLS_DESC', 'Regular Expressions allowed, separate strings by semicolons (;).');
@define('PLUGIN_EVENT_SPAMBLOCK_FILTER_AUTHORS', 'Wordfilter for author names');
@define('PLUGIN_EVENT_SPAMBLOCK_FILTER_AUTHORS_DESC', 'Regular Expressions allowed, separate strings by semicolons (;).');
@define('PLUGIN_EVENT_SPAMBLOCK_FILTER_WORDS', 'Wordfilter for comment body');

@define('PLUGIN_EVENT_SPAMBLOCK_REASON_CHECKMAIL', 'Invalid e-mail address');
@define('PLUGIN_EVENT_SPAMBLOCK_CHECKMAIL', 'Check e-mail addresses?');
@define('PLUGIN_EVENT_SPAMBLOCK_REQUIRED_FIELDS', 'Required comment fields');
@define('PLUGIN_EVENT_SPAMBLOCK_REQUIRED_FIELDS_DESC', 'Enter a list of required fields that need to be filled when a user comments. Seperate multiple fields with a ",". Available keys are: name, email, url, replyTo, comment');
@define('PLUGIN_EVENT_SPAMBLOCK_REASON_REQUIRED_FIELD', 'You did not specify the %s field!');

@define('PLUGIN_EVENT_SPAMBLOCK_CONFIG', 'Configure Anti-Spam methods');
@define('PLUGIN_EVENT_SPAMBLOCK_ADD_AUTHOR', 'Block this author via Spamblock plugin');
@define('PLUGIN_EVENT_SPAMBLOCK_ADD_URL', 'Block this URL via Spamblock plugin');
@define('PLUGIN_EVENT_SPAMBLOCK_REMOVE_AUTHOR', 'Unblock this author via Spamblock plugin');
@define('PLUGIN_EVENT_SPAMBLOCK_REMOVE_URL', 'Unblock this URL via Spamblock plugin');

@define('PLUGIN_EVENT_SPAMBLOCK_BLOGG_SPAMLIST', 'Activate URL filtering by blogg.de Blacklist');
@define('PLUGIN_EVENT_SPAMBLOCK_REASON_BLOGG_SPAMLIST', 'Filtered by blogg.de Blacklist');

@define('PLUGIN_EVENT_SPAMBLOCK_REASON_TITLE', 'Entry title equals comment');
@define('PLUGIN_EVENT_SPAMBLOCK_FILTER_TITLE', 'Reject comments which only contain the entry title');

@define('PLUGIN_EVENT_SPAMBLOCK_TRACKBACKURL', 'Check Trackback URLs');
@define('PLUGIN_EVENT_SPAMBLOCK_TRACKBACKURL_DESC', 'Only allow trackbacks, when its URL contains a link to your blog');
@define('PLUGIN_EVENT_SPAMBLOCK_REASON_TRACKBACKURL', 'Trackback URL invalid.');

@define('PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_SCRAMBLE', 'Scrambled Captchas');

@define('PLUGIN_EVENT_SPAMBLOCK_HIDE', 'Disable spamblock for Authors');
@define('PLUGIN_EVENT_SPAMBLOCK_HIDE_DESC', 'You can allow authors in the following usergroups to post comments without them being checked by the spamblock plugin.');

@define('PLUGIN_EVENT_SPAMBLOCK_AKISMET', 'Akismet API Key');
@define('PLUGIN_EVENT_SPAMBLOCK_AKISMET_DESC', 'Akismet.com is a central anti-spam and blacklisting server. It can analyze your incoming comments and check if that comment has been listed as Spam. Akismet was developed for WordPress specifically, but can be used by other systems. You just need an API Key from http://www.akismet.com by registering an account at http://www.wordpress.com/. If you leave this API key empty, Akismet will not be used.');
@define('PLUGIN_EVENT_SPAMBLOCK_AKISMET_FILTER', 'How to treat Akismet-reported spam');
@define('PLUGIN_EVENT_SPAMBLOCK_REASON_AKISMET_SPAMLIST', 'Filtered by Akismet.com Blacklist');

@define('PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATION_TREAT', 'What to do with comments when being auto-moderated?');
@define('PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATIONT_TREAT', 'What to do with trackbacks when being auto-moderated?');
@define('PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATIONT', 'Force trackback moderation after how many days');
@define('PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATIONT_DESC', 'You can automatically set all trackbacks for entries to be moderated. Enter the age of an entry in days, after which it should be auto-moderated. 0 means no auto-moderation.');

@define('PLUGIN_EVENT_SPAMBLOCK_CSRF', 'Use CSRF protection for comments?');
@define('PLUGIN_EVENT_SPAMBLOCK_CSRF_DESC', 'If enabled, a special hash value will check that only users can submit a comment with a valid session ID. This will decrease spam and prevent users from tricking you into submitting comments via CSRF, but it will also prevent users commenting on your blog without cookies.');
@define('PLUGIN_EVENT_SPAMBLOCK_CSRF_REASON', 'Your comment did not contain a Session-Hash. Comments can only be made on this blog when having cookies enabled!');