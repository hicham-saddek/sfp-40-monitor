<?php

namespace App\Http\Controllers;

use App\Events\NewDataEntryEvent;
use App\Models\Channel;
use App\Models\Data;
use App\Models\Variable;
use Illuminate\Http\Request;
use Pusher\Pusher;
use function broadcast;
use function compact;
use function event;

class DataController extends Controller
{
    public function index(Request $request, Channel $channel, Variable $variable)
    {
        $data = $variable->data()->lazy();
        if ($request->wantsJson())
            return $this->success(compact([ 'channel', 'variable', 'data' ]));
        return inertia('Data/Index')->with(compact([ 'channel', 'variable', 'data' ]));
    }

    public function store(Request $request, Channel $channel, Variable $variable)
    {
        $data = $request->validate([
            'value' => [ 'required', 'boolean' ],
            'collected_at' => [ 'required', 'date' ],
        ]);
        $data = $variable->data()->create($data);
        if (!is_null($data)) {
            broadcast(new NewDataEntryEvent($data));
            return $this->success(compact([ 'channel', 'variable', 'data' ]));
        }
        return $this->failure(compact([ 'channel', 'variable' ]));
    }

    public function show(Request $request, Data $data)
    {
        if ($request->wantsJson()) {
            return $this->success(compact('data'));
        }
        return inertia('Data/Show')->with(compact('data'));
    }

    public function edit(Data $data)
    {
        //
    }

    public function update(Request $request, Data $data)
    {
        //
    }

    public function destroy(Data $data)
    {
        //
    }
}
