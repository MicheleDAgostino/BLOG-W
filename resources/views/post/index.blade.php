<x-app-layout>

    <header class="container mt-8">
        <div class="flex flex-wrap justify-center">
            <div class="w-full text-center">
                <h1 class="text-3xl font-extrabold uppercase">Tutti i post</h1>
            </div>
            @if (session('message'))
                <div class="alert alert-success mt-10">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </header>

    <section class="container mt-20">
        <div class="flex flex-col items-center">
            @foreach ($posts as $post)
                <div class="w-6/12 my-8 flex justify-center">
                    <div class="card w-full bg-base-100 shadow-xl justify-between">
                        <div class="card-body">
                          <h2 class="card-title">Titolo post: {{$post->title}}</h2>
                          <p>{{$post->description}}</p>

                          <div class="card-actions justify-end">
                            <p class="underline">Caricato: {{$post->user->name}}</p>

                            {{-- EDIT POST --}}
                            <a href="{{route('post.edit', compact('post'))}}" class="btn btn-warning">Modifica</a>

                            {{-- DELETE POST --}}
                            <form action="{{route('post.delete', compact('post'))}}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-error">Elimina</button>
                            </form>

                            {{-- STORE COMMENT --}}
                            <form action="{{route('comment.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                <input name="description" type="text" class="input input-bordered max-w-xs">
                                <button type="submit" class="btn btn-primary">Commenta</button>
                            </form>

                          </div>
                          <h3>Commenti:</h3>

                          {{-- COMMENTS --}}
                          @if ($post->comments->isEmpty())
                            <div class="chat chat-start">
                                <div class="chat-bubble">Non ci sono ancora commenti. Sii il primo a commentare!</div>
                            </div>
                          @else

                            @foreach($post->comments as $comment)
                            <div class="chat chat-start">
                                <div class="chat-header text-lg">
                                    {{$comment->user->name}}
                                </div>
                                <div class="chat-bubble">{{$comment->description}}
                                    {{-- DELETE COMMENT --}}
                                    <form action="{{route('comment.delete', compact('comment'))}}" method="POST" class="inline">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-xs ms-3 btn-error">X</button>
                                    </form>
                                </div>
                            </div>
                            @endforeach

                          @endif
                        </div>
                      </div>
                </div>
            @endforeach
        </div>
    </section>

</x-app-layout>