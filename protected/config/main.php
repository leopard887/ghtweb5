<?php

return array(
    'basePath'      => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name'          => 'GHTWEB v5',
    'sourceLanguage'=> '00',
    'language'      => 'ru',

    'aliases' => array(
        'app'       => 'application',
        'modules'   => 'application.modules',
        //'vendor' => '',
    ),

    //'basePath' => 'app',

	// preloading 'log' component
    'preload' => array('log'),

    'import' => array(
        'application.helpers.*',
        'application.models.*',
        'application.components.*',
    ),

    'modules' => array(

        'register',
        'login',
        'forgottenPassword',
        'news',
        'page',
        'cabinet',
        'index',
        'backend',
        'deposit',
        'stats',
        'gallery',
        'install',

    ),

    // application components
    'components' => array(

        'clientScript' => array(
            'scriptMap' => array(
                'jquery.js' => FALSE,
            ),
        ),

        'widgetFactory' => array(

            //'enableSkin' => TRUE,
            //'skinPath' => 'widgets',

            'widgets' => array(

                'CCaptcha' => array(
                    'clickableImage'    => TRUE,
                    'showRefreshButton' => FALSE,
                    'imageOptions'      => array(
                        'title' => Yii::t('main', 'Нажмите чтобы обновить'),
                    ),
                ),

                // Настройки для виджета пагинации
                'CLinkPager' => array(
                    'header'                => '',
                    'footer'                => '',
                    'hiddenPageCssClass'    => 'disabled',
                    'firstPageLabel'        => '&lt;&lt;',
                    'prevPageLabel'         => '&lt;',
                    'nextPageLabel'         => '&gt;',
                    'lastPageLabel'         => '&gt&gt',
                    'maxButtonCount'        => 7,
                    //'cssFile'             => '/css/pagination.css',
                    'id'                    => 'pagination',
                    'selectedPageCssClass'  => 'active',
                    'htmlOptions'           => array(
                        'class' => 'pagination pagination-sm',
                    )
                    //'internalPageCssClass' => '',
                ),

                // Настройки для виджета breadcrumb
                'CBreadcrumbs' => array(
                    'tagName'               => 'ul',
                    'separator'             => '',
                    'activeLinkTemplate'    => '<li><a href="{url}">{label}</a></li>',
                    'inactiveLinkTemplate'  => '<li>{label}</li>',
                    'htmlOptions'           => array(
                        'class' => 'breadcrumb',
                    ),
                ),
            ),
        ),

        'notify' => array(
            'class' => 'Notify',
        ),

        'config' => array(
            'class' => 'DbConfig',
        ),

        'cache' => array(
            'class' => 'system.caching.CFileCache',
        ),

        'user' => array(
            'class'             => 'WebUser',
            'allowAutoLogin'    => TRUE,
            'autoRenewCookie'   => TRUE,
            'loginUrl'          => array('/login/default/index'),
        ),

        'authManager' => array(
            'class'         => 'CDbAuthManager',
            'connectionId'  => 'db',
        ),

        'securityManager' => array(
            'cryptAlgorithm'    => array('rijndael-256', '', 'ofb', ''),
            'encryptionKey'     => 'kcwUC@CHuc1y78nC17yg',
        ),

        'request' => array(
            'enableCsrfValidation'  => TRUE,
            'csrfTokenName'         => 'GHTWEB_CSRF_TOKEN',
        ),

        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => FALSE,
            'urlSuffix' => '/',
            'rules' => array(

                // ------------------- [Frontend] -------------------
                '' => 'index/default/index',

                // Deposit (обработка платежа)
                'deposit/result' => 'deposit/default/index',

                // Статические страницы
                'page/<page_name:[a-z0-9-_]+>' => 'page/default/index',

                // Новости
                'news' => 'news/default/index',
                'news/<news_id:\d+>' => 'news/default/detail',

                // Регистрация
                'register' => 'register/default/index',
                'register/<_hash:\w{32}>' => 'register/default/activated',

                // Авторизация
                'login' => 'login/default/index',

                // Восстановление пароля
                'forgotten-password' => 'forgottenPassword/default/index',
                'forgotten-password/<hash:\w{32}>' => 'forgottenPassword/default/step2',

                // Deposit
                'cabinet/deposit' => 'cabinet/deposit/index',
                'cabinet/deposit/processed' => 'cabinet/deposit/processed',
                'deposit/<action:(result|success|fail)>' => 'deposit/default/<action>',
                'cabinet/deposit/sms-list' => 'cabinet/deposit/getSmsNumberList',

                // Logout
                'logout' => 'cabinet/default/logout',


                // Статистика
                'stats/<gs_id:\d+>/<type:([a-z\-]+)>/<clan_id:\w+>' => 'stats/default/index',
                'stats/<gs_id:\d+>/<type:\w+>' => 'stats/default/index',
                'stats/<gs_id:\d+>' => 'stats/default/index',
                'stats' => 'stats/default/index',


                // Cabinet
                'cabinet' => 'cabinet/default/index',

                // Персонажи
                'cabinet/characters' => 'cabinet/characters/index',
                'cabinet/characters/<char_id:([0-9]+)>/<action:(view|teleport)>' => 'cabinet/characters/<action>',

                // Смена пароля от аккаунта
                'cabinet/change-password' => 'cabinet/changePassword/index',

                // Безопасность
                'cabinet/security' => 'cabinet/security/index',

                // Рефералы
                'cabinet/referals' => 'cabinet/referals/index',

                // История платежей
                'cabinet/transaction-history' => 'cabinet/transactionHistory/index',

                // История авторизаций
                'cabinet/auth-history' => 'cabinet/authHistory/index',

                // Магазин
                'cabinet/shop' => 'cabinet/shop/index',
                'cabinet/shop/<category_link:([a-zA-Z0-9\-]+)>' => 'cabinet/shop/category',
                'cabinet/shop/<category_link:([a-zA-Z0-9\-]+)>/buy' => 'cabinet/shop/buy',

                // Тикеты
                'cabinet/tickets' => 'cabinet/tickets/index',
                'cabinet/tickets/add' => 'cabinet/tickets/add',
                'cabinet/tickets/<ticket_id:\d+>/<action:(view|close)>' => 'cabinet/tickets/<action>',

                // Услуги
                'cabinet/services' => 'cabinet/services/index',
                'cabinet/services/premium' => 'cabinet/services/premium',
                'cabinet/services/remove-hwid' => 'cabinet/services/removeHwid',
                /*'cabinet/services/change-char-name' => 'cabinet/services/changeCharName',
                'cabinet/services/change-gender' => 'cabinet/services/changeGender',*/

                // Бонусы
                'cabinet/bonuses' => 'cabinet/bonuses/index',
                'cabinet/bonuses/bonus-code' => 'cabinet/bonuses/bonusCode',
                'cabinet/bonuses/<bonus_id:\d+>/<action:(activation)>' => 'cabinet/bonuses/<action>',

                // Личные сообщения
                'cabinet/messages' => 'cabinet/messages/index',
                'cabinet/messages/<id:\d+>/detail' => 'cabinet/messages/detail',

                // Галерея
                'gallery' => 'gallery/default/index',




                // ------------------- [Backend] -------------------
                'backend' => 'backend/default/index',

                // Очистка кэша
                'backend/clear-cache' => 'backend/default/clearCache',

                // Обновление CMS
                'backend/update' => 'backend/default/update',

                // Обновление миграций
                'backend/update-tables' => 'backend/default/updateTables',

                // Инфа о item
                'backend/get-item-info' => 'backend/default/getItemInfo',

                // Игровые сервера
                'backend/game-servers' => 'backend/gameServers/index',
                'backend/game-servers/<gs_id:\d+>/edit' => 'backend/gameServers/form',
                'backend/game-servers/add' => 'backend/gameServers/form',
                'backend/game-servers/<gs_id:\d+>/<action:(del|allow)>' => 'backend/gameServers/<action>',

                // Магазин
                'backend/game-servers/<gs_id:\d+>/shop' => 'backend/gameServers/shop',
                'backend/game-servers/<gs_id:\d+>/shop/category/<category_id:\d+>/edit' => 'backend/gameServers/shopCategoryForm',
                'backend/game-servers/<gs_id:\d+>/shop/category/add' => 'backend/gameServers/shopCategoryForm',
                'backend/game-servers/<gs_id:\d+>/shop/category/<category_id:\d+>/allow' => 'backend/gameServers/shopCategoryAllow',
                'backend/game-servers/<gs_id:\d+>/shop/category/<category_id:\d+>/del' => 'backend/gameServers/shopCategoryDel',
                'backend/game-servers/<gs_id:\d+>/shop/category/<category_id:\d+>/packs' => 'backend/gameServers/shopCategoryPacks',
                'backend/game-servers/<gs_id:\d+>/shop/category/<category_id:\d+>/pack/add' => 'backend/gameServers/shopCategoryPacksForm',
                'backend/game-servers/<gs_id:\d+>/shop/category/<category_id:\d+>/pack/<pack_id:\d+>/items' => 'backend/gameServers/shopCategoryPackItems',
                'backend/game-servers/<gs_id:\d+>/shop/category/<category_id:\d+>/pack/<pack_id:\d+>/create-item' => 'backend/gameServers/shopCategoryPackCreateItem',
                'backend/game-servers/<gs_id:\d+>/shop/category/<category_id:\d+>/pack/<pack_id:\d+>/item/<item_id:\d+>/edit' => 'backend/gameServers/shopCategoryPackEditItem',
                'backend/game-servers/<gs_id:\d+>/shop/category/<category_id:\d+>/pack/<pack_id:\d+>/item/<item_id:\d+>/del' => 'backend/gameServers/shopCategoryPackDelItem',
                'backend/game-servers/<gs_id:\d+>/shop/category/<category_id:\d+>/pack/<pack_id:\d+>/edit' => 'backend/gameServers/shopCategoryPacksForm',

                'backend/game-servers/<gs_id:\d+>/shop/category/<category_id:\d+>/pack/<pack_id:\d+>/allow' => 'backend/gameServers/shopCategoryPackAllow',
                'backend/game-servers/<gs_id:\d+>/shop/category/<category_id:\d+>/pack/<pack_id:\d+>/del-img' => 'backend/gameServers/shopCategoryPackDelImage',
                'backend/game-servers/<gs_id:\d+>/shop/category/<category_id:\d+>/pack/<pack_id:\d+>/del' => 'backend/gameServers/shopCategoryPackDel',


                // Логин сервера
                'backend/login-servers' => 'backend/loginServers/index',
                'backend/login-servers/<ls_id:\d+>/edit' => 'backend/loginServers/form',
                'backend/login-servers/add' => 'backend/loginServers/form',
                'backend/login-servers/<ls_id:\d+>/<action:(del|allow|accounts)>' => 'backend/loginServers/<action>',

                // Игровые аккаунты на логине
                //'backend/login-servers/<ls_id:\d+>/<action:(edit|del|shop)>' => 'backend/loginServers/<action>',

                // Юзеры
                'backend/users' => 'backend/users/index',
                'backend/users/add' => 'backend/users/add',
                'backend/users/<user_id:\d+>/<action:(view|referals)>' => 'backend/users/<action>',
                'backend/users/<user_id:\d+>/auth-history' => 'backend/users/authHistory',
                'backend/users/<user_id:\d+>/delete-bonus/<bonus_id:\d+>' => 'backend/users/delBonus',
                'backend/users/<user_id:\d+>/add-bonus/' => 'backend/users/addBonus',
                'backend/users/<user_id:\d+>/add-message/' => 'backend/users/addMessage',
                'backend/users/<user_id:\d+>/item-purchase/' => 'backend/users/itemPurchaseLog',
                'backend/users/<user_id:\d+>/transaction-history/' => 'backend/users/transactionHistory',
                'backend/users/<user_id:\d+>/edit-data/' => 'backend/users/editData',

                // Transactions
                //'backend/transactions/user/<user_id:\d+>' => 'backend/transactions/index',

                // Бонусы
                'backend/bonuses/<bonus_id:\d+>/items' => 'backend/bonuses/items',
                'backend/bonuses/<bonus_id:\d+>/create-item' => 'backend/bonuses/itemAdd',
                'backend/bonuses/<bonus_id:\d+>/item/<item_id:\d+>/edit' => 'backend/bonuses/itemEdit',
                'backend/bonuses/<bonus_id:\d+>/item/<item_id:\d+>/del' => 'backend/bonuses/itemDel',
                'backend/bonuses/<bonus_id:\d+>/item/<item_id:\d+>/allow' => 'backend/bonuses/itemAllow',
                'backend/bonuses/generate-code' => 'backend/bonuses/generateCode',

                'backend/bonuses/codes/add' => 'backend/bonuses/codeAdd',
                'backend/bonuses/codes/<code_id:\d+>/allow' => 'backend/bonuses/codeAllow',
                'backend/bonuses/codes/<code_id:\d+>/edit' => 'backend/bonuses/codeEdit',
                'backend/bonuses/codes/<code_id:\d+>/add' => 'backend/bonuses/codeAdd',
                'backend/bonuses/codes/<code_id:\d+>/del' => 'backend/bonuses/codeDel',

                // Тикеты
                'backend/tickets/<id:\d+>/edit' => 'backend/tickets/edit',
                'backend/tickets/categories/<category_id:\d+>/edit' => 'backend/tickets/categoryForm',
                'backend/tickets/categories/<category_id:\d+>/del' => 'backend/tickets/categoryDel',
                'backend/tickets/categories/<category_id:\d+>/allow' => 'backend/tickets/categoryAllow',
                'backend/tickets/categories/add' => 'backend/tickets/categoryForm',

                // Общие правила
                'backend/<controller:\w+>' => 'backend/<controller>/index',
                'backend/<controller:\w+>/<id:\d+>/edit' => 'backend/<controller>/form',
                'backend/<controller:\w+>/add' => 'backend/<controller>/form',
                'backend/<controller:\w+>/<id:\d+>/<method:(del|allow)>' => 'backend/<controller>/<method>',
                //'backend/<controller:\w+>/<method:(del|edit|allow)>' => 'backend/<controller>/<method>',
            ),
        ),

        // DB
        'db' => require 'database.php',

        'errorHandler' => array(
            'errorAction' => 'index/default/error',
        ),

        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'info, error, warning, vardump',
                ),
                array(
                    'class' => 'CWebLogRoute',
                    'levels' => 'error, warning, trace, notice',
                    'categories' => 'application',
                    'enabled' => FALSE,
                ),
                array(
                    'class' => 'CProfileLogRoute',
                    'levels' => 'profile',
                    'enabled' => FALSE,
                ),
            ),
        ),
    ),

    'params' => array(

        // $_GET параметр отвечающий за реферала
        'cookie_referer_name' => 'ref_id',

        // Версии серверов
        'server_versions' => array(
            'Lucera2'       => 'Lucera 2', // http://lucera2.ru
            'Emurt_hf'      => 'emurt HF', // http://emurt.ru/index.php
            'OpenTeam_hf'   => 'OpenTeam HF',
            'L2_dev_hf'     => 'L2 DeV HF', // http://dev.lineage-2.me/
            'R2_core_ep'    => 'R2Core Epilogue', // http://r2core.ru/
            'L2j_server_hf' => 'L2J Server HF', // http://www.l2jserver.com/
            'PainTeamIt'    => 'Pain Team Interlude', // http://pain-team.ru/
        ),

        // Папка куда кидаются картинки
        'uploadPath' => 'uploads',

        // Логирование действий юзера (лучше не включать, создаётся доп. нагрузка на БД)
        'user_actions_log' => FALSE,

        // Типы форумов
        'forum_types' => array('ipb', 'phpbb', 'smf', 'vanilla', 'vBulletin', 'xenForo'),

        // Типы валют
        'currency_symbols' => array(
            'RUB' => Yii::t('main', 'Рубли'),
            'EUR' => Yii::t('main', 'Евро'),
            'USD' => Yii::t('main', 'Доллары'),
        ),

    ),
);
