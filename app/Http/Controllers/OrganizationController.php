<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    //
    public function getOrg(Request $request)
    {
        $org_id = $request->input('organization_id');

        $org = Organization::where('id', $org_id)
        ->get();

        return response([
            'organization' => $org[0]
        ]);
    }
}
