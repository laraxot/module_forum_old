<?php

declare(strict_types=1);

namespace Modules\Forum\Models;

use Sushi\Sushi;

class Home extends BaseModelLang {
    use Sushi;

    protected $rows = [
        [
            'id' => 'home',
            'name' => 'New York',
        ],
    ];

    // --------- functions -------------
    public function forums() {
        return Forum::all();
    }
}
