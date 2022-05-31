<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class EventCRUDService
{
    public static function index($use_pagination = false, $search = null, $paginate = 5): Collection | LengthAwarePaginator | array
    {
        $page = Request::capture()->get('page', 1);

        return \Cache::remember("index-events-$page-$search", 60, function () use ($use_pagination, $search, $paginate) {
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
                )
                ->latest('createdAt');

            if ($use_pagination) {
                return $events->paginate($paginate)->withQueryString()->setPath(url()->current());
            }

            return $events->get();
        });
    }

    public static function indexWithPagination(?string $search = null, int $paginate = 5): Collection | LengthAwarePaginator | array
    {
        return self::index(true, $search, $paginate);
    }

    public static function activeEvents(): array | Collection | \Illuminate\Support\Collection
    {
        return \Cache::remember(
            'active-events',
            60,
            fn() => Event::query()
                ->whereRaw("? BETWEEN startAt AND endAt", [now()->toDateTimeString()])
                ->get()
        );
    }

    public static function store(array $data): \Illuminate\Database\Eloquent\Model | Event
    {
        $data['slug'] = \Str::slug(\Arr::get($data, 'slug'));

        return Event::create($data);
    }

    public static function update(string $uuid, array $data): \Illuminate\Database\Eloquent\Model | Event
    {
        $data['slug'] = \Str::slug(\Arr::get($data, 'slug'));

        return Event::updateOrCreate([
            'id' => $uuid
        ], $data);
    }

    public static function delete(Event $event): void
    {
        abort_if(\Auth::guest(), 403);

        $event->delete();
    }
}
