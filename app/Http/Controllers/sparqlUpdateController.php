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

    public function createEvent()
    {
        return view('sparql.evenemets.create'); // Make sure to create this view
    }
     // Store a new event
    public function storeEvent(Request $request)
{
    // Validate incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'date' => 'required|date',
        'partner_id' => 'required|string|max:255', // Adjust the validation as per your requirements
        'description' => 'nullable|string',
    ]);

    // Prepare the SPARQL query
    $query = "
    PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

    INSERT DATA {
        _:event a your_ontology:Event;
            your_ontology:Event_Name \"{$validatedData['name']}\";
            your_ontology:Event_Location \"{$validatedData['location']}\";
            your_ontology:Event_Date \"{$validatedData['date']}\";
            your_ontology:Partner_ID \"{$validatedData['partner_id']}\";
            your_ontology:Event_Description \"{$validatedData['description']}\".
    }";

    // Execute the SPARQL query using the correct service
    $this->sparqlServiceUpdate->update($query);

    // Redirect with a success message
    return redirect()->route('evenemets.index')->with('success', 'Événement créé avec succès.');
}
public function createRecommendation()
{
    return view('sparql.recommendation.create');
}
public function storeRecommendation(Request $request)
{
    // Validate the request data
    $request->validate([
        'contenu' => 'required|string|max:255',
        'type_Recommendation' => 'required|string|max:255',
    ]);

    // Create SPARQL query to add the recommendation
    $query = "
    PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>
    INSERT DATA {
        your_ontology:recommandation_" . uniqid() . " a your_ontology:Recommandation;
            your_ontology:contenu '" . htmlspecialchars($request->contenu, ENT_QUOTES) . "';
            your_ontology:type_Recommendation '" . htmlspecialchars($request->type_Recommendation, ENT_QUOTES) . "'.
    }";

    // Execute the SPARQL update query
    $this->sparqlServiceUpdate->update($query);

    // Redirect back to the index with a success message
    return redirect()->route('recommendation.index')->with('success', 'Recommandation ajoutée avec succès.');
}
}
