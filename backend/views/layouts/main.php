<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AppAsset;
use common\models\repositories\UserRepository;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use yii\helpers\Url;

AppAsset::register($this);

/* @var UserRepository $user */
$isAccountManager = false;
$user = Yii::$app->user->identity;
$authManager = Yii::$app->authManager;
$roles = Yii::$app->authManager->getRolesByUser($user->id);
if (array_key_exists('account-manager', $roles)) {
    $isAccountManager = true;
}

$isActiveClientMenuItem = ($this->context->route == "client/index") ? 'active' : '';
$isActiveOrderMenuItem = ($this->context->route == "order/index") ? 'active' : '';
$isActivePartnerMenuItem = ($this->context->route == "partner/index") ? 'active' : '';
$isActivePartnerBranchMenuItem = ($this->context->route == "partner-branch/index") ? 'active' : '';
$isActivePartnerBranchMapMenuItem = ($this->context->route == "partner-branch/map") ? 'active' : '';
$isActiveUserMenuItem = ($this->context->route == "user/index") ? 'active' : '';
$isActiveCategoryMenuItem = ($this->context->route == "category/index") ? 'active' : '';
$isActiveUserMenuItem = ($this->context->route == "user/index") ? 'active' : '';

/* @var UserRepository $user */
$user = Yii::$app->user->identity;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="<?= Url::to(['site/index']) ?>" class="nav-link">Главная (<?=$user->username ?>)</a>
            </li>
            <li class="nav-item">
                <a href="<?= Url::to(['site/logout']) ?>" data-method="post" class="nav-link">Выход</a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="<?= Url::to(['site/index']) ?>" class="brand-link">
            <span class="brand-text font-weight-light">Светофор Групп</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <li class="nav-header">Меню</li>
                    <li class="nav-item">
                        <a href="<?= Url::to(['client/index']) ?>"
                           class="nav-link <?php echo $isActiveClientMenuItem ?>">
                            <i class="nav-icon fa fa-users"></i>
                            <p>Клиенты</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Url::to(['order/index']) ?>" class="nav-link <?php echo $isActiveOrderMenuItem ?>">
                            <i class="nav-icon fa fa-shopping-cart"></i>
                            <p>Заказы</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Url::to(['partner/index']) ?>"
                           class="nav-link <?php echo $isActivePartnerMenuItem ?> ">
                            <i class="nav-icon fa fa-handshake"></i>
                            <p>Партнеры</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Url::to(['partner-branch/index']) ?>"
                           class="nav-link <?php echo $isActivePartnerBranchMenuItem ?>">
                            <i class="nav-icon fa fa-code-branch"></i>
                            <p>Филиалы партнеров</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= Url::to(['partner-branch/map']) ?>"
                           class="nav-link <?php echo $isActivePartnerBranchMapMenuItem ?>">
                            <i class="nav-icon fa fa-map-marker-alt"></i>
                            <p>Филиалы на карте</p>
                        </a>
                    </li>

                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Справочники
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: block;">
                            <li class="nav-item">
                                <a href="<?= Url::to(['category/index']) ?>"
                                   class="nav-link <?php echo $isActiveCategoryMenuItem ?>">
                                    <i class="nav-icon fa fa-file"></i>
                                    <p>Категории ВУ</p>
                                </a>
                            </li>
                            <?php if (!$isAccountManager) : ?>
                                <li class="nav-item">
                                    <a href="<?= Url::to(['user/index']) ?>"
                                       class="nav-link <?php echo $isActiveUserMenuItem ?>">
                                        <i class="nav-icon fa fa-id-card"></i>
                                        <p>Пользователи</p>
                                    </a>
                                </li>
                            <?php endif ?>
                        </ul>
                    </li>

                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <?= Breadcrumbs::widget([
                    'homeLink' => ['label' => 'Главная', 'url' => '/index.php'],
                    'links'    => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
                <?= Alert::widget() ?>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?= $content ?>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.0.5
        </div>
        <strong>Copyright &copy; <?= date('Y') ?></strong>
    </footer>

</div>
<!-- ./wrapper -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
