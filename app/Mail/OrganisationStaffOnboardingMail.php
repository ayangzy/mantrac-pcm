<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrganisationStaffOnboardingMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user;
    public string $url;


    public function __construct($user, $url)
    {
        $this->user = $user;
        $this->url = $url;
    }


    public function build()
    {

        $resetLink = route('auth.password.resetPassword', ['token' => $this->url]);

        return $this->subject('Welcome to the PMS Platform')
            ->view('emails.staff-onboarding')
            ->with([
                'resetLink' => $resetLink,
            ]);
    }
}
