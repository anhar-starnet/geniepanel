<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="{{ route('dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light">
            <b>Genie</b>Panel
        </span>
    </a>

    <div class="sidebar">

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">MASTER DATA</li>

                <li class="nav-item">
                    <a href="{{ route('customers.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Customer</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('packages.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-wifi"></i>
                        <p>Paket Internet</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('onts.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-broadcast-tower"></i>
                        <p>ONT</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('areas.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-map-marked-alt"></i>
                        <p>Area</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pops.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-network-wired"></i>
                        <p>POP</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('odps.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-project-diagram"></i>
                        <p>ODP</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('splitters.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-code-branch"></i>
                        <p>Splitter</p>
                    </a>
                </li>

                <li class="nav-header">GENIEACS</li>

                <li class="nav-item">
                    <a href="{{ route('genieacs.devices.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-server"></i>
                        <p>GenieACS Devices</p>
                    </a>
                </li>

                <li class="nav-header">MONITORING</li>

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>Dashboard NOC</p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>

</aside>
