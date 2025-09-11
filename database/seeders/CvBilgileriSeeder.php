<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CvBilgileri;
use Faker\Factory as Faker;

class CvBilgileriSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('tr_TR'); // Türkçe faker

        // Manuel kayıt
        $cv = CvBilgileri::create([
            'first_name'  => 'Emirkan',
            'last_name'   => 'Ergöz',
            'email'       => 'emirkan@example.com',
            'phone'       => '123456789',
            'birth_date'  => '2000-01-01',
            'education'   => 'Bilgisayar Mühendisliği',
            'experience'  => 'Laravel & ML Projeleri',
            'skills'      => json_encode([
                ['skill' => 'PHP', 'level' => 'Advanced'],
                ['skill' => 'Python', 'level' => 'Intermediate'],
            ]),
            'about'       => 'Makine öğrenmesi ve Laravel projeleri ile ilgileniyorum.',
        ]);

        // Resim ekleme (Lorem Picsum’dan rastgele resim)
        $cv->addMediaFromUrl('https://picsum.photos/300/300')->toMediaCollection('profile_pics');

        // 7–8 tane rastgele kayıt
        foreach (range(1, 8) as $i) {
            $cv = CvBilgileri::create([
                'first_name'  => $faker->firstName,
                'last_name'   => $faker->lastName,
                'email'       => $faker->unique()->safeEmail,
                'phone'       => $faker->phoneNumber,
                'birth_date'  => $faker->date(),
                'education'   => $faker->randomElement([
                    'Bilgisayar Mühendisliği',
                    'Elektrik-Elektronik Mühendisliği',
                    'Yazılım Mühendisliği',
                    'Makine Mühendisliği',
                    'Matematik'
                ]),
                'experience'  => $faker->sentence(6),
                'skills'      => json_encode([
                    ['PHP', 'level' => $faker->randomElement(['Beginner','Intermediate','Advanced'])],
                    ['Python', 'level' => $faker->randomElement(['Beginner','Intermediate','Advanced'])],
                    ['Laravel', 'level' => $faker->randomElement(['Beginner','Intermediate','Advanced'])],
                ]),
                'about'       => $faker->paragraph(3),
            ]);

            // Her kayda random görsel ekle
            $cv->addMediaFromUrl('https://picsum.photos/300/300?random=' . $i)
                ->toMediaCollection('profile_pics');
        }
    }
}
