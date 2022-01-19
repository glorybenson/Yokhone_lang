<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"> <span></span>
                </li>
                <li class="{{ request()->is('home') || request()->is('edit-user/*') || request()->is('create-user')  ? 'active submenu active-now' : '' }}">
                    <a href="{{ route('home') }}"><i class="feather-home"></i>
                        <span class="shape1"></span><span class="shape2"></span>
                        <span>Users</span></a>
                </li>

                <li class="{{ request()->is('clients') || request()->is('edit-client/*') || request()->is('create-client')  ? 'active submenu active-now' : '' }}">
                    <a href="{{ route('clients') }}"><i class="feather-lock"></i>
                        <span class="shape1"></span><span class="shape2"></span>
                        <span> Clients</span></a>
                </li>

                <li class="{{ request()->is('farms') || request()->is('edit-farm/*') || request()->is('create-farm') || request()->is('trees') || request()->is('edit-tree/*') || request()->is('create-tree')  ? 'active submenu active-now' : '' }}">
                    <a href="#"><i class="feather-user-plus"></i>
                        <span class="shape1"></span><span class="shape2"></span> <span> Farm</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ request()->is('trees') || request()->is('edit-tree/*') || request()->is('create-tree')  ? 'active active-now' : '' }}" href="{{ route('trees') }}">Trees</a></li>
                        <li><a class="{{ request()->is('farms') || request()->is('edit-farm/*') || request()->is('create-farm')  ? 'active active-now' : '' }}" href="{{ route('farms') }}">Farm</a></li>
                    </ul>
                </li>


                <li class="{{ request()->is('employees') || request()->is('view-employees-salary/*') || request()->is('view-employee/*') || request()->is('edit-employee/*') || request()->is('create-employee')  ? 'active submenu active-now' : '' }}">
                    <a href="{{ route('employees') }}"><i class="feather-lock"></i>
                        <span class="shape1"></span><span class="shape2"></span>
                        <span> Employees</span></a>
                </li>

                <li class="{{ request()->is('invoices') || request()->is('create-invoice') || request()->is('edit-invoice/*') || request()->is('expenses') || request()->is('create-expense') || request()->is('edit-expense/*') ? 'active submenu active-now' : '' }}">
                    <a href="#"><i class="feather-user"></i>
                        <span class="shape1"></span><span class="shape2"></span>
                        <span> Finance</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ request()->is('expenses') || request()->is('create-expense') || request()->is('edit-expense/*') ? 'active active-now' : '' }}" href="{{ route('expenses') }}">Expenses</a></li>
                        <li><a class="{{ request()->is('invoices') || request()->is('create-invoice') || request()->is('edit-invoice/*') ? 'active active-now' : ''  }}" href="{{ route('invoices') }}">Invoices</a></li>
                    </ul>
                </li>

                <li class="">
                    <a href="#"><i class="feather-user"></i>
                        <span class="shape1"></span><span class="shape2"></span>
                        <span> Reports</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="">Expenses</a></li>
                        <li><a href="">Incomes</a></li>
                        <li><a href="">Employees</a></li>
                        <li><a href="">Farms</a></li>
                        <li><a href="">Trees</a></li>
                        <li><a href="">Clients</a></li>
                        <li><a href="">Login history</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</div>