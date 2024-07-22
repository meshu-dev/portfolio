<!doctype html>
    <html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')
        <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    </head>
    <body>
        <div>
            @isset ($profile)
                <div class="mb-5">
                    <h1 class="text-3xl font-bold">{{ $profile['details']['fullname'] }}</h1>
                    <p class="mt-3">{{ $profile['details']['intro'] }}</p>
                    <div class="mt-3">
                        <span class="font-bold">Location:</span>
                        <span>{{ $profile['details']['location'] }}</span>
                    </div>
                    @foreach ($profile['sites'] as $profileSite)
                        <div class="mt-2">
                            <span class="font-bold">{{ $profileSite['name'] }}:</span>
                            <span>{{ $profileSite['url'] }}</span>
                        </div>
                    @endforeach
                </div>
            @endisset
            @isset ($skill_groups)
                <div class="mb-5">
                    <h2 class="text-xl font-bold mb-2">Skills</h2>
                    <div class="grid grid-cols-2">
                        @foreach ($skill_groups as $skillGroup)
                            <div class="max-w-200 mb-5">
                                <div class="font-bold">{{ $skillGroup['name'] }}</div>
                                <ul class="list-disc ml-10">
                                    @foreach ($skillGroup['technologies'] as $technology)
                                        <li>{{ $technology['name'] }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endisset
            @isset ($work_experiences)
                <div class="mb-5">
                    <h2 class="text-xl font-bold mb-2">Work Experience</h2>
                    @foreach ($work_experiences as $workExperience)
                        <div class="mb-10">
                            <div class="flex justify-between font-bold mb-3">
                                <span>{{ $workExperience['title'] }} - {{ $workExperience['company'] }}</span>
                                <span>{{ $workExperience['date'] }}</span>
                            </div>
                            <div class="mb-3">{{ $workExperience['description'] }}</div>
                            <ul class="list-disc ml-10">
                                @foreach ($workExperience['responsibilities'] as $responsibility)
                                    <li>{{ $responsibility }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            @endisset
        </div>
    </body>
</html>
