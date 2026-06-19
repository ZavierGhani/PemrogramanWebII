<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;

class PortfolioController extends Controller
{
    public function beranda()
    {
        $profil = Portfolio::getProfil();
        return view('beranda', compact('profil'));
    }

    public function profil()
    {
        $profil = Portfolio::getProfil();
        $pengalaman = Portfolio::getPengalaman();
        return view('profil', compact('profil', 'pengalaman'));
    }

    public function detail($id)
    {
        $pengalaman = Portfolio::getPengalaman();
        $item = collect($pengalaman)->firstWhere('id', (int)$id);

        if (!$item) abort(404);

        return view('detail', compact('item'));
    }

    public function hobiFilm()
{
    $film = Portfolio::getFilm();
    $series = Portfolio::getSeries();
    return view('hobi.film', compact('film', 'series'));
}
    public function hobiMusik()
    {
        $musik = Portfolio::getMusik();
        return view('hobi.musik', compact('musik'));
    }

    public function hobiBuku()
    {
        $buku = Portfolio::getBuku();
        return view('hobi.buku', compact('buku'));
    }

    public function hobiOlahraga()
    {
        $olahraga = Portfolio::getOlahraga();
        return view('hobi.olahraga', compact('olahraga'));
    }
}