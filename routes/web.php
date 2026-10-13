<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ProductSoldController;
use App\Http\Controllers\ClientNoteController;
use App\Http\Controllers\ClientCommentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\EstimateController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RemoteSalesRegistrationController;
use App\Http\Middleware\SetUserPermission;

Route::get('/', function () {
    return view('auth/login');
});

// Remote Sales Registration
Route::get('/register/remote-sales', [RemoteSalesRegistrationController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register/step1', [RemoteSalesRegistrationController::class, 'submitStep1'])->name('register.step1');
Route::post('/register/step2', [RemoteSalesRegistrationController::class, 'submitStep2'])->name('register.step2');
Route::post('/register/step3', [RemoteSalesRegistrationController::class, 'submitStep3'])->name('register.step3');

Route::get('/user/status', function () {
    return response()->json([
        'isLoggedIn' => Auth::check(),
        'userId' => Auth::id()
    ]);
});


Route::group(['middleware' => [\App\Http\Middleware\SetUserPermission::class]], function () {
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
//    'set_user_permission'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


Route::get('/settings/services',[SettingsController::class,'services'])->name('services');
Route::get('/settings/service/{id}',[SettingsController::class,'service'])->name('service');
Route::post('/settings/service/add',[SettingsController::class,'addService'])->name('add_services');
Route::get('/settings/service/edit/{id}',[SettingsController::class,'editService'])->name('edit_services');
Route::post('/settings/service/update',[SettingsController::class,'updateService'])->name('update_services');
Route::get('/settings/verticals',[SettingsController::class,'verticals'])->name('verticals');
Route::get('/settings/vertical/{id}',[SettingsController::class,'vertical'])->name('vertical');
Route::post('/settings/verticals/add',[SettingsController::class,'addvertical'])->name('add_vertical');
Route::get('/settings/vertical/edit/{id}',[SettingsController::class,'editvertical'])->name('edit_vertical');
Route::post('/settings/vertical/update',[SettingsController::class,'updatevertical'])->name('update_vertical');
Route::get('/settings/products',[SettingsController::class,'products'])->name('products');
Route::get('/settings/product/{id}',[SettingsController::class,'product'])->name('product');
Route::post('/settings/products/add',[SettingsController::class,'addproduct'])->name('add_product');
Route::get('/settings/product/edit/{id}',[SettingsController::class,'editproduct'])->name('edit_product');
Route::post('/settings/product/update',[SettingsController::class,'updateproduct'])->name('update_product');

Route::get('/settings/tags',[SettingsController::class,'tags'])->name('tags');
Route::get('/settings/tag/{id}',[SettingsController::class,'tag'])->name('tag');
Route::post('/settings/tags/add',[SettingsController::class,'addtag'])->name('add_tag');
Route::get('/settings/tag/edit/{id}',[SettingsController::class,'edittag'])->name('edit_tag');
Route::post('/settings/tag/update',[SettingsController::class,'updatetag'])->name('update_tag');


Route::get('/leads', [LeadController::class, 'index'])->name('leads');
Route::get('/leads/create', [LeadController::class, 'create'])->name('add_lead_page');
Route::post('/leads/save',[LeadController::class, 'store'] )->name('post_lead');
Route::get('/leads/import', [LeadController::class, 'import_page'])->name('import_lead_page');
Route::post('/leads/list', [LeadController::class, 'paginate'])->name('datatables_leads');
Route::get('/leads/edit/{lead}', [LeadController::class,'edit'])->name('edit_lead_page');
Route::post('/leads/cancel', [LeadController::class,'cancel'])->name('cancel_lead');
Route::patch('leads//edit/{lead}', [LeadController::class,'update'])->name('patch_lead');
Route::get('product-sold/{clientId}', [ProductSoldController::class, 'view']);
Route::get('client-notes', [ClientNoteController::class,'index']);
Route::get('client-notes/create', [ClientNoteController::class,'create']);
Route::match(['post', 'put'], 'client-notes', [ClientNoteController::class,'store']);
Route::get('client-notes/{clientId}', [ClientNoteController::class,'view'])->name('client-notes');
Route::get('client-notes/{clientId}/edit', [ClientNoteController::class,'edit'])->name('edit-client-notes');
Route::match(['post', 'put'], 'client-notes/{clientId}', [ClientNoteController::class,'update'])->name('update-client-notes');
Route::get('/leads/lead-comments/{clientId}/{comment_type}',[LeadController::class, 'leadComments'] )->name('lead-comments');
Route::get('/leads/lead-comment/{commentId}',[LeadController::class, 'leadComment'] )->name('lead-comment');
Route::post('/leads/lead-comments',[LeadController::class, 'createLeadComments'] )->name('lead-comments');
Route::get('/leads/lead-comment/{clientId}/edit',[LeadController::class, 'editleadComments'] )->name('edit-lead-comments');
Route::put('/leads/lead-comment/{clientId}/update', [LeadController::class,'updateLeadComments'])->name('update-lead-comments');

Route::get('client-notes/{clientId}/sections/{section}/create', [ClientNoteController::class,'createSection'])->name('create-section');
Route::post('client-notes', [ClientNoteController::class,'storeSection'])->name('create-section');
Route::get('client-notes/{clientId}/sections/{section}', [ClientNoteController::class,'viewSection'])->name('view-section');
Route::get('client-notes/{clientId}/sections/{section}/edit', [ClientNoteController::class,'editSection'])->name('edit-section');
Route::post('client-notes/{clientId}/sections/{section}', [ClientNoteController::class,'updateSection'])->name('edit-section');

Route::get('client-comments', [ClientCommentController::class,'index'])->name('customer_dashboard');
Route::post('client-comments/{customerId}/create', [ClientCommentController::class,'create']);
Route::get('client-comments/{customerId}', [ClientCommentController::class,'detail']);
Route::get('client-comment/{customerId}', [ClientCommentController::class,'getComment']);
Route::post('client-comments/{customerId}', [ClientCommentController::class,'detail']);
Route::get('client-comments/{commentId}/edit', [ClientCommentController::class,'edit']);
Route::put('client-comments/{commentId}/edit', [ClientCommentController::class,'update']);


Route::get('product-sold/create', [ProductSoldController::class,'create']);
Route::match(['post', 'put'], 'product-sold', [ProductSoldController::class,'store']);
Route::get('product-sold/{clientId}', [ProductSoldController::class,'view']);
Route::get('product-sold/{clientId}/edit', [ProductSoldController::class,'edit']);
Route::match(['post', 'put'], 'product-sold/{productSoldId}', [ProductSoldController::class,'update']);

Route::match(['get', 'post'], 'payment-options', [PaymentController::class,'paymentOptions']);

  Route::prefix('tasks')->group(function (){

        Route::get('/', [TaskController::class,'index'])->name('task_list');
        Route::get('/kanban', [TaskController::class,'kanban_view'])->name('task_canban_view');

        Route::post('/upload/attachment', [TaskController::class,'upload_attachment'])->name('upload_task_attachment');

        Route::post('/list', [TaskController::class,'paginate'])->name('datatables_tasks');
        Route::get('/create', [TaskController::class,'create'])->name('add_task_page');
        Route::post('/create', [TaskController::class,'store'])->name('post_task');

        Route::get('/edit/{task}', [TaskController::class,'edit'])->name('edit_task_page');
        Route::patch('/edit/{task?}', [TaskController::class,'update'])->name('patch_task');
        Route::get('/remove/{task}', [TaskController::class,'destroy'])->name('delete_task');

        Route::get('/show/{task}', [TaskController::class,'show'])->name('show_task_page');
        Route::post('/comment/{task}', [TaskController::class,'post_task_comment'])->name('post_task_comment');
        Route::patch('/comment/{task}/{comment}', [TaskController::class,'update_task_comment'])->name('patch_task_comment');

        Route::get('/show/{task}/change/status/{status_id}', [TaskController::class,'change_status'])->name('task_change_status');
        Route::post('/change/status', [TaskController::class,'change_status'])->name('task_change_status_ajax');


        Route::get('/related', [TaskController::class,'task_related'])->name('task_related');
        Route::get('/parent/list', [TaskController::class,'parent_tasks'])->name('get_parent_tasks');


        Route::get('/component', [TaskController::class,'tasks_by_component_id'])->name('tasks_by_component_id');

        Route::post('/component/{component}/{id}', [TaskController::class,'tasks_by_component_id_paginate'])->name('datatable_tasks_by_component_id');

        Route::post('/comments/{task}', [TaskController::class,'comments'])->name('datatable_tasks_comments');

        //Route::get('/comment/delete/{comment}', [CommentController::class,'destroy'])->name('delete_comment');

        Route::post('/update/milestone', [TaskController::class,'update_task_milestone'])->name('task_update_milestone');

        Route::post('/assign/{task}', [TaskController::class,'assign_task'])->name('assign_task');

        Route::get('/show/{task}?comment={comment_id}', [TaskController::class,'show'])->name('show_task_comment');


        Route::get('/convert/ticket/{ticket_comment_thread_id}', [TaskController::class,'convert_ticket_to_task'])->name('convert_ticket_to_task');
        Route::get('/file_download/{id}', [TaskController::class,'download'])->name('attachment_download_link');
        Route::get('/delete_file/{id}', [TaskController::class,'deleteFile'])->name('attachment_delete_link');
    });

	    //Users
	    Route::get('/users', [UserController::class,'index'])->name('users');
	    Route::get('/user/create', [UserController::class,'create'])->name('add_user_page');
	    Route::get('/user/edit/{user}', [UserController::class,'edit'])->name('edit_user_page');
	    Route::post('/user/create', [UserController::class,'store'])->name('post_user');
	    Route::patch('/user/edit/{user?}', [UserController::class,'update'])->name('patch_user');
	    
            // Roles
            Route::get('/user/roles', [RoleController::class,'index'])->name('role_list');
            Route::post('/user/roles', [RoleController::class,'paginate'])->name('datatables_roles');
            Route::get('/user/roles/add', [RoleController::class,'create'])->name('create_role_page');
            Route::post('/user/roles/add', [RoleController::class,'store'])->name('post_role');
            Route::get('/user/roles/edit/{role}', [RoleController::class,'edit'])->name('edit_role_page');
            Route::patch('/user/roles/update/{id}', [RoleController::class,'update'])->name('patch_role');
            Route::get('/user/roles/remove/{role}', [RoleController::class,'destroy'])->name('delete_role');
});

   
});