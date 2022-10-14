<x-app-layout>
    <div class="pagetitle">
        <h1>Duty Payments</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Duty</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-md-12">
                @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session::get('error') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <h5 class="card-title">Duty Payments</h5>
                                    </div>
                                    <div class="col-md-2 mt-3 justify-end">
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#largeModal">
                                            <i class="bi bi-printer"></i>
                                            Print Report
                                        </button>
                                    </div>
                                </div>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">Reference</th>
                                            <th scope="col">Vehicle</th>
                                            <th scope="col">Buying</th>
                                            <th scope="col">Rate</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Clerk</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($duties as $duty)
                                            <tr>
                                                <td>{{ $duty->reference }}</td>
                                                <td>{{ $duty->vehicle_id }}</td>
                                                <td>{{ $duty->amount }}</td>
                                                <td>{{ $duty->percentage_rate }}</td>
                                                <td>{{ $duty->total }}</td>
                                                <td>{{ $duty->user_id }}</td>
                                                <td>{{ $duty->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
    <div class="modal fade" id="largeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin-download-duty') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Download Duty Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">From: </label>
                            <div class="col-sm-10">
                                <input type="date" name="from" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">To: </label>
                            <div class="col-sm-10">
                                <input type="date" name="to" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-download"></i>
                            Download
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- End Large Modal-->
</x-app-layout>
