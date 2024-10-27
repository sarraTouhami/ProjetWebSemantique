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
        PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
        PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
        PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>

        SELECT ?certification ?label ?description ?date_creation ?date_validite WHERE {
            ?certification a your_ontology:Certification .
            OPTIONAL { ?certification rdfs:label ?label }
            OPTIONAL { ?certification your_ontology:description_certif ?description }
            OPTIONAL { ?certification your_ontology:date_creation_certif ?date_creation }
            OPTIONAL { ?certification your_ontology:date_validite_certif ?date_validite }

            FILTER (
                CONTAINS(LCASE(str(?certification)), '$searchTerm') ||
                CONTAINS(LCASE(?label), '$searchTerm') ||
                CONTAINS(LCASE(?description), '$searchTerm') ||
                CONTAINS(LCASE(str(?date_creation)), '$searchTerm') ||
                CONTAINS(LCASE(str(?date_validite)), '$searchTerm')
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
}


