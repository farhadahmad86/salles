<?php

// use Illuminate\Routing\Route;

use App\ExpiryDate;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

// use Illuminate\Support\Facades\Auth;

Route::get('/artisan', function () {
    //    \Illuminate\Support\Facades\Artisan::call('migrate:fresh');
    //    \Illuminate\Support\Facades\Artisan::call('db:seed --class=DatabaseSeeder');
    //    \Illuminate\Support\Facades\Artisan::call('db:seed --class=PermissionSeeder');
    //    \Illuminate\Support\Facades\Artisan::call('migrate:rollback --path=/database/migrations/2020_07_18_064539_create_users_table.php');
    //    \Illuminate\Support\Facades\Artisan::call('migrate:fresh --path=/database/migrations/2020_07_18_064539_create_users_table.php');
});

Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', 'PagesController@dashboard');
    //HOME
    //    Route::get('/home', 'HomeController@index')->name('home');

    // COMPANY
    // Route::get('/company', 'ClientController@index')->name('company')->middleware('can:company');
    // Route::get('/createCompany', 'ClientController@create')->name('createCompany')->middleware('can:createCompany');
    // Route::post('/storeCompany', 'ClientController@store')->name('storeCompany')->middleware('can:storeCompany');
    // Route::get('/editCompany', 'ClientController@edit')->name('editCompany')->middleware('can:editCompany');
    // Route::post('/updateCompany', 'ClientController@update')->name('updateCompany')->middleware('can:updateCompany');
    // Route::get('/deleteCompany', 'ClientController@destroy')->name('deleteCompany')->middleware('can:deleteCompany');
    // Route::post('checkCompName', 'ClientController@checkCompName')->name('checkCompName')->middleware('can:checkCompName');

    // Clients
    Route::get('/clients', 'ClientController@index')->name('clients')->middleware('can:clients');
    Route::get('/createClients', 'ClientController@create')->name('createClients')->middleware('can:createClients');
    Route::post('/storeClients', 'ClientController@store')->name('storeClients')->middleware('can:storeClients');
    Route::get('/editClients', 'ClientController@edit')->name('editClients')->middleware('can:editClients');
    Route::post('/updateClients', 'ClientController@update')->name('updateClients')->middleware('can:updateClients');
    Route::get('/deleteClients', 'ClientController@destroy')->name('deleteClients')->middleware('can:deleteClients');
    Route::get('/changeClientStatus', 'ClientController@changeStatus')->name('changeClientStatus')->middleware('can:changeClientStatus');
    Route::post('checkClientName', 'ClientController@checkClientName')->name('checkClientName')->middleware('can:checkClientName');

    // COMPANY PROFILE
    // Route::get('/CompProfile', 'CompProfileController@index')->name('CompProfile')->middleware('can:CompProfile');
    // Route::get('/createCompProfile', 'CompProfileController@create')->name('createCompProfile')->middleware('can:createCompProfile');
    // Route::post('/storeCompProfile', 'CompProfileController@store')->name('storeCompProfile')->middleware('can:storeCompProfile');
    // Route::get('/editCompProfile', 'CompProfileController@edit')->name('editCompProfile')->middleware('can:editCompProfile');
    // Route::post('/updateCompProfile', 'CompProfileController@update')->name('updateCompProfile')->middleware('can:updateCompProfile');
    // Route::get('/deleteCompProfile', 'CompProfileController@delete')->name('deleteCompProfile')->middleware('can:deleteCompProfile');

    //Clients POC PROFILE
    Route::get('/ClientPoc', 'ClientPocProfileController@ClientPoc')->name('ClientPoc')->middleware('can:ClientPoc');
    Route::get('/createClientPoc', 'ClientPocProfileController@createClientPoc')->name('createClientPoc')->middleware('can:createClientPoc');
    Route::post('/storeClientPoc', 'ClientPocProfileController@storeClientPoc')->name('storeClientPoc')->middleware('can:storeClientPoc');
    Route::get('/editClientPoc', 'ClientPocProfileController@editClientPoc')->name('editClientPoc')->middleware('can:editClientPoc');
    Route::post('/updateClientPoc', 'ClientPocProfileController@updateClientPoc')->name('updateClientPoc')->middleware('can:updateClientPoc');
    Route::get('/deleteClientPoc', 'ClientPocProfileController@deleteClientPoc')->name('deleteClientPoc')->middleware('can:deleteClientPoc');
    Route::get('/changePocStatus', 'ClientPocProfileController@changeStatus')->name('changePocStatus');

    //SCHEDULE
    Route::get('/schedule', 'ScheduleController@index')->name('schedule')->middleware('can:schedule');
    Route::post('/schedule_store', 'ScheduleController@store')->name('schedule_store')->middleware('can:schedule_store');
    Route::get('/schedule_show/{array?}/{str?}', 'ScheduleController@show')->name('schedule_show')->middleware('can:schedule_show');
    Route::post('/schedule_show/{array?}/{str?}', 'ScheduleController@show')->name('schedule_show')->middleware('can:schedule_show');
    Route::get('/schedule_edit', 'ScheduleController@edit')->name('schedule_edit')->middleware('can:schedule_edit');
    Route::post('/schedule_update', 'ScheduleController@update')->name('schedule_update')->middleware('can:schedule_update');
    Route::get('/schedule_delete', 'ScheduleController@delete')->name('schedule_delete')->middleware('can:schedule_delete');

    //FUNNEL
    Route::get('/funnel/{array?}/{str?}', 'FunnelController@index')->name('funnel')->middleware('can:funnel');
    Route::get('/createFunnel', 'FunnelController@create')->name('createFunnel')->middleware('can:createFunnel');
    Route::post('/storeFunnel', 'FunnelController@store')->name('storeFunnel')->middleware('can:storeFunnel');
    Route::get('/editFunnel', 'FunnelController@edit')->name('editFunnel')->middleware('can:editFunnel');
    Route::post('/updateFunnel', 'FunnelController@update')->name('updateFunnel')->middleware('can:updateFunnel');
    Route::get('/deleteFunnel', 'FunnelController@delete')->name('deleteFunnel')->middleware('can:deleteFunnel');
    Route::get('/get_poc', 'FunnelController@get_poc')->name('get_poc')->middleware('can:get_poc');
    Route::get('/changeFunnelStatus', 'FunnelController@changeStatus')->name('changeFunnelStatus');

    //Group
    Route::get('/group/{array?}/{str?}', 'GroupController@index')->name('group')->middleware('can:group');
    Route::get('/createGroup', 'GroupController@create')->name('createGroup')->middleware('can:createGroup');
    Route::post('/storeGroup', 'GroupController@store')->name('storeGroup')->middleware('can:storeGroup');
    Route::get('/editGroup', 'GroupController@edit')->name('editGroup')->middleware('can:editGroup');
    Route::post('/updateGroup', 'GroupController@update')->name('updateGroup')->middleware('can:updateGroup');
    Route::get('/deleteGroup', 'GroupController@delete')->name('deleteGroup')->middleware('can:deleteGroup');
    Route::get('/user_session/{id}', 'GroupController@user_session')->name('user_session');

    //PRODUCT
    Route::get('/product', 'ProductController@index')->name('product')->middleware('can:product');
    Route::get('/createProduct', 'ProductController@create')->name('createProduct')->middleware('can:createProduct');
    Route::post('/storeProduct', 'ProductController@store')->name('storeProduct')->middleware('can:storeProduct');
    Route::get('/editProduct', 'ProductController@edit')->name('editProduct')->middleware('can:editProduct');
    Route::post('/updateProduct', 'ProductController@update')->name('updateProduct')->middleware('can:updateProduct');
    Route::get('/deleteProduct', 'ProductController@delete')->name('deleteProduct')->middleware('can:deleteProduct');
    Route::get('/changeProductStatus', 'ProductController@changeStatus')->name('changeProductStatus')->middleware('can:changeProductStatus');

    //PRODUCT PRICE
    Route::get('/productPrice', 'ProductPriceController@productPrice')->name('productPrice')->middleware('can:productPrice');
    Route::get('/productPriceCreate', 'ProductPriceController@productPriceCreate')->name('productPriceCreate')->middleware('can:productPriceCreate');
    Route::post('/productPriceStore', 'ProductPriceController@productPriceStore')->name('productPriceStore')->middleware('can:productPriceStore');
    Route::get('/productPriceEdit', 'ProductPriceController@productPriceEdit')->name('productPriceEdit')->middleware('can:productPriceEdit');
    Route::post('/productPriceUpdate', 'ProductPriceController@productPriceUpdate')->name('productPriceUpdate')->middleware('can:productPriceUpdate');
    Route::get('/productPriceDelete', 'ProductPriceController@productPriceDelete')->name('productPriceDelete')->middleware('can:productPriceDelete');

    //QUOTATIONS
    Route::get('/create_quotation', 'QuotationsController@index')->name('create_quotation')->middleware('can:create_quotation');
    Route::post('/store_quotation', 'QuotationsController@store')->name('store_quotation')->middleware('can:store_quotation');
    Route::get('/quotations', 'QuotationsController@allqoutations')->name('quotations')->middleware('can:quotations');
    Route::get('/view_qoutations', 'QuotationsController@view_qoutations')->name('view_qoutations')->middleware('can:view_qoutations');
    Route::get('/deleteInvoice', 'QuotationsController@delete')->name('deleteInvoice')->middleware('can:deleteInvoice');
    Route::get('/versionqoutation', 'QuotationsController@versionqoutation')->name('versionqoutation');
    Route::post('/store_version', 'QuotationsController@store_version')->name('store_version')->middleware('can:store_version');
    Route::post('/approval_quotations', 'QuotationsController@approval_quotations')->name('approval_quotations')->middleware('can:approval_quotations');
    Route::post('/refuse_approval', 'QuotationsController@refuse_approval')->name('refuse_approval')->middleware('can:refuse_approval');
    Route::get('/approval_expiry_date{array?}/{str?}', 'QuotationsController@approval_date')->name('approval_expiry_date')->middleware('can:approval_expiry_date');
    Route::get('/view_expiry_approvals', 'QuotationsController@approvals')->name('view_expiry_approvals')->middleware('can:view_expiry_approvals');
    // ExpiryDate
    Route::post('/update_expiry_days', 'ExpiryDateController@update')->name('update_expiry_days')->middleware('can:update_expiry_days');
    Route::get('/edit_expiry_days', 'ExpiryDateController@edit')->name('edit_expiry_days')->middleware('can:edit_expiry_days');
    Route::get('/view_expiry_days', 'ExpiryDateController@index')->name('view_expiry_days')->middleware('can:view_expiry_days');

    //ORDER
    Route::get('/order/{array?}/{str?}', 'OrderController@index')->name('order')->middleware('can:order');
    Route::get('/createOrder', 'OrderController@create')->name('createOrder')->middleware('can:createOrder');
    Route::post('/storeOrder', 'OrderController@store')->name('storeOrder')->middleware('can:storeOrder');
    Route::get('/editOrder', 'OrderController@edit')->name('editOrder')->middleware('can:editOrder');
    Route::post('/updateOrder', 'OrderController@update')->name('updateOrder')->middleware('can:updateOrder');
    Route::get('/deleteOrder', 'OrderController@delete')->name('deleteOrder')->middleware('can:deleteOrder');
    Route::get('/get_purposal', 'OrderController@get_purposal')->name('get_purposal')->middleware('can:get_purposal');
    Route::get('/purposal_lists', 'OrderController@purposal_lists')->name('purposal_lists')->middleware('can:purposal_lists');
    Route::get('/get_product_list', 'OrderController@get_product_list')->name('get_product_list')->middleware('can:get_product_list');
    Route::get('/checkQuery', 'OrderController@checkQuery')->name('checkQuery')->middleware('can:checkQuery');
    Route::get('/P', 'OrderController@view_order')->name('view_order')->middleware('can:view_order');
    //    Route::get('/order_advance_search/{array?}/{str?}', 'OrderController@order_advance_search')->name('order_advance_search');

    //BUSINESS PROFILE
    Route::get('/businessProfile', 'BusinessProfileController@businessProfile')->name('businessProfile')->middleware('can:businessProfile');
    Route::post('/updateBusinessProfile', 'BusinessProfileController@updateBusinessProfile')->name('updateBusinessProfile')->middleware('can:updateBusinessProfile');

    //TERM AND CONDITION
    Route::get('/TandC', 'TermAndConditionController@TandC')->name('TandC')->middleware('can:TandC');
    Route::get('/viewTandC', 'TermAndConditionController@viewTandC')->name('viewTandC')->middleware('can:viewTandC');
    Route::post('/storeTandC', 'TermAndConditionController@storeTandC')->name('storeTandC')->middleware('can:storeTandC');
    Route::get('/edit_tandc', 'TermAndConditionController@edit_tandc')->name('edit_tandc')->middleware('can:edit_tandc');
    Route::post('/update_tandc', 'TermAndConditionController@update_tandc')->name('update_tandc')->middleware('can:update_tandc');
    Route::get('/deleteTandC', 'TermAndConditionController@deleteTandC')->name('deleteTandC')->middleware('can:deleteTandC');

    //Designation
    Route::get('/designation', 'DesignationControlller@designation')->name('designation')->middleware('can:designation');
    Route::get('/create_designation', 'DesignationControlller@create_designation')->name('create_designation')->middleware('can:create_designation');
    Route::post('/storedesignation', 'DesignationControlller@storedesignation')->name('storedesignation')->middleware('can:storedesignation');
    Route::get('/edit_designation', 'DesignationControlller@edit_designation')->name('edit_designation')->middleware('can:edit_designation');
    Route::post('/update_designation', 'DesignationControlller@update_designation')->name('update_designation')->middleware('can:update_designation');
    Route::get('/deletedesignation', 'DesignationControlller@deletedesignation')->name('deletedesignation')->middleware('can:deletedesignation');

    //STATUS
    Route::get('/status', 'StatusController@index')->name('status')->middleware('can:status');
    Route::get('/createStatus', 'StatusController@create')->name('createStatus')->middleware('can:createStatus');
    Route::post('/storeStatus', 'StatusController@store')->name('storeStatus')->middleware('can:storeStatus');
    Route::get('/editStatus', 'StatusController@edit')->name('editStatus')->middleware('can:editStatus');
    Route::post('/updateStatus', 'StatusController@update')->name('updateStatus')->middleware('can:updateStatus');
    Route::get('/deleteStatus', 'StatusController@delete')->name('deleteStatus')->middleware('can:deleteStatus');

    //CATEGORY
    Route::get('/category', 'CategoryController@index')->name('category')->middleware('can:category');
    Route::get('/createCategory', 'CategoryController@create')->name('createCategory')->middleware('can:createCategory');
    Route::post('/storeCategory', 'CategoryController@store')->name('storeCategory')->middleware('can:storeCategory');
    Route::get('/editCategory', 'CategoryController@edit')->name('editCategory')->middleware('can:editCategory');
    Route::post('/updateCategory', 'CategoryController@update')->name('updateCategory')->middleware('can:updateCategory');
    Route::get('/deleteCategory', 'CategoryController@delete')->name('deleteCategory')->middleware('can:deleteCategory');

    //Region
    Route::get('/region', 'RegionController@index')->name('region')->middleware('can:region');
    Route::get('/viewRegion', 'RegionController@viewRegion')->name('viewRegion')->middleware('can:viewRegion');
    Route::post('/storeRegion', 'RegionController@store')->name('storeRegion')->middleware('can:storeRegion');
    Route::get('/editRegion', 'RegionController@edit')->name('editRegion')->middleware('can:editRegion');
    Route::post('/updateRegion', 'RegionController@update')->name('updateRegion')->middleware('can:updateRegion');
    Route::get('/deleteRegion', 'RegionController@delete')->name('deleteRegion')->middleware('can:deleteRegion');

    //Area
    Route::get('/area', 'AreaController@index')->name('area')->middleware('can:area');
    Route::get('/viewArea', 'AreaController@viewArea')->name('viewArea')->middleware('can:viewArea');
    Route::post('/storeArea', 'AreaController@store')->name('storeArea')->middleware('can:storeArea');
    Route::get('/editArea', 'AreaController@edit')->name('editArea')->middleware('can:editArea');
    Route::post('/updateArea', 'AreaController@update')->name('updateArea')->middleware('can:updateArea');
    Route::get('/deleteArea', 'AreaController@delete')->name('deleteArea')->middleware('can:deleteArea');

    //Sector
    Route::get('/sector', 'SectorController@index')->name('sector')->middleware('can:sector');
    Route::get('/viewSector', 'SectorController@viewSector')->name('viewSector')->middleware('can:viewSector');
    Route::post('/storeSector', 'SectorController@store')->name('storeSector')->middleware('can:storeSector');
    Route::get('/editSector', 'SectorController@edit')->name('editSector')->middleware('can:editSector');
    Route::post('/updateSector', 'SectorController@update')->name('updateSector')->middleware('can:updateSector');
    Route::get('/deleteSector', 'SectorController@delete')->name('deleteSector')->middleware('can:deleteSector');

    //Town
    Route::get('/town', 'TownController@town')->name('town')->middleware('can:town');
    Route::get('/createTown', 'TownController@createTown')->name('createTown')->middleware('can:createTown');
    Route::post('/storeTown', 'TownController@storeTown')->name('storeTown')->middleware('can:storeTown');
    Route::get('/editTown', 'TownController@editTown')->name('editTown')->middleware('can:editTown');
    Route::post('/updateTown', 'TownController@updateTown')->name('updateTown')->middleware('can:updateTown');
    Route::get('/deleteTown', 'TownController@deleteTown')->name('deleteTown')->middleware('can:deleteTown');

    //Ajax Controller
    Route::get('/insert_region', 'AjaxController@insert_region')->name('insert_region');
    Route::get('/insert_area', 'AjaxController@insert_area')->name('insert_area');
    Route::get('/insert_sector', 'AjaxController@insert_sector')->name('insert_sector');
    Route::get('/get_region', 'AjaxController@get_region')->name('get_region');
    Route::get('/get_area', 'AjaxController@get_area')->name('get_area');
    Route::get('/get_sector', 'AjaxController@get_sector')->name('get_sector');
    Route::get('/com_get_area', 'AjaxController@com_get_area')->name('com_get_area');
    Route::get('/com_get_sec', 'AjaxController@com_get_sec')->name('com_get_sec');
    Route::get('/get_cat', 'AjaxController@get_cat')->name('get_cat');
    // Route::get('/insert_sector', 'AjaxController@insert_sector')->name('insert_sector');
    Route::get('/user_role_ajax', 'AjaxController@user_role_ajax')->name('user_role_ajax');
    Route::get('/get_poc', 'AjaxController@get_poc')->name('get_poc');

    //Visit Type
    Route::get('/visitTypeCreate', 'VisitTypeController@visitTypeCreate')->name('visitTypeCreate')->middleware('can:visitTypeCreate');
    Route::get('/visitTypeView', 'VisitTypeController@visitTypeView')->name('visitTypeView')->middleware('can:visitTypeView');
    Route::post('/visitTypeStore', 'VisitTypeController@visitTypeStore')->name('visitTypeStore')->middleware('can:visitTypeStore');
    Route::get('/visitTypeEdit', 'VisitTypeController@visitTypeEdit')->name('visitTypeEdit')->middleware('can:visitTypeEdit');
    Route::post('/visitTypeUpdate', 'VisitTypeController@visitTypeUpdate')->name('visitTypeUpdate')->middleware('can:visitTypeUpdate');
    Route::get('/visitTypeDelete', 'VisitTypeController@visitTypeDelete')->name('visitTypeDelete')->middleware('can:visitTypeDelete');

    //Business Category
    Route::get('/businessCategory', 'BusinessCategoryController@businessCategory')->name('businessCategory')->middleware('can:businessCategory');
    Route::get('/view_businessCategory', 'BusinessCategoryController@view_businessCategory')->name('view_businessCategory')->middleware('can:view_businessCategory');
    Route::post('/store_businessCategory', 'BusinessCategoryController@store_businessCategory')->name('store_businessCategory')->middleware('can:store_businessCategory');
    Route::get('/edit_businessCategory', 'BusinessCategoryController@edit_businessCategory')->name('edit_businessCategory')->middleware('can:edit_businessCategory');
    Route::post('/update_businessCategory', 'BusinessCategoryController@update_businessCategory')->name('update_businessCategory')->middleware('can:update_businessCategory');
    Route::get('/delete_businessCategory', 'BusinessCategoryController@delete_businessCategory')->name('delete_businessCategory')->middleware('can:delete_businessCategory');

    //Target
    Route::get('/createTarget', 'TargetController@createTarget')->name('createTarget')->middleware('can:createTarget');
    Route::post('/storeTask', 'TargetController@storeTask')->name('storeTask');
    Route::post('/fetch_users', 'TargetController@fetch_users')->name('fetch_users');

    //Schedule Target
    Route::get('/schedule_target', 'TargetController@schedule_target')->name('schedule_target')->middleware('can:schedule_target');
    Route::get('/show_users_schedules', 'TargetController@show_users_schedules')->name('show_users_schedules')->middleware('can:show_users_schedules');

    //Funnel Target
    Route::get('/show_funnel_target', 'TargetController@show_funnel_target')->name('show_funnel_target')->middleware('can:show_funnel_target');
    Route::get('/show_users_funnel', 'TargetController@show_users_funnel')->name('show_users_funnel')->middleware('can:show_users_funnel');

    //quotations Target
    Route::get('/show_quotation_target', 'TargetController@show_quotation_target')->name('show_quotation_target')->middleware('can:show_quotation_target');
    Route::get('/show_users_quotation', 'TargetController@show_users_quotation')->name('show_users_quotation')->middleware('can:show_users_quotation');

    //Order Target
    Route::get('/show_order_target', 'TargetController@show_order_target')->name('show_order_target')->middleware('can:show_order_target');
    Route::get('/show_users_order', 'TargetController@show_users_order')->name('show_users_order')->middleware('can:show_users_order');

    //    Product Group Target
    Route::get('/show_product_group_target', 'TargetController@show_product_group_target')->name('show_product_group_target')->middleware('can:show_product_group_target');
    Route::get('/show_users_product_group', 'TargetController@show_users_product_group')->name('show_users_product_group')->middleware('can:show_users_product_group');

    //Schedule Reports
    Route::get('/scheduleReports', 'ReportsController@scheduleReports')->name('scheduleReports')->middleware('can:scheduleReports');
    Route::get('/sch_target', 'ReportsController@sch_target')->name('sch_target');
    Route::post('/showScheduleUsers', 'ReportsController@showScheduleUsers')->name('showScheduleUsers');
    Route::get('/total_sch_target', 'ReportsController@total_sch_target')->name('total_sch_target');

    //Funnel Reports
    Route::get('/funnelReports', 'ReportsController@funnelReports')->name('funnelReports')->middleware('can:funnelReports');
    Route::get('/funnel_target', 'ReportsController@funnel_target')->name('funnel_target');
    Route::post('/showFunnelUsers', 'ReportsController@showFunnelUsers')->name('showFunnelUsers');
    Route::get('/total_funnel_target', 'ReportsController@total_funnel_target')->name('total_funnel_target');

    //Purposal Reports
    Route::get('/purposalReports', 'ReportsController@purposalReports')->name('purposalReports')->middleware('can:purposalReports');
    Route::get('/purposal_target', 'ReportsController@purposal_target')->name('purposal_target');
    Route::post('/showPurposalUsers', 'ReportsController@showPurposalUsers')->name('showPurposalUsers');
    Route::get('/total_purposal_target', 'ReportsController@total_purposal_target')->name('total_purposal_target');

    //Order Reports
    Route::get('/orderReports', 'ReportsController@orderReports')->name('orderReports')->middleware('can:orderReports');
    Route::get('/order_target', 'ReportsController@order_target')->name('order_target');
    Route::post('/showOrderUsers', 'ReportsController@showOrderUsers')->name('showOrderUsers');
    Route::get('/total_order_target', 'ReportsController@total_order_target')->name('total_order_target');

    // Work Report
    Route::get('/all_work', 'ReminderController@all_work')->name('all_work')->middleware('can:all_work');
    Route::get('/all_work_data', 'ReminderController@all_work_data')->name('all_work_data');
    Route::get('/completed_work', 'ReminderController@completed_work')->name('completed_work')->middleware('can:completed_work');
    Route::get('/completed_work_data', 'ReminderController@completed_work_data')->name('completed_work_data');

    //    Notifications
    Route::post('/notification', 'ScheduleController@notification')->name('notification');

    //    Reminders
    // Route::post('/re_schedule_reminder', 'ReminderController@re_schedule_reminder')->name('re_schedule_reminder')->middleware('can:re_schedule_reminder');
    // Route::post('/re_order_reminder', 'ReminderController@re_order_reminder')->name('re_order_reminder')->middleware('can:re_order_reminder');
    // Route::post('/re_funnel_reminder', 'ReminderController@re_funnel_reminder')->name('re_funnel_reminder')->middleware('can:re_funnel_reminder');
    // Route::post('/re_purposal_reminder', 'ReminderController@re_purposal_reminder')->name('re_purposal_reminder')->middleware('can:re_purposal_reminder');
    Route::post('/sch_reminder', 'ReminderController@sch_reminder')->name('sch_reminder');
    Route::get('/scheduleReminder/{array?}/{str?}', 'ReminderController@scheduleReminder')->name('scheduleReminder')->middleware('can:scheduleReminder');
    Route::post('/funnel_reminder', 'ReminderController@funnel_reminder')->name('funnel_reminder');
    Route::get('/funnelReminder/{array?}/{str?}', 'ReminderController@funnelReminder')->name('funnelReminder')->middleware('can:funnelReminder');
    Route::post('/purposal_reminder', 'ReminderController@purposal_reminder')->name('purposal_reminder');
    Route::get('/purposalReminder/{array?}/{str?}', 'ReminderController@purposalReminder')->name('purposalReminder')->middleware('can:purposalReminder');
    Route::post('/order_reminder', 'ReminderController@order_reminder')->name('order_reminder');
    Route::get('/orderReminder/{array?}/{str?}', 'ReminderController@orderReminder')->name('orderReminder')->middleware('can:orderReminder');
    Route::post('/add_reminder', 'ReminderController@add_reminder')->name('add_reminder');
    Route::post('/role', 'ReminderController@role')->name('role');
    Route::get('/delete_schedule_reminder', 'ReminderController@delete_schedule_reminder')->name('delete_schedule_reminder')->middleware('can:delete_schedule_reminder');
    Route::get('/delete_funnel_reminder', 'ReminderController@delete_funnel_reminder')->name('delete_funnel_reminder')->middleware('can:delete_funnel_reminder');
    Route::get('/delete_invoice_reminder', 'ReminderController@delete_invoice_reminder')->name('delete_invoice_reminder')->middleware('can:delete_invoice_reminder');
    Route::get('/delete_order_reminder', 'ReminderController@delete_order_reminder')->name('delete_order_reminder')->middleware('can:delete_order_reminder');

    //    Remarks
    Route::post('/sch_remarks', 'RemarksController@sch_remarks')->name('sch_remarks');
    Route::get('/scheduleRemarks/{array?}/{str?}', 'RemarksController@scheduleRemarks')->name('scheduleRemarks')->middleware('can:scheduleRemarks');
    Route::post('/funnel_remarks', 'RemarksController@funnel_remarks')->name('funnel_remarks');
    Route::get('/funnelRemarks/{array?}/{str?}', 'RemarksController@funnelRemarks')->name('funnelRemarks')->middleware('can:funnelRemarks');
    Route::post('/purposal_remarks', 'RemarksController@purposal_remarks')->name('purposal_remarks');
    Route::get('/purposalRemarks/{array?}/{str?}', 'RemarksController@purposalRemarks')->name('purposalRemarks')->middleware('can:purposalRemarks');
    Route::post('/order_remarks', 'RemarksController@order_remarks')->name('order_remarks');
    Route::get('/orderRemarks/{array?}/{str?}', 'RemarksController@orderRemarks')->name('orderRemarks')->middleware('can:orderRemarks');
    Route::get('/all_remarks', 'RemarksController@all_remarks')->name('all_remarks')->middleware('can:all_remarks');
    Route::post('/fetching_remarks', 'RemarksController@fetching_remarks')->name('fetching_remarks');

    //    Pagination
    Route::get('/pagination', 'PaginationController@index');
    Route::get('/pagination/fetch_data', 'PaginationController@fetch_data');

    //    PDF
    Route::get('pdf/{array?}/{str?}', 'PdfController@pdf')->name('pdf');

    //    Main Unit
    Route::get('/mainUnit', 'MainUnitController@mainUnit')->name('mainUnit')->middleware('can:mainUnit');
    Route::get('/mainUnitCreate', 'MainUnitController@mainUnitCreate')->name('mainUnitCreate')->middleware('can:mainUnitCreate');
    Route::post('/mainUnitStore', 'MainUnitController@mainUnitStore')->name('mainUnitStore')->middleware('can:mainUnitStore');
    Route::get('/mainUnitEdit', 'MainUnitController@mainUnitEdit')->name('mainUnitEdit')->middleware('can:mainUnitEdit');
    Route::post('/mainUnitUpdate', 'MainUnitController@mainUnitUpdate')->name('mainUnitUpdate')->middleware('can:mainUnitUpdate');
    Route::get('/mainUnitDelete', 'MainUnitController@mainUnitDelete')->name('mainUnitDelete')->middleware('can:mainUnitDelete');

    //    Unit Of Measurement
    Route::get('/uom', 'UnitController@uom')->name('uom')->middleware('can:uom');
    Route::get('/uomCreate', 'UnitController@uomCreate')->name('uomCreate')->middleware('can:uomCreate');
    Route::post('/uomStore', 'UnitController@uomStore')->name('uomStore')->middleware('can:uomStore');
    Route::get('/uomEdit', 'UnitController@uomEdit')->name('uomEdit')->middleware('can:uomEdit');
    Route::post('/uomUpdate', 'UnitController@uomUpdate')->name('uomUpdate')->middleware('can:uomUpdate');
    Route::get('/uomDelete', 'UnitController@uomDelete')->name('uomDelete')->middleware('can:uomDelete');

    //    Product Group
    Route::get('/productGroup', 'ProductGroupController@productGroup')->name('productGroup')->middleware('can:productGroup');
    Route::get('/productGroupCreate', 'ProductGroupController@productGroupCreate')->name('productGroupCreate')->middleware('can:productGroupCreate');
    Route::post('/productGroupStore', 'ProductGroupController@productGroupStore')->name('productGroupStore')->middleware('can:productGroupStore');
    Route::get('/productGroupEdit', 'ProductGroupController@productGroupEdit')->name('productGroupEdit')->middleware('can:productGroupEdit');
    Route::post('/productGroupUpdate', 'ProductGroupController@productGroupUpdate')->name('productGroupUpdate')->middleware('can:productGroupUpdate');
    Route::get('/productGroupDelete', 'ProductGroupController@productGroupDelete')->name('productGroupDelete')->middleware('can:productGroupDelete');

    //User
    Route::get('/user', 'UserController@index')->name('user')->middleware('can:user');
    Route::get('/createuser', 'UserController@create')->name('createuser')->middleware('can:createuser');
    Route::post('/storeuser', 'UserController@store')->name('storeuser')->middleware('can:storeuser');
    Route::get('/edituser', 'UserController@edit')->name('edituser')->middleware('can:edituser');
    Route::post('/updateuser', 'UserController@update')->name('updateuser')->middleware('can:updateuser');
    Route::get('/deleteuser', 'UserController@delete')->name('deleteuser')->middleware('can:deleteuser');
    // User Profile
    Route::get('/editProfile', 'UserController@editProfile')->name('editProfile')->middleware('can:editProfile');
    Route::post('/updateProfile', 'UserController@updateProfile')->name('updateProfile')->middleware('can:updateProfile');
    Route::get('/checkUser', 'UserController@checkUser')->name('checkUser')->middleware('can:checkUser');
    Route::get('/checkEmail', 'UserController@checkEmail')->name('checkEmail')->middleware('can:checkEmail');
    Route::get('/changeStatus', 'UserController@changeStatus')->name('changeStatus')->middleware('can:changeStatus');

    // Farhad
    // password Chage
    Route::get('/change-password', 'ChangePasswordController@index')->name('change-password')->middleware('can:change-password');
    Route::post('/change_password', 'ChangePasswordController@store')->name('change_password')->middleware('can:change_password');
    //    User Role
    // Route::get('/user_role', 'UserRoleController@user_role')->name('user_role')->middleware('can:user_role');
    // Route::get('/user_role_create', 'UserRoleController@user_role_create')->name('user_role_create')->middleware('can:user_role_create');
    // Route::post('/user_role_store', 'UserRoleController@user_role_store')->name('user_role_store')->middleware('can:user_role_store');
    // Route::get('/user_role_edit', 'UserRoleController@user_role_edit')->name('user_role_edit')->middleware('can:user_role_edit');
    // Route::post('/user_role_update', 'UserRoleController@user_role_update')->name('user_role_update')->middleware('can:user_role_update');
    // Route::get('/user_role_delete', 'UserRoleController@user_role_delete')->name('user_role_delete')->middleware('can:user_role_delete');

    //    Modular Group
    Route::get('/modular_group', 'ModularGroupController@modular_group')->name('modular_group')->middleware('can:modular_group');
    Route::get('/create_modular_group', 'ModularGroupController@create_modular_group')->name('create_modular_group')->middleware('can:create_modular_group');
    Route::post('/store_modular_group', 'ModularGroupController@store_modular_group')->name('store_modular_group')->middleware('can:store_modular_group');
    Route::get('/edit_modular_group', 'ModularGroupController@edit_modular_group')->name('edit_modular_group')->middleware('can:edit_modular_group');
    Route::post('/update_modular_group', 'ModularGroupController@update_modular_group')->name('update_modular_group')->middleware('can:update_modular_group');
    Route::get('/delete_modular_group', 'ModularGroupController@delete_modular_group')->name('delete_modular_group')->middleware('can:delete_modular_group');

    // Product Update
    Route::get('/product_price_update', 'ProductPriceUpdateController@product_price_update')->name('product_price_update')->middleware('can:product_price_update');
    Route::post('/update_product_price', 'ProductPriceUpdateController@update_product_price')->name('update_product_price')->middleware('can:update_product_price');

    // Farhad
    // forget Product
    // Route::get('/get_products', [App\Http\Controllers\DeadController::class, 'get_products'])->name('get_products');
    // for mail
    Route::get('/email', function () {
        $to_name = 'farhad';
        $to_email = 'farhadsfz86@gmail.com';
        $data = ['name' => 'Peter Parker', 'body' => 'test Mail'];
        Mail::send('mail', $data);
        return new WelcomeMail();
    });
    // for mail
    // Route::get('/email', function () {
    //     Mail::to('email@email.com')->send(new WelcomeMail());
    //     return new WelcomeMail();
    // });
    // Route::get('send-mail', function () {

    //     $details = [
    //         'title' => 'Mail from ItSolutionStuff.com',
    //         'body' => 'This is for testing email using smtp'
    //     ];

    //     \Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\WelcomeMail($details));

    //     dd("Email is Sent.");
    // });
});
Route::middleware(['checkUserId'])->group(function () {
    Route::get('/add_company', [App\Http\Controllers\CompanyController::class, 'create'])->name('add_company');
    Route::post('/store_company', [App\Http\Controllers\CompanyController::class, 'store'])->name('store_company');
    Route::get('/company_list', [App\Http\Controllers\CompanyController::class, 'company_list'])->name('company_list');
});
//AUTH
Auth::routes();
