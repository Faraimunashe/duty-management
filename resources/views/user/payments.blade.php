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
            </div>
            <div class="col-md-9">
                <div class="card recent-sales overflow-auto">
                    <div class="card-header">
                        Vehicle Details
                        <button type="button" class="btn btn-success" style="float: right;">
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
                                            <a href="#" class="text-primary fw-bold">Sit unde debitis delectus repellendus</a>
                                        </td>
                                        <td>$79</td>
                                        <td class="fw-bold">41</td>
                                        <td>$3,239</td>
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

                    </div>
                </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
</x-app-layout>
