<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:50',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10',
            'gdpr'    => 'accepted',
        ], [
            'name.required'    => 'Zadejte prosím vaše jméno.',
            'email.required'   => 'Zadejte prosím váš e-mail.',
            'email.email'      => 'E-mail není ve správném formátu.',
            'subject.required' => 'Zadejte prosím předmět zprávy.',
            'message.required' => 'Zpráva nesmí být prázdná.',
            'message.min'      => 'Zpráva musí mít alespoň 10 znaků.',
            'gdpr.accepted'    => 'Musíte souhlasit se zpracováním osobních údajů.',
        ]);

        // Log or mail — adjust to your mail setup
        // Mail::to('info@martinbeck.com')->send(new ContactMail($validated));

        return redirect()->route('contact.index')
            ->with('success', 'Děkujeme za zprávu! Ozveme se vám co nejdříve.');
    }
}