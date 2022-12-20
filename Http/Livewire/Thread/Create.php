<?php

declare(strict_types=1);

namespace Modules\Forum\Http\Livewire\Thread;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Forum\Models\Thread;
use Modules\Xot\Jobs\PanelCrud\CreateJob;
use Modules\Xot\Jobs\PanelCrud\StoreJob;
use Modules\Cms\Services\PanelService;

/**
 * Class Create.
 */
class Create extends Component {
    public string $model_name;
    public array $form_data = [];
    public ?Thread $thread;

    public function mount(string $model_name) {
        $this->model_name = $model_name;
        $this->form_data = PanelService::make()->get(xotModel($model_name))->getFields();
        // $this->thread = new Thread();
    }

    protected function rules() {
        return PanelService::make()->get(xotModel($this->model_name))->rules();
    }

    public function render() {
        $view = 'forum::livewire.'.$this->model_name.'.create';

        $view_params = [
            'view' => $view,
        ];

        return view()->make($view, $view_params);
    }

    public function create() {
        // $this->validate();
        // dddx(PanelService::make()->get(xotModel($this->model_name)));
        // PanelService::make()->get(xotModel($this->model_name))->createJob();

        $this->form_data['author_id'] = Auth::id();

        // dddx($this->form_data);

        $r = dispatch(new StoreJob($this->form_data, PanelService::make()->get(xotModel($this->model_name))));

        // dddx($r);

        return redirect()->route('containers.index', ['container0' => 'threads']);
    }
}
