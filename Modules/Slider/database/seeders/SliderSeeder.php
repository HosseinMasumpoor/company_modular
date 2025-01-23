<?php

namespace Modules\Slider\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Slider\Enums\Type;
use Modules\Slider\Models\Slider;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sliders = [
            [
                'name' => 'Main page text slider',
                'type' => Type::TEXT,
                'location' => 'mainpage-main-one',
            ],
            [
                'name' => 'Main page image slider',
                'type' => Type::IMAGE,
                'location' => 'mainpage-main-two',
            ],
            [
                'name' => 'About page coop slider',
                'type' => Type::IMAGE,
                'location' => 'aboutpage-coop',
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
}
