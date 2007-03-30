<?php /* Smarty version 2.6.14, created on 2007-03-30 11:20:21
         compiled from /var/www//blog/templates/default/preview_iframe.tpl */ ?>
    <head>
        <title><?php echo @SERENDIPITY_ADMIN_SUITE; ?>
</title>
        <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['head_charset']; ?>
" />
        <meta name="Powered-By" content="Serendipity v.<?php echo $this->_tpl_vars['head_version']; ?>
" />
        <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['head_link_stylesheet']; ?>
" />
        <script type="text/javascript">
           window.onload = function() {
             parent.document.getElementById('serendipity_iframe').style.height = document.getElementById('mainpane').offsetHeight
                                                                               + parseInt(document.getElementById('mainpane').style.marginTop)
                                                                               + parseInt(document.getElementById('mainpane').style.marginBottom)
                                                                               + 'px';
             parent.document.getElementById('serendipity_iframe').scrolling    = 'no';
             parent.document.getElementById('serendipity_iframe').style.border = 0;
           }
        </script>
    </head>

    <body style="padding: 0px; margin: 0px;">
        <div id="mainpane" style="padding: 0px; margin: 5px auto 5px auto; width: 98%;">
            <div id="content" style="padding: 5px; margin: 0px;">
            <?php echo $this->_tpl_vars['preview']; ?>

            </div>
        </div>
    </body>