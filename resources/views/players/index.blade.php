<x-app-layout>
    <div class="container max-w-7xl mx-auto px-4 md:px-12 pb-3 mt-3">
        <div class="flex flex-wrap -mx-1 lg:-mx-4 mb-4">
            @foreach ($players as $player)
                <article class="w-1/4 px-4 mb-4 flex flex-col items-start">
                    <a href="{{ route('players.show', $player) }}" class="w-full">
                        <div class="flex justify-center items-center mb-2">
                            <img class="h-40 mb-2 object-cover" src="{{ Storage::url('images/players/' . $player->image) }}" alt="">
                        </div>

                        <h4 class="text-lg md-2 font-bold break-words text-left w-full"> {{ $player->first_name }} {{ $player->last_name }}</h4>
                        <p class="text-sm break-words text-left w-full">{{ $player->position }}</p>
                        <p class="text-sm break-words text-left w-full">Age: {{ $player->age }}</p>

                        <p class="text-sm mb-2 md:text-base font-normal text-gray-600 break-words text-left w-full">
                            <span class="text-red-400 font-bold">{{ date('Y-m-d', strtotime('-1 day')) < $player->created_at ? 'NEW' : '' }}</span>
                            {{ $player->created_at->format('Y-m-d') }}
                        </p>
                    </a>
                </article>
            @endforeach
        </div>
        {{ $players->links() }}
    </div>
</x-app-layout>
