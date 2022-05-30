<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEventRequest;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventController extends Controller
{
    /**
     * Display a listing of all events.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $events = Event::all();

        return response()->json($events, Response::HTTP_OK);
    }

    /**
     * Display a listing of the active events.
     *
     * @return JsonResponse
     */
    public function active()
    {
        $active_events = Event::query()
            ->whereRaw("? BETWEEN createdAt AND updatedAt", [now()->toDateTimeString()])
            ->get();

        return response()->json($active_events, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEventRequest $request
     * @return JsonResponse
     */
    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->validated());

        return response()->json($event, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $event = Event::query()
            ->where('id', $id)
            ->firstOrFail();

        return response()->json($event, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreEventRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(StoreEventRequest $request, $id)
    {
        $event = Event::firstOrCreate([
            'id' => $id
        ], $request->validated());

        return response()->json($event, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        Event::whereId($id)->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
