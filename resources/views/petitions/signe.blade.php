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
    @if($success ?? "")
        <div class="bg-green-600 text-white p-2 mb-6">
            {{ $success ?? "Pétition signé" }}
        </div>
    @endif
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
            <input type="text" name="telephone" id="telephone" class="form-input  mt-1 block w-full" required>
            @error('telephone')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="ville" class="block text-gray-700 font-bold">Pays de résidence</label>
            <div class="mb-4 flex">
                <select name="pays" id="pays" onchange="findTownsByCountry()" class="w-full">
                    <option value="">Séléctionner</option>
                </select>
            </div>
            @error('pays')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="ville" class="block text-gray-700 font-bold">Ville de résidence</label>
            <div class="mb-4 flex">
                <select name="ville" id="ville" class="w-full">
                    <option value="">Séléctionner</option>
                </select>
            </div>
            @error('pays')
                <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Signer</button>
            <a href="{{ route('petitions.show', $petition->id) }}" class="text-white px-4 py-2 rounded-lg bg-gray-600 ml-2">Annuler</a>
        </div>
    </form>
    <!--  -->
    <script type="text/javaScript">
        let headers = new Headers();
        let API_KEY = "NTVCTEQ0RnZxNHRHck00ZUVyb1VOM0xaT0p1RzVXR3lad09kUXZwSw==";
        headers.append("X-CSCAPI-KEY", API_KEY);

        let paysTag = document.getElementById("pays");
        let villeTag = document.getElementById("ville");
        let countries = []; 

        const uploadCountrys = () => {
            options = "";
            countries.forEach((elt) => options += `<option value="${elt.name}-${elt.iso2}">${elt.name}</option>`);
            paysTag.innerHTML += options;
        }

        const uploadTowns = (towns) => {
            options = "<option value=''>Séléctionner</option>";
            towns.forEach((elt) => options += `<option value="${elt.name}">${elt.name}</option>`);
            villeTag.innerHTML = options;
        }

        const findTownsByCountry = () => {
            code_pays = paysTag.value.split('-')[1];
            let requestOptions = {
                method: 'GET',
                headers: headers,
                redirect: 'follow'
            };

            fetch("https://api.countrystatecity.in/v1/countries/"+code_pays+"/cities", requestOptions)
            .then(response => response.text())
            .then(result => {
                console.log("DATA");
                let towns = JSON.parse(result);
                console.log(towns);
                uploadTowns(towns);
            })
            .catch(error => console.log('error', error));
        }

        

        let requestOptions = {
        method: 'GET',
        headers: headers,
        redirect: 'follow'
        };

        fetch("https://api.countrystatecity.in/v1/countries", requestOptions)
        .then(response => response.text())
        .then(result => {
            console.log("DATA");
            countries = JSON.parse(result);
            uploadCountrys();
        })
        .catch(error => console.log('error', error));


    </script>
</div>
