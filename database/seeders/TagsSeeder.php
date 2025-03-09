<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
          ['name' => 'Кино'],
          ['name' => 'IT'],
          ['name' => 'Образование'],
          ['name' => 'Сериалы'],
          ['name' => 'Игры'],
        ];
        DB::table('tbl_tag')->insert($tags);
    }
}
