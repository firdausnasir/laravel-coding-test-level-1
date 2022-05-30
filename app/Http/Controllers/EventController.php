<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory | View | Application
    {
        $search = $request->get('q');

        $events = Event::query()
            ->withTrashed()
            ->when(
                $search,
                fn(Builder $query) => (
                    $query->where(function (Builder $secondQuery) use ($search) {
                        $secondQuery->where('id', 'like', "%$search%")
                        ->orWhere('name', 'like', "%$search%")
                        ->orWhere('slug', 'like', "%$search%");
                    })
                )
            )
            ->paginate(3)
            ->withQueryString();

        return view('events.index', compact('events'));
    }

    /**
     * @param Event $event
     * @return Factory|View|Application
     */
    public function edit(Event $event): Factory | View | Application
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEventRequest $request
     * @return RedirectResponse
     */
    public function store(StoreEventRequest $request): RedirectResponse
    {
        $event = Event::create($request->validated());

        return redirect()->route('events.show', $event);
    }

    /**
     * @return Factory|View|Application
     */
    public function create(): Factory | View | Application
    {
        return view('events.create');
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return Application|Factory|View
     */
    public function show(Event $event): Application | Factory | View
    {
        return view('events.show', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreEventRequest $request
     * @param string $uuid
     * @return RedirectResponse
     */
    public function update(StoreEventRequest $request, string $uuid): RedirectResponse
    {
        Event::updateOrCreate([
            'id' => $uuid
        ], $request->validated());

        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return RedirectResponse
     */
    public function destroy(Event $event): RedirectResponse
    {
        $event->delete();

        return redirect()->route('events.index');
    }
}
