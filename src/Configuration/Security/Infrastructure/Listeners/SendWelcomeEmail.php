<?php

namespace Src\Configuration\Security\Infrastructure\Listeners;

use Src\Configuration\Security\Domain\Events\UserCreated;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;

final class SendWelcomeEmail
{
    public function handle(UserCreated $event): void
    {
        // Using the developer's email for testing as seen in apisil
        Mail::to('alexisduarte1512@gmail.com')
            ->cc(['alexisduarte1512@gmail.com'])
            ->send(new ResetPasswordMail(
                $event->email,
                $event->temporaryPassword
            ));

        // Production logic (commented out as in source)
        // Mail::to($event->email)->cc(['capital.humano@notaria83.mx', 'alexisduarte1512@gmail.com', 'auxiliar.humano@notaria83qroo.mx'])->send(new ResetPasswordMail($event->email, $event->temporaryPassword));
    }
}
