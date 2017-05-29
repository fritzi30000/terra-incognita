<?php

namespace App\Http\Controllers\Cms;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Expedition;
use App\DailyBlog;

class DailyBlogController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index($id)
    {
        $dailyBlog = DailyBlog::where('expedition_id', $id)->get();
        $expedition = Expedition::findOrFail($id);
        $sections = array(
            'equipment' => 'Sprzęt',
            'organization' => 'Organizacja',
            'gallery' => 'Galeria',
            'description' => 'Opis i parametry',
            'advices' => 'Porady',
        );
        return view('cms.daily_blog.index', ['dailyBlog' => $dailyBlog, 'expedition' => $expedition, 'sections' => $sections]);
    }

    public function add($id)
    {
        $expedition = Expedition::findOrFail($id);
        $sections = array(
            'equipment' => 'Sprzęt',
            'organization' => 'Organizacja',
            'gallery' => 'Galeria',
            'description' => 'Opis i parametry',
            'advices' => 'Porady',
        );
        return view('cms.daily_blog.add', ['expedition' => $expedition, 'sections' => $sections]);
    }

    public function edit($id)
    {
        $dailyBlog = DailyBlog::findOrFail($id);
        $expedition = Expedition::findOrFail($dailyBlog->expedition_id);
        $sections = array(
            'equipment' => 'Sprzęt',
            'organization' => 'Organizacja',
            'gallery' => 'Galeria',
            'description' => 'Opis i parametry',
            'advices' => 'Porady',
        );
        return view('cms.daily_block.edit', ['daily_blog' => $dailyBlog, 'expedition' => $expedition, 'sections' => $sections]);
    }

    public function update($id)
    {
        $dailyBlog = DailyBlog::findOrFail($id);
        $dailyBlog->fill(request()->all());


        if ($dailyBlog->save()) {
            request()->session()->flash('alert_success', 'Dane zostały zapisane');
        } else {
            request()->session()->flash('alert_success', 'Błąd zapisu danych. Spróbuj jeszcze raz.');
        }

        return redirect('/expedition/daily_blog/edit/' . $dailyBlog->id);
    }

}