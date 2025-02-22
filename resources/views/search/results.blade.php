<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-xl mb-4">検索結果</h2>
        @if ($players->isEmpty())
            <p>該当するアイテムはありません。</p>
        @else
            <ul>
                @foreach ($players as $player)
                    <article class="w-1/4 px-4 mb-4">
                        <a href="{{ route('players.show', $player) }}">
                            <div class="flex justify-center item-center mb-2">
                                <img class="h-40 mb-2 object-cover"
                                    src="{{ Storage::url('images/players/' . $player->image) }}" alt="">
                            </div>

                            <h4 class="text-lg md-2 font-bold break-words"> {{ $player->first_name }} {{ $player->last_name }}</h4>
                            <p class="text-sm break-words">{{ $player->position }}</p>
                            <p class="text-sm break-words">Age: {{ $player->age }}</p>
                            {{-- class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl break-words" --}}

                            <p class="text-sm mb-2 md:text-base font-normal text-gray-600 break-words">
                                <span
                                    class="text-red-400 font-bold">{{ date('Y-m-d', strtotime('-1 day')) < $player->created_at ? 'NEW' : '' }}</span>
                                {{ $player->created_at->format('Y-m-d') }}
                            </p>
                            {{-- <p class="text-gray-700 text-base">{{ Str::limit($player->passport, 50) }}</p> --}}
                        </a>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
