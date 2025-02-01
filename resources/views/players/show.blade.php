<x-app-layout>
    <div class="container lg:w-3/4 md:w-4/5 w-11/12 mx-auto my-8 px-8 py-4 bg-white shadow-md">

        @if (session('notice'))
            <div class="bg-blue-100 border-blue-500 text-blue-700 border-l-4 p-4 my-2">
                {{ session('notice') }}
            </div>
        @endif

        <x-validation-errors :errors="$errors" />

        <div class="flex flex-row gap-4">
            <div class="w-1/2 flex justify-center items-center">
                <img class="h-64  mb-2 object-cover" src="{{ Storage::url('images/players/' . $player->image) }}"
                    alt="" class="mb-4">
            </div>

            <div class="w-1/2">
                <article class="mb-2">
                    <h2
                        class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl break-words">
                        {{ $player->first_name }} {{ $player->last_name }}</h2>
                    <h3>Position: {{ $player->position }}</h3>
                    <h3>Age: {{ $player->age }} / DoB: {{ $player->dob }}</h3>
                    <h3>Height: {{ $player->height }}cm</h3>
                    <h3>Weight: {{ $player->weight }}kg</h3>
                    <h3>Nationality: {{ $player->nationality }}</h3>
                    <h3>Passport: {{ $player->passport }}</h3>

                    <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                        <span
                            class="text-red-400 font-bold">{{ date('Y-m-d', strtotime('-1 day')) < $player->created_at ? 'NEW' : '' }}</span>
                        {{ $player->created_at->format('Y-m-d') }}
                    </p>

            </div>
        </div>

        <div class="flex justify-center items-center">
            <video class="w-xl mb-2 object-cover" controls>
                {{-- <source src="{{ Storage::url('videos/players/' . $player->video) }}" type="video/mp4" alt="" class="mb-4"> --}}
                <source src="{{ Storage::url('videos/players/' . $player->highlight) }}" type="video/mp4"
                    alt="" class="mb-4">
                Your browser does not support the video tag.
            </video>
        </div>


        <p class="text-gray-700 text-base break-all">{!! nl2br(e($player->body)) !!}</p>
        </article>
        <div class="flex flex-row text-center my-4">
            @can('update', $player)
                <a href="{{ route('players.edit', $player) }}"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20 mr-2">Edit</a>
            @endcan
            @can('delete', $player)
                <form action="{{ route('players.destroy', $player) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Delete" onclick="if(!confirm('削除しますか？')){return false};"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-20">
                </form>
            @endcan
        </div>
    </div>
</x-app-layout>
