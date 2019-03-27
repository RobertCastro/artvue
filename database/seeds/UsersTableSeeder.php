<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        User::truncate();
        Role::truncate();

        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleWriter = Role::create(['name' => 'Writer']);

        $viewPostsPermission = Permission::create(['name' => 'View posts']);
        $createPostsPermission = Permission::create(['name' => 'Create posts']);
        $updatePostsPermission = Permission::create(['name' => 'Update posts']);
        $deletePostsPermission = Permission::create(['name' => 'Delete posts']);

        $viewUsersPermission = Permission::create(['name' => 'View users']);
        $createUsersPermission = Permission::create(['name' => 'Create users']);
        $updateUsersPermission = Permission::create(['name' => 'Update users']);
        $deleteUsersPermission = Permission::create(['name' => 'Delete users']);

        $updatedRolesPermission = Permission::create(['name' => 'Update roles']);

        $admin = new User;
        $admin->name = 'Robert Castro';
        $admin->email = 'oneroberth@gmail.com';
        $admin->password = '123456';
        $admin->save();

        $admin->assignRole($roleAdmin);

        $writer = new User;
        $writer->name = 'Alejandro Castro';
        $writer->email = 'alejandro@gmail.com';
        $writer->password = '123456';
        $writer->save();

        $writer->assignRole($roleWriter);
    }
}
