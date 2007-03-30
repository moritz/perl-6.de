<?php # $Id: lang_bg.inc.php 1419 2006-08-29 10:25:22Z jwalker $

/**
 *  @version $Revision: 1419 $
 *  @author Ivan Cenov jwalker@hotmail.bg
 */


    @define('PLUGIN_EVENT_ENTRYPROPERTIES_TITLE', 'Допълнителни свойства за постингите');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_DESC', '(Кеширане, не публични постинги, sticky постинги)');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_STICKYPOSTS', 'Маркиране на този постинг като sticky');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_ACCESS', 'Постингите могат да се четат от');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_ACCESS_PRIVATE', 'Мене');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_ACCESS_MEMBERS', 'Съ-авторите');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_ACCESS_PUBLIC', 'Всички');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHE', 'Кеширане на постингите ?');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHE_DESC', 'Ако е позволено, кеширана версия на постинга ще бъде генерирана при неговия запис. Кеширането ще увеличи производителността, но ще намали гъвкавостта на другите плъгини.');
    @define('PLUGIN_EVENT_ENTRYPROPERTY_BUILDCACHE', 'Кеширане на всички постинги');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHE_FETCHNEXT', 'Кеширане на следващата серия постинги ...');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHE_FETCHNO', 'Кеширане на постинги от %d до %d');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHE_BUILDING', 'Кеширане на постинг #%d, <em>%s</em>...');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHED', 'Постингът е кеширан.');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHE_DONE', 'Кеширането завърши.');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHE_ABORTED', 'Кеширането е прекратено.');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_CACHE_TOTAL', ' (общо %d постинга)...');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_NO_FRONTPAGE', 'Постингът да не се вижда на главната страница и в списъците');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_GROUPS', 'Използване на групово-базираните рестрикции');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_GROUPS_DESC', 'Когато е активирано, Вие можете да дефинирате кои потребителски групи да имат възможност за четене на постингите. Тази опция има голямо влияние върху производителността на блога. Позволете я, само ако наистина ще я използвате.');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_USERS', 'Използване на потребител-базирани рестрикции');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_USERS_DESC', 'Когато е активирано, Вие можете да дефинирате кои специфични потребители да имат възможност за четене на постингите. Тази опция има голямо влияние върху производителността на блога. Позволете я, само ако наистина ще я използвате.');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_HIDERSS', 'Изключване от RSS емисии');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_HIDERSS_DESC', 'При избор \'Да\' съдържанието на тази статия няма да бъде включено в RSS емисии.');

    @define('PLUGIN_EVENT_ENTRYPROPERTIES_CUSTOMFIELDS', 'Допълнителни полета');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_CUSTOMFIELDS_DESC1', 'Допълнителните полета могат да се поставят в шаблона на вашата тема на места, където искате те да се показват. За това редактирайте вашия файл entries.tpl и поставете Smarty тагове подобно на следващите примери: {$entry.properties.ep_MyCustomField} на желаните места. Не трябва да изпускате префикса \'ep_\' преди името на полетата. ');
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_CUSTOMFIELDS_DESC2', 'Тук можете да въведете списък от имена на полета, разделени със запетаи, които да използвате за извеждане на HTML за всяка статия. В имената са разрешени само латински букви и цифри (не и специални символи). Например: \'Customfield1\', \'Customfield2\'. ' . PLUGIN_EVENT_ENTRYPROPERTIES_CUSTOMFIELDS_DESC1);
    @define('PLUGIN_EVENT_ENTRYPROPERTIES_CUSTOMFIELDS_DESC3', 'Списъкът на достъпните допълнителни полета може да бъде редактиран в <a href="%s" target="_blank" title="' . PLUGIN_EVENT_ENTRYPROPERTIES_TITLE . '">конфигурацията</a> на приставка serendipity_event_entryproperties.');

    @define('PLUGIN_EVENT_ENTRYPROPERTIES_DISABLE_MARKUP', 'Забранени текстови форматирания за тази статия:');
