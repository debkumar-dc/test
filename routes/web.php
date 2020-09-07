<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
use DocuSign;
Route::get('/', function () {
    $client = DocuSign::create();

    $templateRole = $client->templateRole([
        'email'     => 'anish@appstango.com',
        'name'      => 'anish ghosh',
        'role_name' => 'abc',
    ]);

    $envelopeDefinition = $client->envelopeDefinition([
        'status'         => 'sent',
        'email_subject'  => 'Signature Request Sample',
        'template_id'    => '',
        'template_roles' => [
            $templateRole,
        ],
    ]);

    $envelopeOptions = $client->envelopes->createEnvelopeOptions([
        'merge_roles_on_draft' => false,
    ]);

     $envelopeSummary = $client->envelopes->createEnvelope($envelopeDefinition, $envelopeOptions);
    dd($envelopeSummary);
});
