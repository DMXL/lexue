<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 17/07/16
 * Time: 3:34 PM
 */

namespace App\ViewComposers;


use App\Models\Teacher\Label;
use App\Models\Teacher\Level;
use Illuminate\View\View;

class TeacherFormComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $levels = Level::all();

        $labels = Label::all();

        $view->with('levels', $levels);
        $view->with('labels', $labels);
    }
}