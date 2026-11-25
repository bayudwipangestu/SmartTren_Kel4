<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Bersihkan cache permission Spatie
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Buat Daftar Permission
        $permissions = [
            'lihat data',
            'tambah data',
            'edit data',
            'hapus data',
            'kelola role'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // 2. Buat Role dan Hubungkan dengan Permission Sesuai Matriks Tugas
        
        // Role Admin (Bisa semua)
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleAdmin->givePermissionTo(Permission::all());

        // Role Dosen (Bisa lihat, tambah, edit)
        $roleDosen = Role::create(['name' => 'Dosen']);
        $roleDosen->givePermissionTo(['lihat data', 'tambah data', 'edit data']);

        // Role Mahasiswa (Hanya bisa lihat)
        $roleMahasiswa = Role::create(['name' => 'Mahasiswa']);
        $roleMahasiswa->givePermissionTo(['lihat data']);


        // 3. Buat Akun Pengguna Dummy untuk Pengujian
        
        $admin = User::create([
            'name' => 'Akun Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole($roleAdmin);

        $dosen = User::create([
            'name' => 'Akun Dosen',
            'email' => 'dosen@test.com',
            'password' => Hash::make('password'),
        ]);
        $dosen->assignRole($roleDosen);

        $mahasiswa = User::create([
            'name' => 'Akun Mahasiswa',
            'email' => 'mahasiswa@test.com',
            'password' => Hash::make('password'),
        ]);
        $mahasiswa->assignRole($roleMahasiswa);
    }
}