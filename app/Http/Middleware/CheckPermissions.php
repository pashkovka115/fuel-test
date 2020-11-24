<?php

namespace App\Http\Middleware;

use Alexusmai\LaravelFileManager\Controllers\FileManagerController;
use App\Http\Controllers\Admin\ColumnController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FuelController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Cashbox\CashboxController;
use Closure;




class CheckPermissions
{
    /**
     * @var array $abilities
     * Разрешения для методов контроллера (админка)
     * по шаблону
     * 'method' => 'permission'
     * Для не раздувания списка методов
     * рекомендуется использовать
     * архитектуру REST
     */
    private $abilities = [
        'index'   => 'view',
        'show'    => 'view',
        'edit'    => 'edit',
        'update'  => 'edit',
        'create'  => 'add',
        'store'   => 'add',
        'destroy' => 'delete',
    ];

    /**
     * @var array $types
     * Список контроллеров к которым будут применяться разрешения $abilities  (админка)
     * по шаблону
     * ControllerName => 'type'
     * где type произвольная строка как идентификатор этого контроллера
     *
     * При записи:
     * private $abilities = [
     *      'index' => 'view',
     * ];
     * private $types = [
     *       HomeController::class => 'dashboard'
     * ];
     * Для выполнения  HomeController::index()
     * будет проверяться разрешение - dashboard_view (через подчёркивание)
     * И не забыть добавить разрешение в БД )))
     */
    private $types = [
        // Касса
        CashboxController::class => 'cashbox',

        // Админ
        FuelController::class => 'fuel',
        ColumnController::class => 'column',
        OrderController::class => 'order',

        DashboardController::class => 'dashboard',
        UserController::class => 'user',
        PermissionController::class => 'permission',
        RoleController::class => 'role',
        UserRoleController::class => 'user-role',
    ];



    /**
     * Проверяет разрешение на выполнение метода контроллера
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $action = \Route::currentRouteAction();
        $sp = explode('@', $action);
        $controller = isset($this->types[$sp[0]]) ? $this->types[$sp[0]] : '';
        $method = isset($this->abilities[$sp[1]]) ? $this->abilities[$sp[1]] : '';
        $permission = $controller . '_' . $method;


        if (auth()->check()){
            if (! auth()->user()->can($permission)){
                return redirect()->back()->withErrors('Не достаточно прав!');
            }
            /*else{
                dump('Есть разрешение '. $permission);
            }*/
        }else{
            header('Location: /');
            exit();
        }



        return $next($request);
    }
}
