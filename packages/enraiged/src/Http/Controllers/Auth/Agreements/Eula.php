<?php

namespace Enraiged\Http\Controllers\Auth\Agreements;

use Enraiged\Agreements\Enums\AgreementType;
use Enraiged\Agreements\Models\Agreement;
use Enraiged\Agreements\Resources\AgreementResource;
use Enraiged\Http\Controllers\Auth\Controller;
use Illuminate\Http\Request;

class Eula extends Controller
{
    /**
     *  @param  \Illuminate\Http\Request  $request
     *  @return \Inertia\Response
     */
    public function __invoke(Request $request)
    {
        $agreement_type = AgreementType::EULA;
        $current_agreement = Agreement::current($agreement_type);

        if (!$current_agreement) {
            abort(404);
        }

        return inertia('auth/Agreement', [
            'agreement' => AgreementResource::from($current_agreement),
        ]);
    }
}
