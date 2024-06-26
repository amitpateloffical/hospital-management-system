<?php

namespace App\Repositories;

use App\Models\Postal;
use Exception;
use Illuminate\Support\Facades\Route;
//use Route;
use Storage;
use Str;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class PostalRepository
 */
class PostalRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldSearchable = [
        'from_title',
        'to_title',
        'reference_no',
        'date',
        'address',
    ];

    /**
     * @return array|string[]
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Postal::class;
    }

    public function store($input): bool
    {
        try {
            /**
             * @var Postal $postal
             */
            $postal = $this->create($input);
            if (! empty($input['attachment'])) {
                $fileName = Route::current()->getName() == 'receives.store' ? 'Receive' : 'Dispatch';
                $fileExtension = getFileName($fileName, $input['attachment']);
                $postal->addMedia($input['attachment'])->usingFileName($fileExtension)->toMediaCollection(Postal::PATH,
                    config('app.media_disc'));
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function updatePostal(array $input, int $postalId)
    {
        try {
            /**
             * @var Postal $postal
             */
            $postal = $this->update($input, $postalId);

            if (! empty($input['attachment'])) {
                $postal->clearMediaCollection(Postal::PATH);
                $fileName = Route::current()->getName() == 'receives.update' ? 'Receive' : 'Dispatch';
                $fileExtension = getFileName($fileName, $input['attachment']);
                $postal->addMedia($input['attachment'])->usingFileName($fileExtension)->toMediaCollection(Postal::PATH,
                    config('app.media_disc'));
            }
            if ($input['avatar_remove'] == 1 && isset($input['avatar_remove']) && ! empty($input['avatar_remove'])) {
                removeFile($postal, Postal::PATH);
            }
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function deleteDocument(int $postalId)
    {
        try {
            /**
             * @var Postal $postal
             */
            $postal = $this->find($postalId);
            $postal->clearMediaCollection(Postal::PATH);
            $this->delete($postalId);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function downloadMedia($postal): array
    {
        try {
            $documentMedia = $postal->media()->first();
            $documentPath = $documentMedia->getPath();
            if (config('app.media_disc') === 'public') {
                $documentPath = (Str::after($documentMedia->getUrl(), '/uploads'));
            }

            ob_end_clean();

            $file = Storage::disk(config('app.media_disc'))->get($documentPath);

            $headers = [
                'Content-Type' => $postal->media[0]->mime_type,
                'Content-Description' => 'File Transfer',
                'Content-Disposition' => "attachment; filename={$postal->media[0]->file_name}",
                'filename' => $postal->media[0]->file_name,
            ];

            return [$file, $headers];
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
