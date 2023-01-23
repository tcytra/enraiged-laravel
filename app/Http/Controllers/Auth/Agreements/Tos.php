<?php

namespace App\Http\Controllers\Auth\Agreements;

use App\Http\Controllers\Controller;
use Enraiged\Agreements\Enums\AgreementType;
use Enraiged\Agreements\Models\Agreement;
use Enraiged\Agreements\Resources\AgreementResource;
use Illuminate\Http\Request;

class Tos extends Controller
{
    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $agreement_type = AgreementType::TOS;
        $current_agreement = Agreement::current($agreement_type);

        if (!$current_agreement) {
            abort(404);
        }

        return inertia('auth/Agreement', [
            'agreement' => AgreementResource::from($current_agreement),
        ]);
    }
}
