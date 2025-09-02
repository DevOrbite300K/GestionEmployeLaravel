<table border="1" cellspacing="0" cellpadding="3" width="100%">
    <thead>
        <tr>
            <th>Photo</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Adresse</th>
            <th>Matricule</th>
            <th>Date Embauche</th>
            <th>Responsable</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employes as $employe) 
        <tr>
            <td>
                @if($employe->photo)
                    @php
                        $photoPath = storage_path('app/public/' . $employe->photo);
                    @endphp
                    <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents($photoPath)) }}" width="50" height="50">
                @else
                    ---
                @endif
            </td>
            <td>{{ $employe->nom }}</td>
            <td>{{ $employe->prenom }}</td>
            <td>{{ $employe->email }}</td>
            <td>{{ $employe->telephone }}</td>
            <td>{{ $employe->adresse }}</td>
            <td>{{ $employe->matricule }}</td>
            <td>{{ $employe->date_embauche }}</td>
            <td>{{ $employe->est_responsable ? 'Oui' : 'Non' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
