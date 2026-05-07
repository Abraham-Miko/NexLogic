<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    public function index(Request $request)
    {
        $wilayah = $request->query('wilayah', '10-TKJ-AA');

        $allData = [
            '10-TKJ-AA' => [
                'top3' => [
                    1 => ['nama' => 'Reza Kecap', 'avatar' => 'https://ui-avatars.com/api/?name=Reza+Kecap&background=random', 'exp' => 9999, 'star' => 15, 'streak' => 15],
                    2 => ['nama' => 'Ryan Knalpot', 'avatar' => 'https://ui-avatars.com/api/?name=Ryan+Knalpot&background=random', 'exp' => 6767, 'star' => 13, 'streak' => 12],
                    3 => ['nama' => 'Windah Habatusauda', 'avatar' => 'https://ui-avatars.com/api/?name=Windah+Habatusauda&background=random', 'exp' => 1234, 'star' => 12, 'streak' => 7],
                ],
                'others' => [
                    4 => ['nama' => 'Rahmat Toyota', 'avatar' => 'https://ui-avatars.com/api/?name=Rahmat+Toyota&background=random', 'exp' => 1024, 'star' => 12, 'streak' => 8],
                    5 => ['nama' => 'Nonoa Miyamae', 'avatar' => 'https://ui-avatars.com/api/?name=Nonoa+Miyamae&background=random', 'exp' => 900, 'star' => 9, 'streak' => 9],
                    6 => ['nama' => 'Miku Nakano', 'avatar' => 'https://ui-avatars.com/api/?name=Miku+Nakano&background=random', 'exp' => 874, 'star' => 9, 'streak' => 5],
                    7 => ['nama' => 'Michael Jawir (MJ)', 'avatar' => 'https://ui-avatars.com/api/?name=Michael+Jawir&background=random', 'exp' => 766, 'star' => 6, 'streak' => 4],
                    8 => ['nama' => 'King Nasir', 'avatar' => 'https://ui-avatars.com/api/?name=King+Nasir&background=random', 'exp' => 567, 'star' => 5, 'streak' => 6],
                ]
            ],
            '10-RPL-AA' => [
                'top3' => [
                    1 => ['nama' => 'Budi Santoso', 'avatar' => 'https://ui-avatars.com/api/?name=Budi+Santoso&background=random', 'exp' => 8500, 'star' => 14, 'streak' => 10],
                    2 => ['nama' => 'Siti Aminah', 'avatar' => 'https://ui-avatars.com/api/?name=Siti+Aminah&background=random', 'exp' => 8200, 'star' => 13, 'streak' => 9],
                    3 => ['nama' => 'Agus Setiawan', 'avatar' => 'https://ui-avatars.com/api/?name=Agus+Setiawan&background=random', 'exp' => 7900, 'star' => 12, 'streak' => 8],
                ],
                'others' => [
                    4 => ['nama' => 'Dewi Lestari', 'avatar' => 'https://ui-avatars.com/api/?name=Dewi+Lestari&background=random', 'exp' => 7500, 'star' => 11, 'streak' => 7],
                    5 => ['nama' => 'Eko Prasetyo', 'avatar' => 'https://ui-avatars.com/api/?name=Eko+Prasetyo&background=random', 'exp' => 7100, 'star' => 10, 'streak' => 6],
                    6 => ['nama' => 'Fajar Nugroho', 'avatar' => 'https://ui-avatars.com/api/?name=Fajar+Nugroho&background=random', 'exp' => 6800, 'star' => 9, 'streak' => 5],
                    7 => ['nama' => 'Gita Gutawa', 'avatar' => 'https://ui-avatars.com/api/?name=Gita+Gutawa&background=random', 'exp' => 6500, 'star' => 8, 'streak' => 4],
                    8 => ['nama' => 'Hendra Gunawan', 'avatar' => 'https://ui-avatars.com/api/?name=Hendra+Gunawan&background=random', 'exp' => 6000, 'star' => 7, 'streak' => 3],
                ]
            ],
            '10-MM-AA' => [
                'top3' => [
                    1 => ['nama' => 'Andi Wijaya', 'avatar' => 'https://ui-avatars.com/api/?name=Andi+Wijaya&background=random', 'exp' => 12500, 'star' => 20, 'streak' => 25],
                    2 => ['nama' => 'Rina Melati', 'avatar' => 'https://ui-avatars.com/api/?name=Rina+Melati&background=random', 'exp' => 11200, 'star' => 18, 'streak' => 20],
                    3 => ['nama' => 'Doni Salmanan', 'avatar' => 'https://ui-avatars.com/api/?name=Doni+Salmanan&background=random', 'exp' => 10800, 'star' => 16, 'streak' => 15],
                ],
                'others' => [
                    4 => ['nama' => 'Ayu Ting Ting', 'avatar' => 'https://ui-avatars.com/api/?name=Ayu+Ting+Ting&background=random', 'exp' => 9500, 'star' => 15, 'streak' => 12],
                    5 => ['nama' => 'Reza Rahadian', 'avatar' => 'https://ui-avatars.com/api/?name=Reza+Rahadian&background=random', 'exp' => 8900, 'star' => 14, 'streak' => 11],
                    6 => ['nama' => 'Vanesha Prescilla', 'avatar' => 'https://ui-avatars.com/api/?name=Vanesha+Prescilla&background=random', 'exp' => 8500, 'star' => 13, 'streak' => 10],
                    7 => ['nama' => 'Iqbaal Ramadhan', 'avatar' => 'https://ui-avatars.com/api/?name=Iqbaal+Ramadhan&background=random', 'exp' => 8100, 'star' => 12, 'streak' => 9],
                    8 => ['nama' => 'Chelsea Islan', 'avatar' => 'https://ui-avatars.com/api/?name=Chelsea+Islan&background=random', 'exp' => 7800, 'star' => 11, 'streak' => 8],
                ]
            ],
        ];

        // Fallback jika wilayah tidak ada di data dummy
        if (!array_key_exists($wilayah, $allData)) {
            $wilayah = '10-TKJ-AA';
        }

        $top3 = $allData[$wilayah]['top3'];
        $others = $allData[$wilayah]['others'];
        
        $availableWilayah = array_keys($allData);

        return view('leaderboard.index', compact('top3', 'others', 'wilayah', 'availableWilayah'));
    }
}
