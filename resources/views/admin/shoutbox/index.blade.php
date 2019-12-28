@extends('admin/app')
@section('content')
<div class="col-sm">
    <hr>
    <h1 class="pull-left">Wiadomości Shoutbox: </h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Lp</th>
                <th>User</th>
                <th>Treść</th>
                <th>Akcje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $message)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $message->author ? $message->author->name : 'Niezarejestrowany' }}</td>
                    <td>{{ $message->content }}</td>
                    <td>
                        <form action="" method="POST" id="delete-msg-form">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button 
                                type="button" 
                                class="btn btn-danger delete-message" 
                                data-msg-id="{{ $message->id }}" 
                                data-toggle="modal" 
                                data-target="#exampleModal">
                                    Usuń
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Usuwnie wiadomości</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Czy jesteś pewien?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                    <button type="button" class="btn btn-danger" id="delete-message" data-msg-id="">Usuń</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('.delete-message').on('click', function(e) {
            const DELETE_ROUTE = "{{ route('message.index') }}";
            var currentElement = e.target;
            document.querySelector('#delete-msg-form').action = DELETE_ROUTE + '/' + currentElement.dataset.msgId;
        });

        $('#delete-message').on('click', function(e) {
            $('#delete-msg-form').submit();
        });
    });
</script>
@endsection