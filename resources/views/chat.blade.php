<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css"
          rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"
            integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.14/vue.js"
            integrity="sha512-pSyYzOKCLD2xoGM1GwkeHbdXgMRVsSqQaaUoHskx/HF09POwvow2VfVEdARIYwdeFLbu+2FCOTRYuiyeGxXkEg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.4.0/socket.io.min.js"
            integrity="sha512-gfppNkmmwLyyV/BXmzS9uWWbjxe0owp9N3wx9NeGmIHkFOiRM0EMmQte753JyYZd9uzIbjuSqPOvME0SvADXhw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.0/echo.min.js"
            integrity="sha512-Hk/QFptXLXupwjWtYZjIcA6hAjQJMqRx/4OYWZ8W/Nd2FG/vgOH6N1vZHNpVITQ/3F+kxcSacMY4ZDejNrSEjA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Chat</title>
</head>
<body>
<div>
    @foreach (\App\Models\User::all() as $user)
        <div>
            <a href="{{url('/')}}/login/{{ $user->id }}">{{ $user->name }}</a>
        </div>
    @endforeach
    <div>
        <a href="{{url('/')}}/logout">Logout</a>
    </div>
</div>
<div id="app" class="container">
    <h3 class=" text-center">Messaging | User: {{ optional(auth()->user())->name }}</h3>
    <div class="messaging">
        <div class="inbox_msg">
            <div class="inbox_people">
                <div class="headind_srch">
                    <div class="recent_heading">
                        <h4>Recent</h4>
                    </div>
                    <div class="srch_bar">
                        <div class="stylish-input-group">
                            <input type="text" class="search-bar" placeholder="Search">
                            <span class="input-group-addon">
                <button type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                </span></div>
                    </div>
                </div>
                <div class="inbox_chat">
                    <div class="chat_list active_chat">
                        <div v-for="user in users" class="chat_people">
                            <div class="chat_img"><img src="https://ptetutorials.com/images/user-profile.png"
                                                       alt="sunil"></div>
                            <div class="chat_ib">
                                <h5>@{{ user.name }} <span class="chat_date">Dec 25</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mesgs">
                <div class="msg_history">
                    <div class="incoming_msg">
                        <div class="incoming_msg_img"><img src="https://ptetutorials.com/images/user-profile.png"
                                                           alt="sunil"></div>
                        <div class="received_msg">
                            <div class="received_withd_msg">
                                <p>@{{ message.message }}</p>
                                <span class="time_date"> 11:01 AM    |    June 9</span></div>
                        </div>
                    </div>
                    <div class="outgoing_msg">
                        <div class="sent_msg">
                            <p>@{{ message.message }}</p>
                            <span class="time_date"> 11:01 AM    |    June 9</span></div>
                    </div>
                </div>
                <div class="type_msg">
                    <div class="input_msg_write">
                        <input type="text" v-model="message" @keyup.enter="sendMessage" class="write_msg"
                               placeholder="Type a message"/>
                        <button @click="sendMessage" class="msg_send_btn" type="button"><i class="fa fa-paper-plane-o"
                                                                                           aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    new Vue({
        el: "#app",
        data() {
            return {
                id: {{ auth()->id() }},
                message: "",
                users: [],
                messages: [],
            }
        },
        methods: {
            sendMessage() {
                axios.post('{{url('/')}}/message', {message: this.message})
                this.message = ""
            }
        },
        mounted() {
            const echo = new Echo({
                broadcaster: "socket.io"
            })

            echo.join('chat')
                .here((users) => {
                    this.users = users
                })
                .listen('ChatEventBroadcast', (event) => {
                    this.messages.push(event);
                });
        },
    })
</script>
</body>
</html>
