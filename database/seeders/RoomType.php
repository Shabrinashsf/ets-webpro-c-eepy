<?php

namespace Database\Seeders;

use App\Models\RoomType as ModelsRoomType;
use Illuminate\Database\Seeder;

class RoomType extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Standard Room', 'price' => 500000],
            ['name' => 'Deluxe Room', 'price' => 700000],
            ['name' => 'Suite Room', 'price' => 1300000],
            ['name' => 'President Room', 'price' => 2000000],
        ];

        foreach ($types as $type) {
            ModelsRoomType::create($type);
        }
    }
}
