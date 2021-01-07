@extends('admin.main')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>User</h1>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>List User</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Fullname</th>
                                    </tr>
                                    @foreach($designer as $row)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td class="font-weight-600">{{$row['username']}}</td>
                                        <td>
                                            {{$row['full_name']}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
