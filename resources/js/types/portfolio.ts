import { CalendarDate } from '@internationalized/date'

export type About = {
    id: string,
    text: string
    technologies: Technology[]
    image_url: string
    remove_image: boolean
}

export type ProjectListItem = {
    id: string,
    name: string;
    url: string;
}

export type Project = ProjectListItem & {
  description: string
  repositories: Repository[]
  technologies: Technology[]
  image_url: string
  remove_image: boolean
}

export type Repository = {
    id: string,
    name: string;
    url: string;
}

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
