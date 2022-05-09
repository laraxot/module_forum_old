<?php

declare(strict_types=1);

namespace Modules\Forum\Models\Panels;

//--- Services --

use Modules\Xot\Models\Panels\XotBasePanel;

class ForumReplyPanel extends XotBasePanel {
    /**
     * The model the resource corresponds to.
     */
    public static string $model = 'Modules\Forum\Models\ForumReply';

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
                'type' => 'Textarea',
                'name' => 'post.txt',
            ],
        ];
    }
}
