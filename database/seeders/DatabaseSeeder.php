<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user1 = User::firstOrCreate([
        'nama' => 'Abraham Miko Pratama',
        'nomor_induk' => '00113355',
        'jenis_kelamin' => 'L',
        'password' => Hash::make('AdminGacor_123'),
        'role' => 'super_admin'
        ]);

        $user2 = User::firstOrCreate([
        'nama' => 'Farel Farizi Purnomosasi',
        'nomor_induk' => '11223344',
        'jenis_kelamin' => 'L',
        'password' => Hash::make('FarelFemboy_123'),
        'role' => 'guru'
        ]);

        $user3 = User::firstOrCreate([
        'nama' => 'Adhyaksa Daudi Musthofa Akhyar',
        'nomor_induk' => '22112222',
        'jenis_kelamin' => 'L',
        'password' => Hash::make('AksaJomok_789'),
        'role' => 'siswa'
        ]);

        $user4 = User::firstOrCreate([
        'nama' => 'Vestia Zeta',
        'nomor_induk' => '33445566',
        'jenis_kelamin' => 'P',
        'password' => Hash::make('MyWifeZeta_456'),
        'role' => 'siswa'
        ]);

        echo "Database seeded successfully!\n";
        echo "Test accounts:\n";
        echo "Super Admin: Abraham Miko Pratama - AdminGacor_123\n";
        echo "Guru: Farel Farizi Purnomosasi - FarelFemboy_123\n";
        echo "Siswa: Adhyaksa Daudi Musthofa Akhyar - AksaJomok_789\n";
        echo "Siswa: Vestia Zeta - MyWifeZeta_456\n";
    }
}
