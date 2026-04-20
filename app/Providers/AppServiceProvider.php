namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Tambahkan baris ini

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Tambahkan kode ini agar semua link pakai HTTPS saat online
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
    }
}