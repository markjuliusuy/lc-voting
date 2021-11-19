<x-app-layout>
    <div class="filters flex space-x-6">
        <div class="w-1/3">
            <select name="category" id="category" class="w-full rounded-xl px-4 py-2">
                <option value="Category One">Category One</option>
            </select>
        </div>
        <div class="w-1/3">
            <select name="other_filters" id="other_filters" class="w-full rounded-xl px-4 py-2">
                <option value="Filter One">Filter One</option>
            </select>
        </div>
        <div class="w-2/3 relative">
            <input type="text" placeholder="Find an idea"
                class="w-full rounded-full bg-white px-4 py-2 pl-8 border-none placeholder-gray-900" />
            <div class="absolute top-0 h-full ml-2 flex items-center">
                <svg class="w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
        .
    </div>
</x-app-layout>