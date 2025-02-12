<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container lg:w-1/2 md:w-4/5 w-11/12 mx-auto mt-8 px-8 bg-white shadow-md">
        <h2 class="text-center text-lg font-bold pt-6 tracking-widest">Profile</h2>

        <x-validation-errors :errors="$errors" />

        <form action="{{ route('players.store') }}" method="POST" enctype="multipart/form-data"
            class="rounded pt-3 pb-8 mb-4">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="first_name">First Name</label>
                <input type="text" name="first_name"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="First Name" value="{{ old('first_name') }}">

                <label class="block text-gray-700 text-sm mb-2" for="last_name">Last Name</label>
                <input type="text" name="last_name"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="Last Name" value="{{ old('last_name') }}">

                <label class="block text-gray-700 text-sm mb-2" for="position">Position</label>
                <input type="text" name="position"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="Position" value="{{ old('position') }}">

                <label class="block text-gray-700 text-sm mb-2" for="dob">DoB</label>
                <input type="date" name="dob" id="dob"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required value="{{ old('dob') }}">

                <label class="block text-gray-700 text-sm mb-2" for="age">Age</label>
                <input type="text" name="age" id="age"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    readonly placeholder="Age">

                <label class="block text-gray-700 text-sm mb-2" for="height">Height</label>
                <input type="text" name="height"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="Height" value="{{ old('height') }}">

                <label class="block text-gray-700 text-sm mb-2" for="weight">
                    Weight
                </label>
                <input type="text" name="weight"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="Weight" value="{{ old('weight') }}">

                <label class="block text-gray-700 text-sm mb-2" for="nationality">
                    Nationality
                </label>
                <input type="text" name="nationality"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="Nationality" value="{{ old('nationality') }}">

                <label class="block text-gray-700 text-sm mb-2" for="passport">
                    Passport
                </label>
                <input type="text" name="passport"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full py-2 px-3"
                    required placeholder="Passport" value="{{ old('passport') }}">

            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="highlight">Highlight</label>
                <input type="file" name="highlight" class="border-gray-300">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm mb-2" for="image">Image</label>
                <input type="file" name="image" class="border-gray-300">
            </div>

            <input type="submit" value="Submit"
                class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
        </form>
    </div>

    <script>
        document.getElementById('dob').addEventListener('input', function() {
            const dob = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - dob.getFullYear();
            const m = today.getMonth() - dob.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
                age--;
            }
            document.getElementById('age').value = age;
        });
    </script>

</x-app-layout>
