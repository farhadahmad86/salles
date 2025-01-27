<aside class="main-sidebar sidebar-dark-primary elevation-4" style="width: 235px;">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('public/storage/img/SaleForceLogo_2.png') }}" alt="AdminLTE Logo"
            class="brand-image elevation-3"
            style=" float: left;line-height: .8;margin-top: -5px;max-height: 36px;width: auto;margin-left: 7px;margin-right: 0;">
        <span class="brand-text font-weight-light"></span>
    </a>
    <!-- Sidebar Sample -->
    <div class="sidebar" style="    padding: 20px 0 0px 0px;position: absolute;">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('/admin_lte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Admin</a>
                    </div>
                </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                {{--                <li class="nav-item has-treeview menu-open">
                                  <a href="/" class="nav-link {{Request::is(['/'])?'active':''}}">
                                      <i class="nav-icon fas fa-tachometer-alt"></i>
                                      <p>
                                          Dashboard
                                      </p>
                                  </a>
                              </li> --}}

                @foreach (\App\Libraries\Navigation::navigation() as $nav1)
                    {{--                    @if (@$nav1['heading'] || !@$nav1['can']) --}}
                    @if ((@$nav1['heading'] && \Gate::any($nav1['can'])) || !@$nav1['can'])
                        <li class="nav-header">{{ $nav1['text'] }}</li>
                    @else
                        {{--                        @if (@$nav1['can'] || !@$nav1['can']) --}}
                        @if ((@$nav1['can'] && \Gate::any($nav1['can'])) || !@$nav1['can'])
                            <li class="nav-item has-treeview {{ Request::is($nav1['can']) ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link {{ Request::is($nav1['can']) ? 'active' : '' }}">
                                    {!! $nav1['left_icon'] !!}
                                    <p>{{ $nav1['text'] }} {!! $nav1['right_icon'] !!}</p>
                                </a>
                                @if (@$nav1['sub_nav'])
                                    <ul class="nav nav-treeview">
                                        @foreach ($nav1['sub_nav'] as $nav2)
                                            {{--                                            @if (@$nav2['can'] || !@$nav2['can']) --}}
                                            @if ((@$nav2['can'] && \Gate::any($nav2['can'])) || !@$nav2['can'])
                                                <li
                                                    class="nav-item has-treeview {{ Request::is($nav2['can']) ? 'menu-open' : '' }}">
                                                    <a href="{{ @$nav2['url'] ? $nav2['url'] : '' }}"
                                                        class="nav-link {{ @$nav2['url'] ? (Request::is($nav2['can']) ? 'active' : '') : '' }}"
                                                        {{ !@$nav2['url'] ? (Request::is($nav2['can']) ? 'style=background:#007bff;color:white' : '') : '' }}>
                                                        {!! $nav2['left_icon'] !!}
                                                        <p>
                                                            {{ $nav2['text'] }}
                                                            {!! $nav2['right_icon'] ?? '' !!}
                                                        </p>
                                                    </a>
                                                    @if (@$nav2['sub_nav'])
                                                        <ul class="nav nav-treeview">
                                                            <li class="nav-item">
                                                                @foreach (@$nav2['sub_nav'] as $nav3)
                                                                    @if (@$nav3['can'] || !@$nav3['can'])
                                                                        <a href="{{ $nav3['url'] }}"
                                                                            class="nav-link {{ Request::is($nav3['can']) ? 'active' : '' }}">
                                                                            {!! $nav3['left_icon'] !!}
                                                                            <p>{{ $nav3['text'] }}</p>
                                                                        </a>
                                                                    @endif
                                                                @endforeach
                                                            </li>
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endif
                @endforeach
                @if (auth()->check() && auth()->user()->id == 1)
                    <li class="nav-header">Manage Companies</li>
                    <li class="nav-item has-treeview ">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fa-solid fa-user-plus" aria-hidden="true"></i>
                            <p>Company<i class="right fas fa-angle-left" aria-hidden="true"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item has-treeview ">
                                <a href="{{ route('add_company') }}" class="nav-link ">
                                    <i class="nav-icon fa-solid fa-plus" aria-hidden="true"></i>
                                    <p>Add Company</p>
                                </a>
                            </li>
                            <li class="nav-item has-treeview ">
                                <a href="{{ route('company_list') }}" class="nav-link ">
                                    <i class="nav-icon fa-regular fa-eye" aria-hidden="true"></i>
                                    <p>Company List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            <div class="child"><a href="/" class="brand-link">
                    <img src="{{ asset('public/storage/img/SaleForceLogo_2.png') }}" alt="AdminLTE Logo"
                        class="brand-image elevation-3"
                        style=" float: left;line-height: .8;margin-top: -5px;max-height: 36px;width: auto;margin-left: 7px;margin-right: 0;">
                    <span class="brand-text font-weight-light"></span>
                </a>
            </div>

        </nav>
        <!-- /.sidebar-menu -->

    </div>
    <!-- End of Sidebar Sample -->

</aside>


{{-- <li class="nav-header">Registrations</li>
<li
    class="nav-item has-treeview {{ Request::is(['businessCategory', 'view_businessCategory', 'edit_businessCategory']) ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ Request::is(['businessCategory', 'view_businessCategory', 'edit_businessCategory']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-magnet"></i>
        <p>
            Business Category
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('businessCategory') }}"
                class="nav-link {{ Request::is('businessCategory') ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Create Business Category</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('view_businessCategory') }}"
                class="nav-link {{ Request::is('view_businessCategory') ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>View Business Category</p>
            </a>
        </li>
    </ul>
</li>
<li
    class="nav-item has-treeview {{ Request::is(['region', 'viewRegion', 'editRegion', 'area', 'viewArea', 'editArea', 'sector', 'viewSector', 'editSector', 'town', 'editTown', 'createTown']) ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ Request::is(['region', 'viewRegion', 'editRegion', 'area', 'viewArea', 'editArea', 'sector', 'viewSector', 'editSector', 'town', 'editTown', 'createTown']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-magnet"></i>
        <p>
            Manage Area
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item has-treeview {{ Request::is(['region', 'viewRegion', 'editRegion']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['region', 'viewRegion', 'editRegion']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    Region
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('region') }}" class="nav-link {{ Request::is(['region']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create Region</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('viewRegion') }}"
                        class="nav-link {{ Request::is(['viewRegion']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View Region</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{ Request::is(['area', 'viewArea', 'editArea']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['area', 'viewArea', 'editArea']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    Area
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('area') }}" class="nav-link {{ Request::is(['area']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create Area</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('viewArea') }}"
                        class="nav-link {{ Request::is(['viewArea']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View Area</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{ Request::is(['sector', 'viewSector', 'editSector']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['sector', 'viewSector', 'editSector']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    Sector
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('sector') }}" class="nav-link {{ Request::is(['sector']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create Sector</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('viewSector') }}"
                        class="nav-link {{ Request::is(['viewSector']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View Sector</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{ Request::is(['town', 'createTown', 'editTown']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['town', 'createTown', 'editTown']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    Town
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('createTown') }}"
                        class="nav-link {{ Request::is(['createTown']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create Town</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('town') }}" class="nav-link {{ Request::is(['town']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View Town</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
<li
    class="nav-item has-treeview {{ Request::is(['visitTypeCreate', 'visitTypeView', 'visitTypeEdit']) ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ Request::is(['visitTypeCreate', 'visitTypeView', 'visitTypeEdit']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-magnet"></i>
        <p>
            Visit Type
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('visitTypeCreate') }}"
                class="nav-link {{ Request::is(['visitTypeCreate']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Create Visit Type</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('visitTypeView') }}"
                class="nav-link {{ Request::is(['visitTypeView']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>View Visit Type</p>
            </a>
        </li>
    </ul>
</li>
<li
    class="nav-item has-treeview {{ Request::is(['mainUnitCreate', 'mainUnit', 'mainUnitEdit', 'unitCreate', 'unit', 'unitEdit', 'productGroupCreate', 'productGroup', 'productGroupEdit', 'createCategory', 'category', 'editCategory', 'createProduct', 'product', 'editProduct', 'productPriceCreate', 'productPrice', 'productPriceEdit']) ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ Request::is(['mainUnitCreate', 'mainUnit', 'mainUnitEdit', 'unitCreate', 'unit', 'unitEdit', 'productGroupCreate', 'productGroup', 'productGroupEdit', 'createCategory', 'category', 'editCategory', 'createProduct', 'product', 'editProduct', 'productPriceCreate', 'productPrice', 'productPriceEdit']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-magnet"></i>
        <p>
            Manage Product
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li
            class="nav-item has-treeview {{ Request::is(['mainUnitCreate', 'mainUnitEdit', 'mainUnit']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['mainUnitCreate', 'mainUnitEdit', 'mainUnit']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    Main Unit
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('mainUnitCreate') }}"
                        class="nav-link {{ Request::is(['mainUnitCreate']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create Main Unit</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('mainUnit') }}"
                        class="nav-link {{ Request::is(['mainUnit']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View Main Unit</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{ Request::is(['unitCreate', 'unit', 'unitEdit']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['unitCreate', 'unit', 'unitEdit']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    Unit
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('unitCreate') }}"
                        class="nav-link {{ Request::is(['unitCreate']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create Unit</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('unit') }}" class="nav-link {{ Request::is(['unit']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View Unit</p>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="nav-item has-treeview {{ Request::is(['productGroupCreate', 'productGroup', 'productGroupEdit']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['productGroupCreate', 'productGroup', 'productGroupEdit']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    Product Group
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('productGroupCreate') }}"
                        class="nav-link {{ Request::is(['productGroupCreate']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create Product Group</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('productGroup') }}"
                        class="nav-link {{ Request::is(['productGroup']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View Product Group</p>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="nav-item has-treeview {{ Request::is(['createCategory', 'category', 'editCategory']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['createCategory', 'category', 'editCategory']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    Product Category
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('createCategory') }}"
                        class="nav-link {{ Request::is(['createCategory']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create Product Category</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('category') }}"
                        class="nav-link {{ Request::is(['category']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View Product Category</p>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="nav-item has-treeview {{ Request::is(['createProduct', 'product', 'editProduct']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['createProduct', 'product', 'editProduct']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    Product
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('createProduct') }}"
                        class="nav-link {{ Request::is(['createProduct']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create Product</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product') }}"
                        class="nav-link {{ Request::is(['product']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View Product</p>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="nav-item has-treeview {{ Request::is(['productPriceCreate', 'productPrice', 'productPriceEdit']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['productPriceCreate', 'productPrice', 'productPriceEdit']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    Product Price
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('productPriceCreate') }}"
                        class="nav-link {{ Request::is(['productPriceCreate']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create Product Price</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('productPrice') }}"
                        class="nav-link {{ Request::is(['productPrice']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View Product Price</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview {{ Request::is(['TandC', 'viewTandC', 'edit_tandc']) ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is(['TandC', 'viewTandC', 'edit_tandc']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-magnet"></i>
        <p>
            Term and Condition
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('TandC') }}" class="nav-link {{ Request::is(['TandC']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Create Term and Condition</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('viewTandC') }}" class="nav-link {{ Request::is(['viewTandC']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>View Term and Condition</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview {{ Request::is(['createTarget']) ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is(['createTarget']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-magnet"></i>
        <p>
            Target
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('createTarget') }}"
                class="nav-link {{ Request::is(['createTarget']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Create Target</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview {{ Request::is(['createStatus', 'status', 'editStatus']) ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is(['createStatus', 'status', 'editStatus']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-magnet"></i>
        <p>
            Status
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('createStatus') }}"
                class="nav-link {{ Request::is(['createStatus']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Create Status</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('status') }}" class="nav-link {{ Request::is(['status']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>View Status</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview {{ Request::is(['createRole', 'role', 'editRole']) ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is(['createRole', 'role', 'editRole']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-magnet"></i>
        <p>
            User
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('createRole') }}"
                class="nav-link {{ Request::is(['createRole']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Create User</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('role') }}" class="nav-link {{ Request::is(['role']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>View User</p>
            </a>
        </li>
    </ul>
</li>
<li
    class="nav-item has-treeview {{ Request::is(['user_role_create', 'user_role', 'user_role_edit']) ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ Request::is(['user_role_create', 'user_role', 'user_role_edit']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-magnet"></i>
        <p>
            User Role
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('user_role_create') }}"
                class="nav-link {{ Request::is(['user_role_create']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Create User Role</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('user_role') }}" class="nav-link {{ Request::is(['user_role']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>View User Role</p>
            </a>
        </li>
    </ul>
</li>
<li
    class="nav-item has-treeview {{ Request::is(['create_modular_group', 'modular_group', 'edit_modular_group']) ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ Request::is(['create_modular_group', 'modular_group', 'edit_modular_group']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-magnet"></i>
        <p>
            Modular Group
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('create_modular_group') }}"
                class="nav-link {{ Request::is(['create_modular_group']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Create Modular Group</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('modular_group') }}"
                class="nav-link {{ Request::is(['modular_group']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>View Modular Group</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview {{ Request::is(['businessProfile']) ? 'menu-open' : '' }}">
    <a href="#" class="nav-link {{ Request::is(['businessProfile']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-magnet"></i>
        <p>
            Business Profile
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('businessProfile') }}"
                class="nav-link {{ Request::is(['businessProfile']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Create Business Profile</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-header">Sale Registrations</li>
<li
    class="nav-item has-treeview {{ Request::is(['company', 'createCompany', 'editCompany', 'CompProfile', 'createCompProfile', 'editCompProfile', 'CompPocProfile', 'createCompPocProfile', 'editCompPocProfile', 'schedule_show', 'schedule', 'schedule_edit', 'funnel', 'createFunnel', 'editFunnel', 'allInvoices', 'invoice', 'order', 'createOrder']) ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ Request::is(['company', 'createCompany', 'editCompany', 'CompProfile', 'createCompProfile', 'editCompProfile', 'CompPocProfile', 'createCompPocProfile', 'editCompPocProfile', 'schedule_show', 'schedule', 'schedule_edit', 'funnel', 'createFunnel', 'editFunnel', 'allInvoices', 'invoice', 'order', 'createOrder']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-magnet"></i>
        <p>
            Manage Sales
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li
            class="nav-item has-treeview {{ Request::is(['createCompany', 'company', 'editCompany']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['createCompany', 'company', 'editCompany']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    Company
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('createCompany') }}"
                        class="nav-link {{ Request::is(['createCompany']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create Company</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('company') }}"
                        class="nav-link {{ Request::is(['company']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View Company</p>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="nav-item has-treeview {{ Request::is(['createCompProfile', 'CompProfile', 'editCompProfile']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['createCompProfile', 'CompProfile', 'editCompProfile']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    Company Profile
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('createCompProfile') }}"
                        class="nav-link {{ Request::is(['createCompProfile']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create Company Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('CompProfile') }}"
                        class="nav-link {{ Request::is(['CompProfile']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View Company Profile</p>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="nav-item has-treeview {{ Request::is(['createCompPocProfile', 'CompPocProfile', 'editCompPocProfile']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['createCompPocProfile', 'CompPocProfile', 'editCompPocProfile']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    POC Profile
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('createCompPocProfile') }}"
                        class="nav-link {{ Request::is(['createCompPocProfile']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create POC Profile</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('CompPocProfile') }}"
                        class="nav-link {{ Request::is(['CompPocProfile']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View POC Profile</p>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="nav-item has-treeview {{ Request::is(['schedule', 'schedule_show', 'schedule_edit']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['schedule', 'schedule_show', 'schedule_edit']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    Schedule
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('schedule') }}"
                        class="nav-link {{ Request::is(['schedule']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create Schedule</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('schedule_show') }}"
                        class="nav-link {{ Request::is(['schedule_show']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View Schedule</p>
                    </a>
                </li>
            </ul>
        </li>
        <li
            class="nav-item has-treeview {{ Request::is(['createFunnel', 'funnel', 'editFunnel']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['createFunnel', 'funnel', 'editFunnel']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    Funnel
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('createFunnel') }}"
                        class="nav-link {{ Request::is(['createFunnel']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create Funnel</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('funnel') }}"
                        class="nav-link {{ Request::is(['funnel']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View Funnel</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{ Request::is(['allInvoices', 'invoice']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['allInvoices', 'invoice']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    Quotation
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('invoice') }}"
                        class="nav-link {{ Request::is(['invoice']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create Quotation</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('allInvoices') }}"
                        class="nav-link {{ Request::is(['allInvoices']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View Quotation</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview {{ Request::is(['createOrder', 'order']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link"
                {{ Request::is(['createOrder', 'order']) ? 'style=background:#007bff;color:white' : '' }}>
                <i class="fas fa-paper-plane nav-icon"></i>
                <p>
                    Order
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ route('createOrder') }}"
                        class="nav-link {{ Request::is(['createOrder']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>Create Order</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('order') }}" class="nav-link {{ Request::is(['order']) ? 'active' : '' }}">
                        <i class="fas fa-minus nav-icon"></i>
                        <p>View Order</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
<li class="nav-header">Manage Reports</li>
<li
    class="nav-item has-treeview {{ Request::is(['scheduleReports', 'funnelReports', 'purposalReports', 'orderReports']) ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ Request::is(['scheduleReports', 'funnelReports', 'purposalReports', 'orderReports']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-magnet"></i>
        <p>
            Reports
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('scheduleReports') }}"
                class="nav-link {{ Request::is(['scheduleReports']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Schedule Reports</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('funnelReports') }}"
                class="nav-link {{ Request::is(['funnelReports']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Funnel Reports</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('purposalReports') }}"
                class="nav-link {{ Request::is(['purposalReports']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Quotation Reports</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('orderReports') }}"
                class="nav-link {{ Request::is(['orderReports']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Order Reports</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-header">Manage Reminders</li>
<li
    class="nav-item has-treeview {{ Request::is(['scheduleReminder', 'funnelReminder', 'purposalReminder', 'orderReminder']) ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ Request::is(['scheduleReminder', 'funnelReminder', 'purposalReminder', 'orderReminder']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-magnet"></i>
        <p>
            Reminders
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('scheduleReminder') }}"
                class="nav-link {{ Request::is(['scheduleReminder']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Schedule Reminder</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('funnelReminder') }}"
                class="nav-link {{ Request::is(['funnelReminder']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Funnel Reminder</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('purposalReminder') }}"
                class="nav-link {{ Request::is(['purposalReminder']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Quotation Reminder</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('orderReminder') }}"
                class="nav-link {{ Request::is(['orderReminder']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Order Reminder</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-header">Manage Remarks</li>
<li
    class="nav-item has-treeview {{ Request::is(['scheduleRemarks', 'funnelRemarks', 'purposalRemarks', 'orderRemarks']) ? 'menu-open' : '' }}">
    <a href="#"
        class="nav-link {{ Request::is(['scheduleRemarks', 'funnelRemarks', 'purposalRemarks', 'orderRemarks']) ? 'active' : '' }}">
        <i class="nav-icon fas fa-magnet"></i>
        <p>
            Remarks
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('scheduleRemarks') }}"
                class="nav-link {{ Request::is(['scheduleRemarks']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Schedule Remarks</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('funnelRemarks') }}"
                class="nav-link {{ Request::is(['funnelRemarks']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Funnel Remarks</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('purposalRemarks') }}"
                class="nav-link {{ Request::is(['purposalRemarks']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Quotation Remarks</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('orderRemarks') }}"
                class="nav-link {{ Request::is(['orderRemarks']) ? 'active' : '' }}">
                <i class="fas fa-minus nav-icon"></i>
                <p>Order Remarks</p>
            </a>
        </li>
    </ul>
</li>












<!-- Sidebar Sample -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('/admin_lte/dist/img/user2-160x160.jpg') }}" class= elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="./index.html" class="nav-link active">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v1</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v2</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Dashboard v3</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="pages/widgets.html" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Widgets
                        <span class="right badge badge-danger">New</span>
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Layout Options
                        <i class="fas fa-angle-left right"></i>
                        <span class="badge badge-info right">6</span>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/layout/top-nav.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Top Navigation</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Top Navigation + Sidebar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/layout/boxed.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Boxed</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fixed Sidebar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/layout/fixed-topnav.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fixed Navbar</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/layout/fixed-footer.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Fixed Footer</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Collapsed Sidebar</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Charts
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/charts/chartjs.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>ChartJS</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/charts/flot.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Flot</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/charts/inline.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Inline</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tree"></i>
                    <p>
                        UI Elements
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/UI/general.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>General</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/UI/icons.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Icons</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/UI/buttons.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Buttons</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/UI/sliders.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Sliders</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/UI/modals.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Modals & Alerts</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/UI/navbar.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Navbar & Tabs</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/UI/timeline.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Timeline</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/UI/ribbons.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Ribbons</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                        Forms
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/forms/general.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>General Elements</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/forms/advanced.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Advanced Elements</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/forms/editors.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Editors</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/forms/validation.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Validation</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        Tables
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/tables/simple.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Simple Tables</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/tables/data.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>DataTables</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/tables/jsgrid.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>jsGrid</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-header">EXAMPLES</li>
            <li class="nav-item">
                <a href="pages/calendar.html" class="nav-link">
                    <i class="nav-icon far fa-calendar-alt"></i>
                    <p>
                        Calendar
                        <span class="badge badge-info right">2</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="pages/gallery.html" class="nav-link">
                    <i class="nav-icon far fa-image"></i>
                    <p>
                        Gallery
                    </p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-envelope"></i>
                    <p>
                        Mailbox
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/mailbox/mailbox.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Inbox</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/mailbox/compose.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Compose</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/mailbox/read-mail.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Read</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Pages
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/examples/invoice.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Invoice</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/profile.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/e-commerce.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>E-commerce</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/projects.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Projects</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/project-add.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Project Add</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/project-edit.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Project Edit</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/project-detail.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Project Detail</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/contacts.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Contacts</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-plus-square"></i>
                    <p>
                        Extras
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="pages/examples/login.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Login</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/register.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Register</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/forgot-password.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Forgot Password</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/recover-password.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Recover Password</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/lockscreen.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Lockscreen</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Legacy User Menu</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/language-menu.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Language Menu</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/404.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Error 404</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/500.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Error 500</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/pace.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Pace</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="pages/examples/blank.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Blank Page</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="starter.html" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Starter Page</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-header">MISCELLANEOUS</li>
            <li class="nav-item">
                <a href="https://adminlte.io/docs/3.0" class="nav-link">
                    <i class="nav-icon fas fa-file"></i>
                    <p>Documentation</p>
                </a>
            </li>
            <li class="nav-header">MULTI LEVEL EXAMPLE</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Level 1</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-circle"></i>
                    <p>
                        Level 1
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Level 2</p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>
                                Level 2
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Level 3</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Level 3</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Level 3</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Level 2</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Level 1</p>
                </a>
            </li>
            <li class="nav-header">LABELS</li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle text-danger"></i>
                    <p class="text">Important</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle text-warning"></i>
                    <p>Warning</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-circle text-info"></i>
                    <p>Informational</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.Sidebar Sample --> --}}
