{if $is_embedded != true}
{if $is_xhtml}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
           "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
{else}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
           "http://www.w3.org/TR/html4/loose.dtd">
{/if}

<html>
<head>
    <title>{$head_title|@default:$blogTitle} {if $head_subtitle} - {$head_subtitle}{/if}</title>
    <meta http-equiv="Content-Type" content="text/html; charset={$head_charset}" />
    <meta name="Powered-By" content="Serendipity v.{$head_version}" />
    <link rel="stylesheet" type="text/css" href="{$head_link_stylesheet}" />
    <link rel="alternate"  type="application/rss+xml" title="{$blogTitle} RSS feed" href="{$serendipityBaseURL}{$serendipityRewritePrefix}feeds/index.rss2" />
    <link rel="alternate"  type="application/x.atom+xml"  title="{$blogTitle} Atom feed"  href="{$serendipityBaseURL}{$serendipityRewritePrefix}feeds/atom.xml" />
{if $entry_id}
    <link rel="pingback" href="{$serendipityBaseURL}comment.php?type=pingback&amp;entry_id={$entry_id}" />
{/if}

{serendipity_hookPlugin hook="frontend_header"}
</head>

<body>
{else}
{serendipity_hookPlugin hook="frontend_header"}
{/if}

{if $is_raw_mode != true}
<div id="container">
<div id="sitename">
    <h1><a class="homelink1" href="{$serendipityBaseURL}">{$head_title|@default:$blogTitle}</a></h1>
    <h2><a class="homelink2" href="{$serendipityBaseURL}">{$head_subtitle|@default:$blogDescription}</a></h2>
</div> <!--sitename-->

{my_inc_header} <!-- opens a div id="wrap"-->
        <div id="leftside">{serendipity_printSidebar side="left"}</div>

        <div id="rightside">{serendipity_printSidebar side="right"}</div>
        <div id="content">{$CONTENT}</div>
{/if}

{$raw_data}
<!--{serendipity_hookPlugin hook="frontend_footer"}-->
</div> <!--wrap-->
<div class="clearingdiv">&nbsp;</div>
</div> <!--container-->

<div id="footer">&copy; 2007 <a href="http://moritz.faui2k3.org/de/">Moritz
Lenz</a> | <a href="/impressum">Impressum</a> | Design by <a href="http://andreasviklund.com">Andreas Viklund</a></div

{if $is_embedded != true}
</body>
</html>
{/if}
