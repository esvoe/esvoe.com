<table class="table table-responsive" id="users-table">
    <thead>
        <th>Timeline Id</th>
        <th>Email</th>
        <th>Verification Code</th>
        <th>Email Verified</th>
        <th>Remember Token</th>
        <th>Password</th>
        <th>Birthday</th>
        <th>City</th>
        <th>Gender</th>
        <th>Last Logged</th>
        <th>Timezone</th>
        <th>Referral Id</th>
        <th>Language Id</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Deleted At</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{!! $user->timeline_id !!}</td>
            <td>{!! $user->email !!}</td>
            <td>{!! $user->verification_code !!}</td>
            <td>{!! $user->email_verified !!}</td>
            <td>{!! $user->remember_token !!}</td>
            <td>{!! $user->password !!}</td>
            <td>{!! $user->birthday !!}</td>
            <td>{!! $user->city !!}</td>
            <td>{!! $user->gender !!}</td>
            <td>{!! $user->last_logged !!}</td>
            <td>{!! $user->timezone !!}</td>
            <td>{!! $user->referral_id !!}</td>
            <td>{!! $user->language_id !!}</td>
            <td>{!! $user->created_at !!}</td>
            <td>{!! $user->updated_at !!}</td>
            <td>{!! $user->deleted_at !!}</td>
            <td>
                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('users.show', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>