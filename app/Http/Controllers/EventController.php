<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use App\Services\EventCRUDService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|View|Application
     */
    public function index(Request $request): Factory | View | Application
    {
        $search   = $request->get('q');
        $paginate = 5;

        $events = EventCRUDService::indexWithPagination($search, $paginate);

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
        $event = EventCRUDService::store($request->validated());

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
        $event = EventCRUDService::update($uuid, $request->validated());

        return redirect()->route('events.show', $event);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return RedirectResponse
     * @throws \Throwable
     */
    public function destroy(Event $event): RedirectResponse
    {
        EventCRUDService::delete($event);

        return redirect()->route('events.index');
    }
}
