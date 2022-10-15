<x-app-layout>
    <div class="pagetitle">
        <h1>Payments</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Payments</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
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
            <div class="col-md-9">
                <div class="card recent-sales overflow-auto">
                    <div class="card-header">
                        Vehicle Details
                        <button type="button" class="btn btn-success" style="float: right;" data-bs-toggle="modal" data-bs-target="#largeModal">
                            <i class="bi bi-plus"></i>
                            Add Vehicle
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-borderless">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Vehicles</th>
                                <th scope="col">Price</th>
                                <th scope="col">Rate %</th>
                                <th scope="col">Duty</th>
                              </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0;
                                    $total_duty = 0.00;
                                @endphp
                                @foreach ($cart as $item)
                                    <tr>
                                        <th scope="row">
                                            @php
                                                $count++;
                                                echo $count;
                                            @endphp
                                        </th>
                                        <td>
                                            @php
                                                $vehicle = get_vehicle($item->id);
                                            @endphp
                                            <a href="#" class="text-primary fw-bold">{{ $vehicle->make.' - '.$vehicle->make }} X {{ $item->qty }}</a>
                                        </td>
                                        <td>${{ $item->price }}</td>
                                        <td class="fw-bold">{{ $item->rate }}</td>
                                        <td>${{ calculate_duty($item->price, $item->rate) }}</td>
                                        @php
                                            $total_duty = $total_duty + calculate_duty($item->price, $item->rate);
                                        @endphp
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- End Left side columns -->
            <div class="col-md-3">
                <div class="card recent-sales overflow-auto">
                    <div class="card-header">
                        Payment Details
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('user-make-payment') }}">
                            @csrf
                            <div class="d-grid gap-2 mt-3">
                                <h3><strong> Total Duty: </strong></h3>
                                <h3>${{ money($total_duty) }}</h3>
                            </div>
                            <div class="d-grid gap-2 mt-3">
                                <button class="btn btn-primary" type="button">
                                    <i class="bi bi-credit-card"></i>
                                    Paynow
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
    <div class="modal fade" id="largeModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('user-add-vehicle') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Vehicle Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Category: </label>
                            <div class="col-sm-10">
                                <select name="category_id" class="form-control" required>
                                    <option selected disabled>Select Vehicle Category</option>
                                    @foreach (get_vehicle_categories() as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Make: </label>
                            <div class="col-sm-10">
                                <input type="text" name="make" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Model: </label>
                            <div class="col-sm-10">
                                <input type="text" name="model" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Engine #: </label>
                            <div class="col-sm-10">
                                <input type="text" name="engine_number" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Manufactured: </label>
                            <div class="col-sm-10">
                                <input type="date" name="date_manufactured" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Quantity: </label>
                            <div class="col-sm-10">
                                <input type="text" name="quantity" class="form-control" value="1" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Price: </label>
                            <div class="col-sm-10">
                                <input type="text" name="price" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Continue</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- End Large Modal-->
</x-app-layout>
