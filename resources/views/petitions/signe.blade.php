<div>
    <div class="mb-12">
        <div class="w-full bg-gray-200 rounded-full h-2.5">
            <div class="bg-blue-600 h-2.5 rounded-full" style="{{ 'width:'.( $petition->signataires->count()*100/$petition->objectif).'%' }}"></div>
        </div>
        <div class="flex justify-between">
            <span>{{ $petition->signataires->count() }}</span>
            <span>objectif: {{ $petition->objectif }}</span>
        </div>
    </div>
    <h1 class="text-3xl font-semibold mb-4">Signer la pétition</h1>
    <form action="{{ route('signataires.store', $petition->id) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="nom" class="block text-gray-700 font-bold">Nom</label>
            <input type="text" name="nom" id="nom" class="form-input mt-1 block w-full" required>
            @error('nom')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="prenom" class="block text-gray-700 font-bold">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-input mt-1 block w-full" required>
            @error('prenom')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-bold">Email</label>
            <input type="email" name="email" id="email" class="form-input mt-1 block w-full" required>
            @error('email')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="telephone" class="block text-gray-700 font-bold">Téléphone</label>
            <input type="text" name="telephone" id="telephone" class="form-input mt-1 block w-full" required>
            @error('telephone')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="pays" class="block text-gray-700 font-bold">Pays de résidence</label>
            <input type="text" name="pays" id="pays" class="form-input mt-1 block w-full" required>
            @error('pays')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="ville" class="block text-gray-700 font-bold">Ville de résidence</label>
            <input type="text" name="ville" id="ville" class="form-input mt-1 block w-full" required>
            @error('ville')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2">Signer</button>
            <a href="{{ route('petitions.show', $petition->id) }}" class="text-gray-600 ml-2">Annuler</a>
        </div>
    </form>
</div>
