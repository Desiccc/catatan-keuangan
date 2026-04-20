namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Tambahkan baris ini

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (config('app.env') === 'production') {
    \Illuminate\Support\Facades\URL::forceScheme('https');
}
        }
    }
}