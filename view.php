<!DOCTYPE html>

<html  dir="ltr" lang="fr" xml:lang="fr">
<head>
    <title>Expérimentation (ROB): Code Python3 - Encoders + Regulation de vitesse en ticks/s</title>
    <link rel="shortcut icon" href="https://moodle.ensta-bretagne.fr/theme/image.php/classic/theme/1601274371/favicon" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="moodle, Expérimentation (ROB): Code Python3 - Encoders + Regulation de vitesse en ticks/s" />
<link rel="stylesheet" type="text/css" href="https://moodle.ensta-bretagne.fr/theme/yui_combo.php?rollup/3.17.2/yui-moodlesimple-min.css" /><script id="firstthemesheet" type="text/css">/** Required in order to fix style inclusion problems in IE with YUI **/</script><link rel="stylesheet" type="text/css" href="https://moodle.ensta-bretagne.fr/theme/styles.php/classic/1601274371_1/all" />
<script>
//<![CDATA[
var M = {}; M.yui = {};
M.pageloadstarttime = new Date();
M.cfg = {"wwwroot":"https:\/\/moodle.ensta-bretagne.fr","sesskey":"JsB6wBhkXh","sessiontimeout":"14400","themerev":"1601274371","slasharguments":1,"theme":"classic","iconsystemmodule":"core\/icon_system_fontawesome","jsrev":"1601274371","admin":"admin","svgicons":true,"usertimezone":"Europe\/Paris","contextid":74188,"langrev":1601614832,"templaterev":"1601274371"};var yui1ConfigFn = function(me) {if(/-skin|reset|fonts|grids|base/.test(me.name)){me.type='css';me.path=me.path.replace(/\.js/,'.css');me.path=me.path.replace(/\/yui2-skin/,'/assets/skins/sam/yui2-skin')}};
var yui2ConfigFn = function(me) {var parts=me.name.replace(/^moodle-/,'').split('-'),component=parts.shift(),module=parts[0],min='-min';if(/-(skin|core)$/.test(me.name)){parts.pop();me.type='css';min=''}
if(module){var filename=parts.join('-');me.path=component+'/'+module+'/'+filename+min+'.'+me.type}else{me.path=component+'/'+component+'.'+me.type}};
YUI_config = {"debug":false,"base":"https:\/\/moodle.ensta-bretagne.fr\/lib\/yuilib\/3.17.2\/","comboBase":"https:\/\/moodle.ensta-bretagne.fr\/theme\/yui_combo.php?","combine":true,"filter":null,"insertBefore":"firstthemesheet","groups":{"yui2":{"base":"https:\/\/moodle.ensta-bretagne.fr\/lib\/yuilib\/2in3\/2.9.0\/build\/","comboBase":"https:\/\/moodle.ensta-bretagne.fr\/theme\/yui_combo.php?","combine":true,"ext":false,"root":"2in3\/2.9.0\/build\/","patterns":{"yui2-":{"group":"yui2","configFn":yui1ConfigFn}}},"moodle":{"name":"moodle","base":"https:\/\/moodle.ensta-bretagne.fr\/theme\/yui_combo.php?m\/1601274371\/","combine":true,"comboBase":"https:\/\/moodle.ensta-bretagne.fr\/theme\/yui_combo.php?","ext":false,"root":"m\/1601274371\/","patterns":{"moodle-":{"group":"moodle","configFn":yui2ConfigFn}},"filter":null,"modules":{"moodle-core-actionmenu":{"requires":["base","event","node-event-simulate"]},"moodle-core-languninstallconfirm":{"requires":["base","node","moodle-core-notification-confirm","moodle-core-notification-alert"]},"moodle-core-chooserdialogue":{"requires":["base","panel","moodle-core-notification"]},"moodle-core-maintenancemodetimer":{"requires":["base","node"]},"moodle-core-tooltip":{"requires":["base","node","io-base","moodle-core-notification-dialogue","json-parse","widget-position","widget-position-align","event-outside","cache-base"]},"moodle-core-lockscroll":{"requires":["plugin","base-build"]},"moodle-core-popuphelp":{"requires":["moodle-core-tooltip"]},"moodle-core-notification":{"requires":["moodle-core-notification-dialogue","moodle-core-notification-alert","moodle-core-notification-confirm","moodle-core-notification-exception","moodle-core-notification-ajaxexception"]},"moodle-core-notification-dialogue":{"requires":["base","node","panel","escape","event-key","dd-plugin","moodle-core-widget-focusafterclose","moodle-core-lockscroll"]},"moodle-core-notification-alert":{"requires":["moodle-core-notification-dialogue"]},"moodle-core-notification-confirm":{"requires":["moodle-core-notification-dialogue"]},"moodle-core-notification-exception":{"requires":["moodle-core-notification-dialogue"]},"moodle-core-notification-ajaxexception":{"requires":["moodle-core-notification-dialogue"]},"moodle-core-dragdrop":{"requires":["base","node","io","dom","dd","event-key","event-focus","moodle-core-notification"]},"moodle-core-formchangechecker":{"requires":["base","event-focus","moodle-core-event"]},"moodle-core-event":{"requires":["event-custom"]},"moodle-core-blocks":{"requires":["base","node","io","dom","dd","dd-scroll","moodle-core-dragdrop","moodle-core-notification"]},"moodle-core-handlebars":{"condition":{"trigger":"handlebars","when":"after"}},"moodle-core_availability-form":{"requires":["base","node","event","event-delegate","panel","moodle-core-notification-dialogue","json"]},"moodle-backup-backupselectall":{"requires":["node","event","node-event-simulate","anim"]},"moodle-backup-confirmcancel":{"requires":["node","node-event-simulate","moodle-core-notification-confirm"]},"moodle-course-categoryexpander":{"requires":["node","event-key"]},"moodle-course-management":{"requires":["base","node","io-base","moodle-core-notification-exception","json-parse","dd-constrain","dd-proxy","dd-drop","dd-delegate","node-event-delegate"]},"moodle-course-dragdrop":{"requires":["base","node","io","dom","dd","dd-scroll","moodle-core-dragdrop","moodle-core-notification","moodle-course-coursebase","moodle-course-util"]},"moodle-course-formatchooser":{"requires":["base","node","node-event-simulate"]},"moodle-course-util":{"requires":["node"],"use":["moodle-course-util-base"],"submodules":{"moodle-course-util-base":{},"moodle-course-util-section":{"requires":["node","moodle-course-util-base"]},"moodle-course-util-cm":{"requires":["node","moodle-course-util-base"]}}},"moodle-form-dateselector":{"requires":["base","node","overlay","calendar"]},"moodle-form-passwordunmask":{"requires":[]},"moodle-form-shortforms":{"requires":["node","base","selector-css3","moodle-core-event"]},"moodle-question-chooser":{"requires":["moodle-core-chooserdialogue"]},"moodle-question-searchform":{"requires":["base","node"]},"moodle-question-preview":{"requires":["base","dom","event-delegate","event-key","core_question_engine"]},"moodle-availability_completion-form":{"requires":["base","node","event","moodle-core_availability-form"]},"moodle-availability_date-form":{"requires":["base","node","event","io","moodle-core_availability-form"]},"moodle-availability_grade-form":{"requires":["base","node","event","moodle-core_availability-form"]},"moodle-availability_group-form":{"requires":["base","node","event","moodle-core_availability-form"]},"moodle-availability_grouping-form":{"requires":["base","node","event","moodle-core_availability-form"]},"moodle-availability_profile-form":{"requires":["base","node","event","moodle-core_availability-form"]},"moodle-mod_assign-history":{"requires":["node","transition"]},"moodle-mod_offlinequiz-repaginate":{"requires":["base","event","node","io","moodle-core-notification-dialogue"]},"moodle-mod_offlinequiz-offlinequizquestionbank":{"requires":["base","event","node","io","io-form","yui-later","moodle-question-qbankmanager","moodle-question-chooser","moodle-question-searchform","moodle-core-notification"]},"moodle-mod_offlinequiz-autosave":{"requires":["base","node","event","event-valuechange","node-event-delegate","io-form"]},"moodle-mod_offlinequiz-modform":{"requires":["base","node","event"]},"moodle-mod_offlinequiz-util":{"requires":["node"],"use":["moodle-mod_offlinequiz-util-base"],"submodules":{"moodle-mod_offlinequiz-util-base":{},"moodle-mod_offlinequiz-util-slot":{"requires":["node","moodle-mod_offlinequiz-util-base"]},"moodle-mod_offlinequiz-util-page":{"requires":["node","moodle-mod_offlinequiz-util-base"]}}},"moodle-mod_offlinequiz-randomquestion":{"requires":["base","event","node","io","moodle-core-notification-dialogue"]},"moodle-mod_offlinequiz-dragdrop":{"requires":["base","node","io","dom","dd","dd-scroll","moodle-core-dragdrop","moodle-core-notification","moodle-mod_offlinequiz-offlinequizbase","moodle-mod_offlinequiz-util-base","moodle-mod_offlinequiz-util-page","moodle-mod_offlinequiz-util-slot","moodle-course-util"]},"moodle-mod_offlinequiz-questionchooser":{"requires":["moodle-core-chooserdialogue","moodle-mod_offlinequiz-util","querystring-parse"]},"moodle-mod_offlinequiz-offlinequizbase":{"requires":["base","node"]},"moodle-mod_offlinequiz-toolboxes":{"requires":["base","node","event","event-key","io","moodle-mod_offlinequiz-offlinequizbase","moodle-mod_offlinequiz-util-slot","moodle-core-notification-ajaxexception"]},"moodle-mod_quiz-quizbase":{"requires":["base","node"]},"moodle-mod_quiz-toolboxes":{"requires":["base","node","event","event-key","io","moodle-mod_quiz-quizbase","moodle-mod_quiz-util-slot","moodle-core-notification-ajaxexception"]},"moodle-mod_quiz-questionchooser":{"requires":["moodle-core-chooserdialogue","moodle-mod_quiz-util","querystring-parse"]},"moodle-mod_quiz-modform":{"requires":["base","node","event"]},"moodle-mod_quiz-autosave":{"requires":["base","node","event","event-valuechange","node-event-delegate","io-form"]},"moodle-mod_quiz-dragdrop":{"requires":["base","node","io","dom","dd","dd-scroll","moodle-core-dragdrop","moodle-core-notification","moodle-mod_quiz-quizbase","moodle-mod_quiz-util-base","moodle-mod_quiz-util-page","moodle-mod_quiz-util-slot","moodle-course-util"]},"moodle-mod_quiz-util":{"requires":["node","moodle-core-actionmenu"],"use":["moodle-mod_quiz-util-base"],"submodules":{"moodle-mod_quiz-util-base":{},"moodle-mod_quiz-util-slot":{"requires":["node","moodle-mod_quiz-util-base"]},"moodle-mod_quiz-util-page":{"requires":["node","moodle-mod_quiz-util-base"]}}},"moodle-message_airnotifier-toolboxes":{"requires":["base","node","io"]},"moodle-filter_glossary-autolinker":{"requires":["base","node","io-base","json-parse","event-delegate","overlay","moodle-core-event","moodle-core-notification-alert","moodle-core-notification-exception","moodle-core-notification-ajaxexception"]},"moodle-filter_mathjaxloader-loader":{"requires":["moodle-core-event"]},"moodle-editor_atto-editor":{"requires":["node","transition","io","overlay","escape","event","event-simulate","event-custom","node-event-html5","node-event-simulate","yui-throttle","moodle-core-notification-dialogue","moodle-core-notification-confirm","moodle-editor_atto-rangy","handlebars","timers","querystring-stringify"]},"moodle-editor_atto-plugin":{"requires":["node","base","escape","event","event-outside","handlebars","event-custom","timers","moodle-editor_atto-menu"]},"moodle-editor_atto-menu":{"requires":["moodle-core-notification-dialogue","node","event","event-custom"]},"moodle-editor_atto-rangy":{"requires":[]},"moodle-report_eventlist-eventfilter":{"requires":["base","event","node","node-event-delegate","datatable","autocomplete","autocomplete-filters"]},"moodle-report_loglive-fetchlogs":{"requires":["base","event","node","io","node-event-delegate"]},"moodle-gradereport_grader-gradereporttable":{"requires":["base","node","event","handlebars","overlay","event-hover"]},"moodle-gradereport_history-userselector":{"requires":["escape","event-delegate","event-key","handlebars","io-base","json-parse","moodle-core-notification-dialogue"]},"moodle-tool_capability-search":{"requires":["base","node"]},"moodle-tool_lp-dragdrop-reorder":{"requires":["moodle-core-dragdrop"]},"moodle-tool_monitor-dropdown":{"requires":["base","event","node"]},"moodle-assignfeedback_editpdf-editor":{"requires":["base","event","node","io","graphics","json","event-move","event-resize","transition","querystring-stringify-simple","moodle-core-notification-dialog","moodle-core-notification-alert","moodle-core-notification-warning","moodle-core-notification-exception","moodle-core-notification-ajaxexception"]},"moodle-atto_accessibilitychecker-button":{"requires":["color-base","moodle-editor_atto-plugin"]},"moodle-atto_accessibilityhelper-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_align-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_bold-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_charmap-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_clear-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_collapse-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_emojipicker-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_emoticon-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_equation-button":{"requires":["moodle-editor_atto-plugin","moodle-core-event","io","event-valuechange","tabview","array-extras"]},"moodle-atto_h5p-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_html-button":{"requires":["promise","moodle-editor_atto-plugin","moodle-atto_html-beautify","moodle-atto_html-codemirror","event-valuechange"]},"moodle-atto_html-codemirror":{"requires":["moodle-atto_html-codemirror-skin"]},"moodle-atto_html-beautify":{},"moodle-atto_image-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_indent-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_italic-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_link-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_managefiles-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_managefiles-usedfiles":{"requires":["node","escape"]},"moodle-atto_media-button":{"requires":["moodle-editor_atto-plugin","moodle-form-shortforms"]},"moodle-atto_noautolink-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_orderedlist-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_recordrtc-recording":{"requires":["moodle-atto_recordrtc-button"]},"moodle-atto_recordrtc-button":{"requires":["moodle-editor_atto-plugin","moodle-atto_recordrtc-recording"]},"moodle-atto_rtl-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_strike-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_subscript-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_superscript-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_table-button":{"requires":["moodle-editor_atto-plugin","moodle-editor_atto-menu","event","event-valuechange"]},"moodle-atto_title-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_underline-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_undo-button":{"requires":["moodle-editor_atto-plugin"]},"moodle-atto_unorderedlist-button":{"requires":["moodle-editor_atto-plugin"]}}},"gallery":{"name":"gallery","base":"https:\/\/moodle.ensta-bretagne.fr\/lib\/yuilib\/gallery\/","combine":true,"comboBase":"https:\/\/moodle.ensta-bretagne.fr\/theme\/yui_combo.php?","ext":false,"root":"gallery\/1601274371\/","patterns":{"gallery-":{"group":"gallery"}}}},"modules":{"core_filepicker":{"name":"core_filepicker","fullpath":"https:\/\/moodle.ensta-bretagne.fr\/lib\/javascript.php\/1601274371\/repository\/filepicker.js","requires":["base","node","node-event-simulate","json","async-queue","io-base","io-upload-iframe","io-form","yui2-treeview","panel","cookie","datatable","datatable-sort","resize-plugin","dd-plugin","escape","moodle-core_filepicker","moodle-core-notification-dialogue"]},"core_comment":{"name":"core_comment","fullpath":"https:\/\/moodle.ensta-bretagne.fr\/lib\/javascript.php\/1601274371\/comment\/comment.js","requires":["base","io-base","node","json","yui2-animation","overlay","escape"]},"mathjax":{"name":"mathjax","fullpath":"https:\/\/cdn.jsdelivr.net\/npm\/mathjax@2.7.8\/MathJax.js?delayStartupUntil=configured"}}};
M.yui.loader = {modules: {}};

//]]>
</script>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body  id="page-mod-folder-view" class="format-topics  path-mod path-mod-folder gecko dir-ltr lang-fr yui-skin-sam yui3-skin-sam moodle-ensta-bretagne-fr pagelayout-incourse course-1498 context-74188 cmid-42503 category-250 ">

<div id="page-wrapper" class="d-print-block">

    <div>
    <a class="sr-only sr-only-focusable" href="#maincontent">Passer au contenu principal</a>
</div><script src="https://moodle.ensta-bretagne.fr/lib/javascript.php/1601274371/lib/babel-polyfill/polyfill.min.js"></script>
<script src="https://moodle.ensta-bretagne.fr/lib/javascript.php/1601274371/lib/polyfills/polyfill.js"></script>
<script src="https://moodle.ensta-bretagne.fr/theme/yui_combo.php?rollup/3.17.2/yui-moodlesimple-min.js"></script><script src="https://moodle.ensta-bretagne.fr/lib/javascript.php/1601274371/lib/javascript-static.js"></script>
<script>
//<![CDATA[
document.body.className += ' jsenabled';
//]]>
</script>



    <nav class="fixed-top navbar navbar-bootswatch navbar-expand moodle-has-zindex">
    
            <a href="https://moodle.ensta-bretagne.fr" class="navbar-brand aalink 
                    d-none d-sm-inline
                    ">
                <span class="site-name d-none d-md-inline">PLTEAD</span>
            </a>
    
            <ul class="navbar-nav d-none d-md-flex">
                <!-- custom_menu -->
                <li class="dropdown nav-item">
    <a class="dropdown-toggle nav-link" id="drop-down-5f76dd3f314b45f76dd3f22e3a42" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#" title="Langue" aria-controls="drop-down-menu-5f76dd3f314b45f76dd3f22e3a42">
        Français ‎(fr)‎
    </a>
    <div class="dropdown-menu" role="menu" id="drop-down-menu-5f76dd3f314b45f76dd3f22e3a42" aria-labelledby="drop-down-5f76dd3f314b45f76dd3f22e3a42">
                <a class="dropdown-item" role="menuitem" href="https://moodle.ensta-bretagne.fr/mod/folder/view.php?id=42503&amp;lang=en" title="English ‎(en)‎">English ‎(en)‎</a>
                <a class="dropdown-item" role="menuitem" href="https://moodle.ensta-bretagne.fr/mod/folder/view.php?id=42503&amp;lang=fr" title="Français ‎(fr)‎">Français ‎(fr)‎</a>
    </div>
</li>
                <!-- page_heading_menu -->
                
            </ul>
            <ul class="nav navbar-nav ml-auto">
                <li class="d-none d-lg-block">
                    
                </li>
                <!-- navbar_plugin_output -->
                <li class="nav-item">
                    <div class="popover-region collapsed popover-region-notifications"
    id="nav-notification-popover-container" data-userid="6567"
    data-region="popover-region">
    <div class="popover-region-toggle nav-link"
        data-region="popover-region-toggle"
        role="button"
        aria-controls="popover-region-container-5f76dd3f329155f76dd3f22e3a43"
        aria-haspopup="true"
        aria-label="Afficher la fenêtre des notifications sans nouvelle notification"
        tabindex="0">
                <i class="icon fa fa-bell fa-fw "  title="Ouvrir/fermer le menu notifications" aria-label="Ouvrir/fermer le menu notifications"></i>
        <div class="count-container hidden" data-region="count-container"
        aria-label="Il y a 0 notifications non lues">0</div>

    </div>
    <div 
        id="popover-region-container-5f76dd3f329155f76dd3f22e3a43"
        class="popover-region-container"
        data-region="popover-region-container"
        aria-expanded="false"
        aria-hidden="true"
        aria-label="Fenêtre de notification"
        role="region">
        <div class="popover-region-header-container">
            <h3 class="popover-region-header-text" data-region="popover-region-header-text">Notifications</h3>
            <div class="popover-region-header-actions" data-region="popover-region-header-actions">        <a class="mark-all-read-button"
           href="#"
           title="Tout marquer comme lu"
           data-action="mark-all-read"
           role="button"
           aria-label="Tout marquer comme lu">
            <span class="normal-icon"><i class="icon fa fa-check fa-fw " aria-hidden="true"  ></i></span>
            <span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
        </a>
        <a href="https://moodle.ensta-bretagne.fr/message/notificationpreferences.php?userid=6567"
           title="Préférences de notification"
           aria-label="Préférences de notification">
            <i class="icon fa fa-cog fa-fw " aria-hidden="true"  ></i>
        </a>
</div>
        </div>
        <div class="popover-region-content-container" data-region="popover-region-content-container">
            <div class="popover-region-content" data-region="popover-region-content">
                        <div class="all-notifications"
            data-region="all-notifications"
            role="log"
            aria-busy="false"
            aria-atomic="false"
            aria-relevant="additions"></div>
        <div class="empty-message" tabindex="0" data-region="empty-message">Vous n'avez pas de notification</div>

            </div>
            <span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
        </div>
                <a class="see-all-link"
                    href="https://moodle.ensta-bretagne.fr/message/output/popup/notifications.php">
                    <div class="popover-region-footer-container">
                        <div class="popover-region-seeall-text">Tout afficher</div>
                    </div>
                </a>
    </div>
</div><div class="popover-region collapsed" data-region="popover-region-messages">
    <a id="message-drawer-toggle-5f76dd3f334b65f76dd3f22e3a44" class="nav-link d-inline-block popover-region-toggle position-relative" href="#"
            role="button">
        <i class="icon fa fa-comment fa-fw "  title="Ouvrir/fermer le tiroir des messages" aria-label="Ouvrir/fermer le tiroir des messages"></i>
        <div class="count-container hidden" data-region="count-container"
        aria-label="Il y a 0 conversations non lues">0</div>
    </a>
    <span class="sr-only sr-only-focusable" data-region="jumpto" tabindex="-1"></span></div>
                </li>
                <!-- user_menu -->
                <li class="nav-item d-flex align-items-center">
                    <div class="usermenu"><div class="action-menu moodle-actionmenu nowrap-items d-inline" id="action-menu-0" data-enhance="moodle-core-actionmenu">

        <div class="menubar d-flex " id="action-menu-0-menubar" role="menubar">

            


                <div class="action-menu-trigger">
                    <div class="dropdown">
                        <a href="#" tabindex="0" class="d-inline-block  dropdown-toggle icon-no-margin" id="action-menu-toggle-0" aria-label="Menu utilisateur" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" aria-controls="action-menu-0-menu">
                            
                            <span class="userbutton"><span class="usertext mr-1">Hugo PIQUARD</span><span class="avatars"><span class="avatar current"><img src="https://moodle.ensta-bretagne.fr/theme/image.php/classic/core/1601274371/u/f2" class="userpicture defaultuserpic" width="35" height="35" aria-hidden="true" /></span></span></span>
                                
                            <b class="caret"></b>
                        </a>
                            <div class="dropdown-menu dropdown-menu-right menu  align-tr-br" id="action-menu-0-menu" data-rel="menu-content" aria-labelledby="action-menu-toggle-0" role="menu" data-align="tr-br">
                                                                <a href="https://moodle.ensta-bretagne.fr/my/" class="dropdown-item menu-action" role="menuitem" data-title="mymoodle,admin" aria-labelledby="actionmenuaction-1">
                                <i class="icon fa fa-tachometer fa-fw " aria-hidden="true"  ></i>
                                <span class="menu-action-text" id="actionmenuaction-1">Tableau de bord</span>
                        </a>
                    <div class="dropdown-divider" role="presentation"><span class="filler">&nbsp;</span></div>
                                                                <a href="https://moodle.ensta-bretagne.fr/user/profile.php?id=6567" class="dropdown-item menu-action" role="menuitem" data-title="profile,moodle" aria-labelledby="actionmenuaction-2">
                                <i class="icon fa fa-user fa-fw " aria-hidden="true"  ></i>
                                <span class="menu-action-text" id="actionmenuaction-2">Profil</span>
                        </a>
                                                                <a href="https://moodle.ensta-bretagne.fr/grade/report/overview/index.php" class="dropdown-item menu-action" role="menuitem" data-title="grades,grades" aria-labelledby="actionmenuaction-3">
                                <i class="icon fa fa-table fa-fw " aria-hidden="true"  ></i>
                                <span class="menu-action-text" id="actionmenuaction-3">Notes</span>
                        </a>
                                                                <a href="https://moodle.ensta-bretagne.fr/message/index.php" class="dropdown-item menu-action" role="menuitem" data-title="messages,message" aria-labelledby="actionmenuaction-4">
                                <i class="icon fa fa-comment fa-fw " aria-hidden="true"  ></i>
                                <span class="menu-action-text" id="actionmenuaction-4">Messages personnels</span>
                        </a>
                                                                <a href="https://moodle.ensta-bretagne.fr/user/preferences.php" class="dropdown-item menu-action" role="menuitem" data-title="preferences,moodle" aria-labelledby="actionmenuaction-5">
                                <i class="icon fa fa-wrench fa-fw " aria-hidden="true"  ></i>
                                <span class="menu-action-text" id="actionmenuaction-5">Préférences</span>
                        </a>
                    <div class="dropdown-divider" role="presentation"><span class="filler">&nbsp;</span></div>
                                                                <a href="https://moodle.ensta-bretagne.fr/login/logout.php?sesskey=JsB6wBhkXh" class="dropdown-item menu-action" role="menuitem" data-title="logout,moodle" aria-labelledby="actionmenuaction-6">
                                <i class="icon fa fa-sign-out fa-fw " aria-hidden="true"  ></i>
                                <span class="menu-action-text" id="actionmenuaction-6">Déconnexion</span>
                        </a>
                            </div>
                    </div>
                </div>

        </div>

</div></div>
                </li>
            </ul>
            <!-- search_box -->
    </nav>
    

    <div id="page" class="container-fluid d-print-block">
        <header id="page-header" class="row">
    <div class="col-12 pt-3 pb-3">
        <div class="card ">
            <div class="card-body ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                    <div class="page-context-header"><div class="page-header-headings"><h1>Expérimentation (ROB)</h1></div></div>
                    </div>
                    <div class="header-actions-container flex-shrink-0" data-region="header-actions-container">
                    </div>
                </div>
                <div class="d-flex flex-wrap">
                    <div id="page-navbar">
                        <nav aria-label="Barre de navigation">
    <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="https://moodle.ensta-bretagne.fr/"  >Accueil</a>
                </li>
        
                <li class="breadcrumb-item">
                    <a href="https://moodle.ensta-bretagne.fr/course/index.php"  >Cours</a>
                </li>
        
                <li class="breadcrumb-item">
                    <a href="https://moodle.ensta-bretagne.fr/course/index.php?categoryid=167"  >Formation d'Ingénieur sous Statut Élève (FISE)</a>
                </li>
        
                <li class="breadcrumb-item">
                    <a href="https://moodle.ensta-bretagne.fr/course/index.php?categoryid=231"  >Semestre 3</a>
                </li>
        
                <li class="breadcrumb-item">
                    <a href="https://moodle.ensta-bretagne.fr/course/index.php?categoryid=241"  >Semestre 3 - Approfondissement STIC</a>
                </li>
        
                <li class="breadcrumb-item">
                    <a href="https://moodle.ensta-bretagne.fr/course/index.php?categoryid=250"  >UE 3.4 - Projet </a>
                </li>
        
                <li class="breadcrumb-item">
                    <a href="https://moodle.ensta-bretagne.fr/course/view.php?id=1498"  title="Expérimentation (ROB)">Expérimentation (ROB)</a>
                </li>
        
                <li class="breadcrumb-item">
                    <a href="https://moodle.ensta-bretagne.fr/course/view.php?id=1498#section-2"  >DDBOT - Code Bas Niveau</a>
                </li>
        
                <li class="breadcrumb-item">
                    <a href="https://moodle.ensta-bretagne.fr/mod/folder/view.php?id=42503" aria-current="page" title="Dossier">Code Python3 - Encoders + Regulation de vitesse en...</a>
                </li>
        </ol>
</nav>
                    </div>
                    <div class="ml-auto d-flex">
                        
                    </div>
                    <div id="course-header">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

        <div id="page-content" class="row  blocks-pre   d-print-block">
            <div id="region-main-box" class="region-main">
                <section id="region-main" class="region-main-content" aria-label="Contenu">
                    <span class="notifications" id="user-notifications"></span>
                    <div role="main"><span id="maincontent"></span><h2>Code Python3 - Encoders + Regulation de vitesse en ticks/s</h2><div id="intro" class="box py-3 generalbox"><div class="no-overflow"><p>Usage :</p><p>python3 tst_regul_py3.py &nbsp; spd left right duration</p><p>avec spd : vitesse en ticks/s</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; left, right : commande initiale gauche droite [0,255]</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; duration : duree en s</p><p><br></p><p><br></p></div></div><div class="box generalbox pt-0 pb-3 foldertree"><div id="folder_tree0" class="filemanager"><ul><li><div class="fp-filename-icon"><span class="fp-icon"><img class="icon " alt="" aria-hidden="true" src="https://moodle.ensta-bretagne.fr/theme/image.php/classic/core/1601274371/f/folder-24" /></span><span class="fp-filename"></span></div><ul><li><span class="fp-filename-icon"><a href="https://moodle.ensta-bretagne.fr/pluginfile.php/74188/mod_folder/content/0/encoders_driver_py3.py?forcedownload=1"><span class="fp-icon"><img class="icon " alt="encoders_driver_py3.py" title="encoders_driver_py3.py" src="https://moodle.ensta-bretagne.fr/theme/image.php/classic/core/1601274371/f/unknown-24" /></span><span class="fp-filename">encoders_driver_py3.py</span></a></span></li><li><span class="fp-filename-icon"><a href="https://moodle.ensta-bretagne.fr/pluginfile.php/74188/mod_folder/content/0/tst_regul_py3.py?forcedownload=1"><span class="fp-icon"><img class="icon " alt="tst_regul_py3.py" title="tst_regul_py3.py" src="https://moodle.ensta-bretagne.fr/theme/image.php/classic/core/1601274371/f/unknown-24" /></span><span class="fp-filename">tst_regul_py3.py</span></a></span></li></ul></li></ul></div></div><div class="box generalbox pt-0 pb-3 folderbuttons"><div class="singlebutton">
    <form method="post" action="https://moodle.ensta-bretagne.fr/mod/folder/download_folder.php" >
            <input type="hidden" name="id" value="42503">
            <input type="hidden" name="sesskey" value="JsB6wBhkXh">
        <button type="submit" class="btn btn-secondary"
            id="single_button5f76dd3f22e3a58"
            title=""
            
            >Télécharger le dossier</button>
    </form>
</div></div></div>
                    <div class="mt-5 mb-1 activity-navigation container-fluid">
<div class="row">
    <div class="col-md-4">        <div class="float-left">
                <a href="https://moodle.ensta-bretagne.fr/mod/resource/view.php?id=42434&forceview=1" id="prev-activity-link" class="btn btn-link"  title="Fichier GPS enregistré à terre avec DDBOT01" >&#x25C4; Fichier GPS enregistré à terre avec DDBOT01</a>

        </div>
</div>
    <div class="col-md-4">        <div class="mdl-align">
            <div class="urlselect">
    <form method="post" action="https://moodle.ensta-bretagne.fr/course/jumpto.php" class="form-inline" id="url_select_f5f76dd3f22e3a53">
        <input type="hidden" name="sesskey" value="JsB6wBhkXh">
            <label for="jump-to-activity" class="sr-only">
                Aller à…
            </label>
        <select  id="jump-to-activity" class="custom-select urlselect" name="jump"
                 >
                    <option value="" selected>Aller à…</option>
                    <option value="/mod/forum/view.php?id=41747&amp;forceview=1" >Annonces</option>
                    <option value="/mod/folder/view.php?id=42431&amp;forceview=1" >Drivers et Programmes de Test (Python 2.7)</option>
                    <option value="/mod/folder/view.php?id=42487&amp;forceview=1" >Version Python3 des drivers</option>
                    <option value="/mod/resource/view.php?id=42434&amp;forceview=1" >Fichier GPS enregistré à terre avec DDBOT01</option>
        </select>
            <noscript>
                <input type="submit" class="btn btn-secondary ml-1" value="Valider">
            </noscript>
    </form>
</div>

        </div>
</div>
    <div class="col-md-4">        <div class="float-right">
            
        </div>
</div>
</div>
</div>
                    
                </section>
            </div>
            <div class="columnleft blockcolumn  has-blocks ">
                <section data-region="blocks-column" class="d-print-none" aria-label="Blocs">
                    <aside id="block-region-side-pre" class="block-region" data-blockregion="side-pre" data-droptarget="1"><a href="#sb-1" class="sr-only sr-only-focusable">Passer Navigation</a>

<section id="inst11673"
     class=" block_navigation block  card mb-3"
     role="navigation"
     data-block="navigation"
          aria-labelledby="instance-11673-header"
     >

    <div class="card-body p-3">

            <h5 id="instance-11673-header" class="card-title d-inline">Navigation</h5>


        <div class="card-text content mt-3">
            <ul class="block_tree list" role="tree" data-ajax-loader="block_navigation/nav_loader"><li class="type_unknown depth_1 contains_branch" aria-labelledby="label_1_1"><p class="tree_item branch navigation_node" role="treeitem" aria-expanded="true" aria-owns="random5f76dd3f22e3a1_group" data-collapsible="false"><a tabindex="-1" id="label_1_1" href="https://moodle.ensta-bretagne.fr/">Accueil</a></p><ul id="random5f76dd3f22e3a1_group" role="group"><li class="type_setting depth_2 item_with_icon" aria-labelledby="label_2_2"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_2_2" href="https://moodle.ensta-bretagne.fr/my/"><i class="icon fa fa-tachometer fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">Tableau de bord</span></a></p></li><li class="type_course depth_2 contains_branch" aria-labelledby="label_2_3"><p class="tree_item branch" role="treeitem" aria-expanded="false" aria-owns="random5f76dd3f22e3a3_group"><span tabindex="-1" id="label_2_3" title="ENSTA Bretagne">Pages du site</span></p><ul id="random5f76dd3f22e3a3_group" role="group" aria-hidden="true"><li class="type_unknown depth_3 item_with_icon" aria-labelledby="label_3_5"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_3_5" href="https://moodle.ensta-bretagne.fr/blog/index.php"><i class="icon fa fa-square fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">Blogs du site</span></a></p></li><li class="type_custom depth_3 item_with_icon" aria-labelledby="label_3_6"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_3_6" href="https://moodle.ensta-bretagne.fr/badges/view.php?type=1"><i class="icon fa fa-square fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">Badges de site</span></a></p></li><li class="type_setting depth_3 item_with_icon" aria-labelledby="label_3_7"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_3_7" href="https://moodle.ensta-bretagne.fr/tag/search.php"><i class="icon fa fa-square fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">Tags</span></a></p></li><li class="type_custom depth_3 item_with_icon" aria-labelledby="label_3_8"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_3_8" href="https://moodle.ensta-bretagne.fr/calendar/view.php?view=month&amp;course=1498"><i class="icon fa fa-calendar fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">Calendrier</span></a></p></li><li class="type_activity depth_3 item_with_icon" aria-labelledby="label_3_10"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_3_10" title="Forum" href="https://moodle.ensta-bretagne.fr/mod/forum/view.php?id=1245"><img class="icon navicon" alt="Forum" title="Forum" src="https://moodle.ensta-bretagne.fr/theme/image.php/classic/forum/1601274371/icon" /><span class="item-content-wrap">Brèves</span></a></p></li><li class="type_activity depth_3 item_with_icon" aria-labelledby="label_3_11"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_3_11" title="Forum" href="https://moodle.ensta-bretagne.fr/mod/forum/view.php?id=1246"><img class="icon navicon" alt="Forum" title="Forum" src="https://moodle.ensta-bretagne.fr/theme/image.php/classic/forum/1601274371/icon" /><span class="item-content-wrap">Forum général</span></a></p></li><li class="type_activity depth_3 item_with_icon" aria-labelledby="label_3_12"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_3_12" title="Forum" href="https://moodle.ensta-bretagne.fr/mod/forum/view.php?id=15674"><img class="icon navicon" alt="Forum" title="Forum" src="https://moodle.ensta-bretagne.fr/theme/image.php/classic/forum/1601274371/icon" /><span class="item-content-wrap">Brèves</span></a></p></li></ul></li><li class="type_system depth_2 contains_branch" aria-labelledby="label_2_13"><p class="tree_item branch canexpand" role="treeitem" aria-expanded="true" aria-owns="random5f76dd3f22e3a11_group"><span tabindex="-1" id="label_2_13">Mes cours</span></p><ul id="random5f76dd3f22e3a11_group" role="group"><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_14"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1388" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1388" data-node-key="1388" data-node-type="20"><a tabindex="-1" id="label_3_14" title="Questionnaires" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1388">Questionnaires2</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_15"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_932" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_932" data-node-key="932" data-node-type="20"><a tabindex="-1" id="label_3_15" title="Calendriers Généraux" href="https://moodle.ensta-bretagne.fr/course/view.php?id=932">Calendriers</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_16"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1063" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1063" data-node-key="1063" data-node-type="20"><a tabindex="-1" id="label_3_16" title="Demande d&#039;autorisation d&#039;absence" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1063">Demande d'autorisation d'absence</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_17"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1126" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1126" data-node-key="1126" data-node-type="20"><a tabindex="-1" id="label_3_17" title="déplacements des étudiants" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1126">déplacements des étudiants</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_18"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1462" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1462" data-node-key="1462" data-node-type="20"><a tabindex="-1" id="label_3_18" title="Valorisation de l&#039;engagement étudiant" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1462">Engagement</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_19"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_625" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_625" data-node-key="625" data-node-type="20"><a tabindex="-1" id="label_3_19" title="Forums CPGE" href="https://moodle.ensta-bretagne.fr/course/view.php?id=625">forum CPGE</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_20"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_698" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_698" data-node-key="698" data-node-type="20"><a tabindex="-1" id="label_3_20" title="Présentation des voies d&#039;approfondissement" href="https://moodle.ensta-bretagne.fr/course/view.php?id=698">Présentation des spécialisations</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_21"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_622" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_622" data-node-key="622" data-node-type="20"><a tabindex="-1" id="label_3_21" title="Entretiens et questionnaires" href="https://moodle.ensta-bretagne.fr/course/view.php?id=622">Entretiens - questionnaires</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_22"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1417" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1417" data-node-key="1417" data-node-type="20"><a tabindex="-1" id="label_3_22" title="UE 1.1 - Mécanique des milieux continus" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1417">UE 1.1 - MMC</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_23"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1379" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1379" data-node-key="1379" data-node-type="20"><a tabindex="-1" id="label_3_23" title="UE 1.1 - Analyse de données spatiales" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1379">UE 1.1 Analyse de données spatiales</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_24"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1100" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1100" data-node-key="1100" data-node-type="20"><a tabindex="-1" id="label_3_24" title="UE 1.1 - Introduction à la programmation - cours" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1100">UE 1.1 - Introduction à la programmation - cours</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_25"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1084" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1084" data-node-key="1084" data-node-type="20"><a tabindex="-1" id="label_3_25" title="UE 1.1 - Introduction à la programmation - TD" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1084">UE 1.1 - Introduction à la programmation - TD</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_26"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_941" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_941" data-node-key="941" data-node-type="20"><a tabindex="-1" id="label_3_26" title="UE 1.1 - Initiation MATLAB" href="https://moodle.ensta-bretagne.fr/course/view.php?id=941">UE 1.1 - Initiation MATLAB</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_27"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_550" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_550" data-node-key="550" data-node-type="20"><a tabindex="-1" id="label_3_27" title="UE 1.1 - Mathématiques pour l&#039;ingénieur" href="https://moodle.ensta-bretagne.fr/course/view.php?id=550">UE 1.1 - Mathématiques pour l'ingénieur</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_28"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_140" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_140" data-node-key="140" data-node-type="20"><a tabindex="-1" id="label_3_28" title="UE 1.1 - Traitement du signal I" href="https://moodle.ensta-bretagne.fr/course/view.php?id=140">UE1-1-SIGNAL</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_29"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1389" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1389" data-node-key="1389" data-node-type="20"><a tabindex="-1" id="label_3_29" title="Mécanique des solides indéformables" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1389">MSI</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_30"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1382" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1382" data-node-key="1382" data-node-type="20"><a tabindex="-1" id="label_3_30" title="UE 1.2 - Automatique" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1382">UE 1.2 - Automatique</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_31"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_555" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_555" data-node-key="555" data-node-type="20"><a tabindex="-1" id="label_3_31" title="UE 1.2 - Analyse Technologique" href="https://moodle.ensta-bretagne.fr/course/view.php?id=555">UE 1.2 Analyse Techno</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_32"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_823" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_823" data-node-key="823" data-node-type="20"><a tabindex="-1" id="label_3_32" title="UE 1.2 - Capteurs et systèmes de mesure" href="https://moodle.ensta-bretagne.fr/course/view.php?id=823">Capteur</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_33"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1000" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1000" data-node-key="1000" data-node-type="20"><a tabindex="-1" id="label_3_33" title="UE 1.2 - Introduction aux systèmes numériques " href="https://moodle.ensta-bretagne.fr/course/view.php?id=1000">Electronique numérique</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_34"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1380" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1380" data-node-key="1380" data-node-type="20"><a tabindex="-1" id="label_3_34" title="UE 1.2 - Conception Assistée par Ordinateur" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1380">UE 1.2 - CAO</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_35"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_617" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_617" data-node-key="617" data-node-type="20"><a tabindex="-1" id="label_3_35" title="UE 1.3 - Etude Bibliographique" href="https://moodle.ensta-bretagne.fr/course/view.php?id=617">UE 1.3 - Bibliographie</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_36"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1386" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1386" data-node-key="1386" data-node-type="20"><a tabindex="-1" id="label_3_36" title="UE 1.3 - Ingénieur et société" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1386">Ingénieur et société</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_37"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1410" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1410" data-node-key="1410" data-node-type="20"><a tabindex="-1" id="label_3_37" title="Module 1- TOEIC" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1410">Mod1 TOEIC</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_38"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1408" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1408" data-node-key="1408" data-node-type="20"><a tabindex="-1" id="label_3_38" title="Module 3 - Team Project" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1408">Mod 3 TP</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_39"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1401" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1401" data-node-key="1401" data-node-type="20"><a tabindex="-1" id="label_3_39" title="Endurance" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1401">Endurance</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_40"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1445" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1445" data-node-key="1445" data-node-type="20"><a tabindex="-1" id="label_3_40" title="UV 2.1 - EDP et propagation d&#039;ondes" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1445">UV 2.1 - EDP et propagation d'ondes</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_41"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_713" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_713" data-node-key="713" data-node-type="20"><a tabindex="-1" id="label_3_41" title="UE 2.1 - Probabilités et statistiques" href="https://moodle.ensta-bretagne.fr/course/view.php?id=713">UE 2.1 - Probabilités et statistiques</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_42"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1219" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1219" data-node-key="1219" data-node-type="20"><a tabindex="-1" id="label_3_42" title="UE 2.1 - Cours :  Introduction à la programmation " href="https://moodle.ensta-bretagne.fr/course/view.php?id=1219">UE 2.1 - IntroProg CoursPython</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_43"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1291" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1291" data-node-key="1291" data-node-type="20"><a tabindex="-1" id="label_3_43" title="UE 2.1 - TD : Introduction à la programmation" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1291">UV 2.1 - IntoProg-TDPython</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_44"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_707" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_707" data-node-key="707" data-node-type="20"><a tabindex="-1" id="label_3_44" title="UE 2.1 - Mécanique des fluides incompressibles" href="https://moodle.ensta-bretagne.fr/course/view.php?id=707">UV 2.1 - MFI</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_45"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_675" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_675" data-node-key="675" data-node-type="20"><a tabindex="-1" id="label_3_45" title="UE 2.1 - Traitement du signal II" href="https://moodle.ensta-bretagne.fr/course/view.php?id=675">UE2-1-SIGNAL</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_46"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_553" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_553" data-node-key="553" data-node-type="20"><a tabindex="-1" id="label_3_46" title="UE 2.1 -  Base de données" href="https://moodle.ensta-bretagne.fr/course/view.php?id=553">UE 2.1 -  Base de données</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_47"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1709" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1709" data-node-key="1709" data-node-type="20"><a tabindex="-1" id="label_3_47" title="Procédés de fabrication" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1709">Fab</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_48"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1460" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1460" data-node-key="1460" data-node-type="20"><a tabindex="-1" id="label_3_48" title="Électrotechnique" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1460">UV2.2 - Électrotechnique</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_49"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1455" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1455" data-node-key="1455" data-node-type="20"><a tabindex="-1" id="label_3_49" title="Electronique numérique (Arduino)" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1455">UV2.2 - Electronique numérique (Arduino)</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_50"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1449" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1449" data-node-key="1449" data-node-type="20"><a tabindex="-1" id="label_3_50" title="Mécanique des solides Déformables" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1449">MSD</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_51"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1439" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1439" data-node-key="1439" data-node-type="20"><a tabindex="-1" id="label_3_51" title="Boucle Capteur Actionneur" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1439">BCA</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_52"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1381" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1381" data-node-key="1381" data-node-type="20"><a tabindex="-1" id="label_3_52" title="Introduction à l&#039;ingénierie système" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1381">UE 2.2 - Ingénierie système</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_53"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_663" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_663" data-node-key="663" data-node-type="20"><a tabindex="-1" id="label_3_53" title="Matériaux" href="https://moodle.ensta-bretagne.fr/course/view.php?id=663">Matériaux</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_54"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1568" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1568" data-node-key="1568" data-node-type="20"><a tabindex="-1" id="label_3_54" title="UE 2.3. - Retour de stage" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1568">RS</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_55"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1750" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1750" data-node-key="1750" data-node-type="20"><a tabindex="-1" id="label_3_55" title="FISE 1 ENGLISH TUTORIAL N° 3" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1750">FISE 1 ENGLISH TUTORIAL N° 3</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_56"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1745" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1745" data-node-key="1745" data-node-type="20"><a tabindex="-1" id="label_3_56" title="MODULE 6 C1/C2 - A Thiery - World Issues and Events" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1745">MODULE 6 C1/C2 - A Thiery - World Issues and Events</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_57"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1710" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1710" data-node-key="1710" data-node-type="20"><a tabindex="-1" id="label_3_57" title="MODULE 5 C1/C2 - A Thiery - World Issues and Events" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1710">MODULE 5 C1/C2 - A Thiery - World Issues and Events</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_58"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1705" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1705" data-node-key="1705" data-node-type="20"><a tabindex="-1" id="label_3_58" title="ENGLISH TUTORIAL N° 2" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1705">ENGLISH TUTORIAL N°2</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_59"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1670" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1670" data-node-key="1670" data-node-type="20"><a tabindex="-1" id="label_3_59" title="FISE 1 English Modules" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1670">English Semester 2</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_60"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1646" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1646" data-node-key="1646" data-node-type="20"><a tabindex="-1" id="label_3_60" title="TOEIC TRAINING" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1646">TOEIC TRAINING</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_61"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1576" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1576" data-node-key="1576" data-node-type="20"><a tabindex="-1" id="label_3_61" title="LV1 Semestre 2 Anglais" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1576">LV1-S2-Anglais</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_62"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1349" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1349" data-node-key="1349" data-node-type="20"><a tabindex="-1" id="label_3_62" title="Module 5d et 6d - Tech Culture" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1349">TC</a></p></li><li class="type_course depth_3 contains_branch" aria-labelledby="label_3_63"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1448" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1448" data-node-key="1448" data-node-type="20"><a tabindex="-1" id="label_3_63" title="Module 4 - Futureproofing" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1448">Futureproofing</a></p></li><li class="type_custom depth_3 item_with_icon" aria-labelledby="label_3_80"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_3_80" href="https://moodle.ensta-bretagne.fr/my/"><i class="icon fa fa-square fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">Plus…</span></a></p></li></ul></li><li class="type_system depth_2 contains_branch" aria-labelledby="label_2_81"><p class="tree_item branch canexpand" role="treeitem" aria-expanded="true" aria-owns="random5f76dd3f22e3a13_group"><a tabindex="-1" id="label_2_81" href="https://moodle.ensta-bretagne.fr/course/index.php">Cours</a></p><ul id="random5f76dd3f22e3a13_group" role="group"><li class="type_category depth_3 contains_branch" aria-labelledby="label_3_82"><p class="tree_item branch canexpand" role="treeitem" aria-expanded="true" aria-owns="random5f76dd3f22e3a14_group"><span tabindex="-1" id="label_3_82">Formation d'Ingénieur sous Statut Élève (FISE)</span></p><ul id="random5f76dd3f22e3a14_group" role="group"><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_83"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_227" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_227" data-node-key="227" data-node-type="10"><span tabindex="-1" id="label_4_83">Accueil - accompagnement - orientation - Forums CPGE</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_84"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_719" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_719" data-node-key="719" data-node-type="10"><span tabindex="-1" id="label_4_84">Programme de formation et des enseignements FISE</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_85"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_530" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_530" data-node-key="530" data-node-type="10"><span tabindex="-1" id="label_4_85">Première année</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_88"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_209" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_209" data-node-key="209" data-node-type="10"><span tabindex="-1" id="label_4_88">Stage opérateur</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_89"><p class="tree_item branch canexpand" role="treeitem" aria-expanded="true" aria-owns="random5f76dd3f22e3a15_group"><span tabindex="-1" id="label_4_89">Semestre 3</span></p><ul id="random5f76dd3f22e3a15_group" role="group"><li class="type_category depth_5 contains_branch" aria-labelledby="label_5_90"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_236" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_236" data-node-key="236" data-node-type="10"><span tabindex="-1" id="label_5_90">UE 3.1 Tronc commun - Mathématiques - informatique</span></p></li><li class="type_category depth_5 contains_branch" aria-labelledby="label_5_91"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_382" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_382" data-node-key="382" data-node-type="10"><span tabindex="-1" id="label_5_91">UE 3.3 - Langues : anglais et LV2</span></p></li><li class="type_category depth_5 contains_branch" aria-labelledby="label_5_92"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_383" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_383" data-node-key="383" data-node-type="10"><span tabindex="-1" id="label_5_92">UE 3.3 - Culture et approfondissement de choix per...</span></p></li><li class="type_category depth_5 contains_branch" aria-labelledby="label_5_93"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_688" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_688" data-node-key="688" data-node-type="10"><span tabindex="-1" id="label_5_93">UE 3.4 - Gestion de projet</span></p></li><li class="type_category depth_5 contains_branch" aria-labelledby="label_5_94"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_240" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_240" data-node-key="240" data-node-type="10"><span tabindex="-1" id="label_5_94">Semestre 3 - Approfondissement Hydrographie-océano...</span></p></li><li class="type_category depth_5 contains_branch" aria-labelledby="label_5_95"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_238" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_238" data-node-key="238" data-node-type="10"><span tabindex="-1" id="label_5_95">Semestre 3 - Approfondissement MECA</span></p></li><li class="type_category depth_5 contains_branch" aria-labelledby="label_5_96"><p class="tree_item branch canexpand" role="treeitem" aria-expanded="true" aria-owns="random5f76dd3f22e3a16_group"><span tabindex="-1" id="label_5_96">Semestre 3 - Approfondissement STIC</span></p><ul id="random5f76dd3f22e3a16_group" role="group"><li class="type_category depth_6 contains_branch" aria-labelledby="label_6_97"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_579" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_579" data-node-key="579" data-node-type="10"><span tabindex="-1" id="label_6_97">UE 3.1 - Fondamentaux</span></p></li><li class="type_category depth_6 contains_branch" aria-labelledby="label_6_98"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_580" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_580" data-node-key="580" data-node-type="10"><span tabindex="-1" id="label_6_98">UE 3.2 - Localisation (ROB)</span></p></li><li class="type_category depth_6 contains_branch" aria-labelledby="label_6_99"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_235" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_235" data-node-key="235" data-node-type="10"><span tabindex="-1" id="label_6_99">UE 3.2 Informatique et réseau</span></p></li><li class="type_category depth_6 contains_branch" aria-labelledby="label_6_100"><p class="tree_item branch canexpand" role="treeitem" aria-expanded="true" aria-owns="random5f76dd3f22e3a17_group"><span tabindex="-1" id="label_6_100">UE 3.4 - Projet </span></p><ul id="random5f76dd3f22e3a17_group" role="group"><li class="type_course depth_7 contains_branch" aria-labelledby="label_7_101"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1496" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1496" data-node-key="1496" data-node-type="20"><a tabindex="-1" id="label_7_101" title="Projet (ROB)" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1496">Projet (ROB)</a></p></li><li class="type_course depth_7 contains_branch" aria-labelledby="label_7_102"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1775" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1775" data-node-key="1775" data-node-type="20"><a tabindex="-1" id="label_7_102" title="Ateliers (ROB)" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1775">Ateliers (ROB)</a></p></li><li class="type_course depth_7 contains_branch" aria-labelledby="label_7_103"><p class="tree_item branch canexpand" role="treeitem" aria-expanded="true" aria-owns="random5f76dd3f22e3a18_group"><a tabindex="-1" id="label_7_103" title="Expérimentation (ROB)" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1498">Expérimentation (ROB)</a></p><ul id="random5f76dd3f22e3a18_group" role="group"><li class="type_container depth_8 contains_branch" aria-labelledby="label_8_104"><p class="tree_item branch" role="treeitem" aria-expanded="false" aria-owns="random5f76dd3f22e3a19_group"><a tabindex="-1" id="label_8_104" href="https://moodle.ensta-bretagne.fr/user/index.php?id=1498">Participants</a></p><ul id="random5f76dd3f22e3a19_group" role="group" aria-hidden="true"><li class="type_setting depth_9 item_with_icon" aria-labelledby="label_9_105"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_9_105" href="https://moodle.ensta-bretagne.fr/blog/index.php?courseid=1498"><i class="icon fa fa-square fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">Blogs de cours</span></a></p></li><li class="type_user depth_9 item_with_icon" aria-labelledby="label_9_106"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_9_106" href="https://moodle.ensta-bretagne.fr/user/view.php?id=6567&amp;course=1498"><i class="icon fa fa-square fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">Hugo PIQUARD</span></a></p></li></ul></li><li class="type_setting depth_8 item_with_icon" aria-labelledby="label_8_107"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_8_107" href="https://moodle.ensta-bretagne.fr/badges/view.php?type=2&amp;id=1498"><i class="icon fa fa-shield fa-fw navicon"  title="Badges" aria-label="Badges"></i><span class="item-content-wrap">Badges</span></a></p></li><li class="type_setting depth_8 item_with_icon" aria-labelledby="label_8_108"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_8_108" href="https://moodle.ensta-bretagne.fr/admin/tool/lp/coursecompetencies.php?courseid=1498"><i class="icon fa fa-check-square-o fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">Compétences</span></a></p></li><li class="type_setting depth_8 item_with_icon" aria-labelledby="label_8_109"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_8_109" href="https://moodle.ensta-bretagne.fr/grade/report/index.php?id=1498"><i class="icon fa fa-table fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">Notes</span></a></p></li><li class="type_structure depth_8 contains_branch" aria-labelledby="label_8_110"><p class="tree_item branch" role="treeitem" id="expandable_branch_30_13978" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_30_13978" data-node-key="13978" data-node-type="30"><a tabindex="-1" id="label_8_110" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1498#section-0">Généralités</a></p></li><li class="type_structure depth_8 contains_branch" aria-labelledby="label_8_111"><p class="tree_item branch" role="treeitem" aria-expanded="true" aria-owns="random5f76dd3f22e3a25_group"><a tabindex="-1" id="label_8_111" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1498#section-2">DDBOT - Code Bas Niveau</a></p><ul id="random5f76dd3f22e3a25_group" role="group"><li class="type_activity depth_9 item_with_icon" aria-labelledby="label_9_112"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_9_112" title="Dossier" href="https://moodle.ensta-bretagne.fr/mod/folder/view.php?id=42431"><img class="icon navicon" alt="Dossier" title="Dossier" src="https://moodle.ensta-bretagne.fr/theme/image.php/classic/folder/1601274371/icon" /><span class="item-content-wrap">Drivers et Programmes de Test (Python 2.7)</span></a></p></li><li class="type_activity depth_9 item_with_icon" aria-labelledby="label_9_113"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_9_113" title="Dossier" href="https://moodle.ensta-bretagne.fr/mod/folder/view.php?id=42487"><img class="icon navicon" alt="Dossier" title="Dossier" src="https://moodle.ensta-bretagne.fr/theme/image.php/classic/folder/1601274371/icon" /><span class="item-content-wrap">Version Python3 des drivers</span></a></p></li><li class="type_activity depth_9 item_with_icon" aria-labelledby="label_9_114"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_9_114" title="Fichier" href="https://moodle.ensta-bretagne.fr/mod/resource/view.php?id=42434"><img class="icon navicon" alt="Fichier" title="Fichier" src="https://moodle.ensta-bretagne.fr/theme/image.php/classic/core/1601274371/f/text-24" /><span class="item-content-wrap">Fichier GPS enregistré à terre avec DDBOT01</span></a></p></li><li class="type_activity depth_9 item_with_icon current_branch" aria-labelledby="label_9_115"><p class="tree_item hasicon active_tree_node" role="treeitem"><a tabindex="-1" id="label_9_115" title="Dossier" href="https://moodle.ensta-bretagne.fr/mod/folder/view.php?id=42503"><img class="icon navicon" alt="Dossier" title="Dossier" src="https://moodle.ensta-bretagne.fr/theme/image.php/classic/folder/1601274371/icon" /><span class="item-content-wrap">Code Python3 - Encoders + Regulation de vitesse en...</span></a></p></li></ul></li><li class="type_structure depth_8 contains_branch" aria-labelledby="label_8_116"><p class="tree_item branch" role="treeitem" id="expandable_branch_30_13981" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_30_13981" data-node-key="13981" data-node-type="30"><a tabindex="-1" id="label_8_116" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1498#section-3">Section 3</a></p></li><li class="type_structure depth_8 contains_branch" aria-labelledby="label_8_117"><p class="tree_item branch" role="treeitem" id="expandable_branch_30_13982" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_30_13982" data-node-key="13982" data-node-type="30"><a tabindex="-1" id="label_8_117" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1498#section-4">Section 4</a></p></li><li class="type_structure depth_8 contains_branch" aria-labelledby="label_8_118"><p class="tree_item branch" role="treeitem" id="expandable_branch_30_13983" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_30_13983" data-node-key="13983" data-node-type="30"><a tabindex="-1" id="label_8_118" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1498#section-5">Section 5</a></p></li><li class="type_structure depth_8 contains_branch" aria-labelledby="label_8_119"><p class="tree_item branch" role="treeitem" id="expandable_branch_30_13984" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_30_13984" data-node-key="13984" data-node-type="30"><a tabindex="-1" id="label_8_119" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1498#section-6">Section 6</a></p></li><li class="type_structure depth_8 contains_branch" aria-labelledby="label_8_120"><p class="tree_item branch" role="treeitem" id="expandable_branch_30_13985" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_30_13985" data-node-key="13985" data-node-type="30"><a tabindex="-1" id="label_8_120" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1498#section-7">Section 7</a></p></li><li class="type_structure depth_8 contains_branch" aria-labelledby="label_8_121"><p class="tree_item branch" role="treeitem" id="expandable_branch_30_13986" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_30_13986" data-node-key="13986" data-node-type="30"><a tabindex="-1" id="label_8_121" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1498#section-8">Section 8</a></p></li><li class="type_structure depth_8 contains_branch" aria-labelledby="label_8_122"><p class="tree_item branch" role="treeitem" id="expandable_branch_30_13987" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_30_13987" data-node-key="13987" data-node-type="30"><a tabindex="-1" id="label_8_122" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1498#section-9">Section 9</a></p></li><li class="type_structure depth_8 contains_branch" aria-labelledby="label_8_123"><p class="tree_item branch" role="treeitem" id="expandable_branch_30_13988" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_30_13988" data-node-key="13988" data-node-type="30"><a tabindex="-1" id="label_8_123" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1498#section-10">Section 10</a></p></li></ul></li><li class="type_course depth_7 contains_branch" aria-labelledby="label_7_124"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_1468" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_1468" data-node-key="1468" data-node-type="20"><a tabindex="-1" id="label_7_124" title="UV projet : procédure administrative à suivre obligatoirement" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1468">UE projet  : procédure administrative</a></p></li><li class="type_course depth_7 item_with_icon" aria-labelledby="label_7_125"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_7_125" title="Projet système Acte 1 (SNS+SOIA+MASSEL)" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1031"><i class="icon fa fa-graduation-cap fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">UE3.4 Proj2A_SNS_SOIA_MASSEL</span></a></p></li><li class="type_course depth_7 item_with_icon" aria-labelledby="label_7_126"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_7_126" title="Ateliers techniques (2019-2020 et avant)" href="https://moodle.ensta-bretagne.fr/course/view.php?id=939"><i class="icon fa fa-graduation-cap fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">SPID-COMPETENCES</span></a></p></li><li class="type_course depth_7 item_with_icon" aria-labelledby="label_7_127"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_7_127" title="Ingénierie-Système " href="https://moodle.ensta-bretagne.fr/course/view.php?id=935"><i class="icon fa fa-graduation-cap fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">UE3.4 IS</span></a></p></li></ul></li><li class="type_category depth_6 contains_branch" aria-labelledby="label_6_128"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_255" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_255" data-node-key="255" data-node-type="10"><span tabindex="-1" id="label_6_128">UV 3.5 - Traitement de l'information 3</span></p></li><li class="type_category depth_6 contains_branch" aria-labelledby="label_6_129"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_256" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_256" data-node-key="256" data-node-type="10"><span tabindex="-1" id="label_6_129">UV 3.7 - Systèmes de navigation - positionnement</span></p></li><li class="type_course depth_6 item_with_icon" aria-labelledby="label_6_130"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_6_130" title="Formes d&#039;ondes et Modulations" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1781"><i class="icon fa fa-graduation-cap fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">Formes d'ondes</span></a></p></li><li class="type_course depth_6 contains_branch" aria-labelledby="label_6_131"><p class="tree_item branch" role="treeitem" id="expandable_branch_20_983" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_20_983" data-node-key="983" data-node-type="20"><a tabindex="-1" id="label_6_131" title="2A STIC - informations générales" href="https://moodle.ensta-bretagne.fr/course/view.php?id=983">2A STIC - informations générales</a></p></li><li class="type_course depth_6 item_with_icon" aria-labelledby="label_6_132"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_6_132" title="UV 3.0 MASTER ROB - Initiation  Robotique Mobile" href="https://moodle.ensta-bretagne.fr/course/view.php?id=709"><i class="icon fa fa-graduation-cap fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">UV 3.0 MASTER ROB - Initiation  Robotique Mobile</span></a></p></li></ul></li><li class="type_course depth_5 item_with_icon" aria-labelledby="label_5_133"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_5_133" title="Projet personnel sportif" href="https://moodle.ensta-bretagne.fr/course/view.php?id=1817"><i class="icon fa fa-graduation-cap fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">Sport</span></a></p></li></ul></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_134"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_251" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_251" data-node-key="251" data-node-type="10"><span tabindex="-1" id="label_4_134">Semestre 4</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_135"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_260" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_260" data-node-key="260" data-node-type="10"><span tabindex="-1" id="label_4_135">Stage assistant ingénieur</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_136"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_213" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_213" data-node-key="213" data-node-type="10"><span tabindex="-1" id="label_4_136">Substitutions - Césures - Contrat pro</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_137"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_311" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_311" data-node-key="311" data-node-type="10"><span tabindex="-1" id="label_4_137">Semestre 5 - Approfondissement ANO</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_138"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_702" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_702" data-node-key="702" data-node-type="10"><span tabindex="-1" id="label_4_138">Semestre 5 - Approfondissement AV</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_139"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_312" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_312" data-node-key="312" data-node-type="10"><span tabindex="-1" id="label_4_139">Semestre 5 - Approfondissement MAMS</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_140"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_175" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_175" data-node-key="175" data-node-type="10"><span tabindex="-1" id="label_4_140">Semestre 5 - Approfondissement ISE</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_141"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_313" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_313" data-node-key="313" data-node-type="10"><span tabindex="-1" id="label_4_141">Semestre 5 - Approfondissement HYO</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_142"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_314" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_314" data-node-key="314" data-node-type="10"><span tabindex="-1" id="label_4_142">Semestre 5 - Approfondissement SP</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_143"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_315" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_315" data-node-key="315" data-node-type="10"><span tabindex="-1" id="label_4_143">Semestre 5 - Approfondissement SNS - SOIA - ROB</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_144"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_363" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_363" data-node-key="363" data-node-type="10"><span tabindex="-1" id="label_4_144">Semestre 5 - UVs 5.8</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_145"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_228" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_228" data-node-key="228" data-node-type="10"><span tabindex="-1" id="label_4_145">Semestre 6 -  PFE</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_146"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_286" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_286" data-node-key="286" data-node-type="10"><span tabindex="-1" id="label_4_146">Documents pédagogiques inter ou hors UV</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_147"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_160" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_160" data-node-key="160" data-node-type="10"><span tabindex="-1" id="label_4_147">IETA ou IA</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_148"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_401" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_401" data-node-key="401" data-node-type="10"><span tabindex="-1" id="label_4_148">Inscriptions aux évaluations de 2ième session (rap...</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_149"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_538" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_538" data-node-key="538" data-node-type="10"><span tabindex="-1" id="label_4_149">Remises à niveau</span></p></li><li class="type_category depth_4 contains_branch" aria-labelledby="label_4_150"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_562" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_562" data-node-key="562" data-node-type="10"><span tabindex="-1" id="label_4_150">Bilans de semestres</span></p></li><li class="type_course depth_4 item_with_icon" aria-labelledby="label_4_151"><p class="tree_item hasicon" role="treeitem"><a tabindex="-1" id="label_4_151" title="FLE/FLS - Formation intensive " href="https://moodle.ensta-bretagne.fr/course/view.php?id=1764"><i class="icon fa fa-graduation-cap fa-fw navicon" aria-hidden="true"  ></i><span class="item-content-wrap">FLE/FLS</span></a></p></li></ul></li><li class="type_category depth_3 contains_branch" aria-labelledby="label_3_152"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_156" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_156" data-node-key="156" data-node-type="10"><span tabindex="-1" id="label_3_152">Informations à destination de tous les étudiants</span></p></li><li class="type_category depth_3 contains_branch" aria-labelledby="label_3_153"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_88" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_88" data-node-key="88" data-node-type="10"><span tabindex="-1" id="label_3_153">Formation d'Ingénieur Par Alternance (FIPA)</span></p></li><li class="type_category depth_3 contains_branch" aria-labelledby="label_3_154"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_140" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_140" data-node-key="140" data-node-type="10"><span tabindex="-1" id="label_3_154">Mastères Spécialisés et Masters</span></p></li><li class="type_category depth_3 contains_branch" aria-labelledby="label_3_155"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_190" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_190" data-node-key="190" data-node-type="10"><span tabindex="-1" id="label_3_155">Formation SAGEMA</span></p></li><li class="type_category depth_3 contains_branch" aria-labelledby="label_3_157"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_278" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_278" data-node-key="278" data-node-type="10"><span tabindex="-1" id="label_3_157">Espace Langues et Culture</span></p></li><li class="type_category depth_3 contains_branch" aria-labelledby="label_3_158"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_89" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_89" data-node-key="89" data-node-type="10"><span tabindex="-1" id="label_3_158">Formation Continue</span></p></li><li class="type_category depth_3 contains_branch" aria-labelledby="label_3_159"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_381" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_381" data-node-key="381" data-node-type="10"><span tabindex="-1" id="label_3_159">Espace Clubs techniques étudiants</span></p></li><li class="type_category depth_3 contains_branch" aria-labelledby="label_3_160"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_408" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_408" data-node-key="408" data-node-type="10"><span tabindex="-1" id="label_3_160">Espace Personnels ENSTA Bretagne</span></p></li><li class="type_category depth_3 contains_branch" aria-labelledby="label_3_161"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_451" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_451" data-node-key="451" data-node-type="10"><span tabindex="-1" id="label_3_161">Innovation Pédagogie Numérique et Formations</span></p></li><li class="type_category depth_3 contains_branch" aria-labelledby="label_3_162"><p class="tree_item branch" role="treeitem" id="expandable_branch_10_684" aria-expanded="false" data-requires-ajax="true" data-loaded="false" data-node-id="expandable_branch_10_684" data-node-key="684" data-node-type="10"><span tabindex="-1" id="label_3_162">Formations intensives de rentrée</span></p></li></ul></li></ul></li></ul>
            <div class="footer"></div>
            
        </div>

    </div>

</section>

  <span id="sb-1"></span><a href="#sb-2" class="sr-only sr-only-focusable">Passer Administration</a>

<section id="inst11674"
     class=" block_settings block  card mb-3"
     role="navigation"
     data-block="settings"
          aria-labelledby="instance-11674-header"
     >

    <div class="card-body p-3">

            <h5 id="instance-11674-header" class="card-title d-inline">Administration</h5>


        <div class="card-text content mt-3">
            <div id="settingsnav" class="box py-3 block_tree_box"><ul class="block_tree list" role="tree" data-ajax-loader="block_navigation/site_admin_loader"><li class="type_course depth_1 contains_branch" tabindex="-1" aria-labelledby="label_1_1"><p class="tree_item root_node tree_item branch" role="treeitem" aria-expanded="false" aria-owns="random5f76dd3f22e3a37_group"><span tabindex="0">Administration du cours</span></p><ul id="random5f76dd3f22e3a37_group" role="group" aria-hidden="true"><li class="type_setting depth_2 item_with_icon" tabindex="-1" aria-labelledby="label_2_1"><p class="tree_item hasicon tree_item leaf" role="treeitem"><a href="https://moodle.ensta-bretagne.fr/enrol/self/unenrolself.php?enrolid=4459"><i class="icon fa fa-user fa-fw navicon" aria-hidden="true"  ></i>Me désinscrire de Expérimentation (ROB)</a></p></li></ul></li></ul></div>
            <div class="footer"></div>
            
        </div>

    </div>

</section>

  <span id="sb-2"></span></aside>
                </section>
            </div>

            <div class="columnright blockcolumn ">
                <section data-region="blocks-column" class="d-print-none" aria-label="Blocs">
                    <aside id="block-region-side-post" class="block-region" data-blockregion="side-post" data-droptarget="1"></aside>
                </section>
            </div>
        </div>
    </div>
    <div
    id="drawer-5f76dd3f3668c5f76dd3f22e3a54"
    class=" drawer bg-white hidden"
    aria-expanded="false"
    aria-hidden="true"
    data-region="right-hand-drawer"
    role="region"
    tabindex="0"
>
            <div id="message-drawer-5f76dd3f3668c5f76dd3f22e3a54" class="message-app" data-region="message-drawer" role="region">
            <div class="closewidget bg-light border-bottom text-right">
                <a class="text-dark" data-action="closedrawer" href="#">
                     <i class="icon fa fa-window-close fa-fw "  title="Fermer" aria-label="Fermer"></i>
                </a>
            </div>
            <div class="header-container position-relative" data-region="header-container">
                <div class="hidden border-bottom px-2 py-3" aria-hidden="true" data-region="view-contacts">
                    <div class="d-flex align-items-center">
                        <div class="align-self-stretch">
                            <a class="h-100 d-flex align-items-center mr-2" href="#" data-route-back role="button">
                                <div class="icon-back-in-drawer">
                                    <span class="dir-rtl-hide"><i class="icon fa fa-chevron-left fa-fw " aria-hidden="true"  ></i></span>
                                    <span class="dir-ltr-hide"><i class="icon fa fa-chevron-right fa-fw " aria-hidden="true"  ></i></span>
                                </div>
                                <div class="icon-back-in-app">
                                    <span class="dir-rtl-hide"><i class="icon fa fa-times fa-fw " aria-hidden="true"  ></i></span>
                                </div>                            </a>
                        </div>
                        <div>
                            Contacts
                        </div>
                        <div class="ml-auto">
                            <a href="#" data-route="view-search" role="button" aria-label="Recherche">
                                <i class="icon fa fa-search fa-fw " aria-hidden="true"  ></i>
                            </a>
                        </div>
                    </div>
                </div>                
                <div
                    class="hidden bg-white position-relative border-bottom p-1 p-sm-2"
                    aria-hidden="true"
                    data-region="view-conversation"
                >
                    <div class="hidden" data-region="header-content"></div>
                    <div class="hidden" data-region="header-edit-mode">
                        
                        <div class="d-flex p-2 align-items-center">
                            Messages sélectionnés :
                            <span class="ml-1" data-region="message-selected-court">1</span>
                            <button type="button" class="ml-auto close" aria-label="Annuler la sélection de message"
                                data-action="cancel-edit-mode">
                                    <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <div data-region="header-placeholder">
                        <div class="d-flex">
                            <div
                                class="ml-2 rounded-circle bg-pulse-grey align-self-center"
                                style="height: 38px; width: 38px"
                            >
                            </div>
                            <div class="ml-2 " style="flex: 1">
                                <div
                                    class="mt-1 bg-pulse-grey w-75"
                                    style="height: 16px;"
                                >
                                </div>
                            </div>
                            <div
                                class="ml-2 bg-pulse-grey align-self-center"
                                style="height: 16px; width: 20px"
                            >
                            </div>
                        </div>
                    </div>
                    <div
                        class="hidden position-absolute"
                        data-region="confirm-dialogue-container"
                        style="top: 0; bottom: -1px; right: 0; left: 0; background: rgba(0,0,0,0.3);"
                    ></div>
                </div>                <div class="border-bottom  p-1 px-sm-2 py-sm-3" aria-hidden="false"  data-region="view-overview">
                    <div class="d-flex align-items-center">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text pr-2 bg-white">
                                    <i class="icon fa fa-search fa-fw " aria-hidden="true"  ></i>
                                </span>
                            </div>
                            <input
                                type="text"
                                class="form-control border-left-0"
                                placeholder="Recherche"
                                aria-label="Recherche"
                                data-region="view-overview-search-input"
                            >
                        </div>
                        <div class="ml-2">
                            <a
                                href="#"
                                data-route="view-settings"
                                data-route-param="6567"
                                aria-label="Réglages"
                                role="button"
                            >
                                <i class="icon fa fa-cog fa-fw " aria-hidden="true"  ></i>
                            </a>
                        </div>
                    </div>
                    <div class="text-right mt-sm-3">
                        <a href="#" data-route="view-contacts" role="button">
                            <i class="icon fa fa-user fa-fw " aria-hidden="true"  ></i>
                            Contacts
                            <span class="badge badge-primary bg-primary ml-2 hidden"
                            data-region="contact-request-count"
                            aria-label="Il y a 0 demandes de contact en attente">
                                0
                            </span>
                        </a>
                    </div>
                </div>
                
                <div class="hidden border-bottom px-2 py-3 view-search"  aria-hidden="true" data-region="view-search">
                    <div class="d-flex align-items-center">
                        <a
                            class="mr-2 align-self-stretch d-flex align-items-center"
                            href="#"
                            data-route-back
                            data-action="cancel-search"
                            role="button"
                        >
                            <div class="icon-back-in-drawer">
                                <span class="dir-rtl-hide"><i class="icon fa fa-chevron-left fa-fw " aria-hidden="true"  ></i></span>
                                <span class="dir-ltr-hide"><i class="icon fa fa-chevron-right fa-fw " aria-hidden="true"  ></i></span>
                            </div>
                            <div class="icon-back-in-app">
                                <span class="dir-rtl-hide"><i class="icon fa fa-times fa-fw " aria-hidden="true"  ></i></span>
                            </div>                        </a>
                        <div class="input-group">
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Recherche"
                                aria-label="Recherche"
                                data-region="search-input"
                            >
                            <div class="input-group-append">
                                <button
                                    class="btn btn-outline-secondary"
                                    type="button"
                                    data-action="search"
                                    aria-label="Recherche"
                                >
                                    <span data-region="search-icon-container">
                                        <i class="icon fa fa-search fa-fw " aria-hidden="true"  ></i>
                                    </span>
                                    <span class="hidden" data-region="loading-icon-container">
                                        <span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="hidden border-bottom px-2 py-3" aria-hidden="true" data-region="view-settings">
                    <div class="d-flex align-items-center">
                        <div class="align-self-stretch" >
                            <a class="h-100 d-flex mr-2 align-items-center" href="#" data-route-back role="button">
                                <div class="icon-back-in-drawer">
                                    <span class="dir-rtl-hide"><i class="icon fa fa-chevron-left fa-fw " aria-hidden="true"  ></i></span>
                                    <span class="dir-ltr-hide"><i class="icon fa fa-chevron-right fa-fw " aria-hidden="true"  ></i></span>
                                </div>
                                <div class="icon-back-in-app">
                                    <span class="dir-rtl-hide"><i class="icon fa fa-times fa-fw " aria-hidden="true"  ></i></span>
                                </div>                            </a>
                        </div>
                        <div>
                            Paramètres
                        </div>
                    </div>
                </div>
            </div>
            <div class="body-container position-relative" data-region="body-container">
                
                <div
                    class="hidden"
                    data-region="view-contact"
                    aria-hidden="true"
                >
                    <div class="p-2 pt-3" data-region="content-container"></div>
                </div>                <div class="hidden h-100" data-region="view-contacts" aria-hidden="true" data-user-id="6567">
                    <div class="d-flex flex-column h-100">
                        <div class="p-3 border-bottom">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a
                                        id="contacts-tab-5f76dd3f3668c5f76dd3f22e3a54"
                                        class="nav-link active"
                                        href="#contacts-tab-panel-5f76dd3f3668c5f76dd3f22e3a54"
                                        data-toggle="tab"
                                        data-action="show-contacts-section"
                                        role="tab"
                                        aria-controls="contacts-tab-panel-5f76dd3f3668c5f76dd3f22e3a54"
                                        aria-selected="true"
                                    >
                                        Contacts
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a
                                        id="requests-tab-5f76dd3f3668c5f76dd3f22e3a54"
                                        class="nav-link"
                                        href="#requests-tab-panel-5f76dd3f3668c5f76dd3f22e3a54"
                                        data-toggle="tab"
                                        data-action="show-requests-section"
                                        role="tab"
                                        aria-controls="requests-tab-panel-5f76dd3f3668c5f76dd3f22e3a54"
                                        aria-selected="false"
                                    >
                                        Demandes
                                        <span class="badge badge-primary bg-primary ml-2 hidden"
                                        data-region="contact-request-count"
                                        aria-label="Il y a 0 demandes de contact en attente">
                                            0
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content d-flex flex-column h-100">
                                            <div
                    class="tab-pane fade show active h-100 lazy-load-list"
                    aria-live="polite"
                    data-region="lazy-load-list"
                    data-user-id="6567"
                                        id="contacts-tab-panel-5f76dd3f3668c5f76dd3f22e3a54"
                    data-section="contacts"
                    role="tabpanel"
                    aria-labelledby="contacts-tab-5f76dd3f3668c5f76dd3f22e3a54"

                >
                    
                    <div class="hidden text-center p-2" data-region="empty-message-container">
                        Aucun contact
                    </div>
                    <div class="hidden list-group" data-region="content-container">
                        
                    </div>
                    <div class="list-group" data-region="placeholder-container">
                        
                    </div>
                    <div class="w-100 text-center p-3 hidden" data-region="loading-icon-container" >
                        <span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
                    </div>
                </div>
                
                                            <div
                    class="tab-pane fade h-100 lazy-load-list"
                    aria-live="polite"
                    data-region="lazy-load-list"
                    data-user-id="6567"
                                        id="requests-tab-panel-5f76dd3f3668c5f76dd3f22e3a54"
                    data-section="requests"
                    role="tabpanel"
                    aria-labelledby="requests-tab-5f76dd3f3668c5f76dd3f22e3a54"

                >
                    
                    <div class="hidden text-center p-2" data-region="empty-message-container">
                        Aucune demande de contact
                    </div>
                    <div class="hidden list-group" data-region="content-container">
                        
                    </div>
                    <div class="list-group" data-region="placeholder-container">
                        
                    </div>
                    <div class="w-100 text-center p-3 hidden" data-region="loading-icon-container" >
                        <span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
                    </div>
                </div>
                        </div>
                    </div>
                </div>                
                <div
                    class="view-conversation hidden h-100"
                    aria-hidden="true"
                    data-region="view-conversation"
                    data-user-id="6567"
                    data-midnight="1601589600"
                    data-message-poll-min="10"
                    data-message-poll-max="120"
                    data-message-poll-after-max="300"
                    style="overflow-y: auto; overflow-x: hidden"
                >
                    <div class="position-relative h-100" data-region="content-container" style="overflow-y: auto; overflow-x: hidden">
                        <div class="content-message-container hidden h-100 px-2 pt-0" data-region="content-message-container" role="log" style="overflow-y: auto; overflow-x: hidden">
                            <div class="py-3 sticky-top z-index-1 border-bottom text-center hidden" data-region="contact-request-sent-message-container">
                                <p class="m-0">Demande de contact envoyée</p>
                                <p class="font-italic font-weight-light" data-region="text"></p>
                            </div>
                            <div class="p-3 text-center hidden" data-region="self-conversation-message-container">
                                <p class="m-0">Espace personnel</p>
                                <p class="font-italic font-weight-light" data-region="text">Enregistrer des brouillons, liens, note, etc. pour un usage ultérieur.</p>
                           </div>
                            <div class="hidden text-center p-3" data-region="more-messages-loading-icon-container"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</div>
                        </div>
                        <div class="p-4 w-100 h-100 hidden position-absolute" data-region="confirm-dialogue-container" style="top: 0; background: rgba(0,0,0,0.3);">
                            
                            <div class="p-3 bg-white" data-region="confirm-dialogue" role="alert">
                                <p class="text-muted" data-region="dialogue-text"></p>
                                <div class="mb-2 custom-control custom-checkbox hidden" data-region="delete-messages-for-all-users-toggle-container">
                                    <input type="checkbox" class="custom-control-input" id="delete-messages-for-all-users" data-region="delete-messages-for-all-users-toggle">
                                    <label class="custom-control-label text-muted" for="delete-messages-for-all-users">
                                        Supprimer pour moi et et pour tous les autres
                                    </label>
                                </div>
                                <button type="button" class="btn btn-primary btn-block hidden" data-action="confirm-block">
                                    <span data-region="dialogue-button-text">Bloc</span>
                                    <span class="hidden" data-region="loading-icon-container"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-block hidden" data-action="confirm-unblock">
                                    <span data-region="dialogue-button-text">Débloquer</span>
                                    <span class="hidden" data-region="loading-icon-container"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-block hidden" data-action="confirm-remove-contact">
                                    <span data-region="dialogue-button-text">Supprimer</span>
                                    <span class="hidden" data-region="loading-icon-container"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-block hidden" data-action="confirm-add-contact">
                                    <span data-region="dialogue-button-text">Ajouter</span>
                                    <span class="hidden" data-region="loading-icon-container"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-block hidden" data-action="confirm-delete-selected-messages">
                                    <span data-region="dialogue-button-text">Supprimer</span>
                                    <span class="hidden" data-region="loading-icon-container"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-block hidden" data-action="confirm-delete-conversation">
                                    <span data-region="dialogue-button-text">Supprimer</span>
                                    <span class="hidden" data-region="loading-icon-container"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-block hidden" data-action="request-add-contact">
                                    <span data-region="dialogue-button-text">Envoyer une demande de contact</span>
                                    <span class="hidden" data-region="loading-icon-container"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-block hidden" data-action="accept-contact-request">
                                    <span data-region="dialogue-button-text">Accepter et ajouter aux contacts</span>
                                    <span class="hidden" data-region="loading-icon-container"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</span>
                                </button>
                                <button type="button" class="btn btn-secondary btn-block hidden" data-action="decline-contact-request">
                                    <span data-region="dialogue-button-text">Décliner</span>
                                    <span class="hidden" data-region="loading-icon-container"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-block" data-action="okay-confirm">OK</button>
                                <button type="button" class="btn btn-secondary btn-block" data-action="cancel-confirm">Annuler</button>
                            </div>
                        </div>
                        <div class="px-2 pb-2 pt-0" data-region="content-placeholder">
                            <div class="h-100 d-flex flex-column">
                                <div
                                    class="px-2 pb-2 pt-0 bg-light h-100"
                                    style="overflow-y: auto"
                                >
                                    <div class="mt-4">
                                        <div class="mb-4">
                                            <div class="mx-auto bg-white" style="height: 25px; width: 100px"></div>
                                        </div>
                                        <div class="d-flex flex-column p-2 bg-white rounded mb-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="mr-2">
                                                    <div class="rounded-circle bg-pulse-grey" style="height: 35px; width: 35px"></div>
                                                </div>
                                                <div class="mr-4 w-75 bg-pulse-grey" style="height: 16px"></div>
                                                <div class="ml-auto bg-pulse-grey" style="width: 35px; height: 16px"></div>
                                            </div>
                                            <div class="bg-pulse-grey w-100" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-75 mt-2" style="height: 16px"></div>
                                        </div>
                                        <div class="d-flex flex-column p-2 bg-white rounded mb-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="mr-2">
                                                    <div class="rounded-circle bg-pulse-grey" style="height: 35px; width: 35px"></div>
                                                </div>
                                                <div class="mr-4 w-75 bg-pulse-grey" style="height: 16px"></div>
                                                <div class="ml-auto bg-pulse-grey" style="width: 35px; height: 16px"></div>
                                            </div>
                                            <div class="bg-pulse-grey w-100" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-75 mt-2" style="height: 16px"></div>
                                        </div>
                                        <div class="d-flex flex-column p-2 bg-white rounded mb-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="mr-2">
                                                    <div class="rounded-circle bg-pulse-grey" style="height: 35px; width: 35px"></div>
                                                </div>
                                                <div class="mr-4 w-75 bg-pulse-grey" style="height: 16px"></div>
                                                <div class="ml-auto bg-pulse-grey" style="width: 35px; height: 16px"></div>
                                            </div>
                                            <div class="bg-pulse-grey w-100" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-75 mt-2" style="height: 16px"></div>
                                        </div>
                                    </div>                                    <div class="mt-4">
                                        <div class="mb-4">
                                            <div class="mx-auto bg-white" style="height: 25px; width: 100px"></div>
                                        </div>
                                        <div class="d-flex flex-column p-2 bg-white rounded mb-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="mr-2">
                                                    <div class="rounded-circle bg-pulse-grey" style="height: 35px; width: 35px"></div>
                                                </div>
                                                <div class="mr-4 w-75 bg-pulse-grey" style="height: 16px"></div>
                                                <div class="ml-auto bg-pulse-grey" style="width: 35px; height: 16px"></div>
                                            </div>
                                            <div class="bg-pulse-grey w-100" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-75 mt-2" style="height: 16px"></div>
                                        </div>
                                        <div class="d-flex flex-column p-2 bg-white rounded mb-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="mr-2">
                                                    <div class="rounded-circle bg-pulse-grey" style="height: 35px; width: 35px"></div>
                                                </div>
                                                <div class="mr-4 w-75 bg-pulse-grey" style="height: 16px"></div>
                                                <div class="ml-auto bg-pulse-grey" style="width: 35px; height: 16px"></div>
                                            </div>
                                            <div class="bg-pulse-grey w-100" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-75 mt-2" style="height: 16px"></div>
                                        </div>
                                        <div class="d-flex flex-column p-2 bg-white rounded mb-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="mr-2">
                                                    <div class="rounded-circle bg-pulse-grey" style="height: 35px; width: 35px"></div>
                                                </div>
                                                <div class="mr-4 w-75 bg-pulse-grey" style="height: 16px"></div>
                                                <div class="ml-auto bg-pulse-grey" style="width: 35px; height: 16px"></div>
                                            </div>
                                            <div class="bg-pulse-grey w-100" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-75 mt-2" style="height: 16px"></div>
                                        </div>
                                    </div>                                    <div class="mt-4">
                                        <div class="mb-4">
                                            <div class="mx-auto bg-white" style="height: 25px; width: 100px"></div>
                                        </div>
                                        <div class="d-flex flex-column p-2 bg-white rounded mb-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="mr-2">
                                                    <div class="rounded-circle bg-pulse-grey" style="height: 35px; width: 35px"></div>
                                                </div>
                                                <div class="mr-4 w-75 bg-pulse-grey" style="height: 16px"></div>
                                                <div class="ml-auto bg-pulse-grey" style="width: 35px; height: 16px"></div>
                                            </div>
                                            <div class="bg-pulse-grey w-100" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-75 mt-2" style="height: 16px"></div>
                                        </div>
                                        <div class="d-flex flex-column p-2 bg-white rounded mb-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="mr-2">
                                                    <div class="rounded-circle bg-pulse-grey" style="height: 35px; width: 35px"></div>
                                                </div>
                                                <div class="mr-4 w-75 bg-pulse-grey" style="height: 16px"></div>
                                                <div class="ml-auto bg-pulse-grey" style="width: 35px; height: 16px"></div>
                                            </div>
                                            <div class="bg-pulse-grey w-100" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-75 mt-2" style="height: 16px"></div>
                                        </div>
                                        <div class="d-flex flex-column p-2 bg-white rounded mb-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="mr-2">
                                                    <div class="rounded-circle bg-pulse-grey" style="height: 35px; width: 35px"></div>
                                                </div>
                                                <div class="mr-4 w-75 bg-pulse-grey" style="height: 16px"></div>
                                                <div class="ml-auto bg-pulse-grey" style="width: 35px; height: 16px"></div>
                                            </div>
                                            <div class="bg-pulse-grey w-100" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-75 mt-2" style="height: 16px"></div>
                                        </div>
                                    </div>                                    <div class="mt-4">
                                        <div class="mb-4">
                                            <div class="mx-auto bg-white" style="height: 25px; width: 100px"></div>
                                        </div>
                                        <div class="d-flex flex-column p-2 bg-white rounded mb-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="mr-2">
                                                    <div class="rounded-circle bg-pulse-grey" style="height: 35px; width: 35px"></div>
                                                </div>
                                                <div class="mr-4 w-75 bg-pulse-grey" style="height: 16px"></div>
                                                <div class="ml-auto bg-pulse-grey" style="width: 35px; height: 16px"></div>
                                            </div>
                                            <div class="bg-pulse-grey w-100" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-75 mt-2" style="height: 16px"></div>
                                        </div>
                                        <div class="d-flex flex-column p-2 bg-white rounded mb-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="mr-2">
                                                    <div class="rounded-circle bg-pulse-grey" style="height: 35px; width: 35px"></div>
                                                </div>
                                                <div class="mr-4 w-75 bg-pulse-grey" style="height: 16px"></div>
                                                <div class="ml-auto bg-pulse-grey" style="width: 35px; height: 16px"></div>
                                            </div>
                                            <div class="bg-pulse-grey w-100" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-75 mt-2" style="height: 16px"></div>
                                        </div>
                                        <div class="d-flex flex-column p-2 bg-white rounded mb-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="mr-2">
                                                    <div class="rounded-circle bg-pulse-grey" style="height: 35px; width: 35px"></div>
                                                </div>
                                                <div class="mr-4 w-75 bg-pulse-grey" style="height: 16px"></div>
                                                <div class="ml-auto bg-pulse-grey" style="width: 35px; height: 16px"></div>
                                            </div>
                                            <div class="bg-pulse-grey w-100" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-75 mt-2" style="height: 16px"></div>
                                        </div>
                                    </div>                                    <div class="mt-4">
                                        <div class="mb-4">
                                            <div class="mx-auto bg-white" style="height: 25px; width: 100px"></div>
                                        </div>
                                        <div class="d-flex flex-column p-2 bg-white rounded mb-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="mr-2">
                                                    <div class="rounded-circle bg-pulse-grey" style="height: 35px; width: 35px"></div>
                                                </div>
                                                <div class="mr-4 w-75 bg-pulse-grey" style="height: 16px"></div>
                                                <div class="ml-auto bg-pulse-grey" style="width: 35px; height: 16px"></div>
                                            </div>
                                            <div class="bg-pulse-grey w-100" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-75 mt-2" style="height: 16px"></div>
                                        </div>
                                        <div class="d-flex flex-column p-2 bg-white rounded mb-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="mr-2">
                                                    <div class="rounded-circle bg-pulse-grey" style="height: 35px; width: 35px"></div>
                                                </div>
                                                <div class="mr-4 w-75 bg-pulse-grey" style="height: 16px"></div>
                                                <div class="ml-auto bg-pulse-grey" style="width: 35px; height: 16px"></div>
                                            </div>
                                            <div class="bg-pulse-grey w-100" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-75 mt-2" style="height: 16px"></div>
                                        </div>
                                        <div class="d-flex flex-column p-2 bg-white rounded mb-2">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="mr-2">
                                                    <div class="rounded-circle bg-pulse-grey" style="height: 35px; width: 35px"></div>
                                                </div>
                                                <div class="mr-4 w-75 bg-pulse-grey" style="height: 16px"></div>
                                                <div class="ml-auto bg-pulse-grey" style="width: 35px; height: 16px"></div>
                                            </div>
                                            <div class="bg-pulse-grey w-100" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-100 mt-2" style="height: 16px"></div>
                                            <div class="bg-pulse-grey w-75 mt-2" style="height: 16px"></div>
                                        </div>
                                    </div>                                </div>
                            </div>                        </div>
                    </div>
                </div>
                
                <div
                    class="hidden"
                    aria-hidden="true"
                    data-region="view-group-info"
                >
                    <div
                        class="pt-3 h-100 d-flex flex-column"
                        data-region="group-info-content-container"
                        style="overflow-y: auto"
                    ></div>
                </div>                <div class="h-100 view-overview-body" aria-hidden="false" data-region="view-overview"  data-user-id="6567">
                    <div id="message-drawer-view-overview-container-5f76dd3f3668c5f76dd3f22e3a54" class="d-flex flex-column h-100" style="overflow-y: auto">
                            
                            
                            <div
                                class="section border-0 card"
                                data-region="view-overview-favourites"
                            >
                                <div id="view-overview-favourites-toggle" class="card-header p-0" data-region="toggle">
                                    <button
                                        class="btn btn-link w-100 text-left p-1 p-sm-2 d-flex align-items-center overview-section-toggle collapsed"
                                        data-toggle="collapse"
                                        data-target="#view-overview-favourites-target-5f76dd3f3668c5f76dd3f22e3a54"
                                        aria-expanded="false"
                                        aria-controls="view-overview-favourites-target-5f76dd3f3668c5f76dd3f22e3a54"
                                    >
                                        <span class="collapsed-icon-container">
                                            <i class="icon fa fa-caret-right fa-fw " aria-hidden="true"  ></i>
                                        </span>
                                        <span class="expanded-icon-container">
                                            <i class="icon fa fa-caret-down fa-fw " aria-hidden="true"  ></i>
                                        </span>
                                        <span class="font-weight-bold">Favori</span>
                                        <small class="hidden ml-1" data-region="section-total-count-container"
                                        aria-label=" conversations">
                                            (<span data-region="section-total-count"></span>)
                                        </small>
                                        <span class="hidden ml-2" data-region="loading-icon-container">
                                            <span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
                                        </span>
                                        <span class="hidden badge badge-pill badge-primary ml-auto bg-primary"
                                        data-region="section-unread-count"
                                        >
                                            
                                        </span>
                                    </button>
                                </div>
                                                            <div
                                class="collapse border-bottom  lazy-load-list"
                                aria-live="polite"
                                data-region="lazy-load-list"
                                data-user-id="6567"
                                            id="view-overview-favourites-target-5f76dd3f3668c5f76dd3f22e3a54"
            aria-labelledby="view-overview-favourites-toggle"
            data-parent="#message-drawer-view-overview-container-5f76dd3f3668c5f76dd3f22e3a54"

                            >
                                
                                <div class="hidden text-center p-2" data-region="empty-message-container">
                                            <p class="text-muted mt-2">Aucune conversation favorite</p>

                                </div>
                                <div class="hidden list-group" data-region="content-container">
                                    
                                </div>
                                <div class="list-group" data-region="placeholder-container">
                                            <div class="text-center py-2"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</div>

                                </div>
                                <div class="w-100 text-center p-3 hidden" data-region="loading-icon-container" >
                                    <span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
                                </div>
                            </div>
                            </div>
                            
                            
                            <div
                                class="section border-0 card"
                                data-region="view-overview-group-messages"
                            >
                                <div id="view-overview-group-messages-toggle" class="card-header p-0" data-region="toggle">
                                    <button
                                        class="btn btn-link w-100 text-left p-1 p-sm-2 d-flex align-items-center overview-section-toggle collapsed"
                                        data-toggle="collapse"
                                        data-target="#view-overview-group-messages-target-5f76dd3f3668c5f76dd3f22e3a54"
                                        aria-expanded="false"
                                        aria-controls="view-overview-group-messages-target-5f76dd3f3668c5f76dd3f22e3a54"
                                    >
                                        <span class="collapsed-icon-container">
                                            <i class="icon fa fa-caret-right fa-fw " aria-hidden="true"  ></i>
                                        </span>
                                        <span class="expanded-icon-container">
                                            <i class="icon fa fa-caret-down fa-fw " aria-hidden="true"  ></i>
                                        </span>
                                        <span class="font-weight-bold">Groupe</span>
                                        <small class="hidden ml-1" data-region="section-total-count-container"
                                        aria-label=" conversations">
                                            (<span data-region="section-total-count"></span>)
                                        </small>
                                        <span class="hidden ml-2" data-region="loading-icon-container">
                                            <span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
                                        </span>
                                        <span class="hidden badge badge-pill badge-primary ml-auto bg-primary"
                                        data-region="section-unread-count"
                                        >
                                            
                                        </span>
                                    </button>
                                </div>
                                                            <div
                                class="collapse border-bottom  lazy-load-list"
                                aria-live="polite"
                                data-region="lazy-load-list"
                                data-user-id="6567"
                                            id="view-overview-group-messages-target-5f76dd3f3668c5f76dd3f22e3a54"
            aria-labelledby="view-overview-group-messages-toggle"
            data-parent="#message-drawer-view-overview-container-5f76dd3f3668c5f76dd3f22e3a54"

                            >
                                
                                <div class="hidden text-center p-2" data-region="empty-message-container">
                                            <p class="text-muted mt-2">Pas de conversation de groupe</p>

                                </div>
                                <div class="hidden list-group" data-region="content-container">
                                    
                                </div>
                                <div class="list-group" data-region="placeholder-container">
                                            <div class="text-center py-2"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</div>

                                </div>
                                <div class="w-100 text-center p-3 hidden" data-region="loading-icon-container" >
                                    <span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
                                </div>
                            </div>
                            </div>
                            
                            
                            <div
                                class="section border-0 card"
                                data-region="view-overview-messages"
                            >
                                <div id="view-overview-messages-toggle" class="card-header p-0" data-region="toggle">
                                    <button
                                        class="btn btn-link w-100 text-left p-1 p-sm-2 d-flex align-items-center overview-section-toggle collapsed"
                                        data-toggle="collapse"
                                        data-target="#view-overview-messages-target-5f76dd3f3668c5f76dd3f22e3a54"
                                        aria-expanded="false"
                                        aria-controls="view-overview-messages-target-5f76dd3f3668c5f76dd3f22e3a54"
                                    >
                                        <span class="collapsed-icon-container">
                                            <i class="icon fa fa-caret-right fa-fw " aria-hidden="true"  ></i>
                                        </span>
                                        <span class="expanded-icon-container">
                                            <i class="icon fa fa-caret-down fa-fw " aria-hidden="true"  ></i>
                                        </span>
                                        <span class="font-weight-bold">Privée</span>
                                        <small class="hidden ml-1" data-region="section-total-count-container"
                                        aria-label=" conversations">
                                            (<span data-region="section-total-count"></span>)
                                        </small>
                                        <span class="hidden ml-2" data-region="loading-icon-container">
                                            <span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
                                        </span>
                                        <span class="hidden badge badge-pill badge-primary ml-auto bg-primary"
                                        data-region="section-unread-count"
                                        >
                                            
                                        </span>
                                    </button>
                                </div>
                                                            <div
                                class="collapse border-bottom  lazy-load-list"
                                aria-live="polite"
                                data-region="lazy-load-list"
                                data-user-id="6567"
                                            id="view-overview-messages-target-5f76dd3f3668c5f76dd3f22e3a54"
            aria-labelledby="view-overview-messages-toggle"
            data-parent="#message-drawer-view-overview-container-5f76dd3f3668c5f76dd3f22e3a54"

                            >
                                
                                <div class="hidden text-center p-2" data-region="empty-message-container">
                                            <p class="text-muted mt-2">Pas de conversation privée</p>

                                </div>
                                <div class="hidden list-group" data-region="content-container">
                                    
                                </div>
                                <div class="list-group" data-region="placeholder-container">
                                            <div class="text-center py-2"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</div>

                                </div>
                                <div class="w-100 text-center p-3 hidden" data-region="loading-icon-container" >
                                    <span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
                                </div>
                            </div>
                            </div>
                    </div>
                </div>
                
                <div
                    data-region="view-search"
                    aria-hidden="true"
                    class="h-100 hidden"
                    data-user-id="6567"
                    data-users-offset="0"
                    data-messages-offset="0"
                    style="overflow-y: auto"
                    
                >
                    <div class="hidden" data-region="search-results-container" style="overflow-y: auto">
                        
                        <div class="d-flex flex-column">
                            <div class="mb-3 bg-white" data-region="all-contacts-container">
                                <div data-region="contacts-container"  class="pt-2">
                                    <h4 class="h6 px-2">Contacts</h4>
                                    <div class="list-group" data-region="list"></div>
                                </div>
                                <div data-region="non-contacts-container" class="pt-2 border-top">
                                    <h4 class="h6 px-2">Non contact</h4>
                                    <div class="list-group" data-region="list"></div>
                                </div>
                                <div class="text-right">
                                    <button class="btn btn-link text-primary" data-action="load-more-users">
                                        <span data-region="button-text">Charger plus</span>
                                        <span data-region="loading-icon-container" class="hidden"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</span>
                                    </button>
                                </div>
                            </div>
                            <div class="bg-white" data-region="messages-container">
                                <h4 class="h6 px-2 pt-2">Messages personnels</h4>
                                <div class="list-group" data-region="list"></div>
                                <div class="text-right">
                                    <button class="btn btn-link text-primary" data-action="load-more-messages">
                                        <span data-region="button-text">Charger plus</span>
                                        <span data-region="loading-icon-container" class="hidden"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</span>
                                    </button>
                                </div>
                            </div>
                            <p class="hidden p-3 text-center" data-region="no-results-container">Aucun résultat</p>
                        </div>                    </div>
                    <div class="hidden" data-region="loading-placeholder">
                        <div class="text-center pt-3 icon-size-4"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</div>
                    </div>
                    <div class="p-3 text-center" data-region="empty-message-container">
                        <p>Rechercher des personnes et des messages</p>
                    </div>
                </div>                
                <div class="h-100 hidden bg-white" aria-hidden="true" data-region="view-settings">
                    <div class="hidden" data-region="content-container">
                        
                        <div data-region="settings" class="p-3">
                            <h3 class="h6 font-weight-bold">Confidentialité</h3>
                            <p>Vous pouvez choisir qui peut vous envoyer un message personnel</p>
                            <div data-preference="blocknoncontacts" class="mb-3">
                                <fieldset>
                                    <legend class="sr-only">Accepter des messages de :</legend>
                                        <div class="custom-control custom-radio mb-2">
                                            <input
                                                type="radio"
                                                name="message_blocknoncontacts"
                                                class="custom-control-input"
                                                id="block-noncontacts-5f76dd3f3668c5f76dd3f22e3a54-1"
                                                value="1"
                                            >
                                            <label class="custom-control-label ml-2" for="block-noncontacts-5f76dd3f3668c5f76dd3f22e3a54-1">
                                                Mes contacts seulement
                                            </label>
                                        </div>
                                        <div class="custom-control custom-radio mb-2">
                                            <input
                                                type="radio"
                                                name="message_blocknoncontacts"
                                                class="custom-control-input"
                                                id="block-noncontacts-5f76dd3f3668c5f76dd3f22e3a54-0"
                                                value="0"
                                            >
                                            <label class="custom-control-label ml-2" for="block-noncontacts-5f76dd3f3668c5f76dd3f22e3a54-0">
                                                Mes contacts et tout le monde dans mes cours
                                            </label>
                                        </div>
                                </fieldset>
                            </div>
                        
                            <div class="hidden" data-region="notification-preference-container">
                                <h3 class="mb-2 mt-4 h6 font-weight-bold">Préférences de notification</h3>
                            </div>
                        
                            <h3 class="mb-2 mt-4 h6 font-weight-bold">Général</h3>
                            <div data-preference="entertosend">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="enter-to-send-5f76dd3f3668c5f76dd3f22e3a54" >
                                    <label class="custom-control-label" for="enter-to-send-5f76dd3f3668c5f76dd3f22e3a54">
                                        Taper entrée pour envoyer
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div data-region="placeholder-container">
                        
                        <div class="d-flex flex-column p-3">
                            <div class="w-25 bg-pulse-grey h6" style="height: 18px"></div>
                            <div class="w-75 bg-pulse-grey mb-4" style="height: 18px"></div>
                            <div class="mb-3">
                                <div class="w-100 d-flex mb-3">
                                    <div class="bg-pulse-grey rounded-circle" style="width: 18px; height: 18px"></div>
                                    <div class="bg-pulse-grey w-50 ml-2" style="height: 18px"></div>
                                </div>
                                <div class="w-100 d-flex mb-3">
                                    <div class="bg-pulse-grey rounded-circle" style="width: 18px; height: 18px"></div>
                                    <div class="bg-pulse-grey w-50 ml-2" style="height: 18px"></div>
                                </div>
                                <div class="w-100 d-flex mb-3">
                                    <div class="bg-pulse-grey rounded-circle" style="width: 18px; height: 18px"></div>
                                    <div class="bg-pulse-grey w-50 ml-2" style="height: 18px"></div>
                                </div>
                            </div>
                            <div class="w-50 bg-pulse-grey h6 mb-3 mt-2" style="height: 18px"></div>
                            <div class="mb-4">
                                <div class="w-100 d-flex mb-2 align-items-center">
                                    <div class="bg-pulse-grey w-25" style="width: 18px; height: 27px"></div>
                                    <div class="bg-pulse-grey w-25 ml-2" style="height: 18px"></div>
                                </div>
                                <div class="w-100 d-flex mb-2 align-items-center">
                                    <div class="bg-pulse-grey w-25" style="width: 18px; height: 27px"></div>
                                    <div class="bg-pulse-grey w-25 ml-2" style="height: 18px"></div>
                                </div>
                            </div>
                            <div class="w-25 bg-pulse-grey h6 mb-3 mt-2" style="height: 18px"></div>
                            <div class="mb-3">
                                <div class="w-100 d-flex mb-2 align-items-center">
                                    <div class="bg-pulse-grey w-25" style="width: 18px; height: 27px"></div>
                                    <div class="bg-pulse-grey w-50 ml-2" style="height: 18px"></div>
                                </div>
                            </div>
                        </div>                    </div>
                </div>            </div>
            <div class="footer-container position-relative" data-region="footer-container">
                
                <div
                    class="hidden border-top bg-white position-relative"
                    aria-hidden="true"
                    data-region="view-conversation"
                    data-enter-to-send="0"
                >
                    <div class="hidden p-sm-2" data-region="content-messages-footer-container">
                        
                            <div
                                class="emoji-auto-complete-container w-100 hidden"
                                data-region="emoji-auto-complete-container"
                                aria-live="polite"
                                aria-hidden="true"
                            >
                            </div>
                        <div class="d-flex mt-sm-1">
                            <textarea
                                dir="auto"
                                data-region="send-message-txt"
                                class="form-control bg-light"
                                rows="3"
                                data-auto-rows
                                data-min-rows="3"
                                data-max-rows="5"
                                aria-label="Écrire un message"
                                placeholder="Écrire un message"
                                style="resize: none"
                            ></textarea>
                        
                            <div class="position-relative d-flex flex-column">
                                    <div
                                        data-region="emoji-picker-container"
                                        class="emoji-picker-container hidden"
                                        aria-hidden="true"
                                    >
                                        
                                        <div
                                            data-region="emoji-picker"
                                            class="card shadow emoji-picker"
                                        >
                                            <div class="card-header px-1 pt-1 pb-0 d-flex justify-content-between flex-shrink-0">
                                                <button
                                                    class="btn btn-outline-secondary icon-no-margin category-button selected"
                                                    data-action="show-category"
                                                    data-category="Recent"
                                                    title="Récents"
                                                >
                                                    <i class="icon fa fa-clock-o fa-fw " aria-hidden="true"  ></i>
                                                </button>
                                                <button
                                                    class="btn btn-outline-secondary icon-no-margin category-button"
                                                    data-action="show-category"
                                                    data-category="Smileys & People"
                                                    title="Émoticônes & personnes"
                                                >
                                                    <i class="icon fa fa-smile-o fa-fw " aria-hidden="true"  ></i>
                                                </button>
                                                <button
                                                    class="btn btn-outline-secondary icon-no-margin category-button"
                                                    data-action="show-category"
                                                    data-category="Animals & Nature"
                                                    title="Animaux & nature"
                                                >
                                                    <i class="icon fa fa-leaf fa-fw " aria-hidden="true"  ></i>
                                                </button>
                                                <button
                                                    class="btn btn-outline-secondary icon-no-margin category-button"
                                                    data-action="show-category"
                                                    data-category="Food & Drink"
                                                    title="Nourriture & boissons"
                                                >
                                                    <i class="icon fa fa-cutlery fa-fw " aria-hidden="true"  ></i>
                                                </button>
                                                <button
                                                    class="btn btn-outline-secondary icon-no-margin category-button"
                                                    data-action="show-category"
                                                    data-category="Travel & Places"
                                                    title="Voyages & lieux"
                                                >
                                                    <i class="icon fa fa-plane fa-fw " aria-hidden="true"  ></i>
                                                </button>
                                                <button
                                                    class="btn btn-outline-secondary icon-no-margin category-button"
                                                    data-action="show-category"
                                                    data-category="Activities"
                                                    title="Activités"
                                                >
                                                    <i class="icon fa fa-futbol-o fa-fw " aria-hidden="true"  ></i>
                                                </button>
                                                <button
                                                    class="btn btn-outline-secondary icon-no-margin category-button"
                                                    data-action="show-category"
                                                    data-category="Objects"
                                                    title="Objets"
                                                >
                                                    <i class="icon fa fa-lightbulb-o fa-fw " aria-hidden="true"  ></i>
                                                </button>
                                                <button
                                                    class="btn btn-outline-secondary icon-no-margin category-button"
                                                    data-action="show-category"
                                                    data-category="Symbols"
                                                    title="Symboles"
                                                >
                                                    <i class="icon fa fa-heart fa-fw " aria-hidden="true"  ></i>
                                                </button>
                                                <button
                                                    class="btn btn-outline-secondary icon-no-margin category-button"
                                                    data-action="show-category"
                                                    data-category="Flags"
                                                    title="Drapeaux"
                                                >
                                                    <i class="icon fa fa-flag fa-fw " aria-hidden="true"  ></i>
                                                </button>
                                            </div>
                                            <div class="card-body p-2 d-flex flex-column overflow-hidden">
                                                <div class="input-group mb-1 flex-shrink-0">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text pr-0 bg-white text-muted">
                                                            <i class="icon fa fa-search fa-fw " aria-hidden="true"  ></i>
                                                        </span>
                                                    </div>
                                                    <input
                                                        type="text"
                                                        class="form-control border-left-0"
                                                        placeholder="Rechercher"
                                                        aria-label="Rechercher"
                                                        data-region="search-input"
                                                    >
                                                </div>
                                                <div class="flex-grow-1 overflow-auto emojis-container h-100" data-region="emojis-container">
                                                    <div class="position-relative" data-region="row-container"></div>
                                                </div>
                                                <div class="flex-grow-1 overflow-auto search-results-container h-100 hidden" data-region="search-results-container">
                                                    <div class="position-relative" data-region="row-container"></div>
                                                </div>
                                            </div>
                                            <div
                                                class="card-footer d-flex flex-shrink-0"
                                                data-region="footer"
                                            >
                                                <div class="emoji-preview" data-region="emoji-preview"></div>
                                                <div data-region="emoji-short-name" class="emoji-short-name text-muted text-wrap ml-2"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <button
                                        class="btn btn-link btn-icon icon-size-3 ml-1"
                                        aria-label="Activer/désactiver le sélecteur d'émojis"
                                        data-action="toggle-emoji-picker"
                                    >
                                        <i class="icon fa fa-smile-o fa-fw " aria-hidden="true"  ></i>
                                    </button>
                                <button
                                    class="btn btn-link btn-icon icon-size-3 ml-1 mt-auto"
                                    aria-label="Envoyer message personnel"
                                    data-action="send-message"
                                >
                                    <span data-region="send-icon-container"><i class="icon fa fa-paper-plane fa-fw " aria-hidden="true"  ></i></span>
                                    <span class="hidden" data-region="loading-icon-container"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="hidden p-sm-2" data-region="content-messages-footer-edit-mode-container">
                        
                        <div class="d-flex p-3 justify-content-end">
                            <button
                                class="btn btn-link btn-icon my-1 icon-size-4"
                                data-action="delete-selected-messages"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Supprimer les messages sélectionnés"
                            >
                                <span data-region="icon-container"><i class="icon fa fa-trash fa-fw " aria-hidden="true"  ></i></span>
                                <span class="hidden" data-region="loading-icon-container"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</span>
                                <span class="sr-only">Supprimer les messages sélectionnés</span>
                            </button>
                        </div>                    </div>
                    <div class="hidden bg-secondary p-sm-3" data-region="content-messages-footer-require-contact-container">
                        
                        <div class="p-3 bg-white">
                            <p data-region="title"></p>
                            <p class="text-muted" data-region="text"></p>
                            <button type="button" class="btn btn-primary btn-block" data-action="request-add-contact">
                                <span data-region="dialogue-button-text">Envoyer une demande de contact</span>
                                <span class="hidden" data-region="loading-icon-container"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</span>
                            </button>
                        </div>
                    </div>
                    <div class="hidden bg-secondary p-sm-3" data-region="content-messages-footer-require-unblock-container">
                        
                        <div class="p-3 bg-white">
                            <p class="text-muted" data-region="text">Vous avez bloqué cet utilisateur.</p>
                            <button type="button" class="btn btn-primary btn-block" data-action="request-unblock">
                                <span data-region="dialogue-button-text">Débloquer l'utilisateur</span>
                                <span class="hidden" data-region="loading-icon-container"><span class="loading-icon icon-no-margin"><i class="icon fa fa-circle-o-notch fa-spin fa-fw "  title="Chargement" aria-label="Chargement"></i></span>
</span>
                            </button>
                        </div>
                    </div>
                    <div class="hidden bg-secondary p-sm-3" data-region="content-messages-footer-unable-to-message">
                        
                        <div class="p-3 bg-white">
                            <p class="text-muted" data-region="text">Vous ne pouvez pas envoyer un message à cet utilisateur</p>
                        </div>
                    </div>
                    <div class="p-sm-2" data-region="placeholder-container">
                        <div class="d-flex">
                            <div class="bg-pulse-grey w-100" style="height: 80px"></div>
                            <div class="mx-2 mb-2 align-self-end bg-pulse-grey" style="height: 20px; width: 20px"></div>
                        </div>                    </div>
                    <div
                        class="hidden position-absolute"
                        data-region="confirm-dialogue-container"
                        style="top: -1px; bottom: 0; right: 0; left: 0; background: rgba(0,0,0,0.3);"
                    ></div>
                </div>                    <div data-region="view-overview" class="text-center">
                        <a href="https://moodle.ensta-bretagne.fr/message/index.php">
                            Tout afficher
                        </a>
                    </div>
            </div>
        </div>

</div>
    <div id="goto-top-link">
        <a class="btn btn-light" role="button" href="#">
            <i class="icon fa fa-arrow-up fa-fw "  title="Vers le haut de page" aria-label="Vers le haut de page"></i>
        </a>
    </div>
    <footer id="page-footer" class="py-3 bg-dark text-light">
        <div class="container">
            <div id="course-footer"></div>
    
    
            <div class="logininfo">Connecté sous le nom « <a href="https://moodle.ensta-bretagne.fr/user/profile.php?id=6567" title="Consulter le profil">Hugo PIQUARD</a> » (<a href="https://moodle.ensta-bretagne.fr/login/logout.php?sesskey=JsB6wBhkXh">Déconnexion</a>)</div>
            <div class="tool_usertours-resettourcontainer"></div>
            <div class="homelink"><a href="https://moodle.ensta-bretagne.fr/course/view.php?id=1498">Expérimentation (ROB)</a></div>
            <nav class="nav navbar-nav d-md-none" aria-label="Menu personnalisé">
                    <ul class="list-unstyled pt-3">
                                        <li><a href="#" title="Langue">Français ‎(fr)‎</a></li>
                                    <li>
                                        <ul class="list-unstyled ml-3">
                                                            <li><a href="https://moodle.ensta-bretagne.fr/mod/folder/view.php?id=42503&amp;lang=en" title="English ‎(en)‎">English ‎(en)‎</a></li>
                                                            <li><a href="https://moodle.ensta-bretagne.fr/mod/folder/view.php?id=42503&amp;lang=fr" title="Français ‎(fr)‎">Français ‎(fr)‎</a></li>
                                        </ul>
                                    </li>
                    </ul>
            </nav>
            <div class="tool_dataprivacy"><a href="https://moodle.ensta-bretagne.fr/admin/tool/dataprivacy/summary.php">Résumé de conservation de données</a></div><a href="https://download.moodle.org/mobile?version=2020061501.14&amp;lang=fr&amp;iosappid=633359593&amp;androidappid=com.moodle.moodlemobile">Obtenir l'app mobile</a>
            <script>
//<![CDATA[
var require = {
    baseUrl : 'https://moodle.ensta-bretagne.fr/lib/requirejs.php/1601274371/',
    // We only support AMD modules with an explicit define() statement.
    enforceDefine: true,
    skipDataMain: true,
    waitSeconds : 0,

    paths: {
        jquery: 'https://moodle.ensta-bretagne.fr/lib/javascript.php/1601274371/lib/jquery/jquery-3.4.1.min',
        jqueryui: 'https://moodle.ensta-bretagne.fr/lib/javascript.php/1601274371/lib/jquery/ui-1.12.1/jquery-ui.min',
        jqueryprivate: 'https://moodle.ensta-bretagne.fr/lib/javascript.php/1601274371/lib/requirejs/jquery-private'
    },

    // Custom jquery config map.
    map: {
      // '*' means all modules will get 'jqueryprivate'
      // for their 'jquery' dependency.
      '*': { jquery: 'jqueryprivate' },
      // Stub module for 'process'. This is a workaround for a bug in MathJax (see MDL-60458).
      '*': { process: 'core/first' },

      // 'jquery-private' wants the real jQuery module
      // though. If this line was not here, there would
      // be an unresolvable cyclic dependency.
      jqueryprivate: { jquery: 'jquery' }
    }
};

//]]>
</script>
<script src="https://moodle.ensta-bretagne.fr/lib/javascript.php/1601274371/lib/requirejs/require.min.js"></script>
<script>
//<![CDATA[
M.util.js_pending("core/first");require(['core/first'], function() {
require(['core/prefetch']);
;
require(["media_videojs/loader"], function(loader) {
    loader.setUp(function(videojs) {
        videojs.options.flash.swf = "https://moodle.ensta-bretagne.fr/media/player/videojs/videojs/video-js.swf";
videojs.addLanguage('fr', {
  "Audio Player": "Lecteur audio",
  "Video Player": "Lecteur vidéo",
  "Play": "Lecture",
  "Pause": "Pause",
  "Replay": "Revoir",
  "Current Time": "Temps actuel",
  "Duration": "Durée",
  "Remaining Time": "Temps restant",
  "Stream Type": "Type de flux",
  "LIVE": "EN DIRECT",
  "Loaded": "Chargé",
  "Progress": "Progression",
  "Progress Bar": "Barre de progression",
  "progress bar timing: currentTime={1} duration={2}": "{1} de {2}",
  "Fullscreen": "Plein écran",
  "Non-Fullscreen": "Fenêtré",
  "Mute": "Sourdine",
  "Unmute": "Son activé",
  "Playback Rate": "Vitesse de lecture",
  "Subtitles": "Sous-titres",
  "subtitles off": "Sous-titres désactivés",
  "Captions": "Sous-titres transcrits",
  "captions off": "Sous-titres transcrits désactivés",
  "Chapters": "Chapitres",
  "Descriptions": "Descriptions",
  "descriptions off": "descriptions désactivées",
  "Audio Track": "Piste audio",
  "Volume Level": "Niveau de volume",
  "You aborted the media playback": "Vous avez interrompu la lecture de la vidéo.",
  "A network error caused the media download to fail part-way.": "Une erreur de réseau a interrompu le téléchargement de la vidéo.",
  "The media could not be loaded, either because the server or network failed or because the format is not supported.": "Cette vidéo n'a pas pu être chargée, soit parce que le serveur ou le réseau a échoué ou parce que le format n'est pas reconnu.",
  "The media playback was aborted due to a corruption problem or because the media used features your browser did not support.": "La lecture de la vidéo a été interrompue à cause d'un problème de corruption ou parce que la vidéo utilise des fonctionnalités non prises en charge par votre navigateur.",
  "No compatible source was found for this media.": "Aucune source compatible n'a été trouvée pour cette vidéo.",
  "The media is encrypted and we do not have the keys to decrypt it.": "Le média est chiffré et nous n'avons pas les clés pour le déchiffrer.",
  "Play Video": "Lire la vidéo",
  "Close": "Fermer",
  "Close Modal Dialog": "Fermer la boîte de dialogue modale",
  "Modal Window": "Fenêtre modale",
  "This is a modal window": "Ceci est une fenêtre modale",
  "This modal can be closed by pressing the Escape key or activating the close button.": "Ce modal peut être fermé en appuyant sur la touche Échap ou activer le bouton de fermeture.",
  ", opens captions settings dialog": ", ouvrir les paramètres des sous-titres transcrits",
  ", opens subtitles settings dialog": ", ouvrir les paramètres des sous-titres",
  ", opens descriptions settings dialog": ", ouvrir les paramètres des descriptions",
  ", selected": ", sélectionné",
  "captions settings": "Paramètres des sous-titres transcrits",
  "subtitles settings": "Paramètres des sous-titres",
  "descriptions settings": "Paramètres des descriptions",
  "Text": "Texte",
  "White": "Blanc",
  "Black": "Noir",
  "Red": "Rouge",
  "Green": "Vert",
  "Blue": "Bleu",
  "Yellow": "Jaune",
  "Magenta": "Magenta",
  "Cyan": "Cyan",
  "Background": "Arrière-plan",
  "Window": "Fenêtre",
  "Transparent": "Transparent",
  "Semi-Transparent": "Semi-transparent",
  "Opaque": "Opaque",
  "Font Size": "Taille des caractères",
  "Text Edge Style": "Style des contours du texte",
  "None": "Aucun",
  "Raised": "Élevé",
  "Depressed": "Enfoncé",
  "Uniform": "Uniforme",
  "Dropshadow": "Ombre portée",
  "Font Family": "Famille de polices",
  "Proportional Sans-Serif": "Polices à chasse variable sans empattement (Proportional Sans-Serif)",
  "Monospace Sans-Serif": "Polices à chasse fixe sans empattement (Monospace Sans-Serif)",
  "Proportional Serif": "Polices à chasse variable avec empattement (Proportional Serif)",
  "Monospace Serif": "Polices à chasse fixe avec empattement (Monospace Serif)",
  "Casual": "Manuscrite",
  "Script": "Scripte",
  "Small Caps": "Petites capitales",
  "Reset": "Réinitialiser",
  "restore all settings to the default values": "Restaurer tous les paramètres aux valeurs par défaut",
  "Done": "Terminé",
  "Caption Settings Dialog": "Boîte de dialogue des paramètres des sous-titres transcrits",
  "Beginning of dialog window. Escape will cancel and close the window.": "Début de la fenêtre de dialogue. La touche d'échappement annulera et fermera la fenêtre.",
  "End of dialog window.": "Fin de la fenêtre de dialogue."
});

    });
});;
M.util.js_pending('block_navigation/navblock'); require(['block_navigation/navblock'], function(amd) {amd.init("11673"); M.util.js_complete('block_navigation/navblock');});;
M.util.js_pending('block_settings/settingsblock'); require(['block_settings/settingsblock'], function(amd) {amd.init("11674", null); M.util.js_complete('block_settings/settingsblock');});;

require(['jquery', 'core/custom_interaction_events'], function($, CustomEvents) {
    CustomEvents.define('#single_select5f76dd3f22e3a41', [CustomEvents.events.accessibleChange]);
    $('#single_select5f76dd3f22e3a41').on(CustomEvents.events.accessibleChange, function() {
        var ignore = $(this).find(':selected').attr('data-ignore');
        if (typeof ignore === typeof undefined) {
            $('#single_select_f5f76dd3f22e3a40').submit();
        }
    });
});
;

require(['jquery', 'message_popup/notification_popover_controller'], function($, controller) {
    var container = $('#nav-notification-popover-container');
    var controller = new controller(container);
    controller.registerEventListeners();
    controller.registerListNavigationEventListeners();
});
;

require(
[
    'jquery',
    'core_message/message_popover'
],
function(
    $,
    Popover
) {
    var toggle = $('#message-drawer-toggle-5f76dd3f334b65f76dd3f22e3a44');
    Popover.init(toggle);
});
;

        require(['jquery', 'core/custom_interaction_events'], function($, CustomEvents) {
            CustomEvents.define('#jump-to-activity', [CustomEvents.events.accessibleChange]);
            $('#jump-to-activity').on(CustomEvents.events.accessibleChange, function() {
                if (!$(this).val()) {
                    return false;
                }
                $('#url_select_f5f76dd3f22e3a53').submit();
            });
        });
    ;

require(['jquery', 'core_message/message_drawer'], function($, MessageDrawer) {
    var root = $('#message-drawer-5f76dd3f3668c5f76dd3f22e3a54');
    MessageDrawer.init(root, '5f76dd3f3668c5f76dd3f22e3a54', false);
});
;

require(['jquery', 'core/custom_interaction_events'], function($, CustomEvents) {
    CustomEvents.define('#single_select5f76dd3f22e3a56', [CustomEvents.events.accessibleChange]);
    $('#single_select5f76dd3f22e3a56').on(CustomEvents.events.accessibleChange, function() {
        var ignore = $(this).find(':selected').attr('data-ignore');
        if (typeof ignore === typeof undefined) {
            $('#single_select_f5f76dd3f22e3a55').submit();
        }
    });
});
;

M.util.js_pending('theme_boost/loader');
require(['theme_boost/loader'], function() {
    M.util.js_complete('theme_boost/loader');
});
;
M.util.js_pending('core/notification'); require(['core/notification'], function(amd) {amd.init(74188, [], true); M.util.js_complete('core/notification');});;
M.util.js_pending('core/log'); require(['core/log'], function(amd) {amd.setConfig({"level":"warn"}); M.util.js_complete('core/log');});;
M.util.js_pending('core/page_global'); require(['core/page_global'], function(amd) {amd.init(); M.util.js_complete('core/page_global');});M.util.js_complete("core/first");
});
//]]>
</script>
<script>
//<![CDATA[
M.yui.add_module({"mod_folder":{"name":"mod_folder","fullpath":"https:\/\/moodle.ensta-bretagne.fr\/lib\/javascript.php\/1601274371\/mod\/folder\/module.js","requires":[]}});

//]]>
</script>
<script>
//<![CDATA[
M.str = {"moodle":{"lastmodified":"Modifi\u00e9 le","name":"Nom","error":"Erreur","info":"Information","yes":"Oui","no":"Non","ok":"OK","viewallcourses":"Afficher tous les cours","cancel":"Annuler","confirm":"Confirmer","areyousure":"En \u00eates-vous bien s\u00fbr\u00a0?","closebuttontitle":"Fermer","unknownerror":"Erreur inconnue","file":"Fichier","url":"URL"},"repository":{"type":"Type","size":"Taille","invalidjson":"Cha\u00eene JSON non valide","nofilesattached":"Aucun fichier joint","filepicker":"S\u00e9lecteur de fichiers","logout":"D\u00e9connexion","nofilesavailable":"Aucun fichier disponible","norepositoriesavailable":"D\u00e9sol\u00e9, aucun de vos d\u00e9p\u00f4ts actuels ne peut retourner de fichiers dans le format requis.","fileexistsdialogheader":"Le fichier existe","fileexistsdialog_editor":"Un fichier de ce nom a d\u00e9j\u00e0 \u00e9t\u00e9 joint au texte que vous modifiez.","fileexistsdialog_filemanager":"Un fichier de ce nom a d\u00e9j\u00e0 \u00e9t\u00e9 joint","renameto":"Renommer \u00e0 \u00ab\u00a0{$a}\u00a0\u00bb","referencesexist":"Ce fichier est utilis\u00e9 comme source par {$a} alias.","select":"S\u00e9lectionnez"},"admin":{"confirmdeletecomments":"Voulez-vous vraiment supprimer des commentaires\u00a0?","confirmation":"Confirmation"},"debug":{"debuginfo":"Info de d\u00e9bogage","line":"Ligne","stacktrace":"Trace de la pile"},"langconfig":{"labelsep":"&nbsp;"}};
//]]>
</script>
<script>
//<![CDATA[
(function() {Y.use("moodle-filter_glossary-autolinker",function() {M.filter_glossary.init_filter_autolinking({"courseid":0});
});
Y.use("moodle-filter_mathjaxloader-loader",function() {M.filter_mathjaxloader.configure({"mathjaxconfig":"\nMathJax.Hub.Config({\n    config: [\"Accessible.js\", \"Safe.js\"],\n    errorSettings: { message: [\"!\"] },\n    skipStartupTypeset: true,\n    messageStyle: \"none\"\n});\n","lang":"fr"});
});
M.util.help_popups.setup(Y);
 M.util.js_pending('random5f76dd3f22e3a57'); Y.use('mod_folder', function(Y) { M.mod_folder.init_tree(Y, "folder_tree0", false);  M.util.js_complete('random5f76dd3f22e3a57'); });
 M.util.js_pending('random5f76dd3f22e3a59'); Y.on('domready', function() { M.util.js_complete("init");  M.util.js_complete('random5f76dd3f22e3a59'); });
})();
//]]>
</script>

        </div>
    </footer>
</div>

</body>
</html>