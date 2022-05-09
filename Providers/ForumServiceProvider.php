<?php

declare(strict_types=1);

namespace Modules\Forum\Providers;

//---- bases --
use Modules\Xot\Providers\XotBaseServiceProvider;

class ForumServiceProvider extends XotBaseServiceProvider {
    protected string $module_dir = __DIR__;

    protected string $module_ns = __NAMESPACE__;

    public string $module_name = 'forum'; //lower del nome
}
