<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>SubTitle</th>
            <th>submitted at</th>
            <th>approved at</th>
            <th>is pinned</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    @foreach($articles as $article)
    <tr>
        <td>{{ $article->title }}</td>
        <td>{{ $article->subtitle }}</td>
        <td>{{ $article->submitted_at }}
             @livewire('formx::inputs.toggle-date',['model'=>$article,'field'=>'submitted_at'],key('toggle-date-submitted-'.$article->id))

        </td>

        <td>{{ $article->approved_at }}
             @livewire('formx::inputs.toggle-date',['model'=>$article,'field'=>'approved_at'],key('toggle-date-'.$article->id))
        </td>
        <td>{{-- $article->is_pinned --}}
            @livewire('formx::inputs.toggle-bool',['model'=>$article,'field'=>'is_pinned'],key('toggle-bool-'.$article->id))
        </td>
        <td>

        </td>
    </tr>
    @endforeach
    <tbody>
</table>