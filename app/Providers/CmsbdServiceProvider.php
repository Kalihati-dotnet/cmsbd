<?php
namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;

use Blade;

class CmsbdServiceProvider extends ServiceProvider
{

    //protected $defer = true;
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $mng = explode(DIRECTORY_SEPARATOR, ___SERVER('REQUEST_URI'));

        // 
        if(isset($mng[1]) && $mng[1] === 'manage'){
            config(['session.cookie' => 'MNGSESS']);


        }
        
        // \View::composer(['*'], function() {
        //     view()->share([
        //         'categories' => Category::where('parent_id', '=', null)->get(),
        //        // 'xmbdCategories' => XmbdCategory::where('parent_id', '=', null)->get(),
        //       //  'tagOptions' => Tag::get()->pluck('name', 'id')->toArray()
        //     ]);
        // });

        Blade::directive('can', function ($expression) {
            return "<?php if (Auth::guard('manage')->user()->checkAbility({$expression})) : ?>";
        });

        Blade::directive('endcan', function () {
            return "<?php endif; ?>";
        });


    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       
    }
}
