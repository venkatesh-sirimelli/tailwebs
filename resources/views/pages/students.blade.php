@extends('layout.layout')
@section('title', 'Home')
@section('content')
    <div class="container">
        <table class="table rel_table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Mark</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($students) && count($students) > 0)
                    @foreach ($students as $student)
                        <tr>
                            <td><span class="name">{{ substr($student->name, 0, 1) }}</span>{{ $student->name }}</td>
                            <td>{{ $student->subject }}</td>
                            <td>{{ $student->marks }}</td>
                            <td>
                                <div class="dropdown">
                                    <div data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-caret-down circle" aria-hidden="true"></i>
                                    </div>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item edit_student" href="#" data-bs-toggle="modal"
                                                data-bs-target="#add" data-student="{{$student->name}}" data-subject="{{$student->subject}}" data-marks="{{$student->marks}}">Edit</a></li>
                                        <li><a class="dropdown-item delete_student" data-id="{{ md5($student->id) }}"
                                                href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                            <!-- Start Edit Student Model -->
                            <div class="modal fade" id="edit_student_{{ $student->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <form action="{{ route('create-student') }}" method="POST" id="edit_form_{{$student->id}}">
                                                @csrf
                                                <div class="field">
                                                    <label for="name">Name</label>
                                                    <div class="input_box">
                                                        <i class="fas fa-user input_icon"></i>
                                                        <input type="text" class="input_field" value="{{ $student->name }}" name="name" required data-parsley-required-message="Name is required" />
                                                    </div>
                                                    @error('name')
                                                        <div class="bg-danger text-light px-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="field">
                                                    <label for="subject">Subject</label>
                                                    <div class="input_box">
                                                        <i class="fas fa-comment-alt input_icon"></i>
                                                        <input type="text" class="input_field" value="{{ $student->subject }}" name="subject" required data-parsley-required-message="Subject is required" />
                                                    </div>
                                                    @error('subject')
                                                        <div class="bg-danger text-light px-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="field">
                                                    <label for="marks">Marks</label>
                                                    <div class="input_box">
                                                        <i class="fas fa-bookmark input_icon" aria-hidden="true"></i>
                                                        <input type="text" class="input_field" value="{{ $student->marks }}" name="marks" required data-parsley-required-message="Marks are required" data-parsley-type="number" data-parsley-type-message="Marks must be a number" />
                                                    </div>
                                                    @error('marks')
                                                        <div class="bg-danger text-light px-2">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="t_button">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Edit Student Model -->
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">No Students data Found!</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{ $students->links('pagination::bootstrap-5') }}

        <button type="button" class="t_button edit_student" data-bs-toggle="modal" data-bs-target="#add">Add</button>

        <!-- Start Add Student Model -->
        <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <form action="{{ route('create-student') }}" method="POST" class="student_form">
                            @csrf
                            <div class="field">
                                <label for="name">Name</label>
                                <div class="input_box">
                                    <i class="fas fa-user input_icon"></i>
                                    <input type="text" class="input_field student" name="name" required
                                        data-parsley-required-message="Name is required" />
                                </div>
                                @error('name')
                                    <div class="bg-danger text-light px-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label for="subject">Subject</label>
                                    <div class="input_box">
                                        <i class="fas  fa-comment-alt input_icon"></i>
                                        <input type="text" class="input_field subject" name="subject" required
                                            data-parsley-required-message="Subject is required" />
                                    </div>
                                    @error('subject')
                                        <div class="bg-danger text-light px-2">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="field">
                                        <label for="marks">Marks</label>
                                        <div class="input_box">
                                            <i class="fas fa-bookmark input_icon" aria-hidden="true"></i>
                                            <input type="text" class="input_field marks" name="marks" required
                                                data-parsley-required-message="Marks are required"
                                                data-parsley-type="number"
                                                data-parsley-type-message="Marks must be a number" />
                                        </div>
                                        @error('marks')
                                            <div class="bg-danger text-light px-2">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="t_button">Add</button>
                                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Add Student Model -->
        
    </div>
    <script>
        $(document).ready(function() {
            $('.student_form').parsley();
            $(document).on('click','.edit_student',function(){
                $('.student_form').parsley().destroy();;
                $('.student_form').parsley();
                $('.student_form')[0].reset();
                $('#add .student').val($(this).data('student'));
                $('#add .subject').val($(this).data('subject'));
                $('#add .marks').val($(this).data('marks'));
            })
            $(document).on('click', '.delete_student', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/delete-student/' + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your item has been deleted.',
                                    'success'
                                );
                                location.reload();
                            },
                            error: function(xhr) {
                                Swal.fire(
                                    'Error!',
                                    'There was a problem deleting the item.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
