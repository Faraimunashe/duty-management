<x-app-layout>
    <div class="pagetitle">
        <h1>Daily Transactions</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Transactions</li>
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
                        <h5 class="card-title">Daily Transactions</h5>
                        <table class="table table-borderless datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Reference</th>
                                    <th scope="col">Method</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($transactions as $item)
                                    <tr>
                                        <th scope="row">
                                            <a href="#">
                                                @php
                                                    $count++;
                                                    echo $count;
                                                @endphp
                                            </a>
                                        </th>
                                        <td>{{ $item->reference }}</td>
                                        <td><a href="#" class="text-primary">{{ $item->method }}</a></td>
                                        <td>${{ $item->amount }}</td>
                                        <td>
                                            @if ($item->status == 1)
                                                success
                                            @elseif ($item->status == 2)
                                                pending
                                            @elseif ($item->status == 0)
                                                failed

                                            @endif

                                        </td>
                                        <td> {{ $item->created_at }} </td>
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
