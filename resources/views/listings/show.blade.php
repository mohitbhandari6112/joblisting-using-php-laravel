<x-layout>
    <a href="/" class="inline-block mb-4 ml-4 text-black"><i class="fa-solid fa-arrow-left"></i> Back
    </a>
    <div class="mx-4">
        <x-card>
            <div class="flex flex-col items-center justify-center text-center">
                <img class="w-48 mb-6 mr-6"
                    src="{{ $listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png') }}"
                    alt="" />

                <h3 class="mb-2 text-2xl">{{ $listing->title }}</h3>
                <div class="mb-4 text-xl font-bold">{{ $listing->company }} </div>

                <x-listing-tags :tagsCsv='$listing->tags' />

                <div class="my-4 text-lg">
                    <i class="fa-solid fa-location-dot"></i>{{ $listing->location }}
                </div>
                <div class="w-full mb-6 border border-gray-200"></div>
                <div>
                    <h3 class="mb-4 text-3xl font-bold">
                        Job Description
                    </h3>
                    <div class="space-y-6 text-lg">
                        {{ $listing->description }}

                        <a href="{{ $listing->emial }}"
                            class="block py-2 mt-6 text-white bg-laravel rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-envelope"></i>
                            Contact Employer</a>

                        <a href="{{ $listing->website }}" target="_blank"
                            class="block py-2 text-white bg-black rounded-xl hover:opacity-80"><i
                                class="fa-solid fa-globe"></i> Visit
                            Website</a>
                    </div>
                </div>
            </div>
        </x-card>
        {{-- <x-card class="flex mt-4 gap-x-4">
            <a href="/listings/{{ $listing->id }}/edit">
                <i class="fa-solid fa-pencil"></i>Edit
            </a>

            <form action="/listings/{{ $listing->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="text-red-500">
                    <i class="fa-solid fa-trash"></i>Delete
                </button>
            </form>
        </x-card> --}}

    </div>
</x-layout>
