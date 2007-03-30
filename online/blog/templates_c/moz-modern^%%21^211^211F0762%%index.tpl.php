<?php /* Smarty version 2.6.14, created on 2007-03-30 11:34:13
         compiled from /var/www//blog/templates/moz-modern/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', '/var/www//blog/templates/moz-modern/index.tpl', 12, false),array('function', 'serendipity_hookPlugin', '/var/www//blog/templates/moz-modern/index.tpl', 22, false),array('function', 'serendipity_printSidebar', '/var/www//blog/templates/moz-modern/index.tpl', 37, false),)), $this); ?>
<?php if ($this->_tpl_vars['is_embedded'] != true):  if ($this->_tpl_vars['is_xhtml']): ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
           "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php else: ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
           "http://www.w3.org/TR/html4/loose.dtd">
<?php endif; ?>

<html>
<head>
    <title><?php echo smarty_modifier_default(@$this->_tpl_vars['head_title'], @$this->_tpl_vars['blogTitle']); ?>
 <?php if ($this->_tpl_vars['head_subtitle']): ?> - <?php echo $this->_tpl_vars['head_subtitle'];  endif; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['head_charset']; ?>
" />
    <meta name="Powered-By" content="Serendipity v.<?php echo $this->_tpl_vars['head_version']; ?>
" />
    <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['head_link_stylesheet']; ?>
" />
    <link rel="alternate"  type="application/rss+xml" title="<?php echo $this->_tpl_vars['blogTitle']; ?>
 RSS feed" href="<?php echo $this->_tpl_vars['serendipityBaseURL'];  echo $this->_tpl_vars['serendipityRewritePrefix']; ?>
feeds/index.rss2" />
    <link rel="alternate"  type="application/x.atom+xml"  title="<?php echo $this->_tpl_vars['blogTitle']; ?>
 Atom feed"  href="<?php echo $this->_tpl_vars['serendipityBaseURL'];  echo $this->_tpl_vars['serendipityRewritePrefix']; ?>
feeds/atom.xml" />
<?php if ($this->_tpl_vars['entry_id']): ?>
    <link rel="pingback" href="<?php echo $this->_tpl_vars['serendipityBaseURL']; ?>
comment.php?type=pingback&amp;entry_id=<?php echo $this->_tpl_vars['entry_id']; ?>
" />
<?php endif; ?>

<?php echo serendipity_smarty_hookPlugin(array('hook' => 'frontend_header'), $this);?>

</head>

<body>
<?php else:  echo serendipity_smarty_hookPlugin(array('hook' => 'frontend_header'), $this);?>

<?php endif; ?>

<div id="serendipity_banner">
    <h1><a class="homelink1" href="<?php echo $this->_tpl_vars['serendipityBaseURL']; ?>
"><?php echo smarty_modifier_default(@$this->_tpl_vars['head_title'], @$this->_tpl_vars['blogTitle']); ?>
</a></h1>
    <h2><a class="homelink2" href="<?php echo $this->_tpl_vars['serendipityBaseURL']; ?>
"><?php echo smarty_modifier_default(@$this->_tpl_vars['head_subtitle'], @$this->_tpl_vars['blogDescription']); ?>
</a></h2>
</div>

<div id="mainpane">
<?php if ($this->_tpl_vars['leftSidebarElements'] > 0): ?>
    <div id="serendipityLeftSideBar"><?php echo serendipity_smarty_printSidebar(array('side' => 'left'), $this);?>
</div>
<?php endif; ?>

<?php if ($this->_tpl_vars['rightSidebarElements'] < 1): ?>
    <div id="content_left">
<?php elseif ($this->_tpl_vars['leftSidebarElements'] < 1): ?>
    <div id="content_right">
<?php else: ?>
    <div id="content">
<?php endif; ?>
		<?php echo $this->_tpl_vars['CONTENT']; ?>

		<?php echo $this->_tpl_vars['raw_data']; ?>

	</div>

<?php if ($this->_tpl_vars['rightSidebarElements'] > 0): ?>
    <div id="serendipityRightSideBar"><?php echo serendipity_smarty_printSidebar(array('side' => 'right'), $this);?>
</div>
<?php endif; ?>

    <div id="copyright">Powered by <a href="http://www.s9y.org/">serendipity</a>, Design by <a href="http://supergarv.de/">Garvin Hicking</a>. Smile, you're on the candid credit line!</div>
</div>
<?php echo serendipity_smarty_hookPlugin(array('hook' => 'frontend_footer'), $this);?>

<?php if ($this->_tpl_vars['is_embedded'] != true): ?>
</body>
</html>
<?php endif; ?>