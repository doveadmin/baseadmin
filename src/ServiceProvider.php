<?php

namespace DACore\BaseAdmin;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Schema;
use Blade;

use DACore\BaseAdmin\Console\Commands\Command;

class ServiceProvider extends BaseServiceProvider
{

    public function boot()
    {

        // 特殊字段太长报错
        Schema::defaultStringLength(191);

        // 模板机制中使用的量
        Blade::directive('getLinkUrl', function($expression) {
            return "<?php echo Route($expression); ?>";
        });


        // 【1】模板
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'dacore.baseadmin');
        //发布视图到resources/views/vendor目录
        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('/views/DACore/BaseAdmin'),
        ]);

        // 【2】路由
        $this->setupRoutes($this->app->router);

        // 【3】配置
        $this->mergeConfigFrom(
            __DIR__ . '/config/dacore_baseadmin.php', 'dacore_baseadmin'
        );
        //发布配置文件
        $this->publishes([
            __DIR__.'/config/dacore_baseadmin.php' => config_path('dacore_baseadmin.php'),
        ], 'config');

        // 【4】数据库迁移
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // 【5】资源文件
        $this->publishes([
            __DIR__.'/resources/assets' => public_path('assets/DACore/BaseAdmin'),
        ], 'public');

        // 【6】注册 Artisan 命令
        if ($this->app->runningInConsole()) {
            $this->commands([
                Command::class,
            ]);
        }

    }

    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'DACore\BaseAdmin\Controllers'], function($router)
        {
            require __DIR__ . '/routes/routes.php';
        });
    }
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        config([
            'config/dacore_baseadmin.php',
        ]);
    }
}
