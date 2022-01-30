<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title"> <span></span>
                </li>
                @if(in_array(1, Auth::user()->roles) || in_array(2, Auth::user()->roles))
                <li class="{{ request()->is('home') || request()->is('edit-user/*') || request()->is('create-user')  ? 'active active-now' : '' }}">
                    <a href="{{ route('home') }}"><i class="feather-home"></i>
                        <span class="shape1"></span><span class="shape2"></span>
                        <span>Users</span></a>
                </li>
                @endif

                @if(in_array(1, Auth::user()->roles) || in_array(3, Auth::user()->roles))
                <li class="{{ request()->is('clients') || request()->is('edit-client/*') || request()->is('create-client')  ? 'active active-now' : '' }}">
                    <a href="{{ route('clients') }}"><i class="feather-lock"></i>
                        <span class="shape1"></span><span class="shape2"></span>
                        <span> Clients</span></a>
                </li>
                @endif

                @if(in_array(1, Auth::user()->roles) || in_array(4, Auth::user()->roles))
                <li class="{{ request()->is('farms') || request()->is('edit-farm/*') || request()->is('create-farm') || request()->is('trees') || request()->is('edit-tree/*') || request()->is('create-tree') || request()->is('crops') || request()->is('edit-crop/*') || request()->is('create-crop')  ? 'active active-now' : '' }}">
                    <a href="#"><i class="feather-user-plus"></i>
                        <span class="shape1"></span><span class="shape2"></span> <span> Farm</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ request()->is('farms') || request()->is('edit-farm/*') || request()->is('create-farm')  ? 'active' : '' }}" href="{{ route('farms') }}">Farm</a></li>
                        <li><a class="{{ request()->is('trees') || request()->is('edit-tree/*') || request()->is('create-tree')  ? 'active' : '' }}" href="{{ route('trees') }}">Trees</a></li>
                        <li><a class="{{ request()->is('crops') || request()->is('edit-crop/*') || request()->is('create-crop')  ? 'active' : '' }}" href="{{ route('crops') }}">Crops</a></li>
                    </ul>
                </li>
                @endif


                @if(in_array(1, Auth::user()->roles) || in_array(5, Auth::user()->roles))
                <li class="{{ request()->is('employees') || request()->is('view-employees-salary/*') || request()->is('view-employee/*') || request()->is('edit-employee/*') || request()->is('create-employee')  ? 'active active-now' : '' }}">
                    <a href="{{ route('employees') }}"><i class="feather-lock"></i>
                        <span class="shape1"></span><span class="shape2"></span>
                        <span> Employees</span></a>
                </li>
                
                <li class="{{ request()->is('employees') || request()->is('view-employees-salary/*') || request()->is('view-employee/*') || request()->is('edit-employee/*') || request()->is('create-employee')  ? 'active active-now' : '' }}">
                    <a href="#"><i class="feather-user"></i>
                        <span class="shape1"></span><span class="shape2"></span>
                        <span> Employees</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ request()->is('employees') || request()->is('view-employees-salary/*') || request()->is('view-employee/*') || request()->is('edit-employee/*') || request()->is('create-employee') ? 'active active-now' : '' }}" href="{{ route('expenses') }}">Employees</a></li>
                        <li><a class="{{ request()->is('employees') || request()->is('view-employees-salary/*') || request()->is('view-employee/*') || request()->is('edit-employee/*') || request()->is('create-employee') ? 'active active-now' : '' }}" href="{{ route('expenses') }}">Employee Record</a></li>
                        <li><a class="{{ request()->is('invoices') || request()->is('create-invoice') || request()->is('edit-invoice/*') ? 'active active-now' : ''  }}" href="{{ route('invoices') }}">Payment</a></li>
                    </ul>
                </li>
                @endif


                @if(in_array(1, Auth::user()->roles) || in_array(6, Auth::user()->roles))
                <li class="{{ request()->is('invoices') || request()->is('create-invoice') || request()->is('edit-invoice/*') || request()->is('expenses') || request()->is('create-expense') || request()->is('edit-expense/*') ? 'active active-now' : '' }}">
                    <a href="#"><i class="feather-user"></i>
                        <span class="shape1"></span><span class="shape2"></span>
                        <span> Finance</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ request()->is('expenses') || request()->is('create-expense') || request()->is('edit-expense/*') ? 'active active-now' : '' }}" href="{{ route('expenses') }}">Expenses</a></li>
                        <li><a class="{{ request()->is('invoices') || request()->is('create-invoice') || request()->is('edit-invoice/*') ? 'active active-now' : ''  }}" href="{{ route('invoices') }}">Invoices</a></li>
                    </ul>
                </li>
                @endif


                @if(in_array(1, Auth::user()->roles))
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
                @endif


            </ul>
        </div>
    </div>
</div>