<?php

namespace App\Console\Commands;

use App\Models\App;
use App\Modules\Key\Actions\CreateAppAction;
use App\Modules\Key\Dtos\CreateAppDto;
use App\Modules\Key\Exeptions\App\AppAlreadyExistsException;
use App\Modules\Key\Repositories\AppsRepository;
use Illuminate\Console\Command;

class AppConsoleManager extends Command
{
    // sail artisan app:app-manager
    protected $signature = 'app:app-manager';

    const SHOW_LIST = 'show_list';
    const ADD_APP = 'add_app';
    const EXIT = 'exit';
    const PER_PAGE = 10;

    protected $description = 'Создание нового приложения, для которого может быть выписан ключ';

    private CreateAppAction $createAppAction;
    private AppsRepository $appsRepository;

    public function handle(
        CreateAppAction $createAppAction,
        AppsRepository $appsRepository,
    ): void
    {
        $this->createAppAction = $createAppAction;
        $this->appsRepository = $appsRepository;

        $this->showMenu();
    }

    private function showMenu(): void
    {
        $action = $this->choice('Выберите действие', [
            self::SHOW_LIST => 'Список приложений',
            self::ADD_APP => 'Новое приложение',
            self::EXIT => 'Выход',
        ]);

        $actionHandlers = [
            self::SHOW_LIST => [$this, 'showList'],
            self::ADD_APP => [$this, 'addApp'],
            self::EXIT => [$this, 'exit'],
        ];

        if (isset($actionHandlers[$action])) {
            $actionHandlers[$action]();
        }
    }

    private function showList(int $page = 1): void
    {
        $apps = $this->appsRepository->getPage($page, self::PER_PAGE);
        $values = $apps->map(static function (App $app) {
            return [
                'id' => $app->id,
                'name' => $app->name,
                'created_at' => $app->created_at->format('Y-m-t'),
            ];
        });

        $this->table([
            'id',
            'Имя',
            'Создано'
        ], $values);

        $actions = [
            'prev' => [
                'title' => 'Назад',
                'handler' => fn() => $this->showList($page - 1),
                'hidden' => $page === 1,
            ],
            'next' => [
                'title' => 'Вперед',
                'handler' => fn() => $this->showList($page + 1),
                'hidden' => $apps->count() < self::PER_PAGE,
            ],
            'menu' => [
                'title' => 'Меню',
                'handler' => [$this, 'showMenu'],
                'hidden' => false,
            ],
        ];

        $actions = array_filter($actions, fn($action) => !$action['hidden']);
        $titles = array_map(fn($action) => $action['title'], $actions);
        $choice = $this->choice('', $titles);

        if (isset($actions[$choice]['handler'])) {
            $actions[$choice]['handler']();
        }
    }

    private function addApp(): void
    {
        $appName = $this->ask('Название приложения', '');

        $createAppDto = CreateAppDto::fromArray([
            'name' => $appName,
        ]);

        try {
            $createdApp = ($this->createAppAction)($createAppDto);
            $this->info('Приложение добавлено');
            $this->info($createdApp->name);
        } catch (AppAlreadyExistsException) {
            $this->info('Имя приложения уже занято');
        } catch (\Throwable $exception) {
            logger()->error($exception->getMessage(), $exception->getTrace());

            $this->error('Неизвестная ошибка');
        }

        $this->showMenu();
    }

    private function exit(): int
    {
        return 0;
    }
}
