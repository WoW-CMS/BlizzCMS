<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    /**
     * Change site language
     * 
     * @param string $locale
     * @return void
     */
    public function lang($locale = null)
    {
        $this->multilanguage->setLanguage($locale);


        $agent = $this->request->getUserAgent();
        return redirect()->to($agent->getReferrer());
    }
}
