<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.php"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li <?php if ($paginaAtiva == 'Dashboard') { echo ' class="sidebar-item active"'; } ?> class="sidebar-item">
                    <a href="dashboard.php" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <!-- <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Components</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="component-alert.html">Alert</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-badge.html">Badge</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-breadcrumb.html">Breadcrumb</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-button.html">Button</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-card.html">Card</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-carousel.html">Carousel</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-dropdown.html">Dropdown</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-list-group.html">List Group</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-modal.html">Modal</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-navs.html">Navs</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-pagination.html">Pagination</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-progress.html">Progress</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-spinner.html">Spinner</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="component-tooltip.html">Tooltip</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>Extra Components</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="extra-component-avatar.html">Avatar</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="extra-component-sweetalert.html">Sweet Alert</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="extra-component-toastify.html">Toastify</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="extra-component-rating.html">Rating</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="extra-component-divider.html">Divider</a>
                        </li>
                    </ul>
                </li> -->

                <li class="sidebar-title">Gestão de Díaria</li>

                <li <?php if ($paginaAtiva == 'Solicitar-Diaria') { echo ' class="sidebar-item active"'; } ?> class="sidebar-item  ">
                    <a href="planilha_diarias.php" class='sidebar-link'>
                        <i class="bi bi-chat-square-text"></i>
                        <span>Solicitar Díarias</span>
                    </a>
                </li>

                <li <?php if ($paginaAtiva == 'Cadastrar-Diaria') { echo ' class="sidebar-item active"'; } ?> class="sidebar-item  ">
                    <a href="cadastrar-diaria.php" class='sidebar-link'>
                        <i class="bi bi-app-indicator"></i>
                        <span>Cadastrar Díaria</span>
                    </a>
                </li>

                <li <?php if ($paginaAtiva == 'Planilha_Diaria') { echo ' class="sidebar-item active"'; } ?> class="sidebar-item  ">
                    <a href="planilha_diarias.php" class='sidebar-link'>
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                        <span>Planilha de Díarias</span>
                    </a>
                </li>


                <li class="sidebar-title">Power Bi - Patio</li>

                <li class="sidebar-item  ">
                    <a href="form-layout.html" class='sidebar-link'>
                        <i class="bi bi-speedometer2"></i>
                        <span>Devolução de Vazio</span>
                    </a>
                </li>


                <li class="sidebar-item  ">
                    <a href="table-datatable.html" class='sidebar-link'>
                        <i class="bi bi-speedometer2"></i>
                        <span>Controlador Patio</span>
                    </a>
                </li>

                <li class="sidebar-title">Administradores</li>

                <li class="sidebar-item  ">
                    <a href="form-layout.html" class='sidebar-link'>
                        <i class="bi bi-people"></i>
                        <span>Controle de Usuarios</span>
                    </a>
                </li>

                <li <?php if ($paginaAtiva == 'Aprovar-Diaria') { echo ' class="sidebar-item active"'; } ?> class="sidebar-item  ">
                    <a href="planilha_diarias.php" class='sidebar-link'>
                        <i class="bi bi-check2-all"></i>
                        <span>Aprovação de Diaria</span>
                    </a>
                </li>

                <li class="sidebar-title">Pages</li>


                <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-x-octagon-fill"></i>
                        <span>Errors</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="error-403.html">403</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="error-404.html">404</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="error-500.html">500</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>

