<x-app-layout>
    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 bg-white shadow-md">
        <h2 class="text-center text-lg font-bold pt-6 tracking-widest">ブログ登録</h2>

        <x-validation-errors :errors="$errors" />

        <form action="{{ route('cheers.store') }}" method="POST" enctype="multipart/form-data"
            class="rounded pt-3 pb-8 mb-4">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="first_name">
                    First Name
                </label>
                <input type="text" name="first_name"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="First Name" value="{{ old('first_name') }}">

                <label class="block text-gray-700 text-sm mb-2" for="last_name">
                    Last Name
                </label>
                <input type="text" name="last_name"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="Last Name" value="{{ old('last_name') }}">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="last_name">
                    Last Name
                </label>
                <textarea name="last_name" rows="10"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required>{{ old('last_name') }}</textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="image">
                    ブログ用画像
                </label>
                <input type="file" name="image" class="border-gray-300">
            </div>
            <input type="submit" value="Submit"
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>
    </div>
</x-app-layout>
