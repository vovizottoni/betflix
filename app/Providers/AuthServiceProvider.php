<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // VerifyEmail::toMailUsing(function ($notifiable, $url) {
        //     return (new MailMessage)
        //         ->subject('Verificar Endereço de Email')
        //         ->line('Clique no botão abaixo para verificar seu endereço de e-mail.')
        //         ->action('Verificar Endereço de Email', $url)
        //         ->line('Se você não criou uma conta, nenhuma outra ação é necessária.');
        // });



        // ResetPassword::toMailUsing(function ($notifiable, $url) {
        //     return (new MailMessage)
        //         ->subject('Notificação de redefinição de senha')
        //         ->line('Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.')
        //         ->action('Redefinir senha', $url)
        //         ->line('Este link de redefinição de senha expirará em :count minutos.', ['count' => config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')])
        //         ->line('Se você não solicitou uma redefinição de senha, nenhuma outra ação é necessária.');
        // });
    }
}
