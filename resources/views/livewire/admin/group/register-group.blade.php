<div>
    <div class="page-header">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
            <div>
                <span class="icon"><i class="mdi mdi-buffer"></i></span>
                <b>{{__('admin_register-group.register_group_title')}}</b>
            </div>
        </div>
    </div>

    <div class="">

        <div class="w-full flex justify-center items-center">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8  w-full grid grid-cols-1 md:grid-cols-3 gap-4">


                <div class="">
                    <label class="label ">{{__('admin_register-group.name')}}</label>
                    <div class="field-body">
                        <div class="field">
                            <input wire:model.defer='name' class="input input-bordered" type="text">
                        </div>
                        @error('name') <span class="error  text-red-700">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-span-full">
                    <label class="label " >{{__('admin_register-group.description')}}</label>
                    <div class="field-body">
                        <div class="field">
                            <textarea class="textarea textarea-bordered " wire:model.defer='description' name="" id="" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <label class="label col-span-full -mb-6 mt-4" style="border-left: 5px solid red; padding-left: 10px; text-transform: uppercase; margin-bottom: 0px;">Configuração do Bônus de Primeiro Depósito:</label>
                <div class="">
                    <label class="label " >Status</label>
                    <select wire:model.defer ="bonus1_status" class="select select-bordered w-full">
                      <option selected value="">{{__('admin_group.select_option')}}</option>
                      <option value="active">{{__('admin_group.active')}}</option>
                      <option value='inactive'>{{__('admin_group.inactive')}}</option>
                    </select>
                    @error('bonus1_status') <span class="error  text-red-700">{{ $message }}</span> @enderror
                </div>
                <div class="">
                    <label class="label " for=""> Piso  </label>
                    <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" id='bonus1_piso' class='input input-bordered w-full text-xs' type="text" placeholder="1-50000" wire:model.defer='bonus1_piso_integer'>
                    <p class="text-xs">Digite apenas números inteiros</p>
                </div>
                <div class="">
                    <label class="label " for=""> Teto  </label>
                    <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" id='bonus1_teto' class="input input-bordered w-full text-xs" type="text" placeholder="1-50000" wire:model.defer='bonus1_teto_integer'>
                    <p class="text-xs">Digite apenas números inteiros</p>
                </div>
                <div class="">
                    <label class="label "for=""> Percentual</label>
                    <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="bonus_1_percentual" class="input input-bordered w-full" type="text" placeholder="1-100" wire:model.defer='bonus1_percentual_valor_integer'>
                    <p class="text-xs">Digite apenas números inteiros</p>
                </div>
                <div class="">
                    <label class="label " >Destino</label>
                    <select class="select select-bordered w-full"  wire:model.defer="bonus1_destino">
                      <option  selected value="">{{__('admin_group.select_option')}}</option>
                      <option value="balanceNormal">{{__('admin_group.balanceNormal')}}</option>
                      <option value='balanceBonus'>{{__('admin_group.balanceBonus')}}</option>
                    </select>
                    @error('bonus1_destino') <span class="error  text-red-700">{{ $message }}</span> @enderror
                </div>
                <div class="hidden md:block"></div>
                <label class="label col-span-full -mb-6 mt-4" style="border-left: 5px solid red; padding-left: 10px; text-transform: uppercase; margin-bottom: 0px;">Configuração do CPA:</label>
                <div class="">
                    <label class="label " for="">Status</label>
                    <select class="select select-bordered w-full"  wire:model.defer="bonus2_status">
                        <option  selected value="">{{__('admin_group.select_option')}}</option>
                        <option value="active">{{__('admin_group.active')}}</option>
                        <option value='inactive'>{{__('admin_group.inactive')}}</option>
                    </select>
                    @error('bonus2_status') <span class="error  text-red-700">{{ $message }}</span> @enderror
                </div>


                <div class="">
                    <label class="label " for="">Bonificação em dois niveis:</label>
                    <select class="select select-bordered w-full"  wire:model.defer="bonus2_two_levels">
                        <option selected value="">{{__('admin_group.select_option')}}</option>
                        <option value="active">Sim</option>
                        <option value='inactive'>Não</option>
                    </select>
                </div>


                <div class="">
                    <label class="label " for=""> Porcentagem do superior:</label>
                    <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" id='bonus2_piso' class="input input-bordered w-full" type="text" placeholder="1-50000" wire:model.defer='bonus2_percentual_superior_integer'>
                    <p class="text-xs">Digite apenas números inteiros</p>
                </div>

                <div class="">
                    <label class="label " for=""> Piso  </label>
                    <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" id='bonus2_piso' class="input input-bordered w-full" type="text" placeholder="1-50000" wire:model.defer='bonus2_piso_integer'>
                    <p class="text-xs">Digite apenas números inteiros</p>
                </div>

                <div class="">
                    <label class="label "> Teto  </label>
                    <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" id='bonus2_teto' class="input input-bordered w-full" type="text" placeholder="1-50000" wire:model.defer='bonus2_teto_integer'>
                    <p class="text-xs">Digite apenas números inteiros</p>
                </div>

                <div class="">
                    <label class="label "for="">Percentual</label>
                    <input onkeypress="return event.charCode >= 48 && event.charCode <= 57" id="bonus_2_percentual" class="input input-bordered w-full" type="text"  placeholder="1-100" wire:model.defer='bonus2_percentual_valor_integer'>
                    <p class="text-xs">Digite apenas números inteiros</p>
                </div>
                <div class="">
                    <label class="label "for="">Destino</label>
                    <select class="select select-bordered w-full"  wire:model.defer="bonus2_destino">
                        <option  selected value="">{{__('admin_group.select_option')}}</option>
                        <option value="balanceNormal">{{__('admin_group.balanceNormal')}}</option>
                        <option value='balanceBonus'>{{__('admin_group.balanceBonus')}}</option>
                    </select>
                    @error('bonus2_destino') <span class="error  text-red-700">{{ $message }}</span> @enderror
                </div>



                <div class='flex items-center justify-end gap-4 mt-6 col-span-full'>

                    <label wire:click="cancel()" for="edit-group" class="btn btn-error">Cancelar</label>
                    <label wire:click="register()"  class="btn btn-success" >Registrar Grupo</label>

                </div>
            </form>

        </div>

    </div>

    <script>
            const bonus2_teto = document.getElementById("bonus2_teto");
            bonus2_teto.addEventListener("keypress", function(e) {
            if(e.key === ",") {
            e.preventDefault();
        }
            if(e.key === ".") {
            e.preventDefault();
        }

        });

        const bonus2_piso = document.getElementById("bonus2_piso");
        bonus2_piso.addEventListener("keypress", function(e) {
            if(e.key === ",") {
            e.preventDefault();
        }
            if(e.key === ".") {
            e.preventDefault();
        }

        });

        const bonus1_teto = document.getElementById("bonus1_teto");
        bonus1_teto.addEventListener("keypress", function(e) {
            if(e.key === ",") {
            e.preventDefault();
        }
            if(e.key === ".") {
            e.preventDefault();
        }

        });

        const bonus1_piso = document.getElementById("bonus1_piso");
        bonus1_piso.addEventListener("keypress", function(e) {
            if(e.key === ",") {
            e.preventDefault();
        }
            if(e.key === ".") {
            e.preventDefault();
        }

        });

        const bonus_1_percentual = document.getElementById("bonus_1_percentual");
        bonus_1_percentual.addEventListener("keypress", function(e) {
            if(e.key === ",") {
            e.preventDefault();
        }
            if(e.key === ".") {
            e.preventDefault();
        }

        });

        const bonus_2_percentual = document.getElementById("bonus_2_percentual");
        bonus_2_percentual.addEventListener("keypress", function(e) {
            if(e.key === ",") {
            e.preventDefault();
        }
            if(e.key === ".") {
            e.preventDefault();
        }

        });
    </script>
</div>
