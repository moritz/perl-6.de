<?php /* Smarty version 2.6.14, created on 2007-03-29 18:41:52
         compiled from file:/var/www//blog/templates/default/sidebar.tpl */ ?>
<?php if ($this->_tpl_vars['is_raw_mode']): ?>
<div id="serendipity<?php echo $this->_tpl_vars['pluginside']; ?>
SideBar">
<?php endif;  $_from = $this->_tpl_vars['plugindata']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
    <div class="serendipitySideBarItem container_<?php echo $this->_tpl_vars['item']['class']; ?>
">
        <?php if ($this->_tpl_vars['item']['title'] != ""): ?><h3 class="serendipitySideBarTitle <?php echo $this->_tpl_vars['item']['class']; ?>
"><?php echo $this->_tpl_vars['item']['title']; ?>
</h3><?php endif; ?>
        <div class="serendipitySideBarContent"><?php echo $this->_tpl_vars['item']['content']; ?>
</div>
    </div>
<?php endforeach; endif; unset($_from);  if ($this->_tpl_vars['is_raw_mode']): ?>
</div>
<?php endif; ?>