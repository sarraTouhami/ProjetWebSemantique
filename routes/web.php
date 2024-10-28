<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventaireBeneficiaireController;
use App\Http\Controllers\ProduitAlimentaireController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DonController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InventaireDonateurController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DemandeAdminController;
use App\Http\Controllers\Admin\EventAdminController;
use App\Http\Controllers\Admin\RecommendationAdminController;
use App\Http\Controllers\Admin\ProduitAdminController;
use App\Http\Controllers\Admin\DonAdminController;
use App\Http\Controllers\Admin\ReservationAdminController;
use App\Http\Controllers\Admin\FeedbackAdminController;
/**** */

use App\Http\Controllers\SparqlController;
use App\Http\Controllers\sparqlUpdateController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resource('posts', PostController::class);
Route::resource('demandes', DemandeController::class);
Route::resource('inventaires-beneficiaires', InventaireBeneficiaireController::class);
Route::resource('reservations', ReservationController::class);
Route::resource('notifications', NotificationController::class);
Route::resource('recommendations', RecommendationController::class);
Route::resource('events', EventController::class);
Route::resource('feedbacks', FeedbackController::class);
Route::resource('Dons', DonController::class);
Route::resource('invertaireDonateurs', InventaireDonateurController::class);


Route::get('/', function () {
    return view('welcome');
});
// Route::get('/demandes', function () {

//     return view('demandes/index');
// });
Route::get('/hi', function () {

    return view('hi');
});

Route::get('/test', function () {

    return view('test');
});
Route::resource('produitAlimentaire', ProduitAlimentaireController::class)->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('/mesProduits', [ProduitAlimentaireController::class, 'mesProduits'])
         ->name('produitAlimentaire.mesProduits');
});

Route::resource('certifications', CertificationController::class);

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // User resource route
    Route::resource('users', UserController::class);

    // Demande resource route
    Route::resource('demandes', DemandeAdminController::class);
    Route::resource('events', EventAdminController::class);
    Route::resource('recommendations', RecommendationAdminController::class);

    Route::resource('produits', ProduitAdminController::class);
    Route::resource('dons', DonAdminController::class);

    // Reservation resource route
    Route::resource('reservations', ReservationAdminController::class);

    // Feedback resource route
    Route::resource('feedbacks', FeedbackAdminController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('posts.like');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

/*** */


Route::get('/sparql/test', [SparqlController::class, 'index']);
Route::get('/certification/search', [SparqlController::class, 'certificationComport'])->name('certification.search');
Route::get('/produit/calender', [SparqlController::class, 'displayProductsInCalendar'])->name('produit.calender');
Route::get('/certification/stats', [SparqlController::class, 'stats'])->name('certification.stats');




Route::get('/demande/search', [SparqlController::class, 'demandeComport'])->name('demande.search');
Route::get('/utilisateurs/search', [SparqlController::class, 'allUtilisateurs'])->name('utilisateur.search');
Route::delete('/utilisateurs/delete', [sparqlUpdateController::class, 'deleteUser'])->name('utilisateur.delete');
Route::get('/donateurs/search', [SparqlController::class, 'allDonateurs'])->name('donateur.index');
Route::get('/evenemets/search', [SparqlController::class, 'searchEvents'])->name('evenemets.index');
Route::get('/Recommendation/search', [SparqlController::class, 'indexRecommendation'])->name('recommendation.index');



Route::get('/donations/search', [SparqlController::class, 'donComport'])->name('don.search');
Route::get('/donations/create', [sparqlUpdateController::class, 'create'])->name('don.create');
Route::post('/donations/store', [sparqlUpdateController::class, 'store'])->name('don.store');
Route::post('/donations/delete', [sparqlUpdateController::class, 'delete'])->name('don.delete');
Route::get('/posts/create', [sparqlUpdateController::class, 'createPost'])->name('post.create');
Route::get('/posts', [SparqlController::class, 'allPosts'])->name('posts.all');
Route::post('/posts/store', [sparqlUpdateController::class, 'storePost'])->name('post.store');

Route::get('/inventaireDonateur/search', [SparqlController::class, 'inventaireDonateur'])->name('inventaireDonateur.search');
Route::post('/inventaireDonateur/delete', [sparqlUpdateController::class, 'deleteInventory'])->name('inventaireDonateur.delete');
Route::get('/evenemets/create', [sparqlUpdateController::class, 'createEvent'])->name('evenemets.create');
Route::post('/evenemets/store', [sparqlUpdateController::class, 'storeEvent'])->name('evenemets.store');
Route::get('/Recommendation/create', [sparqlUpdateController::class, 'createRecommendation'])->name('recommendation.create');
Route::post('/Recommendation/store', [sparqlUpdateController::class, 'storeRecommendation'])->name('recommendation.store');
Route::get('/demande/search', [SparqlController::class, 'demandeComport'])->name('demande.search');
Route::get('/inventairebe/list', [SparqlController::class, 'inventaireBeneficiaire'])->name('inventairebe.index');
Route::get('/inventairebe/create', [SparqlUpdateController::class, 'createinventaireb'])->name('inventairebe.create'); // Ajoutez cette route
Route::post('/inventairebe/store', [SparqlUpdateController::class, 'storeinventaireb'])->name('inventairebe.store');


Route::get('/produit/create', [sparqlUpdateController::class, 'createProduct'])->name('produit.create');
Route::post('/produit/store', [sparqlUpdateController::class, 'storeProduct'])->name('produit.store');
Route::get('/donations/create', [sparqlUpdateController::class, 'create'])->name('don.create');
Route::post('/donations/store', [sparqlUpdateController::class, 'store'])->name('don.store');
Route::get('/reservation/search', [SparqlController::class, 'searchReservation'])->name('reservation.search');
Route::get('/reservation/add', [sparqlUpdateController::class, 'add'])->name('reservation.add');
Route::post('/reservation/addReserv', [sparqlUpdateController::class, 'addReserv'])->name('reservation.addReserv');
Route::get('/feedback/search', [SparqlController::class, 'searchFeedback'])->name('feedback.search');

;



