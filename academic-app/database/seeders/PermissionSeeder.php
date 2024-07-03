<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat atau memperbarui peran admin
        $role_admin = Role::updateOrCreate(['name' => 'admin']);

        // Membuat atau memperbarui peran guru
        $role_guru = Role::updateOrCreate(['name' => 'guru']);

        // Membuat atau memperbarui peran siswa
        $role_siswa = Role::updateOrCreate(['name' => 'siswa']);

        // Membuat atau memperbarui izin untuk melihat dashboard
        $permission_dashboard = Permission::updateOrCreate(['name' => 'view_dashboard']);

        // Membuat atau memperbarui izin untuk melihat nilai
        $permission_nilai = Permission::updateOrCreate(['name' => 'view_nilai']);

        // Memberikan izin kepada peran admin
        $role_admin->givePermissionTo($permission_dashboard);
        $role_admin->givePermissionTo($permission_nilai);

        // Memberikan izin kepada peran guru
        $role_guru->givePermissionTo($permission_nilai);

        // Memberikan izin kepada peran siswa
        $role_siswa->givePermissionTo($permission_nilai);

        // Menemukan user dengan ID tertentu dan memberikan peran admin
        $user_admin = User::find(1);
        if ($user_admin) {
            $user_admin->assignRole('admin');
        }

        // Menemukan user dengan ID tertentu dan memberikan peran guru
        $user_guru1 = User::find(2);
        if ($user_guru1) {
            $user_guru1->assignRole('guru');
        }

        $user_guru2 = User::find(3);
        if ($user_guru2) {
            $user_guru2->assignRole('guru');
        }

        // Menemukan user dengan ID tertentu dan memberikan peran siswa
        $user_siswa = User::find(4); // Ganti dengan ID user siswa yang relevan
        if ($user_siswa) {
            $user_siswa->assignRole('siswa');
        }

        // Cek izin untuk peran siswa
        dd($role_siswa->hasPermissionTo('view_nilai'));
    }
}
