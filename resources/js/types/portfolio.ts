export type Skill = {
    id: string,
    name: string;
}

export type Technology = {
    id: string,
    name: string;
}

export type WorkExperience = {
    id: string;
    title: string;
    company: string;
    location: string;
    isCurrent: boolean;
    start_date: string;
    end_date: string|null;
    description: string;
    responsibilities: string,
    active: boolean
}
