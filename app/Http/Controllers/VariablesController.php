<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Variable;
use Illuminate\Http\Request;
use function compact;
use function inertia;
use function is_null;
use function route;

class VariablesController extends Controller
{
    public function index(Channel $channel)
    {
        return inertia('Variables/Index')->with([
            'pages' => $channel->variables()->paginate(),
            'channel' => $channel,
        ]);
    }

    public function create(Channel $channel)
    {
        return inertia('Variables/Create')->with(compact('channel'));
    }

    public function store(Request $request, Channel $channel)
    {
        $data = $request->validate([
            'title' => [ 'required', 'string', 'min:5', 'max:191' ],
            'description' => [ 'required', 'string' ],
            'node_id' => [ 'required', 'string' ],
            'subscriptions_status' => [ 'nullable', 'boolean' ],
        ]);
        $variable = $channel->variables()->create(collect($data)->whereNotNull()->toArray());
        if (!is_null($variable))
            return $this->success([ 'created' => true, 'variable' => $variable ]);
        return $this->failure([ 'created' => false, 'variable' => $variable ]);
    }

    public function show(Channel $channel, Variable $variable)
    {
        return inertia('Variables/Show')->with(compact('variable', 'channel'));
    }

    public function edit(Channel $channel, Variable $variable)
    {
        return inertia('Variables/Edit')->with(compact('variable', 'channel'));
    }

    public function update(Request $request, Channel $channel, Variable $variable)
    {
        $data = $request->validate([
            'title' => [ 'nullable', 'string', 'min:5', 'max:191' ],
            'description' => [ 'nullable', 'string' ],
            'node_id' => [ 'nullable', 'string' ],
            'subscriptions_status' => [ 'nullable', 'boolean' ],
        ]);
        $data = collect($data)->whereNotNull()->toArray();
        $updated = $variable->update($data);
        return $this->success(compact('updated', 'variable', 'channel'));
    }

    public function destroy(Channel $channel, Variable $variable)
    {
        $deleted = $variable->delete();
        return $this->success(compact('deleted', 'channel'), route('variables.index'));
    }

    public function subscribe(Channel $channel, Variable $variable)
    {
        $subscription = $variable->subscribe();
        return $this->success(compact('subscription', 'channel', 'variable'));
    }

    public function unsubscribe(Channel $channel, Variable $variable)
    {
        $subscription = $variable->unsubscribe();
        return $this->success(compact('subscription', 'channel', 'variable'));
    }

    public function toggleSubscription(Channel $channel, Variable $variable)
    {
        $subscription = $variable->toggleSubscription();
        return $this->success(compact('subscription', 'channel', 'variable'));
    }

    public function toggleWatch(Channel $channel, Variable $variable)
    {
        if ($updated = $variable->toggleSubscription() == true)
            return $this->success(compact([ 'channel', 'variable', 'updated' ]));
        return $this->failure();
    }
}
