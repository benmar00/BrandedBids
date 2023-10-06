<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
        <div class="multinav">
            <div class="multinav-scroll" style="height: 100%;">
                <!-- sidebar menu-->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="{{ currentSelectedURL('admin.dashboard') }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="icon-Home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="treeview">
                        @canany([
                            'config',
                            'create config',
                            'edit config',
                            'delete config',
                            'logo edit',
                            'favicon
                            edit',
                            ])
                            <a href="#">
                                <i class="icon-Settings1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <span>Website Setting</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                        @endcan
                        <ul class="treeview-menu">
                            @can('favicon edit')
                                <li class="{{ currentSelectedURL('admin.config.favicon') }}">
                                    <a href="{{ route('admin.config.favicon') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Favicon</a>
                                </li>
                            @endcan
                            @can('logo edit')
                                <li class="{{ currentSelectedURL('admin.config.logo') }}">
                                    <a href="{{ route('admin.config.logo') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Logo</a>
                                </li>
                            @endcan
                            @can('edit config')
                                <li class="{{ currentSelectedURL('admin.config.settings') }}">
                                    <a href="{{ route('admin.config.settings') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Config</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    @role('admin')
                        <li class="treeview">
                            <a href="#">
                                <i class="icon-Image"></i>
                                <span>Banner Management</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ currentSelectedURL('banner.create') }}">
                                    <a href="{{ route('banner.create') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Add Banner</a>
                                </li>
                                <li class="{{ currentSelectedURL('banner.index') }}">
                                    <a href="{{ route('banner.index') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Banner List</a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class='fa fa-phone' aria-hidden='true'></i>
                                <span>Inquiry Section</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                <li class="{{ \Request::query('inquiry') == 'newsletter' ? 'active' : '' }}">
                                    <a href="{{ route('inquiry.index', ['inquiry' => 'newsletter']) }}"><i
                                            class="icon-Commit"><span class="path1"></span><span
                                                class="path2"></span></i>Newsletter
                                        Inquiries</a>
                                </li>
                                <li class="{{ \Request::query('inquiry') == 'contact' ? 'active' : '' }}">
                                    <a href="{{ route('inquiry.index', ['inquiry' => 'contact']) }}"><i
                                            class="icon-Commit"><span class="path1"></span><span
                                                class="path2"></span></i>Contact Inquiries</a>
                                </li>
                            </ul>
                        </li>

                        <li class="header">Content Management System</li>
                        <li class="treeview">
                            <a href="#">
                                <i class='icon-File'><span class='path1'></span><span class='path2'></span></i>
                                <span>Pages</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                @can('create page')
                                    <li class="{{ currentSelectedURL('page.create') }}">
                                        <a href="{{ route('page.create') }}"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Add Page</a>
                                    </li>
                                @endcan
                                @can('page')
                                    <li class="{{ currentSelectedURL('page.index') }}">
                                        <a href="{{ route('page.index') }}"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Page</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endrole

                    <!-- start bid -->

                    <li class="">
                        <a href="{{ route('admin.bid.index') }}">
                            <i class='fa fa-hashtag'><span class='path1'></span><span class='path2'></span></i>
                            <span>Bids</span>
                        </a>

                    </li>
                    <!-- end bid -->

                    @foreach ($laravelAdminMenus->menus as $section)
                        @if ($section->items)
                            <li class="header">{{ $section->section }}</li>
                            @foreach ($section->items as $menu)
                                @role($menu->role)
                                    <li class="treeview">
                                        <a href="#">
                                            {!! $menu->icon !!}

                                            <span>{{ $menu->title }}</span>
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-right pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu">

                                            <li
                                                class="{{ Request::is('admin' . $menu->url . '/create') ? 'active ' : '' }} {{ strtolower($menu->title) . '-add' }}">
                                                <a href="{{ url($menu->url . '/create') }}"><i
                                                        class="icon-Commit"><span class="path1"></span><span
                                                            class="path2"></span></i>Add {{ $menu->title }}</a>
                                            </li>
                                            <li class="{{ Request::is('admin' . $menu->url) ? 'active ' : '' }} ">
                                                <a href="{{ url($menu->url) }}"><i class="icon-Commit"><span
                                                            class="path1"></span><span
                                                            class="path2"></span></i>{{ $menu->title }} List</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endrole
                            @endforeach
                        @endif
                    @endforeach
                    @role('super admin')
                        <li class="header">Roles</li>
                        <li class="treeview">
                            <a href="#">
                                <i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
                                <span>Roles</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                @can('create role')
                                    <li class="{{ currentSelectedURL('roles.create') }}">
                                        <a href="{{ route('roles.create') }}"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Add Roles</a>
                                    </li>
                                @endcan
                                @can('role')
                                    <li class="{{ currentSelectedURL('roles.index') }}">
                                        <a href="{{ route('roles.index') }}"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Roles List</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="header">Permissions</li>
                        <li class="treeview">
                            <a href="#">
                                <i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
                                <span>Permissions</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu">
                                @can('create permission')
                                    <li class="{{ currentSelectedURL('permissions.create') }}">
                                        <a href="{{ route('permissions.create') }}"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Add Permission</a>
                                    </li>
                                @endcan
                                @can('permission')
                                    <li class="{{ currentSelectedURL('permissions.index') }}">
                                        <a href="{{ route('permissions.index') }}"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Permission List</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endrole

                    {{-- <li class="header">Ecommerce</li> --}}
                    {{-- <li class="treeview">

                        @canany(['attribute', 'create attribute', 'edit attribute'])
                            <a href="#">
                                <i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
                                <span>Attribute Management</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                        @endcanany



                        <ul class="treeview-menu">
                            @can('create attribute')
                                <li class="{{ Request::is('admin/attribute/create') ? 'active' : '' }}">
                                    <a href="{{ url('admin/attribute/create') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Add Attribute</a>
                                </li>
                            @endcan
                            @can('attribute')
                                <li class="{{ Request::is('admin/attribute') ? 'active' : '' }}">
                                    <a href="{{ url('admin/attribute') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Attribute List</a>
                                </li>
                            @endcan

                        </ul>
                    </li> --}}
                    {{-- <li class="treeview">

                        @canany(['category', 'create category', 'edit category'])
                            <a href="#">
                                <i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
                                <span>Category Management</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                        @endcanany



                        <ul class="treeview-menu">
                            @can('create category')
                                <li class="{{ currentSelectedURL('category.create') }}">
                                    <a href="{{ route('category.create') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Add Category</a>
                                </li>
                            @endcan
                            @can('category')
                                <li class="{{ currentSelectedURL('category.index') }}">
                                    <a href="{{ route('category.index') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Category List</a>
                                </li>
                            @endcan

                        </ul>
                    </li> --}}

                    <li class="treeview">
                        @canany(['user', 'create user', 'edit user'])
                            <a href="#">
                                <i class="icon-Group"><span class="path1"></span><span class="path2"></span></i>
                                <span>User</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                        @endcan
                        <ul class="treeview-menu">
                            @can('create user')
                                <li class="{{ currentSelectedURL('customer.create') }}">
                                    <a href="{{ route('customer.create') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Add User</a>
                                </li>
                            @endcan
                            @can('user')
                                <li class="{{ currentSelectedURL('customer.index') }}">
                                    <a href="{{ route('customer.index') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>User List</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    {{-- <li>
                        <a href="analysis.html">
                            <i class="icon-Chart-line"><span class="path1"></span><span class="path2"></span></i>
                            <span>Analysis</span>
                        </a>
                    </li> --}}
                    {{-- <li class="treeview">
                        <a href="#">
                            @canany([
    'order',
    'delete order',
    'product',
    'create product',
    'edit product',
    'delete
                                product',
])
                                <i class="icon-Cart"><span class="path1"></span><span class="path2"></span></i>
                                <span>Online Store</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            @endcan
                        </a>
                        <ul class="treeview-menu">
                            @can('product')
                                <li class="{{ currentSelectedURL('product.index') }}"><a
                                        href="{{ route('product.index') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></espan></i>Products</a></li>
                            @endcan
                            @can('create product')
                                <li class="{{ currentSelectedURL('product.create') }}"><a
                                        href="{{ route('product.create') }}"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Products Add</a>
                                </li>
                            @endcan --}}
                    {{-- @can('order')
                                <li><a href="ecommerce_orders.html"><i class="icon-Commit"><span
                                                class="path1"></span><span class="path2"></span></i>Product Orders</a>
                                </li>
                            @endcan --}}

                </ul>
                </li>
                {{-- <li class="header">UI & Pages</li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Library"><span class="path1"></span><span class="path2"></span></i>
                            <span>Collections</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="mailbox.html"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Mailbox</a></li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Widgets
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="widgets_blog.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Blog</a>
                                    </li>
                                    <li><a href="widgets_chart.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Chart</a>
                                    </li>
                                    <li><a href="widgets_list.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>List</a>
                                    </li>
                                    <li><a href="widgets_social.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Social</a>
                                    </li>
                                    <li><a href="widgets_statistic.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span
                                                    class="path2"></span></i>Statistic</a></li>
                                    <li><a href="widgets_weather.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Weather</a>
                                    </li>
                                    <li><a href="widgets.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Widgets</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Modals
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="component_modals.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Modals</a>
                                    </li>
                                    <li><a href="component_sweatalert.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Sweet
                                            Alert</a></li>
                                    <li><a href="component_notification.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Toastr</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Apps
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="extra_calendar.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Calendar</a>
                                    </li>
                                    <li><a href="contact_app.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Contact
                                            List</a></li>
                                    <li><a href="contact_app_chat.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Chat</a>
                                    </li>
                                    <li><a href="extra_taskboard.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Todo</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="email_index.html"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Emails</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Brush"><span class="path1"></span><span class="path2"></span></i>
                            <span>UI & Components</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Components
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="component_bootstrap_switch.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Bootstrap
                                            Switch</a></li>
                                    <li><a href="component_date_paginator.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Date
                                            Paginator</a></li>
                                    <li><a href="component_media_advanced.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Advanced
                                            Medias</a></li>
                                    <li><a href="component_rangeslider.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Range
                                            Slider</a></li>
                                    <li><a href="component_rating.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Ratings</a>
                                    </li>
                                    <li><a href="component_animations.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span
                                                    class="path2"></span></i>Animations</a></li>
                                    <li><a href="extension_fullscreen.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span
                                                    class="path2"></span></i>Fullscreen</a></li>
                                    <li><a href="extension_pace.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Pace</a>
                                    </li>
                                    <li><a href="component_nestable.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Nestable</a>
                                    </li>
                                    <li><a href="component_portlet_draggable.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Draggable
                                            Portlets</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Utilities
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="ui_grid.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Grid
                                            System</a></li>
                                    <li><a href="box_cards.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>User
                                            Card</a></li>
                                    <li><a href="box_advanced.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Advanced
                                            Card</a></li>
                                    <li><a href="box_basic.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Basic
                                            Card</a></li>
                                    <li><a href="box_color.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Card
                                            Color</a></li>
                                    <li><a href="box_group.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Card
                                            Group</a></li>
                                    <li><a href="ui_badges.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Badges</a>
                                    </li>
                                    <li><a href="ui_border_utilities.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Border</a>
                                    </li>
                                    <li><a href="ui_buttons.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Buttons</a>
                                    </li>
                                    <li><a href="ui_color_utilities.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Color</a>
                                    </li>
                                    <li><a href="ui_dropdown.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Dropdown</a>
                                    </li>
                                    <li><a href="ui_dropdown_grid.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Dropdown
                                            Grid</a></li>
                                    <li><a href="ui_progress_bars.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Progress
                                            Bars</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Icons
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="icons_fontawesome.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Font
                                            Awesome</a></li>
                                    <li><a href="icons_glyphicons.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span
                                                    class="path2"></span></i>Glyphicons</a></li>
                                    <li><a href="icons_material.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Material
                                            Icons</a></li>
                                    <li><a href="icons_themify.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Themify
                                            Icons</a></li>
                                    <li><a href="icons_simpleline.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Simple Line
                                            Icons</a></li>
                                    <li><a href="icons_cryptocoins.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Cryptocoins
                                            Icons</a></li>
                                    <li><a href="icons_flag.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Flag
                                            Icons</a></li>
                                    <li><a href="icons_weather.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Weather
                                            Icons</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Elements
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="ui_ribbons.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Ribbons</a>
                                    </li>
                                    <li><a href="ui_sliders.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Sliders</a>
                                    </li>
                                    <li><a href="ui_typography.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span
                                                    class="path2"></span></i>Typography</a></li>
                                    <li><a href="ui_tab.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Tabs</a>
                                    </li>
                                    <li><a href="ui_timeline.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Timeline</a>
                                    </li>
                                    <li><a href="ui_timeline_horizontal.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Horizontal
                                            Timeline</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-File"><span class="path1"></span><span class="path2"></span><span
                                    class="path3"></span></i>
                            <span>Forms & Tables</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Forms
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="forms_advanced.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Form
                                            Elements</a></li>
                                    <li><a href="forms_general.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Form
                                            Layout</a></li>
                                    <li><a href="forms_wizard.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Form
                                            Wizard</a></li>
                                    <li><a href="forms_validation.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Form
                                            Validation</a></li>
                                    <li><a href="forms_mask.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span
                                                    class="path2"></span></i>Formatter</a></li>
                                    <li><a href="forms_xeditable.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Xeditable
                                            Editor</a></li>
                                    <li><a href="forms_dropzone.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Dropzone</a>
                                    </li>
                                    <li><a href="forms_code_editor.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Code
                                            Editor</a></li>
                                    <li><a href="forms_editors.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Editor</a>
                                    </li>
                                    <li><a href="forms_editor_markdown.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Markdown</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Tables
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="tables_simple.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Simple
                                            tables</a></li>
                                    <li><a href="tables_data.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Data
                                            tables</a></li>
                                    <li><a href="tables_editable.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Editable
                                            Tables</a></li>
                                    <li><a href="tables_color.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Table
                                            Color</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Chart-pie"><span class="path1"></span><span class="path2"></span></i>
                            <span>Charts & Maps</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Charts
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="charts_chartjs.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>ChartJS</a>
                                    </li>
                                    <li><a href="charts_flot.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Flot</a>
                                    </li>
                                    <li><a href="charts_inline.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Inline
                                            charts</a></li>
                                    <li><a href="charts_morris.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Morris</a>
                                    </li>
                                    <li><a href="charts_peity.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Peity</a>
                                    </li>
                                    <li><a href="charts_chartist.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Chartist</a>
                                    </li>
                                    <li><a href="charts_c3_axis.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Axis
                                            Chart</a></li>
                                    <li><a href="charts_c3_bar.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Bar
                                            Chart</a></li>
                                    <li><a href="charts_c3_data.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Data
                                            Chart</a></li>
                                    <li><a href="charts_c3_line.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Line
                                            Chart</a></li>
                                    <li><a href="charts_echarts_basic.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Basic
                                            Charts</a></li>
                                    <li><a href="charts_echarts_bar.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Bar
                                            Chart</a></li>
                                    <li><a href="charts_echarts_pie_doughnut.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Pie &
                                            Doughnut Chart</a></li>
                                </ul>
                            </li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Maps
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-right pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="map_google.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Google
                                            Map</a></li>
                                    <li><a href="map_vector.html"><i class="icon-Commit"><span
                                                    class="path1"></span><span class="path2"></span></i>Vector
                                            Map</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Chat-locked"><span class="path1"></span><span class="path2"></span></i>
                            <span>Authentication</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="auth_login.html"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Login</a></li>
                            <li><a href="auth_register.html"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Register</a></li>
                            <li><a href="auth_lockscreen.html"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Lockscreen</a></li>
                            <li><a href="auth_user_pass.html"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Recover password</a>
                            </li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Chat-check"><span class="path1"></span><span class="path2"></span></i>
                            <span>Miscellaneous</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="error_404.html"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Error 404</a></li>
                            <li><a href="error_500.html"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Error 500</a></li>
                            <li><a href="error_maintenance.html"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Maintenance</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-User"><span class="path1"></span><span class="path2"></span></i>
                            <span>Usefull Page</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="extra_app_ticket.html"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Support Ticket</a>
                            </li>
                            <li><a href="extra_profile.html"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>User Profile</a></li>
                            <li><a href="contact_userlist_grid.html"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Userlist Grid</a>
                            </li>
                            <li><a href="contact_userlist.html"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Userlist</a></li>
                            <li><a href="sample_faq.html"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>FAQs</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="icon-Clipboard"><span class="path1"></span><span class="path2"></span><span
                                    class="path3"></span><span class="path4"></span></i>
                            <span>Extra Pages</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="sample_blank.html"><i class="icon-Commit"><span class="path1"></span><span
                                            class="path2"></span></i>Blank</a></li>
                            <li><a href="sample_coming_soon.html"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Coming Soon</a></li>
                            <li><a href="sample_custom_scroll.html"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Custom Scrolls</a>
                            </li>
                            <li><a href="sample_gallery.html"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Gallery</a></li>
                            <li><a href="sample_lightbox.html"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Lightbox Popup</a>
                            </li>
                            <li><a href="sample_pricing.html"><i class="icon-Commit"><span
                                            class="path1"></span><span class="path2"></span></i>Pricing</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </div>
    </section>
</aside>
