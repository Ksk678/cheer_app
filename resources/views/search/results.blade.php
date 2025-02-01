<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-xl mb-4">検索結果</h2>
        @if($items->isEmpty())
            <p>該当するアイテムはありません。</p>
        @else
            <ul>
                @foreach($items as $item)
                    <li>{{ $item->name }} - {{ $item->description }}</li>
                @endforeach
            </ul>
        @endif
    </div>
</x-app-layout>
