<?php

namespace App\Models;

use App\Models\Account;
use App\Traits\HasEloquentCacheTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
 
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasEloquentCacheTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id', 'name', 'email', 'email_verified_at', 'password', 'two_factor_secret', 'two_factor_recovery_codes',
        'two_factor_confirmed_at', 'remember_token', 'current_team_id', 'profile_photo_path', 'created_at',
        'updated_at', 'role', 'cpf', 'my_nickname_for_invite', 'invted_for_user_id', 'kyc_status', 'my_invite_code', 'user_id', 'invite_code', 'group_id', 'country',
        'active', 'last_seen', 'bonus3_superiorhierarquico_user_id', 'bonus3_nivelhierarquico',
        'bonus3_percentual', 'birth_date', 'gender', 'rollover_bonus1_opcao', 'rollover_bonus1_multiplicador', 'rollover_bonus1_valorObjetivo',
        'rollover_bonus1_atingiu_valorObjetivo', 'fungamess_user_blocked'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class, 'users_id', 'id');
    }

    public function group(): HasOne
    {
        return $this->hasOne(Group::class, 'id', 'group_id');
    }

    public function transactions()
    {
        return $this->hasManyThrough(
            Transaction::class,
            Account::class,
            'users_id', // Foreign key on the types table...
            'accounts_id', // Foreign key on the items table...
            'id', // Local key on the users table...
            'id' // Local key on the categories table...
        );
    }

    public function tokenAccounts()
    {
        return $this->hasManyThrough(
            TokenAccount::class,
            Account::class,
            'users_id', // Foreign key on the types table...
            'accounts_id', // Foreign key on the items table...
            'id', // Local key on the users table...
            'id' // Local key on the categories table...
        );
    }

    public function bets()
    {
        return $this->hasManyThrough(
            Bet::class,
            Account::class,
            'users_id', // Foreign key on the types table...
            'accounts_id', // Foreign key on the items table...
            'id', // Local key on the users table...
            'id' // Local key on the categories table...
        );
    }


    public function fungamessGameGains()
    {
        return $this->hasManyThrough(
            FungamessGameGains::class,
            Account::class,
            'users_id', // Foreign key on the types table...
            'accounts_id', // Foreign key on the items table...
            'id', // Local key on the users table...
            'id' // Local key on the categories table...
        );
    }

    public function getFirstDeposit()
    {
        return $this->transactions()->completedDeposits()->first();
    }

    public function qntdWithdrawalToday()
    {

    }

    public function parent(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function childrens(): HasMany
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }

    public function hasRollOverOption()
    {
        $group = $this->group()->first();
        if (isset($group['id']) && $group['bonus1_status'] == 'active') {
            $completeDeposit = $this->getFirstDeposit();
            return !isset($completeDeposit['id']);

        }
        return false;


    }


    public function hasSelectedAccount()
    {
        $account_id = getAccountIdSession();
        return !empty($account_id);
    }

    /**
     * Route notifications for the mail channel.
     *
     * @return  array<string, string>|string
     */
    public function routeNotificationForMail(Notification $notification)
    {
        // Return email address and name...
        return [$this->email];
    }

    public function isAdmin()
    {
        if ($this->role == 'admin') {
            return true;
        }
        return false;
    }

    public function qtyCashoutToday()
    {
        return $this->transactions()->isCashOut()->isPendingOrPaidCashout()->isToday()->count();
    }

    public function qtyCompletedCashout()
    {
        return $this->transactions()->isCashOut()->isPaidCashout()->count();
    }

    public function updateLastSeen()
    {
        $this->update(['last_seen' => (new \DateTime())->format("Y-m-d H:i:s")]);
    }

    public function kycValidation(): HasOne
    {
        return $this->hasOne(KycValidation::class, 'user_id', 'id');
    }

    public function canUploadKycDocs(): bool
    {
        return $this->kyc_status == 'not_verified' || $this->kyc_status == 'failed_verification';
    }

    public function getBonus3FormatedPercent()
    {
        $p = (float)$this->bonus3_percentual;
        return safeDiv($p, 100);
    }

    public function getChildrensIds()
    {
        return $this->childrens()->select("id")->get()->pluck('id');
    }

    public function getAffAccountsIds()
    {
        $afiliados = $this->getChildrensIds();
        return Account::whereIn("users_id", $afiliados)->select("id")->get()->pluck('id');
    }

    public function getDepositsQty()
    {
        return $this->transactions()->completedDeposits()->count();
    }

    public function invites()
    {
        //'invite_code', '=', $user->my_invite_code
        return $this->childrens();
    }


    public function getSessionFirstAccountId()
    {
        $key = "first_account_id_" . $this->id;
        if (session()->has($key)) {
            return session()->get($key);
        } else {
            $firstAccountId = Account::where('users_id', $this->id)->min('id');
            session()->put($key, $firstAccountId);
            return $firstAccountId;
        }
    }

    public function hasFirstDeposit()
    {
        $qty = $this->getDepositsQty();
        if ($qty > 0) {
            return true;
        }
        return false;
    }

    public function hasCashout()
    {
        $qty = $this->qtyCompletedCashout();
        if ($qty > 0) {
            return true;
        }
        return false;
    }

    public function getTotalDeposit()
    {
        $qty = $this->qtyCompletedCashout();
        if ($qty > 0) {
            return true;
        }
        return false;
    }

    public function hasEspecialBonus3Group()
    {
        $especialGroups = ['master', 'supervisor', 'gerente', 'subgerente'];
        return in_array($this->bonus3_nivelhierarquico, $especialGroups);

    }

    public function canManageBonus3Group()
    {
        $groups = ['master', 'supervisor', 'gerente'];
        return in_array($this->bonus3_nivelhierarquico, $groups);
    }

    public static function withAccountsJoin()
    {
        $select = ["users.*",
            'accounts.id as account_id',
            'accounts.photo'
        ];

        return User::select($select)->join('accounts', 'users.id', '=', 'accounts.users_id');
    }

    public function invitesWithAccounts()
    {
        return self::withAccountsJoin()->where("users.user_id", $this->id);
    }

}
