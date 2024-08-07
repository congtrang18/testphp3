<?php

use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\sanpham;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

// Route::get('/', function () {
// //   $data=[
// //     'name'=>'BÓNG ĐÁ',
// //     'slug'=>Str::slug('bóng đá'),
// //     'is_active'=>0,
// //   ];
// //   Category::query()->create($data);
// $category=Category::withTrashed()->findOrFail(2);
// $category->restore();
// });
Route::get('test', function () {
    // DB::table('employes')->select('employes.name','departments.name')->join('departments','departments.department_id','employes.department_id')

    // ->ddRawSql();
    // ;

    // DB::table('employes','e')->select('e.name','d.name')
    // ->join('departments as d','d.department_id','e.department_id')
    // ->where([
    //     ["e.salary",">",70000],
    //     ["d.name","like",'maketing']
    // ])
    // ->ddRawSql();

    // DB::table('employes','e')->select('e.name','d.name')
    // ->join('departments as d','d.department_id','e.department_id')
    // ->whereBetween('e.salary',[50000,70000])->ddRawSql();

    // DB::table('employes','e')->select('e.name','d.name')
    // ->join('departments as d','d.department_id','e.department_id')
    // ->where('d.department_name','<>','hr')
    // ->ddRawSql();

    // DB::table('employes','e')->select('e.name','d.name')
    // ->join('departments as d','d.department_id','e.department_id')
    // ->where('e.last_name','like','D%')
    // ->ddRawSql();

    // DB::table('employes','e')->select('e.name','d.name')
    // ->join('departments as d','d.department_id','e.department_id')
    // ->where('e.salary',)
    // ->ddRawSql();

    //  DB::table('employes','e')->select('e.name','d.name')
    //     ->join('departments as d','d.department_id','e.department_id')
    //     ->whereYear('e.hire_date','<=',4)
    //     ->ddRawSql();


});

// 
Route::get('/', function () {
    echo 'trang chủ';
});
Route::get('user/{id}', function (string $id) {
    echo $id;
});
Route::get('product/{name}', function (string $name) {
    echo $name;
})->name('product.show');
Route::prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('user', [UserController::class, 'index'])->name('user');
    });
Route::controller(UserController::class)->group(function () {
    Route::get('register', 'register');
});
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        echo 'dây là trang dashboard';
    });
});
Route::resource('user', UserController::class);

// attach. dùng cho thêm mới
// detach,dùng cho update
// sync,
// toggle
