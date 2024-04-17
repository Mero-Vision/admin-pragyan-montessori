<!DOCTYPE html>
<html lang="en">

@include('admin_layouts.header')

<body>

    <div class="main-wrapper">

        @include('admin_layouts.nav')


        @include('admin_layouts.sidebar')


        <div class="page-wrapper">
            <div class="content container-fluid">


                <div class="row">





                    <div class="card card-table">
                        <table class="table border-0 star-student table-hover table-center mb-0 table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile No</th>
                                    <th>Message</th>
                                </tr>

                            </thead>
                            <tbody>

                                @forelse ($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->phone_no }}</td>
                                        <td>{{ $contact->message }}</td>
                                    </tr>
                                @empty
                                    <td colspan="6">
                                        <img src="{{ url('assets/img/Empty-rafiki.png') }}"
                                            class="img-fluid mx-auto d-block" alt="Empty Data" style="max-width: 40%" />
                                    </td>
                                @endforelse

                            </tbody>

                        </table>
                        {{ $contacts->links('pagination::bootstrap-5') }}












                    </div>
                </div>




                <div class="modal fade contentmodal" id="deleteModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content doctor-profile">
                            <div class="modal-header pb-0 border-bottom-0  justify-content-end">
                                <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                                        class="feather-x-circle"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="delete-wrap text-center">
                                    <div class="del-icon"><i class="feather-x-circle"></i></div>
                                    <h2>Sure you want to delete</h2>
                                    <div class="submit-section">
                                        <a href="blog.html" class="btn btn-success me-2">Yes</a>
                                        <a href="#" class="btn btn-danger" data-bs-dismiss="modal">No</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        @include('admin_layouts.footer2')

    </div>


    @include('admin_layouts.footer')
</body>

</html>
