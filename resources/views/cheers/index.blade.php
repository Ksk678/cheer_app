<x-app-layout>
    <div class="container max-w-7xl mx-auto px-4 md:px-12 pb-3 mt-3">
        <div class="flex flex-wrap -mx-1 lg:-mx-4 mb-4">
            @foreach ($cheers as $cheer)
                <article class="w-full px-4 md:w-1/2 text-xl text-gray-800 leading-normal">
                    <a href="{{ route('cheers.show', $cheer) }}">
                        <h5> {{ $cheer->first_name }} {{ $cheer->last_name }}</h5>
                        <p>{{ $cheer->position }}</p>
                        <p>Age: {{ $cheer->age }}</p>
                        {{-- class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl break-words" --}}

                        <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                            <span
                                class="text-red-400 font-bold">{{ date('Y-m-d H:i:s', strtotime('-1 day')) < $cheer->created_at ? 'NEW' : '' }}</span>
                            {{ $cheer->created_at }}
                        </p>
                        <img class="w-full mb-2" src="{{ $cheer->image }}" alt="">
                        <img class="w-full mb-2" src="{{ Storage::url($cheer->image_url) }}" alt="">
                        <img class="w-full mb-2" src="{{ asset('storage/' . $cheer->image_url) }}" alt="">
                        {{-- <p class="text-gray-700 text-base">{{ Str::limit($cheer->passport, 50) }}</p> --}}
                    </a>
                </article>
            @endforeach
        </div>
        {{ $cheers->links() }}
    </div>
</x-app-layout>
