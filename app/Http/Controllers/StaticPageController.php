<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    /**
     * Muestra el manual del usuario.
     *
     * @return \Illuminate\View\View
     */
    public function manual()
    {
        return view('static-pages.manual');
    }

    /**
     * Redirige al correo de soporte técnico.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function support()
    {
        return redirect()->to('mailto:soporte@jangas.gob.pe');
    }

    /**
     * Muestra la página Acerca del Sistema.
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        return view('modules.static-pages.about');
    }
}