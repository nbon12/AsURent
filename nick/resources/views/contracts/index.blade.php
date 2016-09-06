@extends('../layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New Task Form -->
        <form action="{{ url('contracts') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Task Name -->
            <div class="form-group">
                <label for="task-name" class="col-sm-12">Contract</label>

                <div class="col-sm-6">
                    Name:<input type="text" name="name" id="contract-name" class="form-control">
                </div>
                <div class="col-sm-6">
                    Description:<input type="text" name="description" id="contract-description" class="form-control">
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i> Add Contract
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- TODO: Current Tasks -->
    @if (count($contracts) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Contracts
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>Contract</th>
                        <th>Description</th>
                        <th>&nbsp;</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($contracts as $contract)
                            <tr>
                                <!-- Task Name -->
                                <td class="table-text">
                                    <div>{{ $contract->name }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $contract->description }}</div>
                                </td>

                                <td>
                                    <!-- Delete Button -->
                                    <form action="{{ url('contract/'.$contract->id) }}" method="POST">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <button type="submit" id="delete-task-{{ $contract->id }}" class="btn btn-danger">
                                            <i class="fa fa-btn fa-trash"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection