<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TreeController;
use Illuminate\Support\Facades\Storage;
Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




use App\Models\Tree;
Route::get('/tree/{slug}/qr/download', function ($slug) {
    $tree = Tree::where('slug', $slug)->firstOrFail();

    // Ensure QR code exists before attempting to download
    if ($tree->qr_code && Storage::disk('public')->exists($tree->qr_code)) {
        return response()->download(Storage::disk('public')->path($tree->qr_code));
    }

    // If QR code does not exist, you can return an error or a fallback
    return response()->json(['error' => 'QR code not available'], 404);
})->name('tree.qr.download');

Route::get('/tree/{slug}', function ($slug) {
    $tree = Tree::where('slug', $slug)->firstOrFail();
    return view('tree.show', compact('tree'));
})->name('tree.show');

Route::get('/trees/{slug}', [TreeController::class, 'show'])->name('tree.view');

require __DIR__.'/auth.php';
