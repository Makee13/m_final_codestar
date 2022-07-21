<div wire:poll>
    <div class="container-message">
        <h3 class=" text-center">
            {{__('Coza Perfume Community')}}
        </h3>
        <div>
            <p class="text-muted text-center m-t-10">
                <em>{{__('Use civilized and polite words in the chat box, violating your account will be banned forever.')}}</em>
            </p>
        </div>
        <div class="messaging">
            <div class="inbox_msg">
                <div class="mesgs">
                    <div id="chat" class="msg_history">
                        @forelse ($messages as $message)
                            @if ($message->user->email == auth()->user()->email)
                                <!-- Reciever Message-->
                                <div class="outgoing_msg">
                                    <div class="sent_msg">
                                        <p>{{ $message->message_text }}</p>
                                        <span class="time_date">
                                            {{ $message->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @else
                                <div class="incoming_msg d-flex align-items-center m-b-20">
                                    <div class="incoming_msg_img"> <img
                                            src="/template/images/user-profile.png" alt="sunil"> </div>
                                    <div class="received_msg">

                                    @if ($message->user->roles == 'admin')
                                        <strong style="color: #6c7ae0;">{{__('Coza supporter')}}</strong>
                                    @else
                                        <strong>{{ \Str::ucfirst($message->user->name) }}</strong>
                                    @endif
                                        <div class="received_withd_msg">
                                            <p>{{ $message->message_text }}</p>
                                            <span
                                                class="time_date">{{ $message->created_at->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <h5 style="text-align: center;color:red">{{__('No previous messages')}}</h5>
                        @endforelse

                    </div>
                    <div class="type_msg">
                        <div class="input_msg_write">
                            <form wire:submit.prevent="sendMessage">
                                <input onkeydown='scrollDown()' wire:model.defer="messageText" type="text"
                                    class="write_msg" placeholder="Enter your message" />
                                <button class="msg_send_btn" type="submit">{{__('Send')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
