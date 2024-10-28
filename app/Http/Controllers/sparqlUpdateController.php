<?php

namespace App\Http\Controllers;

use App\Services\sparqlServiceUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class sparqlUpdateController extends Controller
{
    protected $sparqlServiceUpdate;

    public function __construct(sparqlServiceUpdate $sparqlServiceUpdate)
    {
        $this->sparqlServiceUpdate = $sparqlServiceUpdate;
    }
  
    public function create()
    {
        return view('sparql.don.create');
    }

    public function store(Request $request)
    {
        // Valider les données de la requête
        $validatedData = $request->validate([
            'type_aliment' => 'required|string|max:255',
            'quantité' => 'required|integer|min:1',
            'date_don' => 'required|date',
            'date_permption' => 'required|date',
            'statut_don' => 'required|string|max:255',

        ]);

        // Construire la requête SPARQL pour créer un nouveau don
        $query = "
        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

        INSERT DATA {
            _:don a your_ontology:Don ;
                  your_ontology:type_aliment \"{$validatedData['type_aliment']}\" ;
                  your_ontology:quantité \"{$validatedData['quantité']}\" ;
                  your_ontology:date_don \"{$validatedData['date_don']}\" ;
                  your_ontology:date_permption \"{$validatedData['date_permption']}\" ;
                  your_ontology:statut_don \"{$validatedData['statut_don']}\" ;.
                  
        }
        ";

        // Exécuter la requête SPARQL
        $this->sparqlServiceUpdate->update($query); // Changement ici pour appeler update()

        // Rediriger avec un message de succès
        return redirect()->route('don.search')->with('success', 'Le don a été créé avec succès.');
    }

    // sparqlUpdateController.php

    public function delete(Request $request)
    {
        // Valider les données de la requête
        $validator = Validator::make($request->all(), [
            'attribute' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }
    
        // Extraire l'attribut et la valeur
        $attribute = $request->input('attribute');
        $value = $request->input('value');
    
        try {
            // Construire la requête SPARQL pour supprimer le don
            $query = "
            PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>
    
            DELETE {
                ?don a your_ontology:Don ;
                     your_ontology:{$attribute} \"$value\" .
            }
            WHERE {
                ?don a your_ontology:Don ;
                     your_ontology:{$attribute} \"$value\" .
            }
            ";
    
            // Exécuter la requête SPARQL
            $this->sparqlServiceUpdate->update($query); // Appeler la méthode pour exécuter la mise à jour
    
            // Rediriger avec un message de succès
            return redirect()->route('don.search')->with('success', 'Le don a été supprimé avec succès.');
    
        } catch (\Exception $e) {
            // En cas d'erreur, rediriger avec un message d'erreur
            return redirect()->back()->with('error', 'Erreur lors de la suppression du don : ' . $e->getMessage());
        }
    }

 //reservation_add
 public function add()
{
    return view('sparql.reservation.add');
}
public function addReserv(Request $request)
{
    // Valider les données de la requête
    $validatedData = $request->validate([
        'status_reserv' => 'required|string|in:Confirmée,Réservée',
        'date_reservation' => 'required|date',
        'Date_de_livraison' => 'required|date',
    ]);

    // Construire la requête SPARQL pour insérer une nouvelle réservation
    $query = "
    PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
    PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>
    PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>

    INSERT DATA {
        _:reservation rdf:type your_ontology:Reservation ;
                      your_ontology:status_reserv \"{$validatedData['status_reserv']}\" ;
                      your_ontology:date_reservation \"{$validatedData['date_reservation']}\"^^xsd:dateTime ;
                      your_ontology:Date_de_livraison \"{$validatedData['Date_de_livraison']}\"^^xsd:dateTime .
    }
    ";

    Log::info('Requête SPARQL pour ajout de réservation:', ['query' => $query]);

    // Exécution de la requête SPARQL
    try {
        $this->sparqlService->update($query);
        return response()->json(['message' => 'Réservation ajoutée avec succès'], 201);
    } catch (\Exception $e) {
        Log::error('Erreur lors de l\'ajout de la réservation:', [
            'error' => $e->getMessage(),
            'query' => $query,
        ]);
        return response()->json(['message' => 'Erreur lors de l\'ajout de la réservation'], 500);
    }
}



    
}