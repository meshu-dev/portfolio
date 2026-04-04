<?php

namespace App\Http\Controllers\Admin\Cv;

use App\Actions\Cv\Pdf\GetPdfFileAction;
use App\Enums\FlashTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\PdfFileResource;
use App\Jobs\CreateCvPdfJob;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Inertia\{Inertia, Response};

class PdfController extends Controller
{
    public function view(): Response
    {
        $pdfFile = resolve(GetPdfFileAction::class)->execute();

        return Inertia::render('Cv/Pdf', ['pdf' => new PdfFileResource($pdfFile)]);
    }

    public function generate(): RedirectResponse
    {
        CreateCvPdfJob::dispatch((int) Auth::id());

        Inertia::flash([
            'message' => 'PDF generation has started and will complete in the next few minutes',
            'type'    => FlashTypeEnum::SUCCESS,
        ]);

        return to_route('pdf.view');
    }

    public function getPdfFile(): PdfFileResource
    {
        $pdfFile = resolve(GetPdfFileAction::class)->execute();

        return new PdfFileResource($pdfFile);
    }
}
