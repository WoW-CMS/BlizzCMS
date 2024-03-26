<?php

namespace App\Controllers;

use App\Models\News;

class Home extends BaseController
{
    public function index(): string
    {
        $newsModel = model(News::class);

        $data = [
            'articles' => $newsModel->getArticles(),
            'realms' => null,
        ];

        return view('layout/Header') .
            view('home/Home', $data) .
            view('layout/Footer');
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
