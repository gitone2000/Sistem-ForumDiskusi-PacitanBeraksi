<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Channel;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $channels = [
            [
                'nama' => 'Forum Umum',
                'slug' => 'forum-umum',
                'deskripsi' => 'Diskusi umum untuk semua Mahasiswa.'
            ],
        ];

        foreach ($channels as $channel) {
            Channel::create($channel);
        }
    }
}
