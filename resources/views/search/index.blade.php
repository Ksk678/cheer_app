<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <div class="container max-w-7xl mx-auto px-4 md:px-12 pb-3 mt-3 grid grid-cols-3 gap-4">
        <!-- 検索フォーム: 左側1/3 -->
        <div class="col-span-1">
            <form method="GET" action="{{ route('search.index') }}">
                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium text-gray-700">First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="{{ request('first_name') }}"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="{{ request('last_name') }}"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="position" class="block text-sm font-medium text-gray-700">Position:</label>
                    <input type="text" id="position" name="position" value="{{ request('position') }}"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="age_min" class="block text-sm font-medium text-gray-700">Age (Min):</label>
                    <input type="number" id="age_min" name="age_min" value="{{ request('age_min') }}"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="age_max" class="block text-sm font-medium text-gray-700">Age (Max):</label>
                    <input type="number" id="age_max" name="age_max" value="{{ request('age_max') }}"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="nationality" class="block text-sm font-medium text-gray-700">Nationality:</label>
                    <input type="text" id="nationality" name="nationality" value="{{ request('nationality') }}"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <div class="mb-4">
                    <label for="passport" class="block text-sm font-medium text-gray-700">Passport:</label>
                    <input type="text" id="passport" name="passport" value="{{ request('passport') }}"
                        class="mt-1 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                </div>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Search</button>
            </form>
        </div>

        <!-- 検索結果: 右側2/3 -->
        <div class="col-span-2">
            @if ($players->isNotEmpty())
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Search Results</h3>
                    </div>
                    <div class="border-t border-gray-200">
                        <dl>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                @foreach ($players as $player)
                                    <article class="w-full">
                                        <a href="{{ route('players.show', $player) }}">
                                            <div class="flex justify-center item-center mb-2">
                                                <img class="h-40 mb-2 object-cover"
                                                    src="{{ Storage::url('images/players/' . $player->image) }}"
                                                    alt="">
                                            </div>

                                            <h4 class="text-lg md-2 font-bold break-words"> {{ $player->first_name }}
                                                {{ $player->last_name }}
                                            </h4>
                                            <p class="text-sm break-words">{{ $player->position }}</p>
                                            <p class="text-sm break-words">Age: {{ $player->age }}</p>

                                            <p class="text-sm mb-2 md:text-base font-normal text-gray-600 break-words">
                                                <span
                                                    class="text-red-400 font-bold">{{ date('Y-m-d', strtotime('-1 day')) < $player->created_at ? 'NEW' : '' }}</span>
                                                {{ $player->created_at->format('Y-m-d') }}
                                            </p>
                                        </a>
                                    </article>
                                @endforeach
                            </div>
                        </dl>
                    </div>
                </div>
            @else
                <p class="text-gray-500">No results found.</p>
            @endif
        </div>
    </div>
</x-app-layout>
