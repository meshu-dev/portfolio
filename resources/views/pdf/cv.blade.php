<!doctype html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <style>
            body {
                margin: 0 50px;
            }
            .section {
                margin-bottom: 5px;
            }
            .profile-row {
                margin-bottom: 3px;
            }
            .profile-row-label {
                font-weight: bold;
            }
            .workexp-row {
                display: flex;
                flex-direction: row;
            }
            .skill-groups {
                padding-top: 20px;
                margin-bottom: -40px;
            }
            .skill-group {
                display: inline-block;
                width: 250px;
            }
            .skill-group-label {
                font-weight: bold;
            }
            .skill-list li {
                margin-bottom: 3px;
            }
            .workexp-row {
                margin-bottom: 40px;
            }
            .workexp-header {
                overflow: hidden;
                font-weight: bold;
                min-height: 20px;
                margin-bottom: 20px;
            }
            .workexp-header-title {
                float: left;
            }
            .workexp-header-date {
                float: right;
            }
            .workexp-list li {
                margin-bottom: 3px;
            }
        </style>
    </head>
    <body>
        <div>
            @isset ($profile)
                <div class="section">
                    <h1>{{ $profile['details']['fullname'] }}</h1>
                    <p>{{ $profile['details']['intro'] }}</p>
                    <div class="profile-row">
                        <span class="profile-row-label">Location:</span>
                        <span>{{ $profile['details']['location'] }}</span>
                    </div>
                    @foreach ($profile['sites'] as $profileSite)
                        <div class="profile-row">
                            <span class="profile-row-label">{{ $profileSite['name'] }}:</span>
                            <span>{{ $profileSite['url'] }}</span>
                        </div>
                    @endforeach
                </div>
            @endisset
            @isset ($skill_groups)
                <div class="section">
                    <h2>Skills</h2>
                    <div class="skill-groups">
                        @foreach ($skill_groups as $skillGroup)
                            <div class="skill-group">
                                <div class="skill-group-label">{{ $skillGroup['name'] }}</div>
                                <ul class="skill-list">
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
                <div class="section">
                    <h2>Work Experience</h2>
                    @foreach ($work_experiences as $workExperience)
                        <div class="workexp-row">
                            <div class="workexp-header">
                                <span class="workexp-header-title">{{ $workExperience['title'] }} - {{ $workExperience['company'] }}</span>
                                <span class="workexp-header-date">{{ $workExperience['location'] }} | {{ date('M y', strtotime($workExperience['start_date'])) }} - {{ $workExperience['end_date'] ? date('M y', strtotime($workExperience['end_date'])) : 'Present' }}</span>
                            </div>
                            <div>{{ $workExperience['description'] }}</div>
                            <ul class="workexp-list">
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
