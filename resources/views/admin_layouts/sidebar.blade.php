<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>@lang('translation.main_menu')</span>
                </li>
                <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{url('admin/dashboard')}}"><i class="feather-grid"></i> <span> @lang('translation.dashboard')</span></a>

                </li>

                 <li class="submenu {{ request()->is('admin/cms*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-book"></i> <span> @lang('translation.cms')</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{url('admin/cms/blogs/active-blogs')}}" class="{{ request()->is('admin/cms/blogs/active-blogs') ? 'active' : '' }}">@lang('translation.blogs')</a></li>
                        <li><a href="{{url('admin/cms/events')}}" class="{{ request()->is('admin/cms/events') ? 'active' : '' }}">@lang('translation.events')</a></li>
                        <li><a href="{{url('admin/cms/gallery')}}" class="{{ request()->is('admin/cms/gallery') ? 'active' : '' }}">@lang('translation.gallery')</a></li>
                        <li><a href="{{url('admin/cms/contact-us')}}" class="{{ request()->is('admin/cms/contact-us') ? 'active' : '' }}">@lang('translation.contact_us')</a></li>
                        
                    </ul>
                </li>
                
                {{-- <li class="submenu">
                    <a href="#"><i class="fas fa-graduation-cap"></i> <span> Students</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="">Student List</a></li>
                        <li><a href="">Student View</a></li>
                        <li><a href="">Student Add</a></li>
                        <li><a href="">Student Edit</a></li>
                    </ul>
                </li> --}}
              <li class="submenu {{ request()->is('admin/teachers*') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> @lang('translation.teacher')</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="{{url('admin/teachers/view')}}" class="{{ request()->is('admin/teachers/view') ? 'active' : '' }}">@lang('translation.teacher_list')</a></li>
                        <li><a href="{{url('admin/teachers/add')}}" class="{{ request()->is('admin/teachers/add') ? 'active' : '' }}">@lang('translation.add_teacher')</a></li>
                        
                    </ul>
                </li> 
                {{-- <li class="submenu">
                    <a href="#"><i class="fas fa-building"></i> <span> Departments</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="departments.html">Department List</a></li>
                        <li><a href="add-department.html">Department Add</a></li>
                        <li><a href="edit-department.html">Department Edit</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-book-reader"></i> <span> Subjects</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="subjects.html">Subject List</a></li>
                        <li><a href="add-subject.html">Subject Add</a></li>
                        <li><a href="edit-subject.html">Subject Edit</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-clipboard"></i> <span> Invoices</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="invoices.html">Invoices List</a></li>
                        <li><a href="invoice-grid.html">Invoices Grid</a></li>
                        <li><a href="add-invoice.html">Add Invoices</a></li>
                        <li><a href="edit-invoice.html">Edit Invoices</a></li>
                        <li><a href="view-invoice.html">Invoices Details</a></li>
                        <li><a href="invoices-settings.html">Invoices Settings</a></li>
                    </ul>
                </li>


                <li class="menu-title">
                    <span>Management</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fas fa-file-invoice-dollar"></i> <span> Accounts</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="fees-collections.html">Fees Collection</a></li>
                        <li><a href="expenses.html">Expenses</a></li>
                        <li><a href="salary.html">Salary</a></li>
                        <li><a href="add-fees-collection.html">Add Fees</a></li>
                        <li><a href="add-expenses.html">Add Expenses</a></li>
                        <li><a href="add-salary.html">Add Salary</a></li>
                    </ul>
                </li>
                <li>
                    <a href="holiday.html"><i class="fas fa-holly-berry"></i> <span>Holiday</span></a>
                </li>
                <li>
                    <a href="fees.html"><i class="fas fa-comment-dollar"></i> <span>Fees</span></a>
                </li>
                <li>
                    <a href="exam.html"><i class="fas fa-clipboard-list"></i> <span>Exam list</span></a>
                </li>
                <li>
                    <a href="event.html"><i class="fas fa-calendar-day"></i> <span>Events</span></a>
                </li>
                <li>
                    <a href="time-table.html"><i class="fas fa-table"></i> <span>Time Table</span></a>
                </li>
                <li>
                    <a href="library.html"><i class="fas fa-book"></i> <span>Library</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fa fa-newspaper"></i> <span> Blogs</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul>
                        <li><a href="blog.html">All Blogs</a></li>
                        <li><a href="add-blog.html">Add Blog</a></li>
                        <li><a href="edit-blog.html">Edit Blog</a></li>
                    </ul>
                </li> --}}
                
                <li class="{{ request()->is('admin/settings*') ? 'active' : '' }}">
                    <a href="{{url('admin/settings/general-settings')}}"><i class="fas fa-cog"></i> <span>@lang('translation.setting')</span></a>
                </li> 
                
                
            </ul>
        </div>
    </div>
</div>
