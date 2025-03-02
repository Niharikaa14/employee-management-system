<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Employee\EmployeeTaskController;
use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\Admin\AdminAttendanceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->name('home');

// route::get('post',[HomeController::class, 'post'])->middleware(['auth','admin']);
Route::middleware(['auth', 'admin'])->group(function () {
    // Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    // Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // employee route 
    Route::get('/employee/list', [EmployeeController::class, 'index'])->name('admin.employee.list');
    Route::get('/employee/add', [EmployeeController::class, 'add'])->name('admin.employee.add');
    Route::post('/employee/create', [EmployeeController::class, 'create'])->name('admin.employee.create');
    Route::post('/employee/delete', [EmployeeController::class, 'delete'])->name('admin.employee.delete');
    Route::get('/employee/edit/{id}', [EmployeeController::class, 'edit'])->name('admin.employee.edit');
    Route::post('/employee/update', [EmployeeController::class, 'update'])->name('admin.employee.update');

    // task route 
    Route::get('/tasks/list', [TaskController::class, 'index'])->name('admin.task.list');
    Route::get('/tasks/add', [TaskController::class, 'add'])->name('admin.task.add');
    Route::post('/tasks/create', [TaskController::class, 'create'])->name('admin.task.create');
    Route::post('/tasks/delete', [TaskController::class, 'delete'])->name('admin.task.delete');
    Route::get('/tasks/edit/{id}', [TaskController::class, 'edit'])->name('admin.task.edit');
    Route::post('/tasks/update', [TaskController::class, 'update'])->name('admin.task.update');

    // department route 
    Route::get('/departments/list', [DepartmentController::class, 'index'])->name('admin.department.list');
    Route::get('/departments/add', [DepartmentController::class, 'add'])->name('admin.department.add');
    Route::post('/departments/store', [DepartmentController::class, 'store'])->name('admin.department.store');
    Route::post('/departments/delete', [DepartmentController::class, 'delete'])->name('admin.department.delete');
    Route::get('/departments/edit/{id}', [DepartmentController::class, 'edit'])->name('admin.department.edit');
    Route::post('/departments/update', [DepartmentController::class, 'update'])->name('admin.department.update');

    // admin route 
    Route::get('/admin/list', [AdminController::class, 'index'])->name('admin.admin.list');
    Route::get('/admin/add', [AdminController::class, 'add'])->name('admin.admin.add');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.admin.store');
    Route::post('/admin/delete', [AdminController::class, 'delete'])->name('admin.admin.delete');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.admin.edit');
    Route::post('/admin/update', [AdminController::class, 'update'])->name('admin.admin.update');

    Route::get('/attendance', [AdminAttendanceController::class, 'index'])->name('admin.attendance.index');
    
    // update profile route
    //  Route::get('/admin/update/profile',[UpdateController::class,'index'])->name('admin.admin.update.profile');
    //  Route::post('/admin/update/store/profile',[UpdateController::class,'update'])->name('admin.admin.store.profile');

});

Route::middleware(['auth', 'employee'])->prefix('employee/dashboard')->group(function () {
    Route::get('/', [EmployeeTaskController::class, 'dashboard'])->name('employee.dashboard');
    Route::get('/tasks/list', [EmployeeTaskController::class, 'index'])->name('employee.task.list');
    Route::patch('/tasks/update-status/{id}', [EmployeeTaskController::class, 'updateStatus'])->name('employee.task.updateStatus');

    Route::post('/attendance/start', [AttendanceController::class, 'start'])->name('attendance.start');
    Route::post('/attendance/finish', [AttendanceController::class, 'finish'])->name('attendance.finish');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
