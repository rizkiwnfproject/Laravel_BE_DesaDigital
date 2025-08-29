<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialAssistanceRecipient extends Model
{
    use SoftDeletes, UUID, HasFactory;
    protected $fillable = [
        'social_assistance_id',
        'head_of_family_id',
        'amount',
        'reason',
        'bank',
        'account_number',
        'proof',
        'status',
    ];

    public function scopeSearch($query, $search)
    {
        // memiliki headOfFamily
        return $query->where('account_number', 'like', '%' . $search . '%')
            ->orWhere('bank', 'like', '%' . $search . '%')
            ->orWhereHas('headOfFamily', function ($query) use ($search) {
                // memiliki user
                $query->whereHas('user', function ($query) use ($search) {
                    // filterUser
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            });
    }

    public function socialAssistance()
    {
        return $this->belongsTo(SocialAssistance::class);
    }
    public function headOfFamily()
    {
        return $this->belongsTo(HeadOfFamily::class);
    }
}
