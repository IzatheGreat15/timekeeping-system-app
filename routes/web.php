<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\MainLeaveController;
use App\Http\Controllers\SubLeaveController;
use App\Http\Controllers\UserController;

use App\Models\Department;
use App\Models\Shift;
use App\Models\Main_Leave;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('employee.dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

/* Replace the 'id' in the URL with actual ID */

/* General */
Route::view("/change-password", 'general.change-password');
Route::view("/manage-account", 'general.manage-account');
Route::view("/notifications", 'general.notifications');

/* Time in/out */
Route::view("/time-in-out", 'employee.dashboard');

/* Attendance */
Route::view("/attendance-records", 'employee.attendance-record');
Route::view("/attendance-records-id", 'employee.attendance-spec');
Route::view("/adjustment-records", 'employee.adjustment-record');
Route::view("/adjustment-records-id", 'employee.adjustment-spec');
Route::view("/adjustment-new", 'employee.adjustment-new');
Route::view("/adjustment-edit-id", 'employee.adjustment-edit');

/* Shift */
Route::view("/shift-records", 'employee.shift-record');
Route::view("/shift-records-id", 'employee.shift-spec');
Route::view("/shift-change", 'employee.shift-change');
Route::view("/shift-change-id", 'employee.shift-change-spec');
Route::view("/shift-change-new", 'employee.shift-change-new');
Route::view("/shift-change-edit", 'employee.shift-change-edit');

/* Leave */
Route::view("/leave-records", 'employee.leave-record');
Route::view("/leave-records-id", 'employee.leave-spec');
Route::view("/leave-request", 'employee.leave-request');
Route::view("/leave-request-new", 'employee.leave-request-new');
Route::view("/leave-request-edit", 'employee.leave-request-edit');

/* Overtime */
Route::view("/overtime-records", 'employee.overtime-records');
Route::view("/overtime-records-id", 'employee.overtime-spec');
Route::view("/overtime-request", 'employee.overtime-request');
Route::view("/overtime-request-new", 'employee.overtime-request-new');
Route::view("/overtime-request-edit", 'employee.overtime-request-edit');

/* Management */
Route::view("/management", 'management.dashboard');
Route::view("/employee-records-id", 'management.employee-spec');

Route::view("/approve-adjustments", 'management.adjustment');
Route::view("/adjustment-approvals-id", 'management.adjustment-approvals-id');

Route::view("/approve-shift-change", 'management.shift');
Route::view("/shift-approvals-id", 'management.shift-approval-id');

Route::view("/approve-leaves", 'management.leave');
Route::view("/leave-approvals-id", 'management.leave-approval-id');

Route::view("/approve-overtimes", 'management.overtime');
Route::view("/overtime-approvals-id", 'management.overtime-approval-id');

Route::view("/manage-shifts", 'management.manage-shift');
Route::view("/shift-manage-id", 'management.shift-manage-id');
Route::view("/shift-manage-new", 'management.manage-shift-new');
Route::view("/shift-manage-edit", 'management.manage-shift-edit');




/* Admin */
Route::get("/departments", [DepartmentController::class, "show_department"]);
Route::view("/department-new", 'admin.department-new');
Route::post("/add-new-department", [DepartmentController::class, "add_department"]);
Route::get("/department-edit/{id}", [DepartmentController::class, "edit_department"]);
Route::post("/department-update", [DepartmentController::class, "update_department"]);
Route::post("/department-delete", [DepartmentController::class, "delete_department"]);
Route::post("/department-search", [DepartmentController::class, "search_department"]);

Route::get("/shifts", [ShiftController::class, "show_shift"]);
Route::view("/shift-new", 'admin.shift-new');
Route::post("/add-new-shift", [ShiftController::class, "add_shift"]);
Route::get("/shift-edit/{id}", [ShiftController::class, "edit_shift"]);
Route::post("/shift-update", [ShiftController::class, "update_shift"]);
Route::post("/shift-delete", [ShiftController::class, "delete_shift"]);
Route::post("/shift-search", [ShiftController::class, "search_shift"]);

Route::get("/leaves-category", [MainLeaveController::class, "show_main_leave"]);
Route::get("/leave-category-details/{id}", [MainLeaveController::class, "display_main_leave"]);
Route::view("/leave-category-new", 'admin.leave-cat-new');
Route::post("/add-new-main-leave", [MainLeaveController::class, "add_main_leave"]);
Route::get("/leave-category-edit/{id}", [MainLeaveController::class, "edit_main_leave"]);
Route::post("/main-leave-update", [MainLeaveController::class, "update_main_leave"]);
Route::post("/main-leave-delete", [MainLeaveController::class, "delete_main_leave"]);
Route::post("/leave-category-search", [MainLeaveController::class, "search_main_leave"]);

Route::get("/leaves-subcategory", [SubLeaveController::class, "show_sub_leave"]);
Route::get("/leave-subcategory-new", [SubLeaveController:: class, "add_sub_leave"]);
Route::post("/add-new-sub-leave", [SubLeaveController:: class, "store_sub_leave"]);
Route::get("/leave-subcategory-edit/{id}", [SubLeaveController::class, "edit_sub_leave"]);
Route::post("/sub-leave-update", [SubLeaveController::class, "update_sub_leave"]);
Route::post("/sub-leave-delete", [SubLeaveController::class, "delete_sub_leave"]);
Route::post("/leave-subcategory-search", [SubLeaveController::class, "search_sub_leave"]);


Route::get("/accounts", [UserController::class, "show_account"]);
//Route::view("/account-new", 'admin.account-new');
Route::get("/account-new", [UserController::class, "new_account"]);
Route::get('/account/ajax', [UserController::class, "account_dropdown"]);
Route::post("/add-new-account", [UserController::class, "store_account"]);
Route::get("/account-edit/{id}", [UserController::class, "edit_account"]);
Route::post("/account-update", [UserController::class, "update_account"]);
Route::post("/account-delete", [UserController::class, "delete_account"]);
Route::post("/account-search", [UserController::class, "search_account"]);

require __DIR__.'/auth.php';
