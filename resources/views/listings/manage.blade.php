<x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="my-6 text-3xl font-bold text-center uppercase">
                Manage Gigs
            </h1>
        </header>
        <table class="w-full rounded-sm table-auto">
            <tbody>
                @unless ($listings->isEmpty())
                    @foreach ($listings as $listing)
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 text-lg border-t border-b border-gray-300">
                                <a href="/listings/{{ $listing->id }}">
                                    {{ $listing->title }}
                                </a>
                            </td>
                            <td class="px-4 py-8 text-lg border-t border-b border-gray-300">
                                <a href="/listings/{{ $listing->id }}/edit" class="px-6 py-2 text-blue-400 rounded-xl"><i
                                        class="fa-solid fa-pen-to-square"></i>
                                    Edit</a>
                            </td>
                            <td class="px-4 py-8 text-lg border-t border-b border-gray-300">
                                <form action="/listings/{{ $listing->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500">
                                        <i class="fa-solid fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 text-lg border-t border-b border-gray-300">
                            <p class="text-center">No Listings Found</p>
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </x-card>
</x-layout>
