<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;
use function compact;
use function inertia;
use function is_null;
use function request;
use function route;

class ChannelsController extends Controller
{
    public function index()
    {
        $pages = Channel::query()->withoutGlobalScopes([ 'not_active' ])->paginate();
        if (request()->wantsJson())
            return $this->success(compact('pages'));
        return inertia('Channels/Index')->with(compact('pages'));
    }

    public function create()
    {
        return inertia('Channels/Create');
    }

    public function store(Request $request)
    {
        $channelData = collect($request->validate([
            'title' => [ 'required', 'string', 'min:2', 'max:191' ],
            'description' => [ 'required', 'string' ],
            'active' => [ 'nullable', 'boolean' ],
            'opc' => [ 'required', 'string' ],
            'clock' => [ 'required', 'integer', 'min:1', 'max:86400' ],
            '3d_x' => [ 'nullable', 'numeric' ],
            '3d_y' => [ 'nullable', 'numeric' ],
            '3d_z' => [ 'nullable', 'numeric' ],
        ]))->whereNotNull()->toArray();
        $channel = Channel::create($channelData);
        $created = !is_null($channel);
        if ($created)
            return $this->success(compact('created', 'channel'));
        return $this->failure(compact('created', 'channel'));
    }

    public function show(Channel $channel)
    {
        if (request()->wantsJson())
            return $this->success(compact('channel'));
        return inertia('Channels/Show')->with(compact('channel'));
    }

    public function edit(Channel $channel)
    {
        return inertia('Channels/Edit')->with(compact("channel"));
    }

    public function update(Request $request, Channel $channel)
    {
        $channelData = collect($request->validate([
            'title' => [ 'nullable', 'string', 'min:2', 'max:191' ],
            'description' => [ 'nullable', 'string' ],
            'active' => [ 'nullable', 'boolean' ],
            'opc' => [ 'nullable', 'string' ],
            'clock' => [ 'nullable', 'integer' ],
            '3d_x' => [ 'nullable', 'numeric' ],
            '3d_y' => [ 'nullable', 'numeric' ],
            '3d_z' => [ 'nullable', 'numeric' ],
        ]))->whereNotNull()->toArray();
        $updated = $channel->update($channelData);
        return $this->success(compact('updated', 'channel'));
    }

    public function destroy(Channel $channel)
    {
        $deleted = $channel->delete();
        return $this->success(compact('deleted'), route('channels.index'));
    }

    public function watched(Channel $channel)
    {
        $watched = $channel->subscriptions(true)->get();
        return $this->success(compact('channel', 'watched'));
    }

    public function unwatched(Channel $channel)
    {
        $unwatched = $channel->subscriptions(false)->get();
        return $this->success(compact('channel', 'unwatched'));
    }

    public function configs(Channel $channel)
    {
        $configs = $channel->only([ 'opc', 'clock' ]);
        if (request()->wantsJson())
            return $this->success(compact('channel', 'configs'));
        return inertia('Channels/Show')->with(compact('channel', 'configs'));
    }

    public function toggleMonitoring(Channel $channel)
    {
        $activated = !$channel->active;
        $updated = $channel->update([ 'active' => $activated ]);
        if ($updated)
            return $this->success(compact([ 'channel', 'activated', 'updated' ]));
        return $this->failure();
    }
}
