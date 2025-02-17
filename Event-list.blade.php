<div class="container mx-auto py-6">
    <h1 class="text-3xl font-bold mb-4">Upcoming Events</h1>

    @if (session()->has('message'))
        <div class="bg-green-500 text-white p-2 mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-500 text-white p-2 mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($events as $event)
            <div class="bg-white p-4 rounded-lg shadow-lg">
                <h2 class="text-xl font-semibold">{{ $event->name }}</h2>
                <p class="text-gray-600">{{ \Carbon\Carbon::parse($event->date)->format('F j, Y, g:i a') }}</p>
                
                <div class="mt-4">
                    @if (Auth::check() && !\App\Models\EventRsvp::where('user_id', Auth::id())->where('event_id', $event->id)->exists())
                        <button wire:click="rsvp({{ $event->id }})" class="bg-blue-500 text-white py-2 px-4 rounded-full">
                            RSVP
                        </button>
                    @elseif(Auth::check())
                        <button wire:click="withdrawRsvp({{ $event->id }})" class="bg-red-500 text-white py-2 px-4 rounded-full">
                            Withdraw RSVP
                        </button>
                    @endif
                </div>

                <div class="mt-2 text-gray-600">
                    <span>{{ $event->rsvps()->count() }} people attending</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
