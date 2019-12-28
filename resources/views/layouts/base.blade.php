<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '2 Miliony') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Dosis" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <div class="container">
      @include('partials.cookie_message')
      @include('partials.header')
      @include('partials.flash_message')
      @include('partials.navbar')
      {{-- @unless (isset($hideTopContent))
        @include('partials.sponsored_article')
        @include('partials.latest_articles')
      @endunless --}}

    <main role="main">
      <div class="row">
        @yield('content')
        @unless (isset($hideSidebar))
          @include('partials.right_sidebar')
        @endunless
      </div>
    </main>
    <footer class="blog-footer container">
      <div class="row justify-content-md-center">
        <div class="col-md-4 col-sm-12  footer-categories">
          <div class="col-sm-12 footer-category"><a href="{{ route('/', 'warsztat-inwestora') }}">Warsztat inwestora</a></div>
          <div class="col-sm-12 footer-category"><a href="{{ route('/', 'filozofia-inwestowania') }}">Filozofia inwestowania</a></div>
          <div class="col-sm-12 footer-category"><a href="{{ route('/', 'ciemna-strona-gieldy') }}"">Ciemna strona giełdy</a></div>
          <div class="col-sm-12 footer-category"><a href="{{ route('/', 'analizy-biezace') }}">Analizy bieżące</a></div>
          <div class="col-sm-12 footer-category"><a href="{{ route('/', 'ogolnie-o-finansach') }}">Ogólnie o finansach</a></div>
        </div>
        <div class="col-md-4 col-sm-12 footer-rules">
          <div class="col-sm-12 footer-category"><a href="{{ route('regulations', 'regulamin') }}">Regulamin</a></div>
          <div class="col-sm-12 footer-category"><a href="{{ route('regulations', 'polityka-prywatnosci') }}">Polityka prywatności</a></div>
          <div class="col-sm-12 footer-category"><a href="{{ route('regulations', 'kontakt') }}">Kontakt</a></div>
        </div>
        <div class="col-md-4 col-sm-12 footer-socials">
          <div class="col-sm-12 footer-category"><a href="{{ route('/', 'filozofia-inwestowania') }}">Facebook</a></div>
          <div class="col-sm-12 footer-category"><a href="{{ route('/', 'filozofia-inwestowania') }}">Twitter</a></div>
        </div>
      </div>
    </footer>

    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="https://js.pusher.com/4.4/pusher.min.js"></script>

    @yield('js')
    <script type="text/javascript">
        $(document).ready(function() {
          const SHOUTBOX_MESSAGE_LENGTH = 280;

          Pusher.logToConsole = false;
          const channel_name = 'blog_channel';

          var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: 'eu',
            forceTLS: true
          });

          var channel = pusher.subscribe('blog_channel');

          channel.bind('App\\Events\\ChatEvent', function(data) {
              renderMessage(data.username, data.message);
          });

          const MONTHS = {
            'Jan': 'Styczeń',
            'Feb': 'Luty',
            'Mar': 'Marzec',
            'Apr': 'Kwiecień',
            'May': 'Maj',
            'Jun': 'Czerwiec',
            'Jul': 'Lipiec',
            'Aug': 'Sierpień',
            'Sep': 'Wrzesień',
            'Oct': 'Październik',
            'Nov': 'Listopad',
            'Dec': 'Grudzień'
          };
          const DEFAULT_PLACEHOLDER = 'Wpisz wiadomość...';
          const BLOCKED_PLACEHOLDER = 'Niezalogowany użytkownik może wysłać jedną wiadomość na minutę...';

          var messageField = $('#shout-box-message');
          var sendButton = $('#shout-box-button');
          var timeout;

          function escapeHtml(unsafe) {
            return unsafe
             .replace(/&/g, "&amp;")
             .replace(/</g, "&lt;")
             .replace(/>/g, "&gt;")
             .replace(/"/g, "&quot;")
             .replace(/'/g, "&#039;");
         }

         function formatDate(date) {
          try {
            return new Date(date+" UTC").toLocaleString();
          } catch (error) {
            console.log(error);
            return '';
          }
         }

         function blockShoutboxInput(message) {
            messageField.val('');
            timeout = setTimeout(function() {
              messageField.prop("disabled", false);
              messageField.prop("placeholder", DEFAULT_PLACEHOLDER);
              messageField.val(message);
            }, 10000);
         }

         function renderMessage(username, message) {
            var msg = '\
              <div class="message-block">\
                <div class="author">'+username+', '+formatDate(message.created_at)+'</div>\
                <div class="message-content">'+escapeHtml(message.content)+'</div>\
              </div>\
              ';
            $('.messages').append(msg);
            sendButton.text('Wyślij');
            messageField.prop("disabled", false);
            scrollMessages();
         }

         function scrollMessages() {
          $('#messages').scrollTop(100000);
         }

            $('#logout-button').on('click', function(e) {
                e.preventDefault();
                $('#logout').submit();
            })

            window.onscroll = function() {
              var currentScrollPos = document.documentElement.scrollTop || document.body.scrollTop;
              if (currentScrollPos > 52) {
                $('.nav-scroller nav.nav').addClass('fixed-top');
                $('nav .item').addClass('stick-top');
                $('.nav .logo').removeClass('hidden');
              } else {
                $('.nav-scroller nav.nav').removeClass('fixed-top');
                $('nav .item').removeClass('stick-top');
                $('.nav .logo').addClass('hidden');
              }
            };

            messageField.on('keyup', function (e) {
              $('#shoutbox-error').addClass('hidden');
              if (e.keyCode == 13) {
                  send();
              }
            });

            $('#shout-box-button').on('click', function() {
              send();
            });

            function send() {
              var message = messageField.val();
              if (message === '' || message.length > SHOUTBOX_MESSAGE_LENGTH ) {
                $('#shoutbox-error').removeClass('hidden');
                return;
              }
              messageField.val('');
              $.ajax({
                method: 'POST',
                url: '{{ route('/') }}/message',
                data: {
                  message: message
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function() {
                  sendButton.text('Wysyłanie...');
                  messageField.prop("disabled", true);
                }
              })
              .done(function (data) {
                if (data.status === 'success') {
                  // renderMessage(data.username, data.message);
                } else {
                  clearTimeout(timeout);
                  messageField.prop("placeholder", BLOCKED_PLACEHOLDER);
                  blockShoutboxInput(message);
                  sendButton.text('Wyślij');
                }
              })
              .catch(function(error) {
                console.log(error.responseJSON.errors.message[0]);
                $('#shoutbox-error').removeClass('hidden');
                messageField.prop("disabled", false);
              })
              ;
              scrollMessages();
            }

            scrollMessages();
        });
    </script>
</body>
</html>
