@if (is_numeric($user->id))
    <a href="{{ route('profil', $user->name) }}" title="Profile git" class="w-max">
        @endif
        <div
            class="flex items-center font-bold {{ $bg }} border {{ $border }} w-max p-1.5 px-4 rounded-xl mt-1 cursor-pointer hover:bg-gray-200 transition">
            <img class="inline w-10 h-10 rounded-full"
                 src="{{ $user->profile_photo_url }}"
                 alt="{{ $user->name }}"/>
            <p class="ml-2 @if (is_numeric($user->id)) text-blue-500 @else text-gray-600 @endif">{{ $user->name }}</p>
        </div>
        @if (is_numeric($user->id))
    </a>
@endif
