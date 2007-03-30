<?php /* Smarty version 2.6.14, created on 2007-03-30 11:34:13
         compiled from file:/var/www//blog/templates/default/content.tpl */ ?>
<!-- CONTENT START -->

<?php if ($this->_tpl_vars['searchresult_tooShort']): ?>
    <h3 class="serendipity_date"><?php echo @QUICKSEARCH; ?>
</h3>
	<div class="serendipity_search serendipity_search_tooshort"><?php echo $this->_tpl_vars['content_message']; ?>
</div>
<?php elseif ($this->_tpl_vars['searchresult_error']): ?>
    <h3 class="serendipity_date"><?php echo @QUICKSEARCH; ?>
</h3>
	<div class="serendipity_search serendipity_search_error"><?php echo $this->_tpl_vars['content_message']; ?>
</div>
<?php elseif ($this->_tpl_vars['searchresult_noEntries']): ?>
    <h3 class="serendipity_date"><?php echo @QUICKSEARCH; ?>
</h3>
	<div class="serendipity_search serendipity_search_noentries"><?php echo $this->_tpl_vars['content_message']; ?>
</div>
<?php elseif ($this->_tpl_vars['searchresult_results']): ?>
    <h3 class="serendipity_date"><?php echo @QUICKSEARCH; ?>
</h3>
	<div class="serendipity_search serendipity_search_results"><?php echo $this->_tpl_vars['content_message']; ?>
</div>
<?php else: ?>
	<div class="serendipity_content_message"><?php echo $this->_tpl_vars['content_message']; ?>
</div>
<?php endif; ?>

<?php echo $this->_tpl_vars['ENTRIES']; ?>

<?php echo $this->_tpl_vars['ARCHIVES']; ?>


<!-- CONTENT END -->