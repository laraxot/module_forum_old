<?php
namespace Modules\Forum\Models\Panels\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\LU\Models\User as User;
use Modules\Forum\Models\Panels\Policies\ForumPanelPolicy as Panel;

use Modules\Xot\Models\Panels\Policies\XotBasePanelPolicy;

class ForumPanelPolicy extends XotBasePanelPolicy {
}
