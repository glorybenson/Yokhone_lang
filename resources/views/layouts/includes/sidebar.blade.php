
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title"> <span></span>
                        </li>
                        <li class="{{ request()->is('home') || request()->is('edit-user/*') || request()->is('create-user')  ? 'active active-now' : '' }}">
                            <a href="{{ route('home') }}"><i class="feather-home"></i>
                                <span class="shape1"></span><span class="shape2"></span>
                                <span>Users</span></a>
                        </li>

                        <li>
                            <a href=""><i class="feather-lock"></i>
                                <span class="shape1"></span><span class="shape2"></span>
                                <span> Clients</span></a>
                        </li>

                        <li class="submenu">
                            <a href="#"><i class="feather-user-plus"></i>
                                <span class="shape1"></span><span class="shape2"></span> <span> Farm</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="./profile.html">Trees</a></li>
                                <li><a href="{{ route('farms') }}">Farm</a></li>
                            </ul>
                        </li>


                        <li class="{{ request()->is('employees') || request()->is('view-employees-salary/*') || request()->is('view-employee/*') || request()->is('edit-employee/*') || request()->is('create-employee')  ? 'active active-now' : '' }}">
                            <a href="{{ route('employees') }}"><i class="feather-lock"></i>
                                <span class="shape1"></span><span class="shape2"></span>
                                <span> Employees</span></a>
                        </li>

                        <li class="submenu">
                            <a href="#"><i class="feather-user"></i>                            
                            <span class="shape1"></span><span class="shape2"></span>
                                <span> Finance</span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="">Expenses</a></li>
                                <li><a href="">Invoices</a></li>
                            </ul>
                        </li>

                         <li class="submenu">
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