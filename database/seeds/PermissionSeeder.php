<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (\App\Libraries\Permissions::permissions() as $permissions) {
            foreach ($permissions as $permission => $permName) {
                \Spatie\Permission\Models\Permission::findOrCreate($permission);
            }
        }
    }
}
