<table class="table table-responsive" id="timelines-table">
    <thead>
        <th>Avatar Id</th>
        <th>Username</th>
        <th>Name</th>
        <th>About</th>
        <th>Type</th>
        <th>Created At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($timelines as $timeline)
        <tr>
            <td>{!! $timeline->avatar_id !!}</td>
            <td>{!! $timeline->username !!}</td>
            <td>{!! $timeline->name !!}</td>
            <td>{!! $timeline->about !!}</td>
            <td>{!! $timeline->type !!}</td>
            <td>{!! $timeline->created_at !!}</td>
            <td>
                {!! Form::open(['route' => ['timelines.destroy', $timeline->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('timelines.show', [$timeline->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('timelines.edit', [$timeline->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>