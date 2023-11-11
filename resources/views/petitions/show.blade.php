<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Détails de la pétition : ') }} {{ $petition->titre }}
        </h2>
    </x-slot>
    <div class="py-12 w-2/3 m-auto flex flex-col items-center lg:flex-row space-y-3 lg:space-y-0 space-x-0 lg:space-x-3" style="">
        @if ($petition->etat)
        <div class="rounded-lg flex flex-col items-center lg:w-2/3 w-full" >
            <div class="p-5 ">
                @if (Auth::user())
                <div class="mb-4 flex items-center justify-between">
                    <div>
                        <a href="{{ route('petitions.edit', $petition) }}" class="bg-blue-500 px-2 py-2 rounded-lg text-white px-4 py-2">Éditer</a>
                        <form action="{{ route('petitions.destroy', $petition) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-2 rounded-lg" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette pétition?')">Supprimer</button>
                        </form>
                    </div>
                    <a href="{{ route('petitions.index') }}" class="text-gray-600 ml-2 bg-green-100 rounded-xl"> <- Retour à la liste des pétitions</a>
                </div>
                @endif
                <div class="mb-4 flex flex-col items-center">
                    <img src="/storage/petitions/{{ $petition->image }}" alt="Image de la pétition" width="500px">
                </div>
                <div class="mb-4">
                    <h1 class="text-3xl font-semibold">{{ $petition->titre }}</h1>
                    <p>
                        État: 
                        <span class="{{ $petition->etat == 1 ? 'text-gree-500' : 'text-red-500' }}">{{ $petition->etat == 1 ? 'Actif' : 'Inactif' }}</span>
                    </p>
                </div>
                <div class="mb-4">
                    <p class="text-gray-700">Objectif: {{ $petition->objectif }}</p>
                </div>
                <div class="mb-4">
                    <p class="text-gray-700">{{ $petition->description }}</p>
                </div>  
            </div>
        </div>
        <div class="p-3 bg-white rounded-lg lg:w-1/3 w-full">
            @include('petitions.signe')
        </div>
        @else
        <div class="m-auto">La pétition est innactifs</div>
        @endif
    </div>
</x-app-layout>
