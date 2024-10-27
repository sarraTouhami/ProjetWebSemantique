<?php

namespace App\Http\Controllers;

use App\Services\SparqlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import the Log facade
use Illuminate\Pagination\LengthAwarePaginator;
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
}
";

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
public function demandeComport(Request $request)
{
    $searchTerm = strtolower($request->input('search_term', ''));
    $statutFilter = $request->input('statut', []);
    
    $statuts = ['en attente', 'Complétée'];

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

    // Applique le filtre de recherche par mot-clé si un terme est fourni
    if ($searchTerm && empty($statutFilter)) {
        $query .= "
        FILTER (
            CONTAINS(LCASE(str(?demande)), '$searchTerm') ||
            CONTAINS(LCASE(?statut), '$searchTerm') ||
            CONTAINS(LCASE(str(?data_de_demande)), '$searchTerm') ||
            CONTAINS(LCASE(?type_aliment), '$searchTerm')
        )
        ";
    }
    // Applique le filtre de statut uniquement si des statuts sont sélectionnés
    elseif (!empty($statutFilter) && !$searchTerm) {
        $values = array_map(function($statut) {
            return "\"$statut\"";
        }, $statutFilter);
        $statutValues = implode(" ", $values);
        
        $query .= " VALUES ?statut { $statutValues }";
    }
    // Applique les deux filtres uniquement si les deux critères sont fournis
    elseif ($searchTerm && !empty($statutFilter)) {
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
        'statuts' => $statuts
    ]);
}

public function inventaireBeneficiaire(Request $request)
{
    // Requête SPARQL pour obtenir l'inventaire des bénéficiaires
    $query = "
    PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
    PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
    PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

    SELECT ?beneficiaire ?quantite_inventaire ?date_permption ?non_article ?location WHERE {
        ?beneficiaire rdf:type your_ontology:Inventaire_Bénéficiaire .
        OPTIONAL { ?beneficiaire your_ontology:quantite_inventaire ?quantite_inventaire }
        OPTIONAL { ?beneficiaire your_ontology:date_permption ?date_permption }
        OPTIONAL { ?beneficiaire your_ontology:non_article ?non_article }
        OPTIONAL { ?beneficiaire your_ontology:location ?location }
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
public function store(Request $request)
{
    $nomArticle = $request->input('nom_article');
    $quantiteInventaire = $request->input('quantite_inventaire');
    $datePeremption = $request->input('date_peremption');
    $location = $request->input('location');

    // SPARQL query to insert a new article
    $query = "
    PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
    PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
    PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

    INSERT DATA {
        _:newBeneficiaire a your_ontology:Beneficiaire ;
            your_ontology:nom_article '$nomArticle' ;
            your_ontology:quantite_inventaire '$quantiteInventaire' ;
            your_ontology:date_peremption '$datePeremption' ;
            your_ontology:location '$location' .
    }
    ";

    Log::info('SPARQL Insert Query for Beneficiary Inventory:', ['query' => $query]);

    // Execute the SPARQL query
    try {
        $this->sparqlService->query($query);
        return redirect()->route('inventaire.index')->with('success', 'Article ajouté avec succès!');
    } catch (\Exception $e) {
        Log::error('Error executing SPARQL Insert Query:', ['error' => $e->getMessage()]);
        return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'ajout de l\'article.');
    }
}
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
    
}
