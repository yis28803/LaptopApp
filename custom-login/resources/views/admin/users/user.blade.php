@extends('admin.admin')
@section('title','Manage Users')
  
@section('content')
<div class="container mx-auto p-4">
    <div class="p-2 mb-4">
        <form method="GET" action="{{ route('admin_user.search') }}">
            <div class="flex"> 
                <x-text-input id="keyword" class="block mt-1 w-50 mr-2"
                type="text"
                name="keyword"
                required autocomplete=""
                placeholder="name or email" />
                <x-primary-button class="">Search</x-primary-button></div>
        </form>
    </div>

    <x-table :headers="['ID', 'Name', 'Email', 'Orders','Cart' ,'Actions']" :data="$users" class="border-collapse border border-gray-200">
        @foreach ($users as $user)
        <tr>
            <td class="px-6 py-4 whitespace-no-wrap">{{ $user->id }}</td>
            <td class="px-6 py-4 whitespace-no-wrap">{{ $user->name }}</td>
            <td class="px-6 py-4 whitespace-no-wrap">{{ $user->email }}</td>
            <td class="px-6 py-4 whitespace-no-wrap"> 
             <x-nav-link :href="route('admin_order.searchByUserId', ['id' => $user->id])" class="text-indigo-600 hover:text-indigo-900">
                {{ $user->orders->count() }}
            </x-nav-link></td>

            <td class="px-6 py-4 whitespace-no-wrap">
                <x-nav-link :href="''" class="text-yellow-600 hover:text-yellow-900">
                    {{ $user->cartItems->count() }}
                </x-nav-link>
            </td>
            <td class="px-6 py-4 whitespace-no-wrap flex">
                <form method="POST" action="{{ route('admin_user.delete', ['id' => $user->id]) }}" class="inline">
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

    {{ $users->links() }}
</div>
@endsection 