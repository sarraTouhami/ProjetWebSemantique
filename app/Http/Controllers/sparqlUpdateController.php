<?php

namespace App\Http\Controllers;
use App\Services\SparqlService;
use App\Services\sparqlServiceUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class sparqlUpdateController extends Controller
{
    protected $sparqlService;
    protected $sparqlServiceUpdate;


    public function __construct(SparqlService $sparqlService, SparqlServiceUpdate $sparqlServiceUpdate)
    {
        $this->sparqlService = $sparqlService;
        $this->sparqlServiceUpdate = $sparqlServiceUpdate;
        $this->sparqlService = $sparqlService;
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

    /////////////////////POST//////////////////////////////

    public function deleteUser(Request $request)
    {
        $request->validate([
            'individualUri' => 'required|string',
        ]);

        $individualUri = $request->input('individualUri');
        $query = "
        PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

        DELETE WHERE {
            <{$individualUri}> ?p ?o.
        }
    ";

        try {
            $this->sparqlServiceUpdate->update($query);
            return redirect()->route('utilisateur.search')->with('success', 'Utilisateur supprimé avec succès.');

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Erreur lors de la suppression : ' . $e->getMessage()]);
        }
    }


    public function createPost()
    {
        // SPARQL query to fetch user instances
        $query = "
        PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

        SELECT ?user ?nom WHERE {
            { ?user a your_ontology:Donateur .
              OPTIONAL { ?user your_ontology:nom ?nom }
            }
            UNION
            { ?user a your_ontology:Beneficiaire .
              OPTIONAL { ?user your_ontology:nom ?nom }
            }
            UNION
            { ?user a your_ontology:Transporteur .
              OPTIONAL { ?user your_ontology:nom ?nom }
            }
        }

        ";

        // Execute the query and get the results using the query endpoint
        $users = $this->sparqlService->query($query);

        // Return the view with user instances
        return view('sparql.post.create', compact('users'));
    }

    public function storePost(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'contenu' => 'required|string',
            'type_de_post' => 'required|string|max:255',
            'creator' => 'required|url',
        ]);

        // Construct the SPARQL query to create a new post
        $query = "
        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

        INSERT DATA {
            _:post a your_ontology:Post ;
                  your_ontology:title \"{$validatedData['title']}\" ;
                  your_ontology:contenu \"{$validatedData['contenu']}\" ;
                  your_ontology:type_de_post \"{$validatedData['type_de_post']}\" ;
                  your_ontology:estCrééPar <{$validatedData['creator']}> .
        }
    ";

        // Execute the SPARQL query
        $this->sparqlServiceUpdate->update($query);

        // Redirect with success message
        return redirect()->route('posts.all')->with('success', 'The post has been created successfully.');
    }


    public function createinventaireb()
    {
        // Requête SPARQL pour obtenir les produits frais et alimentaires, incluant l'URI du produit
        $query = "
        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
        PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

        SELECT ?produit ?nom_aliment ?quantite_aliment ?date_permption ?categorie_aliment WHERE {
            {
                ?produit rdf:type your_ontology:Produit_Frais .
                ?produit your_ontology:nom_aliment ?nom_aliment .
                ?produit your_ontology:quantité_aliment ?quantite_aliment .
                ?produit your_ontology:date_permption ?date_permption .
                ?produit your_ontology:catégorie_aliment ?categorie_aliment .
            }
            UNION
            {
                ?produit rdf:type your_ontology:Produit_Alimentaire .
                ?produit your_ontology:nom_aliment ?nom_aliment .
                ?produit your_ontology:quantité_aliment ?quantite_aliment .
                ?produit your_ontology:date_permption ?date_permption .
                ?produit your_ontology:catégorie_aliment ?categorie_aliment .
            }
        }
        ";

        // Exécution de la requête SPARQL
        $results = $this->sparqlService->query($query);
        $produits = $results['results']['bindings'] ?? [];

        // Traitement supplémentaire si nécessaire pour structurer les données

        return view('sparql.inventairebe.create', ['produits' => $produits]);
    }

    public function storeinventaireb(Request $request)
{
    // Vérification des produits sélectionnés
    $selectedProducts = $request->input('produits');

    // Debugging: Afficher les produits sélectionnés
    \Log::info('Produits sélectionnés: ', [$selectedProducts]);

    // Vérifier si les produits sont sélectionnés et s'il s'agit d'un tableau
    if (is_null($selectedProducts) || !is_array($selectedProducts) || empty($selectedProducts)) {
        return redirect()->back()->with('error', 'Veuillez sélectionner au moins un produit.');
    }

    // URI de l'inventaire spécifique
    $inventaireUri = "http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#inventaireBeneficiaire_001";

    // Construction de la requête SPARQL pour l'affectation
    $query = "
        PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>
        INSERT DATA {
    ";

    // Boucle pour ajouter chaque produit sélectionné
    foreach ($selectedProducts as $productId) {
        // Vérifier l'ID de produit pour le débogage
        \Log::info('Ajout du produit: ', [$productId]);

        // Remplacer $productId par l'URI de produit correspondant
        // Assurez-vous que le $productId correspond à la bonne structure d'URI
        $query .= "{$inventaireUri} your_ontology:contientProduit <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#{$productId}> . ";
    }

    // Clôture de la requête
    $query .= "}";

    // Affichage de la requête pour le débogage
    \Log::info('Requête SPARQL: ', [$query]);

    // Exécution de la requête SPARQL pour l'insertion
    try {
        $this->sparqlServiceUpdate->update($query);
    } catch (\Exception $e) {
        \Log::error('Erreur lors de l\'exécution de la requête SPARQL: ', ['message' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Erreur lors de l\'affectation des produits à l\'inventaire.');
    }

    // Rediriger avec un message de succès
    return redirect()->route('inventairebe.index')->with('success', 'Les produits ont été affectés à l\'inventaire avec succès.');
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

/////////
    // Method for showing the create form for products
    public function createProduct()
    {
        return view('sparql.produits.create');
    }

    // Method for storing a new product
    public function storeProduct(Request $request)
    {
        // Valider les données de la requête
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_type' => 'required|string|in:Produit_Alimentaire,Produit_Frais',
            'quantity' => 'required|integer|min:1',
            'expiration_date' => 'required|date',
            'category' => 'nullable|string|max:255',
        ]);

        // Construire la requête SPARQL avec les données validées
        $query = "
        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

        INSERT DATA {
            _:produit a your_ontology:{$validatedData['product_type']} ;
                      your_ontology:nom_aliment \"{$validatedData['product_name']}\" ;
                      your_ontology:quantité_aliment \"{$validatedData['quantity']}\"^^<http://www.w3.org/2001/XMLSchema#integer> ;
                      your_ontology:date_permption \"{$validatedData['expiration_date']}\"^^<http://www.w3.org/2001/XMLSchema#date> ;
                      " . ($validatedData['category'] ? "your_ontology:catégorie_aliment \"{$validatedData['category']}\" ." : "") . "
        }
        ";

        try {
            // Exécuter la requête SPARQL
            $this->sparqlServiceUpdate->update($query);

            // Rediriger avec un message de succès
            return redirect()->route('produit.calender')->with('success', 'Le produit a été créé avec succès.');
        } catch (\Exception $e) {
            // En cas d'erreur, enregistrer l'erreur et rediriger avec un message d'erreur
            Log::error('Erreur SPARQL : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
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


