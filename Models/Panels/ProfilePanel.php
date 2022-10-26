<?php

declare(strict_types=1);

namespace Modules\Forum\Models\Panels;

// --- Services --

use Modules\Blog\Models\Panels\ProfilePanel as BaseProfilePanel;

class ProfilePanel extends BaseProfilePanel {
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'Modules\Forum\Models\Profile';
}
