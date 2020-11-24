<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'dashboard_view', 'description' => 'Просматривать главную панель']);

        Permission::create(['name' => 'user_view', 'description' => 'Просматривать пользователей']);
        Permission::create(['name' => 'user_edit', 'description' => 'Редактировать пользователя']);
        Permission::create(['name' => 'user_add', 'description' => 'Добавлять пользователя']);
        Permission::create(['name' => 'user_delete', 'description' => 'Удалять пользователя']);

        Permission::create(['name' => 'permission_view', 'description' => 'Просматривать разрешения']);
        Permission::create(['name' => 'permission_edit', 'description' => 'Редактировать разрешение']);

        Permission::create(['name' => 'role_view', 'description' => 'Просматривать роли']);
        Permission::create(['name' => 'role_edit', 'description' => 'Редактировать роль']);
        Permission::create(['name' => 'role_add', 'description' => 'Добавлять роль']);
        Permission::create(['name' => 'role_delete', 'description' => 'Удалять роль']);

        Permission::create(['name' => 'column_view', 'description' => 'Просматривать колонки']);
        Permission::create(['name' => 'column_edit', 'description' => 'Редактировать колонки']);
        Permission::create(['name' => 'column_add', 'description' => 'Добавлять колонки']);
        Permission::create(['name' => 'column_delete', 'description' => 'Удалять колонки']);

        Permission::create(['name' => 'fuel_view', 'description' => 'Просматривать топливо']);
        Permission::create(['name' => 'fuel_edit', 'description' => 'Редактировать топливо']);
        Permission::create(['name' => 'fuel_add', 'description' => 'Добавлять топливо']);
        Permission::create(['name' => 'fuel_delete', 'description' => 'Удалять топливо']);

        Permission::create(['name' => 'cashbox_view', 'description' => 'Просматривать кассу']);
        Permission::create(['name' => 'cashbox_edit', 'description' => 'Редактировать кассу']);
        Permission::create(['name' => 'cashbox_add', 'description' => 'Добавлять кассу']);
        Permission::create(['name' => 'cashbox_delete', 'description' => 'Удалять кассу']);

        Permission::create(['name' => 'order_view', 'description' => 'Просматривать чек']);
        Permission::create(['name' => 'order_edit', 'description' => 'Редактировать чек']);
        Permission::create(['name' => 'order_add', 'description' => 'Добавлять чек']);
        Permission::create(['name' => 'order_delete', 'description' => 'Удалять чек']);

        Permission::create(['name' => 'user-role_view', 'description' => 'Просматривать роли пользователей']);
        Permission::create(['name' => 'user-role_edit', 'description' => 'Синхронизировать пользователей и роли']);




        $role = Role::create(['name' => 'Администратор', 'description' => 'Можно всё']);
        $role->givePermissionTo(Permission::all());

        Role::create(['name' => 'Кассир', 'description' => 'Все права на кассу'])
            ->givePermissionTo(['cashbox_view', 'cashbox_edit', 'cashbox_add', 'cashbox_delete']);

        $users = \App\Models\User::all();
        if ($users){
            $admin = $users[0];
            $admin->assignRole('Администратор');
            if (isset($users[1])){
                $moderator = $users[1];
                $moderator->assignRole('Кассир');
            }
        }
    }
}






















