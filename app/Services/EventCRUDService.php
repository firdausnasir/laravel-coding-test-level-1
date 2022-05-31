<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class EventCRUDService
{
    public static function index($use_pagination = false, $search = null, $paginate = 5): Collection | LengthAwarePaginator | array
    {
        $events = Event::query()
            ->when(
                $search,
                fn(Builder $query) => (
                $query->where(function (Builder $secondQuery) use ($search) {
                    $secondQuery->where('id', 'like', "%$search%")
                        ->orWhere('name', 'like', "%$search%")
                        ->orWhere('slug', 'like', "%$search%");
                })
                )
            );

        if ($use_pagination) {
            return $events->paginate($paginate)->withQueryString();
        }

        return $events->get();
    }

    public static function indexWithPagination(?string $search = null, int $paginate = 5): Collection | LengthAwarePaginator | array
    {
        return self::index(true, $search, $paginate);
    }

    public static function activeEvents(): array | Collection | \Illuminate\Support\Collection
    {
        return Event::query()
            ->whereRaw("? BETWEEN startAt AND endAt", [now()->toDateTimeString()])
            ->get();
    }

    public static function store(array $data): \Illuminate\Database\Eloquent\Model | Event
    {
        return Event::create($data);
    }

    public static function update(string $uuid, array $data): \Illuminate\Database\Eloquent\Model | Event
    {
        return Event::updateOrCreate([
            'id' => $uuid
        ], $data);
    }

    public static function delete(Event $event): void
    {
        $event->delete();
    }
}
