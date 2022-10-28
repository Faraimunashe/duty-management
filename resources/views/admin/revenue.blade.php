<x-app-layout>
    <div class="pagetitle">
        <h1>Daily Revenue</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Revenue</li>
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
                        <h5 class="card-title">Daily Revenue</h5>
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Day</th>
                                    <th scope="col">Transactions</th>
                                    <th scope="col">Revenue</th>
                                    <th scope="col">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($dates as $key => $items)
                                    <tr>
                                        <th scope="row">
                                            <a href="#">
                                                @php
                                                    $count++;
                                                    echo $count;
                                                @endphp
                                            </a>
                                        </th>
                                        <td>{{ $key }}</td>
                                        <td><a href="#" class="text-primary">{{ $items->count() }}</a></td>
                                        <td>${{ get_daily_revenue($key) }}</td>
                                        <td>
                                            <a href="#" class="btn btn-primary btn-sm">
                                                view
                                            </a>
                                        </td>
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
