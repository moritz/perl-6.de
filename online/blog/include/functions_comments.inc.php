<?php # $Id: functions_comments.inc.php 1618 2007-02-13 08:35:56Z garvinhicking $
# Copyright (c) 2003-2005, Jannis Hermanns (on behalf the Serendipity Developer Team)
# All rights reserved.  See LICENSE file for licensing details

if (IN_serendipity !== true) {
    die ("Don't hack!");
}

if (defined('S9Y_FRAMEWORK_COMMENTS')) {
    return;
}
@define('S9Y_FRAMEWORK_COMMENTS', true);

/**
 * Store the personal details of a commenting user in a cookie (or delete that cookie)
 *
 * @access public
 * @return null
 */
function serendipity_rememberComment() {
    global $serendipity;

    if (isset($serendipity['POST']['remember'])) {
        serendipity_rememberCommentDetails(
          array(
            'url'      => $serendipity['POST']['url'],
            'name'     => $serendipity['POST']['name'],
            'email'    => $serendipity['POST']['email'],
            'remember' => 'checked="checked"'
          )
        );
    } elseif (isset($serendipity['POST']['comment'])) {
        serendipity_forgetCommentDetails(array('url', 'name', 'email', 'remember'));
    }
}

/**
 * Store all options of an array within a permanent cookie
 *
 * @access public
 * @param   array   input array
 * @return null
 */
function serendipity_rememberCommentDetails($details) {
    global $serendipity;

    foreach ($details as $n => $v) {
        serendipity_setCookie($n, $v);
    }
}

/**
 * Purge stored options from a permanent cookie
 *
 * LONG
 *
 * @access public
 * @param   array   Array of key names that shall be deleted inside cookies
 * @return null
 */
function serendipity_forgetCommentDetails($keys) {
    global $serendipity;
    if (!$serendipity['COOKIE']) {
        return;
    }

    foreach ($keys AS $n) {
        serendipity_deleteCookie($n);
    }
}

/**
 * Display the Comment form for entries
 *
 * @access public
 * @param   int     The EntryID to show the commentform for
 * @param   string  The URL that acts as the target of the HTML Form
 * @param   array   Array of existing comments to this entry
 * @param   array   Array of personal details data (i.e. from Cookie or POST input)
 * @param   boolean Toggle whether to show extended options of the comment form
 * @param   boolean Toggle whether comments to this entry are allowed
 * @param   array   The data of the entry that the comment is referring to
 * @return null
 */
function serendipity_displayCommentForm($id, $url = '', $comments = NULL, $data = NULL, $showToolbar = true, $moderate_comments = true, $entry = null) {
    global $serendipity;

    if ($comments == NULL) {
        $comments = serendipity_fetchComments($id);
    }

    $commentform_data = array(
        'commentform_action'         => $url,
        'commentform_id'             => $id,
        'commentform_name'           => isset($data['name'])      ? htmlspecialchars($data['name'])       : (isset($serendipity['COOKIE']['name'])     ? htmlspecialchars($serendipity['COOKIE']['name'])     : ''),
        'commentform_email'          => isset($data['email'])     ? htmlspecialchars($data['email'])      : (isset($serendipity['COOKIE']['email'])    ? htmlspecialchars($serendipity['COOKIE']['email'])    : ''),
        'commentform_url'            => isset($data['url'])       ? htmlspecialchars($data['url'])        : (isset($serendipity['COOKIE']['url'])      ? htmlspecialchars($serendipity['COOKIE']['url'])      : ''),
        'commentform_remember'       => isset($data['remember'])  ? 'checked="checked"'                   : (isset($serendipity['COOKIE']['remember']) ? 'checked="checked"' : ''),
        'commentform_replyTo'        => serendipity_generateCommentList($id, $comments, ((isset($data['replyTo']) && ($data['replyTo'])) ? $data['replyTo'] : 0)),
        'commentform_subscribe'      => isset($data['subscribe']) ? 'checked="checked"' : '',
        'commentform_data'           => isset($data['comment'])   ? htmlspecialchars($data['comment']) : '',
        'is_commentform_showToolbar' => $showToolbar,
        'is_allowSubscriptions'      => $serendipity['allowSubscriptions'],
        'is_moderate_comments'       => $moderate_comments,
        'commentform_entry'          => $entry
    );

    $serendipity['smarty']->assign($commentform_data);

    serendipity_smarty_fetch('COMMENTFORM', 'commentform.tpl');
}

/**
 * Fetch an array of comments to a specific entry id
 *
 * @access public
 * @param   int     The Entry ID to fetch comments for
 * @param   int     How many comments to fetch (empty: all)
 * @param   string  How shall comments be ordered (ASC|DESC)
 * @param   boolean Shall non-approved comments be displayed?
 * @param   string  Comment type to fetch
 * @return  array   The SQL result of comments
 */
function serendipity_fetchComments($id, $limit = null, $order = '', $showAll = false, $type = 'NORMAL', $where = '') {
    global $serendipity;
    $and = '';

    if (!empty($limit)) {
        $limit = serendipity_db_limit_sql($limit);
    } else {
        $limit = '';
    }

    if ($type == 'comments' || empty($type)) {
        $type = 'NORMAL';
    } elseif ($type == 'trackbacks') {
        $type = 'TRACKBACK';
    } elseif ($type == 'comments_and_trackbacks') {
        $type = '%';
    }

    if (!empty($id)) {
        $and .= " AND co.entry_id = '" . (int)$id ."'";
    }

    if (!$showAll) {
        $and .= ' AND co.status = \'approved\'';
    }

    $and .= $where;

    if ($serendipity['dbType'] == 'postgres') {
        $group    = '';
        $distinct = 'DISTINCT';
    } else {
        $group    = 'GROUP BY co.id';
        $distinct = '';
    }

    $query = "SELECT $distinct
                    co.id,
                    co.entry_id, co.timestamp, co.title AS ctitle, co.email, co.url, co.ip, co.body, co.type, co.subscribed,
                    co.author,
                    e.title,
                    e.timestamp AS entrytimestamp,
                    e.id AS entryid,
                    e.authorid,
                    co.id AS commentid,
                    co.parent_id AS parent_id
              FROM
                    {$serendipity['dbPrefix']}comments co
                    LEFT JOIN {$serendipity['dbPrefix']}entries e ON (co.entry_id = e.id)
              WHERE co.type LIKE '" . $type . "' AND co.entry_id > 0 $and
              $group
              ORDER BY
                    " . ($where != '' ? '' : 'co.id') . " " . ($order != '' ? $order : '') . "
                    $limit";
    $comments = serendipity_db_query($query, false, 'assoc');

    if (!is_array($comments)) {
        return array();
    }

    serendipity_plugin_api::hook_event('fetchcomments', $comments);

    return $comments;
}

/**
 * Create a HTML SELECT dropdown field which represents all hierarchical comments
 *
 * @access public
 * @param   int     The entry ID to show comments for
 * @param   array   The existing comments for this entry
 * @param   int     The ID of the comment that is being referred to (last selection)
 * @param   int     The parent ID of the last comment [for recursive usage]
 * @param   int     The current nesting/hierarchy level [for recursive usage]
 * @param   string  The HTML indention string that gets prepended to a comment [for recursive usage]
 * @return  string  The HTML SELECT code
 */
function serendipity_generateCommentList($id, $comments = NULL, $selected = 0, $parent = 0, $level = 0, $indent = '') {
    global $serendipity;

    if (!is_array($comments)) {
        if (empty($id)) {
            $comments = array();
        } else {
            $comments = serendipity_fetchComments($id);
        }
    }

    $retval = $parent ? '' : '<select id="serendipity_replyTo" onchange="' . (!empty($serendipity['plugindata']['onchange']) ? $serendipity['plugindata']['onchange'] : '') . '" name="serendipity[replyTo]"><option value="0">[ ' . TOP_LEVEL . ' ]</option>';

    $i = 0;
    foreach ($comments as $comment) {
        if ($comment['parent_id'] == $parent) {
            $i++;
            $retval .= '<option value="' . $comment['id'] . '"'. ($selected == $comment['id'] || (isset($serendipity['POST']['replyTo']) && $comment['id'] == $serendipity['POST']['replyTo']) ? ' selected="selected"' : '') .'>' . str_repeat('&#160;', $level * 2) . '#' . $indent . $i . ': ' . (empty($comment['author']) ? ANONYMOUS : htmlspecialchars($comment['author'])) . ' ' . ON . ' ' . serendipity_mb('ucfirst', serendipity_strftime(DATE_FORMAT_SHORT, $comment['timestamp'])) . "</option>\n";
            $retval .= serendipity_generateCommentList($id, $comments, $selected, $comment['id'], $level + 1, $indent . $i . '.');
        }
    }
    $retval .= $parent ? '' : '</select>';

    return $retval;
}

/**
 * Print a list of comments to an entry
 *
 * @access public
 * @param   array       The list of comments to display
 * @param   int         The parentID of a comment to show. Can contain the constant for VIEWMODE_THREADED/LINEAR. [recursive usage]
 * @param   int         The current nesting depth of a comment [recursive usage]
 * @param   string      A string repesenting the actual comment (1.1.2.1)
 * @return  string      The HTML construct of all comments
 */
function serendipity_printComments($comments, $parentid = 0, $depth = 0, $trace = null, $smarty_block = 'COMMENTS', $smarty_file = 'comments.tpl') {
    global $serendipity;
    static $_smartyComments;

    /* - $_smartyComments holds the ending smarty array.
       - $depth is the current depth of the recurrence.
       - $i is the position in the current depth. */

    if ($parentid === VIEWMODE_THREADED) {
        $parentid = 0;
    }

    /* Wait a second, we just got attacked by a call with level 0,
       this must mean we've started over */
    if ( $depth == 0 ) {
        $_smartyComments = array();
    }

    $i = 0;
    foreach ($comments as $comment) {
        if ($parentid === VIEWMODE_LINEAR || !isset($comment['parent_id']) || $comment['parent_id'] == $parentid) {
            $i++;

            $comment['comment'] = htmlspecialchars(strip_tags($comment['body']));
            $comment['url']     = strip_tags($comment['url']);
            $comment['link_delete'] = $serendipity['baseURL'] . 'comment.php?serendipity[delete]=' . $comment['id'] . '&amp;serendipity[entry]=' . $comment['entry_id'] . '&amp;serendipity[type]=comments';

            /* Fix fucked links */
            if (!empty($comment['url']) && substr($comment['url'], 0, 7) != 'http://' && substr($comment['url'], 0, 8) != 'https://') {
                $comment['url'] = 'http://' . $comment['url'];
            }

            if (!empty($comment['url'])) {
                if (!@parse_url($comment['url'])) {
                    $comment['url'] = '';
                }
                $comment['url'] = htmlspecialchars($comment['url'], ENT_QUOTES);
            }

            serendipity_plugin_api::hook_event('frontend_display', $comment);

            if (isset($comment['no_email']) && $comment['no_email']) {
                $comment['email'] = false;
            } elseif (!empty($comment['email'])) {
                $comment['clear_email'] = $comment['email'];
                $comment['email']       = htmlspecialchars(str_replace('@', '[at]', $comment['email']));
            }

            $comment['body']    = $comment['comment'];
            $comment['pos']     = $i;
            $comment['trace']   = $trace . $i;
            $comment['depth']   = $depth;
            $comment['author']  = htmlspecialchars($comment['author']);

            $_smartyComments[] = $comment;
            if ($comment['id'] && $parentid !== VIEWMODE_LINEAR ) {
                serendipity_printComments($comments, $comment['id'], ($depth+1), ($trace . $i . '.'), $smarty_block, $smarty_file);
            }
        }
    }

    /* We are inside a recusive child, and we need to break out */
    if ($depth !== 0) {
        return true;
    }

    $serendipity['smarty']->assign_by_ref('comments', $_smartyComments);
    unset($_smartyComments);

    return serendipity_smarty_fetch($smarty_block, $smarty_file);
}

/**
 * Fetches and prints a listing of comments by author
 */
function serendipity_printCommentsByAuthor() {
    global $serendipity;

    $type      = $serendipity['GET']['commentMode'];

    if ($type == 'comments' || empty($type)) {
        $type = 'NORMAL';
    } elseif ($type == 'trackbacks') {
        $type = 'TRACKBACK';
    } elseif ($type == 'comments_and_trackbacks') {
        $type = '%';
    }

    $sql_where = " AND co.author = '" . serendipity_db_escape_string($serendipity['GET']['viewCommentAuthor']) . "'";

    if (!empty($serendipity['GET']['commentStartTime'])) {
        $sql_where .= " AND co.timestamp >= " . (int)$serendipity['GET']['commentStartTime'];
    }

    if (!empty($serendipity['GET']['commentEndTime'])) {
        $sql_where .= " AND co.timestamp <= " . (int)$serendipity['GET']['commentEndTime'];
    }

    if (empty($serendipity['GET']['page'])) {
        $serendipity['GET']['page'] = 1;
    }
    $sql_limit = $serendipity['fetchLimit'] * ($serendipity['GET']['page']-1) . ',' . $serendipity['fetchLimit'];
    $c = serendipity_fetchComments(null, $sql_limit, 'co.entry_id DESC, co.id ASC', false, $type, $sql_where);

    $entry_comments = array();
    foreach($c as $i => $comment) {
        if (!isset($entry_comments[$comment['entry_id']])) {
            $comment['link'] = serendipity_archiveURL($comment['entry_id'], $comment['title'], 'serendipityHTTPPath', true, array('timestamp' => $comment['entrytimestamp']));
            $entry_comments[$comment['entry_id']] = $comment;
        }
        $entry_comments[$comment['entry_id']]['comments'][] = $comment;
    }

    foreach($entry_comments AS $entry_id => $_data) {
        $entry_comments[$entry_id]['tpl_comments'] =& serendipity_printComments($_data['comments'], VIEWMODE_LINEAR, 0, null, 'COMMENTS', 'comments.tpl');
    }

    $serendipity['smarty']->assign_by_ref('comments_by_authors', $entry_comments);

    if (!empty($id)) {
        $and .= " AND co.entry_id = '" . (int)$id ."'";
    }

    if (!$showAll) {
        $and .= ' AND co.status = \'approved\'';
    }

    $cc = serendipity_db_query("SELECT count(co.id) AS counter
                                  FROM {$serendipity['dbPrefix']}comments AS co
                                 WHERE co.entry_id > 0
                                   AND co.type LIKE '" . $type . "'
                                   AND co.status = 'approved' " . $sql_where . "
                              GROUP BY co.author", true, 'assoc');
    if (!isset($cc['counter'])) {
        $totalComments = 0;
    } else {
        $totalComments = $cc['counter'];
    }
    serendipity_printEntryFooter('', $totalComments);

    serendipity_smarty_fetch('ENTRIES', 'comments_by_author.tpl');

    return true;
}

/**
 * Delete a specific comment
 *
 * @access public
 * @param   int     The ID of the comment to delete
 * @param   int     The ID of the entry the comment belongs to [safety]
 * @param   string  The type of a comment (comments/trackback)
 * @return  boolean Return whether the action was successful)
 */
function serendipity_deleteComment($id, $entry_id, $type='comments') {
    global $serendipity;

    $id       = (int)$id;
    $entry_id = (int)$entry_id;
    if ($id < 1 OR $entry_id < 1) {
        return false;
    }

    if ($_SESSION['serendipityAuthedUser'] === true) {
        $admin = '';
        if (!serendipity_checkPermission('adminEntriesMaintainOthers')) {
            $admin = " AND authorid = " . (int)$_SESSION['serendipityAuthorid'] ."'";
        }

        /* We have to figure out if the comment we are about to delete, is awaiting approval,
           if so - we should *not* subtract it from the entries table */
        $sql = serendipity_db_query("SELECT type, status, parent_id, body FROM {$serendipity['dbPrefix']}comments
                                            WHERE entry_id = ". $entry_id ."
                                                    AND id = ". $id, true);


        /* Check to see if the comment has children
         * if it does, don't delete, but replace with "*(COMMENT DELETED)*"
            to delete a tree, delete children first */
        $has_parent = serendipity_db_query("SELECT count(id) AS count
                                              FROM {$serendipity['dbPrefix']}comments
                                             WHERE parent_id = ". $id . "
                                             LIMIT 1", true);

        if (is_array($has_parent) && isset($has_parent['count']) && $has_parent['count'] > 0 && $sql['body'] != 'COMMENT_DELETED') {
            // Comment has childs, so don't delete it.
            serendipity_db_query("UPDATE {$serendipity['dbPrefix']}comments
                                     SET body = 'COMMENT_DELETED'
                                   WHERE id = " . $id);
        } else {
            // Comment has no childs or had already been deleted., it can be safely removed.
            serendipity_db_query("DELETE FROM {$serendipity['dbPrefix']}comments
                                        WHERE entry_id = ". $entry_id ."
                                                AND id = ". $id);

            if (is_array($sql) && $sql['status'] !== 'pending') {
                if (!empty($sql['type']) && $sql['type'] != 'NORMAL') {
                    $type = 'trackbacks';
                } else {
                    $type = 'comments';
                }
                serendipity_db_query("UPDATE {$serendipity['dbPrefix']}entries SET $type = $type-1 WHERE id = ". $entry_id ." AND $type > 0 $admin");
            }

            serendipity_db_query("UPDATE {$serendipity['dbPrefix']}comments SET parent_id = " . (int)$sql['parent_id'] . " WHERE parent_id = " . $id);
        }
        return true;
    } else {
        return false;
    }
}

/**
 * Toggle whether an entry allows comments
 *
 * @access public
 * @param   int     The ID of the entry where the switch shall be toggled
 * @param   string  Whether the entry shall be opened or closed for comments
 * @return null
 */
function serendipity_allowCommentsToggle($entry_id, $switch = 'disable') {
    global $serendipity;

    if ($_SESSION['serendipityAuthedUser'] === true) {
        $admin = '';
        if (!serendipity_checkPermission('adminEntriesMaintainOthers')) {
            $admin = " AND authorid = '" . (int)$_SESSION['serendipityAuthorid'] ."'";
        }

        $query = "UPDATE {$serendipity['dbPrefix']}entries SET allow_comments = '" . ($switch == 'disable' ? 'false' : 'true') . "' WHERE id = '". (int)$entry_id ."' $admin";
        serendipity_db_query($query);
        if (serendipity_isResponseClean($_SERVER['HTTP_REFERER'])) {
            header('Location: '. $_SERVER['HTTP_REFERER']);
        }
    } else {
        die('What are you up to? You need to be an admin to close comments');
    }
}

/**
 * Approve a comment
 *
 * LONG
 *
 * @access public
 * @param   int         The ID of the comment to approve
 * @param   int         The ID of the entry a comment belongs to
 * @param   boolean     Whether to force approving a comment despite of its current status
 * @return boolean      Success or failure
 */
function serendipity_approveComment($cid, $entry_id, $force = false) {
    global $serendipity;

    /* Get data about the comment, we need this query because this function can be called from anywhere */
    /* This also makes sure we are either the author of the comment, or a USERLEVEL_ADMIN */
    $sql = "SELECT c.*, e.title, a.email as authoremail, a.mail_comments, e.timestamp AS entry_timestamp, e.last_modified AS entry_last_modified
                FROM {$serendipity['dbPrefix']}comments c
                LEFT JOIN {$serendipity['dbPrefix']}entries e ON (e.id = c.entry_id)
                LEFT JOIN {$serendipity['dbPrefix']}authors a ON (e.authorid = a.authorid)
                WHERE c.id = '". (int)$cid ."'
                    ". ((!serendipity_checkPermission('adminEntriesMaintainOthers') && $force !== true) ? "AND e.authorid = '". (int)$serendipity['authorid'] ."'" : '') ."
                    ". (($force === true) ? "" : "AND status = 'pending'");
    $rs  = serendipity_db_query($sql, true);

    /* It's already approved, don't spam people */
    if ( $rs === false ) {
        return false;
    }

    $sql = "UPDATE {$serendipity['dbPrefix']}comments SET status = 'approved' WHERE id = ". (int)$cid;
    serendipity_db_query($sql);

    $field = ($rs['type'] == 'NORMAL' ? 'comments' : 'trackbacks');
    // Check when the entry was published. If it is older than max_last_modified allows, the last_modified date of that entry
    // will not be pushed. With this we make sure that an RSS feed will not be updated on a client's reader and marked as new
    // only because someone made an comment to an old entry.
    if ($rs['entry_timestamp'] > time() - $serendipity['max_last_modified']) {
        $lm = time();
    } else {
        $lm = (int)$rs['entry_last_modified'];
    }

    $query = "UPDATE {$serendipity['dbPrefix']}entries SET $field=$field+1, last_modified=". $lm ." WHERE id='". (int)$entry_id ."'";
    serendipity_db_query($query);

    if ($serendipity['allowSubscriptions']) {
        serendipity_mailSubscribers($entry_id, $rs['author'], $rs['email'], $rs['title'], $rs['authoremail'], $cid);
    }
    return true;
}

/**
 * Save a comment made by a visitor
 *
 * @access public
 * @param   int     The ID of an entry
 * @param   array   An array that holds the input data from the visitor
 * @param   string  The type of a comment (normal/trackback)
 * @param   string  Where did a comment come from? (internal|trackback|plugin)
 * @return  boolean Returns true if the comment could be added
 */
function serendipity_saveComment($id, $commentInfo, $type = 'NORMAL', $source = 'internal') {
    global $serendipity;

    $query = "SELECT id, allow_comments, moderate_comments, last_modified, timestamp, title FROM {$serendipity['dbPrefix']}entries WHERE id = '". (int)$id ."'";
    $ca    = serendipity_db_query($query, true);

    $commentInfo['type'] = $type;
    $commentInfo['source'] = $source;
    serendipity_plugin_api::hook_event('frontend_saveComment', $ca, $commentInfo);
    if (!is_array($ca) || serendipity_db_bool($ca['allow_comments'])) {
        $title         = serendipity_db_escape_string(isset($commentInfo['title']) ? $commentInfo['title'] : '');
        $comments      = $commentInfo['comment'];
        $ip            = serendipity_db_escape_string(isset($commentInfo['ip']) ? $commentInfo['ip'] : $_SERVER['REMOTE_ADDR']);
        $commentsFixed = serendipity_db_escape_string($commentInfo['comment']);
        $name          = serendipity_db_escape_string($commentInfo['name']);
        $url           = serendipity_db_escape_string($commentInfo['url']);
        $email         = serendipity_db_escape_string($commentInfo['email']);
        $parentid      = (isset($commentInfo['parent_id']) && is_numeric($commentInfo['parent_id'])) ? $commentInfo['parent_id'] : 0;
        $status        = serendipity_db_escape_string(isset($commentInfo['status']) ? $commentInfo['status'] : (serendipity_db_bool($ca['moderate_comments']) ? 'pending' : 'approved'));
        $t             = serendipity_db_escape_string(isset($commentInfo['time']) ? $commentInfo['time'] : time());
        $referer       = (isset($_SESSION['HTTP_REFERER']) ? serendipity_db_escape_string($_SESSION['HTTP_REFERER']) : '');

        $query = "SELECT a.email, e.title, a.mail_comments, a.mail_trackbacks
                 FROM {$serendipity['dbPrefix']}entries e, {$serendipity['dbPrefix']}authors a
                 WHERE e.id  = '". (int)$id ."'
                 AND e.authorid = a.authorid";
        $row = serendipity_db_query($query, true); // Get info on author/entry
        if (!is_array($row) || empty($id)) {
            // No associated entry found.
            return false;
        }

        if (isset($commentInfo['subscribe'])) {
            $subscribe = 'true';
        } else {
            $subscribe = 'false';
        }

        $query  = "INSERT INTO {$serendipity['dbPrefix']}comments (entry_id, parent_id, ip, author, email, url, body, type, timestamp, title, subscribed, status, referer)";
        $query .= " VALUES ('". (int)$id ."', '$parentid', '$ip', '$name', '$email', '$url', '$commentsFixed', '$type', '$t', '$title', '$subscribe', '$status', '$referer')";

        serendipity_db_query($query);
        $cid = serendipity_db_insert_id('comments', 'id');

        // Send mail to the author if he chose to receive these mails, or if the comment is awaiting moderation
        if (serendipity_db_bool($ca['moderate_comments'])
            || ($type == 'NORMAL' && serendipity_db_bool($row['mail_comments']))
            || ($type == 'TRACKBACK' && serendipity_db_bool($row['mail_trackbacks']))) {
            serendipity_sendComment($cid, $row['email'], $name, $email, $url, $id, $row['title'], $comments, $type, serendipity_db_bool($ca['moderate_comments']));
        }

        // Approve with force, if moderation is disabled
        if (empty($ca['moderate_comments']) || serendipity_db_bool($ca['moderate_comments']) == false) {
            serendipity_approveComment($cid, $id, true);
        }
        serendipity_purgeEntry($id, $t);
        return true;
    } else {
        return false;
    }
}

/**
 * Send a mail to all subscribers of an entry about a new comment
 *
 * @access public
 * @param   int     The ID of the entry where a new comment has been made
 * @param   string  The name of the latest poster to an entry
 * @param   string  The email addre ssof the latest poster to an entry
 * @param   string  The title of the entry
 * @param   string  The mail address used to send emails from
 * @param   int     The ID of the comment that has been made
 * @return null
 */
function serendipity_mailSubscribers($entry_id, $poster, $posterMail, $title, $fromEmail = 'none@example.com', $cid = null) {
    global $serendipity;

    $entryURI = serendipity_archiveURL($entry_id, $title, 'baseURL') . ($cid > 0 ? '#c' . $cid : '');
    $subject =  sprintf(NEW_COMMENT_TO_SUBSCRIBED_ENTRY, $title);

    $pgsql_insert = '';
    $mysql_insert = '';
    if ($serendipity['dbType'] == 'postgres') {
        $pgsql_insert = 'DISTINCT ON (email)';
    } else {
        $mysql_insert = 'GROUP BY email';
    }

    $sql = "SELECT $pgsql_insert author, email, type
            FROM {$serendipity['dbPrefix']}comments
            WHERE entry_id = '". (int)$entry_id ."'
              AND email <> '" . serendipity_db_escape_string($posterMail) . "'
              AND email <> ''
              AND subscribed = 'true' $mysql_insert";
    $subscribers = serendipity_db_query($sql);

    if (!is_array($subscribers)) {
        return;
    }

    foreach ($subscribers as $subscriber) {
        if ($subscriber['type'] == 'TRACKBACK') {
            $text = sprintf(
                      SUBSCRIPTION_TRACKBACK_MAIL,

                      $subscriber['author'],
                      $serendipity['blogTitle'],
                      $title,
                      $poster,
                      $entryURI,
                      serendipity_rewriteURL('unsubscribe/' . urlencode($subscriber['email']) . '/' . (int)$entry_id, 'baseURL')
            );
        } else {
            $text = sprintf(
                      SUBSCRIPTION_MAIL,

                      $subscriber['author'],
                      $serendipity['blogTitle'],
                      $title,
                      $poster,
                      $entryURI,
                      serendipity_rewriteURL('unsubscribe/' . urlencode($subscriber['email']) . '/' . (int)$entry_id, 'baseURL')
            );
        }

        serendipity_sendMail($subscriber['email'], $subject, $text, $fromEmail);
    }
}

/**
 * Cancel a subscription to an entry
 *
 * @access public
 * @param   string      E-Mail address to cancel subscription
 * @param   int         The entry ID to unsubscribe from
 * @return  int         Return number of unsubscriptions
 */
function serendipity_cancelSubscription($email, $entry_id) {
    global $serendipity;
    $sql = "UPDATE {$serendipity['dbPrefix']}comments
                SET subscribed = 'false'
            WHERE entry_id = '". (int)$entry_id ."'
                AND email = '" . serendipity_db_escape_string($email) . "'";
    serendipity_db_query($sql);

    return serendipity_db_affected_rows();
}

/**
 * Send a comment notice to the admin/author of an entry
 *
 * @access public
 * @param  int      ID of the comment that has been made
 * @param  string   Author's email address to send the mail to
 * @param  string   The name of the sender
 * @param  string   The URL of the sender
 * @param  int      The ID of the entry that has been commented
 * @param  string   The title of the entry that has been commented
 * @param  string   The text of the comment
 * @param  string   The type of the comment (normal|trackback)
 * @param  boolean  Toggle Whether comments to this entry need approval
 * @return boolean  Return success of sending the mails
 */
function serendipity_sendComment($comment_id, $to, $fromName, $fromEmail, $fromUrl, $id, $title, $comment, $type = 'NORMAL', $moderate_comment = false) {
    global $serendipity;

    if (empty($fromName)) {
        $fromName = ANONYMOUS;
    }

    $entryURI   = serendipity_archiveURL($id, $title, 'baseURL');
    $path       = ($type == 'TRACKBACK') ? 'trackback' : 'comment';
    $deleteURI  = serendipity_rewriteURL(PATH_DELETE . '/'. $path .'/' . $comment_id . '/' . $id . '-' . serendipity_makeFilename($title)  . '.html', 'baseURL');
    $approveURI = serendipity_rewriteURL(PATH_APPROVE . '/'. $path .'/' . $comment_id . '/' . $id . '-' . serendipity_makeFilename($title)  . '.html', 'baseURL');

    if ($type == 'TRACKBACK') {

        /******************* TRACKBACKS *******************/
        $subject =  ($moderate_comment ? '[' . REQUIRES_REVIEW . '] ' : '') . NEW_TRACKBACK_TO . ' ' . $title;
        $text = sprintf(A_NEW_TRACKBACK_BLAHBLAH, $title)
              . "\n"
              . "\n" . REQUIRES_REVIEW          . ': ' . (($moderate_comment) ? YES : NO) . (isset($serendipity['moderate_reason']) ? ' (' . $serendipity['moderate_reason'] . ')' : '')
              . "\n" . LINK_TO_ENTRY            . ': ' . $entryURI
              . "\n" . 'Weblog ' . NAME         . ': ' . stripslashes($fromName)
              . "\n" . LINK_TO_REMOTE_ENTRY     . ': ' . $fromUrl
              . "\n"
              . "\n" . EXCERPT . ':'
              . "\n" . strip_tags($comment)
              . "\n"
              . "\n" . '----'
              . "\n" . YOU_HAVE_THESE_OPTIONS
              . (($moderate_comment) ? "\n" . str_repeat(' ', 2) . THIS_TRACKBACK_NEEDS_REVIEW : '')
              . "\n" . str_repeat(' ', 3) . str_pad(VIEW_ENTRY,  15) . ' -- '. $entryURI
              . "\n" . str_repeat(' ', 3) . str_pad(DELETE_TRACKBACK,  15) . ' -- '. $deleteURI
              . (($moderate_comment) ? "\n" . str_repeat(' ', 3) . str_pad(APPROVE_TRACKBACK, 15) . ' -- '. $approveURI : '');

    } else {

        /******************* COMMENTS *********************/
        $subject = ($moderate_comment ? '[' . REQUIRES_REVIEW . '] ' : '') . NEW_COMMENT_TO . ' ' . $title;
        $text = sprintf(A_NEW_COMMENT_BLAHBLAH, $serendipity['blogTitle'], $title)
              . "\n" . LINK_TO_ENTRY . ': ' . $entryURI
              . "\n"
              . "\n" . REQUIRES_REVIEW         . ': ' . (($moderate_comment) ? YES : NO) . (isset($serendipity['moderate_reason']) ? ' (' . $serendipity['moderate_reason'] . ')' : '')
              . "\n" . USER . ' ' . IP_ADDRESS . ': ' . $_SERVER['REMOTE_ADDR']
              . "\n" . USER . ' ' . NAME       . ': ' . $fromName
              . "\n" . USER . ' ' . EMAIL      . ': ' . $fromEmail
              . "\n" . USER . ' ' . HOMEPAGE   . ': ' . $fromUrl
              . "\n"
              . "\n" . COMMENTS                . ': '
              . "\n" . strip_tags($comment)
              . "\n"
              . "\n" . '----'
              . "\n" . YOU_HAVE_THESE_OPTIONS
              . (($moderate_comment) ? "\n" . str_repeat(' ', 2) . THIS_COMMENT_NEEDS_REVIEW : '')
              . "\n" . str_repeat(' ', 3) . str_pad(VIEW_COMMENT,  15) . ' -- '. $entryURI .'#c'. $comment_id
              . "\n" . str_repeat(' ', 3) . str_pad(DELETE_COMMENT,  15) . ' -- '. $deleteURI
              . (($moderate_comment) ? "\n" . str_repeat(' ', 3) . str_pad(APPROVE_COMMENT, 15) . ' -- '. $approveURI : '');
    }

    return serendipity_sendMail($to, $subject, $text, $fromEmail, null, $fromName);
}
