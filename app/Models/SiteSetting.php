<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends BaseModel
{
    use HasFactory;

    public static $keys = [

        "school_name" => [
            "type" => "text",
            "element" => "text",
            "visible" => 1,
            "display_text" => "School Name"
        ],



        "facebook_link" => [
            "type" => "text",
            "element" => "text",
            "visible" => 1,
            "display_text" => "Facebook Link"
        ],

        "twitter_link" => [
            "type" => "text",
            "element" => "text",
            "visible" => 1,
            "display_text" => "Twitter Link"
        ],

        "youtube_link" => [
            "type" => "text",
            "element" => "text",
            "visible" => 1,
            "display_text" => "Youtube Link"
        ],
        "instagram_link" => [
            "type" => "text",
            "element" => "text",
            "visible" => 1,
            "display_text" => "Instagram Link"
        ],

        "email" => [
            "type" => "text",
            "element" => "text",
            "visible" => 1,
            "display_text" => "Email"
        ],

        "phone_no" => [
            "type" => "text",
            "element" => "text",
            "visible" => 1,
            "display_text" => "Phone Number"
        ],

        "address" => [
            "type" => "text",
            "element" => "text",
            "visible" => 1,
            "display_text" => "Address"
        ],


    ];
}