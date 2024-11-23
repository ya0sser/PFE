<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\UserEventController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\{CalendarController, ProfileController, EventController, Auth\RegisteredUserController, commentsController};
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\Admin\AdminMachineController;

// Public Routes
Route::get('/', [EventController::class, 'landing'])->name('landing');
Route::get('/pathway/{id}', [EventController::class, 'show'])->name('events.show');
Route::post('/subscribe/{eventId}', [EventController::class, 'subscribe'])->name('events.subscribe');
Route::get('/payment/{eventId}', [EventController::class, 'payment'])->name('components.payment');
Route::post('/payment/{eventId}', [EventController::class, 'processPayment'])->name('components.payment.process');
Route::get('/redirect-to-register', [EventController::class, 'redirectToRegister'])->name('redirect.register');

// Authentication Routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.post');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/register', [RegisteredUserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'register'])->name('register.post');

// Admin Login Routes
Route::get('/admin/login', [AuthenticatedSessionController::class, 'createAdmin'])->name('admin.login');
Route::post('/admin/login', [AuthenticatedSessionController::class, 'adminStore'])->name('admin.login.post');

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Routes for managing customers
    Route::get('/admin/customers', [UserController::class, 'index'])->name('admin.customers.index');
    Route::get('/admin/customers/{user}/edit', [UserController::class, 'edit'])->name('admin.customers.edit');
    Route::put('/admin/customers/{user}', [UserController::class, 'update'])->name('admin.customers.update');
    Route::delete('/admin/customers/{user}', [UserController::class, 'destroy'])->name('admin.customers.destroy');
    Route::delete('/admin/customers/mass-delete', [UserController::class, 'massDelete'])->name('admin.customers.massDelete');
    Route::put('/admin/customers/mass-update', [UserController::class, 'massUpdate'])->name('admin.customers.massUpdate');
    Route::post('/admin/customers', [UserController::class, 'store'])->name('admin.customers.store');

    
    Route::get('events-admin', [AdminEventController::class, 'index'])->name('event-admin.index');
    Route::get('events-admin/create', [AdminEventController::class, 'create'])->name('event-admin.create');
    Route::post('events-admin', [AdminEventController::class, 'store'])->name('event-admin.store');
    Route::get('events-admin/{event}/edit', [AdminEventController::class, 'edit'])->name('event-admin.edit');
    Route::put('events-admin/{event}', [AdminEventController::class, 'update'])->name('event-admin.update');
    Route::delete('events-admin/{event}', [AdminEventController::class, 'destroy'])->name('event-admin.destroy');
    Route::get('events-admin/{event}', [AdminEventController::class, 'show'])->name('event-admin.show');
    Route::get('events-admin/detail/{id}', [AdminEventController::class, 'detail'])->name('event-admin.detail');

    Route::get('/user-event', [UserEventController::class, 'index'])->name('user-event.index');
    Route::post('/user-event', [UserEventController::class, 'store'])->name('user-event.store');
    Route::delete('/user-event/{userId}/{eventId}', [UserEventController::class, 'destroy'])->name('user-event.destroy');
    Route::get('/user-event/{userId}/{eventId}', [UserEventController::class, 'show'])->name('user-event.detail');
    Route::delete('/user-event/guest/{guestSubscriptionId}', [UserEventController::class, 'destroyGuest'])->name('user-event.destroyGuest');


    Route::get('/admin/comments', [commentsController::class, 'index'])->name('admin.comments.index');
    Route::delete('/admin/comments/{comment}', [commentsController::class, 'destroy'])->name('admin.comments.destroy');
    Route::get('/admin/user-event/downloadPdf', [UserEventController::class, 'downloadPdf'])->name('user-event.downloadPdf');
    Route::put('/events-admin/update-max-subscribers/{id}', [AdminEventController::class, 'updateMaxSubscribers'])->name('event-admin.updateMaxSubscribers');

    Route::view('/admin/askus', 'adminDashboard.Askus')->name('admin.askus');
    // Route::get('/machines', [MachineController::class, 'index'])->name('machines.index');
    // Route::get('/admin/machines', [AdminMachineController::class, 'index'])->name('admin.machines.index');
    // Route::post('/admin/machines', [AdminMachineController::class, 'store'])->name('admin.machines.store');
    // Route::delete('/admin/machines/{machine}', [AdminMachineController::class, 'destroy'])->name('admin.machines.destroy');
});

Route::delete('/events/{eventId}/unsubscribe', [EventController::class, 'unsubscribe'])->name('events.unsubscribe');

Route::middleware('guest')->group(function () {
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});


// Other public routes
Route::get('/comments/create', [commentsController::class, 'create'])->name('comments.create');
Route::post('/comments', [commentsController::class, 'store'])->name('comments.store');
Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.view');
Route::get('/api/events', [EventController::class, 'getEvents']);
Route::get('/askus', function () { return view('components.askus'); });
Route::get('/forgot-password', function () { return view('auth.forgot-password'); });
Route::get('/subscribe/{eventId}/after-login', [EventController::class, 'handleSubscription'])->name('subscribe.after.login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::get('/user-event/download', [UserEventController::class, 'downloadCsv'])->name('user-event.download');
Route::get('/user-event/download-csv', [UserEventController::class, 'downloadCsv'])->name('user-event.downloadCsv');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::middleware('web')->group(function () {
    Auth::routes(['verify' => true]);
});
// Route::get('/machines', [MachineController::class, 'index'])->name('machines.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/machine', function () { return view('pages.machine'); });
Route::put('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');


Route::get('/contact', function () { return view('pages.contact'); });


Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');



Route::get('/subscribe-guest/{eventId}', [EventController::class, 'showGuestSubscribeForm'])->name('subscribe.guest');
Route::post('/subscribe-guest/{eventId}', [EventController::class, 'subscribeGuest'])->name('subscribe.guest.submit');

require __DIR__.'/auth.php';