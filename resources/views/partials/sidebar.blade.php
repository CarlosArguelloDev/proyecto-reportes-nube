<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <img src="{{ asset('storage/icon.png') }}" width="40px" alt="logo">
            </a>
        </div>
    

        <div class="navbar-content">
    <ul class="pc-navbar">
        <li class="pc-item">
            <a href="" class="pc-link">
                <span class="pc-micon"><i class="ti ti-braces"></i></span>
                <span class="pc-mtext">Proyecto Nube Swarm - jenkins</span>
            </a>
        </li>
        <li class="pc-item pc-caption">
            <label>Mis informes</label>
            <i class="ti ti-dashboard"></i>
        </li>
        <li class="pc-item">
            <a href="{{ route('reportes.mis') }}" class="pc-link">
                <span class="pc-micon"><i class="ti ti-report-analytics"></i></span>
                <span class="pc-mtext">Mis Reportes</span>
            </a>
        </li>
        <li class="pc-item pc-caption">
            <label>Secciones</label>
            <i class="ti ti-dashboard"></i>
        </li>
        <li class="pc-item">
            <a href="{{ route('reportes.index') }}" class="pc-link">
                <span class="pc-micon"><i class="ti ti-report"></i></span>
                <span class="pc-mtext">Reportes</span>
            </a>
        </li>
        <li class="pc-item">
            <a href="{{ route('zonas.index') }}" class="pc-link">
                <span class="pc-micon"><i class="ti ti-map-2"></i></span>
                <span class="pc-mtext">Zonas</span>
            </a>
        </li>
        <li class="pc-item">
            <a href="{{ route('reportes.atendidos') }}" class="pc-link">
                <span class="pc-micon"><i class="ti ti-circle-check"></i></span>
                <span class="pc-mtext">Reportes Atendidos</span>
            </a>
        </li>
        <li class="pc-item">
            <a href="" class="pc-link">
                <span class="pc-micon"><i class="ti ti-database-export"></i></span>
                <span class="pc-mtext">Exportar datos</span>
            </a>
        </li>
        <li class="pc-item">
            <a href="" class="pc-link">
                <span class="pc-micon"><i class="ti ti-heart"></i></span>
                <span class="pc-mtext">Acerca de</span>
            </a>
        </li>

    </ul>

</div>
    </div>
</nav>