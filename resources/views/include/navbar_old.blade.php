<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
{{--    <div class="container">--}}
        <a class="navbar-brand" href="{{ url('/') }}">
            <?php
                $name = namespace\App\Models\BusinessProfile::select('business_profile_name', 'business_profile_logo')->first();
            ?>
                <img src="{{asset('storage/img/'.$name->business_profile_logo)}}" width="135px" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

{{--                ADMIN--}}

                @if(isset(Auth::user()->role) && Auth::user()->role == 'Admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{Request::is(['company', 'CompProfile', 'CompPocProfile', 'createCompany', 'createCompProfile', 'createCompPocProfile', 'schedule_show', 'schedule', 'funnel',
                        'createFunnel','allInvoices', 'invoice','order', 'createOrder']) ?'active':''}}" href="#" data-toggle="dropdown">Sales Registration
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{Request::is(['company', 'createCompany'])?'active' :''}}" href="{{route('company')}}">Company</a>
                            <a class="dropdown-item {{Request::is(['CompProfile', 'createCompProfile'])?'active' :''}}" href="{{route('CompProfile')}}">Company Profile</a>
                            <a class="dropdown-item {{Request::is(['CompPocProfile', 'createCompPocProfile'])?'active' :''}}" href="{{route('CompPocProfile')}}">Poc Profile</a>
                            <a class="dropdown-item {{Request::is(['schedule_show', 'schedule'])?'active':''}}" href="{{route('schedule_show')}}">Schedule</a>
                            <a class="dropdown-item {{Request::is(['funnel','createFunnel'])?'active':''}}" href="{{route('funnel')}}">Funnel</a>
                            <a class="dropdown-item {{Request::is(['allInvoices', 'invoice'])?'active':''}}" href="{{route('allInvoices')}}">Quotation</a>
                            <a class="dropdown-item {{Request::is(['order', 'createOrder'])?'active':''}}" href="{{route('order')}}">Order</a>
                        </div>
                    </li>
{{--                                <li class="nav-item">--}}
{{--                                    <a class="nav-link {{Request::is(['order', 'createOrder'])?'active':''}}" href="{{route('order')}}">Order</a>--}}
{{--                                </li>--}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{Request::is(['scheduleReminder','funnelReminder','purposalReminder','orderReminder'])?'active':''}}" href="#" data-toggle="dropdown">
                            Reminders
                            {{--                            <span class="badge badge-danger">2</span>--}}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{Request::is(['scheduleReminder'])?'active' :''}}" href="{{route('scheduleReminder')}}">Schedule</a>
                            <a class="dropdown-item {{Request::is(['funnelReminder'])?'active' :''}}" href="{{route('funnelReminder')}}">Funnel</a>
                            <a class="dropdown-item {{Request::is(['purposalReminder'])?'active' :''}}" href="{{route('purposalReminder')}}">Purposal</a>
                            <a class="dropdown-item {{Request::is(['orderReminder'])?'active' :''}}" href="{{route('orderReminder')}}">Order</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{Request::is(['scheduleRemarks','funnelRemarks','purposalRemarks','orderRemarks'])?'active':''}}" href="#" data-toggle="dropdown">
                            Remarks
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{Request::is(['scheduleRemarks'])?'active' :''}}" href="{{route('scheduleRemarks')}}">Schedule</a>
                            <a class="dropdown-item {{Request::is(['funnelRemarks'])?'active' :''}}" href="{{route('funnelRemarks')}}">Funnel</a>
                            <a class="dropdown-item {{Request::is(['purposalRemarks'])?'active' :''}}" href="{{route('purposalRemarks')}}">Purposal</a>
                            <a class="dropdown-item {{Request::is(['orderRemarks'])?'active' :''}}" href="{{route('orderRemarks')}}">Order</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{Request::is(['scheduleReports', 'funnelReports', 'purposalReports', 'orderReports'])?'active':''}}" href="#" data-toggle="dropdown">
                            Reports
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{Request::is('scheduleReports')?'active' :''}}" href="{{route('scheduleReports')}}">Schedule</a>
                            <a class="dropdown-item {{Request::is('funnelReports')?'active' :''}}" href="{{route('funnelReports')}}">Funnel</a>
                            <a class="dropdown-item {{Request::is('purposalReports')?'active' :''}}" href="{{route('purposalReports')}}">Purposal</a>
                            <a class="dropdown-item {{Request::is('orderReports')?'active' :''}}" href="{{route('orderReports')}}">Order</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{Request::is(['region', 'editRegion', 'area', 'editArea', 'sector', 'editSector', 'product', 'createProduct',
                         'editProduct', 'createRole', 'editRole', 'status', 'createStatus', 'editStatus', 'category', 'createCategory', 'editCategory', 'role', 'TandC',
                          'edit_tandc', 'businessProfile', 'businessCategory', 'edit_businessCategory','visitTypeCreate', 'visitTypeEdit','productPrice', 'productPriceCreate',
                           'productPriceEdit', 'productGroup', 'productGroupCreate', 'productGroupEdit', 'town', 'editTown', 'createTown','mainUnit', 'mainUnitCreate', 'mainUnitEdit',
                           'unit', 'unitCreate', 'unitEdit','user_role', 'user_role_create', 'user_role_edit'])?'active':''}}"
                           href="#" data-toggle="dropdown">Registration</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{Request::is(['businessCategory', 'edit_businessCategory'])?'active' :''}}" href="{{route('businessCategory')}}">Business Category</a>
                            <a class="dropdown-item {{Request::is(['region', 'editRegion'])?'active' :''}}" href="{{route('region')}}">Region</a>
                            <a class="dropdown-item {{Request::is(['area', 'editArea'])?'active' :''}}" href="{{route('area')}}">Area</a>
                            <a class="dropdown-item {{Request::is(['sector', 'editSector'])?'active' :''}}" href="{{route('sector')}}">Sector</a>
                            <a class="dropdown-item {{Request::is(['town', 'editTown', 'createTown'])?'active' :''}}" href="{{route('town')}}">Town</a>
                            <a class="dropdown-item {{Request::is(['visitTypeCreate', 'visitTypeEdit'])?'active' :''}}" href="{{route('visitTypeCreate')}}">Visit Type</a>
                            <a class="dropdown-item {{Request::is(['mainUnit', 'mainUnitCreate', 'mainUnitEdit'])?'active' :''}}" href="{{route('mainUnit')}}">Main Unit</a>
                            <a class="dropdown-item {{Request::is(['unit', 'unitCreate', 'unitEdit'])?'active' :''}}" href="{{route('unit')}}">Unit</a>
                            <a class="dropdown-item {{Request::is(['productGroup', 'productGroupCreate', 'productGroupEdit'])?'active' :''}}" href="{{route('productGroup')}}">Product Group</a>
                            <a class="dropdown-item {{Request::is(['category', 'createCategory', 'editCategory'])?'active':''}}" href="{{route('category')}}">Product Category</a>
                            <a class="dropdown-item {{Request::is(['product', 'createProduct', 'editProduct'])?'active':''}}" href="{{route('product')}}">Product</a>
                            <a class="dropdown-item {{Request::is(['productPrice', 'productPriceCreate', 'productPriceEdit'])?'active':''}}" href="{{route('productPrice')}}">Product Price</a>
                            <a class="dropdown-item {{Request::is(['TandC', 'edit_tandc'])?'active':''}}" href="{{route('TandC')}}">Term and Condition</a>
                            <a class="dropdown-item {{Request::is(['createTarget'])?'active':''}}" href="{{route('createTarget')}}">Target</a>
                            <a class="dropdown-item {{Request::is(['status', 'createStatus', 'editStatus'])?'active':''}}" href="{{route('status')}}">Status</a>
                            <a class="dropdown-item {{Request::is(['role', 'createRole', 'editRole'])?'active':''}}" href="{{route('role')}}">Register User</a>
                            <a class="dropdown-item {{Request::is(['user_role', 'user_role_create', 'user_role_edit'])?'active':''}}" href="{{route('user_role')}}">Register Role</a>
                            <a class="dropdown-item {{Request::is(['businessProfile'])?'active':''}}" href="{{route('businessProfile')}}">Business Profile</a>
                        </div>
                    </li>
                @endif

{{--                SUPERVISOR--}}

                @if(isset(Auth::user()->role) && Auth::user()->role == 'Supervisor')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{Request::is(['company', 'CompProfile', 'CompPocProfile', 'createCompany', 'createCompProfile', 'createCompPocProfile', 'schedule_show', 'schedule', 'funnel',
                        'createFunnel','allInvoices', 'invoice','order', 'createOrder']) ?'active':''}}" href="#" data-toggle="dropdown">Sales Registration
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item {{Request::is(['company', 'createCompany'])?'active' :''}}" href="{{route('company')}}">Company</a>
                                <a class="dropdown-item {{Request::is(['CompProfile', 'createCompProfile'])?'active' :''}}" href="{{route('CompProfile')}}">Company Profile</a>
                                <a class="dropdown-item {{Request::is(['CompPocProfile', 'createCompPocProfile'])?'active' :''}}" href="{{route('CompPocProfile')}}">Poc Profile</a>
                                <a class="dropdown-item {{Request::is(['schedule_show', 'schedule'])?'active':''}}" href="{{route('schedule_show')}}">Schedule</a>
                                <a class="dropdown-item {{Request::is(['funnel','createFunnel'])?'active':''}}" href="{{route('funnel')}}">Funnel</a>
                                <a class="dropdown-item {{Request::is(['allInvoices', 'invoice'])?'active':''}}" href="{{route('allInvoices')}}">Purposal</a>
                                <a class="dropdown-item {{Request::is(['order', 'createOrder'])?'active':''}}" href="{{route('order')}}">Order</a>
                            </div>
                        </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{Request::is(['scheduleReminder','funnelReminder','purposalReminder','orderReminder'])?'active':''}}" href="#" data-toggle="dropdown">
                            Reminders
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{Request::is(['scheduleReminder'])?'active' :''}}" href="{{route('scheduleReminder')}}">Schedule</a>
                            <a class="dropdown-item {{Request::is(['funnelReminder'])?'active' :''}}" href="{{route('funnelReminder')}}">Funnel</a>
                            <a class="dropdown-item {{Request::is(['purposalReminder'])?'active' :''}}" href="{{route('purposalReminder')}}">Purposal</a>
                            <a class="dropdown-item {{Request::is(['orderReminder'])?'active' :''}}" href="{{route('orderReminder')}}">Order</a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{Request::is(['scheduleRemarks','funnelRemarks','purposalRemarks','orderRemarks'])?'active':''}}" href="#" data-toggle="dropdown">
                            Remarks
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{Request::is(['scheduleRemarks'])?'active' :''}}" href="{{route('scheduleRemarks')}}">Schedule</a>
                            <a class="dropdown-item {{Request::is(['funnelRemarks'])?'active' :''}}" href="{{route('funnelRemarks')}}">Funnel</a>
                            <a class="dropdown-item {{Request::is(['purposalRemarks'])?'active' :''}}" href="{{route('purposalRemarks')}}">Purposal</a>
                            <a class="dropdown-item {{Request::is(['orderRemarks'])?'active' :''}}" href="{{route('orderRemarks')}}">Order</a>
                        </div>
                    </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{Request::is(['scheduleReports', 'funnelReports', 'purposalReports', 'orderReports'])?'active':''}}" href="#" data-toggle="dropdown">
                                Reports
                            </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item {{Request::is('scheduleReports')?'active' :''}}" href="{{route('scheduleReports')}}">Schedule</a>
                                <a class="dropdown-item {{Request::is('funnelReports')?'active' :''}}" href="{{route('funnelReports')}}">Funnel</a>
                                <a class="dropdown-item {{Request::is('purposalReports')?'active' :''}}" href="{{route('purposalReports')}}">Purposal</a>
                                <a class="dropdown-item {{Request::is('orderReports')?'active' :''}}" href="{{route('orderReports')}}">Order</a>
                            </div>
                        </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{Request::is(['region', 'editRegion', 'area', 'editArea', 'sector', 'editSector', 'product', 'createProduct',
                         'editProduct', 'createRole', 'editRole', 'status', 'createStatus', 'editStatus', 'category', 'createCategory', 'editCategory', 'role', 'TandC',
                          'edit_tandc', 'businessProfile', 'businessCategory', 'edit_businessCategory','visitTypeCreate', 'visitTypeEdit', 'productGroup', 'productGroupCreate',
                           'productGroupEdit', 'town', 'editTown', 'createTown', 'user_role', 'user_role_create', 'user_role_edit'])?'active':''}}"
                           href="#" data-toggle="dropdown">Registration</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{Request::is(['businessCategory', 'edit_businessCategory'])?'active' :''}}" href="{{route('businessCategory')}}">Business Category</a>
                            <a class="dropdown-item {{Request::is(['region', 'editRegion'])?'active' :''}}" href="{{route('region')}}">Region</a>
                            <a class="dropdown-item {{Request::is(['area', 'editArea'])?'active' :''}}" href="{{route('area')}}">Area</a>
                            <a class="dropdown-item {{Request::is(['sector', 'editSector'])?'active' :''}}" href="{{route('sector')}}">Sector</a>
                            <a class="dropdown-item {{Request::is(['town', 'editTown', 'createTown'])?'active' :''}}" href="{{route('town')}}">Town</a>
                            <a class="dropdown-item {{Request::is(['visitTypeCreate', 'visitTypeEdit'])?'active' :''}}" href="{{route('visitTypeCreate')}}">Visit Type</a>
                            <a class="dropdown-item {{Request::is(['TandC', 'edit_tandc'])?'active':''}}" href="{{route('TandC')}}">Term and Condition</a>
                            <a class="dropdown-item {{Request::is(['createTarget'])?'active':''}}" href="{{route('createTarget')}}">Target</a>
                            <a class="dropdown-item {{Request::is(['role', 'createRole', 'editRole'])?'active':''}}" href="{{route('role')}}">Register User</a>
                            <a class="dropdown-item {{Request::is(['user_role', 'user_role_create', 'user_role_edit'])?'active':''}}" href="{{route('role')}}">Register Role</a>
                        </div>
                    </li>

                @endif

{{--                SALE PERSON--}}

                @if(isset(Auth::user()->role) && Auth::user()->role == 'Sale Person')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{Request::is(['company', 'CompProfile', 'CompPocProfile', 'createCompany', 'createCompProfile', 'createCompPocProfile', 'schedule_show', 'schedule', 'funnel',
                    'createFunnel','allInvoices', 'invoice','order', 'createOrder']) ?'active':''}}" href="#" data-toggle="dropdown">Sales Registration
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{Request::is(['company', 'createCompany'])?'active' :''}}" href="{{route('company')}}">Company</a>
                            <a class="dropdown-item {{Request::is(['CompProfile', 'createCompProfile'])?'active' :''}}" href="{{route('CompProfile')}}">Company Profile</a>
                            <a class="dropdown-item {{Request::is(['CompPocProfile', 'createCompPocProfile'])?'active' :''}}" href="{{route('CompPocProfile')}}">Poc Profile</a>
                            <a class="dropdown-item {{Request::is(['schedule_show', 'schedule'])?'active':''}}" href="{{route('schedule_show')}}">Schedule</a>
                            <a class="dropdown-item {{Request::is(['funnel','createFunnel'])?'active':''}}" href="{{route('funnel')}}">Funnel</a>
                            <a class="dropdown-item {{Request::is(['allInvoices', 'invoice'])?'active':''}}" href="{{route('allInvoices')}}">Purposal</a>
                            <a class="dropdown-item {{Request::is(['order', 'createOrder'])?'active':''}}" href="{{route('order')}}">Order</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{Request::is(['scheduleReminder','funnelReminder','purposalReminder','orderReminder'])?'active':''}}" href="#" data-toggle="dropdown">
                            Reminders
                            {{--                            <span class="badge badge-danger">2</span>--}}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{Request::is(['scheduleReminder'])?'active' :''}}" href="{{route('scheduleReminder')}}">Schedule</a>
                            <a class="dropdown-item {{Request::is(['funnelReminder'])?'active' :''}}" href="{{route('funnelReminder')}}">Funnel</a>
                            <a class="dropdown-item {{Request::is(['purposalReminder'])?'active' :''}}" href="{{route('purposalReminder')}}">Purposal</a>
                            <a class="dropdown-item {{Request::is(['orderReminder'])?'active' :''}}" href="{{route('orderReminder')}}">Order</a>
                        </div>
                    </li>
                @endif

{{--                PRODUCT MANAGER--}}

                @if(isset(Auth::user()->role) && Auth::user()->role == 'Product Manager')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{Request::is(['product', 'createProduct', 'editProduct','allInvoices', 'invoice','order', 'createOrder', 'productGroup',
                            'productGroupCreate', 'productGroupEdit']) ?'active':''}}" href="#" data-toggle="dropdown">Manage Product</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{Request::is(['mainUnitCreate', 'mainUnitEdit'])?'active' :''}}" href="{{route('mainUnit')}}">Main Unit</a>
                            <a class="dropdown-item {{Request::is(['unitCreate', 'unitEdit'])?'active' :''}}" href="{{route('unit')}}">Unit</a>
                            <a class="dropdown-item {{Request::is(['productGroup', 'productGroupCreate', 'productGroupEdit'])?'active' :''}}" href="{{route('productGroup')}}">Product Group</a>
                            <a class="dropdown-item {{Request::is(['category', 'createCategory', 'editCategory'])?'active':''}}" href="{{route('category')}}">Product Category</a>
                            <a class="dropdown-item {{Request::is(['product', 'createProduct', 'editProduct'])?'active':''}}" href="{{route('product')}}">Product</a>
                            <a class="dropdown-item {{Request::is(['allInvoices', 'invoice'])?'active':''}}" href="{{route('allInvoices')}}">Purposal</a>
                            <a class="dropdown-item {{Request::is(['order', 'createOrder'])?'active':''}}" href="{{route('order')}}">Order</a>
                        </div>
                    </li>
                @endif

{{--                PRICE MANAGER--}}

                @if(isset(Auth::user()->role) && Auth::user()->role == 'Price Manager')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{Request::is(['productPrice', 'productPriceCreate', 'productPriceEdit']) ?'active':''}}" href="#" data-toggle="dropdown">Manage Product</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{Request::is(['productPrice', 'productPriceCreate', 'productPriceEdit'])?'active':''}}" href="{{route('productPrice')}}">Product Price</a>
                        </div>
                    </li>
                @endif

{{--                TELE CALLER--}}

                @if(isset(Auth::user()->role) && Auth::user()->role == 'Tele Caller')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{Request::is(['schedule_show','funnel','allInvoices','order']) ?'active':''}}" href="#" data-toggle="dropdown">Manage Tele Caller
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{Request::is(['schedule_show'])?'active':''}}" href="{{route('schedule_show')}}">Schedule</a>
                            <a class="dropdown-item {{Request::is(['funnel'])?'active':''}}" href="{{route('funnel')}}">Funnel</a>
                            <a class="dropdown-item {{Request::is(['allInvoices'])?'active':''}}" href="{{route('allInvoices')}}">Purposal</a>
                            <a class="dropdown-item {{Request::is(['order'])?'active':''}}" href="{{route('order')}}">Order</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{Request::is(['all_work','completed_work','total_work']) ?'active':''}}" href="#" data-toggle="dropdown">Reminder Reports
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{Request::is(['all_work'])?'active':''}}" href="{{route('all_work')}}">Pending Work</a>
                            <a class="dropdown-item {{Request::is(['completed_work'])?'active':''}}" href="{{route('completed_work')}}">Completed Work</a>
{{--                            <a class="dropdown-item {{Request::is(['total_work'])?'active':''}}" href="{{route('total_work')}}">Total Work</a>--}}
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{Request::is(['all_remarks']) ?'active':''}}" href="#" data-toggle="dropdown">Remarks Reports
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item {{Request::is(['all_remarks'])?'active':''}}" href="{{route('all_remarks')}}">All Remarks</a>
                        </div>
                    </li>
                @endif
            </ul>


            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

{{--                Notification--}}

{{--                @if(!Auth::guest())--}}
{{--                <div class="dropdown2" style="margin: 7px 20px 0 0; position: relative">--}}
{{--                    <span id="dLabel" style="cursor: pointer" role="button" data-toggle="dropdown" data-target="#">Notifications--}}
{{--                        (<b class="notification">0</b>)--}}
{{--                    </span>--}}
{{--                    <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">--}}
{{--                        <div class="notification-heading"><h4 class="menu-title">Notifications</h4></div>--}}
{{--                        <li class="divider"></li>--}}
{{--                        <div class="schedule-wrapper">--}}
{{--                            <div class="content">--}}
{{--                                <div class="notification-item">--}}
{{--                                    <div class="item-title"><b>Company </b>(<span style="font-size: 16px">Schedule</span>)</div>--}}
{{--                                    <b>Reminder Date: </b><span>10-30-2019</span>--}}
{{--                                    <div><a href="#">View</a></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="funnel-wrapper">--}}
{{--                            <div class="content">--}}
{{--                                <div class="notification-item">--}}
{{--                                    <div class="item-title"><b>Company </b>(<span style="font-size: 16px">Schedule</span>)</div>--}}
{{--                                    <b>Reminder Date: </b><span>10-30-2019</span>--}}
{{--                                    <div><a href="#">View</a></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="purposal-wrapper">--}}
{{--                            <div class="content">--}}
{{--                                <div class="notification-item">--}}
{{--                                    <div class="item-title"><b>Company </b>(<span style="font-size: 16px">Schedule</span>)</div>--}}
{{--                                    <b>Reminder Date: </b><span>10-30-2019</span>--}}
{{--                                    <div><a href="#">View</a></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="order-wrapper">--}}
{{--                            <div class="content">--}}
{{--                                <div class="notification-item">--}}
{{--                                    <div class="item-title"><b>Company </b>(<span style="font-size: 16px">Schedule</span>)</div>--}}
{{--                                    <b>Reminder Date: </b><span>10-30-2019</span>--}}
{{--                                    <div><a href="#">View</a></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <li class="divider"></li>--}}
{{--                        <div class="notification-footer" style="margin-top: 10px;"><h4 class="menu-title">View all<i class="glyphicon glyphicon-circle-arrow-right"></i></h4></div>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--                @endif--}}

                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    {{--                    @if (Route::has('register'))--}}
                    {{--                        <li class="nav-item">--}}
                    {{--                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
                    {{--                        </li>--}}
                    {{--                    @endif--}}
                @else
                    <li class="nav-item dropdown">
                        <img src="storage/img/{{Auth::user()->image}}" class="rounded-circle" width="33px" height="40px" alt="">
                        <a id="navbarDropdown" class="nav-link float-right dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a href="{{Route('editProfile')}}" class="dropdown-item">My Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
{{--    </div>--}}
</nav>
