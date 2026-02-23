import { CalendarDate } from '@internationalized/date'

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
    start_date: CalendarDate;
    end_date: CalendarDate|null;
    description: string;
    responsibilities: string,
    active: boolean
}
