<?php

namespace Database\Seeders;

use Enraiged\Agreements\Models\Agreement;
use Illuminate\Database\Seeder;

class AgreementSeeder extends Seeder
{
    /**
     *  Seed the application roles.
     *
     *  @return void
     */
    public function run()
    {
        $config = config('enraiged.auth.must_agree_to_terms');

        if ($config && $config !== false) {
            foreach (['EULA', 'TOS'] as $type) {
                $resource = resource_path("seeds/agreements/{$type}.md");
                $content = file_exists($resource)
                    ? file_get_contents($resource)
                    : 'No content';

                $parameters = [
                    'content' => $content,
                    'type' => $type,
                    'version' => '1.0.0',
                ];

                Agreement::create($parameters)->publish();
            }
        }
    }
}
