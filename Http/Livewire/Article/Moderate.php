<?php

declare(strict_types=1);

namespace Modules\Forum\Http\Livewire\Article;

use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\Blog\Models\Article;

/**
 * Undocumented class.
 */
class Moderate extends Component {
    // public array $form_data = [];
    // public Collection $articles;

    protected $listeners = ['updateField' => 'updateField'];

    public function mount() {
        $this->articles = Article::all();
    }

    public function render() {
        $view = 'forum::livewire.article.moderate';
        // $this->articles = Article::all();
        $view_params = [
            'view' => $view,
            // 'articles' => Article::all(),
        ];

        return view()->make($view, $view_params);
    }

    public function updateField($id, $field, $value) {
        $this->articles->where('id', $id)->{$field} = $value;
    }
}
