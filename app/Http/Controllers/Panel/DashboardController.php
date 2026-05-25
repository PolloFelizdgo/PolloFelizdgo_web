<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Services\Panel\PanelContentService;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __construct(private readonly PanelContentService $contentService)
    {
    }

    public function __invoke(): View
    {
        $this->contentService->processDueScheduledPublishes();

        $mailConfigured = (string) config('mail.mailers.smtp.host', '') !== ''
            && (string) config('mail.from.address', '') !== '';

        $recaptchaConfigured = (string) config('services.recaptcha.site_key', '') !== ''
            && (string) config('services.recaptcha.secret_key', '') !== '';

        return view('panel.dashboard', [
            'status' => [
                'app' => 'up',
                'mail' => $mailConfigured ? 'configured' : 'missing',
                'recaptcha' => $recaptchaConfigured ? 'configured' : 'missing',
            ],
            'sectionStatuses' => $this->contentService->getSectionStatuses([
                'home.content',
                'about.content',
                'footer.copy',
                'menu.items',
                'theme.settings',
            ]),
        ]);
    }
}
