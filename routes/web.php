<?php

use App\Http\Controllers\AdjustmentEmpController;
use App\Http\Controllers\ChangeShiftEmpController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeaveEmpController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\MainLeaveController;
use App\Http\Controllers\OvertimeEmpController;
use App\Http\Controllers\SubLeaveController;
use App\Http\Controllers\UserController;

use App\Models\Department;
use App\Models\LeaveEmp;
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
    return view('auth.login');
});

Route::get('/time-in-out', function () {
    return view('employee.dashboard');
})->middleware(['auth'])->name('dashboard');

/* Replace the 'id' in the URL with actual ID */

/* General */
Route::view("/change-password", 'general.change-password');
Route::view("/manage-account", 'general.manage-account');
Route::view("/notifications", 'general.notifications');
Route::get("/logout-user", [UserController::class, "logout_user"]);

/* Time in/out */
//Route::view("/time-in-out", 'employee.dashboard');

/* Attendance */
Route::view("/attendance-records", 'employee.attendance-record');
Route::view("/attendance-records-id", 'employee.attendance-spec');

/* Adjustment */
Route::get("/adjustment-records", [AdjustmentEmpController::class, "show_adjustment"]);
Route::get("/adjustment-records/{id}", [AdjustmentEmpController::class, "view_adjustment"]);
Route::view("/adjustment-new", 'employee.adjustment-new');
Route::post("/adjustment-add", [AdjustmentEmpController::class, "add_adjustment"]);
Route::view("/adjustment-edit-id", 'employee.adjustment-edit');
Route::post("/adjustment-delete", [AdjustmentEmpController::class, "delete_adjustment"]);

/* Shift */
Route::get("/shift-records", [ChangeShiftEmpController::class, "display_shift_records"]);
Route::get("/shift-records/{id}", [ChangeShiftEmpController::class, "view_change_shift"]);
Route::get("/shift-change", [ChangeShiftEmpController::class, "display_change_shift"]);
Route::get("/shift-change/{id}", [ChangeShiftEmpController::class, "view_change_shift"]);
Route::get("/shift-change-new", [ChangeShiftEmpController::class, "new_change_shift"]);
Route::post("/shift-change-add", [ChangeShiftEmpController::class, "add_change_shift"]);
Route::get("/shift-change-edit/{id}", [ChangeShiftEmpController::class, "edit_change_shift"]);
Route::post("/shift-change-update", [ChangeShiftEmpController::class, "update_change_shift"]);
Route::post("/shift-change-delete", [ChangeShiftEmpController::class, "delete_change_shift"]);
//search to be done

/* Leave */
Route::get("/leave-records", [LeaveEmpController::class, "show_leave_record"]);
Route::get("/leave-records/{id}", [LeaveEmpController::class, "view_leave_record"]);
Route::get("/leave-request", [LeaveEmpController::class, "show_leave_request"]);
Route::get("/leave-request-new", [LeaveEmpController::class, "new_leave_request"]);
Route::post("/add-leave-request", [LeaveEmpController::class, "add_leave_request"]);
Route::get("/leave-request-edit/{id}", [LeaveEmpController::class, "edit_leave_request"]);
Route::post("/leave-request-update", [LeaveEmpController::class, "update_leave_request"]);
Route::post("/leave-request-delete", [LeaveEmpController::class, "delete_leave_request"]);
Route::post("/leave-request-search", [LeaveEmpController::class, "search_leave_request"]);

/* Overtime */
Route::view("/overtime-records", 'employee.overtime-records');
Route::view("/overtime-records-id", 'employee.overtime-spec');
Route::get("/overtime-request", [OvertimeEmpController::class, "show_overtime_requests"]);
Route::view("/overtime-request-new", 'employee.overtime-request-new');
//Route::view("/overtime-request/{id}", /* add the controller class */); //shows employee.overtime-spec
Route::get("/overtime-request-edit/{id}", [OvertimeEmpController::class, "edit_overtime_request"]);
Route::post("/overtime-request-created", [OvertimeEmpController::class, "add_overtime_request"]);

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
