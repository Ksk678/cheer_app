<x-app-layout>
    <div class="container max-w-7xl mx-auto px-4 md:px-12 pb-3 mt-3">
        <div class="flex flex-wrap -mx-1 lg:-mx-4 mb-4">
            @foreach ($cheers as $cheer)
                {{-- <article class="w-48 px-4 md:w-1/2 text-4l text-gray-800 leading-normal"> --}}
                <article class="w-1/4 px-4 mb-4">
                    <a href="{{ route('cheers.show', $cheer) }}">
                        <div class="flex justify-center item-center mb-2">
                            <img class="h-40 mb-2 object-cover" src="{{ Storage::url('images/cheers/' . $cheer->image) }}"
                                alt="">
                        </div>

                        <h4 class="text-lg md-2 font-bold break-words"> {{ $cheer->first_name }} {{ $cheer->last_name }}</h4>
                        <p class="text-sm break-words">{{ $cheer->position }}</p>
                        <p class="text-sm break-words">Age: {{ $cheer->age }}</p>
                        {{-- class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl break-words" --}}

                        <p class="text-sm mb-2 md:text-base font-normal text-gray-600 break-words">
                            <span
                                class="text-red-400 font-bold">{{ date('Y-m-d', strtotime('-1 day')) < $cheer->created_at ? 'NEW' : '' }}</span>
                            {{ $cheer->created_at->format('Y-m-d') }}
                        </p>
                        {{-- <p class="text-gray-700 text-base">{{ Str::limit($cheer->passport, 50) }}</p> --}}
                    </a>
                </article>
            @endforeach
        </div>
        {{ $cheers->links() }}
    </div>
</x-app-layout>
