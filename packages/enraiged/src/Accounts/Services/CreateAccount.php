<?php

namespace Enraiged\Accounts\Services;

use App\Auth\User;
use Enraiged\Accounts\Events\AccountCreated;
use Enraiged\Profiles\Models\Profile;
use Illuminate\Support\Facades\DB;

class CreateAccount
{
    use Traits\LoadParameters,
        Traits\ModelAttributes;

    /** @var  object  The Account model. */
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
        $this->load($parameters);
    }

    /**
     *  Create User,Profile records and return the associated Account.
     *
     *  @return self
     */
    public function handle()
    {
        $user = DB::transaction(function () {
            $profile = Profile::create(
                collect($this->parameters)
                    ->only($this->getProfileAttributes())
                    ->toArray()
            );

            $user = User::create(
                collect($this->parameters)
                    ->only($this->getAccountAttributes())
                    ->merge(['profile_id' => $profile->id])
                    ->toArray()
            );

            return $user;
        });

        $this->account = $user->account;
        $this->account->load('profile');

        event(new AccountCreated($this->account));

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
