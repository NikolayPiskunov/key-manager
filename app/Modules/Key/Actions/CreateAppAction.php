<?php

namespace App\Modules\Key\Actions;

use App\Models\App;
use App\Modules\Key\Dtos\CreateAppDto;
use App\Modules\Key\Exeptions\App\AppAlreadyExistsException;
use App\Modules\Key\Repositories\AppsRepository;
use App\Modules\Key\Services\AppCreator;

final readonly class CreateAppAction
{
    public function __construct(
        private AppCreator $appCreator,
        private AppsRepository $appsRepository,
    )
    {
        //
    }

    /**
     * @throws AppAlreadyExistsException
     */
    public function __invoke(CreateAppDto $createAppDto): App
    {
        $existsApp = $this->appsRepository->forName($createAppDto->name);

        if ($existsApp) {
            throw new AppAlreadyExistsException();
        }

        return $this->appCreator->create($createAppDto);
    }
}
