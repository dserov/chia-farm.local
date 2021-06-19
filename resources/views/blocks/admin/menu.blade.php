<div class="menu flex">
    @foreach((new \App\Models\Menu())->getAdminMenu() as $item)
        <a href="{{ route($item['alias']) }}"
           class="text-purple-800 bg-gray-300 hover:text-gray-100 hover:bg-purple-800 px-4 py-2">
            {{$item['title']}}
        </a>
    @endforeach
</div>
