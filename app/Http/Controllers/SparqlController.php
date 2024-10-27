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
    // Requête SPARQL pour récupérer les produits avec leur date de péremption
    $query = "
    PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
    PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
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

    // Log the SPARQL query for debugging
    Log::info('Executing SPARQL Query for products:', ['query' => $query]);

    // Execute the SPARQL query
    $results = $this->sparqlService->query($query);
    $products = $results['results']['bindings'] ?? [];

    // Log the results for debugging
    Log::info('SPARQL Query Results:', ['results' => $products]);

    // Format the results for display
    $formattedProducts = [];
    foreach ($products as $product) {
        $expiryDate = isset($product['datePeremption']) ? new \DateTime($product['datePeremption']['value']) : null;
        if ($expiryDate) {
            $formattedProducts[] = [
                'produit' => $product['produit']['value'],
                'nomAliment' => $product['nomAliment']['value'] ?? 'Inconnu',
                'quantiteAliment' => $product['quantiteAliment']['value'] ?? 'N/A',
                'categorieAliment' => $product['categorieAliment']['value'] ?? 'Non défini',
                'expiryDate' => $expiryDate,
            ];
        }
    }

    return view('sparql.produits.calender', ['products' => $formattedProducts]);
}




}