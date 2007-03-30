<?php # $Id: serendipity_event_spamblock.php 1528 2006-12-01 08:58:47Z garvinhicking $


if (IN_serendipity !== true) {
    die ("Don't hack!");
}

// Probe for a language include with constants. Still include defines later on, if some constants were missing
$probelang = dirname(__FILE__) . '/' . $serendipity['charset'] . 'lang_' . $serendipity['lang'] . '.inc.php';
if (file_exists($probelang)) {
    include $probelang;
}

include dirname(__FILE__) . '/lang_en.inc.php';

/* BC - TODO: Remove for 0.8 final */
if (!function_exists('serendipity_serverOffsetHour')) {
    function serendipity_serverOffsetHour() {
        return time();
    }
}

class serendipity_event_spamblock extends serendipity_event
{
var $filter_defaults;

    function introspect(&$propbag)
    {
        global $serendipity;

        $this->title = PLUGIN_EVENT_SPAMBLOCK_TITLE;

        $propbag->add('name',          PLUGIN_EVENT_SPAMBLOCK_TITLE);
        $propbag->add('description',   PLUGIN_EVENT_SPAMBLOCK_DESC);
        $propbag->add('stackable',     false);
        $propbag->add('author',        'Garvin Hicking, Sebastian Nohn');
        $propbag->add('requirements',  array(
            'serendipity' => '0.8',
            'smarty'      => '2.6.7',
            'php'         => '4.1.0'
        ));
        $propbag->add('version',       '1.61');
        $propbag->add('event_hooks',    array(
            'frontend_saveComment' => true,
            'external_plugin'      => true,
            'frontend_comment'     => true,
            'fetchcomments'        => true,
            'backend_comments_top' => true,
            'backend_view_comment' => true
        ));
        $propbag->add('configuration', array(
            'killswitch',
            'hide_for_authors',
            'bodyclone',
            'entrytitle',
            'ipflood',
            'csrf',
            'captchas',
            'captchas_ttl',
            'captcha_color',
            'forcemoderation',
            'forcemoderation_treat',
            'forcemoderationt',
            'forcemoderationt_treat',
            'disable_api_comments',
            'trackback_check_url',
            'links_moderate',
            'links_reject',
            'contentfilter_activate',
            'contentfilter_urls',
            'contentfilter_authors',
            'contentfilter_words',
            'bloggdeblacklist',
            'akismet',
            'akismet_filter',
            'hide_email',
            'checkmail',
            'required_fields',
            'logtype',
            'logfile'));
        $propbag->add('groups', array('ANTISPAM'));

        $this->filter_defaults = array(
                                   'authors' => 'casino;phentermine;credit;loans;poker',
                                   'urls'    => '8gold\.com;911easymoney\.com;canadianlabels\.net;condodream\.com;crepesuzette\.com;debt-help-bill-consolidation-elimination\.com;fidelityfunding\.net;flafeber\.com;gb\.com;houseofsevengables\.com;instant-quick-money-cash-advance-personal-loans-until-pay-day\.com;mediavisor\.com;newtruths\.com;oiline\.com;onlinegamingassociation\.com;online\-+poker\.com;popwow\.com;royalmailhotel\.com;spoodles\.com;sportsparent\.com;stmaryonline\.org;thatwhichis\.com;tmsathai\.org;uaeecommerce\.com;learnhowtoplay\.com',
                                   'words'   => 'very good site!;Real good stuff!'
        );
    }

    function introspect_config_item($name, &$propbag)
    {
        global $serendipity;

        switch($name) {
            case 'disable_api_comments':
                $propbag->add('type', 'radio');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_API_COMMENTS);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_API_COMMENTS_DESC);
                $propbag->add('default', 'none');
                $propbag->add('radio', array(
                    'value' => array('moderate', 'reject', 'none'),
                    'desc'  => array(PLUGIN_EVENT_SPAMBLOCK_API_MODERATE, PLUGIN_EVENT_SPAMBLOCK_API_REJECT, NONE)
                ));
                $propbag->add('radio_per_row', '1');

                break;

            case 'trackback_check_url':
                $propbag->add('type', 'boolean');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_TRACKBACKURL);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_TRACKBACKURL_DESC);
                $propbag->add('default', false);
                break;

            case 'hide_email':
                $propbag->add('type', 'boolean');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_HIDE_EMAIL);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_HIDE_EMAIL_DESC);
                $propbag->add('default', false);
                break;

            case 'csrf':
                $propbag->add('type', 'boolean');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_CSRF);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_CSRF_DESC);
                $propbag->add('default', true);
                break;

            case 'entrytitle':
                $propbag->add('type', 'boolean');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_FILTER_TITLE);
                $propbag->add('description', '');
                $propbag->add('default', false);
                break;

            case 'checkmail':
                $propbag->add('type', 'boolean');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_CHECKMAIL);
                $propbag->add('description', '');
                $propbag->add('default', false);
                break;

            case 'required_fields':
                $propbag->add('type', 'string');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_REQUIRED_FIELDS);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_REQUIRED_FIELDS_DESC);
                $propbag->add('default', '');
                break;

            case 'bodyclone':
                $propbag->add('type', 'boolean');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_BODYCLONE);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_BODYCLONE_DESC);
                $propbag->add('default', true);
                break;

            case 'captchas':
                $propbag->add('type', 'radio');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_DESC);
                $propbag->add('default', 'yes');
                $propbag->add('radio', array(
                    'value' => array(true, 'no', 'scramble'),
                    'desc'  => array(YES, NO, PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_SCRAMBLE)
                ));
                break;

            case 'hide_for_authors':
                $_groups =& serendipity_getAllGroups();
                $groups = array(
                    'all'  => ALL_AUTHORS,
                    'none' => NONE
                );

                foreach($_groups AS $group) {
                    $groups[$group['confkey']] = $group['confvalue'];
                }

                $propbag->add('type', 'multiselect');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_HIDE);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_HIDE_DESC);
                $propbag->add('select_values', $groups);
                $propbag->add('select_size',   5);
                $propbag->add('default', 'all');
                break;

            case 'killswitch':
                $propbag->add('type', 'boolean');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_KILLSWITCH);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_KILLSWITCH_DESC);
                $propbag->add('default', false);
                break;

            case 'contentfilter_activate':
                $propbag->add('type', 'radio');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_FILTER_ACTIVATE);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_FILTER_ACTIVATE_DESC);
                $propbag->add('default', 'moderate');
                $propbag->add('radio', array(
                    'value' => array('moderate', 'reject', 'none'),
                    'desc'  => array(PLUGIN_EVENT_SPAMBLOCK_API_MODERATE, PLUGIN_EVENT_SPAMBLOCK_API_REJECT, NONE)
                ));
                $propbag->add('radio_per_row', '1');

                break;

            case 'bloggdeblacklist':
                $propbag->add('type', 'radio');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_BLOGG_SPAMLIST);
                $propbag->add('description', '');
                $propbag->add('default', 'none');
                $propbag->add('radio', array(
                    'value' => array('moderate', 'reject', 'none'),
                    'desc'  => array(PLUGIN_EVENT_SPAMBLOCK_API_MODERATE, PLUGIN_EVENT_SPAMBLOCK_API_REJECT, NONE)
                ));
                $propbag->add('radio_per_row', '1');

                break;

            case 'akismet':
                $propbag->add('type', 'string');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_AKISMET);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_AKISMET_DESC);
                $propbag->add('default', '');
                $propbag->add('radio', array(
                    'value' => array('moderate', 'reject', 'none'),
                    'desc'  => array(PLUGIN_EVENT_SPAMBLOCK_API_MODERATE, PLUGIN_EVENT_SPAMBLOCK_API_REJECT, NONE)
                ));
                $propbag->add('radio_per_row', '1');

                break;

            case 'akismet_filter':
                $propbag->add('type', 'radio');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_AKISMET_FILTER);
                $propbag->add('description', '');
                $propbag->add('default', 'reject');
                $propbag->add('radio', array(
                    'value' => array('moderate', 'reject', 'none'),
                    'desc'  => array(PLUGIN_EVENT_SPAMBLOCK_API_MODERATE, PLUGIN_EVENT_SPAMBLOCK_API_REJECT, NONE)
                ));
                $propbag->add('radio_per_row', '1');

                break;

            case 'contentfilter_urls':
                $propbag->add('type', 'text');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_FILTER_URLS);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_FILTER_URLS_DESC);
                $propbag->add('default', $this->filter_defaults['urls']);
                break;

            case 'contentfilter_authors':
                $propbag->add('type', 'text');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_FILTER_AUTHORS);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_FILTER_AUTHORS_DESC);
                $propbag->add('default', $this->filter_defaults['authors']);
                break;

            case 'contentfilter_words':
                $propbag->add('type', 'text');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_FILTER_WORDS);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_FILTER_AUTHORS_DESC);
                $propbag->add('default', $this->filter_defaults['words']);
                break;

            case 'logfile':
                $propbag->add('type', 'string');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_LOGFILE);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_LOGFILE_DESC);
                $propbag->add('default', $serendipity['serendipityPath'] . 'spamblock.log');
                break;

            case 'logtype':
                $propbag->add('type', 'radio');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_LOGTYPE);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_LOGTYPE_DESC);
                $propbag->add('default', 'db');
                $propbag->add('radio',         array(
                    'value' => array('file', 'db', 'none'),
                    'desc'  => array(PLUGIN_EVENT_SPAMBLOCK_LOGTYPE_FILE, PLUGIN_EVENT_SPAMBLOCK_LOGTYPE_DB, PLUGIN_EVENT_SPAMBLOCK_LOGTYPE_NONE)
                ));
                $propbag->add('radio_per_row', '1');

                break;

            case 'ipflood':
                $propbag->add('type', 'string');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_IPFLOOD);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_IPFLOOD_DESC);
                $propbag->add('default', 0);
                break;

            case 'captchas_ttl':
                $propbag->add('type', 'string');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_TTL);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_TTL_DESC);
                $propbag->add('default', '7');
                break;

            case 'captcha_color':
                $propbag->add('type', 'string');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_CAPTCHA_COLOR);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_CAPTCHA_COLOR_DESC);
                $propbag->add('default', '255,255,255');
                $propbag->add('validate', '@^[0-9]{1,3},[0-9]{1,3},[0-9]{1,3}$@');
                break;

            case 'forcemoderation':
                $propbag->add('type', 'string');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATION);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATION_DESC);
                $propbag->add('default', '30');
                break;

            case 'forcemoderation_treat':
                $propbag->add('type', 'radio');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATION_TREAT);
                $propbag->add('description', '');
                $propbag->add('default', 'moderate');
                $propbag->add('radio', array(
                    'value' => array('moderate', 'reject'),
                    'desc'  => array(PLUGIN_EVENT_SPAMBLOCK_API_MODERATE, PLUGIN_EVENT_SPAMBLOCK_API_REJECT)
                ));
                $propbag->add('radio_per_row', '1');
                break;

            case 'forcemoderationt':
                $propbag->add('type', 'string');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATIONT);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATIONT_DESC);
                $propbag->add('default', '30');
                break;

            case 'forcemoderationt_treat':
                $propbag->add('type', 'radio');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_FORCEMODERATIONT_TREAT);
                $propbag->add('description', '');
                $propbag->add('default', 'moderate');
                $propbag->add('radio', array(
                    'value' => array('moderate', 'reject'),
                    'desc'  => array(PLUGIN_EVENT_SPAMBLOCK_API_MODERATE, PLUGIN_EVENT_SPAMBLOCK_API_REJECT)
                ));
                $propbag->add('radio_per_row', '1');
                break;

            case 'links_moderate':
                $propbag->add('type', 'string');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_LINKS_MODERATE);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_LINKS_MODERATE_DESC);
                $propbag->add('default', '7');
                break;

            case 'links_reject':
                $propbag->add('type', 'string');
                $propbag->add('name', PLUGIN_EVENT_SPAMBLOCK_LINKS_REJECT);
                $propbag->add('description', PLUGIN_EVENT_SPAMBLOCK_LINKS_REJECT_DESC);
                $propbag->add('default', '13');
                break;

            default:
                    return false;
        }

        return true;
    }

    function &getBlacklist($where, $api_key = '', &$eventData, &$addData) {
        global $serendipity;

        $ret = false;
        require_once S9Y_PEAR_PATH . 'HTTP/Request.php';
        if (function_exists('serendipity_request_start')) serendipity_request_start();

        switch($where) {
            case 'akismet.com':
                $ret  = array();
        		$data = array(
        		  'blog'                    => $serendipity['baseURL'],
        		  'user_agent'              => $_SERVER['HTTP_USER_AGENT'],
        		  'referrer'                => $_SERVER['HTTP_REFERER'],
        		  'user_ip'                 => $_SERVER['REMOTE_ADDR'] != getenv('SERVER_ADDR') ? $_SERVER['REMOTE_ADDR'] : getenv('HTTP_X_FORWARDED_FOR'),
        		  'permalink'               => serendipity_archiveURL($eventData['id'], $eventData['title'], 'serendipityHTTPPath', true, array('timestamp' => $eventData['timestamp'])),
        		  'comment_type'            => ($addData['type'] == 'NORMAL' ? 'comment' : 'trackback'),
        		  'comment_author'          => $addData['name'],
        		  'comment_author_email'    => $addData['email'],
        		  'comment_author_url'      => $addData['url'],
        		  'comment_content'         => $addData['comment']
                );
                $opt = array(
                    'method'            => 'POST',
                    'http'              => '1.1',
                    'timeout'           => 20,
                    'allowRedirects'    => true,
                    'maxRedirects'      => 3
                );

                $req    = &new HTTP_Request(
                    'http://rest.akismet.com/1.1/verify-key',
                     $opt
                );

                $req->addPostData('key',  $api_key);
                $req->addPostData('blog', $serendipity['baseURL']);

                if (PEAR::isError($req->sendRequest()) || $req->getResponseCode() != '200') {
                    $ret['is_spam'] = false;
                    $ret['message'] = 'API Verification Request failed';
                    $this->log($this->logfile, $eventData['id'], 'API_ERROR', 'Akismet HTTP verification request failed.', $addData);
                    break;
                } else {
                    // Fetch response
                    $reqdata = $req->getResponseBody();
                }

                if (!preg_match('@valid@i', $reqdata)) {
                    $ret['is_spam'] = false;
                    $ret['message'] = 'API Verification failed';
                    $this->log($this->logfile, $eventData['id'], 'API_ERROR', 'Akismet API verification failed: ' . $reqdata, $addData);
                    break;
                }

                $req    = &new HTTP_Request(
                    'http://' . $api_key . '.rest.akismet.com/1.1/comment-check',
                    $opt
                );

                foreach($data AS $key => $value) {
                    $req->addPostData($key, $value);
                }

                if (PEAR::isError($req->sendRequest()) || $req->getResponseCode() != '200') {
                    $ret['is_spam'] = false;
                    $ret['message'] = 'Akismet Request failed';
                    $this->log($this->logfile, $eventData['id'], 'API_ERROR', 'Akismet HTTP request failed.', $addData);
                    break;
                } else {
                    // Fetch response
                    $reqdata = $req->getResponseBody();
                }

                if (preg_match('@true@i', $reqdata)) {
                    $ret['is_spam'] = true;
                    $ret['message'] = $reqdata;
                } elseif (preg_match('@false@i', $reqdata)) {
                    $ret['is_spam'] = false;
                    $ret['message'] = $reqdata;
                    $this->log($this->logfile, $eventData['id'], 'API_ERROR', 'Akismet API verification failed: ' . $reqdata, $addData);
                } else {
                    $ret['is_spam'] = false;
                    $ret['message'] = 'Akismet API failure';
                    $this->log($this->logfile, $eventData['id'], 'API_ERROR', 'Akismet API failure: ' . $reqdata, $addData);
                }

                break;

            case 'blogg.de':
                $target  = $serendipity['serendipityPath'] . PATH_SMARTY_COMPILE . '/blogg.de.blacklist.txt';
                $timeout = 3600; // One hour

                if (file_exists($target) && filemtime($target) > time()-$timeout) {
                    $data = file_get_contents($target);
                } else {
                    $data = '';

                    $req    = &new HTTP_Request('http://spam.blogg.de/blacklist.txt');

                    if (PEAR::isError($req->sendRequest()) || $req->getResponseCode() != '200') {
                        if (file_exists($target) && filesize($target) > 0) {
                            $data = file_get_contents($target);
                        }
                    } else {
                        // Fetch file
                        $data = $req->getResponseBody();
                        $fp = @fopen($target, 'w');

                        if ($fp) {
                            fwrite($fp, $data);
                            fclose($fp);
                        }
                    }
                }

                $blacklist = explode("\n", $data);
                $ret =& $blacklist;

            default:
                break;
        }

        if (function_exists('serendipity_request_end')) serendipity_request_end();
        return $ret;
    }

    function checkScheme($maxVersion) {
        global $serendipity;

        $version = $this->get_config('version', '1.0');

        if ($version != $maxVersion) {
            $q   = "CREATE TABLE {$serendipity['dbPrefix']}spamblocklog (
                          timestamp int(10) {UNSIGNED} default null,
                          type varchar(255),
                          reason text,
                          entry_id int(10) {UNSIGNED} not null default '0',
                          author varchar(80),
                          email varchar(200),
                          url varchar(200),
                          useragent varchar(255),
                          ip varchar(15),
                          referer varchar(255),
                          body text)";
            $sql = serendipity_db_schema_import($q);

            $q   = "CREATE INDEX kspamidx ON {$serendipity['dbPrefix']}spamblocklog (timestamp);";
            $sql = serendipity_db_schema_import($q);

            $q   = "CREATE INDEX kspamtypeidx ON {$serendipity['dbPrefix']}spamblocklog (type);";
            $sql = serendipity_db_schema_import($q);

            $q   = "CREATE INDEX kspamentryidx ON {$serendipity['dbPrefix']}spamblocklog (entry_id);";
            $sql = serendipity_db_schema_import($q);

            $this->set_config('version', $maxVersion);
        }

        return true;
    }

    function generate_content(&$title) {
        $title = $this->title;
    }

    // Checks whether the current author is contained in one of the gorups that need no spam checking
    function inGroup() {
        global $serendipity;

        $checkgroups = explode('^', $this->get_config('hide_for_authors'));

        if (!isset($serendipity['authorid']) || !is_array($checkgroups)) {
            return false;
        }

        $mygroups =& serendipity_getGroups($serendipity['authorid'], true);
        if (!is_array($mygroups)) {
            return false;
        }

        foreach($checkgroups AS $key => $groupid) {
            if ($groupid == 'all') {
                return true;
            } elseif (in_array($groupid, $mygroups)) {
                return true;
            }
        }

        return false;
    }

    function event_hook($event, &$bag, &$eventData, $addData = null) {
        global $serendipity;

        $hooks = &$bag->get('event_hooks');

        if (isset($hooks[$event])) {
            $captchas_ttl = $this->get_config('captchas_ttl', 7);
            $_captchas    = $this->get_config('captchas', 'yes');
            $captchas     = ($_captchas !== 'no' && ($_captchas === 'yes' || $_captchas === 'scramble' || serendipity_db_bool($_captchas)));

            // Check if the entry is older than the allowed amount of time. Enforce kaptchas if that is true
            // of if kaptchas are activated for every entry
            $show_captcha = ($captchas && isset($eventData['timestamp']) && ($captchas_ttl < 1 || ($eventData['timestamp'] < (time() - ($captchas_ttl*60*60*24)))) ? true : false);

            $forcemoderation = $this->get_config('forcemoderation', 60);
            $forcemoderation_treat = $this->get_config('forcemoderation_treat', 'moderate');
            $forcemoderationt = $this->get_config('forcemoderationt', 60);
            $forcemoderationt_treat = $this->get_config('forcemoderationt_treat', 'moderate');

            $links_moderate  = $this->get_config('links_moderate', 10);
            $links_reject    = $this->get_config('links_reject', 20);

            if (function_exists('imagettftext') && function_exists('imagejpeg')) {
                $max_char = 5;
                $min_char = 3;
                $use_gd   = true;
            } else {
                $max_char = $min_char = 5;
                $use_gd   = false;
            }

            switch($event) {
                case 'fetchcomments':
                    if (is_array($eventData) && !$_SESSION['serendipityAuthedUser'] && serendipity_db_bool($this->get_config('hide_email', false))) {
                        // Will force emails to be not displayed in comments and RSS feed for comments. Will not apply to logged in admins (so not in the backend as well)
                        @reset($eventData);
                        while(list($idx, $comment) = each($eventData)) {
                            $eventData[$idx]['no_email'] = true;
                        }
                    }
                    break;

                case 'frontend_saveComment':
                    if (!is_array($eventData) || serendipity_db_bool($eventData['allow_comments'])) {
                        if ($this->get_config('logtype', 'db') == 'db' && $this->get_config('version') != $bag->get('version')) {
                            $this->checkScheme($bag->get('version'));
                        }

                        $serendipity['csuccess'] = 'true';
                        $logfile = $this->logfile = $this->get_config('logfile', $serendipity['serendipityPath'] . 'spamblock.log');
                        $required_fields = $this->get_config('required_fields', '');

                        // Check CSRF [comments only, cannot be applied to trackbacks]
                        if ($addData['type'] == 'NORMAL' && serendipity_db_bool($this->get_config('csrf', true))) {
                            if (!serendipity_checkFormToken(false)) {
                                $this->log($logfile, $eventData['id'], 'REJECTED', PLUGIN_EVENT_SPAMBLOCK_CSRF_REASON, $addData);
                                $eventData = array('allow_comments' => false);
                                $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_CSRF_REASON;
                            }
                        }

                        // Check required fields
                        if ($addData['type'] == 'NORMAL' && !empty($required_fields)) {
                            $required_field_list = explode(',', $required_fields);
                            foreach($required_field_list as $required_field) {
                                $required_field = trim($required_field);
                                if (empty($addData[$required_field])) {
                                    $this->log($logfile, $eventData['id'], 'REJECTED', PLUGIN_EVENT_SPAMBLOCK_REASON_REQUIRED_FIELD, $addData);
                                    $eventData = array('allow_comments' => false);
                                    $serendipity['messagestack']['comments'][] = sprintf(PLUGIN_EVENT_SPAMBLOCK_REASON_REQUIRED_FIELD, $required_field);
                                    return false;
                                }
                            }
                        }

                        // Check whether to allow comments from registered authors
                        if (serendipity_userLoggedIn() && $this->inGroup()) {
                            return true;
                        }

                        // Check if entry title is the same as comment body
                        if (serendipity_db_bool($this->get_config('entrytitle')) && trim($eventData['title']) == trim($addData['comment'])) {
                            $this->log($logfile, $eventData['id'], 'REJECTED', PLUGIN_EVENT_SPAMBLOCK_REASON_TITLE, $addData);
                            $eventData = array('allow_comments' => false);
                            $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_ERROR_BODY;
                            return false;
                        }

                        // Check for global emergency moderation
                        if ( $this->get_config('killswitch', false) === true ) {
                            $this->log($logfile, $eventData['id'], 'REJECTED', PLUGIN_EVENT_SPAMBLOCK_REASON_KILLSWITCH, $addData);
                            $eventData = array('allow_comments' => false);
                            $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_ERROR_KILLSWITCH;
                            return false;
                        }

                        // Check for not allowing trackbacks/wfwcomments
                        if ( ($addData['type'] != 'NORMAL' || $addData['source'] == 'API') &&
                             $this->get_config('disable_api_comments', 'none') != 'none') {
                            if ($this->get_config('disable_api_comments') == 'reject') {
                                $this->log($logfile, $eventData['id'], 'REJECTED', PLUGIN_EVENT_SPAMBLOCK_REASON_API, $addData);
                                $eventData = array('allow_comments' => false);
                                $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_REASON_API;
                                return false;
                            } elseif ($this->get_config('disable_api_comments') == 'moderate') {
                                $this->log($logfile, $eventData['id'], 'MODERATE', PLUGIN_EVENT_SPAMBLOCK_REASON_API, $addData);
                                $eventData['moderate_comments'] = true;
                                $serendipity['csuccess']        = 'moderate';
                                $serendipity['moderate_reason'] = PLUGIN_EVENT_SPAMBLOCK_REASON_API;
                            }
                        }

                        // Filter Akismet Blacklist?
                        $akismet_apikey = $this->get_config('akismet');
                        $akismet        = $this->get_config('akismet_filter');
                        if (!empty($akismet_apikey) && ($akismet == 'moderate' || $akismet == 'reject')) {
                            $spam = $this->getBlacklist('akismet.com', $akismet_apikey, $eventData, $addData);
                            if ($spam['is_spam'] !== false) {
                                if ($akismet == 'moderate') {
                                    $this->log($logfile, $eventData['id'], 'MODERATE', PLUGIN_EVENT_SPAMBLOCK_REASON_AKISMET_SPAMLIST . ': ' . $spam['message'], $addData);
                                    $eventData['moderate_comments'] = true;
                                    $serendipity['csuccess']        = 'moderate';
                                    $serendipity['moderate_reason'] = PLUGIN_EVENT_SPAMBLOCK_ERROR_BODY;
                                } else {
                                    $this->log($logfile, $eventData['id'], 'REJECTED', PLUGIN_EVENT_SPAMBLOCK_REASON_AKISMET_SPAMLIST . ': ' . $spam['message'], $addData);
                                    $eventData = array('allow_comments' => false);
                                    $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_ERROR_BODY;
                                    return false;
                                }
                            }
                        }

                        // Check Trackback URLs?
                        if ($addData['type'] == 'TRACKBACK' && serendipity_db_bool($this->get_config('trackback_check_url'))) {
                            require_once S9Y_PEAR_PATH . 'HTTP/Request.php';

                            if (function_exists('serendipity_request_start')) serendipity_request_start();
                            $req     = &new HTTP_Request($addData['url'], array('allowRedirects' => true, 'maxRedirects' => 5));
                            $is_valid = false;
                            if (PEAR::isError($req->sendRequest()) || $req->getResponseCode() != '200') {
                                $is_valid = false;
                            } else {
                                $fdata = $req->getResponseBody();

                                // Check if the target page contains a link to our blog
                                if (preg_match('@' . preg_quote($serendipity['baseURL'], '@') . '@i', $fdata)) {
                                    $is_valid = true;
                                } else {
                                    $is_valid = false;
                                }
                            }
                            if (function_exists('serendipity_request_end')) serendipity_request_end();

                            if ($is_valid === false) {
                                $this->log($logfile, $eventData['id'], 'REJECTED', PLUGIN_EVENT_SPAMBLOCK_REASON_TRACKBACKURL, $addData);
                                $eventData = array('allow_comments' => false);
                                $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_REASON_TRACKBACKURL;
                                return false;
                            }
                        }

                        // Check for word filtering
                        if ($filter_type = $this->get_config('contentfilter_activate', 'moderate')) {

                            // Filter authors names
                            $filter_authors = explode(';', $this->get_config('contentfilter_authors', $this->filter_defaults['authors']));
                            if (is_array($filter_authors)) {
                                foreach($filter_authors AS $filter_author) {
                                    if (empty($filter_author)) {
                                        continue;
                                    }
                                    if (preg_match('@' . $filter_author . '@i', $addData['name'])) {
                                        if ($filter_type == 'moderate') {
                                            $this->log($logfile, $eventData['id'], 'MODERATE', PLUGIN_EVENT_SPAMBLOCK_FILTER_AUTHORS, $addData);
                                            $eventData['moderate_comments'] = true;
                                            $serendipity['csuccess']        = 'moderate';
                                            $serendipity['moderate_reason'] = PLUGIN_EVENT_SPAMBLOCK_ERROR_BODY;
                                        } else {
                                            $this->log($logfile, $eventData['id'], 'REJECTED', PLUGIN_EVENT_SPAMBLOCK_FILTER_AUTHORS, $addData);
                                            $eventData = array('allow_comments' => false);
                                            $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_ERROR_BODY;
                                            return false;
                                        }
                                    }
                                }
                            }

                            // Filter URL
                            $filter_urls = explode(';', $this->get_config('contentfilter_urls', $this->filter_defaults['urls']));
                            if (is_array($filter_urls)) {
                                foreach($filter_urls AS $filter_url) {
                                    if (empty($filter_url)) {
                                        continue;
                                    }
                                    if (preg_match('@' . $filter_url . '@i', $addData['url'])) {
                                        if ($filter_type == 'moderate') {
                                            $this->log($logfile, $eventData['id'], 'MODERATE', PLUGIN_EVENT_SPAMBLOCK_FILTER_URLS, $addData);
                                            $eventData['moderate_comments'] = true;
                                            $serendipity['csuccess']        = 'moderate';
                                            $serendipity['moderate_reason'] = PLUGIN_EVENT_SPAMBLOCK_ERROR_BODY;
                                        } else {
                                            $this->log($logfile, $eventData['id'], 'REJECTED', PLUGIN_EVENT_SPAMBLOCK_FILTER_URLS, $addData);
                                            $eventData = array('allow_comments' => false);
                                            $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_ERROR_BODY;
                                            return false;
                                        }
                                    }
                                }
                            }

                            // Filter Content
                            $filter_bodys = explode(';', $this->get_config('contentfilter_words', $this->filter_defaults['words']));
                            if (is_array($filter_bodys)) {
                                foreach($filter_bodys AS $filter_body) {
                                    if (empty($filter_body)) {
                                        continue;
                                    }
                                    if (preg_match('@' . $filter_body . '@i', $addData['comment'])) {
                                        if ($filter_type == 'moderate') {
                                            $this->log($logfile, $eventData['id'], 'MODERATE', PLUGIN_EVENT_SPAMBLOCK_FILTER_WORDS, $addData);
                                            $eventData['moderate_comments'] = true;
                                            $serendipity['csuccess']        = 'moderate';
                                            $serendipity['moderate_reason'] = PLUGIN_EVENT_SPAMBLOCK_ERROR_BODY;
                                        } else {
                                            $this->log($logfile, $eventData['id'], 'REJECTED', PLUGIN_EVENT_SPAMBLOCK_FILTER_WORDS, $addData);
                                            $eventData = array('allow_comments' => false);
                                            $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_ERROR_BODY;
                                            return false;
                                        }
                                    }
                                }
                            }
                        } // Content filtering end

                        // Filter Blogg.de Blacklist?
                        $bloggdeblacklist = $this->get_config('bloggdeblacklist');
                        if ($bloggdeblacklist == 'moderate' || $bloggdeblacklist == 'reject') {
                            $domains = $this->getBlacklist('blogg.de', '', $eventData, $addData);
                            if (is_array($domains)) {
                                foreach($domains AS $domain) {
                                    $domain = trim($domain);
                                    if (empty($domain)) {
                                        continue;
                                    }

                                    if (preg_match('@' . preg_quote($domain) . '@i', $addData['url'])) {
                                        if ($bloggdeblacklist == 'moderate') {
                                            $this->log($logfile, $eventData['id'], 'MODERATE', PLUGIN_EVENT_SPAMBLOCK_REASON_BLOGG_SPAMLIST . ': ' . $domain, $addData);
                                            $eventData['moderate_comments'] = true;
                                            $serendipity['csuccess']        = 'moderate';
                                            $serendipity['moderate_reason'] = PLUGIN_EVENT_SPAMBLOCK_ERROR_BODY;
                                        } else {
                                            $this->log($logfile, $eventData['id'], 'REJECTED', PLUGIN_EVENT_SPAMBLOCK_REASON_BLOGG_SPAMLIST . ': ' . $domain, $addData);
                                            $eventData = array('allow_comments' => false);
                                            $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_ERROR_BODY;
                                            return false;
                                        }
                                    }
                                }
                            }
                        }

                        // Check for maximum number of links before rejecting
                        $link_count = substr_count(strtolower($addData['comment']), 'http://');
                        if ($links_reject > 0 && $link_count > $links_reject) {
                            $this->log($logfile, $eventData['id'], 'REJECTED', PLUGIN_EVENT_SPAMBLOCK_REASON_LINKS_REJECT, $addData);
                            $eventData = array('allow_comments' => false);
                            $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_ERROR_BODY;
                            return false;
                        }

                        // Captcha checking
                        if ($show_captcha && $addData['type'] == 'NORMAL') {
                            if (!isset($_SESSION['spamblock']['captcha']) || !isset($serendipity['POST']['captcha']) || strtolower($serendipity['POST']['captcha']) != strtolower($_SESSION['spamblock']['captcha'])) {
                                $this->log($logfile, $eventData['id'], 'REJECTED', sprintf(PLUGIN_EVENT_SPAMBLOCK_REASON_CAPTCHAS, $serendipity['POST']['captcha'], $_SESSION['spamblock']['captcha']), $addData);
                                $eventData = array('allow_comments' => false);
                                $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_ERROR_CAPTCHAS;
                                return false;
                            } else {
// DEBUG
//                                $this->log($logfile, $eventData['id'], 'REJECTED', 'Captcha passed: ' . $serendipity['POST']['captcha'] . ' / ' . $_SESSION['spamblock']['captcha'] . ' // Source: ' . $_SERVER['REQUEST_URI'], $addData);
                            }
                        } else {
// DEBUG
//                            $this->log($logfile, $eventData['id'], 'REJECTED', 'Captcha not needed: ' . $serendipity['POST']['captcha'] . ' / ' . $_SESSION['spamblock']['captcha'] . ' // Source: ' . $_SERVER['REQUEST_URI'], $addData);
                        }

                        // Check for forced comment moderation
                        if ($addData['type'] == 'NORMAL' && $forcemoderation > 0 && $eventData['timestamp'] < (time() - ($forcemoderation * 60 * 60 * 24))) {
                            $this->log($logfile, $eventData['id'], $forcemoderation_treat, PLUGIN_EVENT_SPAMBLOCK_REASON_FORCEMODERATION, $addData);
                            if ($forcemoderation_treat == 'reject') {
                                $eventData = array('allow_comments' => false);
                                $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_REASON_FORCEMODERATION;
                                return false;
                            } else {
                                $eventData['moderate_comments'] = true;
                                $serendipity['csuccess']        = 'moderate';
                                $serendipity['moderate_reason'] = PLUGIN_EVENT_SPAMBLOCK_REASON_FORCEMODERATION;
                            }
                        }

                        // Check for forced trackback moderation
                        if ($addData['type'] != 'NORMAL' && $forcemoderationt > 0 && $eventData['timestamp'] < (time() - ($forcemoderationt * 60 * 60 * 24))) {
                            $this->log($logfile, $eventData['id'], $forcemoderationt_treat, PLUGIN_EVENT_SPAMBLOCK_REASON_FORCEMODERATION, $addData);
                            if ($forcemoderationt_treat == 'reject') {
                                $eventData = array('allow_comments' => false);
                                $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_REASON_FORCEMODERATION;
                                return false;
                            } else {
                                $eventData['moderate_comments'] = true;
                                $serendipity['csuccess']        = 'moderate';
                                $serendipity['moderate_reason'] = PLUGIN_EVENT_SPAMBLOCK_REASON_FORCEMODERATION;
                            }
                        }

                        // Check for maximum number of links before forcing moderation
                        if ($links_moderate > 0 && $link_count > $links_moderate) {
                            $this->log($logfile, $eventData['id'], 'REJECTED', PLUGIN_EVENT_SPAMBLOCK_REASON_LINKS_MODERATE, $addData);
                            $eventData['moderate_comments'] = true;
                            $serendipity['csuccess']        = 'moderate';
                            $serendipity['moderate_reason'] = PLUGIN_EVENT_SPAMBLOCK_REASON_LINKS_MODERATE;
                        }

                        // Check for identical comments. We allow to bypass trackbacks from our server to our own blog.
                        if ( $this->get_config('bodyclone', true) === true && $_SERVER['REMOTE_ADDR'] != $_SERVER['SERVER_ADDR']) {
                            $query = "SELECT count(id) AS counter FROM {$serendipity['dbPrefix']}comments WHERE body = '" . serendipity_db_escape_string($addData['comment']) . "'";
                            $row   = serendipity_db_query($query, true);
                            if (is_array($row) && $row['counter'] > 0) {
                                $this->log($logfile, $eventData['id'], 'REJECTED', PLUGIN_EVENT_SPAMBLOCK_REASON_BODYCLONE, $addData);
                                $eventData = array('allow_comments' => false);
                                $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_ERROR_BODY;
                                return false;
                            }
                        }

                        // Check last IP
                        if ($addData['type'] == 'NORMAL' && $this->get_config('ipflood', 2) != 0 ) {
                            $query = "SELECT max(timestamp) AS last_post FROM {$serendipity['dbPrefix']}comments WHERE ip = '" . serendipity_db_escape_string($_SERVER['REMOTE_ADDR']) . "'";
                            $row   = serendipity_db_query($query, true);
                            if (is_array($row) && $row['last_post'] > (time() - $this->get_config('ipflood', 2)*60)) {
                                $this->log($logfile, $eventData['id'], 'REJECTED', PLUGIN_EVENT_SPAMBLOCK_REASON_IPFLOOD, $addData);
                                $eventData = array('allow_comments' => false);
                                $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_ERROR_IP;
                                return false;
                            }
                        }

                        // Check invalid email
                        if ($addData['type'] == 'NORMAL' && serendipity_db_bool($this->get_config('checkmail', false))) {
                            if (!empty($addData['email']) && strstr($addData['email'], '@') === false) {
                                $this->log($logfile, $eventData['id'], 'REJECTED', PLUGIN_EVENT_SPAMBLOCK_REASON_CHECKMAIL, $addData);
                                $eventData = array('allow_comments' => false);
                                $serendipity['messagestack']['comments'][] = PLUGIN_EVENT_SPAMBLOCK_REASON_CHECKMAIL;
                                return false;
                            }
                        }

                        if ($eventData['moderate_comments'] == true) {
                            return false;
                        }
                    }

                    return true;
                    break;

                case 'frontend_comment':
                    if (serendipity_db_bool($this->get_config('hide_email', false))) {
                        echo '<div class="serendipity_commentDirection serendipity_comment_spamblock">' . PLUGIN_EVENT_SPAMBLOCK_HIDE_EMAIL_NOTICE . '</div>';
                    }

                    if (serendipity_db_bool($this->get_config('csrf', true))) {
                        echo serendipity_setFormToken('form');
                    }

                    // Check whether to allow comments from registered authors
                    if (serendipity_userLoggedIn() && $this->inGroup()) {
                        return true;
                    }

                    if ($show_captcha) {
                        echo '<div class="serendipity_commentDirection serendipity_comment_captcha">';
                        if (!isset($serendipity['POST']['preview']) || strtolower($serendipity['POST']['captcha'] != strtolower($_SESSION['spamblock']['captcha']))) {
                            echo '<br />' . PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_USERDESC . '<br />';
                            if ($use_gd) {
                                printf('<img src="%s" title="%s" alt="CAPTCHA" class="captcha" />',
                                    $serendipity['baseURL'] . ($serendipity['rewrite'] == 'none' ? $serendipity['indexFile'] . '?/' : '') . 'plugin/captcha_' . md5(time()),
                                    htmlspecialchars(PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_USERDESC2)
                                );
                            } else {
                                $bgcolors = explode(',', $this->get_config('captcha_color', '255,0,255'));
                                $hexval   = '#' . dechex(trim($bgcolors[0])) . dechex(trim($bgcolors[1])) . dechex(trim($bgcolors[2]));
                                $this->random_string($max_char, $min_char);
                                echo '<div style="background-color: ' . $hexval . '">';
                                for ($i = 1; $i <= $max_char; $i++) {
                                    printf('<img src="%s" title="%s" alt="CAPTCHA ' . $i . '" class="captcha" />',
                                        $serendipity['baseURL'] . ($serendipity['rewrite'] == 'none' ? $serendipity['indexFile'] . '?/' : '') . 'plugin/captcha_' . $i . '_' . md5(time()),
                                        htmlspecialchars(PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_USERDESC2)
                                    );
                                }
                                echo '</div>';
                            }
                            echo '<br />';
                            echo '<label for="captcha">'. PLUGIN_EVENT_SPAMBLOCK_CAPTCHAS_USERDESC3 . '</label><br /><input type="text" size="5" name="serendipity[captcha]" value="" id="captcha" />';
                        } elseif (isset($serendipity['POST']['captcha'])) {
                            echo '<input type="hidden" name="serendipity[captcha]" value="' . htmlspecialchars($serendipity['POST']['captcha']) . '" />';
                        }
                        echo '</div>';
                    }

                    return true;
                    break;


                case 'external_plugin':
                    $parts     = explode('_', $eventData);
                    if (!empty($parts[1])) {
                        $param     = (int) $parts[1];
                    } else {
                        $param     = null;
                    }

                    $methods = array('captcha');

                    if (!in_array($parts[0], $methods)) {
                        return;
                    }

                    list($musec, $msec) = explode(' ', microtime());
                    $srand = (float) $msec + ((float) $musec * 100000);
                    srand($srand);
                    mt_srand($srand);
                    $width    = 120;
                    $height   = 40;

                    $bgcolors = explode(',', $this->get_config('captcha_color', '255,255,255'));
                    $fontfiles = array('Vera.ttf', 'VeraSe.ttf', 'chumbly.ttf', '36daysago.ttf');

                    if ($use_gd) {
                        $strings  = $this->random_string($max_char, $min_char);
                        $fontname = $fontfiles[array_rand($fontfiles)];
                        $font     = $serendipity['serendipityPath'] . 'plugins/serendipity_event_spamblock/' . $fontname;

                        if (!file_exists($font)) {
                            // Search in shared plugin directory
                            $font = S9Y_INCLUDE_PATH . 'plugins/serendipity_event_spamblock/' . $fontname;
                        }

                        if (!file_exists($font)) {
                            die(PLUGIN_EVENT_SPAMBLOCK_ERROR_NOTTF);
                        }

                        header('Content-Type: image/jpeg');
                        $image  = imagecreate($width, $height);
                        $bgcol  = imagecolorallocate($image, trim($bgcolors[0]), trim($bgcolors[1]), trim($bgcolors[2]));
                        // imagettftext($image, 10, 1, 1, 15, imagecolorallocate($image, 255, 255, 255), $font, 'String: ' . $string);

                        $pos_x  = 5;
                        foreach($strings AS $idx => $charidx) {
                            $color = imagecolorallocate($image, mt_rand(50, 235), mt_rand(50, 235), mt_rand(50,235));
                            $size  = mt_rand(15, 21);
                            $angle = mt_rand(-20, 20);
                            $pos_y = ceil($height - (mt_rand($size/3, $size/2)));

                            imagettftext(
                              $image,
                              $size,
                              $angle,
                              $pos_x,
                              $pos_y,
                              $color,
                              $font,
                              $this->chars[$charidx]
                            );

                            $pos_x = $pos_x + $size + 2;

                        }

                        if ($_captchas === 'scramble') {
                            $line_diff = mt_rand(5, 15);
                            $pixel_col = imagecolorallocate($image, trim($bgcolors[0])-mt_rand(10,50), trim($bgcolors[1])-mt_rand(10,50), trim($bgcolors[2])-mt_rand(10,50));
                            for ($y = $line_diff; $y < $height; $y += $line_diff) {
                                $row_diff = mt_rand(5, 15);
                                for ($x = $row_diff; $x < $width; $x+= $row_diff) {
                                    imagerectangle($image, $x, $y, $x+1, $y+1, $pixel_col);
                                }
                            }
                        }
                        imagejpeg($image, '', 90);
                        imagedestroy($image);
                    } else {
                        header('Content-Type: image/png');
                        $output_char = strtolower($_SESSION['spamblock']['captcha']{$parts[1] - 1});
                        $cap = $serendipity['serendipityPath'] . 'plugins/serendipity_event_spamblock/captcha_' . $output_char . '.png';
                        if (!file_exists($cap)) {
                            $cap = S9Y_INCLUDE_PATH . 'plugins/serendipity_event_spamblock/captcha_' . $output_char . '.png';
                        }

                        if (file_exists($cap)) {
                            echo file_get_contents($cap);
                        }
                    }
                    return true;
                    break;

                case 'backend_comments_top':

                    // Add Author to blacklist. If already filtered, it will be removed from the filter. (AKA "Toggle")
                    if (isset($serendipity['GET']['spamBlockAuthor'])) {
                        $item    = $this->getComment('author', $serendipity['GET']['spamBlockAuthor']);
                        $items   = &$this->checkFilter('authors', $item, true);
                        $this->set_config('contentfilter_authors', implode(';', $items));
                    }

                    // Add URL to blacklist. If already filtered, it will be removed from the filter. (AKA "Toggle")
                    if (isset($serendipity['GET']['spamBlockURL'])) {
                        $item    = $this->getComment('url', $serendipity['GET']['spamBlockURL']);
                        $items   = &$this->checkFilter('urls', $item, true);
                        $this->set_config('contentfilter_urls', implode(';', $items));
                    }

                    echo ' - ' . WORD_OR . ' - <a class="serendipityPrettyButton" href="serendipity_admin.php?serendipity[adminModule]=plugins&amp;serendipity[plugin_to_conf]=' . $this->instance . '">' . PLUGIN_EVENT_SPAMBLOCK_CONFIG . '</a>';
                    return true;
                    break;

                case 'backend_view_comment':
                    $author_is_filtered = $this->checkFilter('authors', $eventData['author']);
                    $clink1 = 'clink1' . $eventData['id'];
                    $clink2 = 'clink2' . $eventData['id'];

                    $eventData['action_author'] .= ' <a id="' . $clink1 . '" class="serendipityIconLink" title="' . ($author_is_filtered ? PLUGIN_EVENT_SPAMBLOCK_REMOVE_AUTHOR : PLUGIN_EVENT_SPAMBLOCK_ADD_AUTHOR) . '" href="serendipity_admin.php?serendipity[adminModule]=comments&amp;serendipity[spamBlockAuthor]=' . $eventData['id'] . $addData . '#' . $clink1 . '"><img src="' . serendipity_getTemplateFile('admin/img/' . ($author_is_filtered ? 'un' : '') . 'configure.png') . '" /></a>';

                    if (!empty($eventData['url'])) {
                        $url_is_filtered    = $this->checkFilter('urls', $eventData['url']);
                        $eventData['action_url']    .= ' <a id="' . $clink2 . '" class="serendipityIconLink" title="' . ($url_is_filtered ? PLUGIN_EVENT_SPAMBLOCK_REMOVE_URL : PLUGIN_EVENT_SPAMBLOCK_ADD_URL) . '" href="serendipity_admin.php?serendipity[adminModule]=comments&amp;serendipity[spamBlockURL]=' . $eventData['id'] . $addData . '#' . $clink2 . '"><img src="' . serendipity_getTemplateFile('admin/img/' . ($url_is_filtered ? 'un' : '') . 'configure.png') . '" /></a>';
                    }

                    return true;
                    break;

                default:
                    return false;
                    break;
            }
        } else {
            return false;
        }
    }

    function &checkFilter($what, $match, $getItems = false) {
        $items = explode(';', $this->get_config('contentfilter_' . $what, $this->filter_defaults[$what]));

        $filtered = false;
        if (is_array($items)) {
            foreach($items AS $key => $item) {
                if (empty($match)) {
                    continue;
                }

                if (empty($item)) {
                    unset($items[$key]);
                    continue;
                }

                if (preg_match('@' . $item . '@', $match)) {
                    $filtered = true;
                    unset($items[$key]);
                }
            }
        }

        if ($getItems) {
            if (!$filtered && !empty($match)) {
                $items[] = preg_quote($match, '@');
            }

            return $items;
        }

        return $filtered;
    }

    function getComment($key, $id) {
        global $serendipity;
        $c = serendipity_db_query("SELECT $key FROM {$serendipity['dbPrefix']}comments WHERE id = '" . (int)$id . "'", true, 'assoc');

        if (!is_array($c) || !isset($c[$key])) {
            return false;
        }

        return $c[$key];
    }

    function random_string($max_char, $min_char) {
        $this->chars = array(2, 3, 4, 7, 9); // 1, 5, 6 and 8 may look like characters.
        $this->chars = array_merge($this->chars, array('A','B','C','D','E','F','H','J','K','L','M','N','P','Q','R','T','U','V','W','X','Y','Z')); // I, O, S may look like numbers

        $strings   = array_rand($this->chars, mt_rand($min_char, $max_char));
        $string    = '';
        foreach($strings AS $idx => $charidx) {
            $string .= $this->chars[$charidx];
        }
        $_SESSION['spamblock'] = array('captcha' => $string);

        return $strings;
    }

    function log($logfile, $id, $switch, $reason, $comment) {
        global $serendipity;

        $method = $this->get_config('logtype');

        switch($method) {
            case 'file':
                if (empty($logfile)) {
                    return;
                }

                $fp = @fopen($logfile, 'a+');
                if (!is_resource($fp)) {
                    return;
                }

                fwrite($fp, sprintf(
                    '[%s] - [%s: %s] - [#%s, Name "%s", E-Mail "%s", URL "%s", User-Agent "%s", IP %s] - [%s]' . "\n",
                    date('Y-m-d H:i:s', serendipity_serverOffsetHour()),
                    $switch,
                    $reason,
                    $id,
                    str_replace("\n", ' ', $comment['name']),
                    str_replace("\n", ' ', $comment['email']),
                    str_replace("\n", ' ', $comment['url']),
                    str_replace("\n", ' ', $_SERVER['HTTP_USER_AGENT']),
                    $_SERVER['REMOTE_ADDR'],
                    str_replace("\n", ' ', $comment['comment'])
                ));

                fclose($fp);
                break;

            case 'none':
                return;
                break;

            case 'db':
            default:
                $q = sprintf("INSERT INTO {$serendipity['dbPrefix']}spamblocklog
                                          (timestamp, type, reason, entry_id, author, email, url,  useragent, ip,   referer, body)
                                   VALUES (%d,        '%s',  '%s',  '%s',     '%s',   '%s',  '%s', '%s',      '%s', '%s',    '%s')",

                           serendipity_serverOffsetHour(),
                           serendipity_db_escape_string($switch),
                           serendipity_db_escape_string($reason),
                           serendipity_db_escape_string($id),
                           serendipity_db_escape_string($comment['name']),
                           serendipity_db_escape_string($comment['email']),
                           serendipity_db_escape_string($comment['url']),
                           serendipity_db_escape_string($_SERVER['HTTP_USER_AGENT']),
                           serendipity_db_escape_string($_SERVER['REMOTE_ADDR']),
                           serendipity_db_escape_string(isset($_SESSION['HTTP_REFERER']) ? $_SESSION['HTTP_REFERER'] : $_SERVER['HTTP_REFERER']),
                           serendipity_db_escape_string($comment['comment'])
                );

                serendipity_db_query($q);
                break;
        }
    }
}

/* vim: set sts=4 ts=4 expandtab : */
