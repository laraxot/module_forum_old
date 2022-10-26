<?php

declare(strict_types=1);

namespace Modules\Forum\Models\Panels;

// --- Services --

use Modules\Xot\Models\Panels\XotBasePanel;

class ForumPanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'Modules\Forum\Models\Forum';

    /**
     * The single value that should be used to represent the resource when being displayed.
     */
    public static string $title = 'title';

    public function fields(): array {
        return [
            (object) [
                'type' => 'Id',
                'name' => 'post_id',
            ],
            (object) [
                'type' => 'SelectParent',
                'name' => 'parent_id',
            ],
            (object) [
                'type' => 'Text',
                'name' => 'post.title',
            ],
            (object) [
                'type' => 'Text',
                'name' => 'post.subtitle',
            ],
            (object) [
                'type' => 'Wysiwyg',
                'name' => 'post.txt',
            ],
        ];
    }
}
