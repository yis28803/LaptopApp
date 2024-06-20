@extends('admin.admin')
@section('title', 'Manage Laptops')

@section('content')
<div class="container mx-auto p-4">
    <div class="p-2 mb-4">
        <form method="GET" action="{{ route('admin_laptop.search') }}">
            <div class="flex">  <x-text-input id="keyword" class="block mt-1 w-50 mr-2"
                type="text"
                name="keyword"
                required autocomplete=""
                placeholder="name or brand" />
            <x-primary-button class="mx-3">Search</x-primary-button>
            
            <x-nav-link :href="route('admin_laptop.show_create')" class="text-green-600 hover:text-green-800  mx-3">
                {{ __('CREATE') }}
            </x-nav-link>
        </div>
          
        </form>
    </div>

    <x-table :headers="['ID', 'Name', 'Price', 'Thumbnail', 'Description', 'Actions']" :data="$laptops" class="border-collapse border border-gray-200">
        @foreach ($laptops as $laptop)
        <tr>
            <td class="px-6 py-4 whitespace-no-wrap">{{ $laptop->id }}</td>
            <td class="px-6 py-4 whitespace-no-wrap">{{ $laptop->name }}</td>
            <td class="px-6 py-4 whitespace-no-wrap">{{ $laptop->price }}</td>
            <td class="px-6 py-4 whitespace-no-wrap">
                @if ($laptop->avatar_url)
                <img src="{{ $laptop->avatar_url }}" alt="{{ $laptop->name }}" class="w-16 h-16 object-cover rounded">
                @else
                No Image
                @endif
            </td>
            <td class="px-6 py-4 whitespace-no-wrap">{{ $laptop->description }}</td>
            <td class="px-6 py-4 whitespace-no-wrap flex">
                <x-nav-link :href="route('admin_laptop.show_update', ['id' => $laptop->id])" class="text-indigo-600 hover:text-indigo-900">
                    {{ __('Edit') }}
                </x-nav-link>
                <form method="POST" action="{{ route('admin_laptop.delete', ['id' => $laptop->id]) }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <x-nav-link onclick="return confirm('Are you sure?')" class="text-red-600 hover:text-red-900">
                        {{ __('Delete') }}
                    </x-nav-link>
                </form>
            </td>
            <tr>
                <td colspan="6" class="border-t border-gray-200"></td>
            </tr>
        </tr>
        @endforeach
    </x-table>

    {{ $laptops->links() }}
</div>
@endsection
