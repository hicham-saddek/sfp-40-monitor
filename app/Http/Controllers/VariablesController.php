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
            'pages' => Variable::query()->paginate(),
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
            'title' => ['required', 'string', 'min:5', 'max:191'],
            'description' => ['required', 'string'],
            'opc_ua_namespace_index' => ['required', 'integer', 'min:0', 'max:256'],
            'opc_ua_identifier' => ['required', 'integer', 'min:0', 'max:9999'],
            'subscriptions_status' => ['required', 'boolean'],
        ]);
        $variable = $channel->variables()->create($data);
        if (!is_null($variable))
            return $this->success(['created' => true, 'variable' => $variable]);
        return $this->failure(['created' => false, 'variable' => $variable]);
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
            'title' => ['nullable', 'string', 'min:5', 'max:191'],
            'description' => ['nullable', 'string'],
            'opc_ua_namespace_index' => ['nullable', 'integer', 'min:0', 'max:256'],
            'opc_ua_identifier' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'subscriptions_status' => ['nullable', 'boolean'],
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
}
