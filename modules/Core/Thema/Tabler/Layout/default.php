<div class="page">
    <!-- Sidebar -->
    <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark">
                <a href="<?php echo site_url('/'); ?>">
                    <?php echo core_services_html()->getSiteName(); ?>
                </a>
            </h1>

            <?php /* ?>
            <!-- mobile profile /s -->
            <div class="navbar-nav flex-row d-lg-none">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                        <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>Paweł Kuna</div>
                            <div class="mt-1 small text-muted">UI Designer</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="#" class="dropdown-item">Status</a>
                        <a href="#" class="dropdown-item">Profile</a>
                        <a href="#" class="dropdown-item">Feedback</a>
                        <div class="dropdown-divider"></div>
                        <a href="./settings.html" class="dropdown-item">Settings</a>
                        <a href="./sign-in.html" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div>
            <!-- mobile profile /e -->
            <?php */ ?>

            <div class="collapse navbar-collapse" id="sidebar-menu">
                <ul class="navbar-nav pt-lg-3">
                    <?php
                    $navigation = core_services_navigation()->get();
                    foreach ($navigation as $depth1)
                    {
                        if (! isset($depth1['child']))
                        {
                            ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $depth1['active'] ? 'active' : ''; ?>" href="<?php echo $depth1['href']; ?>">
                            <span class="nav-link-title"><?php echo $depth1['name']; ?></span>
                        </a>
                    </li>
                            <?php
                        }
                        else
                        {
                            ?>
                    <li class="nav-item dropdown <?php echo $depth1['active'] ? 'active' : ''; ?>">
                        <a class="nav-link dropdown-toggle" href="" data-bs-toggle="dropdown" data-bs-auto-close="false" role="button" aria-expanded="false">
                            <span class="nav-link-title"><?php echo $depth1['name']; ?></span>
                        </a>
                        <div class="dropdown-menu <?php echo $depth1['active'] ? 'show' : ''; ?>">
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <?php
                                    foreach ($depth1['child'] as $depth2)
                                    {
                                        ?>
                                    <a class="dropdown-item <?php echo $depth2['active'] ? 'active' : ''; ?>" href="<?php echo $depth2['href']; ?>"><?php echo $depth2['name']; ?></a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </aside>

    <!-- Navbar -->
    <header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none">
        <div class="container-xl">
            <?php /* ?>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-nav flex-row order-md-last">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                        <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000m.jpg)"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>Paweł Kuna</div>
                            <div class="mt-1 small text-muted">UI Designer</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="#" class="dropdown-item">Status</a>
                        <a href="#" class="dropdown-item">Profile</a>
                        <a href="#" class="dropdown-item">Feedback</a>
                        <div class="dropdown-divider"></div>
                        <a href="./settings.html" class="dropdown-item">Settings</a>
                        <a href="./sign-in.html" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div>
            <?php */ ?>

            <div class="collapse navbar-collapse" id="navbar-menu">
                <div class="nav-item d-none d-md-flex me-3">
                    <div class="btn-list">
                        <a class="nav-link" href="<?php echo site_to('core_ratio_calculator'); ?>">비율 계산기</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl"><?php echo $page ?? ''; ?></div>
        </div>

        <footer class="footer footer-transparent d-print-none">
            <div class="container-xl">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-lg-auto ms-lg-auto">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                <a class="link-secondary" href="<?php echo site_to('core_ratio_calculator'); ?>">비율 계산기</a>
                            </li>

                            <li class="list-inline-item">
                                <a target="_blank" class="link-secondary" rel="noopener" href="https://discord.gg/dZFASsU">
                                    <!-- https://tabler.io/icons/icon/brand-discord -->
                                    <i class="ti ti-brand-discord"></i>
                                    Discord
                                </a>
                            </li>

                            <li class="list-inline-item">
                                <a target="_blank" class="link-secondary" rel="noopener" href="https://github.com/yks118/oha.gg.open">
                                    <!-- https://tabler.io/icons/icon/brand-github -->
                                    <i class="ti ti-brand-github"></i>
                                    Source Code
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Copyright &copy; <?php echo date('Y'); ?>
                                <a class="link-secondary" href="https://github.com/yks118">Yun KwangSeon</a>
                                /
                                Designed by <a class="link-secondary" href="https://tabler.io/admin-template">Tabler</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
