<?php

namespace App\Http\Controllers;

use App\Services\sparqlServiceUpdate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\SparqlService; 
class sparqlUpdateController extends Controller
{
    protected $sparqlServiceUpdate;
    protected $sparqlService;

    public function __construct(sparqlServiceUpdate $sparqlServiceUpdate,SparqlService $sparqlService)
    {
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
    

    
}
