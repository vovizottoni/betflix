<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = array(
            array('id' => '1','created_at' => NULL,'updated_at' => '2023-03-14 11:58:13','deleted_at' => NULL,'name' => 'Grupo Padrão','description' => NULL,'bonus1_status' => 'inactive','bonus1_percentual_valor_integer' => '0','bonus1_teto_integer' => '0','bonus1_destino' => 'balanceBonus','bonus2_status' => 'active','bonus2_percentual_valor_integer' => '50','bonus2_destino' => 'balanceNormal','bonus3_status' => 'inactive','bonus3_percentual_valor_integer' => '0','bonus3_tipo_aposta_balance' => 'balanceNormal','bonus3_destino' => 'balanceNormal','tipo' => 'padrao','bonus1_piso_integer' => '5','bonus2_piso_integer' => '50','bonus2_teto_integer' => '50','bonus3_piso_integer' => NULL,'bonus3_teto_integer' => NULL,'bonus2_two_levels' => 'inactive','bonus2_percentual_superior_integer' => NULL),
            array('id' => '2','created_at' => '2023-03-14 11:20:23','updated_at' => '2023-03-25 00:12:47','deleted_at' => '2023-03-25 00:12:47','name' => 'Ganhe R$50,00 por R$50,00+ depositados','description' => NULL,'bonus1_status' => 'active','bonus1_percentual_valor_integer' => NULL,'bonus1_teto_integer' => NULL,'bonus1_destino' => 'balanceNormal','bonus2_status' => 'active','bonus2_percentual_valor_integer' => '100','bonus2_destino' => 'balanceNormal','bonus3_status' => 'inactive','bonus3_percentual_valor_integer' => NULL,'bonus3_tipo_aposta_balance' => 'balanceNormal','bonus3_destino' => 'balanceNormal','tipo' => 'nao-padrao','bonus1_piso_integer' => NULL,'bonus2_piso_integer' => '50','bonus2_teto_integer' => '50','bonus3_piso_integer' => NULL,'bonus3_teto_integer' => NULL,'bonus2_two_levels' => 'inactive','bonus2_percentual_superior_integer' => NULL),
            array('id' => '4','created_at' => NULL,'updated_at' => '2023-03-25 19:06:40','deleted_at' => NULL,'name' => 'Grupo Padrão','description' => NULL,'bonus1_status' => 'active','bonus1_percentual_valor_integer' => '100','bonus1_teto_integer' => '500','bonus1_destino' => 'balanceBonus','bonus2_status' => 'active','bonus2_percentual_valor_integer' => '25','bonus2_destino' => 'balanceNormal','bonus3_status' => 'inactive','bonus3_percentual_valor_integer' => '0','bonus3_tipo_aposta_balance' => 'balanceNormal','bonus3_destino' => 'balanceNormal','tipo' => 'nao-padrao','bonus1_piso_integer' => '5','bonus2_piso_integer' => '40','bonus2_teto_integer' => '40','bonus3_piso_integer' => NULL,'bonus3_teto_integer' => NULL,'bonus2_two_levels' => 'inactive','bonus2_percentual_superior_integer' => NULL),
            array('id' => '5','created_at' => '2023-03-24 23:44:54','updated_at' => '2023-03-25 00:12:40','deleted_at' => '2023-03-25 00:12:40','name' => 'Ganhe R$40,00 por R$40,00 + depositados','description' => NULL,'bonus1_status' => 'active','bonus1_percentual_valor_integer' => NULL,'bonus1_teto_integer' => NULL,'bonus1_destino' => 'balanceNormal','bonus2_status' => 'active','bonus2_percentual_valor_integer' => '100','bonus2_destino' => 'balanceNormal','bonus3_status' => 'inactive','bonus3_percentual_valor_integer' => NULL,'bonus3_tipo_aposta_balance' => 'balanceNormal','bonus3_destino' => 'balanceNormal','tipo' => 'nao-padrao','bonus1_piso_integer' => NULL,'bonus2_piso_integer' => '40','bonus2_teto_integer' => '40','bonus3_piso_integer' => NULL,'bonus3_teto_integer' => NULL,'bonus2_two_levels' => 'inactive','bonus2_percentual_superior_integer' => NULL),
            array('id' => '6','created_at' => '2023-03-24 23:45:39','updated_at' => '2023-03-25 00:12:43','deleted_at' => '2023-03-25 00:12:43','name' => 'Ganhe R$20,00 por R$20,00+ depositados','description' => NULL,'bonus1_status' => 'inactive','bonus1_percentual_valor_integer' => NULL,'bonus1_teto_integer' => NULL,'bonus1_destino' => 'balanceBonus','bonus2_status' => 'active','bonus2_percentual_valor_integer' => '100','bonus2_destino' => 'balanceNormal','bonus3_status' => 'inactive','bonus3_percentual_valor_integer' => NULL,'bonus3_tipo_aposta_balance' => 'balanceNormal','bonus3_destino' => 'balanceNormal','tipo' => 'nao-padrao','bonus1_piso_integer' => NULL,'bonus2_piso_integer' => '20','bonus2_teto_integer' => '20','bonus3_piso_integer' => NULL,'bonus3_teto_integer' => NULL,'bonus2_two_levels' => 'inactive','bonus2_percentual_superior_integer' => NULL),
            array('id' => '7','created_at' => '2023-03-24 23:46:29','updated_at' => '2023-03-25 00:12:37','deleted_at' => '2023-03-25 00:12:37','name' => 'Ganhe R$10,00 por R$10,00+ depositados','description' => NULL,'bonus1_status' => 'inactive','bonus1_percentual_valor_integer' => NULL,'bonus1_teto_integer' => NULL,'bonus1_destino' => 'balanceBonus','bonus2_status' => 'active','bonus2_percentual_valor_integer' => '100','bonus2_destino' => 'balanceNormal','bonus3_status' => 'inactive','bonus3_percentual_valor_integer' => NULL,'bonus3_tipo_aposta_balance' => 'balanceNormal','bonus3_destino' => 'balanceNormal','tipo' => 'nao-padrao','bonus1_piso_integer' => NULL,'bonus2_piso_integer' => '10','bonus2_teto_integer' => '10','bonus3_piso_integer' => NULL,'bonus3_teto_integer' => NULL,'bonus2_two_levels' => 'inactive','bonus2_percentual_superior_integer' => NULL),
            array('id' => '8','created_at' => '2023-03-25 00:18:14','updated_at' => '2023-03-25 00:20:54','deleted_at' => NULL,'name' => 'Seu afiliado ganha R$50,00 por R$50,00+ depositados','description' => NULL,'bonus1_status' => 'inactive','bonus1_percentual_valor_integer' => NULL,'bonus1_teto_integer' => NULL,'bonus1_destino' => 'balanceBonus','bonus2_status' => 'active','bonus2_percentual_valor_integer' => '100','bonus2_destino' => 'balanceNormal','bonus3_status' => 'inactive','bonus3_percentual_valor_integer' => NULL,'bonus3_tipo_aposta_balance' => 'balanceNormal','bonus3_destino' => 'balanceNormal','tipo' => 'nao-padrao','bonus1_piso_integer' => NULL,'bonus2_piso_integer' => '50','bonus2_teto_integer' => '50','bonus3_piso_integer' => NULL,'bonus3_teto_integer' => NULL,'bonus2_two_levels' => 'inactive','bonus2_percentual_superior_integer' => NULL),
            array('id' => '9','created_at' => '2023-03-25 00:18:52','updated_at' => '2023-03-25 00:18:52','deleted_at' => NULL,'name' => 'Seu afiliado e você ganham R$25,00 cada por R$50,00+ depositados','description' => NULL,'bonus1_status' => 'inactive','bonus1_percentual_valor_integer' => NULL,'bonus1_teto_integer' => NULL,'bonus1_destino' => 'balanceBonus','bonus2_status' => 'active','bonus2_percentual_valor_integer' => '50','bonus2_destino' => 'balanceNormal','bonus3_status' => 'inactive','bonus3_percentual_valor_integer' => NULL,'bonus3_tipo_aposta_balance' => 'balanceNormal','bonus3_destino' => 'balanceNormal','tipo' => 'nao-padrao','bonus1_piso_integer' => NULL,'bonus2_piso_integer' => '50','bonus2_teto_integer' => '50','bonus3_piso_integer' => NULL,'bonus3_teto_integer' => NULL,'bonus2_two_levels' => 'active','bonus2_percentual_superior_integer' => '50'),
            array('id' => '10','created_at' => '2023-03-25 00:19:34','updated_at' => '2023-03-25 00:19:34','deleted_at' => NULL,'name' => 'Seu afiliado e você ganham R$20,00 cada por R$40,00+ depositados','description' => NULL,'bonus1_status' => 'inactive','bonus1_percentual_valor_integer' => NULL,'bonus1_teto_integer' => NULL,'bonus1_destino' => 'balanceBonus','bonus2_status' => 'active','bonus2_percentual_valor_integer' => '50','bonus2_destino' => 'balanceNormal','bonus3_status' => 'inactive','bonus3_percentual_valor_integer' => NULL,'bonus3_tipo_aposta_balance' => 'balanceNormal','bonus3_destino' => 'balanceNormal','tipo' => 'nao-padrao','bonus1_piso_integer' => NULL,'bonus2_piso_integer' => '40','bonus2_teto_integer' => '40','bonus3_piso_integer' => NULL,'bonus3_teto_integer' => NULL,'bonus2_two_levels' => 'active','bonus2_percentual_superior_integer' => '50'),
            array('id' => '11','created_at' => '2023-03-25 00:20:26','updated_at' => '2023-03-25 00:20:26','deleted_at' => NULL,'name' => 'Seu afiliado e você ganham R$10,00 cada por R$20,00+ depositados','description' => NULL,'bonus1_status' => 'active','bonus1_percentual_valor_integer' => NULL,'bonus1_teto_integer' => NULL,'bonus1_destino' => 'balanceBonus','bonus2_status' => 'inactive','bonus2_percentual_valor_integer' => '50','bonus2_destino' => 'balanceNormal','bonus3_status' => 'inactive','bonus3_percentual_valor_integer' => NULL,'bonus3_tipo_aposta_balance' => 'balanceNormal','bonus3_destino' => 'balanceNormal','tipo' => 'nao-padrao','bonus1_piso_integer' => NULL,'bonus2_piso_integer' => '20','bonus2_teto_integer' => '20','bonus3_piso_integer' => NULL,'bonus3_teto_integer' => NULL,'bonus2_two_levels' => 'active','bonus2_percentual_superior_integer' => '50'),
            array('id' => '12','created_at' => '2023-03-25 00:18:15','updated_at' => '2023-03-25 00:20:55','deleted_at' => NULL,'name' => 'Seu afiliado ganha R$40,00 por R$40,00+ depositados','description' => NULL,'bonus1_status' => 'inactive','bonus1_percentual_valor_integer' => NULL,'bonus1_teto_integer' => NULL,'bonus1_destino' => 'balanceBonus','bonus2_status' => 'active','bonus2_percentual_valor_integer' => '100','bonus2_destino' => 'balanceNormal','bonus3_status' => 'inactive','bonus3_percentual_valor_integer' => NULL,'bonus3_tipo_aposta_balance' => 'balanceNormal','bonus3_destino' => 'balanceNormal','tipo' => 'nao-padrao','bonus1_piso_integer' => NULL,'bonus2_piso_integer' => '40','bonus2_teto_integer' => '40','bonus3_piso_integer' => NULL,'bonus3_teto_integer' => NULL,'bonus2_two_levels' => 'inactive','bonus2_percentual_superior_integer' => NULL),
            array('id' => '13','created_at' => '2023-03-25 00:18:53','updated_at' => '2023-03-25 00:18:53','deleted_at' => NULL,'name' => 'Seu afiliado ganha R$30,00 e você ganha R$20,00 cada por R$50,00+ depositados','description' => NULL,'bonus1_status' => 'inactive','bonus1_percentual_valor_integer' => NULL,'bonus1_teto_integer' => NULL,'bonus1_destino' => 'balanceBonus','bonus2_status' => 'active','bonus2_percentual_valor_integer' => '30','bonus2_destino' => 'balanceNormal','bonus3_status' => 'inactive','bonus3_percentual_valor_integer' => NULL,'bonus3_tipo_aposta_balance' => 'balanceNormal','bonus3_destino' => 'balanceNormal','tipo' => 'nao-padrao','bonus1_piso_integer' => NULL,'bonus2_piso_integer' => '50','bonus2_teto_integer' => '50','bonus3_piso_integer' => NULL,'bonus3_teto_integer' => NULL,'bonus2_two_levels' => 'active','bonus2_percentual_superior_integer' => '20'),
            array('id' => '14','created_at' => '2023-03-25 00:18:53','updated_at' => '2023-03-25 00:18:53','deleted_at' => NULL,'name' => 'Seu afiliado ganha R$40,00 e você ganha R$10,00 cada por R$50,00+ depositados','description' => NULL,'bonus1_status' => 'inactive','bonus1_percentual_valor_integer' => NULL,'bonus1_teto_integer' => NULL,'bonus1_destino' => 'balanceBonus','bonus2_status' => 'active','bonus2_percentual_valor_integer' => '80','bonus2_destino' => 'balanceNormal','bonus3_status' => 'inactive','bonus3_percentual_valor_integer' => NULL,'bonus3_tipo_aposta_balance' => 'balanceNormal','bonus3_destino' => 'balanceNormal','tipo' => 'nao-padrao','bonus1_piso_integer' => NULL,'bonus2_piso_integer' => '50','bonus2_teto_integer' => '50','bonus3_piso_integer' => NULL,'bonus3_teto_integer' => NULL,'bonus2_two_levels' => 'active','bonus2_percentual_superior_integer' => '20'),
            array('id' => '15','created_at' => '2023-03-25 00:20:27','updated_at' => '2023-03-25 00:20:27','deleted_at' => NULL,'name' => 'Seu afiliado e você ganham R$5,00 cada por R$10,00+ depositados','description' => NULL,'bonus1_status' => 'active','bonus1_percentual_valor_integer' => NULL,'bonus1_teto_integer' => NULL,'bonus1_destino' => 'balanceBonus','bonus2_status' => 'inactive','bonus2_percentual_valor_integer' => '50','bonus2_destino' => 'balanceNormal','bonus3_status' => 'inactive','bonus3_percentual_valor_integer' => NULL,'bonus3_tipo_aposta_balance' => 'balanceNormal','bonus3_destino' => 'balanceNormal','tipo' => 'nao-padrao','bonus1_piso_integer' => NULL,'bonus2_piso_integer' => '10','bonus2_teto_integer' => '10','bonus3_piso_integer' => NULL,'bonus3_teto_integer' => NULL,'bonus2_two_levels' => 'active','bonus2_percentual_superior_integer' => '50'),
            array('id' => '16','created_at' => '2023-03-25 00:20:27','updated_at' => '2023-03-25 00:20:27','deleted_at' => NULL,'name' => 'Seu afiliado ganha R$ 20,00 por cada R$20,00+ depositados','description' => NULL,'bonus1_status' => 'active','bonus1_percentual_valor_integer' => NULL,'bonus1_teto_integer' => NULL,'bonus1_destino' => 'balanceBonus','bonus2_status' => 'inactive','bonus2_percentual_valor_integer' => '100','bonus2_destino' => 'balanceNormal','bonus3_status' => 'inactive','bonus3_percentual_valor_integer' => NULL,'bonus3_tipo_aposta_balance' => 'balanceNormal','bonus3_destino' => 'balanceNormal','tipo' => 'nao-padrao','bonus1_piso_integer' => NULL,'bonus2_piso_integer' => '20','bonus2_teto_integer' => '20','bonus3_piso_integer' => NULL,'bonus3_teto_integer' => NULL,'bonus2_two_levels' => 'active','bonus2_percentual_superior_integer' => NULL)
        );
        DB::table('group')->insert($group);

    }
}