<?php

namespace App\Http\Controllers;

use App\Services\SparqlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
class SparqlController extends Controller
{
    protected $sparqlService;

    public function __construct(SparqlService $sparqlService)
    {
        $this->sparqlService = $sparqlService;
    }

    public function index()
    {
        $query = '
        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
        PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

        SELECT ?instance WHERE {
          ?instance rdf:type your_ontology:Demande .

        }

        ';

        // Log the SPARQL query for debugging
        Log::info('Executing SPARQL Query:', ['query' => $query]);

        // Execute the SPARQL query
        $results = $this->sparqlService->query($query);

        // Log the results or any errors for debugging
        Log::info('SPARQL Query Results:', ['results' => $results]);

        // Return the results to a view or as JSON
        return response()->json($results);
    }
    //new code
    public function certificationComport(Request $request)
    {
        $searchTerm = strtolower($request->input('search_term')); // Lowercase search term

        // SPARQL query with filters
        $query = "
        PREFIX owl: <http://www.w3.org/2002/07/owl#>
        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
        PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

        SELECT ?instance ?certifStatus ?dateValidate ?nomCertif ?descriptionCertif ?dateCreation WHERE {
        ?instance rdf:type your_ontology:Certification .  # Assurez-vous que cette classe est correcte

        OPTIONAL { ?instance your_ontology:Certif_status ?certifStatus }
        OPTIONAL { ?instance your_ontology:date_validite_certif ?dateValidate }  # Assurez-vous que le nom de la propriété est correct
        OPTIONAL { ?instance your_ontology:nom_certif ?nomCertif }
        OPTIONAL { ?instance your_ontology:description_certif ?descriptionCertif }
        OPTIONAL { ?instance your_ontology:date_creation_certif ?dateCreation }

        FILTER (
            CONTAINS(LCASE(str(?instance)), '$searchTerm') ||
            CONTAINS(LCASE(?certifStatus), '$searchTerm') ||
            CONTAINS(LCASE(?nomCertif), '$searchTerm') ||
            CONTAINS(LCASE(?descriptionCertif), '$searchTerm') ||
            CONTAINS(LCASE(str(?dateCreation)), '$searchTerm') ||
            CONTAINS(LCASE(str(?dateValidate)), '$searchTerm')
        )
        }";

        Log::info('SPARQL Query:', ['query' => $query]);

        // Execute SPARQL query
        $results = $this->sparqlService->query($query);
        $certifications = $results['results']['bindings'] ?? [];

        Log::info('SPARQL Query Results:', ['results' => $certifications]);

        // Paginate results
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5; // Number of items per page
        $paginatedResults = new LengthAwarePaginator(
            array_slice($certifications, ($currentPage - 1) * $perPage, $perPage),
            count($certifications),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('sparql/certifications/search', ['results' => $paginatedResults]);
    }


    /////////////////////////////////////////SARRA /////////////////////////////////


    public function donComport(Request $request)
{
    $searchTerm = strtolower($request->input('search_term'));

    $query = "
    PREFIX owl: <http://www.w3.org/2002/07/owl#>
    PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
    PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
    PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

    SELECT ?instance ?statut_don ?quantité ?date_permption ?date_don ?type_aliment WHERE {
    ?instance rdf:type your_ontology:Don .

    OPTIONAL { ?instance your_ontology:statut_don ?statut_don }
    OPTIONAL { ?instance your_ontology:quantité ?quantité }
    OPTIONAL { ?instance your_ontology:date_permption ?date_permption }
    OPTIONAL { ?instance your_ontology:date_don ?date_don }
    OPTIONAL { ?instance your_ontology:type_aliment ?type_aliment }

      FILTER (
        CONTAINS(LCASE(str(?instance)), '$searchTerm') ||
        CONTAINS(LCASE(?statut_don), '$searchTerm') ||
        CONTAINS(LCASE(?quantité), '$searchTerm') ||
        CONTAINS(LCASE(?date_permption), '$searchTerm') ||
        CONTAINS(LCASE(?date_don), '$searchTerm') ||
        CONTAINS(LCASE(?type_aliment), '$searchTerm')
      )
    }
    ";

    Log::info('SPARQL Query for Don:', ['query' => $query]);

    $results = $this->sparqlService->query($query);
    $donations = $results['results']['bindings'] ?? [];

    Log::info('SPARQL Query Results for Don:', ['results' => $donations]);

    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 5;
    $paginatedResults = new LengthAwarePaginator(
        array_slice($donations, ($currentPage - 1) * $perPage, $perPage),
        count($donations),
        $perPage,
        $currentPage,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('sparql/don/search', ['results' => $paginatedResults]);
}


public function inventaireDonateur(Request $request)
{
    $searchTerm = strtolower($request->input('search_term'));

    $query = "
    PREFIX owl: <http://www.w3.org/2002/07/owl#>
    PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
    PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
    PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

    SELECT ?instance ?quantite_inventaire ?localisation ?non_article ?date_permption WHERE {
        ?instance rdf:type your_ontology:Inventaire_Donateur .

        OPTIONAL { ?instance your_ontology:quantite_inventaire ?quantite_inventaire }
        OPTIONAL { ?instance your_ontology:localisation ?localisation }
        OPTIONAL { ?instance your_ontology:non_article ?non_article }
        OPTIONAL { ?instance your_ontology:date_permption ?date_permption }

        FILTER (
            CONTAINS(LCASE(str(?instance)), '$searchTerm') ||
            CONTAINS(LCASE(?quantite_inventaire), '$searchTerm') ||
            CONTAINS(LCASE(?localisation), '$searchTerm') ||
            CONTAINS(LCASE(?non_article), '$searchTerm') ||
            CONTAINS(LCASE(str(?date_permption)), '$searchTerm')
        )
    }
    ";

    Log::info('SPARQL Query for Inventaire Donateur:', ['query' => $query]);

    $results = $this->sparqlService->query($query);
    $inventaires = $results['results']['bindings'] ?? [];

    Log::info('SPARQL Query Results for Inventaire Donateur:', ['results' => $inventaires]);

    // Paginate results
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 5;
    $paginatedResults = new LengthAwarePaginator(
        array_slice($inventaires, ($currentPage - 1) * $perPage, $perPage),
        count($inventaires),
        $perPage,
        $currentPage,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('sparql/inventaireDonateur/search', ['results' => $paginatedResults]);
}



 ///////////////////////////////////////////////////////////
 public function demandeComport(Request $request)
{
    $searchTerm = strtolower($request->input('search_term', ''));
    $statutFilter = $request->input('statut', []);

    $statuts = ['en attente', 'Complétée'];

    // Requête principale pour obtenir les demandes
    $query = "
    PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
    PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
    PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

    SELECT ?demande ?data_de_demande ?statut ?type_aliment WHERE {
        ?demande a your_ontology:Demande .
        OPTIONAL { ?demande your_ontology:data_de_demande ?data_de_demande }
        OPTIONAL { ?demande your_ontology:statut ?statut }
        OPTIONAL { ?demande your_ontology:type_aliment ?type_aliment }
    ";

    // Appliquer les filtres
    if ($searchTerm && empty($statutFilter)) {
        $query .= "
        FILTER (
            CONTAINS(LCASE(str(?demande)), '$searchTerm') ||
            CONTAINS(LCASE(?statut), '$searchTerm') ||
            CONTAINS(LCASE(str(?data_de_demande)), '$searchTerm') ||
            CONTAINS(LCASE(?type_aliment), '$searchTerm')
        )
        ";
    } elseif (!empty($statutFilter) && !$searchTerm) {
        $values = array_map(function($statut) {
            return "\"$statut\"";
        }, $statutFilter);
        $statutValues = implode(" ", $values);

        $query .= " VALUES ?statut { $statutValues }";
    } elseif ($searchTerm && !empty($statutFilter)) {
        $values = array_map(function($statut) {
            return "\"$statut\"";
        }, $statutFilter);
        $statutValues = implode(" ", $values);

        $query .= "
        FILTER (
            (CONTAINS(LCASE(str(?demande)), '$searchTerm') ||
            CONTAINS(LCASE(?statut), '$searchTerm') ||
            CONTAINS(LCASE(str(?data_de_demande)), '$searchTerm') ||
            CONTAINS(LCASE(?type_aliment), '$searchTerm'))
        ) VALUES ?statut { $statutValues }
        ";
    }

    $query .= "}";

    Log::info('SPARQL Query for Demande with Filter:', ['query' => $query]);

    $results = $this->sparqlService->query($query);
    $demandes = $results['results']['bindings'] ?? [];
    Log::info('SPARQL Query Results for Demande with Filter:', ['results' => $demandes]);

    // Calculer les statistiques des demandes
    $statistics = $this->calculateStatistics($demandes);

    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 5;
    $paginatedResults = new LengthAwarePaginator(
        array_slice($demandes, ($currentPage - 1) * $perPage, $perPage),
        count($demandes),
        $perPage,
        $currentPage,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('sparql.demandes.search', [
        'results' => $paginatedResults,
        'statuts' => $statuts,
        'statistics' => $statistics, // Passer les statistiques à la vue
    ]);
}

// Fonction pour calculer les statistiques des demandes
private function calculateStatistics($demandes)
{
    $statisticCount = [
        'total' => count($demandes),
        'en_attente' => 0,
        'complete' => 0,
    ];

    foreach ($demandes as $demande) {
        $statut = $demande['statut']['value'] ?? '';
        if ($statut === 'en attente') {
            $statisticCount['en_attente']++;
        } elseif ($statut === 'Complétée') {
            $statisticCount['complete']++;
        }
    }

    return $statisticCount;
}

public function inventaireBeneficiaire(Request $request)
{
    // Requête SPARQL pour obtenir l'inventaire des bénéficiaires, incluant les produits associés
    $query = "
    PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
    PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
    PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

    SELECT ?beneficiaire ?quantite_inventaire ?date_permption ?non_article ?location ?produit ?nom_aliment ?quantite_produit WHERE {
        ?beneficiaire rdf:type your_ontology:Inventaire_Bénéficiaire .

        OPTIONAL { ?beneficiaire your_ontology:quantite_inventaire ?quantite_inventaire }
        OPTIONAL { ?beneficiaire your_ontology:date_permption ?date_permption }
        OPTIONAL { ?beneficiaire your_ontology:non_article ?non_article }
        OPTIONAL { ?beneficiaire your_ontology:location ?location }

        OPTIONAL {
            ?beneficiaire your_ontology:contientProduit ?produit .
            ?produit your_ontology:nom_aliment ?nom_aliment .
            ?produit your_ontology:quantité_aliment ?quantite_produit .
        }
    }
    ";

    // Log de la requête SPARQL
    Log::info('SPARQL Query for Inventaire_Bénéficiaire Inventory:', ['query' => $query]);

    // Exécution de la requête SPARQL
    $results = $this->sparqlService->query($query);
    $inventaires = $results['results']['bindings'] ?? [];

    // Log des résultats
    Log::info('SPARQL Query Results for Inventaire_Bénéficiaire Inventory:', ['results' => $inventaires]);

    return view('sparql.inventairebe.index', ['inventaires' => $inventaires]);
}



    public function allUtilisateurs(Request $request)
    {
        $searchTerm = strtolower($request->input('search_term', ''));
        $roleFilter = $request->input('role', []);

        $roles = ['Donateur', 'Transporteur', 'Bénéficiaire'];

        $query = "
        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

        SELECT DISTINCT ?individual ?name ?email ?vehicle ?location (COUNT(DISTINCT ?don) AS ?donCount) WHERE {
        ?individual a ?type .
        OPTIONAL { ?individual your_ontology:nom ?name . }
        OPTIONAL { ?individual your_ontology:email ?email . }
        OPTIONAL { ?individual your_ontology:détails_véhicule ?vehicle . }
        OPTIONAL { ?individual your_ontology:location ?location . }

        OPTIONAL {
            {
                ?don your_ontology:aDonateur ?individual .  # For Donateurs
            } UNION {
                ?don your_ontology:aBeneficiaire ?individual .  # For Bénéficiaires
            }
        }
    ";

        if ($searchTerm) {
            $query .= " FILTER (
        CONTAINS(LCASE(str(?name)), '$searchTerm') ||
        CONTAINS(LCASE(str(?email)), '$searchTerm')
        )";
        }

        if (!empty($roleFilter)) {
            $roleValues = array_map(function ($role) {
                return "your_ontology:$role";
            }, $roleFilter);
            $query .= " FILTER (?type IN (" . implode(", ", $roleValues) . "))";
        }

        $query .= "
    } GROUP BY ?individual ?name ?email ?vehicle ?location
    ";

        $results = $this->sparqlService->query($query);
        $utilisateurs = $results['results']['bindings'] ?? [];

        $utilisateurs = collect($utilisateurs)->unique(function ($user) {
            return $user['individual']['value'];
        })->values()->all();

        return view('sparql.utilisateur.search', [
            'utilisateurs' => $utilisateurs,
            'selectedRoles' => $roleFilter,
            'roles' => $roles,
            'searchTerm' => $searchTerm,
        ]);
    }

    public function allPosts(Request $request)
    {
        // SPARQL query to fetch all posts
        $query = "
    PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

    SELECT ?post ?title ?contenu ?type_de_post ?creator ?creatorName WHERE {
        ?post a your_ontology:Post .
        OPTIONAL { ?post your_ontology:title ?title . }
        OPTIONAL { ?post your_ontology:contenu ?contenu . }
        OPTIONAL { ?post your_ontology:type_de_post ?type_de_post . }
        OPTIONAL { ?post your_ontology:estCrééPar ?creator . }
        OPTIONAL { ?creator your_ontology:nom ?creatorName . }
    }";



        // Execute the SPARQL query
        $results = $this->sparqlService->query($query);
        $posts = $results['results']['bindings'] ?? []; // Extract results


        // Return the results to a view without pagination
        return view('sparql.post.search', ['results' => $posts]);
    }

////////////////Event
public function searchEvents(Request $request)
{
    $searchTerm = $request->input('search');

    $query = "
    PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

    SELECT ?Event ?Event_Name ?Event_Location ?Event_Description WHERE {
      ?Event a your_ontology:Event;
        your_ontology:Event_Name ?Event_Name;
        your_ontology:Event_Location ?Event_Location;
        your_ontology:Event_Description ?Event_Description.
      FILTER (CONTAINS(LCASE(?Event_Name), LCASE('$searchTerm')) ||
              CONTAINS(LCASE(?Event_Location), LCASE('$searchTerm')))
    }";

    $results = $this->sparqlService->query($query);
    $events = $results['results']['bindings'] ?? [];

    return $this->paginateResults($request, $events, 'sparql.evenemets.index');
}
//////////
public function indexRecommendation(Request $request)
{
    // Get the search term from the request
    $searchTerm = $request->input('search');

    // Define the base SPARQL query
    $query = "
    PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>
    SELECT ?contenu ?type_Recommendation
    WHERE {
        ?recommendation a your_ontology:Recommandation.
        ?recommendation your_ontology:contenu ?contenu.
        ?recommendation your_ontology:type_Recommendation ?type_Recommendation.
        FILTER (CONTAINS(LCASE(?contenu), LCASE('$searchTerm')) ||
                CONTAINS(LCASE(?type_Recommendation), LCASE('$searchTerm')))
    }";


    // Execute the query to get results
    $results = $this->sparqlService->query($query);
    $recommendations = $results['results']['bindings'] ?? [];
    return $this->paginateResults($request, $recommendations, 'sparql.recommendation.index');
}
    /////////
    private function paginateResults(Request $request, array $results, string $view)
 {
     $currentPage = LengthAwarePaginator::resolveCurrentPage();
     $perPage = 5; // Number of items per page
     $paginatedResults = new LengthAwarePaginator(
         array_slice($results, ($currentPage - 1) * $perPage, $perPage),
         count($results),
         $perPage,
         $currentPage,
         ['path' => $request->url(), 'query' => $request->query()]
     );

     return view($view, ['results' => $paginatedResults]);

}

    //state
    public function stats()
    {
        // La requête SPARQL
        $query = "
        PREFIX owl: <http://www.w3.org/2002/07/owl#>
        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
        PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

        SELECT ?certifStatus (COUNT(?instance) AS ?count) WHERE {
          ?instance rdf:type your_ontology:Certification .
          OPTIONAL { ?instance your_ontology:Certif_status ?certifStatus }
        }
        GROUP BY ?certifStatus
        ";

        // Exécuter la requête SPARQL
        $results = $this->sparqlService->query($query);

        // Vérifiez si des résultats ont été renvoyés
        if (isset($results['results']['bindings'])) {
            $certifications = $results['results']['bindings'];
        } else {
            // Si aucun résultat n'est trouvé, retournez un tableau vide
            $certifications = [];
        }

        // Log les résultats pour le débogage
        Log::info('SPARQL Query Results:', ['results' => $certifications]);

        // Transformer les résultats pour le rendre plus facile à manipuler
        $formattedResults = [];
        foreach ($certifications as $certification) {
            $formattedResults[] = [
                'certifStatus' => $certification['certifStatus']['value'] ?? 'Non défini',
                'count' => (int) $certification['count']['value'], // Convertir en entier
            ];
        }

        // Passer les résultats formatés à la vue
        return view('sparql.certifications.stats', ['results' => $formattedResults]);
    }

//calander
// new method to display products in a calendar
public function displayProductsInCalendar(Request $request)
    {
        $query = "
        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

        SELECT ?produit ?nomAliment ?quantiteAliment ?categorieAliment ?datePeremption
        WHERE {
            ?produit rdf:type ?type .
            FILTER(?type IN (your_ontology:Produit_Alimentaire, your_ontology:Produit_Frais)) .

            OPTIONAL { ?produit your_ontology:nom_aliment ?nomAliment . }
            OPTIONAL { ?produit your_ontology:quantité_aliment ?quantiteAliment . }
            OPTIONAL { ?produit your_ontology:catégorie_aliment ?categorieAliment . }
            OPTIONAL { ?produit your_ontology:date_permption ?datePeremption . }
        }
        ORDER BY ?produit
        ";

        Log::info('Executing SPARQL Query:', ['query' => $query]);

        // Exécuter la requête SPARQL via ton service personnalisé
        $results = $this->sparqlService->query($query);
        $products = $results['results']['bindings'] ?? [];

        Log::info('SPARQL Query Results:', ['results' => $products]);

        // Réorganiser les produits par date d'expiration
        $groupedProducts = [];
        foreach ($products as $product) {
            $expiryDate = isset($product['datePeremption'])
                ? $product['datePeremption']['value']
                : 'Date inconnue';

            $groupedProducts[$expiryDate][] = [
                'nom' => $product['nomAliment']['value'] ?? 'Inconnu',
                'quantite' => $product['quantiteAliment']['value'] ?? 'N/A',
                'categorie' => $product['categorieAliment']['value'] ?? 'Non défini'
            ];
        }

        return view('sparql.produits.calender', [
            'groupedProducts' => $groupedProducts
        ]);
    }

    //Reservation

//recherche par date decroissant
public function searchReservation(Request $request)
{
    $searchTerm = strtolower($request->input('search_term'));

    // Nouvelle requête SPARQL
    $query = "
    PREFIX owl: <http://www.w3.org/2002/07/owl#>
    PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
    PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
    PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>
    PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>

    SELECT ?reservation ?statusReserv ?dateReservation ?dateDeLivraison WHERE {
       ?reservation rdf:type your_ontology:Reservation .

       OPTIONAL { ?reservation your_ontology:status_reserv ?statusReserv }
       OPTIONAL { ?reservation your_ontology:date_reservation ?dateReservation }
       OPTIONAL { ?reservation your_ontology:Date_de_livraison ?dateDeLivraison }
    }
    ORDER BY DESC(?dateReservation)
    ";

    Log::info('SPARQL Query:', ['query' => $query]);

    // Exécution de la requête SPARQL
    $results = $this->sparqlService->query($query);
    $reservations = $results['results']['bindings'] ?? [];

    Log::info('SPARQL Query Results:', ['results' => $reservations]);

    // Appliquer le filtrage basé sur le terme de recherche
    if ($searchTerm) {
        $reservations = array_filter($reservations, function ($reservation) use ($searchTerm) {
            return (
                isset($reservation['statusReserv']['value']) && stripos($reservation['statusReserv']['value'], $searchTerm) !== false ||
                isset($reservation['dateReservation']['value']) && stripos($reservation['dateReservation']['value'], $searchTerm) !== false ||
                isset($reservation['dateDeLivraison']['value']) && stripos($reservation['dateDeLivraison']['value'], $searchTerm) !== false
            );
        });
    }

    // Pagination des résultats
    $currentPage = LengthAwarePaginator::resolveCurrentPage();
    $perPage = 5; // Nombre d'éléments par page
    $paginatedResults = new LengthAwarePaginator(
        array_slice($reservations, ($currentPage - 1) * $perPage, $perPage),
        count($reservations),
        $perPage,
        $currentPage,
        ['path' => $request->url(), 'query' => $request->query()]
    );

    return view('sparql/reservation/search', ['results' => $paginatedResults]);
}

public function searchFeedback(Request $request)
{
    // Récupérer les critères de recherche
    $searchTerm = strtolower($request->input('search_term'));

    // Construction des filtres
    $filters = [];
    if ($searchTerm) {
        $filters[] = 'FILTER(CONTAINS(lcase(?contenu), "' . $searchTerm . '") || CONTAINS(lcase(?type), "' . $searchTerm . '"))';
    }

    // Construire la requête SPARQL
    $query = '
    PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
    PREFIX owl: <http://www.w3.org/2002/07/owl#>
    PREFIX ont: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>
    PREFIX xsd: <http://www.w3.org/2001/XMLSchema#>

    SELECT ?feedback ?contenu ?type ?dateFeedback
    WHERE {
        ?feedback rdf:type ont:Feedback .
        ?feedback ont:contenu_feedback ?contenu .
        ?feedback ont:type_feedback ?type .
        OPTIONAL { ?feedback ont:date_feedback ?dateFeedback }
        ' . implode(' ', $filters) . '
    }
    ORDER BY DESC(?dateFeedback)'; // Order by date descending

    Log::info('SPARQL Query:', ['query' => $query]);

    // Exécution de la requête SPARQL
    try {
        $results = $this->sparqlService->query($query);
        $feedbacks = $results['results']['bindings'] ?? [];

        Log::info('SPARQL Query Results:', ['results' => $feedbacks]);

        // Pagination des résultats
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 5; // Nombre d'éléments par page
        $paginatedResults = new LengthAwarePaginator(
            array_slice($feedbacks, ($currentPage - 1) * $perPage, $perPage),
            count($feedbacks),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Return view with paginated results
        return view('sparql.feedback.search', ['results' => $paginatedResults]);
    } catch (\Exception $e) {
        Log::error('Erreur lors de la recherche de feedbacks:', ['error' => $e->getMessage(), 'query' => $query]);
        return back()->withErrors(['message' => 'Erreur lors de la recherche de feedbacks.']);
    }
}






}
