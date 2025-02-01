<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <form action="{{ route('search.results') }}" method="GET">
            <input type="text" name="keyword" placeholder="検索キーワード" class="border p-2">
            <button type="submit" class="bg-blue-500 text-white p-2">検索</button>
        </form>
    </div>
</x-app-layout>
