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

}

