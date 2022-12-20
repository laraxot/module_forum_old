@php
//dddx(isset($thread));
@endphp
<div class="bg-gray-100 py-6 px-4 space-y-6 sm:p-6">
    <div>
        <h2 id="create_thread_heading" class="text-lg leading-6 font-medium text-gray-900">
            @if ($thread)
                Update thread
            @else
                Create a new thread
            @endif
        </h2>
        <x-rules-banner />
    </div>

    <div class="flex flex-col space-y-6">
        <div class="grow space-y-6">
            <div class="space-y-1">
                <x-forms.label for="subject" />
    <x-forms.body action="create" modelClass="{{ get_class(xotModel($this->model_name)) }}" />
    {{-- <x-button.primary-cta wire:click="create()">CREATE</x-button.primary-cta> --}}
    <button wire:click="create()">CREATE</button>

                <x-forms.inputs.input name="subject" :value="$thread ? $thread->subject() : ''" required
                    maxlength="60" />

                <span class="mt-2 text-sm text-gray-500">
                    Maximum 60 characters.
                </span>
            </div>
        </div>

        <div class="grow space-y-6">
            <div class="space-y-1">
                <x-forms.label for="tags">
                    Tags
                </x-forms.label>

                <select name="tags[]" id="create-thread" multiple x-data="{}"
                    x-init="$nextTick(function () { choices($el) })">
                    @foreach ($_theme->tags() as $tag)
                        <option value="{{ $tag->id }}" @if (in_array($tag->id, $_theme->selectedTags())) selected @endif>{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="grow space-y-6">
            <div class="space-y-1">
                <x-forms.label for="body">Compose your question</x-forms.label>

                <livewire:editor :body="$thread ? $thread->body() : ''" placeholder="Compose your thread..." hasButton
                    :buttonLabel="$thread ? 'Update thread' : 'Create thread'" buttonIcon="heroicon-o-arrow-right" />
            </div>
        </div>
    </div>
</div>
