<x-layout>
    <div class="flex items-center">
        <x-standings :teams="$teams"/>
        <x-week :weekGames="$weekGames"/>
        <x-predictions :predictions="$predictions"/>
    </div>
</x-layout>
