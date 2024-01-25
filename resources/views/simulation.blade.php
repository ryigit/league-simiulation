<x-layout>
    <div class="grid grid-cols-1 text-2xl text-center border-b border-amber-50 mb-4">
        <h1 class="text-white py-4">League Simulation</h1>
    </div>
    <div class="grid grid-cols-3 gap-3 m-4">
        <x-standings :teams="$teams"/>
        <x-week :weekGames="$weekGames"/>
        <x-predictions :predictions="$predictions"/>
    </div>
    <div class="grid grid-cols-3 gap-3">
        <div class="items-center">
            <form action="{{route('simulation.simulateAllWeeks')}}" method="POST" class="flex items-center justify-center my-6">
                @csrf
                <button type="submit"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Simulate All Weeks
                </button>
            </form>
        </div>
        <div class="items-center">
            <form action="{{route('simulation.simulateNextWeek')}}" method="POST" class="flex items-center justify-center my-6">
                @csrf
                <button type="submit"
                        class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Simulate Next Week
                </button>
            </form>
        </div>
        <div class="items-center">
            <form action="{{route('reset')}}" method="POST" class="flex items-center justify-center my-6">
                @csrf
                <button type="submit"
                        class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                    Reset Simulation
                </button>
            </form>
        </div>
    </div>
</x-layout>
