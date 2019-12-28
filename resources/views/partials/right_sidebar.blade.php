<aside class="col-md-4 blog-sidebar">
  <div class="shout-box shadow">
    <div class="messages" id="messages">
      @foreach ($messages as $message)
      <div class="message-block">
        <div class="author">{{ $message->getAuthor() }}, {{ $message->getDate() }}</div>
        <div class="message-content">
          {{ $message->content }}
        </div>
      </div>
      @endforeach
    </div>
    <form id="shout-box" action="{{ route('message.store') }}" method="POST">
      {{ csrf_field() }}
      <textarea name="message" id="shout-box-message" class="form-control single-message" placeholder="Wpisz wiadomość..."></textarea>
      <button type="button" id="shout-box-button" class="btn btn-info btn-block">Wyślij</button>
    </form>
  </div>
  <div id="shoutbox-error" class="pl-3 pr-3 mb-3 bg-light rounded hidden">
    <p class="text-danger pt-1 pb-1 text-center">Treść wiadomości jest wymagana i nie powinna przekraczać 280 znaków</p>
  </div>
  {{-- <div class="p-3 mb-3 bg-light rounded">
    <h4 class="font-italic">About</h4>
    <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
  </div> --}}

  <div class="p-3 mb-4">
    <h4 class="font-italic">Archiwum</h4>
    <ol class="list-unstyled">
      @foreach ($archive as $key => $row)
        <li><a href="{{ route('archive', $key) }}">{{ \App\Helpers\DateHelper::dateConvToArchive($key) }}</a></li>
      @endforeach
    </ol>
  </div>
</aside><!-- /.blog-sidebar -->