<?php

namespace App\Providers;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //  Model::preventLazyLoading(! app()->isProduction());
    $m_pending = Order::whereHas('order_approval', function ($q) {
      $q->where('m_approved_status', 'Pending');
    })->count();
    //$parent_categories = $shop_category->getParentCategories();

    view()->composer('*', function ($view) {
      $view->with('m_pending',Order::whereHas('order_approval', function ($q) {
        $q->where('m_approved_status', 'Pending');
      })->count());
      $view->with('coo_pending',Order::whereHas('order_approval', function ($q) {
        $q->where('coo_approved_status', 'Pending');
      })->count());
      $view->with('noc_pending',Order::whereHas('order_approval', function ($q) {
        $q->where('noc_approved_status', 'Pending');
      })->count());
      $view->with('noc_pro_pending',Order::whereHas('order_approval', function ($q) {
        $q->where('noc_processing_status', 'Pending');
      })->count());
      $view->with('a_pending',Order::whereHas('order_approval', function ($q) {
        $q->where('a_approved_status', 'Pending');
      })->count());
    });
  }
}
