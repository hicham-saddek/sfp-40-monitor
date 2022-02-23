<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Variable;
use Illuminate\Support\Facades\Broadcast;
use function inertia;

class VisualisationsController extends Controller
{
    public function historyIndex()
    {
        return inertia('Visualizations/History')->with([
            'channels' => Channel::with('variables')->get(),
            'data' => [],
        ]);
    }

    public function history(Channel $channel, Variable $variable)
    {
        return inertia('Visualizations/History')->with([
            'channels' => Channel::with('variables')->get(),
            'data' => $variable->data()->orderBy('created_at', 'desc')->limit(50)->get()->sortKeys(),
        ]);
    }

    public function realtimeIndex()
    {
        return inertia('Visualizations/Realtime')->with([
            'channels' => Channel::with('variables')->get(),
            'data' => [],
        ]);
    }

    public function realtime(Channel $channel, Variable $variable)
    {
        return inertia('Visualizations/Realtime')->with([
            'channels' => Channel::with('variables')->get(),
            'realtimeEnabled' => true,
            'data' => [],
        ])->withViewData([
            'channel' => $channel,
            'variable' => $variable,
        ]);
    }
}
