<?php

namespace App\Modules\Key\Actions;

use App\Modules\Key\Presenters\KeysPresenter;
use App\Modules\Key\Repositories\KeysRepository;

final readonly class ShowKeyAction
{
    public function __construct(
        private KeysRepository $keysRepository,
        private KeysPresenter  $keysPresenter,
    )
    {
        //
    }

    /**
     * @throws \Exception
     */
    public function __invoke(string $key): array
    {
        $key = $this->keysRepository->find($key);

        if (!$key) {
            throw new \Exception('not found');
        }

        return $this->keysPresenter->prepare($key);
    }
}
