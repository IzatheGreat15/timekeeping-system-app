<?php
use Routes\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeaveEmpController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\MainLeaveController;
use App\Http\Controllers\OvertimeEmpController;
use App\Http\Controllers\SubLeaveController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdjustmentEmpController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ChangeShiftEmpController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\NotifRequestController;
use App\Http\Controllers\ShiftEmpController;
use App\Models\Attendance;
use App\Models\Department;
use App\Models\LeaveEmp;
use App\Models\Shift;
use App\Models\Main_Leave;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifMail;
use App\Models\ChangeShiftEmp;

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
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('/time-in-out');
    });

    Route::get('/time-in-out', function () {
        return view('employee.dashboard');
    })->middleware(['auth'])->name('dashboard');

    /* Replace the 'id' in the URL with actual ID */

    /* General */
    Route::get('/time-in-out', [AttendanceController::class, "display_dashboard"]);
    Route::view("/change-password", 'general.change-password');
    Route::post("/change-password-user", [UserController::class, "change_password"]);
    Route::get("/manage-account", [UserController::class, "show_account_auth"]);
    Route::post("/manage-account-auth", [UserController::class, "manage_account"]);
    Route::get("/logout-user", [UserController::class, "logout_user"]);
    Route::get("/notifications", [ApprovalController::class, "show_notifs"]);
    //Route::view("/notifications", 'general.notifications');
    Route::get("/logout-user", [UserController::class, "logout_user"]);

    /* Time in/out */
    Route::get("/time-in/{id}", [AttendanceController::class, "time_in"]);
    Route::get("/time-out/{id}", [AttendanceController::class, "time_out"]);

    /* Attendance */
    Route::get("/attendance-records", [AttendanceController::class, "show_attendance"]);
    Route::get("/attendance-records/{id}", [AttendanceController::class, "view_attendance"]);
    Route::post("/search-export-attendance", [AttendanceController::class, "search_export_attendance"]);

    /* Adjustment */
    Route::get("/adjustment-records", [AdjustmentEmpController::class, "show_adjustment"]);
    Route::get("/adjustment-records/{id}", [AdjustmentEmpController::class, "view_adjustment"]);
    Route::view("/adjustment-new", 'employee.adjustment-new');
    Route::post("/adjustment-add", [AdjustmentEmpController::class, "add_adjustment"]);
    Route::get("/adjustment-edit/{id}", [AdjustmentEmpController::class, "edit_adjustment"]);
    Route::post("/adjustment_update", [AdjustmentEmpController::class, "update_adjustment"]);
    Route::post("/adjustment_delete", [AdjustmentEmpController::class, "delete_adjustment"]);
    Route::post("/adjustment-search", [AdjustmentEmpController::class, "search_adjustment"]);

    /* Shift */
    Route::get("/shift-records", [ChangeShiftEmpController::class, "display_shift_records"]);
    Route::post("/shift-records-search", [ChangeShiftEmpController::class, "search_shift_records"]);

    Route::get("/shift-change", [ChangeShiftEmpController::class, "display_change_shift"]);
    Route::get("/shift-change/{id}", [ChangeShiftEmpController::class, "view_change_shift"]);
    Route::get("/shift-change-new", [ChangeShiftEmpController::class, "new_change_shift"]);
    Route::post("/shift-change-add", [ChangeShiftEmpController::class, "add_change_shift"]);
    Route::get("/shift-change-edit/{id}", [ChangeShiftEmpController::class, "edit_change_shift"]);
    Route::post("/shift-change-update", [ChangeShiftEmpController::class, "update_change_shift"]);
    Route::post("/shift-change-delete", [ChangeShiftEmpController::class, "delete_change_shift"]);
    Route::post("/shift-change-search", [ChangeShiftEmpController::class, "search_change_shift"]);

    /* Leave */
    Route::get("/leave-records", [LeaveEmpController::class, "show_leave_record"]);
    Route::get("/leave-records/{id}", [LeaveEmpController::class, "view_leave_record"]);
    Route::post("/leave-records-search", [LeaveEmpController::class, "search_leave_record"]);

    Route::get("/leave-request", [LeaveEmpController::class, "show_leave_request"]);
    Route::get("/leave-request-new", [LeaveEmpController::class, "new_leave_request"]);
    Route::post("/add-leave-request", [LeaveEmpController::class, "add_leave_request"]);
    Route::get("/leave-request-edit/{id}", [LeaveEmpController::class, "edit_leave_request"]);
    Route::post("/leave-request-update", [LeaveEmpController::class, "update_leave_request"]);
    Route::post("/leave-request-delete", [LeaveEmpController::class, "delete_leave_request"]);
    Route::post("/leave-request-search", [LeaveEmpController::class, "search_leave_request"]);
    Route::get("/download/{filename}/{id}", [LeaveEmpController::class, "download_file"]);

    /* Overtime */
    Route::get("/overtime-records", [OvertimeEmpController::class, "show_overtime_records"]);
    Route::get("/overtime-records/{id}", [OvertimeEmpController::class, "view_overtime_request"]);
    Route::post("/overtime-record-search", [OvertimeEmpController::class, "search_overtime_record"]);

    Route::get("/overtime-request", [OvertimeEmpController::class, "show_overtime_requests"]);
    Route::view("/overtime-request-new", 'employee.overtime-request-new');
    Route::get("/overtime-request/{id}", [OvertimeEmpController::class, "view_overtime_request"]);
    Route::get("/overtime-request-edit/{id}", [OvertimeEmpController::class, "edit_overtime_request"]);
    Route::post("/overtime-request-created", [OvertimeEmpController::class, "add_overtime_request"]);
    Route::post("/overtime-request-edited", [OvertimeEmpController::class, "update_overtime_request"]);
    Route::post("/overtime-request-deleted", [OvertimeEmpController::class, "delete_overtime_request"]);
    Route::post("/overtime-request-search", [OvertimeEmpController::class, "search_overtime_request"]);

    /* Management */

    Route::get("/management", [ManagementController::class, "show_management_dash"]);
    Route::get("/employee-records-id/{id}", [ManagementController::class, "show_management_emp_indiv"]);

    Route::get("/approve-adjustments", [ManagementController::class, "show_management_attendance_adjustment"]);
    Route::get("/adjustment-approvals-id/{id}", [ManagementController::class, "show_management_attendance_adjustment_indiv"]);

    Route::get("/approve-shift-change", [ManagementController::class, "show_management_shift_adjustment"]);
    Route::get("/shift-approvals-id/{id}", [ManagementController::class, "show_management_shift_adjustment_indiv"]);

    Route::get("/approve-leaves", [ManagementController::class, "show_management_leaves"]);
    Route::get("/leave-approvals-id/{id}", [ManagementController::class, "show_management_leaves_indiv"]);

    Route::get("/approve-overtimes", [ManagementController::class, "show_management_overtimes"]);
    Route::get("/overtime-approvals-id/{id}", [ManagementController::class, "show_management_overtimes_indiv"]);

    Route::get("/manage-shifts", [ShiftEmpController::class, "show_manage_shift"]);
    Route::get("/shift-manage/{id}", [ShiftEmpController::class, "view_manage_shift"]);
    Route::get("/shift-manage-new", [ShiftEmpController::class, "new_manage_shift"]);
    Route::post("/add-manage-shift", [ShiftEmpController::class, "add_manage_shift"]);
    Route::get("/shift-manage-edit/{id}", [ShiftEmpController::class, "edit_manage_shift"]);
    Route::post("/update-manage-shift", [ShiftEmpController::class, "update_manage_shift"]);
    Route::post("/manage-shift-delete", [ShiftEmpController::class, "delete_manage_shift"]);

    Route::post("/approve-attendance", [ApprovalController::class, "approve_attendance"]);
    Route::post("/approve-shift", [ApprovalController::class, "approve_shift"]);
    Route::post("/approve-leave", [ApprovalController::class, "approve_leave"]);
    Route::post("/approve-overtime", [ApprovalController::class, "approve_overtime"]);

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
    Route::get("/account-new", [UserController::class, "new_account"]);
    Route::get('/account/ajax', [UserController::class, "account_dropdown"]);
    Route::post("/add-new-account", [UserController::class, "store_account"]);
    Route::get("/account-edit/{id}", [UserController::class, "edit_account"]);
    Route::post("/account-update", [UserController::class, "update_account"]);
    Route::post("/account-delete", [UserController::class, "delete_account"]);
    Route::post("/account-search", [UserController::class, "search_account"]);

    Route::view('/manila_time', 'employee.timezones.manila_time');
    Route::view('/us_time', 'employee.timezones.us_time');
    Route::view('/dubai_time', 'employee.timezones.dubai_time');
});

Route::get('/send-notif', [NotifRequestController::class, "send_notif"]);

require __DIR__.'/auth.php';

