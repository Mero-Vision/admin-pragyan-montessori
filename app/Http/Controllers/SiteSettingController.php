<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiteSettingCreateRequest;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteSettingController extends Controller
{
    public function store(SiteSettingCreateRequest $request)

    {

        try {

            DB::transaction(function () use ($request) {

                foreach (SiteSetting::$keys as $key => $data) {
                    if (!isset($request->$key))
                        continue;
                    $value = (($data["type"] == "image") ? $request->file($key) : $request->get($key));
                    if (!$value) {
                        if ($data["type"] != "image")
                        SiteSetting::where('key', $key)->delete();
                        continue;
                    }
                    $site_setting = SiteSetting::updateOrCreate([
                        "key" => $key,
                    ], [
                        "value" => $data["type"] == "text" ? $value : (($data["type"] == "array") ? json_encode($value) : null),
                        "type" => $data["type"]
                    ]);
                    if ($data["type"] == "image") {
                        $site_setting->clearMediaCollection();
                        $site_setting->addMedia($request->file($key))->toMediaCollection();
                    }
                }
            });
            sweetalert()->addSuccess("Setting data updated successfully!");
            return back();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}