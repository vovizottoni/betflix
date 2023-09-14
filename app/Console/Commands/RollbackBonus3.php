<?php

namespace App\Console\Commands;

use App\Models\Account;
use App\Models\Bonus;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RollbackBonus3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rollback_bonus_3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            $week = 12;
            $where = ['bonus3_processado' => 's', 'bonus3_semanapagamento' => $week];
            $accountIds = Bonus::select(DB::raw("distinct(accounts_id)"))->where($where)->get()->pluck("accounts_id");
            foreach ($accountIds as $accountId) {
                $bonus = Bonus::where($where)->where("accounts_id", $accountId)->first();
                if (isset($bonus['id'])) {
                    $account = Account::where("id", $bonus->accounts_id)->first();
                    $balance = $bonus->bonus3_valordopagamentosemanal;
                    $code = "rlbcK_bonus3_" . $bonus->id;
                    $account->removeBalance('balance', $balance, $code);
                    Bonus::where($where)->where("accounts_id", $accountId)->update(['bonus3_processado' => 'n']);
                }

            }

            DB::commit();
        } catch (\Exception $e) {
            echo $e->getMessage();
            DB::rollBack();
        }

        return Command::SUCCESS;
    }
}
