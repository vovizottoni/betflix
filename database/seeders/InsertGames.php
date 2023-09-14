<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InsertGames extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //*********************************************************************************************
        //ROCKETCRASH
        $check_rocketcrash = DB::table('games')->where([['game_code', '=',  'rocketcrash']])->first();
        if (empty($check_rocketcrash)) {

            DB::table('games')->insert([
                'id_game_hypertech' => 1,
                'description' => 'Descricao do jogo RocketCrash',
                'name' => 'Rocket Crash',
                'token_hypetech' => 'd432b4d7c7a65accae30d7e9151726c72d769fec7cfa551a15ac6b4343b4fa50',
                'game_code' => 'rocketcrash'
            ]);
        } else {

            //jogo já existente na base

        }
        //*********************************************************************************************


        //*********************************************************************************************
        //PIPA
        $check_pipa = DB::table('games')->where([['game_code', '=',  'pipa']])->first();
        if (empty($check_pipa)) {

            DB::table('games')->insert([
                'id_game_hypertech' => 2,
                'description' => 'Descricao do jogo Pipa',
                'name' => 'Pipa',
                'token_hypetech' => 'd432b4d7c7a65accae30d7e9151726c72d769fec7cfa551a15ac6b4343b4fa50',
                'game_code' => 'pipa'
            ]);
        } else {

            //jogo já existente na base

        }
        //*********************************************************************************************



        //*********************************************************************************************
        //MOTOGRAU
        $check_motograu = DB::table('games')->where([['game_code', '=',  'motograu']])->first();
        if (empty($check_motograu)) {

            DB::table('games')->insert([
                'id_game_hypertech' => 3,
                'description' => 'Descricao do jogo Motograu',
                'name' => 'Motograu',
                'token_hypetech' => 'd432b4d7c7a65accae30d7e9151726c72d769fec7cfa551a15ac6b4343b4fa50',
                'game_code' => 'motograu'
            ]);
        } else {

            //jogo já existente na base

        }
        //*********************************************************************************************



        //*********************************************************************************************
        //EMBAIXADINHA
        $check_embaixadinha = DB::table('games')->where([['game_code', '=',  'embaixadinha']])->first();
        if (empty($check_embaixadinha)) {

            DB::table('games')->insert([
                'id_game_hypertech' => 4,
                'description' => 'Descricao do jogo Embaixadinha',
                'name' => 'Embaixadinha',
                'token_hypetech' => 'd432b4d7c7a65accae30d7e9151726c72d769fec7cfa551a15ac6b4343b4fa50',
                'game_code' => 'embaixadinha'
            ]);
        } else {

            //jogo já existente na base

        }
        //*********************************************************************************************




        //*********************************************************************************************
        //AVIATOR
        $check_aviator = DB::table('games')->where([['game_code', '=',  'aviator']])->first();
        if (empty($check_aviator)) {

            DB::table('games')->insert([
                'id_game_hypertech' => 5,
                'description' => 'Descricao do jogo Aviator',
                'name' => 'Aviator',
                'token_hypetech' => 'd432b4d7c7a65accae30d7e9151726c72d769fec7cfa551a15ac6b4343b4fa50',
                'game_code' => 'aviator'
            ]);
        } else {

            //jogo já existente na base

        }
        //*********************************************************************************************


        //*********************************************************************************************
        //MASKARA
        $check_mask = DB::table('games')->where([['game_code', '=',  'mask']])->first();
        if (empty($check_mask)) {

            DB::table('games')->insert([
                'id_game_hypertech' => 6,
                'description' => 'Descricao do jogo Maskara',
                'name' => 'Maskara',
                'token_hypetech' => 'd432b4d7c7a65accae30d7e9151726c72d769fec7cfa551a15ac6b4343b4fa50',
                'game_code' => 'mask'
            ]);
        } else {

            //jogo já existente na base

        }
        //*********************************************************************************************




        //*********************************************************************************************
        //TOGURO
        $check_toguro = DB::table('games')->where([['game_code', '=',  'toguro']])->first();
        if (empty($check_toguro)) {

            DB::table('games')->insert([
                'id_game_hypertech' => 7,
                'description' => 'Descricao do jogo Toguro',
                'name' => 'Toguro',
                'token_hypetech' => 'd432b4d7c7a65accae30d7e9151726c72d769fec7cfa551a15ac6b4343b4fa50',
                'game_code' => 'toguro'
            ]);
        } else {

            //jogo já existente na base

        }
        //*********************************************************************************************




        //*********************************************************************************************
        //double
        $check_double = DB::table('games')->where([['game_code', '=',  'double']])->first();
        if (empty($check_double)) {

            DB::table('games')->insert([
                'id_game_hypertech' => 8,
                'description' => 'Descricao do jogo Double',
                'name' => 'Double',
                'token_hypetech' => 'd432b4d7c7a65accae30d7e9151726c72d769fec7cfa551a15ac6b4343b4fa50',
                'game_code' => 'double'
            ]);
        } else {

            //jogo já existente na base

        }
        //*********************************************************************************************




        $check_crash = DB::table('games')->where([['game_code', '=',  'crash']])->first();
        if (empty($check_crash)) {

            DB::table('games')->insert([
                'id_game_hypertech' => 9,
                'description' => 'Descricao do jogo Crash',
                'name' => 'Crash',
                'token_hypetech' => 'd432b4d7c7a65accae30d7e9151726c72d769fec7cfa551a15ac6b4343b4fa50',
                'game_code' => 'crash'
            ]);
        } else {

            //jogo já existente na base

        }

        $check_wall_street = DB::table('games')->where([['game_code', '=',  'wall-street']])->first();
        if (empty($check_wall_street)) {

            DB::table('games')->insert([
                'id_game_hypertech' => 10,
                'description' => 'Descricao do jogo Wall Street',
                'name' => 'Wall Street',
                'token_hypetech' => 'd432b4d7c7a65accae30d7e9151726c72d769fec7cfa551a15ac6b4343b4fa50',
                'game_code' => 'wall-street'
            ]);
        } else {

            //jogo já existente na base

        }
    }
}
