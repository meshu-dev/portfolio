@vite('resources/css/app.css')
<div class="m-4 inline-block">
    <h1 class="text-2xl font-bold mb-4">Hi there 👋, I'm Mesh</h1>
    <p class="mb-2">Currently working on personal projects to enhance my skills and explore technologies which I haven't worked with before.</p>
    <div class="mb-2">
        {!! $streakStats !!}
    </div>
    <h2 class="text-xl font-bold mb-1">Technologies</h2>
    <hr class="mb-4" />
    <div class="mb-4">
        {!! $readMeStats !!}
    </div>
    <div class="flex">    
        @foreach ($skills as $skill)
            <div class="w-48">
                <h3 class="text-l font-bold mb-2">{{ $skill->name }}</h3>
                <ul class="list-disc ml-8 max-w-36">
                    @foreach ($skill->technologies as $technology)
                        <li class="mb-1">{{ $technology->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
