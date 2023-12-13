<x-app-layout>

    <header class="container mt-8">
        <div class="flex flex-wrap justify-center">
            <div class="w-full text-center">
                <h1 class="text-3xl font-extrabold uppercase">Inserisci un post!</h1>
            </div>
        </div>
    </header>
    
    <section class="container mt-20">
        <div class="flex flex-wrap justify-center">
            <div class="w-6/12">
                <form method="POST" action="{{route('post.store')}}" class="flex flex-col items-center">
                    @csrf
                    <div class="flex flex-col w-[50%] items-center">
                        <label class="my-3">Titolo post</label>
                        <input type="text" name="title" placeholder="Titolo" class="input input-bordered w-full max-w-xs" />
                    </div>
                    <div class="flex flex-col w-[50%] items-center mt-3">
                        <label class="my-3">Descrizione</label>
                        <textarea name="description" class="textarea textarea-bordered w-full" placeholder="Descrizione"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5">Inserisci</button>
                </form>
            </div>
        </div>
    </section>

</x-app-layout>