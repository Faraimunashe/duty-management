<x-app-layout>
    <div class="pagetitle">
        <h1>Imported Vehicles</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Imported</li>
                <li class="breadcrumb-item active">Vehicles</li>
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
            <div class="col-md-12">
                        <div class="card recent-sales overflow-auto">
                            <div class="card-body">
                                <h5 class="card-title">Imported Vehicles</h5>
                                <table class="table table-borderless datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Vehicle</th>
                                            <th scope="col">Engine #</th>
                                            <th scope="col">Qty</th>
                                            <th scope="col">Manufactured On</th>
                                            <th scope="col">Import On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 0;
                                        @endphp
                                        @foreach ($vehicles as $item)
                                            <tr>
                                                <th scope="row">
                                                    <a href="#">
                                                        @php
                                                            $vehicle = get_vehicle($item->vehicle_id);
                                                            $count++;
                                                            echo $count;
                                                        @endphp
                                                    </a>
                                                </th>
                                                <td><a href="#" class="text-primary">{{ $vehicle->make.' '.$vehicle->model }}</a></td>
                                                <td>{{ $vehicle->engine_number }}</td>
                                                <td>{{ $vehicle->quantity }}</td>
                                                <td>{{ $vehicle->date_manufactured }}</td>
                                                <td>{{ $item->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
            </div><!-- End Left side columns -->
        </div>
    </section>
</x-app-layout>
