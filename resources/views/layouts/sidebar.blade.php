        <!-- Sidebar menu-->
        <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
        <aside class="app-sidebar">
          <div class="app-sidebar__user">
            <img class="app-sidebar__user-avatar" src="{{ asset('images/user.png') }}" alt="User Image" height="40" width="40">
            <div>
              <p class="app-sidebar__user-name">{{ Auth::user()->nombre }}</p>
              <p class="app-sidebar__user-designation">{{ Auth::user()->role->nombre }}</p>
            </div>
          </div>
          <ul class="app-menu">
            @if( Auth::user()->can('admin') )
            <li>
              <a class="app-menu__item {{ Request::is('admin/usuario**') ? 'active' : '' }}" href="/admin/usuarios">
                <i class="app-menu__icon fa fa-user fa-lg"></i>
                <span class="app-menu__label">Usuarios</span>
              </a>
            </li>
            <li>
                <a class="app-menu__item {{ Request::is('medico**') ? 'active' : '' }}" href="/admin/medicos">
                    <i class="app-menu__icon fa fa-user-md fa-lg"></i>
                    <span class="app-menu__label">Médicos</span>
                </a>
            </li>
            @endif
            @if( Auth::user()->can('recepcionista') )
            <li>
              <a class="app-menu__item {{ Request::is('paciente**') ? 'active' : '' }}" href="/pacientes">
                <i class="app-menu__icon fa fa-heart"></i>
                <span class="app-menu__label">Pacientes</span>
              </a>
            </li>
            @endif
            @if( Auth::user()->can('medico') )
            <li>
              <a class="app-menu__item {{ Request::is('turno') ? 'active' : '' }}" href="/turnos">
                <i class="app-menu__icon fa fa-calendar fa-lg"></i>
                <span class="app-menu__label">Turnos</span>
              </a>
            </li>
            @endif
            {{-- 
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Pages</span><i class="treeview-indicator fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a class="treeview-item" href="blank-page.html"><i class="icon fa fa-circle-o"></i> Blank Page</a></li>
                <li><a class="treeview-item" href="page-login.html"><i class="icon fa fa-circle-o"></i> Login Page</a></li>
                <li><a class="treeview-item" href="page-lockscreen.html"><i class="icon fa fa-circle-o"></i> Lockscreen Page</a></li>
                <li><a class="treeview-item" href="page-user.html"><i class="icon fa fa-circle-o"></i> User Page</a></li>
                <li><a class="treeview-item" href="page-invoice.html"><i class="icon fa fa-circle-o"></i> Invoice Page</a></li>
                <li><a class="treeview-item" href="page-calendar.html"><i class="icon fa fa-circle-o"></i> Calendar Page</a></li>
                <li><a class="treeview-item" href="page-mailbox.html"><i class="icon fa fa-circle-o"></i> Mailbox</a></li>
                <li><a class="treeview-item" href="page-error.html"><i class="icon fa fa-circle-o"></i> Error Page</a></li>
              </ul>
            </li>
            --}}
          </ul>
        </aside>
