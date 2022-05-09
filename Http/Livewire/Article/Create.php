<?php

declare(strict_types=1);

namespace Modules\Forum\Http\Livewire\Article;

use Livewire\Component;
use Modules\Blog\Models\Article;

/**
 * Undocumented class.
 */
class Create extends Component {
    public array $form_data = [];
    public Article $article;

    public function mount() {
        $this->article = new Article();
    }

    public function render() {
        $view = 'forum::livewire.article.create';

        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }

    public function create() {
        dddx($this->form_data);
    }
}
