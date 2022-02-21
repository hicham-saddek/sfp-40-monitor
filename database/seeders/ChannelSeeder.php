<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    public function run()
    {
        $this->channel([
            'title' => 'Poste SFP 001',
            'description' => 'Poste SFP 001 Palette',
        ]);
        $this->channel([
            'title' => 'Poste SFP 002',
            'description' => 'Poste SFP 002 Emballage',
        ]);
        $this->channel([
            'title' => 'Poste SFP 003',
            'description' => 'Poste SFP 003 Vérification',
        ]);
        $this->channel([
            'title' => 'Poste SFP 004',
            'description' => 'Poste SFP 004 Entré produit',
        ]);
        $this->channel([
            'title' => 'Poste SFP 005',
            'description' => 'Poste SFP 005 Triage',
        ]);
        $this->channel([
            'title' => 'Poste SFP 006',
            'description' => 'Poste SFP 006 Sortie',
        ]);
    }

    public function channel(array $attributes): Channel
    {
        return Channel::create($attributes);
    }
}
