<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Student extends BaseModel implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }


    // public function payments()
    // {
    //     return $this->hasMany(MonthlyFeesPayment::class);
    // }

    // public function calculateDuesNepali()
    // {
    //     $currentNepaliDate = Convert::toNepali(now());
    //     $currentNepaliYear = $currentNepaliDate->year;
    //     $currentNepaliMonth = $currentNepaliDate->month;

    //     // Assuming student has a registration date in Nepali calendar stored as `registration_date_nepali`
    //     $registrationNepaliDate = Convert::toGregorian($this->registration_date_nepali);
    //     $totalMonths = (($currentNepaliYear - $registrationNepaliDate->year) * 12) + $currentNepaliMonth - $registrationNepaliDate->month + 1;

    //     // Total fee that should have been paid till now
    //     $totalFeeDue = $totalMonths * $this->monthly_fee;

    //     // Total amount paid by the student till now
    //     $totalPaid = $this->payments()->sum('amount');

    //     // Calculate the dues
    //     $dues = $totalFeeDue - $totalPaid;

    //     return $dues;
    // }
}