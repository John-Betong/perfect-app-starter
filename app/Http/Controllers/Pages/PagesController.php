<?php declare(strict_types=1);

namespace App\Http\Controllers\Pages;

class PagesController
{
    final public function home(): void
    {
        view('layouts/layout', ['templatePage' => 'default']);
    }

    final public function about(): void
    {
        $appName = 'Perfect App';
        view('layouts/layout', ['templatePage' => 'pages/about', 'appName' => $appName]);
    }

    final public function contact(): void
    {
        $company = 'Perfect App';
        view('layouts/layout', ['templatePage' => 'pages/contact','company' => $company]);
    }

    //----------------------------------------------------------------------------------------
    // Framework Examples
    //----------------------------------------------------------------------------------------

    final public function table(): void
    {
        view('layouts/layout', ['templatePage' => 'pages/table']);
    }

    //----------------------------------------------------------------------------------------
    // TO DO
    //----------------------------------------------------------------------------------------

    final public function settings(): void
    {
        view('layouts/layout', ['templatePage' => 'admin/settings']);
    }

    final public function errors(): void
    {
        view('layouts/layout', ['templatePage' => 'admin/errors']);
    }



}
