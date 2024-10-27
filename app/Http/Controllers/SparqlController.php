<?php

namespace App\Http\Controllers;

use App\Services\SparqlService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import the Log facade

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
      // New method for certification search
      public function certificationComport(Request $request)
      {
          // Get search term from request, you can also validate or sanitize this input
          $searchTerm = $request->input('search_term'); // Change 'search_term' to your actual input field name
  
          // Prepare the SPARQL query
          $query = '
          PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
          PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
          PREFIX your_ontology: <http://www.semanticweb.org/user/ontologies/2024/8/untitled-ontology-8#>
  
          SELECT ?certification ?label ?description ?date_creation ?date_validite WHERE {
              ?certification a your_ontology:Certification .
              OPTIONAL { ?certification rdfs:label ?label }
              OPTIONAL { ?certification your_ontology:description_certif ?description }
              OPTIONAL { ?certification your_ontology:date_creation_certif ?date_creation }
              OPTIONAL { ?certification your_ontology:date_validite_certif ?date_validite }
              FILTER (CONTAINS(LCASE(?label), LCASE("'.$searchTerm.'")))  # Case insensitive search
          }
          ';
  
          // Log the SPARQL query for debugging
          Log::info('Executing SPARQL Certification Query:', ['query' => $query]);
  
          // Execute the SPARQL query
          $results = $this->sparqlService->query($query);
  
          // Log the results or any errors for debugging
          Log::info('SPARQL Certification Query Results:', ['results' => $results]);
  
          // Return the results to a view or as JSON
         // return response()->json($results);
          return view('sparql/certifications/search', ['results' => $results]);
      }
}
