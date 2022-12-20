<?php

declare(strict_types=1);

namespace Modules\Forum\Models\Panels\Policies;

use Modules\Cms\Contracts\PanelContract;
use Modules\Xot\Contracts\UserContract;
use Modules\Cms\Models\Panels\Policies\XotBasePanelPolicy;

class ThreadPanelPolicy extends XotBasePanelPolicy {
    public function artisan(UserContract $user, PanelContract $panel) {
        return true;
    }
}
