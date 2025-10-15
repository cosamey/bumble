<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->deleteMedia();

        $this->call([
            UserSeeder::class,
        ]);
    }

    private function deleteMedia(): void
    {
        File::deleteDirectory(storage_path('app/public/media'));
        File::deleteDirectory(storage_path('app/private/media'));
    }
}
