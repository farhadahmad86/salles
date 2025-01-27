<?php

namespace App\Libraries;

class Navigation
{
    static function navigation()
    {
        return [
            [
                'text' => 'Sales Registrations',
                'heading' => true,
                'can' => ['createClients', 'clients', 'editClients', 'create_designation', 'designation', 'edit_designation', 'createCompProfile', 'CompProfile', 'editCompProfile', 'schedule', 'schedule_show', 'schedule_edit', 'createFunnel', 'funnel', 'editFunnel', 'quotations', 'create_quotation', 'view_expiry_days', 'view_expiry_approvals', 'createOrder', 'order', 'createClientPoc', 'ClientPoc', 'editClientPoc'],
            ],
            [
                'text' => 'Clients',
                'left_icon' => '<i class="nav-icon fa-solid fa-users-viewfinder"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['createClients', 'clients', 'editClients'],
                'sub_nav' => [
                    [
                        'text' => 'Create Clients Profile',
                        'url' => route('createClients'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                        'can' => 'createClients',
                    ],
                    [
                        'text' => 'View Clients',
                        'url' => route('clients'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'clients',
                    ],
                ],
            ],
            [
                'text' => 'Designation',
                'left_icon' => '<i class="nav-icon fa-solid fa fa-briefcase"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['create_designation', 'designation', 'edit_designation'],
                'sub_nav' => [
                    [
                        'text' => 'Create Designation',
                        'url' => route('create_designation'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                        'can' => 'create_designation',
                    ],
                    [
                        'text' => 'View Designation',
                        'url' => route('designation'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'designation',
                    ],
                ],
            ],
            [
                'text' => 'Client POC',
                'left_icon' => '<i class="nav-icon fa-solid fa-phone-volume"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['createClientPoc', 'ClientPoc', 'editClientPoc'],
                'sub_nav' => [
                    [
                        'text' => 'Create POC',
                        'url' => route('createClientPoc'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                        'can' => 'createClientPoc',
                    ],
                    [
                        'text' => 'View POC',
                        'url' => route('ClientPoc'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'ClientPoc',
                    ],
                ],
            ],
            // [
            //     'text' => 'Company Profile',
            //     'left_icon' => '<i class="nav-icon fas fa-magnet"></i>',
            //     'right_icon' => '<i class="right fas fa-angle-left"></i>',
            //     'can' => ['createCompProfile', 'CompProfile', 'editCompProfile'],
            //     'sub_nav' => [
            //         [
            //             'text' => 'Create Company Profile',
            //             'url' => route('createCompProfile'),
            //             'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
            //             'can' => 'createCompProfile',
            //         ],
            //         [
            //             'text' => 'View Company Profile',
            //             'url' => route('CompProfile'),
            //             'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
            //             'can' => 'CompProfile',
            //         ]
            //     ]
            // ],
            [
                'text' => 'Schedule',
                'left_icon' => '<i class="nav-icon fa-solid fa-clipboard-list"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['schedule', 'schedule_show', 'schedule_edit'],
                'sub_nav' => [
                    [
                        'text' => 'Create Schedule',
                        'url' => route('schedule'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                        'can' => 'schedule',
                    ],
                    [
                        'text' => 'View Schedule',
                        'url' => route('schedule_show'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'schedule_show',
                    ],
                ],
            ],
            [
                'text' => 'Funnel',
                'left_icon' => '<i class="nav-icon fa-solid fa-filter"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['createFunnel', 'funnel', 'editFunnel'],
                'sub_nav' => [
                    [
                        'text' => 'Create Funnel',
                        'url' => route('createFunnel'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                        'can' => 'createFunnel',
                    ],
                    [
                        'text' => 'View Funnel',
                        'url' => route('funnel'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'funnel',
                    ],
                ],
            ],
            [
                'text' => 'Quotation',
                'left_icon' => '<i class="nav-icon fa-solid fa-file-invoice"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['quotations', 'create_quotation', 'view_expiry_days', 'view_expiry_approvals'],
                'sub_nav' => [
                    [
                        'text' => 'Create Quotation',
                        'url' => route('create_quotation'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                        'can' => 'create_quotation',
                    ],
                    [
                        'text' => 'View Quotation',
                        'url' => route('quotations'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'quotations',
                    ],
                    [
                        'text' => 'Quotations Expiry',
                        'url' => route('view_expiry_days'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                        'can' => 'view_expiry_days',
                    ],
                    [
                        'text' => 'View Quotations Expiry Approvals',
                        'url' => route('view_expiry_approvals'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'view_expiry_approvals',
                    ],
                ],
            ],
            [
                'text' => 'Order',
                'left_icon' => '<i class="nav-icon fa-solid fa-truck"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['createOrder', 'order'],
                'sub_nav' => [
                    [
                        'text' => 'Create Order',
                        'url' => route('createOrder'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                        'can' => 'createOrder',
                    ],
                    [
                        'text' => 'View Order',
                        'url' => route('order'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'order',
                    ],
                ],
            ],
            [
                'text' => 'Registrations',
                'heading' => true,
                'can' => ['businessCategory', 'view_businessCategory', 'edit_businessCategory', 'region', 'viewRegion', 'editRegion', 'area', 'viewArea', 'editArea', 'sector', 'viewSector', 'editSector', 'town', 'editTown', 'createTown', 'visitTypeCreate', 'visitTypeView', 'visitTypeEdit', 'mainUnitCreate', 'mainUnit', 'mainUnitEdit', 'uomCreate', 'uom', 'uomEdit', 'productGroupCreate', 'productGroup', 'productGroupEdit', 'createCategory', 'category', 'editCategory', 'createProduct', 'product', 'editProduct', 'productPriceCreate', 'productPrice', 'productPriceEdit', 'TandC', 'viewTandC', 'edit_tandc', 'createTarget', 'createStatus', 'status', 'editStatus', 'createuser', 'user', 'edituser', 'user_role_create', 'user_role', 'user_role_edit', 'create_modular_group', 'modular_group', 'edit_modular_group', 'businessProfile', 'createGroup', 'storeGroup', 'group', 'editGroup', 'updateGroup', 'deleteGroup'],
            ],
            [
                'text' => 'Business Category',
                'left_icon' => '<i class="nav-icon fa-solid fa-briefcase"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['businessCategory', 'view_businessCategory', 'edit_businessCategory'],
                'sub_nav' => [
                    [
                        'text' => 'Create Business Category',
                        'url' => route('businessCategory'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                        'can' => 'businessCategory',
                    ],
                    [
                        'text' => 'View Business Category',
                        'url' => route('view_businessCategory'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'view_businessCategory',
                    ],
                ],
            ],
            [
                'text' => 'Manage Area',
                'left_icon' => '<i class="nav-icon fa-solid fa-people-roof"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['region', 'viewRegion', 'editRegion', 'area', 'viewArea', 'editArea', 'sector', 'viewSector', 'editSector', 'town', 'editTown', 'createTown'],
                'sub_nav' => [
                    [
                        'text' => 'Region',
                        'left_icon' => '<i class="nav-icon fa-solid fa-globe"></i>',
                        'right_icon' => '<i class="right fas fa-angle-left"></i>',
                        'can' => ['region', 'viewRegion', 'editRegion'],
                        'sub_nav' => [
                            [
                                'text' => 'Create Region',
                                'url' => route('region'),
                                'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                                'can' => 'region',
                            ],
                            [
                                'text' => 'View Region',
                                'url' => route('viewRegion'),
                                'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                                'can' => 'viewRegion',
                            ],
                        ],
                    ],
                    [
                        'text' => 'Area',
                        'left_icon' => '<i class="nav-icon fa-solid fa-chart-area"></i>',
                        'right_icon' => '<i class="right fas fa-angle-left"></i>',
                        'can' => ['area', 'viewArea', 'editArea'],
                        'sub_nav' => [
                            [
                                'text' => 'Create Area',
                                'url' => route('area'),
                                'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                                'can' => 'area',
                            ],
                            [
                                'text' => 'View Area',
                                'url' => route('viewArea'),
                                'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                                'can' => 'viewArea',
                            ],
                        ],
                    ],
                    [
                        'text' => 'Sector',
                        'left_icon' => '<i class="nav-icon fa-solid fa-city"></i>',
                        'right_icon' => '<i class="right fas fa-angle-left"></i>',
                        'can' => ['sector', 'viewSector', 'editSector'],
                        'sub_nav' => [
                            [
                                'text' => 'Create Sector',
                                'url' => route('sector'),
                                'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                                'can' => 'sector',
                            ],
                            [
                                'text' => 'View Sector',
                                'url' => route('viewSector'),
                                'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                                'can' => 'viewSector',
                            ],
                        ],
                    ],
                    [
                        'text' => 'Town',
                        'left_icon' => '<i class="nav-icon fa-solid fa-house"></i>',
                        'right_icon' => '<i class="right fas fa-angle-left"></i>',
                        'can' => ['town', 'editTown', 'createTown'],
                        'sub_nav' => [
                            [
                                'text' => 'Create Town',
                                'url' => route('createTown'),
                                'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                                'can' => 'createTown',
                            ],
                            [
                                'text' => 'View Town',
                                'url' => route('town'),
                                'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                                'can' => 'town',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'text' => 'Visit Type',
                'left_icon' => '<i class="nav-icon fa-solid fa-car-on"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['visitTypeCreate', 'visitTypeView', 'visitTypeEdit'],
                'sub_nav' => [
                    [
                        'text' => 'Create Visit Type',
                        'url' => route('visitTypeCreate'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                        'can' => 'visitTypeCreate',
                    ],
                    [
                        'text' => 'View Visit Type',
                        'url' => route('visitTypeView'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'visitTypeView',
                    ],
                ],
            ],
            [
                'text' => 'Manage Product',
                'left_icon' => '<i class="nav-icon fa-solid fa-boxes-stacked"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['mainUnitCreate', 'mainUnit', 'mainUnitEdit', 'uomCreate', 'uom', 'uomEdit', 'productGroupCreate', 'productGroup', 'productGroupEdit', 'createCategory', 'category', 'editCategory', 'createProduct', 'product', 'editProduct', 'productPriceCreate', 'productPrice', 'productPriceEdit', 'product_price_update'],
                'sub_nav' => [
                    [
                        'text' => 'Main Unit',
                        'left_icon' => '<i class="nav-icon fa-solid fa-scale-balanced"></i>',
                        'right_icon' => '<i class="right fas fa-angle-left"></i>',
                        'can' => ['mainUnitCreate', 'mainUnitEdit', 'mainUnit'],
                        'sub_nav' => [
                            [
                                'text' => 'Create Main Unit',
                                'url' => route('mainUnitCreate'),
                                'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                                'can' => 'mainUnitCreate',
                            ],
                            [
                                'text' => 'View Main Unit',
                                'url' => route('mainUnit'),
                                'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                                'can' => 'mainUnit',
                            ],
                        ],
                    ],
                    [
                        'text' => 'UOM',
                        'left_icon' => '<i class="nav-icon fa-solid fa-weight-scale"></i>',
                        'right_icon' => '<i class="right fas fa-angle-left"></i>',
                        'can' => ['uomCreate', 'uomEdit', 'uom'],
                        'sub_nav' => [
                            [
                                'text' => 'Create UOM',
                                'url' => route('uomCreate'),
                                'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                                'can' => 'uomCreate',
                            ],
                            [
                                'text' => 'View UOM',
                                'url' => route('uom'),
                                'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                                'can' => 'uom',
                            ],
                        ],
                    ],
                    [
                        'text' => 'Product Group',
                        'left_icon' => '<i class="nav-icon fa-solid fa-layer-group"></i>',
                        'right_icon' => '<i class="right fas fa-angle-left"></i>',
                        'can' => ['productGroupCreate', 'productGroup', 'productGroupEdit'],
                        'sub_nav' => [
                            [
                                'text' => 'Create Product Group',
                                'url' => route('productGroupCreate'),
                                'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                                'can' => 'productGroupCreate',
                            ],
                            [
                                'text' => 'View Product Group',
                                'url' => route('productGroup'),
                                'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                                'can' => 'productGroup',
                            ],
                        ],
                    ],
                    [
                        'text' => 'Product Category',
                        'left_icon' => '<i class="nav-icon fa-solid fa-warehouse"></i>',
                        'right_icon' => '<i class="right fas fa-angle-left"></i>',
                        'can' => ['createCategory', 'category', 'editCategory'],
                        'sub_nav' => [
                            [
                                'text' => 'Create Product Category',
                                'url' => route('createCategory'),
                                'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                                'can' => 'createCategory',
                            ],
                            [
                                'text' => 'View Product Category',
                                'url' => route('category'),
                                'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                                'can' => 'category',
                            ],
                        ],
                    ],
                    [
                        'text' => 'Product',
                        'left_icon' => '<i class="nav-icon fa-brands fa-product-hunt"></i>',
                        'right_icon' => '<i class="right fas fa-angle-left"></i>',
                        'can' => ['createProduct', 'product', 'editProduct'],
                        'sub_nav' => [
                            [
                                'text' => 'Create Product',
                                'url' => route('createProduct'),
                                'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                                'can' => 'createProduct',
                            ],
                            [
                                'text' => 'View Product',
                                'url' => route('product'),
                                'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                                'can' => 'product',
                            ],
                        ],
                    ],
                    [
                        'text' => 'Single Product Price',
                        'left_icon' => '<i class="nav-icon fa-solid fa-sack-dollar"></i>',
                        'right_icon' => '<i class="right fas fa-angle-left"></i>',
                        'can' => ['productPriceCreate', 'productPrice', 'productPriceEdit'],
                        'sub_nav' => [
                            [
                                'text' => 'Create Product Price',
                                'url' => route('productPriceCreate'),
                                'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                                'can' => 'productPriceCreate',
                            ],
                            [
                                'text' => 'View Product Price',
                                'url' => route('productPrice'),
                                'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                                'can' => 'productPrice',
                            ],
                        ],
                    ],
                    [
                        'text' => 'Group Wise Product Price',
                        'left_icon' => '<i class="nav-icon fa-solid fa-sack-dollar"></i>',
                        'right_icon' => '<i class="right fas fa-angle-left"></i>',
                        'can' => ['product_price_update', 'update_product_price'],
                        'sub_nav' => [
                            [
                                'text' => 'Group Wise Product Price',
                                'url' => route('product_price_update'),
                                'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                                'can' => 'product_price_update',
                            ],
                            // [
                            //     'text' => 'View Product Price',
                            //     'url' => route('productPrice'),
                            //     'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                            //     'can' => 'productPrice',
                            // ],
                        ],
                    ],
                ],
            ],
            [
                'text' => 'Term And Condition',
                'left_icon' => '<i class="nav-icon fa-regular fa-file-lines"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['TandC', 'viewTandC', 'edit_tandc'],
                'sub_nav' => [
                    [
                        'text' => 'Create Term And Condition',
                        'url' => route('TandC'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                        'can' => 'TandC',
                    ],
                    [
                        'text' => 'View Term And Condition',
                        'url' => route('viewTandC'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'viewTandC',
                    ],
                ],
            ],
            [
                'text' => 'Target',
                'left_icon' => '<i class="nav-icon fa-solid fa-bullseye"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['createTarget'],
                'sub_nav' => [
                    [
                        'text' => 'Create Target',
                        'url' => route('createTarget'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                        'can' => 'createTarget',
                    ],
                ],
            ],
            [
                'text' => 'Group',
                'left_icon' => '<i class="nav-icon fa fa-group"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['createGroup','group','editStatus'],
                'sub_nav' => [
                    [
                        'text' => 'Create Group',
                        'url' => route('createGroup'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                        'can' => 'createGroup',
                    ],
                    [
                        'text' => 'View Group',
                        'url' => route('group'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-eye"></i>',
                        'can' => 'group',
                    ],
                ],
            ],
            // [
            //     'text' => 'Status',
            //     'left_icon' => '<i class="nav-icon fas fa-magnet"></i>',
            //     'right_icon' => '<i class="right fas fa-angle-left"></i>',
            //     'can' => ['createStatus', 'status', 'editStatus'],
            //     'sub_nav' => [
            //         [
            //             'text' => 'Create Status',
            //             'url' => route('createStatus'),
            //             'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
            //             'can' => 'createStatus',
            //         ],
            //         [
            //             'text' => 'View Status',
            //             'url' => route('status'),
            //             'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
            //             'can' => 'status',
            //         ]
            //     ]
            // ],
            [
                'text' => 'User',
                'left_icon' => '<i class="nav-icon fa-solid fa-user-plus"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['createuser', 'user', 'edituser'],
                'sub_nav' => [
                    [
                        'text' => 'Create User',
                        'url' => route('createuser'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                        'can' => 'createuser',
                    ],
                    [
                        'text' => 'View User',
                        'url' => route('user'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'user',
                    ],
                ],
            ],
            [
                'text' => 'Modular Group',
                'left_icon' => '<i class="nav-icon fa-solid fa-users-between-lines"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['create_modular_group', 'modular_group', 'edit_modular_group'],
                'sub_nav' => [
                    [
                        'text' => 'Create Modular Group',
                        'url' => route('create_modular_group'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                        'can' => 'create_modular_group',
                    ],
                    [
                        'text' => 'View Modular Group',
                        'url' => route('modular_group'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'modular_group',
                    ],
                ],
            ],
            // [
            //     'text' => 'User Role',
            //     'left_icon' => '<i class="nav-icon fas fa-magnet"></i>',
            //     'right_icon' => '<i class="right fas fa-angle-left"></i>',
            //     'can' => ['user_role_create', 'user_role', 'user_role_edit'],
            //     'sub_nav' => [
            //         [
            //             'text' => 'Create User Role',
            //             'url' => route('user_role_create'),
            //             'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
            //             'can' => 'user_role_create',
            //         ],
            //         [
            //             'text' => 'View User Role',
            //             'url' => route('user_role'),
            //             'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
            //             'can' => 'user_role',
            //         ]
            //     ]
            // ],

            [
                'text' => 'Business Profile',
                'left_icon' => '<i class="nav-icon fa-solid fa-address-card"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['businessProfile'],
                'sub_nav' => [
                    [
                        'text' => 'Create Business Profile',
                        'url' => route('businessProfile'),
                        'left_icon' => '<i class="nav-icon fa-solid fa-plus"></i>',
                        'can' => 'businessProfile',
                    ],
                ],
            ],
            [
                'text' => 'Manage Reports',
                'heading' => true,
                'can' => ['scheduleReports', 'funnelReports', 'purposalReports', 'orderReports', 'all_work', 'completed_work'],
            ],
            [
                'text' => 'Reports',
                'left_icon' => '<i class="nav-icon fa-solid fa-file-prescription"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['scheduleReports', 'funnelReports', 'purposalReports', 'orderReports', 'all_work', 'completed_work'],
                'sub_nav' => [
                    [
                        'text' => 'Schedule Reports',
                        'url' => route('scheduleReports'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'scheduleReports',
                    ],
                    [
                        'text' => 'Funnel Reports',
                        'url' => route('funnelReports'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'funnelReports',
                    ],
                    [
                        'text' => 'Quotation Reports',
                        'url' => route('purposalReports'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'purposalReports',
                    ],
                    [
                        'text' => 'Order Reports',
                        'url' => route('orderReports'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'orderReports',
                    ],
                    [
                        'text' => 'All Work Reports',
                        'url' => route('all_work'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'all_work',
                    ],
                    [
                        'text' => 'Completed Work Reports',
                        'url' => route('completed_work'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'completed_work',
                    ],
                ],
            ],
            [
                'text' => 'Manage Reminders',
                'heading' => true,
                'can' => ['scheduleReminder', 'funnelReminder', 'purposalReminder', 'orderReminder'],
            ],
            [
                'text' => 'Reminders',
                'left_icon' => '<i class="nav-icon fa-solid fa-bullhorn"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['scheduleReminder', 'funnelReminder', 'purposalReminder', 'orderReminder'],
                'sub_nav' => [
                    [
                        'text' => 'Schedule Reminder',
                        'url' => route('scheduleReminder'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'scheduleReminder',
                    ],
                    [
                        'text' => 'Funnel Reminder',
                        'url' => route('funnelReminder'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'funnelReminder',
                    ],
                    [
                        'text' => 'Quotation Reminder',
                        'url' => route('purposalReminder'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'purposalReminder',
                    ],
                    [
                        'text' => 'Order Reminder',
                        'url' => route('orderReminder'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'orderReminder',
                    ],
                ],
            ],
            [
                'text' => 'Manage Remarks',
                'heading' => true,
                'can' => ['scheduleRemarks', 'funnelRemarks', 'purposalRemarks', 'orderRemarks', 'all_remarks'],
            ],
            [
                'text' => 'Remarks',
                'left_icon' => '<i class="nav-icon fa-brands fa-readme"></i>',
                'right_icon' => '<i class="right fas fa-angle-left"></i>',
                'can' => ['scheduleRemarks', 'funnelRemarks', 'purposalRemarks', 'orderRemarks', 'all_remarks'],
                'sub_nav' => [
                    [
                        'text' => 'Schedule Remarks',
                        'url' => route('scheduleRemarks'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'scheduleRemarks',
                    ],
                    [
                        'text' => 'Funnel Remarks',
                        'url' => route('funnelRemarks'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'funnelRemarks',
                    ],
                    [
                        'text' => 'Quotation Remarks',
                        'url' => route('purposalRemarks'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'purposalRemarks',
                    ],
                    [
                        'text' => 'Order Remarks',
                        'url' => route('orderRemarks'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'orderRemarks',
                    ],
                    [
                        'text' => 'All Remarks',
                        'url' => route('all_remarks'),
                        'left_icon' => '<i class="nav-icon fa-regular fa-eye"></i>',
                        'can' => 'all_remarks',
                    ],
                ],
            ],
        ];
    }
}
