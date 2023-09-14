<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Livewire\Component;
use Carbon\Carbon;
use Cache;

use App\Models\User;


class Index extends Component
{
    public $total_users = 0;
    public $total_verified_users = 0;

    public $total_users_made_deposit = 0;
    public $conversion_registration_vs_deposit = '0%';

    public $total_registered_users_today = 0;
    public $total_registered_users_yesterday = 0;

    public $total_online_now = 0;

    public $users_country;
    public $users_country_name = [];
    public $users_country_total = [];

    public $total_users_month_year = '';

    public function mount()
    {
        $this->total_users = User::where([['role', '=',  'player']])->count();
        $this->total_verified_users = User::where([['role', '=',  'player'], ['kyc_status', '=',  'verified']])->count();

        $this->total_users_made_deposit = $this->totalUsersMadeDeposit();
        $this->conversion_registration_vs_deposit = $this->conversionRegistrationDeposit();

        $today = (new \DateTime(date('Y-m-d')))->format('Y-m-d');
        $yesterday = (new \DateTime(date('Y-m-d')))->modify('-1 day')->format('Y-m-d');

        $this->total_registered_users_today = User::where([['created_at', '>=', $today]])->count();
        $this->total_registered_users_yesterday = User::where([['created_at', '<', $today], ['created_at', '>=', $yesterday]])->count();

        $this->total_online_now = $this->totalOnlineNow();

        $this->total_users_month_year = $this->totalUsersPerMonthYear();

        $this->users_country = $this->usersCountry();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.index');
    }

    private function totalOnlineNow()
    {
        $users = User::all();

        $total = 0;
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id)) {
                $total += 1;
            }
        }

        return $total;
    }

    private function totalUsersPerMonthYear()
    {
        $users = \DB::select("SELECT SUBSTRING(REPLACE(created_at, '-', ''), 1, 6) AS month_year, count(*) as total FROM users where role = 'player' group by month_year order by month_year asc;");

        $data = [];
        for ($i = 1; $i <= 12; $i++) {
            $monthYear = date('Y') . str_pad($i, 2, 0, STR_PAD_LEFT);
            $data[$monthYear] = 0;
        }

        foreach ($users as $key => $item) {
            $data[$item->month_year] = $item->total;
        }

        $data = implode(',', $data);

        return $data;
    }

    private function totalUsersMadeDeposit()
    {
        $users = \DB::select("SELECT count(*) as total
                                from transactions t
                                left join accounts a on a.id = t.accounts_id
                                left join users u on u.id = a.users_id
                                group by u.id
                                HAVING COUNT(u.id) > 1;");

        $totalUsers = 0;

        if (isset($users[0])) $totalUsers = $users[0]->total;

        return $totalUsers;
    }

    private function conversionRegistrationDeposit()
    {
        $conversion = 0;

        // possible division by zero
        if ($this->total_users_made_deposit > 0) $conversion = ($this->total_users * $this->total_users_made_deposit) / 100;

        return $conversion;
    }

    private function usersCountry()
    {
        $users = \DB::select("SELECT u.country,
                                count(u.id) as total,
                                SUM(if(u.active = 's', 1, 0)) AS total_active
                                from users u
                                where u.role = 'player'
                                group by u.country
                                order by total desc;");

        foreach ($users as $item) {
            $this->users_country_name[] = $item->country;
            $this->users_country_total[] = $item->total;
        }

        return $users;
    }
}
