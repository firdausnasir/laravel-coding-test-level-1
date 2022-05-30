<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    /**
     * Display a listing of all events.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $events = Event::all();

        return response()->json($events, Response::HTTP_OK);
    }

    /**
     * Display a listing of the active events.
     *
     * @return JsonResponse
     */
    public function activeEvents(): JsonResponse
    {
        $active_events = Event::query()
            ->whereRaw("? BETWEEN startAt AND endAt", [now()->toDateTimeString()])
            ->get();

        return response()->json($active_events, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEventRequest $request
     * @return JsonResponse
     */
    public function store(StoreEventRequest $request): JsonResponse
    {
        $event = Event::create($request->validated());

        return response()->json($event, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Event $event
     * @return JsonResponse
     */
    public function show(Event $event): JsonResponse
    {

        return response()->json($event, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreEventRequest $request
     * @param string $uuid
     * @return JsonResponse
     */
    public function update(StoreEventRequest $request, string $uuid): JsonResponse
    {
        $event = Event::firstOrCreate([
            'id' => $uuid
        ], $request->validated());

        return response()->json($event, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Event $event
     * @return JsonResponse
     */
    public function destroy(Event $event): JsonResponse
    {
        $event->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
