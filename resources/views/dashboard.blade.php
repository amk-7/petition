<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tableau de board') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto flex flex-col items-center sm:px-6 lg:px-8">
            <div class="mb-3 flex justify-between items-center space-x-12">
                <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tigh">List des pétitions</h1>
                <a href="{{ route('petitions.create') }}">
                    <button class="bg-blue-500 text-white px-2 py-3 rounded-lg">Ajouter</button>
                </a>
            </div>
            <div class="">
                @foreach($petitions as $petition)
                <div class="flex flex-col md:flex-row items-center bg-white  dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-3">
                    <img class="w-32 rounded-l-xl" src="/storage/petitions/{{ $petition->image }}" alt="">
                    <div class="p-6 text-gray-900 dark:text-gray-100 w-64 md:w-full">
                        <h1 class="font-semibold text-xl mb-3"> {{ $petition->titre }} </h1>
                        <p>
                            {{ $petition->description }}
                        </p>
                        <div class="mt-4 flex space-x-3">
                            <a href="{{ route('petitions.show', $petition) }}">
                                <button class="bg-green-500 text-white px-2 py-1 rounded-lg">Lire +</button>
                            </a>
                            <a href="{{ route('petitions.export', $petition) }}">
                                <button class="bg-blue-500 text-white px-2 py-1 rounded-lg">Signataires</button>
                            </a>
                            <!-- Bouton Partager sur WhatsApp -->
                            <button id="copierBtn" onclick="copierLien(`{{ route('petitions.show', $petition) }}`)" class="bg-gray-500 text-white px-2 py-1 rounded-lg">copier le lien</button>
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
