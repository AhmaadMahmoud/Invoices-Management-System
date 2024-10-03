<?php
namespace Database\Seeders;
use App\Models\User as ModelsUser;
use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$user = ModelsUser::create([
'name' => 'Ahmed Mahmoud',
'email' => 'ahmed.mhhhh23@gmail.com',
'password' => bcrypt('123456789'),
'roles_name' => ["owner"],
'status' => 'مفعل'
]);
$role = Role::create(['name' => 'owner']);
$permissions = Permission::pluck('id','id')->all();
$role->syncPermissions($permissions);
$user->assignRole([$role->id]);
}
}
