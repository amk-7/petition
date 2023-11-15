<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Tableau de board') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto flex flex-col items-center sm:px-6 lg:px-8">
            <div class="mb-3 flex justify-between items-center space-x-12">
                <h1 class="font-semibold text-xl text-gray-800 leading-tigh">List des pétitions</h1>
                <a href="{{ route('petitions.create') }}">
                    <button class="bg-blue-500 text-white px-2 py-3 rounded-lg">Ajouter</button>
                </a>
            </div>
            <div class="">
                @foreach($petitions as $petition)
                <div class="flex flex-col md:flex-row items-center bg-white  overflow-hidden shadow-sm sm:rounded-lg mb-3">
                    <img class="w-32 rounded-l-xl" src="/storage/petitions/{{ $petition->image }}" alt="">
                    <div class="p-6 text-gray-900 w-64 md:w-full">
                        <h1 class="font-semibold text-xl mb-3"> {{ $petition->titre }} ({{ $petition->signataires->count() }})</h1>
                        <p>
                            {!! $petition->showDescription() !!}
                        </p>
                        <div class="mt-4 flex flex-col md:flex-row md:space-x-3 space-y-3 md:space-y-0 w-full">
                            @if($petition->etat)
                            <a href="{{ route('petitions.show', $petition) }}">
                                <button class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded-lg w-full">Lire +</button>
                            </a>
                            @else
                                <button class="bg-green-300 text-white px-2 py-1 rounded-lg">Lire +</button>
                            @endif
                            
                            <a href="{{ route('petitions.export', $petition) }}">
                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-lg w-full">Signataires</button>
                            </a>
                           
                            <button id="copierBtn" onclick="copierLien(`{{ route('petitions.show', $petition) }}`)" class="bg-gray-500 hover:bg-gray-600 text-white px-2 py-1 rounded-lg">copier le lien</button>
                             
                            <a href="{{ route('petitions.edit', $petition) }}" class="bg-orange-500 hover:bg-orange-600 px-2 py-2 rounded-lg text-white px-4 py-2 text-center">Éditer</a>
                            
                            <form action="{{ route('petitions.destroy', $petition) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-2 py-2 rounded-lg w-full" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette pétition?')">Supprimer</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        function copierLien(lien) {
            console.log(lien);
            // Sélectionner le texte du lien
            var lienPétition = document.createElement("textarea");
            lienPétition.value = lien;
            document.body.appendChild(lienPétition);
            lienPétition.select();
            document.execCommand('copy');
            document.body.removeChild(lienPétition);

            // Afficher un message de confirmation (vous pouvez personnaliser ce message)
            alert('Lien copié dans le presse-papiers !');
        }
    </script>
</x-app-layout>
