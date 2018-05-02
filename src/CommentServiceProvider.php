<?php 

namespace webazin\Comment;

use Ghanem\Rating\Commands\MigrationCommand;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->commands('command.commentable.migration');
        $this->app->bind('command.commentable.migration', function ($app) {
            return new MigrationCommand();
        }, TRUE);
    }
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        //
    }
    /**
     * Get the services provided.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'command.commentable.migration',
        ];
    }
}
