<?php

namespace Enraiged\Accounts\Services;

use App\Auth\User;
use Enraiged\Profiles\Models\Profile;
use Illuminate\Support\Facades\DB;

class CreateAccount
{
    /** @var  object  The created Account. */
    protected $account;

    /** @var  array  The provided parameters. */
    protected $parameters;

    /**
     *  Create an instance of the CreateAccount service.
     *
     *  @param  array   $parameters
     *  @return void
     */
    public function __construct(array $parameters)
    {
        if (key_exists('name', $parameters)) {
            $names = explode(' ', $parameters['name']);

            $parameters['first_name'] = array_shift($names);
            $parameters['last_name'] = count($names) ? implode($names) : null;

            unset($parameters['name']);
        }

        $this->parameters = $parameters;
    }

    /**
     *  Create a User + Profile and return the associated Account.
     *
     *  @return $this
     */
    public function handle()
    {
        $user = DB::transaction(function () {
            $profile = Profile::create(
                collect($this->parameters)
                    ->only(\Enraiged\Profiles\Collections\Attributes::$fillable)
                    ->toArray()
            );

            $user = User::create(
                collect($this->parameters)
                    ->only(\Enraiged\Accounts\Collections\Attributes::$fillable)
                    ->merge(['profile_id' => $profile->id])
                    ->toArray()
            );

            return $user;
        });

        $this->account = $user->account;
        $this->account->load('profile');

        return $this;
    }

    /**
     *  Create and return an Account from provided parameters.
     *
     *  @param  array   $parameters
     *  @return \Enraiged\Accounts\Models\Account
     */
    public static function From($parameters)
    {
        $builder = (new self($parameters))->handle();

        return $builder->account;
    }
}
