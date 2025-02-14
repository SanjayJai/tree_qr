<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class Tree extends Model
{
    use HasFactory;

    protected $fillable = [
        'common_name', 'family_name', 'species_name', 'location',
        'tree_uses', 'distribution', 'other_information',
        'tree_image', 'qr_code', 'slug'
    ];

    protected static function booted()
    {
        static::creating(function ($tree) {
            // Generate a slug if not provided
            $tree->slug = Str::slug($tree->common_name . '-' . Str::random(5));

            // Generate QR Code
            $qrCodePath = 'qrcodes/tree_' . uniqid() . '.png';
            Storage::disk('public')->put($qrCodePath, QrCode::format('png')->size(200)->generate(route('tree.show', $tree->slug)));
            $tree->qr_code = $qrCodePath;
        });

        static::updating(function ($tree) {
            // If slug is changed, regenerate QR code
            if ($tree->isDirty('slug') || $tree->isDirty('common_name')) {
                $qrCodePath = 'qrcodes/tree_' . uniqid() . '.png';
                Storage::disk('public')->put($qrCodePath, QrCode::format('png')->size(200)->generate(route('tree.show', $tree->slug)));
                $tree->qr_code = $qrCodePath;
            }
        });
    }
}