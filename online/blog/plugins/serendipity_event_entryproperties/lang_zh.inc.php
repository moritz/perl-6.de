<?php
##########################################################################
# Copyright (c) 2003-2005, Jannis Hermanns (on behalf the Serendipity    #
# Developer Team) All rights reserved.  See LICENSE file for licensing   #
# details								 #
#                                                                        #
# (c) 2003 Jannis Hermanns <J@hacked.it>                                 #
# http://www.jannis.to/programming/serendipity.html                      #
#                                                                        #
# Translated by                                                          #
# (c) 2006 Aphonex Li <aphonex.li@gmail.com>                             #
#               http://www.exten.cn                                      #
##########################################################################

        @define('PLUGIN_EVENT_ENTRYPROPERTIES_TITLE', '���µĸ߼�����');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_DESC', '(��ȡ����, ����������, �ö�����)');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_STICKYPOSTS', '���Ϊ�ö�����');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_ACCESS', '˭�����Ķ�����');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_ACCESS_PRIVATE', '�Լ�');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_ACCESS_MEMBER', '������');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_ACCESS_PUBLIC', '�ÿ�');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHE', '�����ȡ����');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHE_DESC', '���������ÿ�α�������ʱ���Ὠ����ȡ���ϡ���ȡ���Ͽ������ٶȣ���������Щ��Ҳ����ݡ�');
        @define('PLUGIN_EVENT_ENTRYPROPERTY_BUILDCACHE', '������ȡ����');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHE_FETCHNEXT', 'ѡȡ��������...');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHE_FETCHNO', 'ѡȡ���� %d �� %d');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHE_BUILDING', '���������µĿ�ȡ���� #%d, <em>%s</em>...');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHED', 'ȡ�ÿ�ȡ����');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHE_DONE', '��ȡ���');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHE_ABORTED', '��ȡ����ȡ��');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHE_TOTAL', ' (�ܹ� %d ƪ����)...');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_NL2BR', '���� nl2br');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_NO_FRONTPAGE', '�������������� / ��ҳ��');
        @define('PLUGIN_EVENT_ENTRYPROPERTIES_GROUPS', 'ʹ��Ⱥ������');
		@define('PLUGIN_EVENT_ENTRYPROPERTIES_GROUPS_DESC', '���������������ѡ���Ǹ�Ⱥ��ĳ�Ա����������¡��������Ӱ��ϵͳ�ٶȣ����Ǳ�Ҫ��ò�Ҫʹ�á�');
		@define('PLUGIN_EVENT_ENTRYPROPERTIES_USERS', 'ʹ�û�Ա����');
		@define('PLUGIN_EVENT_ENTRYPROPERTIES_USERS_DESC', '���������������ѡ���Ǹ���Ա����������¡��������Ӱ��ϵͳ�ٶȣ����Ǳ�Ҫ��ò�Ҫʹ�á�');
		@define('PLUGIN_EVENT_ENTRYPROPERTIES_HIDERSS', 'RSS ����������');
		@define('PLUGIN_EVENT_ENTRYPROPERTIES_HIDERSS_DESC', '������������µ����ݲ�����ʾ�� RSS �ڡ�');

		@define('PLUGIN_EVENT_ENTRYPROPERTIES_CUSTOMFIELDS', '�Զ��˵�');
		define('PLUGIN_EVENT_ENTRYPROPERTIES_CUSTOMFIELDS_DESC1', '����������������ʾ����Ĳ˵���������༭ entries.tpl ������Ȼ�� Smarty ��ǩ {$entry.properties.ep_MyCustomField} ������Ҫ����ʾ�� HTML ���档 ע��˵���ǰ����� ep_');
		define('PLUGIN_EVENT_ENTRYPROPERTIES_CUSTOMFIELDS_DESC2', '�����������ÿ���Զ��ŷֿ��Ĳ˵����� - ��Ҫʹ��������š����磺"Customfield1, Customfield2". ' . PLUGIN_EVENT_ENTRYPROPERTIES_CUSTOMFIELDS_DESC1);
		@define('PLUGIN_EVENT_ENTRYPROPERTIES_CUSTOMFIELDS_DESC3', 'ÿ���Զ��˵�����������ı� <a href="%s" target="_blank" title="' . PLUGIN_EVENT_ENTRYPROPERTIES_TITLE . '">����趨</a>��');

?>
