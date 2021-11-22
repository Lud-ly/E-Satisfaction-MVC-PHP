<nav class="navbar navbar-expand-lg">

        <div class="logo col-6 col-sm-5 col-md-4 col-lg-1 col-xl-1">
                <img src="<?php $variableCssCompagny->getCompagnyLogo(); ?>" width="50%">
        </div>
        <div class="d-lg-none col-6 d-flex align-items-center justify-content-center">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarNav">
                <div class="col-md-1"></div>
                <div class="col-md-12 col-lg-9">
                        <ul class="nav navbar-nav justify-content-center">
                                <li class="nav-item">
                                        <div class="nav-link">
                                                <div class="link d-flex justify-content-center">
                                                        <a class="nav-link" href="index.php?route=Feedback&action=index&idSurvey=30">
                                                                <div class="d-flex justify-content-center">
                                                                        <i class="fas fa-home fa-2x"></i>
                                                                </div>
                                                                <?= STRINGS["Accueil"] ?>
                                                        </a>
                                                </div>
                                        </div>
                                </li>
                                <li class="nav-item">
                                        <div class="nav-link">
                                                <div class="d-flex justify-content-center">
                                                        <a class="nav-link" href="index.php?route=Survey&action=index">
                                                                <div class="d-flex justify-content-center">
                                                                        <i class="fas fa-poll-h fa-2x"></i>
                                                                </div>
                                                                <?= STRINGS["Enquetes"] ?>
                                                        </a>
                                                </div>
                                        </div>
                                </li>
                                <li class="nav-item">
                                        <div class="nav-link">
                                                <div class="d-flex justify-content-center">
                                                        <a class="nav-link" href="index.php?route=Question&action=index">
                                                                <div class="d-flex justify-content-center">
                                                                        <i class="fas fa-question fa-2x"></i>
                                                                </div>
                                                                <?= STRINGS["Questions"] ?>
                                                        </a>
                                                </div>
                                        </div>
                                </li>
                                <li class="nav-item">
                                        <div class="nav-link">
                                                <div class="d-flex justify-content-center">
                                                        <a class="nav-link" href="index.php?route=Feedback&action=index&idSurvey=30&showResult=true">
                                                                <div class="d-flex justify-content-center">
                                                                        <i class="far fa-chart-bar fa-2x"></i>
                                                                </div>
                                                                <?= STRINGS["Statistiques"] ?>
                                                        </a>
                                                </div>
                                        </div>
                                </li>
                        </ul>
                </div>
                <div class="navbar-brand col-md-12 col-lg-1 d-flex justify-content-center">
                        <li style="list-style-type: none;" class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="<?= $_SESSION['dataUserLoginApps']['avatar'] ?>" width="50" height="50" class="rounded-circle img-thumbnail img-responsive">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right position-absolute p-0" aria-labelledby="navbarDropdown" style="color:var(--primary-color)">
                                        <?php if (count($_SESSION['dataUserLoginApps']['modules']) >= 2) : ?>
                                                <a class="dropdown-item py-2" href="<?= URL_LOGIN_APPS_API ?>">
                                                        <i class="fas fa-sync-alt text-muted mr-2"></i>
                                                        Modules
                                                </a>
                                        <?php endif; ?>
                                        <a href="?route=Logout&action=logout" class="dropdown-item py-2">
                                                <i class="fas fa-sign-out-alt text-muted mr-2"></i>
                                                Deconnexion
                                        </a>
                                </div>
                        </li>
                </div>
        </div>

</nav>