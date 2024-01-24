<x-layout>
    <div class="flex items-center">
        <x-standings :teams="$teams"/>
        <x-week :weekGames="$weekGames"/>
    </div>
</x-layout>
