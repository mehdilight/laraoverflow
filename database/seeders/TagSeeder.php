<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::query()
            ->insert(
                [
                    [
                        'name'        => 'javascript',
                        'description' => 'For questions about programming in ECMAScript (JavaScript/JS) and its different dialects/implementations (except for ActionScript). Note that JavaScript is NOT Java. Include all tags that are relevant to your question: e.g., [node.js], [jQuery], [JSON], [ReactJS], [angular], [ember.js], [vue.js], [typescript], [svelte], etc.'
                    ],
                    [
                        'name'        => 'laravel',
                        'description' => 'The Laravel framework is an open-sourced PHP web framework that allows developers to create dynamic and scalable web applications. The source code of Laravel is hosted on GitHub and released under the MIT license.'
                    ],
                    [
                        'name'        => 'alpine.js',
                        'description' => 'Alpine.js is a minimal framework for composing JavaScript behavior in your markup.'
                    ],
                ]
            );
    }
}
