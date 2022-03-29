<?php

use Illuminate\Support\Facades\Route;

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
Route::view("/admin-time-in-out", 'admin.dashboard');

Route::view("/departments", 'admin.department');
Route::view("/department-new", 'admin.department-new');
Route::view("/department-edit", 'admin.department-edit');

Route::view("/shifts", 'admin.shift');
Route::view("/shift-new", 'admin.shift-new');
Route::view("/shift-edit", 'admin.shift-edit');

Route::view("/leaves-category", 'admin.leave-cat');
Route::view("/leave-category-details", 'admin.leave-cat-spec');
Route::view("/leave-category-new", 'admin.leave-cat-new');
Route::view("/leave-category-edit", 'admin.leave-cat-edit');
Route::view("/leaves-subcategory", 'admin.leave-subcat');
Route::view("/leave-subcategory-new", 'admin.leave-subcat-new');
Route::view("/leave-subcategory-edit", 'admin.leave-subcat-edit');

Route::view("/accounts", 'admin.account');
Route::view("/account-new", 'admin.account-new');
Route::view("/account-edit", 'admin.account-edit');

require __DIR__.'/auth.php';
