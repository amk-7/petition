<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
        {{ isset($petition) ? 'Éditer la Pétition' : 'Enregistrer une Pétition' }}
        </h2>
    </x-slot>
    <div class="py-12 flex flex-col items-center m-3">
        <div class="max-w-7xl mx-auto flex flex-col items-center sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center bg-white overflow-hidden shadow-sm sm:rounded-lg p-5">
            @if(isset($petition))
                <form action="{{ route('petitions.update', $petition) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
            @else
                <form action="{{ route('petitions.store') }}" method="POST" enctype="multipart/form-data">
            @endif
                @csrf
                <div class="mb-4">
                    <label for="titre" class="block text-gray-700 font-bold">Titre de la Pétition</label>
                    <input type="text" name="titre" id="titre" value="{{ old('titre', isset($petition) ? $petition->titre : '') }}" class="form-input mt-1 block w-full" required>
                    @error('titre')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="etat" class="block text-gray-700 font-bold">État de la Pétition</label>
                    <select name="etat" id="etat" class="form-select mt-1 block w-full" required>
                        <option value="1" {{ old('etat', isset($petition) ? $petition->etat : '') == 1 ? 'selected' : '' }}>Actif</option>
                        <option value="0" {{ old('etat', isset($petition) ? $petition->etat : '') == 0 ? 'selected' : '' }}>Inactif</option>
                    </select>
                    @error('etat')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="objectif" class="block text-gray-700 font-bold">Objectif de la Pétition</label>
                    <input type="number" name="objectif" id="objectif" value="{{ old('objectif', isset($petition) ? $petition->objectif : '') }}" class="form-input mt-1 block w-full" required>
                    @error('objectif')
                        <p class="text-red-500 text-xs">{{ $message }}</p>
                    @enderror
                </div>
                    <div class="mb-4 w-80 md:w-full">
                        <label for="description" class="block text-gray-700 font-bold">Description de la Pétition</label>
                        <input type="text" name="description" id="description" value="{!! old('description', isset($petition) ? $petition->description : '') !!}" hidden>
                        <div id="editor" class="">{!! old('description', isset($petition) ? $petition->description : '') !!}</div>
                        @error('description')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-bold">Image de la Pétition</label>
                        <input type="file" name="file" id="image" class="form-input mt-1 block w-full">
                        @error('file')
                            <p class="text-red-500 text-xs">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Enregistrer la Pétition</button>
                        <a href="{{ route('dashboard') }}">
                            <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Annuler</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="/ckeditor5/ckeditor.js"></script>

    <script>
        ClassicEditor
        .create(document.querySelector('#editor'), {
        })
        .then(editor => {
            editor.model.document.on('change:data', () => {
                const content = editor.getData();
                document.querySelector('#description').value = content;
            });
        })
        .catch(error => {
            console.error(error);
        });
    </script>
</x-app-layout>
