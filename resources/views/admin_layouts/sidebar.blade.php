<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>@lang('translation.main_menu')</span>
                </li>


                @if (Auth()->user()->role == 'admin')
                    <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ url('admin/dashboard') }}"><i class="feather-grid"></i> <span>
                                @lang('translation.dashboard')</span></a>

                    </li>
                    <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                        <a href="{{ url('admin/users') }}"><i class='bx bxs-user'></i> <span> User Management</span></a>

                    </li>
                @endif


                <li class="submenu {{ request()->is('admin/cms*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-book"></i> <span> @lang('translation.cms')</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{ url('admin/cms/announcements') }}"
                                class="{{ request()->is('admin/cms/announcements') ? 'active' : '' }}">Announcements</a>
                        </li>
                        <li><a href="{{ url('admin/cms/admission-inquiry') }}"
                                class="{{ request()->is('admin/cms/admission-inquiry') ? 'active' : '' }}">Admission
                                Inquiry</a></li>
                        <li><a href="{{ url('admin/cms/contact-us') }}"
                                class="{{ request()->is('admin/cms/contact-us') ? 'active' : '' }}">Contact Us</a></li>
                        <li><a href="{{ url('admin/cms/teachers') }}"
                                class="{{ request()->is('admin/cms/teachers') ? 'active' : '' }}">Teachers</a></li>
                        <li><a href="{{ url('admin/cms/blogs') }}"
                                class="{{ request()->is('admin/cms/blogs') ? 'active' : '' }}">Blogs</a></li>

                    </ul>
                </li>

                @if (Auth()->user()->role == 'admin')
                    <li class="submenu {{ request()->is('admin/students*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-graduation-cap"></i> <span> Students</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/students') }}"
                                    class="{{ request()->is('admin/students') ? 'active' : '' }}">Student List</a></li>
                            <li><a href="{{ url('admin/students/add') }}"
                                    class="{{ request()->is('admin/students/add') ? 'active' : '' }}">Add New
                                    Student</a>
                            </li>

                        </ul>
                    </li>
                    <li class="submenu {{ request()->is('admin/teachers*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Teachers</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/teachers') }}"
                                    class="{{ request()->is('admin/teachers') ? 'active' : '' }}">Teacher List</a></li>
                            <li><a href="{{ url('admin/teachers/add') }}"
                                    class="{{ request()->is('admin/teachers/add') ? 'active' : '' }}">Add Teacher</a>
                            </li>

                        </ul>
                    </li>
                    <li class="submenu  {{ request()->is('admin/school-classes*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-building"></i> <span> Classes</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/school-classes') }}"
                                    class="{{ request()->is('admin/school-classes') ? 'active' : '' }}">Class List</a>
                            </li>
                            <li><a href="{{ url('admin/school-classes/class-time-table/create') }}"
                                    class="{{ request()->is('admin/school-classes/class-time-table/create') ? 'active' : '' }}">Create
                                    Class Time-Table</a></li>
                        </ul>
                    </li>
                    <li class="submenu {{ request()->is('admin/accounts*') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-file-invoice-dollar"></i> <span> Accounts</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/accounts/admission/create') }}"
                                    class="{{ request()->is('admin/accounts/admission/create') ? 'active' : '' }}">Student
                                    Admission</a></li>
                            <li><a href="{{ url('admin/accounts/admission') }}"
                                    class="{{ request()->is('admin/accounts/admission') ? 'active' : '' }}">Admission
                                    Payment</a></li>
                            <li><a href="{{ url('admin/accounts/student-monthly-fees-payments') }}"
                                    class="{{ request()->is('admin/accounts/student-monthly-fees-payments') ? 'active' : '' }}">Monthly
                                    Fees Payments</a></li>
                            <li><a href="{{ url('admin/accounts/settings/payment-options') }}"
                                    class="{{ request()->is('admin/accounts/settings/payment-options') ? 'active' : '' }}">Account
                                    Settings</a></li>

                        </ul>
                    </li>

                    <li class="submenu {{ request()->is('admin/day-book*') ? 'active' : '' }}">
                        <a href="#"><i class="bi bi-wallet"></i> <span> Day Book</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/day-book/add-income') }}"
                                    class="{{ request()->is('admin/day-book/add-income') ? 'active' : '' }}">Add
                                    Income</a></li>
                            <li><a href="{{ url('admin/day-book/add-expense') }}"
                                    class="{{ request()->is('admin/day-book/add-expense') ? 'active' : '' }}">Add
                                    Expenses</a></li>
                            <li><a href="{{ url('admin/day-book/account-statement') }}"
                                    class="{{ request()->is('admin/day-book/account-statement') ? 'active' : '' }}">Account
                                    Statement</a></li>



                        </ul>
                    </li>

                    <li class="submenu {{ request()->is('admin/bank-book*') ? 'active' : '' }}">
                        <a href="#"><i class="bi bi-journal-text"></i> <span> Bank Reconciliation</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/bank-book') }}"
                                    class="{{ request()->is('admin/bank-book') ? 'active' : '' }}">Bank
                                    Book</a></li>
                            <li><a href="{{ url('admin/bank-book/create-bank-account') }}"
                                    class="{{ request()->is('admin/bank-book/create-bank-account') ? 'active' : '' }}">Register
                                    New Bank</a></li>

                        </ul>
                    </li>

                    <li class="{{ request()->is('admin/reports*') ? 'active' : '' }}">
                        <a href="{{ url('admin/reports') }}"><i class="bi bi-clipboard-data"></i> <span>
                                Reports</span></a>

                    </li>


                    <li class="submenu {{ request()->is('admin/tools*') ? 'active' : '' }}">
                        <a href="#"><i class="bi bi-tools"></i> <span> Tools</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ url('admin/tools/calendar') }}"
                                    class="{{ request()->is('admin/tools/calendar') ? 'active' : '' }}">Calendar</a>
                            </li>
                            <li><a href="{{ url('admin/tools/nepali-date-converter') }}"
                                    class="{{ request()->is('admin/tools/nepali-date-converter') ? 'active' : '' }}">Nepali
                                    Date Converter</a></li>


                        </ul>
                    </li>

                    <li class="{{ request()->is('admin/settings*') ? 'active' : '' }}">
                        <a href="{{ url('admin/settings/general-settings') }}"><i class="fas fa-cog"></i>
                            <span>Settings</span></a>
                    </li>
                @endif



            </ul>
        </div>
    </div>
</div>
